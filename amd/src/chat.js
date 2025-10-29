define(["jquery", "core/ajax", "core/notification"], function($, ajax, notification) {
    var chat = {

        init: function(courseid, release) {

            if ($("body.pagelayout-embedded").length) {
                return;
            }

            chat.load_audioplayer();
            chat.record_start();

            var geniaichat = $("#geniai-chat");

            if ($(".pagelayout-embedded, .pagelayout-maintenance").length) {
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
                .on("input", function(event) {
                    event.currentTarget.style.height = "34px";
                    event.currentTarget.style.height = (event.currentTarget.scrollHeight) + "px";
                });
            document.getElementById("geniai-textarea").addEventListener("paste", function(e) {
                e.preventDefault();
                var text = e.clipboardData.getData("text/plain");
                document.execCommand("insertHTML", false, text);
            });

            $("#geniai-icon-send").click(sendMessage);

            geniaisendarea.click(function() {
                document.getElementById("geniai-textarea").focus();
            });

            function sendMessage() {
                var messagesend = geniaitextarea.val().trim();
                if (messagesend.length > 1 || chat.mediaRecordUrl) {
                    setTimeout(function() {
                        geniaitextarea.val("");
                        geniaitextarea.css({height: 34});
                        geniaisendarea.removeClass("geniai-active");

                        chat.reset_recording();
                    }, 20);

                    var geniaiServerId = "id-" + Math.random().toString(16).slice(2);
                    geniaiareamensagens.append(`
                            <div class="geniai-message" id="${geniaiServerId}-send"></div>
                            <div id="${geniaiServerId}" class="geniai-message geniai-server">
                                <svg height="40" class="geniai-loader">
                                    <circle class="dot" cx="10" cy="20" r="3" style="fill:#777;" />
                                    <circle class="dot" cx="20" cy="20" r="3" style="fill:#777;" />
                                    <circle class="dot" cx="30" cy="20" r="3" style="fill:#777;" />
                                </svg>
                            </div>`);
                    if (chat.mediaRecordUrl) {
                        $(`#${geniaiServerId}-send`).html(`
                            <audio controls autoplay src="${chat.mediaRecordUrl}" 
                                   id="${geniaiServerId}-audio"></audio>
                            <div id="${geniaiServerId}-transcription" class="transcription"></div>`);

                        $(`#${geniaiServerId}-audio`).audioPlayer();
                    } else {
                        $(`#${geniaiServerId}-send`).html(messagesend);
                    }
                    geniaiscrollarea.scrollTop = 10000000000000;

                    ajax.call([{
                        methodname: "local_geniai_chat",
                        args: {
                            message: messagesend,
                            audio: chat.mediaRecordUrl,
                            courseid: courseid,
                            lang: chat.lang,
                        }
                    }])[0].done(function(data) {
                        if (data.result) {
                            if (data.content_html) {
                                $(`#${geniaiServerId}`).html(data.content_html);
                            }else{
                                $(`#${geniaiServerId}`).html(data.content);
                            }

                            if (data.content_transcription) {
                                $(`#${geniaiServerId}-transcription`).html(data.content_transcription);
                            }

                            $(`#${geniaiServerId} audio`).audioPlayer();
                        } else {
                            console.log(data);
                            if (data.message) {
                                $(`#${geniaiServerId}`)
                                    .html(data.message)
                                    .addClass("geniai-error");
                            } else {
                                $(`#${geniaiServerId}`)
                                    .html(data.content)
                                    .addClass("geniai-error");
                            }
                        }

                        geniaiscrollarea.scrollTop = 10000000000000;
                    }).fail(notification.exception);
                }
            }

            function resizeScrollarea() {
                if ($("#geniai-chat").hasClass("mode-geniai")) {
                    var height1 = $(window).innerHeight() - 181;
                    $("#geniai-scrollarea").css({
                        "max-height": height1 + "px",
                        "min-height": height1 + "px",
                    });
                } else {
                    var height2 = $(window).innerHeight() - 165;
                    $("#geniai-scrollarea").css({
                        "max-height": height2 + "px",
                    });
                }
            }

            $(window).resize(resizeScrollarea);
            resizeScrollarea();

            $("#geniai-chat-btn,#geniai-icon-close").click(function() {
                event.stopPropagation();
                event.preventDefault();

                geniaichat.toggleClass("geniai-active");

                if (geniaichat.hasClass("geniai-active")) {
                    localStorage.setItem("geniai-chat-isopen", "true");
                    openChat();
                } else {
                    localStorage.removeItem("geniai-chat-isopen");
                }
            });
            if (localStorage.getItem("geniai-chat-isopen") == "true") {
                geniaichat.addClass("geniai-active");
                openChat();
            }
            if (document.getElementById("geniai-mod-popup")) {
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

                ajax.call([{
                    methodname: "local_geniai_history",
                    args: {
                        courseid: courseid,
                        action: "clear"
                    }
                }]);
            });

            function startChat() {
                const message_01 = $("#local_geniai_message_01").val();
                geniaiareamensagens.append(`<div class="geniai-message geniai-server format-text">${message_01}</div>`);

                const message_02 = $("#local_geniai_message_02").val();
                const messages = message_02.split("\n");
                for (let i = 0; i < messages.length; i++) {
                    const msg = messages[i].trim();
                    if (msg.length < 3) {
                        continue;
                    }
                    geniaiareamensagens.append(`<div class="geniai-message geniai-server format-text">${msg}</div>`);
                }
            }

            function showHistory() {
                ajax.call([{
                    methodname: "local_geniai_history",
                    args: {
                        courseid: courseid,
                        action: "history"
                    }
                }])[0].done(function(data) {
                    var history = JSON.parse(data.content);
                    var iterate = $.each(history, function(id, message) {
                        var html = null;
                        if (message.role == "user") {
                            html = $(`<div class="geniai-message geniai-history">${message.content}</div>`);
                        } else if (message.role == "system") {
                            html = $(`<div class="geniai-message geniai-history geniai-server">${message.content}</div>`);
                        }

                        html.find("audio").removeAttr("autoplay");
                        geniaiareamensagens.append(html);
                    });
                    $.when(iterate).done(function() {
                        $(`#geniai-chat audio`).audioPlayer();
                    });

                    geniaiscrollarea.scrollTop = 10000000000000;
                }).fail(notification.exception);
            }
        },

        mediaRecordUrl: null,

        record_start: function() {
            let chunks = []; // will be used later to record audio
            let mediaRecorder = null; // will be used later to record audio

            $("#geniai-icon-mic").click(record);
            $("#geniai-icon-stop").click(chat.reset_recording);

            function record() {
                chat.reset_recording();

                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert("Your browser does not support recording!");
                    return;
                }

                if (!mediaRecorder) {

                    $("#geniai-icon-mic").addClass("recording");
                    $("#geniai-textarea").css({"opacity": 0});

                    // start recording
                    navigator.mediaDevices.getUserMedia({
                            audio: true,
                        })
                        .then((stream) => {
                            mediaRecorder = new MediaRecorder(stream);
                            mediaRecorder.start();
                            mediaRecorder.ondataavailable = mediaRecorderDataAvailable;
                            mediaRecorder.onstop = mediaRecorderStop;
                        })
                        .catch((err) => {
                            alert(`The following error occurred: ${err}`);
                            $("#geniai-icon-mic").removeClass("recording");
                            $("#geniai-textarea").css({"opacity": 1});
                        });
                } else {
                    // stop recording
                    mediaRecorder.stop();
                    mediaRecorder = null;

                    $("#geniai-icon-mic").removeClass("recording");
                    $("#geniai-textarea").css({"opacity": 1});

                    $("#geniai-icon-send").click();
                }
            }

            function mediaRecorderDataAvailable(e) {
                chunks.push(e.data);
            }

            function mediaRecorderStop() {

                var reader = new FileReader();
                reader.readAsDataURL(new Blob(chunks, {type: "audio/mp3"}));
                reader.onloadend = function() {
                    chat.mediaRecordUrl = reader.result;
                };

                $("#geniai-sendarea").addClass("geniai-active");
                $("#geniai-icon-stop").show();

                mediaRecorder = null;
                chunks = [];
            }
        },

        reset_recording: function() {
            $("#geniai-icon-mic").removeClass("recording").show();
            $("#geniai-icon-stop").hide();
            $("#recorded-audio-container").hide();
            $("#geniai-sendarea").removeClass("geniai-active");
            $("#geniai-textarea").css({"opacity": 1});

            chat.mediaRecordUrl = null;
        },

        load_audioplayer: function() {
            /* AUTHOR: Osvaldas Valutis, www.osvaldas.info */
            var isTouch       = "ontouchstart" in window,
                eStart        = isTouch ? "touchstart" : "mousedown",
                eMove         = isTouch ? "touchmove" : "mousemove",
                eEnd          = isTouch ? "touchend" : "mouseup",
                eCancel       = isTouch ? "touchcancel" : "mouseup",
                secondsToTime = function(secs) {
                    var hours   = Math.floor(secs / 3600),
                        minutes = Math.floor(secs % 3600 / 60),
                        seconds = Math.ceil(secs % 3600 % 60);
                    return (hours == 0 ? "" : hours > 0 && hours.toString().length < 2 ? "0" + hours + ":" : hours + ":") + (minutes.toString().length < 2 ? "0" + minutes : minutes) + ":" + (seconds.toString().length < 2 ? "0" + seconds : seconds);
                },
                canPlayType   = function(file) {
                    var audioElement = document.createElement("audio");
                    return !!(audioElement.canPlayType && audioElement.canPlayType("audio/" + file.split(".").pop().toLowerCase() + ";").replace(/no/, ""));
                };

            $.fn.audioPlayer = function(params) {
                var params      = $.extend({
                        classPrefix: "audioplayer",
                        strPlay: "",
                        strPause: "",
                        strVolume: ""
                    }, params),
                    cssClass    = {},
                    cssClassSub = {
                        playPause: "playpause",
                        playing: "playing",
                        time: "time",
                        timeCurrent: "time-current",
                        timeDuration: "time-duration",
                        bar: "bar",
                        barLoaded: "bar-loaded",
                        barPlayed: "bar-played",
                        volume: "volume",
                        volumeButton: "volume-button",
                        volumeAdjust: "volume-adjust",
                        noVolume: "novolume",
                        mute: "mute",
                        mini: "mini"
                    };

                for (var subName in cssClassSub)
                    cssClass[subName] = params.classPrefix + "-" + cssClassSub[subName];

                this.each(function() {
                    if ($(this).prop("tagName").toLowerCase() != "audio")
                        return false;

                    var $this = $(this);
                    var audioFile = $this.attr("src");
                    var isAutoPlay = $this.get(0).getAttribute("autoplay");
                    isAutoPlay = isAutoPlay === "" || isAutoPlay === "autoplay" ? true : false;
                    var isLoop = $this.get(0).getAttribute("loop");
                    isLoop = isLoop === "" || isLoop === "loop" ? true : false;
                    var isSupport = false;

                    if (typeof audioFile === "undefined") {
                        $this.find("source").each(function() {
                            audioFile = $(this).attr("src");
                            if (typeof audioFile !== "undefined" && canPlayType(audioFile)) {
                                isSupport = true;
                                return false;
                            }
                        });
                    } else if (canPlayType(audioFile)) {
                        isSupport = true;
                    }
                    isSupport = true;

                    var thePlayer = $('<div class="' + params.classPrefix + '">' + (isSupport ? $('<div>').append($this.eq(0).clone()).html() : '<embed src="' + audioFile + '" width="0" height="0" volume="100" autostart="' + isAutoPlay.toString() + '" loop="' + isLoop.toString() + '" />') + '<div class="' + cssClass.playPause + '" title="' + params.strPlay + '"><a href="#">' + params.strPlay + '</a></div></div>');
                    var theAudio = isSupport ? thePlayer.find("audio") : thePlayer.find("embed");
                    theAudio = theAudio.get(0);

                    if (isSupport) {
                        thePlayer.find("audio").css({
                            "width": 0,
                            "height": 0,
                            "visibility": "hidden"
                        });
                        thePlayer.append('<div class="' + cssClass.time + ' ' + cssClass.timeCurrent + '"></div><div class="' + cssClass.bar + '"><div class="' + cssClass.barLoaded + '"></div><div class="' + cssClass.barPlayed + '"></div></div><div class="' + cssClass.time + ' ' + cssClass.timeDuration + '"></div><div class="' + cssClass.volume + '"><div class="' + cssClass.volumeButton + '" title="' + params.strVolume + '"><a href="#">' + params.strVolume + '</a></div><div class="' + cssClass.volumeAdjust + '"><div><div></div></div></div></div>');

                        var theBar            = thePlayer.find("." + cssClass.bar),
                            barPlayed         = thePlayer.find("." + cssClass.barPlayed),
                            barLoaded         = thePlayer.find("." + cssClass.barLoaded),
                            timeCurrent       = thePlayer.find("." + cssClass.timeCurrent),
                            timeDuration      = thePlayer.find("." + cssClass.timeDuration),
                            volumeButton      = thePlayer.find("." + cssClass.volumeButton),
                            volumeAdjuster    = thePlayer.find("." + cssClass.volumeAdjust + " > div"),
                            volumeDefault     = 0,
                            adjustCurrentTime = function(e) {
                                theRealEvent = isTouch ? e.originalEvent.touches[0] : e;
                                theAudio.currentTime = Math.round((theAudio.duration * (theRealEvent.pageX - theBar.offset().left)) / theBar.width());
                            },
                            adjustVolume      = function(e) {
                                theRealEvent = isTouch ? e.originalEvent.touches[0] : e;
                                theAudio.volume = Math.abs((theRealEvent.pageX - volumeAdjuster.offset().left) / volumeAdjuster.width());
                            },
                            updateLoadBar     = setInterval(function() {
                                if (theAudio.buffered.length > 0) {
                                    barLoaded.width((theAudio.buffered.end(0) / theAudio.duration) * 100 + "%");
                                    if (theAudio.buffered.end(0) >= theAudio.duration)
                                        clearInterval(updateLoadBar);
                                }
                            }, 100);

                        var volumeTestDefault = theAudio.volume,
                            volumeTestValue   = theAudio.volume = 0.111;
                        if (Math.round(theAudio.volume * 1000) / 1000 == volumeTestValue) theAudio.volume = volumeTestDefault;
                        else thePlayer.addClass(cssClass.noVolume);

                        timeDuration.html("&hellip;");
                        timeCurrent.text(secondsToTime(0));

                        theAudio.addEventListener("loadeddata", function() {
                            timeDuration.text(secondsToTime(theAudio.duration));
                            volumeAdjuster.find("div").width(theAudio.volume * 100 + "%");
                            volumeDefault = theAudio.volume;
                        });

                        theAudio.addEventListener("timeupdate", function() {
                            timeCurrent.text(secondsToTime(theAudio.currentTime));
                            barPlayed.width((theAudio.currentTime / theAudio.duration) * 100 + "%");
                        });

                        theAudio.addEventListener("volumechange", function() {
                            volumeAdjuster.find("div").width(theAudio.volume * 100 + "%");
                            if (theAudio.volume > 0 && thePlayer.hasClass(cssClass.mute)) thePlayer.removeClass(cssClass.mute);
                            if (theAudio.volume <= 0 && !thePlayer.hasClass(cssClass.mute)) thePlayer.addClass(cssClass.mute);
                        });

                        theAudio.addEventListener("ended", function() {
                            thePlayer.removeClass(cssClass.playing);
                        });

                        theBar.on(eStart, function(e) {
                                adjustCurrentTime(e);
                                theBar.on(eMove, function(e) {
                                    adjustCurrentTime(e);
                                });
                            })
                            .on(eCancel, function() {
                                theBar.unbind(eMove);
                            });

                        volumeButton.on("click", function() {
                            if (thePlayer.hasClass(cssClass.mute)) {
                                thePlayer.removeClass(cssClass.mute);
                                theAudio.volume = volumeDefault;
                            } else {
                                thePlayer.addClass(cssClass.mute);
                                volumeDefault = theAudio.volume;
                                theAudio.volume = 0;
                            }
                            return false;
                        });

                        volumeAdjuster.on(eStart, function(e) {
                                adjustVolume(e);
                                volumeAdjuster.on(eMove, function(e) {
                                    adjustVolume(e);
                                });
                            })
                            .on(eCancel, function() {
                                volumeAdjuster.unbind(eMove);
                            });
                    } else thePlayer.addClass(cssClass.mini);

                    if (isAutoPlay) thePlayer.addClass(cssClass.playing);

                    thePlayer.find("." + cssClass.playPause).on("click", function() {
                        if (thePlayer.hasClass(cssClass.playing)) {
                            $(this).attr("title", params.strPlay).find("a").html(params.strPlay);
                            thePlayer.removeClass(cssClass.playing);
                            isSupport ? theAudio.pause() : theAudio.Stop();
                        } else {
                            $(this).attr("title", params.strPause).find("a").html(params.strPause);
                            thePlayer.addClass(cssClass.playing);
                            isSupport ? theAudio.play() : theAudio.play();
                        }
                        return false;
                    });

                    $this.replaceWith(thePlayer);
                });
                return this;
            };
        }
    };

    return chat;
});
