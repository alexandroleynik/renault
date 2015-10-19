app.view.wfn['header'] = (function () {
    var wtemplate = '/templates/block/part/header.html';

    if (app.view.headerLoaded) {
        return;
    }

    app.logger.func('addHeader');

    var params = {
        "fields": 'id,slug,title,body,before_body,after_body,on_scenario',
        "where": {
            "slug": "header",
            "locale": app.config.frontend_app_locale,
            "domain_id": app.config.frontend_app_domain_id
        }
    };

    $.getJSON(
            app.config.frontend_app_api_url + '/db/blocks',
            params,
            function (blockData) {
                //process domain header
                if (blockData.items[0] && 'extend' != blockData.items[0].on_scenario) {
                    var body = blockData.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
                    var data = JSON.parse(body);

                    data.t = app.view.getTranslationsFromData(data);
                    data.links = app.view.getLinksFromData(data);

                    data.isRu = ('ru-RU' == app.config.frontend_app_locale) ? true : false;
                    data.isEn = ('en-US' == app.config.frontend_app_locale) ? true : false;
                    data.isUk = ('uk-UA' == app.config.frontend_app_locale) ? true : false;

                    data.urlToHome = app.view.helper.preffix + '/home';
                    data.urlToLocale = app.view.helper.preffix

                    $.each(data.menu, function (key, val) {

                        if ('@frontend' == val.host) {
                            data.menu[key].host = app.view.helper.preffix;

                        }
                        $.each(val.submenu, function(subkey, subval){
                                if('@frontend' == subval.host)     {
                                           data.menu[key].submenu[subkey].host = app.view.helper.preffix;
                                }
                        } );
                        window.testkey = key;
                        window.testval = val;

                        //$.each(this.submenu, function(sub_key, sub_val){
                        //    //app.logger.var(sub_key);
                        //    if ('@frontend' == sub_val.host) {
                        //        data.menu[key].submenu[sub_key].host = app.view.helper.preffix;
                        //    }
                        //})

                    });

                    data.menu = data.menu.filter(function (v) {
                        return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
                    });

                    var v = app.config.frontend_app_files_midified[wtemplate];

                    app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + wtemplate + '?v=' + v, function (template) {
                        app.logger.var(data);

                        $(template(data)).insertBefore($('#container'));
                        app.view.headerLoaded = true;
                        setTimeout(function () {
                            app.view.changeLangSwitchUrls();
                        }, 2000);
                    });
                }

                //process default domain header
                if (!blockData.items[0] || 'extend' == blockData.items[0].on_scenario) {
                    params.where.domain_id = app.config.frontend_app_default_domain_id;

                    var extendData = {};
                    if (blockData.items[0]) {
                        if (blockData.items[0]['before_body']) {
                            extendData['domain_before_body'] = blockData.items[0]['before_body'];
                        }
                        if (blockData.items[0]['after_body']) {
                            extendData['domain_after_body'] = blockData.items[0]['after_body'];
                        }
                        if (blockData.items[0].on_scenario) {
                            extendData['domain_on_scenario'] = blockData.items[0].on_scenario;
                        }
                    }

                    $.getJSON(
                            app.config.frontend_app_api_url + '/db/blocks',
                            params,
                            function (data) {
                                var body = data.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
                                var data = JSON.parse(body);
                                $.extend(data, extendData);

                                if (data.domain_before_body && data.domain_before_body[0]) {
                                    data.domain_before_body = JSON.parse(data.domain_before_body)[0]['text'];
                                }

                                if (data.domain_after_body && data.domain_after_body[0]) {
                                    data.domain_after_body = JSON.parse(data.domain_after_body)[0]['text'];
                                }

                                data.t = app.view.getTranslationsFromData(data);
                                data.links = app.view.getLinksFromData(data);

                                data.isRu = ('ru-RU' == app.config.frontend_app_locale) ? true : false;
                                data.isEn = ('en-US' == app.config.frontend_app_locale) ? true : false;
                                data.isUk = ('uk-UA' == app.config.frontend_app_locale) ? true : false;

                                data.urlToHome = app.view.helper.preffix + '/home';
                                data.urlToLocale = app.view.helper.preffix

                                $.each(data.menu, function (key, val) {

                                    if ('@frontend' == val.host) {
                                        data.menu[key].host = app.view.helper.preffix;
                                    }
                                    //$.each(this.submenu, function(subkey, subval){
                                    //
                                    //    if ('@frontend' == subval.host) {
                                    //        data.menu[key].submenu[subkey].host = app.view.helper.preffix;
                                    //    }
                                    //})

                                });

                                data.menu = data.menu.filter(function (v) {
                                    return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
                                });

                                var v = app.config.frontend_app_files_midified[wtemplate];

                                app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + wtemplate + '?v=' + v, function (template) {
                                    app.logger.var(data);

                                    $(template(data)).insertBefore($('#container'));
                                    app.view.headerLoaded = true;
                                    setTimeout(function () {
                                        app.view.changeLangSwitchUrls();
                                    }, 2000);
                                });
                            });
                }

            });


});

