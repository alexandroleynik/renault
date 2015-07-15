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

        getFbItems(widget);
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


    function getFbData() {


    }


    function getFbItems(data) {
        FB.api('https://graph.facebook.com/renault.ua?locale=ru_RU&fields=posts.limit(6){picture,message,link,created_time}&access_token=677676795700961|6f7c3417d116450a1ff568ca9e64eed3', function (response) {
            if (response && !response.error) {
                var posts = (response.posts.data);

                data.fbItems = (posts);
                data.fbGroup = items_array_chunk(data.fbItems, 2);
                console.log(data.fbItems);
                //data.vkItems = getVkItems();
                //data.ytItems = getYtItems();
                console.log(data);
                loadTemplate(data);

            } else {
                return 'error';
            }


        });

        //return [
        //    {
        //        'imgsrc': '/img/img-main_social_img1.jpg',
        //        'alt': '#',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '3 дня назад',
        //        'content': 'Назовите самую крупную вещь, которую вам приходилось перевозить в автомобиле. Как думаете, вам бы тогда пригодился Renault Master?'
        //    },
        //    {
        //        'imgsrc': '',
        //        'alt': '',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '10 июня 2015',
        //        'content': 'На честь 60-річчя своєї нестримної' +
        //        'пристрасті до спорту, Alpine' +
        //        'представляє новий шоу-кар під назвою' +
        //        'Alpine Celebration, створений' +
        //        'спеціально для перегонів «24 години' +
        //        'Ле-Мана». Як вам?'
        //    },
        //    {
        //        'imgsrc': '',
        //        'alt': '',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '3 дня назад',
        //        'content': 'Назовите самую крупную вещь, которую вам приходилось перевозить в автомобиле. Как думаете, вам бы тогда пригодился Renault Master?'
        //    },
        //    {
        //        'imgsrc': '/img/img-main_social_img2.jpg',
        //        'alt': '#',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '3 дня назад',
        //        'content': 'Назовите самую крупную вещь, которую вам приходилось перевозить в автомобиле. Как думаете, вам бы тогда пригодился Renault Master?'
        //    },
        //    {
        //        'imgsrc': '/img/img-main_social_img3.jpg',
        //        'alt': '#',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '3 дня назад',
        //        'content': 'Назовите самую крупную вещь, которую вам приходилось перевозить в автомобиле. Как думаете, вам бы тогда пригодился Renault Master?'
        //    },
        //    {
        //        'imgsrc': '',
        //        'alt': '',
        //        'title': 'RENAULT УкраЇНА',
        //        'date': '3 дня назад',
        //        'content': 'Назовите самую крупную вещь, которую вам приходилось перевозить в автомобиле. Как думаете, вам бы тогда пригодился Renault Master?'
        //    }
        //];
    }


    function items_array_chunk(input, size) {

        for (var x, i = 0, c = -1, l = input.length, n = []; i < l; i++) {
            if (x = i % size) {
                n[c][x] = input[i]
            } else {
                n[++c] = [input[i]];
            }
        }
        var groups = [];
        $.each(n, function (k, v) {
            groups[k] = {'items': v};
        });
        return groups;
    }

})();

