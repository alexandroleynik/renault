window.app.view = (function () {
    var currentWidget;

    public = {
        renderPage: function (page) {
            app.logger.prefix = '[app][view]';


            if (!page) {
                alert('Page not found.');
                return false;
            }

            //no widgets
            if (!page.body) {
                alert('Empty page.');
                return false;
            }

            app.page = page;
            document.title = getTitleFromHead(app.page.head);
            app.page.widgets = getWidgetsFromBody(app.page.body);

            this.helper.preffix = app.config.frontend_app_web_url + '/' + app.router.locale
            app.logger.text('this.helper.preffix:' + this.helper.preffix);

            beforePageRender();
            selectMenuItem();
            //changeHomeUrl();
            changeLangSwitchUrls();
            renderWidgets();
        },
        getCurrentWidget: function () {
            return currentWidget;
        },
        beforeWidget: function (w) {
            app.logger.prefix = '[widget][' + w.widgetId + ']';
            app.logger.var(w);
        },
        afterWidget: function (w) {
            app.page.widgets[w.widgetId].rendered = true;
            app.logger.prefix = '';
        },
        helper: {
            preffix: null
        },
        getTranslationsFromData: function (data) {
            if ($.isEmptyObject(data.t)) {
                return {};
            }
            var t = {};

            $.each(data.t, function (k, v) {
                if (v.key && v.value) {
                    t[v.key] = v.value;
                }
            });

            return t;
        },
        getLinksFromData: function (data) {
            if ($.isEmptyObject(data.links)) {
                return {};
            }
            var links = {};

            $.each(data.links, function (k, v) {
                if ('@frontend' == v.host) {
                    v.host = app.view.helper.preffix;
                }

                links[v.key] = v.host + v.url;
            });

            return links;
        }

    };

    function getWidgetsFromBody(body) {
        var widgets = {};
        var obj = JSON.parse(body);
        var index = 0;

        $.each(obj, function (k, v) {
            var wname = getWnameFromWidget(v);

            if (!$.isEmptyObject(v) && 'tab_title' != k && '___' + wname + '___' != k) {

                var wid = wname + '__' + index;
                index++;
                widgets[wid] = v;
                widgets[wid].widgetId = wid;
                widgets[wid].widgetName = wname;
            }
        });

        return widgets;
    }

    function getTitleFromHead(head) {
        var title = null;
        var obj = null;

        if (head) {
            var obj = JSON.parse(head);
        }

        app.logger.text('HEAD');
        app.logger.var(obj);

        if (obj && obj['common'] && obj['common']['title'] && obj['common']['title']['content']) {
            title = obj['common']['title']['content'];
        }

        if (!title) {
            title = app.page.title;
        }

        return title;
    }



    function renderWidgets() {

        var callback = function () {
            //app.logger.text('call interval ');

            //render widgets array            
            var process = false;

            $.each(app.page.widgets, function (k, v) {
                //if true ...                               
                //if false break
                //if undefined run, set false ,break

                if (false === app.page.widgets[k].rendered) {
                    process = true;
                    return false;
                }

                if (undefined === app.page.widgets[k].rendered) {
                    app.page.widgets[k].rendered = false;
                    process = true;
                    currentWidget = app.page.widgets[k];
                    $.getScript(app.config.frontend_app_web_url + '/js/app/widgets/' + v.widgetName + '/widget.js');
                    return false;
                }
            });

            if (false === process) {
                app.logger.text('clear interval');
                clearInterval(window.intervalId)

                afterPageRender();
            }
        };

        window.intervalId = setInterval(callback, 200);
    }

    function selectMenuItem() {
        $("nav").find(".nav-active").removeClass("nav-active");
        $('a[href*="' + location.pathname + '"]').addClass("nav-active");
    }

    function getWnameFromWidget(v) {
        var wname;

        $.each(v, function (k, v) {
            //app.logger.text(k);
            if (k.match(/___(.+)___/)) {
                wname = k.match(/___(.+)___/)[1];
            }
        });

        return wname;
    }

    function afterPageRender() {
        app.logger.func('afterPageRender()');

        addFooter();

        //add ga
        //$.getScript(app.config.frontend_app_web_url + '/js/lib/google.analytics.js');
        app.bindContainerAjaxLinks(app.config.frontend_app_conainer);

        $('.main-container').show();
        $('footer').show();

        if (app.isFirstLoad) {
            preloadLogoEnd();
        }
        else {
            preloadFadeOut();
        }

        app.container.append($("<div/>").html(app.config.frontend_app_code_body_end).text());
    }

    function changeLangSwitchUrls() {
        $('a[short-lang]').each(function (k, v) {
            var urlpath = location.pathname;
            var linkLang = $(v).attr('short-lang');

            if (urlpath && urlpath != '/') {
                urlpath = urlpath.replace(/^\/[\w]{2}/, '/' + linkLang);
            }

            if ('/' == urlpath) {
                urlpath = urlpath + linkLang;
            }

            $(v).attr('href', app.config.frontend_app_frontend_url + urlpath);
        })
    }

    function beforePageRender() {
        addHeader();

        //clear all
        app.container.html('');

        $.getScript(app.config.frontend_app_web_url + '/js/lib/beforeRender.js');
    }

    function addHeader() {
        if (app.view.headerLoaded) {
            return;
        }

        app.logger.func('addHeader');

        var params = {
            "fields": 'id,slug,title,body',
            "where": {
                "slug": "header",
                "locale": app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            },
        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/blocks',
                params,
                function (blockData) {
                    //process domain header
                    if (blockData.items[0]) {
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
                                data.menu[key].url = app.view.helper.preffix + val.url;
                            }
                        });

                        var params2 = '';

                        if (true == app.config.frontend_app_debug) {
                            params2 = '?_' + Date.now();
                        }

                        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/templates/header.html' + params2, function (template) {
                            app.logger.var(data);

                            $(template(data)).insertBefore($('#container'));
                            app.view.headerLoaded = true;
                            setTimeout(function () {
                                changeLangSwitchUrls();
                            }, 2000);

                        });
                    }

                    //process default domain header
                    if (!blockData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/blocks',
                                params,
                                function (data) {

                                    var body = data.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
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
                                            data.menu[key].url = app.view.helper.preffix + val.url;
                                        }
                                    });

                                    var params3 = '';

                                    if (true == app.config.frontend_app_debug) {
                                        params3 = '?_' + Date.now();
                                    }

                                    app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/templates/header.html' + params3, function (template) {
                                        app.logger.var(data);

                                        $(template(data)).insertBefore($('#container'));
                                        app.view.headerLoaded = true;
                                        setTimeout(function () {
                                            changeLangSwitchUrls();
                                        }, 2000);
                                    });
                                });
                    }

                });
    }

    function addFooter() {
        if (app.view.footerLoaded) {
            return;
        }

        app.logger.func('addFooter');

        var params = {
            "fields": 'id,slug,title,body',
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
                    if (blockData.items[0]) {
                        var body = blockData.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
                        var data = JSON.parse(body);

                        data.t = app.view.getTranslationsFromData(data);
                        data.links = app.view.getLinksFromData(data);
                        data.urlToLocale = app.view.helper.preffix

                        /*$.each(data.items, function (key, val) {
                         //data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;                        
                         });*/

                        var params2 = '';

                        if (true == app.config.frontend_app_debug) {
                            params2 = '?_' + Date.now();
                        }

                        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/templates/footer.html' + params2, function (template) {
                            app.logger.var(data);

                            $(template(data)).insertAfter($('#container'));
                            app.view.footerLoaded = true;

                        });

                    }

                    //process default domain footer
                    if (!blockData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/blocks',
                                params,
                                function (blockData) {
                                    //process domain header
                                    var body = blockData.items[0].body.replace(/^\[/, '').replace(/\]$/, '');
                                    var data = JSON.parse(body);

                                    data.t = app.view.getTranslationsFromData(data);
                                    data.links = app.view.getLinksFromData(data);
                                    data.urlToLocale = app.view.helper.preffix

                                    /*$.each(data.items, function (key, val) {
                                     //data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;                        
                                     });*/

                                    var params3 = '';

                                    if (true == app.config.frontend_app_debug) {
                                        params3 = '?_' + Date.now();
                                    }

                                    app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + '/js/app/templates/footer.html' + params3, function (template) {
                                        app.logger.var(data);

                                        $(template(data)).insertAfter($('#container'));
                                        app.view.footerLoaded = true;

                                    });




                                });
                    }
                });
    }

    return public;
})()