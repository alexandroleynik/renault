window.fbAsyncInit = function () {
    FB.init({
        appId: window.server_config.frontend_app_facebook_app_id,
        xfbml: true,
        version: 'v2.3'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(document).ready(function(){

	// Style input+select
	if($('.inp-decorate').length) {
		$('.inp-decorate').styler();
	}

	if($('.single_post_slide_list').length) {
		$('.single_post_slide_list').cycle({
	        fx: 'carousel',
	        carouselVertical: true,
	        paused: true,
	        speed: 300,
	        autoScrolling: false,
	        carouselVisible: 3,
	        prev: '.single_post_slide_list__prev',
	        next: '.single_post_slide_list__next',
	        slides: '> .item'
	    });
	}


$('#mobile-popup .big-close-btn').click(function(){
    $('#mobile-popup').fadeOut(1600);
});
    $('#mobile-popup .close-btn').click(function(){
        $('#mobile-popup').fadeOut(1600);
    });


});

function urlencode(v) {
    return encodeURIComponent(v).replace(/%20/g, '+');
}

function urldecode(v) {
    return uri = decodeURIComponent(v);
}


var cSpeed = 9;
var cWidth = 160;
var cHeight = 20;
var cTotalFrames = 13;
var cFrameWidth = 160;
var cImageSrc = server_config.frontend_app_web_url + '/img/sprites.gif';

var cImageTimeout = false;
var cIndex = 0;
var cXpos = 0;
var cPreloaderTimeout = false;
var SECONDS_BETWEEN_FRAMES = 0;

function preloadStart() {

        //console.log('--------------start')
        //document.getElementById('loaderImage').style.backgroundImage = 'url(' + cImageSrc + ')';
        //document.getElementById('loaderImage').style.width = cWidth + 'px';
        //document.getElementById('loaderImage').style.height = cHeight + 'px';
        //
        ////FPS = Math.round(100/(maxSpeed+2-speed));
        //FPS = Math.round(100 / cSpeed);
        //SECONDS_BETWEEN_FRAMES = 1 / FPS;
        //
        //cPreloaderTimeout = setTimeout('preloadFadeIn()', SECONDS_BETWEEN_FRAMES / 1000);

}

function preloadFadeIn() {

    //cXpos += cFrameWidth;
    ////increase the index so we know which frame of our animation we are currently on
    //cIndex += 1;
    //
    ////if our cIndex is higher than our total number of frames, we're at the end and should restart
    //if (cIndex >= cTotalFrames) {
    //    cXpos = 0;
    //    cIndex = 0;
    //}
    //
    //if (document.getElementById('loaderImage'))
    //    document.getElementById('loaderImage').style.backgroundPosition = (-cXpos) + 'px 0';
    //
    //cPreloaderTimeout = setTimeout('preloadFadeIn()', SECONDS_BETWEEN_FRAMES * 1000);
    //
    //$(".preload-mask").fadeIn();
}

function preloadStop() {
    //$(".preload-mask").fadeOut();
    //clearTimeout(cPreloaderTimeout);
    //cPreloaderTimeout = false;
    //$('.nav-root').removeClass('nav-is-open');
    //$('html, body').removeClass('nav-is-activated');
    //$('.nav-container').removeAttr('style');


    //navDropdown();
}

function preloadLogoEnd() {
    //preloadStop();
}

function preloadFadeOut() {
    //preloadStop();
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


$(function () {

    //nav behavior
    var tm_nav = null;
    $('.show-menu').click(function (e) {
        e.preventDefault();
        $('.nav-container').css({'min-height': $(window).height()});
        clearTimeout(tm_nav);
        $('html, body').addClass('nav-is-activated');
        tm_nav = setTimeout(function () {
            $('.nav-root').addClass('nav-is-open');
        }, 20);
    });
    $('.close-menu').click(function (e) {
        e.preventDefault();
        clearTimeout(tm_nav);
        $('.nav-root').removeClass('nav-is-open');
        tm_nav = setTimeout(function () {
            $('html, body').removeClass('nav-is-activated');
            $('.nav-container').removeAttr('style');
        }, 300);
    });

    $(window).resize(function () {
        if ($(window).width() >= 960) {
            clearTimeout(tm_nav);
            $('.nav-root').removeClass('nav-is-open');
            $('html, body').removeClass('nav-is-activated');
            $('.nav-container').removeAttr('style');
        }
    });



    /*$('.nav-is-open').on('click', 'li', function(){
     alert(1);
     console.log(1);
     clearTimeout(tm_nav);
     $('.nav-root').removeClass('nav-is-open');
     tm_nav = setTimeout(function () {
     $('html, body').removeClass('nav-is-activated');
     $('.nav-container').removeAttr('style');
     }, 300);
     });*/

});

function translit(v) {
    var L = {
        'А': 'A', 'а': 'a', 'Б': 'B', 'б': 'b', 'В': 'V', 'в': 'v', 'Г': 'G', 'г': 'g',
        'Д': 'D', 'д': 'd', 'Е': 'E', 'е': 'e', 'Ё': 'Yo', 'ё': 'yo', 'Ж': 'Zh', 'ж': 'zh',
        'З': 'Z', 'з': 'z', 'И': 'I', 'и': 'i', 'Й': 'Y', 'й': 'y', 'К': 'K', 'к': 'k',
        'Л': 'L', 'л': 'l', 'М': 'M', 'м': 'm', 'Н': 'N', 'н': 'n', 'О': 'O', 'о': 'o',
        'П': 'P', 'п': 'p', 'Р': 'R', 'р': 'r', 'С': 'S', 'с': 's', 'Т': 'T', 'т': 't',
        'У': 'U', 'у': 'u', 'Ф': 'F', 'ф': 'f', 'Х': 'Kh', 'х': 'kh', 'Ц': 'Ts', 'ц': 'ts',
        'Ч': 'Ch', 'ч': 'ch', 'Ш': 'Sh', 'ш': 'sh', 'Щ': 'Sch', 'щ': 'sch', 'Ъ': '"', 'ъ': '"',
        'Ы': 'Y', 'ы': 'y', 'Ь': "'", 'ь': "'", 'Э': 'E', 'э': 'e', 'Ю': 'Yu', 'ю': 'yu',
        'Я': 'Ya', 'я': 'ya'
    },
    r = '',
            k;
    for (k in L)
        r += k;
    r = new RegExp('[' + r + ']', 'g');
    k = function (a) {
        return a in L ? L[a] : '';
    };

    return v.replace(r, k);
}

function toCodeValue(v) {
    return translit(v).replace(/[^\w]/g, '-').toLowerCase();
}

function is_string(mixed_var) {
    return (typeof (mixed_var) == 'string');
}

$('li.services ul li').on('click', function(){
    alert();
    console.log('drgtdgfds')
});
//test grunt 3

/* Simple single page application 
 * with :
 * jquery, 
 * jquery.loadTemplate, 
 * jquery.url-params
 * 
 * @author Eugene Fabrikov eugene.fabrikov@gmail.com
 */

window.app = (function () {
    // ------------------ private vars ---------------------- //

    var public = {
        // ------------------ public vars ----------------------- //
        container: null,
        isFirstLoad: true,
        // ------------------ public functions ------------------ //
        run: function () {
            app.logger.page(location.href);
            app.logger.func('run()');
            init();
            bindEventListeners();
            process();
        },
        bindContainerAjaxLinks: function (selector) {
            app.logger.func('bindContainerAjaxLinks( ' + selector + ')');

            if (app.config.frontend_app_conainer != selector) {
                app.container.find(selector).find('.ajaxLink').off('click');
                app.container.find(selector).find('.ajaxLink').click(fClickAjaxLink);
                app.logger.text('!=selector');
            }
            else {
                app.logger.text('=selector');
                app.container.find('.ajaxLink').off('click');
                app.container.find('.ajaxLink').click(fClickAjaxLink);
            }
        },
        bindAllAjaxLinks: function () {
            app.logger.func('bindAllAjaxLinks');
            $('body').find('.ajaxLink').off('click');
            $('body').find('.ajaxLink').click(fClickAjaxLink);
            $('body').find('.ajaxLink').click(function() {
                console.log('nav');
                $('.nav-primary li.active').removeClass('active'); 
            });
        },
        changePageAjax: function (url) {
            app.logger.prefix = '[app]';
            app.logger.page(location.href);
            app.logger.func('fClickAjaxLink()');

            app.logger.resetTimer();

            app.isFirstLoad = false;

            sessionStorage.setItem('app.previous_url', location.href);

            var params = '';

            preloadFadeIn();

            setTimeout(function () {
                changePage(url, params);
            }, 1000);
        }
    }

    // ------------------ private functions ----------------- //
    function init() {
        app.logger.func('init()');
        public.container = $(app.config.frontend_app_conainer);
        registerHandlebarsHelpers();
    }
    function isWrapper(){
        var page = app.config.frontend_page_without_header_footer;
        var re = /\s*,\s*/
        var pageList = page.split(re);
        var pathname = window.location.pathname;
        var slug = pathname.split('/');

        if($.inArray( slug[2], pageList )>-1){
            return true;
        } else {
            return false;
        }
    }

    function bindEventListeners() {
        app.logger.func('bindEventListeners()');
        bindAjaxLinks();

if(!isWrapper()){
    preloadStart();
}



    }

    function process() {
        app.logger.func('process()');

        app.router.run(location.pathname);
    }

    function bindAjaxLinks() {
        app.logger.func('bindAjaxLinks()');
        //bind ajax load to links 
        $('.ajaxLink').off('click');
        $('.ajaxLink').click(fClickAjaxLink);
    }

    function registerHandlebarsHelpers() {
        Handlebars.registerHelper('link', function (text, url) {
            text = Handlebars.Utils.escapeExpression(text);
            url = Handlebars.Utils.escapeExpression(url);

            var result = '<a href="' + url + '">' + text + '</a>';

            return new Handlebars.SafeString(result);
        });
        Handlebars.registerHelper("counter", function (value, options)
        {
            return parseInt(value) + 1;
        });
        Handlebars.registerHelper("counter0", function (value, options)
        {
            return parseInt(value);
        });
        Handlebars.registerHelper('iff', function(a, operator, b, opts) {
            var bool = false;
            switch(operator) {
                case '==':
                    bool = a == b;
                    break;
                case '>':
                    bool = a > b;
                    break;
                case '<':
                    bool = a < b;
                    break;
                default:
                    throw "Unknown operator " + operator;
            }

            if (bool) {
                return opts.fn(this);
            } else {
                return opts.inverse(this);
            }
        });
    }


    function changePage(url, params) {
        // Change url
        if (url != window.location) {
            window.history.pushState(null, null, url);
        }

        //load html
        app.router.run(url + params);

        //Back Forward buttons
        $(window).off('popstate');
        $(window).bind('popstate', function () {
            if (location.hash) return;
            
            app.logger.func('popstate event for ' + location.pathname + params);
            app.router.run(location.pathname + params);
        });
    }

    fClickAjaxLink = (function () {
        app.logger.prefix = '[app]';
        app.logger.page(location.href);
        app.logger.func('fClickAjaxLink()');

        app.logger.resetTimer();

        app.isFirstLoad = false;

        sessionStorage.setItem('app.previous_url', location.href);

        var url = $(this).attr('href');
        var params = '';

        preloadFadeIn();

        setTimeout(function () {
            changePage(url, params);
        }, 1000);

        // Prevent default action
        return false;
    })

    return public;
})();

window.app.config = window.server_config;
window.app.logger = (function () {
    var startLogTime;    

    public = {
        prefix : '[app]',
        
        page: function (message) {                        
            if (false != app.config.frontend_app_log_clear_page) {            
                console.clear();                
            }
            
            consoleLog(message, '');
        },
        func: function (message) {
            consoleLog(message, '      ');
        },
        text: function (message) {
            consoleLog(message, '            ');
        },
        var : function (v) {
            consoleDir(v);
        },
        
        resetTimer : function() {            
            startLogTime = (new Date()).getTime();        
        }
    };

    function consoleDir(v) {
        if (false == app.config.frontend_app_debug)
            return true;

        console.dir(v);
    }

    function consoleLog(message, tab) {
        if (false == app.config.frontend_app_debug)
            return true;

        var style = 'color: green';

        console.log('%c ' + tab + ' [' + getLogTime() + ' s] '+ window.app.logger.prefix + ' ' + message + ' ', style);
    }

    function getLogTime() {
        if (undefined == startLogTime) {
            startLogTime = (new Date()).getTime();
        }

        return (((new Date()).getTime() - startLogTime) / 1000).toFixed(2);
    }

    return public;
})()
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
            var arr = url.replace(/.+\/\/.+?\//, '').replace(/^\//,'').replace(/\?.+/,'').replace(/\/$/,'').split('/');

            switch (arr.length) {
                case 1:
                    if (!arr[0]) {
                        // empty url, default uk
                        arr[0] = server_config.frontend_app_dealer_locale;
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
                case 'news':
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
                case 'models':
                    switch (this.action) {
                        case 'view':
                            loadViewActionData('/db/info');
                            break;
                        case 'preview':
                            loadPreviewActionData();
                            break;
                    }
                    break;
                //добавить кейс со ссылкой на моделс
                case 'service':
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
                case 'about-company':
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
                case 'finance':
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
                    fields: 'id,slug,head,body,title,before_body,after_body,on_scenario',
                    expand: 'localeGroupPages'
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
                            fields: 'id,slug,head,body,title,before_body,after_body,on_scenario',
                            expand: 'localeGroupPages'
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

window.app.templateLoader = (function () {
    public = {
        getTemplateAjax: function (path, callback) {
            var source;
            var template;
            $.ajax({
                url: path,                
                success: function (data) {
                    source = data;
                    template = Handlebars.compile(source);
                    //execute the callback if passed
                    if (callback) {
                        callback(template);
                    }
                    else {
                        return template;
                    }
                        
                }
            });
        }
    }
    
    return public;

})();
$(document).ready(function () {            
    window.app.run();
});



(function(window,document,undefined) {
    (function(window,document,undefined) {
        'use strict';

        var Notification, addStyle, coreStyle, createElem, defaults, getAnchorElement, getStyle, globalAnchors, hAligns, incr, inherit, insertCSS, mainPositions, opposites, parsePosition, pluginClassName, pluginName, pluginOptions, positions, realign, stylePrefixes, styles, vAligns,
            __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

        pluginName = 'notify';

        pluginClassName = pluginName + 'js';

        positions = {
            t: 'top',
            m: 'middle',
            b: 'bottom',
            l: 'left',
            c: 'center',
            r: 'right'
        };

        hAligns = ['l', 'c', 'r'];

        vAligns = ['t', 'm', 'b'];

        mainPositions = ['t', 'b', 'l', 'r'];

        opposites = {
            t: 'b',
            m: null,
            b: 't',
            l: 'r',
            c: null,
            r: 'l'
        };

        parsePosition = function(str) {
            var pos;
            pos = [];
            $.each(str.split(/\W+/), function(i, word) {
                var w;
                w = word.toLowerCase().charAt(0);
                if (positions[w]) {
                    return pos.push(w);
                }
            });
            return pos;
        };

        styles = {};

        coreStyle = {
            name: 'core',
            html: "<div class=\"" + pluginClassName + "-wrapper\">\n  <div class=\"" + pluginClassName + "-arrow\"></div>\n  <div class=\"" + pluginClassName + "-container\"></div>\n</div>",
            css: "." + pluginClassName + "-corner {\n  position: fixed;\n  margin: 5px;\n  z-index: 1050;\n}\n\n." + pluginClassName + "-corner ." + pluginClassName + "-wrapper,\n." + pluginClassName + "-corner ." + pluginClassName + "-container {\n  position: relative;\n  display: block;\n  height: inherit;\n  width: inherit;\n  margin: 3px;\n}\n\n." + pluginClassName + "-wrapper {\n  z-index: 1;\n  position: absolute;\n  display: inline-block;\n  height: 0;\n  width: 0;\n}\n\n." + pluginClassName + "-container {\n  display: none;\n  z-index: 1;\n  position: absolute;\n  cursor: pointer;\n}\n\n." + pluginClassName + "-text {\n  position: relative;\n}\n\n." + pluginClassName + "-arrow {\n  position: absolute;\n  z-index: 2;\n  width: 0;\n  height: 0;\n}"
        };

        stylePrefixes = {
            "border-radius": ["-webkit-", "-moz-"]
        };

        getStyle = function(name) {
            return styles[name];
        };

        addStyle = function(name, def) {
            var cssText, _ref;
            if (!name) {
                throw "Missing Style name";
            }
            if (!def) {
                throw "Missing Style definition";
            }
            if ((_ref = styles[name]) != null ? _ref.cssElem : void 0) {
                if (window.console) {
                    console.warn("" + pluginName + ": overwriting style '" + name + "'");
                }
                styles[name].cssElem.remove();
            }
            def.name = name;
            styles[name] = def;
            cssText = "";
            if (def.classes) {
                $.each(def.classes, function(className, props) {
                    cssText += "." + pluginClassName + "-" + def.name + "-" + className + " {\n";
                    $.each(props, function(name, val) {
                        if (stylePrefixes[name]) {
                            $.each(stylePrefixes[name], function(i, prefix) {
                                return cssText += "  " + prefix + name + ": " + val + ";\n";
                            });
                        }
                        return cssText += "  " + name + ": " + val + ";\n";
                    });
                    return cssText += "}\n";
                });
            }
            if (def.css) {
                cssText += "/* styles for " + def.name + " */\n" + def.css;
            }
            if (!cssText) {
                return;
            }
            def.cssElem = insertCSS(cssText);
            return def.cssElem.attr('id', "notify-" + def.name);
        };

        insertCSS = function(cssText) {
            var elem;
            elem = createElem("style");
            elem.attr('type', 'text/css');
            $("head").append(elem);
            try {
                elem.html(cssText);
            } catch (e) {
                elem[0].styleSheet.cssText = cssText;
            }
            return elem;
        };

        pluginOptions = {
            clickToHide: true,
            autoHide: true,
            autoHideDelay: 5000,
            arrowShow: true,
            arrowSize: 5,
            elementPosition: 'bottom',
            globalPosition: 'top right',
            style: 'bootstrap',
            className: 'error',
            showAnimation: 'slideDown',
            showDuration: 400,
            hideAnimation: 'slideUp',
            hideDuration: 200,
            gap: 5
        };

        inherit = function(a, b) {
            var F;
            F = function() {};
            F.prototype = a;
            return $.extend(true, new F(), b);
        };

        defaults = function(opts) {
            return $.extend(pluginOptions, opts);
        };

        createElem = function(tag) {
            return $("<" + tag + "></" + tag + ">");
        };

        globalAnchors = {};

        getAnchorElement = function(element) {
            var radios;
            if (element.is('[type=radio]')) {
                radios = element.parents('form:first').find('[type=radio]').filter(function(i, e) {
                    return $(e).attr('name') === element.attr('name');
                });
                element = radios.first();
            }
            return element;
        };

        incr = function(obj, pos, val) {
            var opp, temp;
            if (typeof val === 'string') {
                val = parseInt(val, 10);
            } else if (typeof val !== 'number') {
                return;
            }
            if (isNaN(val)) {
                return;
            }
            opp = positions[opposites[pos.charAt(0)]];
            temp = pos;
            if (obj[opp] !== undefined) {
                pos = positions[opp.charAt(0)];
                val = -val;
            }
            if (obj[pos] === undefined) {
                obj[pos] = val;
            } else {
                obj[pos] += val;
            }
            return null;
        };

        realign = function(alignment, inner, outer) {
            if (alignment === 'l' || alignment === 't') {
                return 0;
            } else if (alignment === 'c' || alignment === 'm') {
                return outer / 2 - inner / 2;
            } else if (alignment === 'r' || alignment === 'b') {
                return outer - inner;
            }
            throw "Invalid alignment";
        };

        Notification = (function() {

            function Notification(elem, data, options) {
                if (typeof options === 'string') {
                    options = {
                        className: options
                    };
                }
                this.options = inherit(pluginOptions, $.isPlainObject(options) ? options : {});
                this.loadHTML();
                this.wrapper = $(coreStyle.html);
                this.wrapper.data(pluginClassName, this);
                this.arrow = this.wrapper.find("." + pluginClassName + "-arrow");
                this.container = this.wrapper.find("." + pluginClassName + "-container");
                this.container.append(this.userContainer);
                if (elem && elem.length) {
                    this.elementType = elem.attr('type');
                    this.originalElement = elem;
                    this.elem = getAnchorElement(elem);
                    this.elem.data(pluginClassName, this);
                    this.elem.before(this.wrapper);
                }
                this.container.hide();
                this.run(data);
            }

            Notification.prototype.loadHTML = function() {
                var style;
                style = this.getStyle();
                this.userContainer = $(style.html);
                this.text = this.userContainer.find('[data-notify-text]');
                if (this.text.length === 0) {
                    this.text = this.userContainer.find('[data-notify-html]');
                    this.rawHTML = true;
                }
                if (this.text.length === 0) {
                    throw "style: '" + name + "' HTML is missing a: 'data-notify-text' or 'data-notify-html' attribute";
                }
                return this.text.addClass("" + pluginClassName + "-text");
            };

            Notification.prototype.show = function(show, userCallback) {
                var args, callback, elems, fn, hidden,
                    _this = this;
                callback = function() {
                    if (!show && !_this.elem) {
                        _this.destroy();
                    }
                    if (userCallback) {
                        return userCallback();
                    }
                };
                hidden = this.container.parent().parents(':hidden').length > 0;
                elems = this.container.add(this.arrow);
                args = [];
                if (hidden && show) {
                    fn = 'show';
                } else if (hidden && !show) {
                    fn = 'hide';
                } else if (!hidden && show) {
                    fn = this.options.showAnimation;
                    args.push(this.options.showDuration);
                } else if (!hidden && !show) {
                    fn = this.options.hideAnimation;
                    args.push(this.options.hideDuration);
                } else {
                    return callback();
                }
                args.push(callback);
                return elems[fn].apply(elems, args);
            };

            Notification.prototype.setGlobalPosition = function() {
                var align, anchor, css, key, main, pAlign, pMain, position;
                position = this.getPosition();
                pMain = position[0], pAlign = position[1];
                main = positions[pMain];
                align = positions[pAlign];
                key = pMain + "|" + pAlign;
                anchor = globalAnchors[key];
                if (!anchor) {
                    anchor = globalAnchors[key] = createElem("div");
                    css = {};
                    css[main] = 0;
                    if (align === 'middle') {
                        css.top = '45%';
                    } else if (align === 'center') {
                        css.left = '45%';
                    } else {
                        css[align] = 0;
                    }
                    anchor.css(css).addClass("" + pluginClassName + "-corner");
                    $("body").append(anchor);
                }
                return anchor.prepend(this.wrapper);
            };

            Notification.prototype.setElementPosition = function() {
                var arrowColor, arrowCss, arrowSize, color, contH, contW, css, elemH, elemIH, elemIW, elemPos, elemW, gap, mainFull, margin, opp, oppFull, pAlign, pArrow, pMain, pos, posFull, position, wrapPos, _i, _j, _len, _len1, _ref;
                position = this.getPosition();
                pMain = position[0], pAlign = position[1], pArrow = position[2];
                elemPos = this.elem.position();
                elemH = this.elem.outerHeight();
                elemW = this.elem.outerWidth();
                elemIH = this.elem.innerHeight();
                elemIW = this.elem.innerWidth();
                wrapPos = this.wrapper.position();
                contH = this.container.height();
                contW = this.container.width();
                mainFull = positions[pMain];
                opp = opposites[pMain];
                oppFull = positions[opp];
                css = {};
                css[oppFull] = pMain === 'b' ? elemH : pMain === 'r' ? elemW : 0;
                incr(css, 'top', elemPos.top - wrapPos.top);
                incr(css, 'left', elemPos.left - wrapPos.left);
                _ref = ['top', 'left'];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    pos = _ref[_i];
                    margin = parseInt(this.elem.css("margin-" + pos), 10);
                    if (margin) {
                        incr(css, pos, margin);
                    }
                }
                gap = Math.max(0, this.options.gap - (this.options.arrowShow ? arrowSize : 0));
                incr(css, oppFull, gap);
                if (!this.options.arrowShow) {
                    this.arrow.hide();
                } else {
                    arrowSize = this.options.arrowSize;
                    arrowCss = $.extend({}, css);
                    arrowColor = this.userContainer.css("border-color") || this.userContainer.css("background-color") || 'white';
                    for (_j = 0, _len1 = mainPositions.length; _j < _len1; _j++) {
                        pos = mainPositions[_j];
                        posFull = positions[pos];
                        if (pos === opp) {
                            continue;
                        }
                        color = posFull === mainFull ? arrowColor : 'transparent';
                        arrowCss["border-" + posFull] = "" + arrowSize + "px solid " + color;
                    }
                    incr(css, positions[opp], arrowSize);
                    if (__indexOf.call(mainPositions, pAlign) >= 0) {
                        incr(arrowCss, positions[pAlign], arrowSize * 2);
                    }
                }
                if (__indexOf.call(vAligns, pMain) >= 0) {
                    incr(css, 'left', realign(pAlign, contW, elemW));
                    if (arrowCss) {
                        incr(arrowCss, 'left', realign(pAlign, arrowSize, elemIW));
                    }
                } else if (__indexOf.call(hAligns, pMain) >= 0) {
                    incr(css, 'top', realign(pAlign, contH, elemH));
                    if (arrowCss) {
                        incr(arrowCss, 'top', realign(pAlign, arrowSize, elemIH));
                    }
                }
                if (this.container.is(":visible")) {
                    css.display = 'block';
                }
                this.container.removeAttr('style').css(css);
                if (arrowCss) {
                    return this.arrow.removeAttr('style').css(arrowCss);
                }
            };

            Notification.prototype.getPosition = function() {
                var pos, text, _ref, _ref1, _ref2, _ref3, _ref4, _ref5;
                text = this.options.position || (this.elem ? this.options.elementPosition : this.options.globalPosition);
                pos = parsePosition(text);
                if (pos.length === 0) {
                    pos[0] = 'b';
                }
                if (_ref = pos[0], __indexOf.call(mainPositions, _ref) < 0) {
                    throw "Must be one of [" + mainPositions + "]";
                }
                if (pos.length === 1 || ((_ref1 = pos[0], __indexOf.call(vAligns, _ref1) >= 0) && (_ref2 = pos[1], __indexOf.call(hAligns, _ref2) < 0)) || ((_ref3 = pos[0], __indexOf.call(hAligns, _ref3) >= 0) && (_ref4 = pos[1], __indexOf.call(vAligns, _ref4) < 0))) {
                    pos[1] = (_ref5 = pos[0], __indexOf.call(hAligns, _ref5) >= 0) ? 'm' : 'l';
                }
                if (pos.length === 2) {
                    pos[2] = pos[1];
                }
                return pos;
            };

            Notification.prototype.getStyle = function(name) {
                var style;
                if (!name) {
                    name = this.options.style;
                }
                if (!name) {
                    name = 'default';
                }
                style = styles[name];
                if (!style) {
                    throw "Missing style: " + name;
                }
                return style;
            };

            Notification.prototype.updateClasses = function() {
                var classes, style;
                classes = ['base'];
                if ($.isArray(this.options.className)) {
                    classes = classes.concat(this.options.className);
                } else if (this.options.className) {
                    classes.push(this.options.className);
                }
                style = this.getStyle();
                classes = $.map(classes, function(n) {
                    return "" + pluginClassName + "-" + style.name + "-" + n;
                }).join(' ');
                return this.userContainer.attr('class', classes);
            };

            Notification.prototype.run = function(data, options) {
                var _this = this;
                if ($.isPlainObject(options)) {
                    $.extend(this.options, options);
                } else if ($.type(options) === 'string') {
                    this.options.color = options;
                }
                if (this.container && !data) {
                    this.show(false);
                    return;
                } else if (!this.container && !data) {
                    return;
                }
                this.text[this.rawHTML ? 'html' : 'text'](data);
                this.updateClasses();
                if (this.elem) {
                    this.setElementPosition();
                } else {
                    this.setGlobalPosition();
                }
                this.show(true);
                if (this.options.autoHide) {
                    clearTimeout(this.autohideTimer);
                    return this.autohideTimer = setTimeout(function() {
                        return _this.show(false);
                    }, this.options.autoHideDelay);
                }
            };

            Notification.prototype.destroy = function() {
                return this.wrapper.remove();
            };

            return Notification;

        })();

        $[pluginName] = function(elem, data, options) {
            if ((elem && elem.nodeName) || elem.jquery) {
                $(elem)[pluginName](data, options);
            } else {
                options = data;
                data = elem;
                new Notification(null, data, options);
            }
            return elem;
        };

        $.fn[pluginName] = function(data, options) {
            $(this).each(function() {
                var inst;
                inst = getAnchorElement($(this)).data(pluginClassName);
                if (inst) {
                    return inst.run(data, options);
                } else {
                    return new Notification($(this), data, options);
                }
            });
            return this;
        };

        $.extend($[pluginName], {
            defaults: defaults,
            addStyle: addStyle,
            pluginOptions: pluginOptions,
            getStyle: getStyle,
            insertCSS: insertCSS
        });

        $(function() {
            insertCSS(coreStyle.css).attr('id', 'core-notify');
            return $(document).on('click notify-hide', "." + pluginClassName + "-wrapper", function(e) {
                var inst;
                inst = $(this).data(pluginClassName);
                if (inst && (inst.options.clickToHide || e.type === 'notify-hide')) {
                    return inst.show(false);
                }
            });
        });

    }(window,document));

    $.notify.addStyle("bootstrap", {
        html: "<div>\n<span data-notify-text></span>\n</div>",
        classes: {
            base: {
                "font-weight": "bold",
                "padding": "8px 15px 8px 14px",
                "text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
                "background-color": "#fcf8e3",
                "border": "1px solid #fbeed5",
                "border-radius": "4px",
                "white-space": "nowrap",
                "padding-left": "25px",
                "background-repeat": "no-repeat",
                "background-position": "3px 7px"
            },
            error: {
                "color": "#B94A48",
                "background-color": "#F2DEDE",
                "border-color": "#EED3D7",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"
            },
            success: {
                "color": "#468847",
                "background-color": "#DFF0D8",
                "border-color": "#D6E9C6",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
            },
            info: {
                "color": "#3A87AD",
                "background-color": "#D9EDF7",
                "border-color": "#BCE8F1",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
            },
            warn: {
                "color": "#C09853",
                "background-color": "#FCF8E3",
                "border-color": "#FBEED5",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"
            }
        }
    });

    (function($) {

        if(window.console === undefined)
            window.console = { isFake: true };

        var fns = ["log","warn","info","group","groupCollapsed","groupEnd"];
        for (var i = fns.length - 1; i >= 0; i--)
            if(window.console[fns[i]] === undefined)
                window.console[fns[i]] = $.noop;

        if(!$) return;

        var I = function(i){ return i; };

        function log() {
            if(this.suppressLog)
                return;
            cons('log', this, arguments);
        }

        function warn() {
            cons('warn', this, arguments);
        }

        function info() {
            cons('info', this, arguments);
        }

        function cons(type, opts, args) {
            if(window.console === undefined ||
                window.console.isFake === true)
                return;

            var a = $.map(args,I);
            a[0] = [opts.prefix, a[0], opts.postfix].join('');
            var grp = $.type(a[a.length-1]) === 'boolean' ? a.pop() : null;

            //if(a[0]) a[0] = getName(this) + a[0];
            if(grp === true) window.console.group(a[0]);
            if(a[0] && grp === null)
                if(window.navigator.userAgent.indexOf("MSIE") >= 0)
                    window.console.log(a.join(','));
                else
                    window.console[type].apply(window.console, a);
            if(grp === false) window.console.groupEnd();
        }

        function withOptions(opts) {
            return {
                log:  function() { log.apply(opts, arguments); },
                warn: function() { warn.apply(opts, arguments); },
                info: function() { info.apply(opts, arguments); }
            };
        }

        var console = function(opts) {
            opts = $.extend({}, console.defaults, opts);
            return withOptions(opts);
        };

        console.defaults = {
            suppressLog: false,
            prefix: '',
            postfix: ''
        };

        $.extend(console, withOptions(console.defaults));

        if($.console === undefined)
            $.console = console;

        $.consoleNoConflict = console;

    }(jQuery));

//plugin wide ajax cache
    var ajaxCache = { loading: {}, loaded: {} } ;

//callable from user defined rules. alias: r.ajax
    function ajaxHelper(userOpts, r) {

        var defaults = {
                method: "GET",
                timeout: 15 * 1000
            },
            exec = r._exec,
            promptContainer = exec.type === "GroupRuleExecution" ?
                exec.element.domElem :
                r.field,
            userSuccess = userOpts.success,
            userError   = userOpts.error,
            options = exec.element.options,
            serialised = JSON ? JSON.stringify(userOpts) : guid();

        function onErrorDefault(e) {
            log("ajax error");
            r.callback("There has been an error");
        }

        var userCallbacks = {
            success: userSuccess,
            error: userError || onErrorDefault
        };

        //already completed
        if(ajaxCache.loaded[serialised]) {

            var args = ajaxCache.loaded[serialised],
                success = userCallbacks.success;

            success.apply(r, args);
            return;
        }

        //this request is in progress,
        //store callbacks for when first request completes
        if(!ajaxCache.loading[serialised])
            ajaxCache.loading[serialised] = [];
        ajaxCache.loading[serialised].push(userCallbacks);

        if(ajaxCache.loading[serialised].length !== 1) return;

        options.prompt(promptContainer, "Checking...", "load");

        function intercept() {
            options.prompt(promptContainer, false);

            var reqs = ajaxCache.loading[serialised];
            while(reqs.length)
                reqs.pop().success.apply(r,arguments);

            ajaxCache.loaded[serialised] = arguments;
        }

        var realCallbacks = {
            success: intercept,
            error: intercept
        };

        exec.ajax = $.ajax($.extend(defaults, userOpts, realCallbacks));
    }



// var guid = function() {
//   return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1);
// };

    var guid = function() {
        return guid.curr++;
    };
    guid.curr = 1;

    $.fn.verifyScrollView = function(onComplete) {
        var field = $(this).first();
        if(field.length !== 1) return $(this);
        return $(this).verifyScrollTo(field, onComplete);
    };

    $.fn.verifyScrollTo = function( target, options, callback ){
        if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
        var settings = $.extend({
            scrollTarget  : target,
            offsetTop     : 50,
            duration      : 500,
            easing        : 'swing'
        }, options);
        return this.each(function(){
            var scrollPane = $(this);
            var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
            var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop, 10);
            scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration, 10), settings.easing, function(){
                if (typeof callback == 'function') { callback.call(this); }
            });
        });
    };

    $.fn.equals = function(that) {
        if($(this).length !== that.length)
            return false;
        for(var i=0,l=$(this).length;i<l;++i)
            if($(this)[i] !== that[i])
                return false;
        return true;
    };


// Inspired by base2 and Prototype

    var Class = null;

    (function(){
        var initializing = false, fnTest = /xyz/.test(function(){xyz;}) ? /\b_super\b/ : /.*/;
        // The base Class implementation (does nothing)
        Class = function(){};

        // Create a new Class that inherits from this class
        Class.extend = function(prop) {
            var _super = this.prototype;

            // Instantiate a base class (but only create the instance,
            // don't run the init constructor)
            initializing = true;
            var prototype = new this();
            initializing = false;

            // Copy the properties over onto the new prototype
            for (var name in prop) {
                // Check if we're overwriting an existing function
                prototype[name] = typeof prop[name] == "function" &&
                typeof _super[name] == "function" && fnTest.test(prop[name]) ?
                    (function(name, fn){
                        return function() {
                            var tmp = this._super;

                            // Add a new ._super() method that is the same method
                            // but on the super-class
                            this._super = _super[name];

                            // The method only need to be bound temporarily, so we
                            // remove it when we're done executing
                            var ret = fn.apply(this, arguments);
                            this._super = tmp;

                            return ret;
                        };
                    })(name, prop[name]) :
                    prop[name];
            }

            // The dummy class constructor
            function Class() {
                // All construction is actually done in the init method
                if ( !initializing && this.init )
                    this.init.apply(this, arguments);
            }

            // Populate our constructed prototype object
            Class.prototype = prototype;

            // Enforce the constructor to be what we expect
            Class.prototype.constructor = Class;

            // And make this class extendable
            Class.extend = arguments.callee;

            return Class;
        };
    })();
    var Set = Class.extend({
        //class variables
        init: function(items, name) {
            //instance variables
            if(name)
                this.name = name;
            else
                this.name = "Set_"+guid();
            this.array = [];
            this.addAll(items);
        },

        indexOf: function(obj) {
            for(var i = 0, l = this.array.length;i<l; ++i)
                if($.isFunction(obj) ?
                        obj(this.get(i)) :
                        this.equals(this.get(i),obj))
                    return i;
            return -1;
        },

        //obj can be a filter function or an object to 'equals' against
        find: function(obj) {
            return this.get(this.indexOf(obj)) || null;
        },

        get: function(i) {
            return this.array[i];
        },
        //truthy find
        has: function(item) {
            return !!this.find(item);
        },
        add: function(item) {
            if(!this.has(item)) {
                this.array.push(item);
                return true;
            }
            return false;
        },
        addAll: function(items) {
            if(!items) return 0;
            if(!$.isArray(items)) items = [items];
            var count = 0;
            for(var i = 0, l = items.length; i<l; ++i)
                if(this.add(items[i]))
                    count++;
            return count;
        },
        remove: function(item) {
            var newSet = [];
            for(var i = 0, l = this.array.length; i<l; ++i)
                if(!this.equals(this.get(i),item))
                    newSet.push(this.get(i));

            this.array = newSet;
            return item;
        },
        removeAll: function() {
            this.array = [];
        },
        equals: function(i1, i2) {
            if(i1 && i2 && i1.equals !== undefined && i2.equals !== undefined)
                return i1.equals(i2);
            else
                return i1 === i2;
        },
        each: function(fn) {
            for(var i = 0, l = this.array.length; i<l; ++i)
                if( fn(this.get(i)) === false)
                    return;
        },
        map: function(fn) {
            return $.map(this.array,fn);
        },
        filter: function(fn) {
            return $.grep(this.array, fn);
        },
        size: function() {
            return this.array.length;
        },
        getArray: function() {
            return this.array;
        }
    });
    var TypedSet = Set.extend({
        init: function(type, items, name) {
            this.type = type;
            this._super(items, name);
        },
        add: function(item) {
            if(item instanceof this.type)
                this._super(item);
            else
                this.log("add failed - invalid type")
        }
    });
    var Utils = {

        //object create implementation
        create: function (o) {
            function F() {}
            F.prototype = o;
            return new F();
        },

        //bind method
        bind: $.proxy,

        //check options - throws a warning if the option doesn't exist
        checkOptions: function(opts) {
            if(!opts) return;
            for(var key in opts)
                if(globalOptions[key] === undefined)
                    warn("Invalid option: '" + key + "'");
        },

        //append to arguments[i]
        appendArg: function(args, expr, i) {
            if(!i) i = 0;
            var a = [].slice.call(args, i);
            a[i] = expr + a[i];
            return a;
        },

        //memoize.js - by @addyosmani, @philogb, @mathias
        // with a few useful tweaks from @DmitryBaranovsk
        memoize: function( fn ) {
            return function () {
                var args = Array.prototype.slice.call(arguments),
                    hash = "",
                    i  = args.length,
                    currentArg = null;
                while(i--){
                    currentArg = args[i];
                    hash += (currentArg === Object(currentArg)) ?
                        JSON.stringify(currentArg) : currentArg;
                    fn.memoize || (fn.memoize = {});
                }
                return (hash in fn.memoize) ? fn.memoize[hash] :
                    fn.memoize[hash] = fn.apply( this , args );
            };
        },

        dateToString: function(date) {
            return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
        },

        parseDate: function(dateStr) {
            //format check
            var m = dateStr.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
            if(!m) return null;

            var date;
            //parse with jquery ui's date picker
            if($.datepicker !== undefined) {
                try {
                    var epoch = $.datepicker.parseDate("dd/mm/yy", dateStr);
                    date = new Date(epoch);
                } catch(e) { return null; }
                //simple regex parse
            } else {
                date = new Date(parseInt(m[3], 10),parseInt(m[2], 10)-1,parseInt(m[1], 10));
            }

            return date;
        },

        /**
         * returns true if we are in a RTLed document
         * @param {jqObject} field
         */
        isRTL: function(field) {
            var $document = $(document);
            var $body = $('body');
            var rtl =
                (field && field.hasClass('rtl')) ||
                (field && (field.attr('dir') || '').toLowerCase()==='rtl') ||
                $document.hasClass('rtl') ||
                ($document.attr('dir') || '').toLowerCase()==='rtl' ||
                $body.hasClass('rtl') ||
                ($body.attr('dir') || '').toLowerCase()==='rtl';
            return Boolean(rtl);
        }
    };


    var VERSION = "0.0.1",
        cons = $.consoleNoConflict({ prefix: 'verify.js: ' }),
        log  = cons.log,
        warn = cons.warn,
        info = cons.info;



    /* ===================================== *
     * Plugin Settings/Variables
     * ===================================== */

    var globalOptions = {
        // Display log messages flag
        debug: false,
        // Auto initialise forms (on DOM ready)
        autoInit: true,
        // Attribute used to find validators
        validateAttribute: "data-validate",
        // Name of the event triggering field validation
        validationEventTrigger: "blur",
        // Automatically scroll viewport to the first error
        scroll: true,
        // Focus on the first input
        focusFirstField: true,
        // Hide error while the user is changing
        hideErrorOnChange: false,
        // Whether to skip the hidden fields
        skipHiddenFields: true,
        // Whether to skip the hidden fields
        skipDisabledFields: true,
        // What class name to apply to the 'errorContainer'
        errorClass: "inp-error",
        // Filter method to find element to apply error class
        errorContainer: function (e) {

            return e.parent().find(".err_container");
        },
        // Filter method to find element which reskins the current element
        reskinContainer: function (e) {
            return e;
        },
        //Before form-submit hook
        beforeSubmit: function(e, result) {
            console.log(result);
            console.log(e);
            return result;
        },
        //tracking method
        track: $.noop,
        //whether to show prompts
        showPrompt: true,
        //prompt method,
        prompt: function(element, text, opts) {
            if($.type($.notify) === 'function') {
                if(!opts) opts = {color: 'red'};
                $.notify(element, text, opts);
            }
        }
    };

//option object creator inheriting from globals
    function CustomOptions(opts) {
        $.extend(true, this, opts);



    }
    CustomOptions.prototype = globalOptions;

    /* ===================================== *
     * Base Class
     * ===================================== */

    var BaseClass = Class.extend({
        name: "Class",
        toString: function() {
            return (this.type ? this.type + ": ":'') +
                (this.name ? this.name + ": ":'');
        },
        log: function() {
            if(!globalOptions.debug) return;
            log.apply(this, Utils.appendArg(arguments, this.toString()));
        },
        warn: function() {
            warn.apply(this, Utils.appendArg(arguments, this.toString()));
        },
        info: function() {
            info.apply(this, Utils.appendArg(arguments, this.toString()));
        },
        bind: function(name) {
            var prop = this[name];
            if(prop && $.isFunction(prop))
                this[name] = Utils.bind(prop,this);
        },
        bindAll: function() {
            for(var propName in this)
                this.bind(propName);
        },
        //enforce asynchronicity
        nextTick: function(fn, args, ms) {
            var _this = this;
            return window.setTimeout(function() {
                fn.apply(_this, args);
            }, ms || 0);
        }
    });
// the Rule class will store all state relating to
// the user definition, all rule state from the DOM
// will be passes into the function inside an
// instance of a RuleExecution

    var Rule = BaseClass.extend({

        init: function(name, userObj){
            this.name = name;

            if(!$.isPlainObject(userObj))
                return this.warn("rule definition must be a function or an object");

            this.type = userObj.__ruleType;

            //construct user obj inheriting parent
            this.extendInterface(userObj.extend);
            //does not inherit
            if(!this.userObj) this.userObj = {};
            //clone object to keep a canonical version intact
            $.extend(this.userObj, userObj);
            //infer 'fn' property
            this.buildFn();
            //rule is ready to be used
            this.ready = this.fn !== undefined;
        },

        extendInterface: function(parentName) {

            if(!parentName || typeof parentName !== 'string')
                return;

            //circular dependancy check - not extending itself or any of it's parents
            var p, name = parentName, names = [];
            while(name) {
                if(name === this.name)
                    return this.error("Rule already extends '%s'", name);
                p = ruleManager.getRawRule(name);
                name = p ? p.extend : null;
            }
            //extend using another validator -> validator name
            var parentRule = ruleManager.getRule(parentName);
            if(!parentRule)
                return this.warn("Rule missing '%s'", name);

            this.parent = parentRule;

            //type check
            if(!(parentRule instanceof Rule))
                return this.error("Cannot extend: '"+otherName+"' invalid type");

            this.userObj = Utils.create(parentRule.userObj);
            this.userObj.parent = parentRule.userObj;
        },

        buildFn: function() {
            //handle object.fn
            if($.isFunction(this.userObj.fn)) {

                //createe ref on the rule
                this.fn = this.userObj.fn;

                //handle object.regexp
            } else if($.type(this.userObj.regex) === "regexp") {

                //build regex function
                this.fn = (function(regex) {
                    return function(r) {
                        var re = new RegExp(regex);
                        if(!r.val().match(re))
                            return r.message || "Invalid Format";
                        return true;
                    };

                })(this.userObj.regex);

            } else {
                return this.error("Rule has no function");
            }
        },

        //the 'this's in these interface mixins
        //refer to the rule 'r' object
        defaultInterface: {
            log: log,
            warn: warn,
            ajax: function(userOpts) {
                ajaxHelper(userOpts, this);
            }
        },

        defaultFieldInterface: {
            val: function() {
                return this.field.val.apply(this.field,arguments);
            }
        },

        defaultGroupInterface: {
            val: function(id, newVal) {
                var field = this.field(id);
                if(field) return newVal === undefined ? field.val() : field.val(newVal);
            },
            field: function(id) {
                var elems = $.grep(this._exec.members, function(exec) {
                    return exec.id === id;
                });

                var elem = elems.length ? elems[0].element.domElem : null;

                if(!elem)
                    this.warn("Cannot find group element with id: '" + id + "'");
                return elem;
            },
            fields: function() {
                return $().add($.map(this._exec.members, function(exec) {
                    return exec.element.domElem;
                }));
            }
        },

        //build public ruleInterface the 'r' rule object
        buildInterface: function(exec) {
            var objs = [];

            objs.push({});
            //user object has lowest precedence!
            objs.push(this.userObj);
            objs.push(this.defaultInterface);
            if(this.type === 'field') {
                objs.push(this.defaultFieldInterface);
                objs.push({ field: exec.element.domElem });
            }
            if(this.type === 'group')
                objs.push(this.defaultGroupInterface);

            objs.push({
                prompt: exec.element.options.prompt,
                form:  exec.element.form.domElem,
                callback: exec.callback,
                args: exec.args,
                _exec: exec
            });

            return $.extend.apply(this,objs);
        }
    });

    /* ===================================== *
     * Rules Manager (Plugin Wide)
     * ===================================== */

    var ruleManager = null;
    (function() {

        //regex parser - with pre 'one(1,2),three.scope(6,7),five)'
        var parseString = function(str) {

            var chars = str.split(""),
                rule, rules = [],
                c, m, depth = 0;

            //replace argument commas with semi-colons
            // TODO allow escaping of '(' ')' ','
            for(var i = 0, l = chars.length; i<l; ++i) {
                c = chars[i];
                if(c === '(') depth++;
                if(c === ')') depth--;
                if(depth > 1) return null;
                if(c === ',' && depth === 1) chars[i] = ";";
            }

            //bracket check
            if(depth !== 0) return null;

            //convert string in format: "name.scope#id(args...)" to object
            $.each(chars.join('').split(','), function(i, rule) {
                //regex doc:      NAME  . SCOPE   # ID      ( PARAM;PARAM* )
                m = rule.match(/^(\w+)(\.(\w+))?(\#(\w+))?(\(([^;\)]+(\;[^;\)]+)*)\))?$/);
                if(!m) return warn("Invalid validate attribute: " + str);
                rule = {};
                rule.name = m[1];
                if(m[3]) rule.scope = m[3];
                if(m[5]) rule.id = m[5];
                rule.args = m[7] ? m[7].split(';') : [];
                rules.push(rule);
            });
            return rules;
        };

        var parseStringMemo = Utils.memoize(parseString);

        //privates
        var rawRules = {},
            builtRules = {};

        var addRules = function(type,obj) {
            //check format, insert type
            for(var name in obj){
                if(rawRules[name])
                    warn("validator '%s' already exists", name);

                //functions get auto-objectified
                if($.isFunction(obj[name]))
                    obj[name] = { fn: obj[name] };
                //
                obj[name].__ruleType = type;
            }

            //deep extend rules by obj
            $.extend(true, rawRules, obj);
        };

        //public
        var addFieldRules = function(obj) {
            addRules('field', obj);
        };

        var addGroupRules = function(obj) {
            addRules('group', obj);
        };

        var updateRules = function(obj) {

            var data = {};
            //check format, insert type
            for(var name in obj) {

                if(rawRules[name])
                    data[name] = obj[name];
                else
                    warn("cannot update validator '%s' doesn't exist yet", name);

                //rebuild
                if(builtRules[name])
                    delete builtRules[name];
            }

            $.extend(true, rawRules, data);
        };

        var getRawRule = function(name) {
            return rawRules[name];
        };

        var getRule = function(name) {
            var r = builtRules[name],
                obj = rawRules[name];

            if(!obj)
                warn("Missing rule: " + name);
            else if(!r)
                r = builtRules[name] = new Rule(name, obj);

            return r;
        };

        //extract an objectified version of the "data-validate" attribute
        var parseAttribute = function(element) {
            var attrName = element.form.options.validateAttribute,
                attr = element.domElem.attr(attrName);
            if(!attr) return null;
            return parseStringMemo(attr);
        };

        //add a rule property to the above object
        var parseElement = function(element) {

            var required = false,
                type = null,
                attrResults = null,
                results = [];

            if(element.type !== 'ValidationField')
                return warn("Cannot get rules from invalid type");

            if(!element.domElem)
                return results;

            attrResults = this.parseAttribute(element);

            if(!attrResults || !attrResults.length)
                return results;

            //add rule instances
            $.each(attrResults, function(i, result) {
                //special required case
                if(/required/.test(result.name))
                    required = true;

                result.rule = getRule(result.name);

                if(result.rule)
                    results.push(result);
            });

            results.required = required;
            return results;
        };

        //public interface
        ruleManager = {
            addFieldRules: addFieldRules,
            addGroupRules: addGroupRules,
            getRule: getRule,
            getRawRule: getRawRule,
            parseString: parseString,
            parseAttribute: parseAttribute,
            parseElement: parseElement
        };

    }());


    var ValidationForm = null;
    (function() {

        /* ===================================== *
         * Element Super Class
         * ===================================== */

        var ValidationElement = BaseClass.extend({

            type: "ValidationElement",
            init: function(domElem) {

                if(!domElem || !domElem.length)
                    throw "Missing Element";

                this.domElem = domElem;
                this.bindAll();
                this.name = this.domElem.attr('name') ||
                this.domElem.attr('id') ||
                guid();
                this.execution = null;

                if(domElem.data('verify'))
                    return false;

                domElem.data('verify',this);
                return true;
            },

            equals: function(that) {
                var e1, e2;

                if( this.domElem )
                    e1 = this.domElem;
                else
                    return false;

                if( that.jquery )
                    e2 = that;
                else if( that instanceof ValidationElement && that.domElem )
                    e2 = that.domElem;

                if(e1 && e2)
                    return e1.equals(e2);

                return false;
            }

        });

        /* ===================================== *
         * Field Wrapper
         * ===================================== */

        var ValidationField = ValidationElement.extend({

            //class variables
            type: "ValidationField",
            init: function(domElem, form) {

                this._super(domElem);

                //instance variables
                this.form = form;
                this.options = form.options;
                this.groups = form.groups;
                this.ruleNames = null;
                this.touched = false;
            },

            //for use with $(field).validate(callback);
            validate: function(callback) {
                if(!callback) callback = $.noop;

                var exec = new FieldExecution(this);

                exec.execute().done(function() {
                    callback(true);
                }).fail(function() {
                    callback(false);
                });
                return;
            },

            update: function() {
                this.rules = ruleManager.parseElement(this);

                //manage this field within shared groups
                for(var i = 0; i < this.rules.length; ++i) {
                    var r = this.rules[i];
                    //skip uninitialised and field rules
                    if(!r.rule) continue;
                    if(r.rule.type !== 'group') continue;
                    //shared groups map
                    if(!this.groups[r.name])
                        this.groups[r.name] = {};
                    //calculate scope
                    var scope = r.scope || 'default';
                    if(!this.groups[r.name][scope])
                        this.groups[r.name][scope] = new TypedSet(ValidationField);
                    //add self to group
                    this.groups[r.name][scope].add(this);
                }

            },

            handleResult: function(exec) {

                var opts = this.options,
                    reskinElem = opts.reskinContainer(this.domElem);

                if(!reskinElem || !reskinElem.length)
                    return this.warn("No reskin element found. Check 'reskinContainer' option.");

                //handle first error
                // if(!exec.success &&
                //    exec.parent.type === 'FormExecution' &&
                //    !exec.parent.handledError) {
                //   exec.parent.handledError = true;
                //   this.scrollFocus(reskinElem);
                // }

                //show prompt
                if(opts.showPrompt)
                    opts.prompt(reskinElem, exec.response);

                //toggle error classes
                var container = opts.errorContainer(reskinElem);
                if(container && container.length)
                    container.toggleClass(opts.errorClass, !exec.success);

                //track event
                this.options.track(
                    'Validate',
                    [this.form.name,this.name].join(' '),
                    exec.success ? 'Valid' : exec.response ? '"'+exec.response+'"' : 'Silent Fail'
                );
            },

            //listening for 'validate' event
            scrollFocus: function(reskinElem) {

                var callback = $.noop;
                if(this.options.focusFirstField)
                    callback = function() {
                        reskinElem.focus();
                    };

                if (this.options.scroll)
                    reskinElem.verifyScrollView(callback);
                else if(this.options.focusFirstField)
                    field.focus();
            }

        });

        /* ===================================== *
         * Form Wrapper
         * ===================================== */

        ValidationForm = ValidationElement.extend({

            /* ===================================== *
             * Instance variables
             * ===================================== */
            type: "ValidationForm",

            init: function(domElem, options) {
                //sanity checks
                this._super(domElem);

                if(!domElem.is("form"))
                    throw "Must be a form";

                this.options = new CustomOptions(options);

                this.fields = new TypedSet(ValidationField);
                this.groups = {};
                this.fieldByName = {};
                this.invalidFields = {};
                this.fieldHistory = {};
                this.submitResult = undefined;
                this.submitPending = false;
                this.cache = {
                    ruleNames: {},
                    ajax: { loading: {}, loaded: {} }
                };

                $(document).ready(this.domReady);
            },

            extendOptions: function(opts) {
                $.extend(true, this.options, opts);
            },

            domReady: function() {
                this.bindEvents();
                this.updateFields();
                this.log("bound to " + this.fields.size() + " elems");
            },

            bindEvents: function() {
                this.domElem
                    .on("keyup.jqv", "input", this.onKeyup)
                    .on("blur.jqv", "input[type=text]:not(.hasDatepicker),input:not([type].hasDatepicker)", this.onValidate)
                    .on("change.jqv", "input[type=text].hasDatepicker,select,[type=checkbox],[type=radio]", this.onValidate)
                    .on("submit.jqv", this.onSubmit)
                    .trigger("initialised.jqv");
            },

            unbindEvents: function() {
                this.domElem.off(".jqv");
            },

            updateFields: function() {
                var sel = "["+this.options.validateAttribute+"]";
                this.domElem.find(sel).each(this.updateField);
            },

            //creates new validation elements
            //adds them to the form
            updateField: function(i, domElem) {
                if(i.jquery !== undefined) domElem = i;
                if(domElem.jquery === undefined)
                    domElem = $(domElem);

                var fieldSelector = "input:not([type=hidden]),select,textarea",
                    field, fieldElem;

                if(!domElem.is(fieldSelector))
                    return this.warn("Validators will not work on container elements ("+domElem.prop('tagName')+"). Please use INPUT, SELECT or TEXTAREA.");

                fieldElem = domElem;

                field = this.fields.find(fieldElem);

                if(!field) {
                    field = new ValidationField(fieldElem, this);
                    this.fields.add(field);
                }

                field.update();

                return field;
            },

            /* ===================================== *
             * Event Handlers
             * ===================================== */

            onSubmit: function(event) {

                var submitForm = false;

                if(this.submitPending)
                    this.warn("pending...");

                //no result -> begin
                if(!this.submitPending &&
                    this.submitResult === undefined) {

                    this.submitPending = true;
                    this.validate(this.doSubmit);

                    //have result
                } else if (this.submitResult !== undefined) {
                    submitForm = this.options.beforeSubmit.call(this.domElem, event, this.submitResult);
                }

                if(!submitForm) event.preventDefault();
                return submitForm;
            },

            doSubmit: function(success) {
                this.log('doSubmit', success);
                this.submitPending = false;
                this.submitResult = success;
                this.domElem.submit(); //trigger onSubmit, though with a result
                this.submitResult = undefined;
            },

            onKeyup: function(event) {
                if(this.options.hideErrorOnChange)
                    this.options.prompt($(event.currentTarget), null);
            },

            //user triggered validate field event
            onValidate: function(event) {
                var domElem = $(event.currentTarget);
                var field = domElem.data('verify') || this.updateField(domElem);
                field.log("validate");
                field.validate($.noop);
            },

            /* ===================================== *
             * Validate Form
             * ===================================== */

            validate: function(callback) {
                if(!callback) callback = $.noop;

                this.updateFields();

                var exec = new FormExecution(this);

                exec.execute().done(function() {
                    callback(true);
                }).fail(function() {
                    callback(false);
                });
                return;
            }
        });

    })();
// only exposing two classes
    var FormExecution = null,
        FieldExecution = null;

//instantiated inside private scope
    (function() {

        var STATUS = {
            NOT_STARTED: 0,
            RUNNING: 1,
            COMPLETE: 2
        };

        //super class
        //set in private scope
        var Execution = BaseClass.extend({

            type: "Execution",

            init: function(element, parent) {
                //corresponding <Form|Field>Element class

                this.element = element;
                if(element) {
                    this.prevExec = element.execution;
                    element.execution = this;
                    this.options = this.element.options;
                    this.domElem = element.domElem;
                }
                //parent Execution class
                this.parent = parent;
                this.name = '#'+guid();
                this.status = STATUS.NOT_STARTED;
                this.bindAll();

                //deferred object
                this.d = this.restrictDeferred();
                this.d.done(this.executePassed);
                this.d.fail(this.executeFailed);

            },

            isPending: function() {
                return this.prevExec && this.prevExec.status !== STATUS.COMPLETE;
            },

            toString: function() {
                return this._super() + "[" + this.element.name + (!this.rule ? "" : ":" + this.rule.name) + "] ";
            },

            //execute in sequence, stop on fail
            serialize: function(objs) {

                var fns = this.mapExecutables(objs);

                if(!$.isArray(fns) || fns.length === 0)
                    return this.resolve();

                var pipeline = fns[0](),
                    i = 1, l = fns.length;

                this.log("SERIALIZE", l);

                if(!pipeline || !pipeline.pipe)
                    throw "Invalid Deferred Object";

                for(;i < l;i++)
                    pipeline = pipeline.pipe(fns[i]);

                //link pipeline
                pipeline.done(this.resolve).fail(this.reject);

                return this.d.promise();
            },

            //execute all at once,
            parallelize: function(objs) {

                var fns = this.mapExecutables(objs);

                var _this = this,
                    n = 0, i = 0, l = fns.length,
                    rejected = false;

                this.log("PARALLELIZE", l);

                if(!$.isArray(fns) || l === 0)
                    return this.resolve();

                function pass(response) {
                    n++;
                    if(n === l) _this.resolve(response);
                }

                function fail(response) {
                    if(rejected) return;
                    rejected = true;
                    _this.reject(response);
                }

                //execute all at once
                for(; i<l; ++i ) {
                    var dd = fns[i]();
                    if(!dd || !dd.done || !dd.fail)
                        throw "Invalid Deferred Object";
                    dd.done(pass).fail(fail);
                }

                return this.d.promise();
            },

            mapExecutables: function(objs) {
                return $.map(objs, function(o) {
                    if($.isFunction(o)) return o;
                    if($.isFunction(o.execute)) return o.execute;
                    throw "Invalid executable";
                });
            },

            linkPass: function(that) {
                that.d.done(this.resolve);
            },
            linkFail: function(that) {
                that.d.fail(this.reject);
            },
            link: function(that) {
                this.linkPass(that);
                this.linkFail(that);
            },

            execute: function() {

                var p = this.parent,
                    ps = [];
                while(p) {
                    ps.unshift(p.name);
                    p = p.parent;
                }
                var gap = "(" + ps.join(' < ') + ")";

                this.log(this.parent ? gap : '', 'executing...');
                this.status = STATUS.RUNNING;
                if(this.domElem)
                    this.domElem.triggerHandler("validating");

                return true;
            },

            executePassed: function(response) {
                this.success = true;
                this.response = this.filterResponse(response);
                this.executed();
            },
            executeFailed: function(response) {
                this.success = false;
                this.response = this.filterResponse(response);
                this.executed();
            },

            executed: function() {
                this.status = STATUS.COMPLETE;

                this.log((this.success ? 'Passed' : 'Failed') + ": " + this.response);

                if(this.domElem)
                    this.domElem.triggerHandler("validated", this.success);
            },

            //resolves or rejects the execution's deferred object 'd'
            resolve: function(response) {
                return this.resolveOrReject(true, response);
            },
            reject: function(response) {
                return this.resolveOrReject(false, response);
            },
            resolveOrReject: function(success, response) {
                var fn = success ? '__resolve' : '__reject';
                if(!this.d || !this.d[fn]) throw "Invalid Deferred Object";
                this.nextTick(this.d[fn], [response], 0);
                return this.d.promise();
            },
            filterResponse: function(response) {
                if(typeof response === 'string')
                    return response;
                return null;
            },
            restrictDeferred: function(d) {
                if(!d) d = $.Deferred();
                d.__reject = d.reject;
                d.__resolve = d.resolve;
                d.reject = d.resolve = function() {
                    console.error("Use execution.resolve|reject()");
                };
                return d;
            }

        });

        //set in plugin scope
        FormExecution = Execution.extend({
            type: "FormExecution",

            init: function(form) {
                this._super(form);
                this.ajaxs = [];

                //prepare child executables
                this.children = this.element.fields.map($.proxy(function(f) {
                    return new FieldExecution(f, this);
                }, this));
            },

            execute: function() {
                this._super();

                if(this.isPending()) {
                    this.warn("pending... (waiting for %s)", this.prevExec.name);
                    return this.reject();
                }

                this.log("exec fields #" + this.children.length);
                return this.parallelize(this.children);
            }

        });

        //set in plugin scope
        FieldExecution = Execution.extend({
            type: "FieldExecution",

            init: function(field, parent) {
                this._super(field, parent);
                if(parent instanceof FormExecution)
                    this.formExecution = parent;
                field.touched = true;
                this.children = [];
            },

            execute: function() {
                this._super();

                if(this.isPending()) {
                    this.warn("pending... (waiting for %s)", this.prevExec.name);
                    return this.reject();
                }

                //execute rules
                var ruleParams = ruleManager.parseElement(this.element);

                //skip check
                this.skip = this.skipValidations(ruleParams);
                if(this.skip)
                    return this.resolve();

                //ready
                this.children = $.map(ruleParams, $.proxy(function(r) {
                    if(r.rule.type === 'group')
                        return new GroupRuleExecution(r, this);
                    else
                        return new RuleExecution(r, this);
                }, this));

                // this.log("exec rules #%s", this.children.length);
                return this.serialize(this.children);
            },

            skipValidations: function(ruleParams) {

                //no rules
                if(ruleParams.length === 0) {
                    this.log("skip (no validators)");
                    return true;
                }

                //not required
                if(!ruleParams.required && !$.trim(this.domElem.val())) {
                    this.warn("skip (not required)");
                    return true;
                }

                //custom-form-elements.js hidden fields
                if(this.options.skipHiddenFields &&
                    this.options.reskinContainer(this.domElem).is(':hidden')) {
                    this.log("skip (hidden)");
                    return true;
                }

                //skip disabled
                if(this.options.skipDisabledFields &&
                    this.domElem.is('[disabled]')) {
                    this.log("skip (disabled)");
                    return true;
                }

                return false;
            },

            executed: function() {
                this._super();

                //pass error to element
                var i, exec = this,
                    children = this.children;
                for(i = 0; i < children.length; ++i)
                    if(children[i].success === false) {
                        exec = children[i];
                        break;
                    }
                this.element.handleResult(exec);
            }

        });

        //set in private scope
        var RuleExecution = Execution.extend({
            type: "RuleExecution",

            init: function(ruleParamObj, parent) {
                this._super(null, parent);

                this.rule = ruleParamObj.rule;
                this.args = ruleParamObj.args;
                this.element = this.parent.element;
                this.options = this.element.options;
                this.rObj = {};
            },

            //the function that gets called when
            //rules return or callback
            callback: function(response) {
                clearTimeout(this.t);
                this.callbackCount++;
                this.log(this.rule.name + " (cb:" + this.callbackCount + "): " + response);

                if(this.callbackCount > 1)
                    return;

                if(response === undefined)
                    this.warn("Undefined result");

                //success
                if(response === true)
                    this.resolve(response);
                else
                    this.reject(response);

            },

            timeout: function() {
                this.warn("timeout!");
                this.callback("Timeout");
            },

            execute: function() {
                this._super();
                this.callbackCount = 0;

                //sanity checks
                if(!this.element || !this.rule.ready) {
                    this.warn(this.element ? 'not  ready.' : 'invalid parent.');
                    return this.resolve();
                }

                this.t = setTimeout(this.timeout, 10000);
                this.r = this.rule.buildInterface(this);
                //finally execute validator

                var response;
                try {
                    response = this.rule.fn(this.r);
                } catch(e) {
                    response = true;
                    console.error("Error caught in validation rule: '" + this.rule.name +
                    "', skipping.\nERROR: " + e.toString() + "\nSTACK:" + e.stack);
                }

                //used return statement
                if(response !== undefined)
                    this.nextTick(this.callback, [response]);

                return this.d.promise();
            }

        });

        var GroupRuleExecution = RuleExecution.extend({

            type: "GroupRuleExecution",

            init: function(ruleParamObj, parent) {
                this._super(ruleParamObj, parent);
                this.groupName = ruleParamObj.name;
                this.id = ruleParamObj.id;
                this.scope = ruleParamObj.scope || 'default';
                this.group = this.element.groups[this.groupName][this.scope];
                if(!this.group)
                    throw "Missing Group Set";
                if(this.group.size() === 1)
                    this.warn("Group only has 1 field. Consider a field rule.");
            },

            execute: function() {

                var sharedExec = this.group.exec,
                    parentExec = this.parent,
                    originExec = parentExec && parentExec.parent,
                    groupOrigin = originExec instanceof GroupRuleExecution,
                    fieldOrigin = !originExec,
                    formOrigin = originExec instanceof FormExecution,
                    _this = this, i, j, field, exec, child,
                    isMember = false;

                if(!sharedExec || sharedExec.status === STATUS.COMPLETE) {
                    this.log("MASTER");
                    this.members = [this];
                    this.executeGroup = this._super;
                    sharedExec = this.group.exec = this;

                    if(formOrigin)
                        sharedExec.linkFail(originExec);

                } else {

                    this.members = sharedExec.members;
                    for(i = 0; i < this.members.length; ++i)
                        if(this.element === this.members[i].element)
                            isMember = true;

                    if(isMember) {
                        //start a new execution - reject old
                        this.log("ALREADY A MEMBER OF %s", sharedExec.name);
                        this.reject();
                        return;

                    } else {
                        this.log("SLAVE TO %s", sharedExec.name);
                        this.members.push(this);
                        this.link(sharedExec);
                        if(this.parent) sharedExec.linkFail(this.parent);
                    }
                }

                if(fieldOrigin)
                    for(i = 0; i < this.group.size(); ++i) {
                        field = this.group.get(i);

                        if(this.element === field)
                            continue;

                        this.log("CHECK:", field.name);
                        //let the user make their way onto
                        // the field first - silent fail!
                        if(!field.touched) {
                            this.log("FIELD NOT READY: ", field.name);
                            return this.reject();
                        }

                        exec = field.execution;
                        //silent fail unfinished
                        if(exec && exec.status !== STATUS.COMPLETE)
                            exec.reject();

                        this.log("STARTING ", field.name);
                        exec = new FieldExecution(field, this);
                        exec.execute();
                    }

                var groupSize = this.group.size(),
                    execSize = sharedExec.members.length;

                if(groupSize === execSize&&
                    sharedExec.status === STATUS.NOT_STARTED) {
                    sharedExec.log("RUN");
                    sharedExec.executeGroup();
                } else {
                    this.log("WAIT (" + execSize + "/" + groupSize + ")");
                }

                return this.d.promise();
            },

            filterResponse: function(response) {
                if(!response || !this.members.length)
                    return this._super(response);

                var isObj = $.isPlainObject(response),
                    isStr = (typeof response === 'string');

                if(isStr && this === this.group.exec) return response;
                if(isObj && response[this.id]) return response[this.id];

                return null;
            }

        });

    })();
    $.fn.validate = function(callback) {
        var validator = $(this).data('verify');
        if(validator)
            validator.validate(callback);
        else
            warn("element does not have verifyjs attached");
    };

    $.fn.validate.version = VERSION;

    $.fn.verify = function(userOptions) {
        return this.each(function() {

            //get existing form class this element
            var form = $.verify.forms.find($(this));

            //unbind and destroy form
            if(userOptions === false || userOptions === "destroy") {
                if(form) {
                    form.unbindEvents();
                    $.verify.forms.remove(form);
                }
                return;
            }

            Utils.checkOptions(userOptions);
            if(form) {
                form.extendOptions(userOptions);
                form.updateFields();
            } else {
                form = new ValidationForm($(this), userOptions);
                $.verify.forms.add(form);
            }

        });
    };

    $.verify = function(options) {
        Utils.checkOptions(options);
        $.extend(globalOptions, options);
    };

    $.extend($.verify, {
        version: VERSION,
        updateRules: ruleManager.updateRules,
        addRules: ruleManager.addFieldRules,
        addFieldRules: ruleManager.addFieldRules,
        addGroupRules: ruleManager.addGroupRules,
        log: info,
        warn: warn,
        defaults: globalOptions,
        globals: globalOptions,
        utils: Utils,
        forms: new TypedSet(ValidationForm, [], "FormSet"),
        _hidden: {
            ruleManager: ruleManager
        }
    });

    /* ===================================== *
     * Auto attach on DOM ready
     * ===================================== */

    $(function() {
        if(globalOptions.autoInit)
            $("form").filter(function() {
                return $(this).find("[" + globalOptions.validateAttribute + "]").length > 0;
            }).verify();
    });

    log("Auto attach validate plugin added.");


   $(document).ready((function($) {

        if($.verify === undefined) {
            window.alert("Please include verify.js before each rule file");
            return;
        }
        
        function check_three(v){
            var c = v.length, i = 0, max3l = 0;
            for (i; i < c; i++) {
    			if (i < (c-2)) {
    				L = v.charAt(i).toUpperCase();
    				p = i + 1;
    				if (p>0) {
    					if (L == v.charAt(p).toUpperCase()) {
    						pp = p + 1;
    						if (pp>0) {
    							if (L == v.charAt(pp).toUpperCase()) {
    								max3l = 1;
    							}
    						}
    					}
    				}	
    			} else {
    				for (j = c; j >= i; j--) {
    					L = v.charAt(j).toUpperCase();
    					p = j - 1;
    					if (p>0) {
    						if (L == v.charAt(p).toUpperCase()) {
    							pp = p - 1;
    							if (pp>0) {
    								if (L == v.charAt(pp).toUpperCase()) {
    									max3l = 1;
    								}
    							}
    						}
    					}
    				};
    			}
    			
    		}
    		if (max3l == 1) {
    			return false;
    		} else {
    		    return true;
    		}
        }

        $.verify.addFieldRules({
            /* Regex validators
             * - at plugin load, 'regex' will be transformed into validator function 'fn' which uses 'message'
             */

            currency: {
                regex: /^\-?\$?\d{1,2}(,?\d{3})*(\.\d+)?$/,
                message: "Invalid monetary value"
            },

            email: function(r) {
                var v = r.val();
                reg_=/@/;
                
                if(!v.match(reg_)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    return app.router.locale == 'uk' ? "В e-mail отстутствует символ \'@\'":"В e-mail відсутній символ \'@\'"
                }
                
                /*if(!v.match(/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    return app.router.locale == 'uk' ? "Email введено не вірно":"Email введен не правильно"
                }*/
                
                if(!v.match(/^[\w\.\d-_]+@[a-z\.-_]+\.[a-z]{2,4}$/i)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == 'uk' ? "В e-mail адресі допускаються тільки латинські літери, цифри та символи \'.\', \'_\', \'-\'":"В e-mail адресе допускаются только латинские буквы, цифры и символы \'.\',\'_\',\'-\'"
                }
                
                
                return true;
            },


            url: {
                regex: /^https?:\/\/[\-A-Za-z0-9+&@#\/%?=~_|!:,.;]*[\-A-Za-z0-9+&@#\/%=~_|]/,
                message: "Invalid URL"
            },
            alphanumeric: {
                regex: /^[0-9A-Za-z]+$/,
                message: "Use digits and letters only"
            },
            street_number: {
                regex: /^\d+[A-Za-z]?(-\d+)?[A-Za-z]?$/,
                message: "Street Number only"
            },
            number: {
                regex: /^\d+$/,
                message: "Use digits only"
            },
            numberSpace: {
                regex: /^[\d\ ]+$/,
                message: "Use digits and spaces only"
            },
            postcode: {
                regex: /^\d{4}$/,
                message: "Invalid postcode"
            },
            date: {
                fn: function(r) {
                    if($.verify.utils.parseDate(r.val()))
                        return true;
                    return r.message;
                },
                message: "Invalid date"
            },
            required: {

                fn: function(r) {

                    return r.requiredField(r, r.field);
                },

                requiredField: function(r, field) {
                    var v = field.val();

                    switch (field.prop("type")) {
                        case "radio":
                        case "checkbox":
                            var name = field.attr("name");
                            var group = field.data('fieldGroup');

                            if(!group) {
                                group = r.form.find("input[name='" + name + "']");
                                field.data('fieldGroup', group);
                            }

                            if (group.is(":checked"))
                                break;

                            if (group.size() === 1){
                                console.log('r.messages.single');
                                console.log(r.messages.single);
                                return r.messages.single;
                            }


                            return r.messages.multiple;

                        default:
                            if (! $.trim(v)){
                                console.log('r.messages.all');
                                console.log(r.messages.all);
                                console.log('fails2');
                                //$(".submit-form-button").attr('disabled','disabled');
                                //$(".submit-form-button").addClass('btn-disabled');
                                $("#check_datas").attr('disabled','disabled');
                                return r.messages.all;
                            }

                            break;
                    }
                    return true;
                },
                messages: {
                    "all": app.router.locale == "uk"?"Це поле обов’язкове":"Поле является обязательным для заполнения",
                    "multiple": app.router.locale == "uk"?"Це поле обов’язкове":"Поле является обязательным для заполнения",
                    "single": app.router.locale == "uk"?"Це поле обов’язкове":"Поле является обязательным для заполнения"
                }
            },
            regex: {
                fn: function(r) {
                    var re;
                    try {
                        var str = r.args[0];
                        re = new RegExp(str);
                    } catch(error) {
                        r.warn("Invalid regex: " + str);
                        return true;
                    }

                    if(!r.val().match(re))
                        return r.args[1] || r.message;
                    return true;
                },
                message: "Invalid format"
            },
            //an alias
            pattern: {
                extend: 'regex'
            },
            asyncTest: function(r) {

                r.prompt(r.field, "Please wait...");
                setTimeout(function() {
                    r.callback();
                },2000);
            },
            name: function(r) {
                var v = r.val();
                
                if(!check_three(v)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='firstname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Не допускається більше 2-х однакових букв":"Не допускается более 2-х одинаковых букв";
                }
                
                if(!v.match(/^\+?[а-яіїєґ\s',А-ЯІЇЄҐ\s']+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='firstname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Введіть текст кирилицею":"Введите текст кириллическими буквами";
                }


                if(v.replace(/\s/g,"").length < 3){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='firstname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Мінімальна кількість букв повинна бути не менше 3":"Минимальное количеств букв должно быть не меньше 3";
                }

                if(v.replace(/\s/g,"").length > 20){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='firstname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Максимальна кількість букв не може перевищувати 20":"Максимальное количество букв не может превышать 20";
                }

                return true;

            },
            surname: function(r) {
                var v = r.val();
                
                if(!check_three(v)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='lastname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Не допускається більше 2-х однакових букв":"Не допускается более 2-х одинаковых букв";
                }
                
                if(!v.match(/^\+?[а-яіїєґ\s',А-ЯІЇЄҐ\s']+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='lastname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Введіть текст кирилицею":"Введите текст кириллическими буквами";
                }


                if(v.replace(/\s/g,"").length < 3){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='lastname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Мінімальна кількість букв повинна бути не менше 3":"Минимальное количеств букв должно быть не меньше 3";
                }

                if(v.replace(/\s/g,"").length > 20){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='lastname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Максимальна кількість букв не може перевищувати 20":"Максимальное количество букв не может превышать 20";
                }

                return true;
            },
            patronymic: function(r) {
                var v = r.val();
                
                if(!check_three(v)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='secondname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Не допускається більше 2-х однакових букв":"Не допускается более 2-х одинаковых букв";
                }
                
                if(!v.match(/^\+?[а-яіїєґ\s',А-ЯІЇЄҐ\s']+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='secondname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Введіть текст кирилицею":"Введите текст кириллическими буквами";
                }


                if(v.replace(/\s/g,"").length < 3){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='secondname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Мінімальна кількість букв повинна бути не менше 3":"Минимальное количеств букв должно быть не меньше 3";
                }

                if(v.replace(/\s/g,"").length > 20){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    /*$('html, body').animate({
                    	scrollTop: $("input[name='secondname']").offset().top
                    }, 500);*/
                    return app.router.locale == "uk"?"Максимальна кількість букв не може перевищувати 20":"Максимальное количество букв не может превышать 20";
                }

                return true;
            },
            description_of_the_problem: function(r) {
                var v = r.val();
                if(!v.match(/^\+?[а-яіїєґ,А-ЯІЇЄҐ,' ']+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Введіть текст кирилицею":"Введите текст кириллическими буквами";
                }


                if(v.replace(/\s/g,"").length < 2){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Мінімальна кількість букв повинна бути не менше 2":"Минимальное количеств букв должно быть не меньше 2";
                }

                if(v.replace(/\s/g,"").length > 30){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Максимальна кількість букв не може перевищувати 30":"Максимальное количество букв не может превышать 30";
                }



                return true;
            },
            phone: function(r) {
                r.val(r.val().replace(/\D/g,''));
                var v = r.val();
                if(!v.match(/^\+?[\d\s]+$/))
                    return app.router.locale == "uk"?"Дозволяються тільки цифри та пробіл":"Только цифры или пробел";
                if(v.match(/^\+/))
                    return true; //allow all international
                if(!v.match(/^0/))
                    return app.router.locale == "uk"?"Номер повинен починатися з 0":"Номер должен начинаться с 0";
                if(!v.match(/^(039|050|063|066|067|068|091|092|093|094|095|096|097|098|099)/))
                    return app.router.locale == "uk"?"Такого мобільного оператора на територіх України не існує":"Такого мобильного оператора на территории Украины не существует";
                if(v.replace(/\s/g,"").length !== 10)
                    return app.router.locale == "uk"?"Повинно бути 10 цифр":"Должно быть 10 цифр";
                return true;
            },
            phone_part: function(r) {
                r.val(r.val().replace(/\D/g,''));
                var v = r.val();
                if(!v.match(/^\+?[\d\s]+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Дозволяються тільки цифри та пробіл":"Только цифры или пробел";
                }

                //if(v.match(/^\+/))
                //    return true; //allow all international
                //if(!v.match(/^0/)){
                //    console.log('fails2');
                //    $(".submit-form-button").attr('disabled','disabled');
                //    $(".submit-form-button").addClass('btn-disabled');
                //    return "Number must start with 0";
                //}

                /*if(v.replace(/\s/g,"").length !== 7){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    return app.router.locale == "uk"?"Повинно бути 7 цифр":"Должно быть 7 цифр";
                }*/
                
                if(v.replace(/\s/g,"").length < 5){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Недостатня кількість цифр у номері телефону":"Недостаточное количество цифр в номере телефона";
                }
                
                if(v.replace(/\s/g,"").length > 7){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Занадто велика кількість цифр в номері телефону":"Слишком большое количество цифр в номере телефона";
                }

                return true;
            },
            phonecode: function(r) {
                r.val(r.val().replace(/\D/g,''));
                var v = r.val();
                if(!v.match(/^\+?[\d\s]+$/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Дозволяються тільки цифри та пробіл":"Только цифры или пробел";
                }

                if(!v.match(/^0/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    return app.router.locale == "uk"?"Номер повинен починатися з 0":"Номер должен начинаться с 0";
                }

                /*if(v.replace(/\s/g,"").length !== 3)
                    return app.router.locale == "uk"?"Повинно бути 3 цифр":"Должно быть 3 цифр";*/
                
                if(v.replace(/\s/g,"").length > 4)
                    return app.router.locale == "uk"?"Повинно бути максимум 4 цифри":"Должно быть максимум 4 цифры";
                if(v.replace(/\s/g,"").length < 3)
                    return app.router.locale == "uk"?"Повинно бути мінімум 3 цифри":"Должно быть минимум 3 цифры";
                
                return true;
            },
            vin: function(r) {
                r.val(r.val().toUpperCase());
                var v = r.val();
                if(!v.match(/^UU/) && !v.match(/^VF1/) && !v.match(/^X7L/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?'VIN повинен починатись з символів "UU", "VF1" або "X7L"':'VIN должен начинаться с символов "UU", "VF1" или "X7L"';
                }

                if(v.length !== 17){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?"Повинно бути 17 цифр":"Должно быть 17 цифр";
                }

                if(v.match(/O/) && !v.match(/Q/) && !v.match(/I/)){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == "uk"?'В полі VIN недопускаються символи "O", "I", "Q"':'В поле VIN недопукаются символы "O", "I", "Q';
                }

                return true;
            },
            size: function(r){
                var v = r.val(), exactOrLower = r.args[0], upper = r.args[1];
                if(exactOrLower !== undefined && upper === undefined) {
                    var exact = parseInt(exactOrLower, 10);
                    if(r.val().length !== exact)
                        return  "Must be "+exact+" characters";
                } else if(exactOrLower !== undefined && upper !== undefined) {
                    var lower = parseInt(exactOrLower, 10);
                    upper = parseInt(upper, 10);
                    if(v.length < lower || upper < v.length)
                        return "Must be between "+lower+" and "+upper+" characters";
                } else {
                    r.warn("size validator parameter error on field: " + r.field.attr('name'));
                }

                return true;
            },
            min: function(r) {
                var v = r.val(), min = parseInt(r.args[0], 10);
                if(v.length < min)
                    return "Must be at least " + min + " characters";
                return true;
            },
            max: function(r) {
                var v = r.val(), max = parseInt(r.args[0], 10);
                if(v.length > max)
                    return "Must be at most " + max + " characters";
                return true;
            },

            decimal: function(r) {
                var vStr = r.val(),
                    places = r.args[0] ? parseInt(r.args[0], 10) : 2;

                if(!vStr.match(/^\d+(,\d{3})*(\.\d+)?$/))
                    return "Invalid decimal value";

                var v = parseFloat(vStr.replace(/[^\d\.]/g,'')),
                    factor = Math.pow(10,places);

                v = (Math.round(v*factor)/factor);
                r.field.val(v);

                return true;
            },
            minVal: function(r) {
                var v = parseFloat(r.val().replace(/[^\d\.]/g,'')),
                    suffix = r.args[1] || '',
                    min = parseFloat(r.args[0]);
                if(v < min)
                    return "Must be greater than " + min + suffix;
                return true;
            },
            maxVal: function(r) {
                var v = parseFloat(r.val().replace(/[^\d\.]/g,'')),
                    suffix = r.args[1] || '',
                    max = parseFloat(r.args[0]);
                if(v > max)
                    return "Must be less than " + max + suffix;
                return true;
            },
            rangeVal: function(r) {
                var v = parseFloat(r.val().replace(/[^\d\.]/g,'')),
                    prefix = r.args[2] || '',
                    suffix = r.args[3] || '',
                    min = parseFloat(r.args[0]),
                    max = parseFloat(r.args[1]);
                if(v > max || v < min)
                    return "Must be between " + prefix + min + suffix + "\nand " + prefix + max + suffix;
                return true;
            },

            agreement: function(r){
                if(!r.field.is(":checked")){
                    console.log('fails2');
                    //$(".submit-form-button").attr('disabled','disabled');
                    //$(".submit-form-button").addClass('btn-disabled');
                    $("#check_datas").attr('disabled','disabled');
                    return app.router.locale == 'uk'?"Це поле обов’язкове":"Поле является обязательным";
                }

                return true;
            },
            minAge: function(r){
                var age = parseInt(r.args[0],10);
                if(!age || isNaN(age)) {
                    console.log("WARNING: Invalid Age Param: " + age);
                    return true;
                }
                var currDate = new Date();
                var minDate = new Date();
                minDate.setFullYear(minDate.getFullYear() - age);
                var fieldDate = $.verify.utils.parseDate(r.val());

                if(fieldDate === "Invalid Date")
                    return "Invalid Date";
                if(fieldDate > minDate)
                    return "You must be at least " + age;
                return true;
            }
        });

        // Group validation rules
        $.verify.addGroupRules({

            dateRange: function(r) {
                var start = r.field("start"),
                    end = r.field("end");

                if(start.length === 0 || end.length === 0) {
                    r.warn("Missing dateRange fields, skipping...");
                    return true;
                }

                var startDate = $.verify.utils.parseDate(start.val());
                if(!startDate)
                    return "Invalid Start Date";

                var endDate = $.verify.utils.parseDate(end.val());
                if(!endDate)
                    return "Invalid End Date";

                if(startDate >= endDate)
                    return "Start Date must come before End Date";

                return true;
            },

            requiredAll: {
                extend: 'required',
                fn: function(r) {
                    var size = r.fields().length,
                        message,
                        passes = [], fails = [];
                    r.fields().each(function(i, field) {
                        message = r.requiredField(r, field);
                        if(message === true) {
                            //$(".submit-form-button").removeAttr('disabled');
                            //$(".submit-form-button").removeClass('btn-disabled');
                            $("#check_datas").removeAttr('disabled')
                            passes.push(field);
                        }
                        else {
                            fails.push({ field: field, message:message });
                        }
                    });

                    if(passes.length > 0 && fails.length > 0) {
                        $.each(fails, function(i, f) {
                            r.prompt(f.field, f.message);
                        });
                        return false;
                    }
                    return true;
                }
            }

        });

    }));
}(window,document));

app.view.wfn['characteristics'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/characteristics.html';
    
    app.view.beforeWidget(widget);           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function updatePrices(data, prices) {
        for(var key in data.items) {

            if(data.items[key].version_code && prices[data.items[key].version_code]) {
                data.items[key].cost = prices[data.items[key].version_code];
            } else if(!data.items[key].cost) {
                delete data.items[key];
                continue;
            }

            for(var key2 in data.items[key].engine) {
                if(data.items[key].engine[key2].version_code && prices[data.items[key].engine[key2].version_code]) {
                    data.items[key].engine[key2].cost = prices[data.items[key].engine[key2].version_code];
                } else if(!data.items[key].cost) {
                    delete data.items[key].engine[key2];
                }
            }
        }
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        data.t = app.view.getTranslationsFromData(data);

        $.getJSON(
            app.config.frontend_app_api_url + '/db/price',
            {
                //"fields": '',
                "where": {
                    locale: app.config.frontend_app_locale,
                    "domain_id": app.config.frontend_app_domain_id,
                }
            },
            function (priceData) {

                var _priceData = {};
                for(var key in priceData.items) {
                    _priceData[(priceData.items[key]['model'] + ' - ' + priceData.items[key]['version_code'])] = priceData.items[key]['price'];
                }

                updatePrices(data, _priceData);
                loadTemplate(data);
            });
        //var params = {
        //    "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
        //    "per-page": data.count,
        //    "sort": sort,
        //    "where": {
        //        locale: app.config.frontend_app_locale,
        //        "domain_id": app.config.frontend_app_domain_id,
        //    }
        //
        //};
        //
        //$.getJSON(
        //    app.config.frontend_app_api_url + '/db/articles',
        //    params,
        //    function (articlesData) {
        //        //process domain articles
        //        if (articlesData.items[0]) {
        //            $.extend(data, articlesData);
        //
        //            $.each(data.items, function (key, val) {
        //
        //                data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
        //                data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
        //            });
        //
        //            data.urlToNews = app.view.helper.preffix + '/news';
        //
        //            loadTemplate(data);
        //        }
        //
        //        //get default articles
        //        if (!articlesData.items[0]) {
        //            params.where.domain_id = app.config.frontend_app_default_domain_id;
        //
        //            $.getJSON(
        //                app.config.frontend_app_api_url + '/db/articles',
        //                params,
        //                function (articlesData) {
        //                    $.extend(data, articlesData);
        //
        //                    $.each(data.items, function (key, val) {
        //
        //                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
        //                        data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
        //                    });
        //
        //                    data.urlToNews = app.view.helper.preffix + '/news';
        //
        //                    loadTemplate(data);
        //                });
        //        }
        //    });
        //loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['engine'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/engine.html';
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
        
        var data = widget;        
        
        loadTemplate(data);
    }

    function loadTemplate(data) {
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
});


app.view.wfn['feat-box'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/feat-box.html';
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
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['files'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/files.html';
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

        var data = widget;
        data.header_1 = 'Все, что вы хотите знать о Renault SANDERO';

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['iframes'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/iframes.html';
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
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['promo-slider'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/promo-slider.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
    
});


app.view.wfn['vehicle-promotions'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/objects/vehicle-promotions.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function updatePrices(data, prices) {
        for(var key in data.items) {

            if(data.items[key].version_code && prices[data.items[key].version_code]) {
                data.items[key].start_price = prices[data.items[key].version_code];
            } else if(!data.items[key].start_price) {
                delete data.items[key];
            }

        }
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.viewAllUrl = app.view.helper.preffix + '/models';

        $.getJSON(
            app.config.frontend_app_api_url + '/db/price', {
                //"fields": '',
                "where": {
                    locale: app.config.frontend_app_locale,
                    "domain_id": app.config.frontend_app_domain_id,
                }
            }, function (priceData) {

                var _priceData = {};
                for(var key in priceData.items) {
                    _priceData[(priceData.items[key]['model'] + ' - ' + priceData.items[key]['version_code'])] = priceData.items[key]['price'];
                }

                updatePrices(data, _priceData);
                loadTemplate(data);
            });
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        
        var v = app.config.frontend_app_files_midified[template];
//test


        var params = {
            "fields": 'title,price',
            "per-page": data.count,

            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
            app.config.frontend_app_api_url + '/db/model',
            params,
            function (articlesData) {
                //process domain articles
                console.log('articlesData');
                console.log(articlesData);
                console.log('articlesData');
                if (articlesData.items[0]) {
                    //$.extend(data, articlesData);
                    //
                    //$.each(data.items, function (key, val) {
                    //
                    //    data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                    //    data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                    //});
                    //
                    //data.urlToNews = app.view.helper.preffix + '/news';
                    //
                    //loadTemplate(data);
                }

                //get default articles
                if (!articlesData.items[0]) {
                    //params.where.domain_id = app.config.frontend_app_default_domain_id;
                    //
                    //$.getJSON(
                    //    app.config.frontend_app_api_url + '/db/articles',
                    //    params,
                    //    function (articlesData) {
                    //        $.extend(data, articlesData);
                    //
                    //        $.each(data.items, function (key, val) {
                    //
                    //            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                    //            data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                    //        });
                    //
                    //        data.urlToNews = app.view.helper.preffix + '/news';
                    //
                    //        loadTemplate(data);
                    //    });
                }
            });
        //test
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);

        app.view.afterWidget(widget);
    }

});


app.view.wfn['credit'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/credit.html';           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['dealer-quest-box'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/dealer-quest-box.html';          

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        $.each(data.items, function (key, val) {
            if ('@frontend' == val.host) {
                data.items[key].viewUrl = app.view.helper.preffix + val.url;
            }
        });
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['info-menu'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/info-menu.html';

    run();

    function run() {
        app.logger.func('run');

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        $.each(data.items, function (key, val) {
            if ('@frontend' == val.host) {
                data.items[key].viewUrl = app.view.helper.preffix + val.url;
            }
                        
            if ('/' + app.router.controller + '/' + app.router.slug == val.url.trim()) {            
                data.items[key].itemLiClass = 'active';
                data.items[key].itemLiClassMobile = 'active';
            }

        });

        data.items = data.items.filter(function (v) {
            return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
        });

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['anchor'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/anchor.html';

    run();

    function run() {
        app.logger.func('run');

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        

        

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});

app.view.wfn['breadcrumbs'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/arrays/tables/breadcrumbs.html';

    run();

    function run() {
        app.logger.func('run');

        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        data.home = app.config.frontend_app_frontend_url;
        data.home_title = app.router.locale='ru'?'Главная':'Головна';
        switch (app.router.locale){
            case 'ru':
                data.home_title = 'Главная';
                break;
            default:
                data.home_title = 'Головна';
                break;
        }
        

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});

app.view.wfn['book-a-test-drive-form'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/book-a-test-drive-form.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        //data.datapicker = getDataPickerFromData(data);

        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        /*$.getScript(
         app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
         );*/
        window.contact_info = data.contact_info;
        loadSalons(data);
        loadFormData(data);
    }

    function getDataPickerFromData(data) {
        if ($.isEmptyObject(data.datapicker)) {
            return {};
        }
        var datapicker = {};

        $.each(data.datapicker, function (k, v) {
            if (v.key && v.value) {
                datapicker[v.key] = v.value;
            }
        });

        return datapicker;
    }

    function mapInitialize(conf) {
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: true,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var SearchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
                {
                    types: ['(cities)'],
                    componentRestrictions: {'country': 'ua'}
                }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace().name)) {
                var town = autocomplete.getPlace().name;
                app.logger.var(autocomplete.getPlace());
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();

            bounds.extend(place.geometry.location);


            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        app.view.allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            //hide services
            if (v.service_id && !v.salon_id) {
                return;
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            app.view.allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                markerClick.call(this, marker1, app.view.allMarkers);
                if($(document).width() < 960){
                    var dest = $('.mapitembox').offset().top;
                $('html, body').animate({scrollTop: dest}, 'slow');
                }
            });
            
                
        })

        var markerCluster = new MarkerClusterer(map1, app.view.allMarkers, {
          maxZoom: 7,
          gridSize: 50,
          styles: [{
            height: 46,
            width: 43,
            anchor: [0,0],
            textColor: '#fff',
            textSize: 18,
            url: '/img/ico-marker4.png'
          }]
        });

    }
    function loadFormData(data) {
        $.ajax({
            url: 'http://dealers.renault.ua/ru/site/test_drive',
            success: function (html) {
                //dealers
                var dealersScript = $(html).filter('#all').children().children().children().filter('div.inner-content').children().children()[4];
                //app.logger.var($(dealersScript).html());
                eval($(dealersScript).html());
                data.dealers = window.dealers;

                //vehicle models
                data.models = [];
                $(html).filter('#all').children().children().children().filter('div.inner-content').children().children().filter('div.form-item-renault').children().filter('form#form ').find('select.form.required.modelOfInterest.width462').children().each(function (k, v) {
                    //app.logger.var($(v).val())
                    data.models.push($.trim($(v).val()));
                });

                var item = null;
                var items = [];

                $.each(data.models, function (k, v) {
                    item = {'title': v, 'img_src': ""};
                    $.each(data.items, function (k2, v2) {
                        if (v == v2.title) {
                            item = v2;
                        }
                    });
                    items.push(item);
                });

                data.items = items;

                loadTemplate(data);

            }
        });

    }

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        app.view.afterWidget(widget);

        //mapInitialize(data);
        app.view.tmpMapData = data;

        loadGoogleMaps();

        setTimeout(function () {
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

            setDefaultValues();
            setPredefinedValues(data);
        }, 3000);
    }

    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;

        mapInitialize(app.view.tmpMapData);
    }

    function loadGoogleMaps() {
        if (true != app.view.gMapsLoaded) {
            app.logger.func('loadGoogleMaps');
            $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
    }

    /**
     * @param variable
     * @returns {*}
     */
    window.getQueryVariable = function(variable) {
        var query = document.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++)
        {
            var pair = vars[i].split("=");
            if (pair[0] == variable)
            {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    };

    function setDefaultValues() {
        var d = new Date();

        var curr_date = d.getDate() + 1;
        var curr_month = d.getMonth() + 1;
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var curr_year = d.getFullYear();
        
        var utm =[]; // utm marks
        if (getQueryVariable('utm_source')){
            utm.push(getQueryVariable('utm_source'));
        }
        if (getQueryVariable('utm_medium')){
            utm.push(getQueryVariable('utm_medium'));
        }
        if (getQueryVariable('utm_term')){
            utm.push(getQueryVariable('utm_term'));
        }
        if (getQueryVariable('utm_content')){
            utm.push(getQueryVariable('utm_content'));
        }
        if (getQueryVariable('utm_campaign')){
            utm.push(getQueryVariable('utm_campaign'));
        }
        
        window.testDriveData = {
            'selected_id': '', //dealer
            'form_id': '3',
            'punkt[5]': '', //Модель*
            'salon_id': '',
            'field-firstname': '2',
            'field-secondname': '3',
            'field-lastname': '1',
            'punkt[1]': '', //firstname
            'punkt[2]': '', //secondname
            'punkt[3]': '', //lastname
            'massive': 'Array',
            'punkt[4]': '', //bd
            'field-email': '6',
            'punkt[6]': '', //email
            'field-phone': '7',
            'punkt[7]': '', //phone
            'punkt[8]': curr_date + '.' + curr_month + '.' + curr_year, //Желаемая дата тест-драйва
            'punkt[9]': '9:00-10:00', //Желаемое время тест-драйва
            //'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            //'punkt[11]': 'true', //Я хочу получать информацию от Renault
            'phone_subscr': 'false',
            'email_subscr': 'false',
            'check_data': 'true',
            'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR',
            'utm_links': utm,
        };

    }

    function loadTranslation(data) {

        switch (app.router.locale) {
            case "uk":
                data.Select_this_dealer = "Вибрати цього диллера";
                data.select_date_and_time = "Оберіть дату та час";
                data.Select_date = "оберіть дату";
                data.select_time = "оберіть час";
                data.optional_confirmation = "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime = "Обрати ці дату та час";

                data.accost = "Звертання";
                data.Mr = "Пан";
                data.Ms = "Пані";
                data.name = "Ім'я";
                data.surname = "Прізвище";
                data.patronymic = "По батькові";
                data.E_Mail = "E-Mail";
                data.post_code = "Індекс";
                data.settlement = "Населений пункт";
                data.house_number = "Номер будинку";
                data.VIN = "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone = "Мобільний телефон";
                data.region = "Область";
                data.street = "Вулиця";
                data.number_of_apartments = "Номер квартири";
                data.The_state_reg_number = "Державний реєстраційний номер";
                data.your_question = "Ваше питання";

                data.Subscribe_to_news = "Підписатися на новини Renault";
                data.consent = "Даю свою згоду на обробку зазначених мною вище персональних даних";


                break
            case "ru":
                data.Select_this_dealer = "Выбрать этого диллера";
                data.select_date_and_time = "Выберите дату и время";
                data.Select_date = "выберите дату";
                data.select_time = "выберите время";
                data.optional_confirmation = "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime = "Выбрать эти дату и время";

                data.accost = "Обращение";
                data.Mr = "Г-н";
                data.Ms = "Г-жа";
                data.name = "Имя";
                data.surname = "Фамилия";
                data.patronymic = "Отчество";
                data.E_Mail = "E-Mail";
                data.post_code = "Индекс";
                data.settlement = "Неселённый пункт";
                data.house_number = "Номер дома";
                data.VIN = "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone = "Мобильный телефон";
                data.region = "Область";
                data.street = "Улица";
                data.number_of_apartments = "Номер квартиры";
                data.The_state_reg_number = "Государственный регистрационный номер";
                data.your_question = "Ваш вопрос";

                data.Subscribe_to_news = "Подписаться на новости RENAULT";
                data.consent = "Даю своё согласие на обработку указанных мною выше личных данных";

                break
            default:
                break
        }

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (salonData) {
                    app.view.dealers = salonData;

                    loadServices(data);
                });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (serviceData) {

                    $.each(app.view.dealers, function (k, v) {
                        $.each(serviceData, function (k2, v2) {
                            if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                                $.extend(app.view.dealers[k], v2);
                                serviceData[k2] = false;
                            }
                        });
                    });

                    $.each(serviceData, function (k, v) {
                        if (!$.isEmptyObject(v)) {
                            app.view.dealers.push(v);
                        }
                    });

                    data.dealers = getPreparedDealers(app.view.dealers);

                    //loadTemplate(data);
                });
    }


    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var html = '<h4>"' + dealer['dealers_name_' + locale] + '"</h4>'
                + '<h5>'+window.contact_info+'</h5>'
                + '<p>' + dealer['city_name_' + locale]
                + '<br>' + dealer['salon_adres_' + locale] + '</p>'
                + '<h5>салон</h5>'
                + '<p>' + dealer['salon_phone'] + '</p>';
        //+ '<h5>СТО</h5>'
        //+ '<p>(044) 495-88-20</p>';

        $('.map-wrapper').addClass('mw-dealer-selected');

        $('.mapitembox').html(html);
        window.testDriveData['selected_id'] = dealer['dealers_id'];
        $('#test-drive-form-select-this-dealer-button').show();
        $('#test-drive-form-select-this-dealer-button').click(function () {
            selectThisDealerButtonClick(dealer);
        });

    }

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    function getDealer(dealers_id) {

    }

    function setPredefinedValues(data) {
        var model, salon_id, service_id, city_id, dealer_id;

        model = $.urlParams('get', 'model'); //'Dokker VAN'
        salon_id = $.urlParams('get', 'salon_id'); //4
        service_id = $.urlParams('get', 'service_id'); //35
        city_id = $.urlParams('get', 'city_id'); //9

        if (app.config.frontend_app_dealer_id) {
            dealer_id = app.config.frontend_app_dealer_id;
        }

        if (model) {
            $('.vehicle-categories').find('.vehicle-in-category-name-inner').each(function (k, v) {
                if (model.toLowerCase() == $(this).html().toLowerCase()) {
                    modelClick.call($(this).parent().parent());
                }
            });
        }

        if (city_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (city_id == v.dealer.city_id) {
                    app.logger.text('predefined city: ' + v.dealer.city_name_ua);

                    $('#test-drive-form-map-input-search').val(v.dealer.city_name_ua);
                    data.center = v.dealer.gps_x + ',' + v.dealer.gps_y;
                    data.zoom = 11;
                    mapInitialize(data);

                    return;
                }
            });
        }

        if (salon_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (salon_id == v.dealer.salon_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (service_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (service_id == v.dealer.service_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (dealer_id && dealer_id > 0) {
            $('#test-drive-form-map-input-search').parent().hide();

            $.each(app.view.allMarkers, function (k, v) {
                if (dealer_id == v.dealer.dealers_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                }
                else {
                    v.visible = false;
                }
            });
        }
    }

    function markerClick(marker1, allMarkers) {
        app.logger.var(marker1.dealer);
        //app.logger.var('marker1.dealer.salon_id');
        //app.logger.var(marker1.dealer.salon_id);
        //app.logger.var('marker1.dealer.salon_id');
        window.testDriveData.salon_id = marker1.dealer.salon_id;
        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');

        //app.logger.var(allMarkers);
    }
});

app.view.wfn['corporate-sales'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/corporate-sales.html';

    run();

    function run() {
        app.logger.func('run');
        console.log('test');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        setDefaultValues();
        loadTemplate(data);
    }


    function loadTemplate(data) {
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

    function setDefaultValues(){
        window.corporateSaleData = {
            'firstname':'',
            'secondname':'',
            'lastname':'',
            'email':'',
            'phone':'',
            'message':''


        };
    }

});


app.view.wfn['service'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/service.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        app.view.contact_info = data.contact_info;
       loadCars(data);


        //http://dealers.renault.ua/platformAjaxRequest.php
        //
        //$.getScript(
        //        app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
        //        );


        //loadTemplate(data);
    }

    function getDataPickerFromData(data) {
        if ($.isEmptyObject(data.datapicker)) {
            return {};
        }
        var datapicker = {};

        $.each(data.datapicker, function (k, v) {
            if (v.key && v.value) {
                datapicker[v.key] = v.value;
            }
        });

        return datapicker;
    }

    function mapInitialize(conf) {
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: true,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var SearchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
            {
                types: ['(cities)'],
                componentRestrictions: {'country': 'ua'}
            }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace().name)) {
                var town = autocomplete.getPlace().name;
                app.logger.var(autocomplete.getPlace());
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();

            bounds.extend(place.geometry.location);


            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        app.view.allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            //hide services
            if (v.salon_id && !v.service_id) {
                return;
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            app.view.allMarkers.push(marker1);
            //
            google.maps.event.addListener(marker1, 'click', function () {
                markerClick.call(this, marker1, app.view.allMarkers);
                if($(document).width() < 960){
                    var dest = $('.mapitembox').offset().top;
                $('html, body').animate({scrollTop: dest}, 'slow');
                }
            });
        })
        
        var markerCluster = new MarkerClusterer(map1, app.view.allMarkers, {
          maxZoom: 7,
          gridSize: 50,
          styles: [{
            height: 46,
            width: 43,
            anchor: [0,0],
            textColor: '#fff',
            textSize: 18,
            url: '/img/ico-marker4.png'
          }]
        });

    }
    //function loadFormData(data) {
    //    $.ajax({
    //        url: 'http://dealers.renault.ua/ru/site/test_drive',
    //        success: function (html) {
    //            //dealers
    //            var dealersScript = $(html).filter('#all').children().children().children().filter('div.inner-content').children().children()[4];
    //            //app.logger.var($(dealersScript).html());
    //            eval($(dealersScript).html());
    //            data.dealers = window.dealers;
    //
    //            //vehicle models
    //            data.models = [];
    //            $(html).filter('#all').children().children().children().filter('div.inner-content').children().children().filter('div.form-item-renault').children().filter('form#form ').find('select.form.required.modelOfInterest.width462').children().each(function (k, v) {
    //                //app.logger.var($(v).val())
    //                data.models.push($.trim($(v).val()));
    //            });
    //
    //            var item = null;
    //            var items = [];
    //
    //            $.each(data.models, function (k, v) {
    //                item = {'title': v, 'img_src': ""};
    //                $.each(data.items, function (k2, v2) {
    //                    if (v == v2.title) {
    //                        item = v2;
    //                    }
    //                });
    //                items.push(item);
    //            });
    //
    //            data.items = items;
    //
    //
    //        }
    //    });
    //
    //}

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data), data);
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        app.view.afterWidget(widget);

        //mapInitialize(data);                        
        app.view.tmpMapData = data;
        
        loadGoogleMaps();
        //$('.select-dealer-content').slideUp();
        //$('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

        setTimeout(function() {
            setDefaultValues();
            setPredefinedValues(data);
        }, 3000); 
        
    }
    
    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;
        
        mapInitialize(app.view.tmpMapData);
    }

    function loadGoogleMaps() {
        if ( true != app.view.gMapsLoaded) {
                app.logger.func('loadGoogleMaps');
                $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
    }

    function setDefaultValues() {
        var d = new Date();

        var curr_date = d.getDate() + 1;
        var curr_month = d.getMonth() + 1;
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var curr_year = d.getFullYear();

        /**
         * @param variable
         * @returns {*}
         */
        window.getQueryVariable = function(variable) {
            var query = document.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++)
            {
                var pair = vars[i].split("=");
                if (pair[0] == variable)
                {
                    return decodeURIComponent(pair[1]);
                }
            }
            return null;
        };

        window.testDriveData = {
            'selected_id': '', //dealer
            'form_id': '5',
            'check_data': 'true',
            'punkt[5]': '', //Модель*
            'field-firstname': '2',
            'field-secondname': '3',
            'field-lastname': '1',
            'punkt[1]': '', //firstname
            'punkt[2]': '', //secondname
            'punkt[3]': '', //lastname
            'massive': 'Array',

            'field-email': '6',
            'punkt[6]': '', //email
            'field-phone': '7',
            'punkt[7]': '', //phone
            'punkt[12]': curr_date + '.' + curr_month + '.' + curr_year, //Желаемая дата тест-драйва
            'punkt[14]': '9:00-10:00', //Желаемое время тест-драйва
'punkt[11]': '18:00-20:00', //Желаемое время тест-драйва

            'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[18]': 'true', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[19]': '1', //Даю своё согласие на обработку указанных мной выше персональных данных*,
            'punkt[20]': '1', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[17]': 'true', //Даю своё согласие на обработку указанных мной выше персональных данных*


            'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR'
        };

    }

    function loadTranslation(data) {

        switch (app.router.locale) {
            case "uk":
                data.Select_this_dealer = "Вибрати цього диллера";
                data.select_date_and_time = "Оберіть дату та час";
                data.Select_date = "оберіть дату";
                data.select_time = "оберіть час";
                data.optional_confirmation = "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime = "Обрати ці дату та час";

                data.accost = "Звертання";
                data.Mr = "Пан";
                data.Ms = "Пані";
                data.name = "Ім'я";
                data.surname = "Прізвище";
                data.patronymic = "По батькові";
                data.E_Mail = "E-Mail";
                data.post_code = "Індекс";
                data.settlement = "Населений пункт";
                data.house_number = "Номер будинку";
                data.VIN = "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone = "Мобільний телефон";
                data.region = "Область";
                data.street = "Вулиця";
                data.number_of_apartments = "Номер квартири";
                data.The_state_reg_number = "Державний реєстраційний номер";
                data.your_question = "Ваше питання";

                data.Subscribe_to_news = "Підписатися на новини Renault";
                data.consent = "Даю свою згоду на обробку зазначених мною вище персональних даних";


                break
            case "ru":
                data.Select_this_dealer = "Выбрать этого диллера";
                data.select_date_and_time = "Выберите дату и время";
                data.Select_date = "выберите дату";
                data.select_time = "выберите время";
                data.optional_confirmation = "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime = "Выбрать эти дату и время";

                data.accost = "Обращение";
                data.Mr = "Г-н";
                data.Ms = "Г-жа";
                data.name = "Имя";
                data.surname = "Фамилия";
                data.patronymic = "Отчество";
                data.E_Mail = "E-Mail";
                data.post_code = "Индекс";
                data.settlement = "Неселённый пункт";
                data.house_number = "Номер дома";
                data.VIN = "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone = "Мобильный телефон";
                data.region = "Область";
                data.street = "Улица";
                data.number_of_apartments = "Номер квартиры";
                data.The_state_reg_number = "Государственный регистрационный номер";
                data.your_question = "Ваш вопрос";

                data.Subscribe_to_news = "Подписаться на новости RENAULT";
                data.consent = "Даю своё согласие на обработку указанных мною выше личных данных";

                break
            default:
                break
        }

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (salonData) {
                app.view.dealers = salonData;

                loadServices(data);
            });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (serviceData) {

                $.each(app.view.dealers, function (k, v) {
                    $.each(serviceData, function (k2, v2) {
                        if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                            $.extend(app.view.dealers[k], v2);
                            serviceData[k2] = false;
                        }
                    });
                });

                $.each(serviceData, function (k, v) {
                    if (!$.isEmptyObject(v)) {
                        app.view.dealers.push(v);
                    }
                });

                data.dealers = getPreparedDealers(app.view.dealers);
                loadTemplate(data);

                //loadFormData(data);
                //loadTemplate(data);
            });
    }


    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var html = '<h4>"' + dealer['dealers_name_' + locale] + '"</h4>'
            + '<h5>' + app.view.contact_info + '</h5>'
            + '<p>' + dealer['city_name_' + locale]
            + '<br>' + dealer['service_adres_' + locale] + '</p>'
            + '<h5>СТО</h5>'
            + '<p>' + dealer['service_phone'] + '</p>';
        //+ '<h5>СТО</h5>'
        //+ '<p>(044) 495-88-20</p>';

        $('.map-wrapper').addClass('mw-dealer-selected');

        $('.mapitembox').html(html);

        window.testDriveData['selected_id'] = dealer['dealers_id'];

        $('#service-form-select-this-dealer-button').show();
        $('#service-form-select-this-dealer-button').click(function () {
             selectThisDealerButtonClick(dealer);
        });

    }

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }



    function setPredefinedValues(data) {        
        var model, salon_id, service_id, city_id, dealer_id;

        model = $.urlParams('get', 'model'); //'Dokker'
        salon_id = $.urlParams('get', 'salon_id'); //51
        service_id = $.urlParams('get', 'service_id'); //44
        city_id = $.urlParams('get', 'city_id'); //9

        if (app.config.frontend_app_dealer_id) {
            dealer_id = app.config.frontend_app_dealer_id;
        }

        if (model) {
            $("select[id=\"model\"]").val(model);
            $("select[id=\"model\"]").parent().find(".jq-selectbox__select-text").html(model);
            
            /*$('.vehicle-categories').find('.vehicle-in-category-name-inner').each(function (k, v) {
                if (model.toLowerCase() == $(this).html().toLowerCase()) {
                    modelClick.call($(this).parent().parent());
                }
            });*/
        }

        if (city_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (city_id == v.dealer.city_id) {
                    app.logger.text('predefined city: ' + v.dealer.city_name_ua);

                    $('#test-drive-form-map-input-search').val(v.dealer.city_name_ua);
                    data.center = v.dealer.gps_x + ',' + v.dealer.gps_y;
                    data.zoom = 11;
                    mapInitialize(data);

                    return;
                }
            });
        }

        if (salon_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (salon_id == v.dealer.salon_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (service_id) {                        
            $.each(app.view.allMarkers, function (k, v) {                
                if (service_id == v.dealer.service_id) {                    
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (dealer_id && dealer_id > 0) {
            $('#test-drive-form-map-input-search').parent().hide();

            $.each(app.view.allMarkers, function (k, v) {
                if (dealer_id == v.dealer.dealers_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                }
                else {
                    v.visible = false;
                }
            });
        }
    }

    function markerClick(marker1, allMarkers) {
        app.logger.var(marker1.dealer);

        changeDealerInfo(marker1.dealer);
        window.testDriveData.salon_id = marker1.dealer.salon_id;
        if(allMarkers){
            for (var i = 0; i < allMarkers.length; i++) {
                allMarkers[i].setIcon('/img/ico-marker3.png');
            }
        }


        marker1.setIcon('/img/ico-marker2.png');
        //app.logger.var(allMarkers);
    }

    function loadCars(data) {
        var params = {
            "controller": 'car',
            "action": 'index'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (carData) {
                app.view.models = carData;
                data.models = [];
                $.each(carData, function(k, v){
                    data.models.push(v.car_name);
                });


                loadSalons(data);
            });
    }
});


app.view.wfn['subscribes'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/subscribes.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        window.testDriveData = {};
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['contact'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/contact.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
window.contact_info = data.contact_info;
        $.verify.addFieldRules({
            nameR1: {
                expected: "42",
                message: app.router.locale == "uk" ? "Wasn't 42uk" : "Wasn't 42ru",
                fn: function (r) {
                    return r.val() === r.expected ? true : r.message;
                }
            }
        });



        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        /*$.getScript(
         app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
         );*/
        loadSalons(data);


        //loadFormData(data);
    }



    function mapInitialize(conf) {
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: true,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var searchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
                {
                    types: ['(cities)'],
                    componentRestrictions: {'country': 'ua'}
                }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace) && !$.isEmptyObject(autocomplete.getPlace.name)) {
                var town = autocomplete.getPlace.name;
                app.logger.var(autocomplete.getPlace);
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();

            bounds.extend(place.geometry.location);

            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        app.view.allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            app.view.allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                markerClick.call(this, marker1, app.view.allMarkers);
                if($(document).width() < 960){
                    var dest = $('.mapitembox').offset().top;
                $('html, body').animate({scrollTop: dest}, 'slow');
                }
            });
        })
        
        var markerCluster = new MarkerClusterer(map1, app.view.allMarkers, {
          maxZoom: 7,
          gridSize: 50,
          styles: [{
            height: 46,
            width: 43,
            anchor: [0,0],
            textColor: '#fff',
            textSize: 18,
            url: '/img/ico-marker4.png'
          }]
        });

    }
    function loadFormData(data) {
        $.ajax({
            url: 'http://dealers.renault.ua/ru/site/test_drive',
            success: function (html) {
                //dealers
                var dealersScript = $(html).filter('#all').children().children().children().filter('div.inner-content').children().children()[4];
                //app.logger.var($(dealersScript).html());
                eval($(dealersScript).html());
                data.dealers = window.dealers;

                //vehicle models
                data.models = [];
                $(html).filter('#all').children().children().children().filter('div.inner-content').children().children().filter('div.form-item-renault').children().filter('form#form ').find('select.form.required.modelOfInterest.width462').children().each(function (k, v) {
                    //app.logger.var($(v).val())
                    data.models.push($.trim($(v).val()));
                });

                var item = null;
                var items = [];

                $.each(data.models, function (k, v) {
                    item = {'title': v, 'img_src': ""};
                    $.each(data.items, function (k2, v2) {
                        if (v == v2.title) {
                            item = v2;
                        }
                    });
                    items.push(item);
                });

                data.items = items;

                loadTemplate(data);

            }
        });

    }

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        app.view.afterWidget(widget);


        //mapInitialize(data);                        
        app.view.tmpMapData = data;

        loadGoogleMaps();

        setTimeout(function () {
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

            setDefaultValues();
            setPredefinedValues(data)
        }, 3000);

    }

    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;

        mapInitialize(app.view.tmpMapData);
    }

    function loadGoogleMaps() {
        if (true != app.view.gMapsLoaded) {
            app.logger.func('loadGoogleMaps');
            $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
    }

    /**
     * @param variable
     * @returns {*}
     */
    window.getQueryVariable = function(variable) {
        var query = document.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++)
        {
            var pair = vars[i].split("=");
            if (pair[0] == variable)
            {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    };

    function setDefaultValues() {
        window.testDriveData = {
            'selected_id': '', //dealer
            'form_id': '2',
            'field-firstname': '2',
            'field-secondname': '3',
            'field-lastname': '1',
            'punkt[1]': '', //firstname
            'punkt[2]': '', //secondname
            'punkt[3]': '', //lastname

            'field-email': '6',
            'punkt[6]': '', //email
            'field-phone': '7',
            'punkt[7]': '', //phone
            'punkt[8]': '', //Comment

            'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[11]': 'true', //Я хочу получать информацию от Renault
            'punkt[12]': '1',
            'punkt[13]': '1',
            'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR'
        };
    }

    function loadTranslation(data) {

        switch (app.router.locale) {
            case "uk":
                data.Select_this_dealer = "Вибрати цього диллера";
                data.select_date_and_time = "Оберіть дату та час";
                data.Select_date = "оберіть дату";
                data.select_time = "оберіть час";
                data.optional_confirmation = "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime = "Обрати ці дату та час";

                data.accost = "Звертання";
                data.Mr = "Пан";
                data.Ms = "Пані";
                data.name = "Ім'я";
                data.surname = "Прізвище";
                data.patronymic = "По батькові";
                data.E_Mail = "E-Mail";
                data.post_code = "Індекс";
                data.settlement = "Населений пункт";
                data.house_number = "Номер будинку";
                data.VIN = "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone = "Мобільний телефон";
                data.region = "Область";
                data.street = "Вулиця";
                data.number_of_apartments = "Номер квартири";
                data.The_state_reg_number = "Державний реєстраційний номер";
                data.your_question = "Ваше питання";

                data.Subscribe_to_news = "Підписатися на новини Renault";
                data.consent = "Даю свою згоду на обробку зазначених мною вище персональних даних";


                break
            case "ru":
                data.Select_this_dealer = "Выбрать этого диллера";
                data.select_date_and_time = "Выберите дату и время";
                data.Select_date = "выберите дату";
                data.select_time = "выберите время";
                data.optional_confirmation = "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime = "Выбрать эти дату и время";

                data.accost = "Обращение";
                data.Mr = "Г-н";
                data.Ms = "Г-жа";
                data.name = "Имя";
                data.surname = "Фамилия";
                data.patronymic = "Отчество";
                data.E_Mail = "E-Mail";
                data.post_code = "Индекс";
                data.settlement = "Неселённый пункт";
                data.house_number = "Номер дома";
                data.VIN = "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone = "Мобильный телефон";
                data.region = "Область";
                data.street = "Улица";
                data.number_of_apartments = "Номер квартиры";
                data.The_state_reg_number = "Государственный регистрационный номер";
                data.your_question = "Ваш вопрос";

                data.Subscribe_to_news = "Подписаться на новости RENAULT";
                data.consent = "Даю своё согласие на обработку указанных мною выше личных данных";

                break
            default:
                break
        }

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (salonData) {
                    app.view.dealers = salonData;

                    loadServices(data);

                });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (serviceData) {

                    $.each(app.view.dealers, function (k, v) {
                        $.each(serviceData, function (k2, v2) {
                            if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                                $.extend(app.view.dealers[k], v2);
                                serviceData[k2] = false;
                            }
                        });
                    });

                    $.each(serviceData, function (k, v) {
                        if (!$.isEmptyObject(v)) {
                            app.view.dealers.push(v);
                        }
                    });

                    data.dealers = getPreparedDealers(app.view.dealers);

                    loadTemplate(data);
                });
    }


    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var street = '', phone = '', dealerDype = '';

        if (!$.isEmptyObject(dealer['salon_phone'])) {
            phone = dealer['salon_phone'];
            dealerDype = 'салон';
        } else if (!$.isEmptyObject(dealer['service_phone'])) {
            dealerDype = locale == 'ua' ? 'сервіс' : 'сервис';
            phone = dealer['service_phone'];
        }

        if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
            street = dealer['service_adres_' + locale];
        } else if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
            street = dealer['salon_adres_' + locale];
        }

        var html = '<h4>"' + dealer['dealers_name_' + locale] + '"</h4>'
                + '<h5>'+ window.contact_info +'</h5>'
                + '<p>' + dealer['city_name_' + locale]
                + '<br>' + street + '</p>'
                + '<h5>' + dealerDype + '</h5>'
                + '<p>' + phone + '</p>';
        //+ '<h5>СТО</h5>'
        //+ '<p>(044) 495-88-20</p>';

        $('.map-wrapper').addClass('mw-dealer-selected');

        $('.mapitembox').html(html);
        window.testDriveData['selected_id'] = dealer['dealers_id'];
        $('#test-drive-form-select-this-dealer-button').show();
        $('#test-drive-form-select-this-dealer-button').click(function () {
            selectThisDealerButtonClick(dealer);
        });

    }

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    function getDealer(dealers_id) {

    }

    function setPredefinedValues(data) {
        var salon_id, service_id, city_id, dealer_id;

        salon_id = $.urlParams('get', 'salon_id'); //4
        service_id = $.urlParams('get', 'service_id'); //35
        city_id = $.urlParams('get', 'city_id'); //9        

        if (app.config.frontend_app_dealer_id) {
            dealer_id = app.config.frontend_app_dealer_id;
        }

        if (city_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (city_id == v.dealer.city_id) {
                    app.logger.text('predefined city: ' + v.dealer.city_name_ua);

                    $('#test-drive-form-map-input-search').val(v.dealer.city_name_ua);
                    data.center = v.dealer.gps_x + ',' + v.dealer.gps_y;
                    data.zoom = 11;
                    mapInitialize(data);

                    return;
                }
            });
        }

        if (salon_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (salon_id == v.dealer.salon_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (service_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (service_id == v.dealer.service_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (dealer_id && dealer_id > 0) {
            $('#test-drive-form-map-input-search').parent().hide();            

            $.each(app.view.allMarkers, function (k, v) {
                if (dealer_id == v.dealer.dealers_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                }
                else {
                    v.visible = false;
                }
            });            
        }
    }

    function markerClick(marker1, allMarkers) {
        app.logger.var(marker1.dealer);
        window.testDriveData.salon_id = marker1.dealer.salon_id;
        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');
        var formfields = document.getElementById('contactus');

        formfields.classList.remove('hidden');
    }
});


app.view.wfn['contact-form'] = (function () {
    /*** process   ***/


    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/contact-form.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        setDefaultValues();
        loadSalons(data);
        //loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        data.kiev = [];
        $.each(data.dealers, function(key, value) {
            if (value.city_id == '3') {
                data.kiev.push(value);

            }


        });
        data.kiev.name = [];
        $.each(data.kiev, function(key, value){


            switch (app.router.locale){
                case 'ru':
                    data.kiev[key].name = value.dealers_name_ru;
                    break;
                default:
                    data.kiev[key].name = value.dealers_name_ua;
                    break;
            }
        });





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

    function loadSalons(data) {
        var params = {
            "controller": 'dealer',
            "action": 'index',
            "city_id": '3'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (dealersData) {


                app.view.dealers = dealersData;
                data.dealers = app.view.dealers;


                loadTemplate(data);
            });
    }

    //function loadServices(data) {
    //    var params = {
    //        "controller": 'service',
    //        "action": 'index'
    //    };
    //
    //    $.getJSON(
    //        'http://dealers.renault.ua/platformAjaxRequest.php',
    //        params,
    //        function (serviceData) {
    //
    //            $.each(app.view.dealers, function (k, v) {
    //                $.each(serviceData, function (k2, v2) {
    //                    if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
    //                        $.extend(app.view.dealers[k], v2);
    //                        serviceData[k2] = false;
    //                    }
    //                });
    //            });
    //
    //            $.each(serviceData, function (k, v) {
    //                if (!$.isEmptyObject(v)) {
    //                    app.view.dealers.push(v);
    //                }
    //            });
    //
    //            data.dealers = getPreparedDealers(app.view.dealers);
    //            console.log('data.dealers');
    //            console.log(data.dealers);
    //
    //            data.kiev = [];
    //            $.each(data.dealers, function(key, value){
    //                if(value.city_id == '3'){
    //                    data.kiev.push(value);
    //                }
    //
    //            });
    //            console.log(data.kiev);
    //            loadTemplate(data);
    //        });
    //}

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            //var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            //dealers[k].gps_x = gps[0];
            //dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    /**
     * @param variable
     * @returns {*}
     */
    

    function setDefaultValues() {
        window.getQueryVariable = function(variable) {
        var query = document.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++)
        {
            var pair = vars[i].split("=");
            if (pair[0] == variable)
            {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    };
        var d = new Date();

        var curr_date = d.getDate() + 1;
        var curr_month = d.getMonth() + 1;
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var curr_year = d.getFullYear();
        window.testDriveData = {
            'selected_id': '30',
            'punkt[5]': 'Captur',
        'field-lastname':'1',
        'punkt[1]': 'WIFIBAR',
        'field-firstname': '2',
        'punkt[2]':'тест',
        'field-secondname':'3',
        'punkt[3]':'WIFIBAR',
        'massive':'Array',
        'punkt[4]':'WIFIBAR',
        'field-email':'6',
        'punkt[6]':'WIFIBAR',
        'field-phone':'7',
        'code_select':'093',
        'code': '',
            'punkt7':'5012553',
        'punkt[8]':'WIFIBAR',
        'punkt[9]':'WIFIBAR',
        'punkt[10]':'yes',
        'punkt[11]':'true',
        'punkt[12]':'1',
        'punkt[13]':'1',
        'submit-val':'1',
            //'selected_id': '', //dealer
            //'punkt[5]': 'Captur', //Модель*
            //'field-firstname': '2',
            //'field-secondname': '3',
            //'field-lastname': '1',
            //'punkt[1]': 'WIFIBAR', //firstname
            //'punkt[2]': 'WIFIBAR', //secondname
            //'punkt[3]': 'WIFIBAR', //lastname
            //'massive': 'Array',
            //'punkt[4]': 'WIFIBAR', //bd
            //'field-email': '6',
            //'punkt[6]': 'WIFIBAR', //email
            //'field-phone': '7',
            //'punkt7': 'WIFIBAR', //phone
            //'punkt[8]': curr_date + '.' + curr_month + '.' + curr_year, //Желаемая дата тест-драйва
            //'punkt[9]': '9:00-10:00', //Желаемое время тест-драйва
            //'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            //'punkt[11]': 'true', //Я хочу получать информацию от Renault
            //'submit-val': '1',
            'RenaultDealerDomain': location.hostname,
            'CampaignUniqueId': window.getQueryVariable('utm_medium') ? window.getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': window.getQueryVariable('utm_source') ? window.getQueryVariable('utm_source') : 'WIFIBAR'
        };

    }
});


app.view.wfn['financing'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/financing.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        $.verify.addFieldRules({
            nameR1: {
                expected: "42",
                message: app.router.locale == "uk"?"Wasn't 42uk":"Wasn't 42ru",
                fn: function(r) {
                    return r.val() === r.expected ? true : r.message;
                }
            }
        });



        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        /*$.getScript(
                app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
                );*/
        loadCars(data);
       // loadSalons(data);


        //loadFormData(data);
    }



    function mapInitialize(conf) {
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: true,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('test-drive-form-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var searchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
                {
                    types: ['(cities)'],
                    componentRestrictions: {'country': 'ua'}
                }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace) && !$.isEmptyObject(autocomplete.getPlace.name)) {
                var town = autocomplete.getPlace.name;
                app.logger.var(autocomplete.getPlace);
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();

            bounds.extend(place.geometry.location);

            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        app.view.allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            //hide services
            if (v.service_id && !v.salon_id) {
                return;
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            app.view.allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                markerClick.call(this, marker1, app.view.allMarkers);
                if($(document).width() < 960){
                    var dest = $('.mapitembox').offset().top;
                $('html, body').animate({scrollTop: dest}, 'slow');
                }
            });
        })
        
        var markerCluster = new MarkerClusterer(map1, app.view.allMarkers, {
          maxZoom: 7,
          gridSize: 50,
          styles: [{
            height: 46,
            width: 43,
            anchor: [0,0],
            textColor: '#fff',
            textSize: 18,
            url: '/img/ico-marker4.png'
          }]
        });

    }
    function loadFormData(data) {
        $.ajax({
            url: 'http://dealers.renault.ua/ru/site/test_drive',
            success: function (html) {
                //dealers
                var dealersScript = $(html).filter('#all').children().children().children().filter('div.inner-content').children().children()[4];
                //app.logger.var($(dealersScript).html());
                eval($(dealersScript).html());
                data.dealers = window.dealers;

                //vehicle models
                data.models = [];
                $(html).filter('#all').children().children().children().filter('div.inner-content').children().children().filter('div.form-item-renault').children().filter('form#form ').find('select.form.required.modelOfInterest.width462').children().each(function (k, v) {
                    //app.logger.var($(v).val())
                    data.models.push($.trim($(v).val()));
                });

                var item = null;
                var items = [];

                $.each(data.models, function (k, v) {
                    item = {'title': v, 'img_src': ""};
                    $.each(data.items, function (k2, v2) {
                        if (v == v2.title) {
                            item = v2;
                        }
                    });
                    items.push(item);
                });

                data.items = items;

                loadTemplate(data);

            }
        });

    }

    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        
        var v = app.config.frontend_app_files_midified[template];
        
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html, data) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        app.view.afterWidget(widget);

        //mapInitialize(data);                        
        app.view.tmpMapData = data;
        
        loadGoogleMaps();
        
        setTimeout(function() {
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

            setDefaultValues();
            setPredefinedValues(data)
        }, 3000); 
    }
    
    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;
        
        mapInitialize(app.view.tmpMapData);
    }

    function loadGoogleMaps() {
        if ( true != app.view.gMapsLoaded) {
                app.logger.func('loadGoogleMaps');
                $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
    }

    /**
     * @param variable
     * @returns {*}
     */
    window.getQueryVariable = function(variable) {
        var query = document.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++)
        {
            var pair = vars[i].split("=");
            if (pair[0] == variable)
            {
                return decodeURIComponent(pair[1]);
            }
        }
        return null;
    };

    function setDefaultValues() {

        window.testDriveData = {
            'selected_id': '', //dealer
            'form_id': '7',
            'field-firstname': '2',
            'field-secondname': '3',
            'field-lastname': '1',
            'punkt[1]': '', //firstname
            'punkt[2]': '', //secondname
            'punkt[3]': '', //lastname

            'field-email': '6',
            'punkt[6]': '', //email
            'field-phone': '7',
            'punkt[7]': '', //phone
            'comment': '', //Comment
            'haveacar': '', //haveacar

            'policy': 'true', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'subscribe': 'true', //Я хочу получать информацию от Renault
            'subscribe_sms': '1',
            'subscribe_email': '1',
            'submit-val': '1',
            'RenaultDealerDomain' : location.hostname,
            'CampaignUniqueId': getQueryVariable('utm_medium') ? getQueryVariable('utm_medium') : 'WIFIBAR',
            'Media': getQueryVariable('utm_source') ? getQueryVariable('utm_source') : 'WIFIBAR'
        };
    }

    function loadTranslation(data) {

        switch (app.router.locale) {
            case "uk":
                data.Select_this_dealer = "Вибрати цього диллера";
                data.select_date_and_time = "Оберіть дату та час";
                data.Select_date = "оберіть дату";
                data.select_time = "оберіть час";
                data.optional_confirmation = "Ми зв'яжемось з Вами щоб підтвердити, що обрані Вами дата та час вільні";
                data.change_this_datetime = "Обрати ці дату та час";

                data.accost = "Звертання";
                data.Mr = "Пан";
                data.Ms = "Пані";
                data.name = "Ім'я";
                data.surname = "Прізвище";
                data.patronymic = "По батькові";
                data.E_Mail = "E-Mail";
                data.post_code = "Індекс";
                data.settlement = "Населений пункт";
                data.house_number = "Номер будинку";
                data.VIN = "VIN <span>(номер кузова, зазначений у свідоцтві<br> про реєстрацію транспортного засобу)</span>";
                data.phone = "Мобільний телефон";
                data.region = "Область";
                data.street = "Вулиця";
                data.number_of_apartments = "Номер квартири";
                data.The_state_reg_number = "Державний реєстраційний номер";
                data.your_question = "Ваше питання";

                data.Subscribe_to_news = "Підписатися на новини Renault";
                data.consent = "Даю свою згоду на обробку зазначених мною вище персональних даних";


                break
            case "ru":
                data.Select_this_dealer = "Выбрать этого диллера";
                data.select_date_and_time = "Выберите дату и время";
                data.Select_date = "выберите дату";
                data.select_time = "выберите время";
                data.optional_confirmation = "Мы свяжемся с Вами, чтобы подтвердить, что выбранные Вами дата и время свободны";
                data.change_this_datetime = "Выбрать эти дату и время";

                data.accost = "Обращение";
                data.Mr = "Г-н";
                data.Ms = "Г-жа";
                data.name = "Имя";
                data.surname = "Фамилия";
                data.patronymic = "Отчество";
                data.E_Mail = "E-Mail";
                data.post_code = "Индекс";
                data.settlement = "Неселённый пункт";
                data.house_number = "Номер дома";
                data.VIN = "VIN <span>( Номер кузова, указанный в свидедельстве<br> о регистрации транспортного средства)</span>";
                data.phone = "Мобильный телефон";
                data.region = "Область";
                data.street = "Улица";
                data.number_of_apartments = "Номер квартиры";
                data.The_state_reg_number = "Государственный регистрационный номер";
                data.your_question = "Ваш вопрос";

                data.Subscribe_to_news = "Подписаться на новости RENAULT";
                data.consent = "Даю своё согласие на обработку указанных мною выше личных данных";

                break
            default:
                break
        }

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (salonData) {
                    app.view.dealers = salonData;

                    loadServices(data);

                });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (serviceData) {

                    $.each(app.view.dealers, function (k, v) {
                        $.each(serviceData, function (k2, v2) {
                            if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                                $.extend(app.view.dealers[k], v2);
                                serviceData[k2] = false;
                            }
                        });
                    });

                    $.each(serviceData, function (k, v) {
                        if (!$.isEmptyObject(v)) {
                            app.view.dealers.push(v);
                        }
                    });

                    data.dealers = getPreparedDealers(app.view.dealers);

                    loadTemplate(data);
                });
    }


    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var html = '<h4>"' + dealer['dealers_name_' + locale] + '"</h4>'
                + '<h5>Контактна інформація</h5>'
                + '<p>' + dealer['city_name_' + locale]
                + '<br>' + dealer['salon_adres_' + locale] + '</p>'
                + '<h5>салон</h5>'
                + '<p>' + dealer['salon_phone'] + '</p>';
        //+ '<h5>СТО</h5>'
        //+ '<p>(044) 495-88-20</p>';

        $('.map-wrapper').addClass('mw-dealer-selected');

        $('.mapitembox').html(html);
        window.testDriveData['selected_id'] = dealer['dealers_id'];
        $('#test-drive-form-select-this-dealer-button').show();
        $('#test-drive-form-select-this-dealer-button').click(function () {
            selectThisDealerButtonClick(dealer);
        });

    }

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    function getDealer(dealers_id) {

    }

    function setPredefinedValues(data) {
        var salon_id, service_id, city_id, dealer_id;

        salon_id = $.urlParams('get', 'salon_id'); //4
        service_id = $.urlParams('get', 'service_id'); //35
        city_id = $.urlParams('get', 'city_id'); //9        
        
        if (app.config.frontend_app_dealer_id) {
            dealer_id = app.config.frontend_app_dealer_id;
        }

        if (city_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (city_id == v.dealer.city_id) {
                    app.logger.text('predefined city: ' + v.dealer.city_name_ua);

                    $('#test-drive-form-map-input-search').val(v.dealer.city_name_ua);
                    data.center = v.dealer.gps_x + ',' + v.dealer.gps_y;
                    data.zoom = 11;
                    mapInitialize(data);

                    return;
                }
            });
        }

        if (salon_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (salon_id == v.dealer.salon_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }

        if (service_id) {
            $.each(app.view.allMarkers, function (k, v) {
                if (service_id == v.dealer.service_id) {
                    markerClick.call(this, v, app.view.allMarkers);
                    return;
                }
            });
        }
        
        if (dealer_id && dealer_id > 0) {
            $('#test-drive-form-map-input-search').parent().hide();
            
            $.each(app.view.allMarkers, function (k, v) {
                if (dealer_id == v.dealer.dealers_id) {
                    markerClick.call(this, v, app.view.allMarkers);                    
                }
                else {
                    v.visible = false;                    
                }
            });
        }
    }

    function markerClick(marker1, allMarkers) {
        app.logger.var(marker1.dealer);
        window.testDriveData.salon_id = marker1.dealer.salon_id;
        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');
        var formfields = document.getElementById('contactus');

        formfields.classList.remove('hidden');
    }

    function loadCars(data) {
        var params = {
            "controller": 'car',
            "action": 'index'
        };

        $.getJSON(
            'http://dealers.renault.ua/platformAjaxRequest.php',
            params,
            function (carData) {
                app.view.models = carData;
                data.models = [];
                $.each(carData, function(k, v){

                    if(v.car_new == 1){
                        data.models.push(v.car_name);
                    }

                });


                loadSalons(data);
            });
    }
});


app.view.wfn['find-a-dealer'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/find-a-dealer.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        loadSalons(data);
    }


    function loadTemplate(data) {
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

        loadGoogleMaps();
        //mapInitialize();
        setTimeout(function() {
            bindEvents();
        }, 3000); 
       
    }

    GoogleMapsLoaded = function () {
        app.view.gMapsLoaded = true;

        mapInitialize();
    }

    function loadGoogleMaps() {
        if ( true != app.view.gMapsLoaded) {
                app.logger.func('loadGoogleMaps');
                $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk&async=2&callback=GoogleMapsLoaded", function () {
            });
        }
        else {
            GoogleMapsLoaded();
        }
    }

    function mapInitialize(conf) {        
        // default options
        var myLatlng1 = new google.maps.LatLng(49.3159955, 32.0068446);
        var zoom = 6;

        if (conf) {
            app.logger.var(conf);
        }
        //if custom center
        if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.center)) {
            myLatlng1 = new google.maps.LatLng(conf.center.split(',')[0], conf.center.split(',')[1]);
        }

        //if custom zoom
        if (!$.isEmptyObject(conf) && conf.zoom) {
            zoom = conf.zoom;
        }

        // Map options
        var mapOptions1 = {
            scrollwheel: false,
            center: myLatlng1,
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // Init map
        var map1 = new google.maps.Map(document.getElementById('mapresult'), mapOptions1);


        // Create the search box and link it to the UI element.

        markers = [];
        var input = /** @type {HTMLInputElement} */(document.getElementById('find-a-dealer-map-input-search'));
        //map1.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        //var SearchBox = new google.maps.places.SearchBox((input));
        var autocomplete = new google.maps.places.Autocomplete(input,
                {
                    types: ['(cities)'],
                    componentRestrictions: {'country': 'ua'}
                }
        );

        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            //filter dealers list 
            if (!$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace()) && !$.isEmptyObject(autocomplete.getPlace().name)) {
                var town = autocomplete.getPlace().name;
                app.logger.var(autocomplete.getPlace());
                app.logger.text(town);

                var filterValue = '.' + toCodeValue(town);
                app.logger.text(filterValue);
                // use filterFn if matches value            
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: filterValue});
                }

                app.view.mapFilterValue = filterValue;

            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            //for (var i = 0, place; place = places[i]; i++) {
            /*var image = {
             url: place.icon,
             size: new google.maps.Size(71, 71),
             origin: new google.maps.Point(0, 0),
             anchor: new google.maps.Point(17, 34),
             scaledSize: new google.maps.Size(25, 25)
             };
             
             // Create a marker for each place.
             var marker = new google.maps.Marker({
             map: map1,
             icon: image,
             title: place.name,
             position: place.geometry.location,                    
             });
             
             markers.push(marker);*/


            //}

            bounds.extend(place.geometry.location);

            map1.fitBounds(bounds);
            map1.setZoom(11);


        });

        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map1, 'bounds_changed', function () {
            var bounds = map1.getBounds();
            autocomplete.setBounds(bounds);
        });

        $(input).change(function () {
            if (!$(this).val()) {
                mapInitialize();
                app.view.initializeMap = true;

                // use filterFn if matches value            
                if (!$.isEmptyObject(app.view.$grid)) {
                    app.view.$grid.isotope({filter: "*"});
                }
            }
            else {
                app.view.initializeMap = false;
            }
        });

        var allMarkers = [];

        $.each(app.view.dealers, function (k, v) {
            if (!$.isEmptyObject(conf) && !$.isEmptyObject(conf.filter)) {
                if ('salon' == conf.filter && $.isEmptyObject(v.salon_id)) {
                    return;
                }

                if ('service' == conf.filter && $.isEmptyObject(v.service_id)) {
                    return;
                }

                if ('pro' == conf.filter && $.isEmptyObject(v.dealers_pro)) {
                    return;
                }
            }

            var myLatlng1 = new google.maps.LatLng(v.gps_x, v.gps_y);
            // Add markers
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map1,
                icon: '/img/ico-marker3.png',
                dealer: v,
                scale: 4
            });

            allMarkers.push(marker1);

            google.maps.event.addListener(marker1, 'click', function () {
                app.logger.var(marker1.dealer);

                changeDealerInfo(marker1.dealer);

                $('html, body').animate({scrollTop: $('#find-a-dealer-selected-dealer-block').offset().top + $('#find-a-dealer-selected-dealer-block').outerHeight() - $(window).height()});

                for (var i = 0; i < allMarkers.length; i++) {
                    allMarkers[i].setIcon('/img/ico-marker3.png');
                }

                marker1.setIcon('/img/ico-marker2.png');
            });
        })

    }

    function loadSalons(data) {
        var params = {
            "controller": 'salon',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (salonData) {
                    app.view.dealers = salonData;

                    loadServices(data);
                });
    }

    function loadServices(data) {
        var params = {
            "controller": 'service',
            "action": 'index'
        };

        $.getJSON(
                'http://dealers.renault.ua/platformAjaxRequest.php',
                params,
                function (serviceData) {

                    $.each(app.view.dealers, function (k, v) {
                        $.each(serviceData, function (k2, v2) {
                            if (v2.gps_coords == v.gps_coords && v2.dealers_id == v.dealers_id) {
                                $.extend(app.view.dealers[k], v2);
                                serviceData[k2] = false;
                            }
                        });
                    });

                    $.each(serviceData, function (k, v) {
                        if (!$.isEmptyObject(v)) {
                            app.view.dealers.push(v);
                        }
                    });

                    data.dealers = getPreparedDealers(app.view.dealers);

                    loadTemplate(data);

                });
    }

    function changeDealerInfo(dealer) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        var value;
        var block = $('#find-a-dealer-selected-dealer-block');

        block.show();
        $('#find-a-dealer-selected-dealer-block-message').hide();

        //name
        value = dealer['dealers_name_' + locale];
        block.find('.fdealer_item__head').html(value);

        //gps_coords
        value = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';
        block.find('.go-to-map').attr('href', value);

        //town
        value = dealer['city_name_' + locale];
        block.find('.town').html(value);

        //street 
        //service_adres_ru salon_adres
        if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
            value = dealer['service_adres_' + locale];
        }
        if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
            value = dealer['salon_adres_' + locale];
        }
        block.find('.street').html(value);

        //salon-title   service-title icons
        block.find('.salon-title').hide();
        block.find('.salon-phone').hide();
        block.find('.service-title').hide();
        block.find('.service-phone').hide();
        block.find('.services-icon-salon').hide();
        block.find('.services-icon-service').hide();
        block.find('.services-icon-pro').hide();

        //salon_phone                
        if (!$.isEmptyObject(dealer['salon_phone'])) {
            value = dealer['salon_phone'];

            block.find('.salon-title').show();
            block.find('.salon-phone').show();
            block.find('.salon-phone').html(value);
        }

        //service_phone
        if (!$.isEmptyObject(dealer['service_phone'])) {
            value = dealer['service_phone'];

            block.find('.service-title').show();
            block.find('.service-phone').show();
            block.find('.service-phone').html(value);
        }

        //salon ?
        if (!$.isEmptyObject(dealer['salon_id'])) {
            block.find('.services-icon-salon').show();
            block.find('.salon-service-url-link').attr('href', dealer['salon_url']);

            //salon-service-promo-link
        }

        //service ?
        if (!$.isEmptyObject(dealer['service_id'])) {
            block.find('.services-icon-service').show();
            block.find('.salon-service-url-link').attr('href', dealer['service_url']);
            //salon-service-promo-link

        }

        //dealers_pro
        if (!$.isEmptyObject(dealer['dealers_pro'])) {
            block.find('.services-icon-pro').show()
        }
    }

    function getPreparedDealers(dealers) {
        var locale = app.router.locale;
        if ('uk' == locale) {
            locale = 'ua';
        }

        $.each(dealers, function (k, dealer) {
            dealers[k].title = dealer['dealers_name_' + locale];
            dealers[k].town = dealer['city_name_' + locale];

            if (!$.isEmptyObject(dealer['service_adres_' + locale])) {
                dealers[k].street = dealer['service_adres_' + locale];
            }
            if (!$.isEmptyObject(dealer['salon_adres_' + locale])) {
                dealers[k].street = dealer['salon_adres_' + locale];
            }

            dealers[k].gpsUrl = 'https://www.google.com.ua/maps/place/@' + dealer.gps_coords.replace(/\ /g, '') + ',17z/data=!4m2!3m1!1s0x40d4cefec397bd8f:0xd344af779861fc77';

            dealers[k].dataFilter = toCodeValue(dealer['city_name_ru']) + ' ' + toCodeValue(dealer['city_name_ua']);

            var gps = dealer.gps_coords.replace(/\ /g, '').split(',');
            dealers[k].gps_x = gps[0];
            dealers[k].gps_y = gps[1];

            if (!$.isEmptyObject(dealer['salon_id'])) {
                dealers[k].websiteUrl = dealer['salon_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-salon';
            }

            if (!$.isEmptyObject(dealer['service_id'])) {
                dealers[k].websiteUrl = dealer['service_url'];
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-service';
            }

            if (!$.isEmptyObject(dealer['dealers_pro'])) {
                dealers[k].dataFilter = dealers[k].dataFilter + ' data-filter-pro';
            }

            if (k % 3 == 0) {
                dealers[k].firstInRow = true;
            }

            if ((k + 1) % 3 == 0) {
                dealers[k].lastInRow = true;
            }

        });

        return dealers;
    }

    function bindEvents() {
        $('#find-a-dealer-filter-salon').click(function () {
            mapInitialize({filter: 'salon'});
            var html = $('#find-a-dealer-filter-salon-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-service').click(function () {
            mapInitialize({filter: 'service'});
            var html = $('#find-a-dealer-filter-service-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-pro').click(function () {
            mapInitialize({filter: 'pro'});
            var html = $('#find-a-dealer-filter-pro-title').html();
            $('#find-a-dealer-filter-selected').html(html.replace('<br>', ' '));
            $('#find-a-dealer-filter-selected-del').show();
            $('.fd_box__selected h4').show();
            $('.fd_box__selected-items').show();
        });

        $('#find-a-dealer-filter-selected-del').click(function () {
            mapInitialize();

            if (!$.isEmptyObject(app.view.$grid)) {
                if (!$.isEmptyObject(app.view.mapFilterValue)) {
                    var filterValue = app.view.mapFilterValue;
                    app.view.$grid.isotope({filter: filterValue});
                }
            }

            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
            $('#find-a-dealer-filter-selected-del').hide();
            $('.fd_box__selected h4').hide();
            $('.fd_box__selected-items').hide();
            //$('.fd_box').addClass('hidden')           
        });

        $('#find-a-dealer-filter-selected-refresh').click(function () {
            mapInitialize();

            if (!$.isEmptyObject(app.view.$grid)) {
                if (!$.isEmptyObject(app.view.mapFilterValue)) {
                    var filterValue = app.view.mapFilterValue;
                    app.view.$grid.isotope({filter: filterValue});
                }
            }

            $('.fd_box__list .fd_box__item--active').removeClass('fd_box__item--active');
            $('#find-a-dealer-filter-selected').html('*');
            $('#find-a-dealer-filter-selected-del').hide();
            $('.fd_box__selected h4').hide();
            $('.fd_box__selected-items').hide();
        });

        $('.go-to-local-gps_coords').click(function () {
            var center = $(this).attr('map-center').replace(/\ /g, '');
            var dealer_id = $(this).attr('dealer-id');

            $.each(app.view.dealers, function (k, v) {
                if (dealer_id == v.dealers_id) {
                    changeDealerInfo(v);
                    return;
                }
            });

            $('#map-tab-a').click();
            $(window).scrollTop('220');

            setTimeout(function () {
                mapInitialize({"center": center, "zoom": 12});
            }, 200);

        });

        $('#map-tab-a').on('click', function () {
            setTimeout(function () {
                $('.fd_box__list .fd_box__item--active').click();
                if (app.view.initializeMap) {
                    mapInitialize();
                }
            }, 200);

        })

    }
});
app.view.wfn['models'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/models.html';

    run();

    function run() {
        app.logger.func('run');

        loadCategories();
    }

    function loadCategories() {

        var params = {
            "fields": 'id,slug,title',
            "where": {
                "domain_id": app.config.frontend_app_default_domain_id,
            }

        };
        //process default models

        $.getJSON(
                app.config.frontend_app_api_url + '/db/model-category',
                params,
                function (catData) {
                    loadData(catData);
                });


    }

    function loadData(catData) {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
        data.catData = catData;

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,price,thumbnail_base_url,thumbnail_path',
            "per-page": data.count,
            "sort": sort,
            "expand": "firstInfo",
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        if (data.catData && data.catData.items && data.catData.items[0]) {
            if ($.urlParams("all")['cslug']) {
                //filter for category
                $.each(data.catData.items, function (k, v) {
                    if ($.urlParams("all")['cslug'] == v.slug) {
                        params['category_id'] = v.id;
                        //change title                    
                        data.t.title = app.config.frontend_app_t[v.title];
                    }
                });

            }
        }

        $.getJSON(
                app.config.frontend_app_api_url + '/db/models',
                params,
                function (modelsData) {
                    //process domain models
                    if (modelsData.items[0]) {
                        $.extend(data, modelsData);

                        $.each(data.items, function (key, val) {
                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            if (val.firstInfo) {
                                data.items[key].viewUrl = app.view.helper.preffix + '/models/' + val.firstInfo.slug;
                            }
                        });

                        data.viewAllUrl = '#';

                        loadTemplate(data);
                    }

                    //process default models
                    if (!modelsData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/models',
                                params,
                                function (modelsData) {
                                    $.extend(data, modelsData);

                                    $.each(data.items, function (key, val) {
                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        if (val.firstInfo) {
                                            data.items[key].viewUrl = app.view.helper.preffix + '/models/' + val.firstInfo.slug;
                                        }
                                    });

                                    data.viewAllUrl = '#';

                                    loadTemplate(data);
                                });
                    }


                });
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        app.logger.var(data);

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

});


app.view.wfn['news'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/news.html'; 

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
            "per-page": data.count,
            "sort": sort,
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/articles',
                params,
                function (articlesData) {
                    //process domain articles
                    if (articlesData.items[0]) {
                        $.extend(data, articlesData);

                        $.each(data.items, function (key, val) {

                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                        });

                        data.urlToNews = app.view.helper.preffix + '/news';

                        loadTemplate(data);
                    }

                    //get default articles
                    if (!articlesData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/articles',
                                params,
                                function (articlesData) {
                                    $.extend(data, articlesData);

                                    $.each(data.items, function (key, val) {

                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                                    });

                                    data.urlToNews = app.view.helper.preffix + '/news';

                                    loadTemplate(data);
                                });
                    }
                });
    }


    function loadTemplate(data) {
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

});


app.view.wfn['promos'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/page/promos.html'; 

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.t = app.view.getTranslationsFromData(data);

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
            "per-page": data.count,
            "sort": sort,
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/promos',
                params,
                function (promosData) {
                    //process domain promos
                    if (promosData.items[0]) {
                        $.extend(data, promosData);

                        $.each(data.items, function (key, val) {
                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            data.items[key].viewUrl = app.view.helper.preffix + '/promo/' + val.slug;
                        });

                        data.urlToNews = app.view.helper.preffix + '/promos';
                        
                        loadTemplate(data);
                    }

                    //get default promos
                    if (!promosData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;
                        
                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/promos',
                                params,
                                function (promosData) {                                    
                                    $.extend(data, promosData);

                                    $.each(data.items, function (key, val) {
                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        data.items[key].viewUrl = app.view.helper.preffix + '/promo/' + val.slug;
                                    });

                                    data.urlToNews = app.view.helper.preffix + '/promos';
                                    loadTemplate(data);
                                });
                    }


                });
    }


    function loadTemplate(data) {
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

});


app.view.wfn['articles-part'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/part/articles-part.html'; 

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        var sort = data.order_by;
        if ("desc" == data.sort_order)
            sort = "-" + sort;

        var params = {
            "fields": 'id,slug,title,description,thumbnail_base_url,thumbnail_path,description,video_base_url,video_path',
            "per-page": data.count,
            "sort": sort,
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

        $.getJSON(
                app.config.frontend_app_api_url + '/db/articles',
                params,
                function (articlesData) {
                    //process domain articles
                    if (articlesData.items[0]) {
                        $.extend(data, articlesData);

                        $.each(data.items, function (key, val) {
                            data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                            data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                            data.items[key].description = val.description;
                        });

                        data.urlToNews = app.view.helper.preffix + '/news';


                        loadTemplate(data);
                    }

                    //get default articles
                    if (!articlesData.items[0]) {
                        params.where.domain_id = app.config.frontend_app_default_domain_id;

                        $.getJSON(
                                app.config.frontend_app_api_url + '/db/articles',
                                params,
                                function (articlesData) {
                                    $.extend(data, articlesData);

                                    $.each(data.items, function (key, val) {
                                        data.items[key].previewImg = val.thumbnail_base_url + '/' + val.thumbnail_path;
                                        data.items[key].viewUrl = app.view.helper.preffix + '/news/' + val.slug;
                                        data.items[key].description = val.description;
                                    });

                                    data.urlToNews = app.view.helper.preffix + '/news';

                                    loadTemplate(data);
                                });

                    }
                });
    }


    function loadTemplate(data) {
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

});


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

                    data.menu = data.menu.filter(function (v) {
                        return app.view.isDealerBlackListPage('/' + app.router.locale + v.url)? false : true;
                    });

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

                                data.menu = data.menu.filter(function (v) {
                                    return app.view.isDealerBlackListPage('/' + app.router.locale + v.url)? false : true;
                                });

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


app.view.wfn['bloglist-bottom'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/bloglist-bottom.html';         

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['bloglist-top'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/block/bloglist-top.html';           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['i-want-to'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    //var template = '/templates/block/i-want-to.html';
    var template = '/templates/block/i-want-to.html';


    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.urlSite = app.view.helper.preffix;
        data.urlToLoadBooking = '';
        //console.log(data);
        $.each(data.buttons, function (key, val) {
            if ('@frontend' == val.host) {
                data.buttons[key].viewUrl = app.view.helper.preffix + val.url;
            } else {
                data.buttons[key].viewUrl = val.url;
            }
        });

        data.buttons = data.buttons.filter(function (v) {
            return app.view.isDealerBlackListPage('/' + app.router.locale + v.url) ? false : true;
        });

        // data.urlToBrochures = app.view.helper.preffix;
        //data.urlToFindADealer = app.view.helper.preffix + '/contact-form';

        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


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
console.log('--------INST--------');
                        console.log(data.data[i].caption);
                        console.log('--------INST--------');
                        if(data.data[i].caption !== null){
                            newinstItem[i]['message'] = instMessageFormat(data.data[i].caption.text, app.router.locale, data_app.wordSlice);
                        }
                       else {
                            newinstItem[i]['message'] = '';
                        }
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

            var opts = {
                part: 'snippet',
                order: 'date',
                maxResults: 18
            };

            if(data.YtChannelId) {
                opts['channelId'] = data.YtChannelId;
            } else {
                opts['q'] = q;
            }

            var request = gapi.client.youtube.search.list(opts);
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
                        message = message.split('//')[0] + message.split("//")[1];
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


app.view.wfn['promo-wysiwyg'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/editor/promo-wysiwyg.html';                

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['sceditor'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/editor/sceditor.html';              

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['wysiwyg'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/editor/wysiwyg.html';             

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['add-image'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/add-image.html';          

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['gallery'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/gallery.html';             

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        console.log(data);
        console.log('data');
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['image-slider-revolution'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/image-slider-revolution.html';   

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        loadTemplate(data);
    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');
        
        var v = app.config.frontend_app_files_midified[template];
        
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        
        app.logger.var(widget);
        
        $('#widget-wrapper-' + widget.uniqueKey).append(html);  

        app.view.afterWidget(widget);
    }
    
});


app.view.wfn['intro'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/intro.html';            

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function updatePrices(data, prices) {
        for(var key in data.items) {

            if(data.items[key].version_code && prices[data.items[key].version_code]) {
                data.items[key].price = prices[data.items[key].version_code];
            } else if(!data.items[key].price) {
                delete data.items[key];
            }

        }
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;

        $.getJSON(
            app.config.frontend_app_api_url + '/db/price', {
                //"fields": '',
                "where": {
                    locale: app.config.frontend_app_locale,
                    "domain_id": app.config.frontend_app_domain_id,
                }
            }, function (priceData) {

                var _priceData = {};
                for(var key in priceData.items) {
                    _priceData[(priceData.items[key]['model'] + ' - ' + priceData.items[key]['version_code'])] = priceData.items[key]['price'];
                }

                updatePrices(data, _priceData);
                loadTemplate(data);
            });
    }


    function loadTemplate(data) {
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
});


app.view.wfn['simple-photo'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/simple-photo.html';             

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['banner'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);

    var widget = app.view.getCurrentWidget();
    var template = '/templates/image/banner.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;

        app.view.href = data.href;
        app.view.categorie = data.categorie;
        app.view.subcategorie = data.subcategorie;
        loadTemplate(data);

    }


    function loadTemplate(data) {
        app.logger.func('loadTemplate(data)');

        var v = app.config.frontend_app_files_midified[template];

        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        $('#widget-wrapper-' + widget.uniqueKey).append(html);
        $('.imgfs > img').click(function () {
            bannerClick();
        });
        app.view.afterWidget(widget);
    }

    function bannerClick() {
        if (typeof _gaq != "undefined") {
            _gaq.push([
                'trackEvent',
                app.view.categorie,
                app.view.subcategorie
            ]);
        }

        window.open(app.view.href);
        
        return false;
    }
});



app.view.wfn['intro-text'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/intro-text.html';            

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }

    function loadTemplate(data) {
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
});


app.view.wfn['hidden-block'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/hidden-block.html';

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});

app.view.wfn['promo-subtitle'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/promo-subtitle.html';          

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['promo-title'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/promo-title.html';           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['section-text'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/section-text.html';             

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['small-text'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/text/small-text.html';           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


app.view.wfn['video'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
    var template = '/templates/video/video.html';           

    run();

    function run() {
        app.logger.func('run');
        loadData();
    }

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;        
        
        loadTemplate(data);
    }


    function loadTemplate(data) {
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
});


//# sourceMappingURL=all.js.map