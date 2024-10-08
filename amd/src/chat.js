define(['jquery', 'core/ajax', 'core/notification'], function($, ajax, notification) {
    return {
        init : function(courseid, release) {
            var geniaichat = $("#geniai-chat");

            if ($('.pagelayout-embedded, .pagelayout-maintenance').length) {
                geniaichat.hide();
                geniaichat.remove();
                return;
            }

            var geniaiscrollarea = document.getElementById("geniai-scrollarea");
            var geniaiareamensagens = $("#geniai-area-mensagens");
            var geniaisendarea = $("#geniai-sendarea");
            var geniaitextarea = $("#geniai-textarea");

            geniaichat.show(200);
            geniaitextarea
                .keydown(function(e) {
                    setTimeout(function() {
                        var messagesend = geniaitextarea.val();
                        if (messagesend.length > 1) {
                            geniaisendarea.addClass("geniai-active");
                        } else {
                            geniaisendarea.removeClass("geniai-active");
                        }
                    }, 10);

                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        sendMessage();
                    }
                })
                .on('input', function(event) {
                    event.currentTarget.style.height = "34px";
                    event.currentTarget.style.height = (event.currentTarget.scrollHeight) + "px";
                });
            document.getElementById('geniai-textarea').addEventListener("paste", function(e) {
                e.preventDefault();
                var text = e.clipboardData.getData("text/plain");
                document.execCommand("insertHTML", false, text);
            });

            $("#geniai-icon-send").click(sendMessage);

            geniaisendarea.click(function() {
                document.getElementById('geniai-textarea').focus();
            });

            function sendMessage() {
                var messagesend = geniaitextarea.val().trim();
                if (messagesend.length > 1) {
                    setTimeout(function() {
                        geniaitextarea.val("");
                        geniaitextarea.css({height : 34});
                        geniaisendarea.removeClass("geniai-active");
                    }, 20);

                    var geniaiServerId = "id-" + Math.random().toString(16).slice(2);
                    geniaiareamensagens.append(`
                <div class="geniai-messagem" id="${geniaiServerId}-send"></div>
                <div id="${geniaiServerId}" class="geniai-messagem geniai-server">
                    <svg height="40" class="geniai-loader">
                        <circle class="dot" cx="10" cy="20" r="3" style="fill:#777;" />
                        <circle class="dot" cx="20" cy="20" r="3" style="fill:#777;" />
                        <circle class="dot" cx="30" cy="20" r="3" style="fill:#777;" />
                    </svg>
                </div>`);
                    $(`#${geniaiServerId}-send`).text(messagesend);
                    geniaiscrollarea.scrollTop = 10000000000000;

                    var methodname = 'local_geniai_chat_3';
                    if (release >= 4.2) {
                        methodname = 'local_geniai_chat_4';
                    }

                    ajax.call([{
                        methodname : methodname,
                        args       : {
                            message  : messagesend,
                            courseid : courseid
                        }
                    }])[0].done(function(data) {

                        if (data.result) {
                            $("#" + geniaiServerId)
                                .html(data.content);
                        } else {
                            $("#" + geniaiServerId)
                                .html(data.content)
                                .addClass("geniai-error");
                        }

                        geniaiscrollarea.scrollTop = 10000000000000;
                    }).fail(notification.exception);
                }
            }

            function resizeScrollarea() {
                var height = $(window).innerHeight() - 165;
                $("#geniai-scrollarea").css({
                    "max-height" : height + "px"
                });
            }

            $(window).resize(resizeScrollarea);
            resizeScrollarea();

            $("#geniai-chat-btn,#geniai-icon-close").click(function() {
                geniaichat.toggleClass("geniai-active");

                if (geniaichat.hasClass("geniai-active")) {
                    localStorage.setItem('geniai-chat-isopen', 'true');
                    openChat();
                } else {
                    localStorage.removeItem('geniai-chat-isopen');
                }
            });
            if (localStorage.getItem('geniai-chat-isopen') == 'true') {
                geniaichat.addClass("geniai-active");
                openChat();
            }

            function openChat() {
                geniaiareamensagens.html("");
                setTimeout(showHistory, 0);
                startChat();
            }

            $("#geniai-clear-history").click(function() {
                geniaiareamensagens.html("");
                startChat();

                var methodname = 'local_geniai_history_3';
                if (release >= 4.2) {
                    methodname = 'local_geniai_history_4';
                }

                ajax.call([{
                    methodname : methodname,
                    args       : {
                        courseid : courseid,
                        action   : "clear"
                    }
                }]);
            });

            function startChat() {
                var message_01 = $("#local_geniai_message_01").val();
                var message_02 = $("#local_geniai_message_02").val();
                geniaiareamensagens.append(`<div class="geniai-messagem geniai-server format-text">${message_01}</div>`);
                geniaiareamensagens.append(`<div class="geniai-messagem geniai-server format-text">${message_02}</div>`);
            }

            function showHistory() {

                var methodname = 'local_geniai_history_3';
                if (release >= 4.2) {
                    methodname = 'local_geniai_history_4';
                }

                ajax.call([{
                    methodname : methodname,
                    args       : {
                        courseid : courseid,
                        action   : "history"
                    }
                }])[0].done(function(data) {
                    var history = JSON.parse(data.content);
                    $.each(history, function(id, message) {
                        if (message.role == "user") {
                            geniaiareamensagens.append(
                                `<div class="geniai-messagem">${message.content}</div>`);
                        } else if (message.role == "system") {
                            geniaiareamensagens.append(
                                `<div class="geniai-messagem geniai-server">${message.content}</div>`);
                        }
                    });
                    geniaiscrollarea.scrollTop = 10000000000000;
                }).fail(notification.exception);
            }
        }
    };
});
