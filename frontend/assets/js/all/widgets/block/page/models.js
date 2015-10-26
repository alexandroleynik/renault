app.view.wfn['models'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/models.html';

    run();

    function run() {
        app.logger.func('run');

        loadCategories();
    }

    function loadCategories() {

        var params = {
            "fields": 'id,slug,title',
            "where": {
                "domain_id": app.config.frontend_app_default_domain_id,
            }

        };
        //process default models

        $.getJSON(
                app.config.frontend_app_api_url + '/db/model-category',
                params,
                function (catData) {
                    loadData(catData);
                });


    }

    function loadData(catData) {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        data.catData = catData;

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

        if (data.catData && data.catData.items && data.catData.items[0]) {
            if ($.urlParams("all")['cslug']) {
                //filter for category
                $.each(data.catData.items, function (k, v) {
                    if ($.urlParams("all")['cslug'] == v.slug) {
                        params['category_id'] = v.id;
                        //change title                    
                        data.t.title = app.config.frontend_app_t[v.title];
                    }
                });

            }
        }

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
        app.logger.var(data);

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

