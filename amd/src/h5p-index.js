define(["jquery", "core/modal_factory"], function($, ModalFactory) {
    var index = {
        readmore: function() {
            $(".text-readmore").each(function() {
                index.createReadMore($(this));
            });

            $("#h5p-create-new").click(function() {
                ModalFactory.create({
                    type: ModalFactory.types.DEFAULT,
                    title: M.util.get_string('h5p-page-title', "local_geniai"),
                    body: $("#h5p-body-create"),
                    footer: "",
                }).done(function(modal) {
                    modal.show();
                })
            });
        },

        createReadMore: function($lement) {
            var fullText = $lement.text();
            var maxLength = $lement.attr("data-size");

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

                $lement.text(truncatedText);
                var readmore = $(`<a href="javascript:void(0);" class="readmore-link">${M.util.get_string('h5p-readmore', "local_geniai")}</a>`);
                $lement.append(readmore)
                    .append("<br>")
                    .click(function() {
                        $lement.text(fullText);
                    });
            }
        }
    };

    return index;
});
