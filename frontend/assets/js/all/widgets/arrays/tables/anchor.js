app.view.wfn['anchor'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/anchor.html';

    run();

    function run() {
        app.logger.func('run');

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        $.each(data.items, function (key, val) {
            if ('@frontend' == val.host) {
                data.items[key].viewUrl = app.view.helper.preffix + val.url;
            }
                        
            if ('/' + app.router.controller + '/' + app.router.slug == val.url.trim()) {            
                data.items[key].itemLiClass = 'active';
                data.items[key].itemLiClassMobile = 'active';
            }

        });

        data.items = data.items.filter(function (v) {
            return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
        });

        loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);

        app.view.afterWidget(widget);
    }
});
