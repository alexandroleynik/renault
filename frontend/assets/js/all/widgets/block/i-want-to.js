app.view.wfn['i-want-to'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    //var template = '/templates/block/i-want-to.html';
    var template = '/templates/block/i-want-to-new.html';


    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;  
        data.urlSite = app.view.helper.preffix;
        data.urlToLoadBooking = '';
        console.log(data);
        // $.each(data.buttons, function (key, val) {
        //     if ('@frontend' == val.host) {
        //         data.buttons[key].viewUrl = app.view.helper.preffix + val.url;
        //     } else {
        //         data.buttons[key].viewUrl = val.url;
        //     }
        // });
       // data.urlToBrochures = app.view.helper.preffix;
       //data.urlToFindADealer = app.view.helper.preffix + '/contact-form';
        
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

