app.view.wfn['corporate-sales'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/corporate-sales.html';

    run();

    function run() {
        app.logger.func('run');
        console.log('test');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        setDefaultValues();
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

    function setDefaultValues(){
        window.corporateSaleData = {
            'firstname':'',
            'secondname':'',
            'lastname':'',
            'email':'',
            'phone':'',
            'message':''


        };
    }

});

