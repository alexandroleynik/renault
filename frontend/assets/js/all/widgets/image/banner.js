app.view.wfn['banner'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/banner.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;

        app.view.href = data.href;
        app.view.categorie = data.categorie;
        app.view.subcategorie = data.subcategorie;
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
        $('.imgfs > img').click(function(){
            bannerClick();
        });
        app.view.afterWidget(widget);
    }

    function bannerClick(){
        window.open(app.view.href);
        _gaq.push([
        'trackEvent',
            app.view.categorie,
            app.view.subcategorie
    ]);
        return false;
    }
});


