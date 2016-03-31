app.view.wfn['breadcrumbs'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/breadcrumbs.html';

    run();

    function run() {
        app.logger.func('run');

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        data.home = app.config.frontend_app_frontend_url;
        data.home_title = app.router.locale=='ru'?'Главная':'Головна';
        switch (app.router.locale){
            case 'ru':
                data.home_title = 'Главная';
                break;
            default:
                data.home_title = 'Головна';
                break;
        }
        

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
