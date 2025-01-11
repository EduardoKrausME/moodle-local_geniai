define(['jquery', 'core/ajax', 'core/notification'], function($, ajax, notification) {
    return {
        init : function() {
            var contextid = $(".editmode-switch-form [name=setmode]").attr("data-context");
            if (contextid) {
                var botao;

                if (document.getElementById("page-contentbank")) {

                    botao = `
                        <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}" 
                           class="d-flex align-items-center btn btn-dark text-nowrap mr-1">
                            <i class="icon fa fa-add fa-fw" style="height:24px;"></i>
                            ${M.util.get_string("h5p-manager", "local_geniai")}
                        </a>`;
                    $("#page-contentbank .content-bank-container .cb-toolbar-container").prepend(botao);
                }

                if (document.getElementById("page-mod-h5pactivity-mod")) {
                    botao = `
                        <div>
                            <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}" target="_blank"
                               class="d-flex align-items-center btn btn-dark text-nowrap">
                                <i class="icon fa fa-add fa-fw" style="height:24px;"></i>
                                ${M.util.get_string("h5p-manager", "local_geniai")}
                            </a>
                        </div>`;
                    $("#id_error_contentbank").before(botao);
                }
            }
        }
    };
});
