app.view.wfn['intro'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/intro.html';            

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function updatePrices(data, prices) {
        for(var key in data.items) {

            if(data.items[key].version_code && prices[data.items[key].version_code]) {
                data.items[key].price = prices[data.items[key].version_code];
            } else if(!data.items[key].price) {
                //TODO: Fix me
                //delete data.items[key];
            }

        }
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;

        _getPrices(function (_priceData) {
            updatePrices(data, _priceData);
            loadTemplate(data);
        });
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

