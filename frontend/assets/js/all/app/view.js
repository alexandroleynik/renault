window.app.view = (function () {
    var currentWidget;

    public = {
        renderPage: function (page) {
            app.logger.prefix = '[app][view]';

            //filter

            //no page
            if (!page) {
                alert('Page not found.');
                return false;
            }

            //no widgets
            if (!page.body) {
                alert('Empty page.');
                return false;
            }

            //delaer page blacklist            
            if (this.isDealerBlackListPage(location.pathname)) {
                alert('Page not allowed.');
                return false;
            }

            app.page = page;
            app.page.body = getExtendedBody(app.page);
            document.title = getTitleFromHead(app.page.head);
            app.page.widgets = getWidgetsFromBody(app.page.body);

            this.helper.preffix = app.config.frontend_app_web_url + '/' + app.router.locale
            app.logger.text('this.helper.preffix:' + this.helper.preffix);

            beforePageRender();
            selectMenuItem();
            //changeHomeUrl();
            app.view.changeLangSwitchUrls();
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
        },
        changeLangSwitchUrls: function () {
            $('a[short-lang]').each(function (k, v) {
                var urlpath = location.pathname;
                var linkLang = $(v).attr('short-lang');
                var result = '';

                if (urlpath && urlpath != '/') {
                    urlpath = urlpath.replace(/^\/[\w]{2}/, '/' + linkLang);
                }

                if ('/' == urlpath) {
                    urlpath = urlpath + linkLang;
                }
                else {
                    if (urlpath.length > 3) {
                        $.each(app.page.localeGroupPages, function (k2, v2) {
                            if (linkLang == v2.locale.replace(/-.+/, '')) {
                                urlpath = urlpath.replace(/\/[^\/]+$/, '/' + v2.slug);
                            }
                        });
                    }
                }


                result = app.config.frontend_app_frontend_url + urlpath;

                if (location.search) {
                    result += location.search;
                }

                $(v).attr('href', result);
            })
        },
        isDealerBlackListPage: function (pathname) {
            if (app.config.frontend_app_domain_id != app.config.frontend_app_default_domain_id) {
                var blackList = app.config.frontend_dealer_page_blacklist.split(',');
                var blackListIndex = blackList.indexOf(pathname.replace('/' + app.router.locale + '/', ''))
                if (blackListIndex != -1) {
                    return true;
                }
            }

            return false;
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
        /*var callback = function () {
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
         //$.getScript(app.config.frontend_app_web_url + '/widgets/' + v.widgetName + '/widget.js');                    

         app.view.wfn[v.widgetName]();
         return false;
         }
         });

         if (false === process) {
         app.logger.text('clear interval');
         clearInterval(window.intervalId);

         afterPageRender();
         }
         };        

         window.intervalId = setInterval(callback, 200);*/

        //parallel load
        $.each(app.page.widgets, function (k, v) {
            if(v.anchor !== undefined){
                app.container.append('<div id="widget-' + v.anchor + '"></div>');
            } else {
                app.container.append('<div id="widget-' + k + '"></div>');
            }
            app.container.append('<div id="widget-wrapper-' + k + '" class="widget-wrapper-' + v.widgetName + '">' + '</div>');
            
            console.log('k');
            console.log(k);
            console.log('v');
            console.log(v);
            currentWidget = app.page.widgets[k];
            currentWidget.uniqueKey = k;
            currentWidget.rootElementId = 'widget-wrapper-' + k;

            app.view.beforeWidget(currentWidget);
            app.view.wfn[v.widgetName]();
        });

        setTimeout(function () {
            afterPageRender();
        }, 2000);
    }

    function selectMenuItem() {
        $("nav").find(".nav-active").removeClass("nav-active");
        $('a[href*="' + location.pathname + '"]').addClass("nav-active");

        $('.nav-dropdown-toggle').parent('li.active').removeClass('active');
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
function isWrapper(){
    var page = app.config.frontend_page_without_header_footer;
    var re = /\s*,\s*/
    var pageList = page.split(re);


    if($.inArray( app.router.slug, pageList )>-1){
        $('.preload-mask').css('display', 'none');
        preloadLogoEnd();
        preloadFadeOut();

        return true;

    } else {

        return false;
    }
}
    function afterPageRender() {
        app.logger.func('afterPageRender()');
        if (!isWrapper()) {
            app.view.wfn['footer']();
        }


        //add ga
        //$.getScript(app.config.frontend_app_web_url + '/js/lib/google.analytics.js');
        //app.bindContainerAjaxLinks(app.config.frontend_app_conainer);

        $('.main-container').show();
        $('footer').show();

        if (app.isFirstLoad) {
            preloadLogoEnd();
        }
        else {
            preloadFadeOut();
        }

        app.container.append($("<div/>").html(app.config.frontend_app_code_body_end).text());

        $("img").attr('alt', app.page.title);

        modifyHtmlTags();

        app.bindAllAjaxLinks();

        setTimeout(function () {
            app.bindAllAjaxLinks();
        }, 3000);
    }


    function beforePageRender() {
        if (!isWrapper()) {
            //$('.preload-mask').hide();
            app.view.wfn['header']();
        }
        //clear all
        app.container.html('');
    }


    function getExtendedBody(page) {
        var body = page.body;

        if (page.domain_before_body) {
            body = page.domain_before_body + body;
        }

        if (page.domain_after_body) {
            body = body + page.domain_after_body;
        }

        body = body.replace(/\]\[/g, ',').replace(/,,/g, ',').replace(/\[,\]/g, '[]').replace(/\[,/g, '[').replace(/\,]/g, ']');

        return body;
    }

    function modifyHtmlTags() {
        $(".widget-wrapper-wysiwyg s").wrapInner("<span></span>");
        $('.widget-wrapper-wysiwyg input[type="radio"]').each(function (k, v) {
            $(v).attr('id', 'radio-' + k);
            $(v).after('<label ' + 'for ="radio-' + k + '">' + $(v).val() + '</label>');

        });
        $('.widget-wrapper-wysiwyg input[type="checkbox"]').each(function (k, v) {
            $(v).attr('id', 'checkbox-' + k);
            $(v).after('<label ' + 'for ="checkbox-' + k + '">' + $(v).val() + '</label>');
        });
    }


    return public;
})()

app.view.wfn = {};
