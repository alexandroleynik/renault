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
            document.title = app.page.title;
            app.page.widgets = getWidgetsFromBody(app.page.body);

            this.helper.preffix = app.config.frontend_app_web_url + '/' + app.router.locale
            app.logger.text('this.helper.preffix:' + this.helper.preffix);

            //clear all
            app.container.html('');

            selectMenuItem();
            //changeHomeUrl();
            changeLangSwitchUrls()
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
    }
    
    function changeLangSwitchUrls() {
        
        $('a[short-lang]').each(function(k ,v) {
            var urlpath = location.pathname;
            var linkLang = $(v).attr('short-lang');
            
            if (urlpath && urlpath != '/') {
                 //$urlpath = preg_replace('/^[\w]{2}/', $lang, $urlpath);
                 urlpath = urlpath.replace(/^\/[\w]{2}/,'/' + linkLang);
            }
            
            if ('/' == urlpath) {
                urlpath = urlpath + linkLang;
            }
            
            $(v).attr('href', app.config.frontend_app_frontend_url + urlpath);
        })
        
        
    }

    return public;
})()