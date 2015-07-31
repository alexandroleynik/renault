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
        FB.api('https://graph.facebook.com/renault.ua?locale=ru_RU&fields=posts.limit(18){full_picture,message,link,created_time}&access_token=677676795700961|6f7c3417d116450a1ff568ca9e64eed3', function (response) {
            if (response && !response.error) {


                obj = response.posts.data;
                fbItems = {};


                for(var i=0 in obj) {
                    fbItems[i] = {
                        "current_date": fbFormat(obj[i].created_time, app.router.locale),
                        "full_picture": obj[i].full_picture,
                        "link_": obj[i].link,
                        "message": fbMessageFormat(obj[i].message, app.router.locale, data.wordSlice)
                    };
                }
                var arr = Object.keys(fbItems).map(function (key) {return fbItems[key]});
                data.fbGroup = items_array_chunk(arr, 2);

                getYtItems(data);



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
                maxResults: 18
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
                console.log(YtData)
                data.YtGroup = items_array_chunk(YtData, 2);
                loadTemplate(data);
            })
        }
    }

    function fbFormat(input, locale) {
        var now = moment(input).locale(locale);

        return now.fromNow();
    }

    function fbMessageFormat(message, locale, messageLength){
        if(message !== undefined && message !== ''){
            if(message.match(/\:\/\//) !== null){
                if (locale == 'uk' || locale === undefined){

                    message = message.split("//")[0] + message.split("//")[1];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                    message = message.replace(new RegExp("http:",'g'),'http://');
                }
                if (locale == 'ru'){
                    message = message.split('//')[2] + message.split("//")[3];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                    message = message.replace(new RegExp("http:",'g'),'http://');
                }
            } else {
                if (locale == 'uk' || locale === undefined){

                    message = message.split("//")[0];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                }
                if (locale == 'ru'){
                    message = message.split('//')[1];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                }
            }

        } else {
            message = ' ';
        }
        if(message!== ' ') message = message + ' ...';
        return message ;
    }






})();

