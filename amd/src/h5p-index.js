define(["jquery", "core/modal_factory"], function($, ModalFactory) {
    return {

        readmore: function() {

            function createReadMore($lement) {
                const fullText = $lement.text();
                console.trace(fullText);
                $lement.attr("data-fulltext", fullText);
                const maxLength = $lement.attr("data-size");

                // Se o texto for maior que o limite, aplica a funcionalidade "Read More"
                if (fullText.length > maxLength) {
                    var partes = fullText.split(" ");
                    var truncatedText = "";
                    for (var i = 0; i < partes.length; i++) {
                        if (`${truncatedText} ${partes[i]}`.length > maxLength) {
                            break;
                        }
                        truncatedText = `${truncatedText} ${partes[i]}`;
                    }

                    var readmore = `<span class="btn btn-link readmore-link">${M.util.get_string("h5p-readmore", "local_geniai")}</span>`;
                    $lement.html(truncatedText + readmore);
                    $lement.find(".readmore-link").click(function() {
                        console.log($lement.attr("data-fulltext"));
                        $lement.html($lement.attr("data-fulltext"));
                    });
                }
            }

            $(".text-readmore").each(function() {
                createReadMore($(this));
            });

            $("#h5p-create-new-link").click(function() {
                ModalFactory.create({
                    type: ModalFactory.types.DEFAULT,
                    title: M.util.get_string("h5p-page-title", "local_geniai"),
                    body: $("#h5p-body-create"),
                    footer: "",
                }).done(function(modal) {
                    modal.show();
                })
            });
        }
    }
});
