app.view.wfn['promos'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/promos.html'; 

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
            "per-page": data.count,
            "sort": sort,
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/promos',
                params,
                function (promosData) {
                    //process domain promos
                    if (promosData.items[0]) {
                        $.extend(data, promosData);

                        $.each(data.items, function (key, val) {
                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            data.items[key].viewUrl = app.view.helper.preffix + '/promo/' + val.slug;
                        });

                        data.urlToNews = app.view.helper.preffix + '/promos';
                        
                        loadTemplate(data);
                    }

                    //get default promos
                    if (!promosData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;
                        
                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/promos',
                                params,
                                function (promosData) {                                    
                                    $.extend(data, promosData);

                                    $.each(data.items, function (key, val) {
                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        data.items[key].viewUrl = app.view.helper.preffix + '/promo/' + val.slug;
                                    });

                                    data.urlToNews = app.view.helper.preffix + '/promos';
                                    loadTemplate(data);
                                });
                    }


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

