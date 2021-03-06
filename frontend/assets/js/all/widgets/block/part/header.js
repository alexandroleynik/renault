app.view.wfn['header'] = (function () {
    var wtemplate = '/templates/block/part/header.html';

    if (app.view.headerLoaded) {
        return;
    }

    app.logger.func('addHeader');

    var params = {
        "fields": 'id,slug,title,body,before_body,after_body,on_scenario,custom',
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
                    data.custom = blockData.items[0].custom;

                    data.isRu = ('ru-RU' == app.config.frontend_app_locale) ? true : false;
                    data.isEn = ('en-US' == app.config.frontend_app_locale) ? true : false;
                    data.isUk = ('uk-UA' == app.config.frontend_app_locale) ? true : false;

                    data.urlToHome = app.view.helper.preffix + '/';
                    data.urlToLocale = app.view.helper.preffix;
                    data.urlToFrontend = server_config.frontend_app_web_url;
                    if(server_config.frontend_app_dealer_locale_available == '0'){
                        data.av_locals = true;
                    }
                    else {
                        data.av_locals = false;
                    }
                    if (data.isUk) data.urlToHome = '/';
                    window.topmenu = data.topmenu;
                    $.each(data.topmenu, function (key, val) {

                        if ('@frontend' == val.host) {
                            data.topmenu[key].host = app.view.helper.preffix;

                        }
                        if (data.topmenu[key].submenu) {


                            $.each(data.topmenu[key].submenu, function (subkey, subval) {
                                if ('@frontend' == subval.host) {
                                    data.topmenu[key].submenu[subkey].host = app.view.helper.preffix;
                                }

                            });

                            data.topmenu[key].submenu = data.topmenu[key].submenu.filter(function (v) {
                                return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
                            });
                        }

                        window.testkey = data.topmenu[key].submenu;
                    });


                    window.menu = data.menu;
                    $.each(data.menu, function (key, val) {

                        if ('@frontend' == val.host) {
                            data.menu[key].host = app.view.helper.preffix;

                        }
                        if (data.menu[key].submenu) {


                            $.each(data.menu[key].submenu, function (subkey, subval) {
                                if ('@frontend' == subval.host) {
                                    data.menu[key].submenu[subkey].host = app.view.helper.preffix;
                                }

                            });

                            data.menu[key].submenu = data.menu[key].submenu.filter(function (v) {
                                return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
                            });
                        }

                        window.testkey = data.menu[key].submenu;
                        //window.testval = val;

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

                                data.urlToHome = app.view.helper.preffix + '/';
                                data.urlToLocale = app.view.helper.preffix;
                                data.urlToFrontend = server_config.frontend_app_web_url;
                                
                                if (data.isUk) data.urlToHome = '/';

                                $.each(data.menu, function (key, val) {

                                    if ('@frontend' == val.host) {
                                        data.menu[key].host = app.view.helper.preffix;
                                    }
                                    if (data.menu[key].submenu) {


                                        $.each(data.menu[key].submenu, function (subkey, subval) {
                                            if ('@frontend' == subval.host) {
                                                data.menu[key].submenu[subkey].host = app.view.helper.preffix;
                                            }
                                        });

                                        data.menu[key].submenu = data.menu[key].submenu.filter(function (v) {
                                            return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
                                        });
                                    }

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

