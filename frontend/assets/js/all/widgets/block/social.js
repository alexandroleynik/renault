app.view.wfn['social'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/social.html';           

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
        app.logger.var(data);
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


    function getFbItems(data) {
        var FbPageName = data.FbPageName;
        var query = 'https://graph.facebook.com/'+ FbPageName + '?locale=ru_RU&fields=posts.limit(18){full_picture,message,link,created_time}&access_token=677676795700961|6f7c3417d116450a1ff568ca9e64eed3';
        FB.api(query, function (response) {
            if (response && !response.error) {


                obj = response.posts.data;
                fbItems = {};


                for (var i = 0 in obj) {
                    fbItems[i] = {
                        "current_date": fbFormat(obj[i].created_time, app.router.locale),
                        "full_picture": obj[i].full_picture,
                        "link_": obj[i].link,
                        "message": fbMessageFormat(obj[i].message, app.router.locale, data.wordSlice)
                    };
                }
                var arr = Object.keys(fbItems).map(function (key) {
                    return fbItems[key]
                });
                data.fbGroup = items_array_chunk(arr, 2);

                getInstItems(data);


            } else {
                return 'error';
            }
        });
    }

    function getInstItems(data) {

        var url = 'https://api.instagram.com/v1/users/'+ data.instUserId +'/media/recent/?client_id=fa8f6abac0704d4d840759aa909201d8&count=18';
        pollInstagram(url, data);
        function pollInstagram(url, data_app) {
            $.ajax({
                method: "GET",
                url: url,
                dataType: "jsonp",
                jsonp: "callback",
                data_app: data_app,
                success: function (data) {
                    var instItem = data.data;
                    app.logger.var(data.data);
                    var newinstItem = [];

                    for (var i = 0; i < instItem.length; i++) {

                        newinstItem[i] = [];
                        newinstItem[i]['title'] = "Instagram Title";
                        newinstItem[i]['tbnl'] = data.data[i].images.standard_resolution.url;

                        newinstItem[i]['message'] = instMessageFormat(data.data[i].caption.text, app.router.locale, data_app.wordSlice);
                        newinstItem[i]['url'] = data.data[i].link;
                        newinstItem[i]['tags'] = data.data[i].tags;

                    }
                    app.logger.var('data.data');
                    app.logger.var(data.data);
                    app.logger.var('data.data');
                    data_app.instItemGroup = items_array_chunk(newinstItem, 2);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Check you internet Connection");

                }
            });

        }

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
                var q = data.YtChannelName;
                makeRequest(q, data);
            });

        }

        function makeRequest(q, data) {
            data.test = 'test';
            var request = gapi.client.youtube.search.list({
                q: q,
                contentOwner: 'RenaultUkraine',
                part: 'snippet',

                sort: 'day',

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
                app.logger.var(YtData)
                data.YtGroup = items_array_chunk(YtData, 2);
                data.urlToFrontend = server_config.frontend_app_web_url;
                
                loadTemplate(data);
            })
        }
    }

    function fbFormat(input, locale) {
        var now = moment(input).locale(locale);

        return now.fromNow();
    }

    function instMessageFormat(message, locale, messageLength) {
        if (message !== undefined || message !== '' || message !== ' ' || is_string(message)) {
            if (message.match(/#/) != null) {
                message = message.split("#")[0];
            }
            if (message.match(/\/\//) != null) {
                if (locale == 'uk' || locale === undefined) {

                    message = message.split("//")[0];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                }
                if (locale == 'ru') {
                    message = message.split('//')[1];
                    message = message.split(" ").map(String);
                    message = message.slice(0, messageLength);
                    message = message.join(' ');
                }
            }
            //app.logger.var('------ ' + message + ' ----- ' + locale + ' ----- ' + messageLength + ' ------ ;<br/>' + is_string(message) + '---------------****');
        }
        return message;
    }

    function fbMessageFormat(message, locale, messageLength) {
        if (message !== undefined && message !== '') {
            if (message.match(/\/\//) == null) {
                return message;
            } else {

                if (message.match(/\:\/\//) !== null) {
                    if (locale == 'uk' || locale === undefined) {

                        message = message.split("//")[0] + message.split("//")[1];
                        message = message.split(" ").map(String);
                        message = message.slice(0, messageLength);
                        message = message.join(' ');
                        message = message.replace(new RegExp("http:", 'g'), 'http://');
                    }
                    if (locale == 'ru') {
                        message = message.split('//')[2] + message.split("//")[3];
                        message = message.split(" ").map(String);
                        message = message.slice(0, messageLength);
                        message = message.join(' ');
                        message = message.replace(new RegExp("http:", 'g'), 'http://');
                    }
                } else {
                    if (locale == 'uk' || locale === undefined) {

                        message = message.split("//")[0];
                        message = message.split(" ").map(String);
                        message = message.slice(0, messageLength);
                        message = message.join(' ');
                    }
                    if (locale == 'ru') {
                        message = message.split('//')[1];
                        message = message.split(" ").map(String);
                        message = message.slice(0, messageLength);
                        message = message.join(' ');
                    }
                }
            }


        }
        else
        {
            message = ' ';
        }

        if (message !== ' ') message = message + ' ...';
        return message;
    }


});

