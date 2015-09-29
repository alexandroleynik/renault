app.view.wfn['footer'] = (function () {
    var wtemplate = '/templates/block/part/footer.html';

    if (app.view.footerLoaded) {
        return;
    }

    app.logger.func('addFooter');

    var params = {
        "fields": 'id,slug,title,body,before_body,after_body,on_scenario',
        "where": {
            "slug": "footer",
            "locale": app.config.frontend_app_locale,
            "domain_id": app.config.frontend_app_domain_id,
        },
    };

    $.getJSON(
            app.config.frontend_app_api_url + '/db/blocks',
            params,
            function (blockData) {
                //process domain footer
                if (blockData.items[0] && 'extend' != blockData.items[0].on_scenario) {
                    var body = blockData.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
                    var data = JSON.parse(body);

                    data.t = app.view.getTranslationsFromData(data);
                    data.links = app.view.getLinksFromData(data);
                    data.urlToLocale = app.view.helper.preffix

                    $.each(data.menu, function (key, val) {
                        if ('@frontend' == val.host) {
                            data.menu[key].host = app.view.helper.preffix;
                        }
                    });

                    //hide find-a-dialer-page for dealers
                    if (app.config.frontend_app_domain_id != app.config.frontend_app_default_domain_id) {
                        data.menu = data.menu.filter(function (v) {
                            return '/find-a-dealer' == v.url ? false : true;
                        });
                    }

                    var v = app.config.frontend_app_files_midified[wtemplate];

                    app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + wtemplate + '?v=' + v, function (template) {
                        app.logger.var(data);

                        $(template(data)).insertAfter($('#container'));
                        app.view.footerLoaded = true;
                    });

                }

                //process default domain footer
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
                            function (blockData) {
                                //process domain header
                                var body = blockData.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
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
                                data.urlToLocale = app.view.helper.preffix


                                $.each(data.menu, function (key, val) {
                                    if ('@frontend' == val.host) {
                                        data.menu[key].host = app.view.helper.preffix;
                                    }
                                });

                                //hide find-a-dialer-page for dealers
                                if (app.config.frontend_app_domain_id != app.config.frontend_app_default_domain_id) {
                                    data.menu = data.menu.filter(function (v) {
                                        return '/find-a-dealer' == v.url ? false : true;
                                    });
                                }

                                var v = app.config.frontend_app_files_midified[wtemplate];

                                app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + wtemplate + '?v=' + v, function (template) {
                                    app.logger.var(data);

                                    $(template(data)).insertAfter($('#container'));
                                    app.view.footerLoaded = true;
                                });



                            });
                }
            });



});

