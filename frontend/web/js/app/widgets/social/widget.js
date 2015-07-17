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


    function getFbItems(data) {
        FB.api('https://graph.facebook.com/renault.ua?locale=ru_RU&fields=posts.limit(6){full_picture,message,link,created_time}&access_token=677676795700961|6f7c3417d116450a1ff568ca9e64eed3', function (response) {
            if (response && !response.error) {
                console.log(response.posts.data);
                data.fbGroup = items_array_chunk(response.posts.data, 2);
                getVkItems(data);
            } else {
                return 'error';
            }
        });
    }

    function getVkItems(data) {
        VK.init({
            apiId: 4996359
        });
        VK.api('wall.get', {'domain': 'renaultukraine', 'count': '6'}, function (vk) {
            data.VkGroup = vk.response['1']['text'];
        });

        getYtItems(data);

    }

    function getYtItems(data) {

        //https://www.googleapis.com/youtube/v3/search?part=snippet&q=renault&channelId=UCKDogp5MchjxMrJRr4EBWbA&key=AIzaSyDLVky-2ZguUovZVgLfMH8g7QSSkEaNe6E
//      var gapiKey = 'AIzaSyDLVky-2ZguUovZVgLfMH8g7QSSkEaNe6E';

//
        keyWordsearch(data);
        function keyWordsearch(data) {
            gapi.client.setApiKey('AIzaSyCWzGO9Vo1eYOW4R4ooPdoFLmNk6zkc0Jw');
            gapi.client.load('youtube', 'v3', function () {
                var q = 'renaultua';
                makeRequest(q, data);
            });

        }

        function makeRequest(q, data) {
            data.test = 'test';
            var request = gapi.client.youtube.search.list({
                q: q,
                part: 'snippet',
                maxResults: 6
            });
            request.execute(function (response) {
                $('#results').empty();
                var srchItems = response.result.items;
                var YtTitle = [];
                var YtThumbnails = [];
                var i = 0;
                $.each(srchItems, function (index, item) {
                    i++;
                    YtTitle.push(item.snippet.title);
                    YtThumbnails.push(item.snippet.thumbnails.high.url);
                    vidTitle = item.snippet.title;
                    vidThumburl = item.snippet.thumbnails.high.url;
                });

                var YtData = [];
                for (var i = 0; i < srchItems.length; i++) {
                    YtData[i] = [];
                    YtData[i]['title'] = srchItems[i].snippet.title;
                    YtData[i]['tbnl'] = srchItems[i].snippet.thumbnails.high.url;
                    YtData[i]['videoId'] = srchItems[i].id.videoId;

                }


                data.YtGroup = items_array_chunk(YtData, 2);

                loadTemplate(data);
            })
        }
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

