window.app.router = (function () {

    public = {
        locale: null,
        controller: null,
        action: null,
        slug: null,
        run: function (url) {
            app.logger.prefix = '[app][router]';
            app.logger.func('router run ' + url);

            //var arr = url.replace(/^\//, '').split('/');
            var arr = url.replace(/.+\/\/.+?\//, '').replace(/^\//,'').split('/');
            //app.logger.var(arr);

            switch (arr.length) {
                case 1:
                    if (!arr[0]) {
                        // empty url, default uk
                        arr[0] = 'uk';
                        arr[1] = 'page';
                        arr[2] = 'view';
                        arr[3] = 'home';
                    } else {
                        // /ru                  
                        arr[0] = arr[0];
                        arr[1] = 'page';
                        arr[2] = 'view';
                        arr[3] = 'home';
                    }
                    break;
                case 2:
                    //set default values
                    //ru/news
                    arr[3] = arr[1];
                    arr[1] = 'page';
                    arr[2] = 'view';
                    break;
                case 3:
                    //set default values
                    //ru/promo/helolo-moto
                    arr[3] = arr[2];
                    arr[2] = 'view'
                    break;
            }

            this.locale = arr[0];
            this.controller = arr[1];
            this.action = arr[2];
            this.slug = arr[3];

            app.logger.text('this.locale: ' + this.locale);
            app.logger.text('this.controller: ' + this.controller);
            app.logger.text('this.action: ' + this.action);
            app.logger.text('this.slug: ' + this.slug);

            switch (this.controller) {
                case 'page':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/page');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'article':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/article');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'promo':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/promo');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'project':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/project');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'info':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/info');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'service-page':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/service-page');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'about-page':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/about-page');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                case 'finance-page':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/finance-page');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
            }

        }
    };

    function getPageDataFromUrl(controller) {
        app.logger.var($.urlParams("all"));

        var data = {};
        $.each($.urlParams("keys"), function (k, v) {
            var key = unescape(v).toLowerCase();
            if (-1 != key.indexOf(controller)) {
                key = key.split('[')[1].replace(/]/, '');
                data[key] = $.urlParams("all")[v];
            }

        })

        app.logger.var(data);

        return data;
    }

    function loadViewActionData($url) {
        $.getJSON(
                app.config.frontend_app_api_url + $url,
                {
                    where: {
                        slug: app.router.slug,
                        locale: app.config.frontend_app_locale,
                        domain_id: app.config.frontend_app_domain_id
                    },
                    fields: 'id,slug,head,body,title,before_body,after_body,on_scenario'
                },
        function (data) {
            if (!data.items[0] || 'extend' == data.items[0].on_scenario) {

                var extendData = {};
                if (data.items[0]) {
                    if (data.items[0]['before_body']) {
                        extendData['domain_before_body'] = data.items[0]['before_body'];
                    }
                    if (data.items[0]['after_body']) {
                        extendData['domain_after_body'] = data.items[0]['after_body'];
                    }
                    if (data.items[0].on_scenario) {
                        extendData['domain_on_scenario'] = data.items[0].on_scenario;
                    }
                }

                $.getJSON(
                        app.config.frontend_app_api_url + $url,
                        {
                            where: {
                                slug: app.router.slug,
                                locale: app.config.frontend_app_locale,
                                domain_id: app.config.frontend_app_default_domain_id
                            },
                            fields: 'id,slug,head,body,title,before_body,after_body,on_scenario'
                        },
                function (data) {
                    $.extend(data.items[0], extendData);
                    app.view.renderPage(data.items[0]);
                });
            }
            else {
                app.view.renderPage(data.items[0]);
            }
        });
    }

    function loadPreviewActionData() {
        var data = getPageDataFromUrl(this.controller);

        app.view.renderPage(data);
    }

    return public;
})()