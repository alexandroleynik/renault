app.view.wfn['characteristics'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/characteristics.html';
    
    app.view.beforeWidget(widget);           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function updatePrices(data, prices) {
        for(var key in data.items) {

            if(data.items[key].version_code && prices[data.items[key].version_code]) {
                data.items[key].cost = prices[data.items[key].version_code];
            } else if(!data.items[key].cost) {
                delete data.items[key];
                continue;
            }

            for(var key2 in data.items[key].engine) {
                if(data.items[key].engine[key2].version_code && prices[data.items[key].engine[key2].version_code]) {
                    data.items[key].engine[key2].cost = prices[data.items[key].engine[key2].version_code];
                } else if(!data.items[key].cost) {
                    delete data.items[key].engine[key2];
                }
            }
        }
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        data.t = app.view.getTranslationsFromData(data);

        _getPrices(function (_priceData) {
            updatePrices(data, _priceData);
            loadTemplate(data);
        });
        
        //var params = {
        //    "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
        //    "per-page": data.count,
        //    "sort": sort,
        //    "where": {
        //        locale: app.config.frontend_app_locale,
        //        "domain_id": app.config.frontend_app_domain_id,
        //    }
        //
        //};
        //
        //$.getJSON(
        //    app.config.frontend_app_api_url + '/db/articles',
        //    params,
        //    function (articlesData) {
        //        //process domain articles
        //        if (articlesData.items[0]) {
        //            $.extend(data, articlesData);
        //
        //            $.each(data.items, function (key, val) {
        //
        //                data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
        //                data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
        //            });
        //
        //            data.urlToNews = app.view.helper.preffix + '/news';
        //
        //            loadTemplate(data);
        //        }
        //
        //        //get default articles
        //        if (!articlesData.items[0]) {
        //            params.where.domain_id = app.config.frontend_app_default_domain_id;
        //
        //            $.getJSON(
        //                app.config.frontend_app_api_url + '/db/articles',
        //                params,
        //                function (articlesData) {
        //                    $.extend(data, articlesData);
        //
        //                    $.each(data.items, function (key, val) {
        //
        //                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
        //                        data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
        //                    });
        //
        //                    data.urlToNews = app.view.helper.preffix + '/news';
        //
        //                    loadTemplate(data);
        //                });
        //        }
        //    });
        //loadTemplate(data);
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

