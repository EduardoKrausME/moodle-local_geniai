// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * activity-analyzer.js
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/ajax", "core/notification", "core/templates", "core/str"], function ($, ajax, notification, templates, str) {
    var currentCourseId = 0;
    var currentCmid = null;
    var currentActivityName = "";
    var currentPlainText = "";
    var currentPrintHtml = "";
    var initialized = false;

    var selectors = {
        activity: ".activity[id^=\"module-\"]",
        controls: ".local-geniai-analysis-controls",
        button: ".local-geniai-analyze-activity-btn",
        latest: ".local-geniai-latest-analysis-btn",
        latestStatus: ".local-geniai-latest-analysis-status",
        latestSummary: ".local-geniai-latest-analysis-summary",
        modal: "#local-geniai-activity-analysis-modal",
        loading: ".local-geniai-analysis-loading",
        error: ".local-geniai-analysis-error",
        result: ".local-geniai-analysis-result",
        activityName: ".local-geniai-analysis-activity-name",
        print: ".local-geniai-analysis-print",
        reanalyze: ".local-geniai-analysis-reanalyze"
    };

    /**
     * Initialize the activity analyzer UI.
     *
     * @param {Number} courseid Current course ID.
     */
    function init(courseid) {
        if (initialized) {
            return;
        }

        initialized = true;
        currentCourseId = parseInt(courseid, 10) || 0;

        if ($("body.pagelayout-embedded, body.pagelayout-maintenance").length) {
            return;
        }

        injectButtons();
        bindEvents(courseid);
        observeCourseChanges();
    }

    /**
     * Bind click events.
     *
     * @param {Number} courseid Current course ID.
     */
    function bindEvents(courseid) {
        $("body").on("click", selectors.button, function (e) {
            e.preventDefault();
            e.stopPropagation();

            currentCmid = parseInt($(this).attr("data-cmid"), 10);
            currentActivityName = getActivityName($(this).closest(selectors.activity));

            if (!currentCmid) {
                return;
            }

            openModal();
            analyze(courseid, currentCmid);
        });

        $("body").on("click", selectors.latest, function (e) {
            e.preventDefault();
            e.stopPropagation();

            currentCmid = parseInt($(this).attr("data-cmid"), 10);
            currentActivityName = getActivityName($(this).closest(selectors.activity));

            if (!currentCmid) {
                return;
            }

            openModal();
            loadLatestAnalysis(courseid, currentCmid, null, true);
        });

        $(selectors.modal).on("click", selectors.reanalyze, function (e) {
            e.preventDefault();

            if (currentCmid) {
                analyze(courseid, currentCmid);
            }
        });

        $(selectors.modal).on("click", selectors.print, function (e) {
            e.preventDefault();
            printResult();
        });
    }

    /**
     * Inject analyzer buttons into activities.
     */
    function injectButtons() {
        $(selectors.activity).each(function () {
            var activity = $(this);
            var cmid = getCmid(activity);

            if (!cmid || activity.find(selectors.controls).length) {
                return;
            }

            templates.render("local_geniai/activity_analyzer_button", {cmid: cmid})
                .done(function (html) {
                    var controls = $(html);
                    placeButton(activity, controls);
                    loadLatestAnalysis(currentCourseId, cmid, controls, false);
                })
                .fail(notification.exception);
        });
    }

    /**
     * Observe course format AJAX redraws and inject buttons again when needed.
     */
    function observeCourseChanges() {
        if (!window.MutationObserver) {
            return;
        }

        var target = document.querySelector("#region-main") || document.body;
        var timeout = null;

        var observer = new MutationObserver(function () {
            window.clearTimeout(timeout);
            timeout = window.setTimeout(injectButtons, 250);
        });

        observer.observe(target, {
            childList: true,
            subtree: true
        });
    }

    /**
     * Place the button in the most compatible activity region available.
     *
     * @param {Object} activity Activity jQuery element.
     * @param {Object} button Button jQuery element.
     */
    function placeButton(activity, button) {
        var actions = activity.find("[data-region=\"activity-actions\"], .activity-actions, .actions").first();

        if (actions.length) {
            actions.prepend(button);
            return;
        }

        var header = activity.find(".activity-header, .activity-item, .activityinstance").first();

        if (header.length) {
            header.append(button);
            return;
        }

        activity.prepend(button);
    }

    /**
     * Get course module ID from the activity element.
     *
     * @param {Object} activity Activity jQuery element.
     * @returns {Number}
     */
    function getCmid(activity) {
        var id = activity.attr("id") || "";
        var match = id.match(/^module-(\d+)$/);

        if (!match) {
            return 0;
        }

        return parseInt(match[1], 10);
    }

    /**
     * Try to extract a readable activity name.
     *
     * @param {Object} activity Activity jQuery element.
     * @returns {String}
     */
    function getActivityName(activity) {
        var name = activity.find(".instancename").first().text().trim();

        if (!name) {
            name = activity.find("a").first().text().trim();
        }

        return name.replace(/\s+/g, " ");
    }

    /**
     * Open and prepare the modal.
     */
    function openModal() {
        var modal = $(selectors.modal);

        modal.find(selectors.activityName).text(currentActivityName);
        modal.find(selectors.error).addClass("d-none").empty();
        modal.find(selectors.result).empty();
        modal.find(selectors.loading).removeClass("d-none");
        modal.find(selectors.print).prop("disabled", true);
        modal.find(selectors.reanalyze).prop("disabled", true);

        if (typeof modal.modal === "function") {
            modal.modal("show");
        } else {
            modal.addClass("show").show();
        }
    }

    /**
     * Analyze an activity through Moodle AJAX.
     *
     * @param {Number} courseid Current course ID.
     * @param {Number} cmid Course module ID.
     */
    function analyze(courseid, cmid) {
        var modal = $(selectors.modal);

        modal.find(selectors.loading).removeClass("d-none");
        modal.find(selectors.error).addClass("d-none").empty();
        modal.find(selectors.result).empty();
        modal.find(selectors.print).prop("disabled", true);
        modal.find(selectors.reanalyze).prop("disabled", true);
        currentPlainText = "";
        currentPrintHtml = "";

        ajax.call([{
            methodname: "local_geniai_analyze_activity",
            args: {
                cmid: cmid,
                analysis: "full"
            }
        }])[0].done(function (data) {
            modal.find(selectors.loading).addClass("d-none");
            modal.find(selectors.reanalyze).prop("disabled", false);

            if (!data.result) {
                showError(data.message || data.content || data.content_html || "");
                return;
            }

            prepareAnalysisData(data);
            currentPlainText = data.content || "";
            currentPrintHtml = data.content_html || "";

            templates.render("local_geniai/activity_analyzer_result", data)
                .done(function (html) {
                    modal.find(selectors.result).html(html);
                    modal.find(selectors.print).prop("disabled", false);
                    updateLatestSummary(cmid, data);
                })
                .fail(notification.exception);
        }).fail(function (error) {
            modal.find(selectors.loading).addClass("d-none");
            modal.find(selectors.reanalyze).prop("disabled", false);
            notification.exception(error);
        });
    }

    /**
     * Load the latest stored analysis from mdl_local_geniai_analysis.
     *
     * @param {Number} courseid Current course ID.
     * @param {Number} cmid Course module ID.
     * @param {Object|null} controls Optional controls wrapper.
     * @param {Boolean} renderInModal Whether to render the latest result in the modal.
     */
    function loadLatestAnalysis(courseid, cmid, controls, renderInModal) {
        if (!courseid || !cmid) {
            return;
        }

        ajax.call([{
            methodname: "local_geniai_analysis_history",
            args: {
                courseid: courseid,
                cmid: cmid,
                limit: 1
            }
        }])[0].done(function (data) {
            var item = data && data.items && data.items.length ? data.items[0] : null;

            if (!item) {
                if (renderInModal) {
                    showNoContent();
                }
                return;
            }

            prepareAnalysisData(item);
            updateLatestSummary(cmid, item, controls);

            if (renderInModal) {
                renderStoredAnalysis(item);
            }
        }).fail(function (error) {
            if (renderInModal) {
                $(selectors.modal).find(selectors.loading).addClass("d-none");
                $(selectors.modal).find(selectors.reanalyze).prop("disabled", false);
                notification.exception(error);
            }
        });
    }

    /**
     * Prepare additional properties used by Mustache templates.
     *
     * @param {Object} data Analysis data.
     */
    function prepareAnalysisData(data) {
        data.model_warning = getModelWarning(data.model || "");
        data.has_recommendations = !!(data.recommendations && data.recommendations.length);
    }

    /**
     * Render a stored analysis in the modal.
     *
     * @param {Object} item Stored analysis item.
     */
    function renderStoredAnalysis(item) {
        var modal = $(selectors.modal);

        currentPlainText = item.content || "";
        currentPrintHtml = item.content_html || "";

        modal.find(selectors.loading).addClass("d-none");
        modal.find(selectors.error).addClass("d-none").empty();
        modal.find(selectors.reanalyze).prop("disabled", false);

        templates.render("local_geniai/activity_analyzer_result", item)
            .done(function (html) {
                modal.find(selectors.result).html(html);
                modal.find(selectors.print).prop("disabled", false);
            })
            .fail(notification.exception);
    }

    /**
     * Show a no content message in the modal.
     */
    function showNoContent() {
        var modal = $(selectors.modal);

        modal.find(selectors.loading).addClass("d-none");
        modal.find(selectors.reanalyze).prop("disabled", false);

        M.util.get_string("analysis_no_content", "local_geniai").done(function (message) {
            modal.find(selectors.error).removeClass("d-none").text(message);
        });
    }

    /**
     * Update the latest analysis summary beside the activity button.
     *
     * @param {Number} cmid Course module ID.
     * @param {Object} item Analysis item.
     * @param {Object|null} controls Optional controls wrapper.
     */
    function updateLatestSummary(cmid, item, controls) {
        controls = controls || $(selectors.controls + '[data-cmid="' + cmid + '"]').first();

        if (!controls || !controls.length) {
            return;
        }

        var status = item.status || "";
        var label = status ?
            `${M.util.get_string("analysis_last", "local_geniai")}: ${status}` :
            M.util.get_string("analysis_last", "local_geniai");
        var summary = buildRecommendationSummary(item);

        controls.find(selectors.latest)
            .removeClass('d-none')
            .attr("title", label)
            .find(selectors.latestStatus)
            .text(label);

        controls.find(selectors.latestSummary)
            .removeClass('d-none')
            .html(summary);
    }

    /**
     * Build the inline status/recommendation summary.
     *
     * @param {Object} item Analysis item.
     * @returns {String}
     */
    function buildRecommendationSummary(item) {
        var parts = [];
        var recommendations = item.recommendations || [];

        if (recommendations.length) {
            const html = `
                <ul>
                    ${recommendations.slice(0, 2).map(item => `<li>${escapeHtml(item)}</li>`).join('')}
                </ul>`;
            parts.push(`<strong>${M.util.get_string("analysis_recommendations", "local_geniai")}:</strong> ${html}`);
        } else {
            parts.push(`<strong>${M.util.get_string("analysis_recommendations", "local_geniai")}:</strong> -`);
        }

        return parts.join(' <span class="mx-1">|</span> ');
    }

    /**
     * Return a warning for mini/nano models.
     *
     * @param {String} model Model name.
     * @returns {String}
     */
    function getModelWarning(model) {
        model = String(model || "").toLowerCase();

        if (model.indexOf("mini") === -1 && model.indexOf("nano") === -1) {
            return "";
        }

        return M.util.get_string("analysis_model_warning", "local_geniai", M.cfg.wwwroot)
    }

    /**
     * Show an error message in the modal.
     *
     * @param {String} message Error message.
     */
    function showError(message) {
        var fallback = M.util.get_string("analysis_error", "local_geniai");

        $.when(fallback).done(function (errorText) {
            $(selectors.modal).find(selectors.error)
                .removeClass('d-none')
                .text(message || errorText);
        });
    }

    /**
     * Open the current analysis in a new tab ready to print.
     */
    function printResult() {
        if (!currentPrintHtml && !currentPlainText) {
            return;
        }

        var printWindow = window.open("", "_blank");

        if (!printWindow) {
            showPrintBlockedNotification();
            return;
        }

        printWindow.document.open();
        printWindow.document.write(buildPrintDocument());
        printWindow.document.close();
        printWindow.focus();
    }

    /**
     * Build a standalone HTML document for printing.
     *
     * @returns {String}
     */
    function buildPrintDocument() {
        var title = currentActivityName || M.util.get_string("analysis_result", "local_geniai");
        var safeTitle = escapeHtml(title);
        var content = currentPrintHtml || '<pre>' + escapeHtml(currentPlainText) + '</pre>';

        return `<!doctype html>
            <html lang="pt-br">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>${safeTitle}</title>
                <style>
                    body{margin:0;background:#f3f4f6;color:#111827;font-family:Arial,Helvetica,sans-serif;line-height:1.55;}
                    .print-toolbar{position:sticky;top:0;z-index:10;padding:16px 24px;background:#ffffff;border-bottom:1px solid #e5e7eb;text-align:right;}
                    .print-toolbar button{border:0;border-radius:8px;background:#0f6cbf;color:#ffffff;font-size:15px;font-weight:700;padding:10px 18px;cursor:pointer;}
                    .print-page{max-width:920px;margin:28px auto;background:#ffffff;padding:42px;box-shadow:0 10px 30px rgba(15,23,42,.12);border-radius:14px;}
                    h1{margin:0 0 22px;font-size:28px;line-height:1.2;color:#0f172a;}
                    h2,h3{color:#0f172a;margin-top:28px;}
                    p,li{font-size:15px;}
                    pre{white-space:pre-wrap;word-break:break-word;background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;padding:18px;}
                    .badge{display:inline-block;margin:0 8px 12px 0;padding:4px 9px;border-radius:999px;background:#e0f2fe;color:#075985;font-size:12px;font-weight:700;}
                    @media print{body{background:#fff;}.no-print{display:none!important;}.print-page{max-width:none;margin:0;padding:0;box-shadow:none;border-radius:0;}a{color:#111827;text-decoration:none;}}
                </style>
            </head>
            <body>
                <div class="print-toolbar no-print"><button type="button" onclick="window.print()">${M.util.get_string("analysis_print", "local_geniai")}</button></div>
                <main class="print-page">
                    <h1>${safeTitle}</h1>
                    ${content}
                </main>
            </body>
            </html>`;
    }

    /**
     * Escape plain text before writing it into the print document.
     *
     * @param {String} text Text to escape.
     * @returns {String}
     */
    function escapeHtml(text) {
        return String(text || "").replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[char];
        });
    }

    /**
     * Show blocked popup notification.
     */
    function showPrintBlockedNotification() {
        M.util.get_string("analysis_print_popup_blocked", "local_geniai").done(function (message) {
            notification.addNotification({
                message: message,
                type: "warning"
            });
        });
    }

    return {
        init: init
    };
});
