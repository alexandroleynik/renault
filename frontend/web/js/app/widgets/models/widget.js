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
        data.t = app.view.getTranslationsFromData(data);

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,price,thumbnail_base_url,thumbnail_path',
            "per-page": data.count,
            "sort": sort,
            "expand": "firstInfo",
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/models',
                params,
                function (modelsData) {
                    //process domain models
                    if (modelsData.items[0]) {
                        $.extend(data, modelsData);

                        $.each(data.items, function (key, val) {
                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            if (val.firstInfo) {
                                data.items[key].viewUrl = app.view.helper.preffix + '/info/' + val.firstInfo.slug;
                            }
                        });

                        data.viewAllUrl = '#';

                        loadTemplate(data);
                    }

                    //process default models
                    if (!modelsData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/models',
                                params,
                                function (modelsData) {                                    
                                    $.extend(data, modelsData);

                                    $.each(data.items, function (key, val) {
                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        if (val.firstInfo) {
                                            data.items[key].viewUrl = app.view.helper.preffix + '/info/' + val.firstInfo.slug;
                                        }
                                    });

                                    data.viewAllUrl = '#';

                                    loadTemplate(data);
                                });
                    }


                });
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if (true == app.config.frontend_app_debug) {
            params = '?_' + Date.now();
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

