app.view.wfn['vehicle-promotions'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/vehicle-promotions.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.viewAllUrl = app.view.helper.preffix + '/models';

        loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        
        var v = app.config.frontend_app_files_midified[template];
//test


        var params = {
            "fields": 'title,price',
            "per-page": data.count,

            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
            app.config.frontend_app_api_url + '/db/model',
            params,
            function (articlesData) {
                //process domain articles
                console.log('articlesData');
                console.log(articlesData);
                console.log('articlesData');
                if (articlesData.items[0]) {
                    //$.extend(data, articlesData);
                    //
                    //$.each(data.items, function (key, val) {
                    //
                    //    data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                    //    data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                    //});
                    //
                    //data.urlToNews = app.view.helper.preffix + '/news';
                    //
                    //loadTemplate(data);
                }

                //get default articles
                if (!articlesData.items[0]) {
                    //params.where.domain_id = app.config.frontend_app_default_domain_id;
                    //
                    //$.getJSON(
                    //    app.config.frontend_app_api_url + '/db/articles',
                    //    params,
                    //    function (articlesData) {
                    //        $.extend(data, articlesData);
                    //
                    //        $.each(data.items, function (key, val) {
                    //
                    //            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                    //            data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                    //        });
                    //
                    //        data.urlToNews = app.view.helper.preffix + '/news';
                    //
                    //        loadTemplate(data);
                    //    });
                }
            });
        //test
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

