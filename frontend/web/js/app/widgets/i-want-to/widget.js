(function () {
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
        data.urlToBookATestDrive = app.config.frontend_app_web_url + app.router.locale + '/page/view/book-a-test-drive'
        data.urlToLoadBooking = 'http://servicebooking.renault.co.uk';
        data.urlToBrochures = app.config.frontend_app_web_url + app.router.locale + '/page/view/brochures';
        data.urlToFindADealer = app.config.frontend_app_web_url + app.router.locale + '/page/view/contact-form';
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if ( true == app.config.frontend_app_debug) {
            params = '?_'+ Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/handlebars.html' + params, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);

        app.view.afterWidget(widget);
    }
})();

