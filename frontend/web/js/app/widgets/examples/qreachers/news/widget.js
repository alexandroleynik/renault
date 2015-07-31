(function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    app.view.beforeWidget(widget);

    run();

    function run() {
        app.logger.func('run');

        //set default values
        sessionStorage.setItem('page.view.news.news.filter.page', 1);

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        data = widget;

        //load categories
        $.getJSON(
                app.config.frontend_app_api_url + '/db/article-categories',
                function (catData) {
                    data.categories = catData.items;
                    loadTemplate(data);
                });
    }

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if (true == app.config.frontend_app_debug) {
            params = '?_' + Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/handlebars.html' + params, function (template) {
            renderWidget(template(data), data);
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');

        app.container.append(html);

        setTimeout(function () {
            changeFilterButtonsState();
            
            //bindCategoryClickEvent(app.config.frontend_app_conainer);
            bindShowMoreScrollEvent();
        }, 500);

        loadArticles(data);

        app.view.afterWidget(widget);
    }

    function changeFilterButtonsState() {

        var cid = sessionStorage.getItem('articles.index.filter.category_id');

        if (cid) {
            app.logger.text('changeFilterButtonsState, cid: ' + cid);
            $('.filter-btn').trigger('click');
            var arr = cid.split(',');
            $('.filter-box').find('.article-category-item').each(function (k, v) {
                if (-1 != arr.indexOf($(v).attr('categoryid'))) {
                    $(v).addClass('active');
                }
            });
        }
    }

    function loadArticles() {
        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,category_id,slug,thumbnail_base_url,thumbnail_path,title',
            "per-page": data.count,
            "expand": 'categories',
            "sort": sort,
            "where_operator_format": [
                "like",
                "domain",
                location.protocol + '//' + location.hostname,
            ]
        };

        var cid = sessionStorage.getItem('articles.index.filter.category_id');

        if (cid) {
            params.category_id = cid;
        }

        var page = sessionStorage.getItem('page.view.news.news.filter.page');

        if (page) {
            params.page = page;
            params.where = {
                locale: app.config.frontend_app_locale
            };
        }

        $.getJSON(
                app.config.frontend_app_api_url + '/db/articles',
                params,
                function (artData) {

                    $.each(artData.items, function (key, val) {
                        artData.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                        artData.items[key].viewUrl = app.view.helper.preffix + '/article/' + val.slug;
                        artData.items[key].dataFilterCategories = getDataFilterCategories(val.categories);
                        artData.items[key].categoryTitles = getCategoryTitles(val.categories);
                    });

                    data.items = artData.items;

                    loadTemplateItems(data);
                });
    }

    function unsetStringElement(old, id) {
        var arr = old.split(',');
        var index = arr.indexOf(id);
        if (-1 != index) {
            arr.splice(index, 1);
        }

        return arr.join(',');
    }

    function loadTemplateItems(data) {
        app.logger.func('loadTemplate(data)');
        var params = '';
        if (true == app.config.frontend_app_debug) {
            params = '?_' + Date.now();
        }
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/widgets/' + widget.widgetName + '/templates/_items.handlebars.html' + params, function (template) {
            renderWidgetItems(template(data));
        });
    }

    function renderWidgetItems(html) {
        app.logger.func('renderWidget(html)');

        $(".news-container .news-wrap").remove();
        
        $(".news-container").prepend(html);
        
        setTimeout(function () {
            $(window).trigger('page.view.article.article.renderWidgetItems');            
        }, 2000);

    }

    function bindShowMoreScrollEvent() {
        $(".projects .show-more").click(function () {
            var page = sessionStorage.getItem('page.view.news.news.filter.page');

            if (page) {
                sessionStorage.setItem('page.view.news.news.filter.page', page + 1);
            }

            loadArticles();
        });
    }

    function getDataFilterCategories(categories) {
        var result = '';
        $.each(categories, function (k, v) {
            result = result + ' data-filter-' + v.category_id;
        });

        return result;
    }
    
    function getCategoryTitles(categories) {
        var result = [];

        $.each(categories, function (k, v) {
            if (v.category_id) {
                result.push(v.category_id);
            }
        });

        //TODO: get category title from data.categories

        return result.join(',');
    }



})();

