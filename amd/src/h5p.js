define(['jquery', 'core/ajax', 'core/notification'], function($, ajax, notification) {
    var h5p = {
        init : function(contextid) {
            var botao = `
                <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}" 
                   class="icon-no-margin btn btn-secondary text-nowrap mr-1">
                    <i class="icon fa fa-add fa-fw"></i>
                    ${M.util.get_string("h5p-manager", "local_geniai")}
                </a>`;
            $("#page-contentbank .cb-toolbar-container").prepend(botao);
        }
    };
    return h5p;
});
