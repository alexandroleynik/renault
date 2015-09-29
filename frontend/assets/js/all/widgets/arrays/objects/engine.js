app.view.wfn['engine'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/engine.html';
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    app.view.beforeWidget(widget);           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
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
        app.container.append(html);

        app.view.afterWidget(widget);
    }
});

