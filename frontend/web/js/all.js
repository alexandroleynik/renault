window.fbAsyncInit = function () {
    FB.init({
        appId: app.config.frontend_app_facebook_app_id,
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

var cSpeed=9;
var cWidth=160;
var cHeight=20;
var cTotalFrames=13;
var cFrameWidth=160;
var cImageSrc='/img/sprites.gif';

var cImageTimeout=false;
var cIndex=0;
var cXpos=0;
var cPreloaderTimeout=false;
var SECONDS_BETWEEN_FRAMES=0;

function preloadStart() {

    document.getElementById('loaderImage').style.backgroundImage='url('+cImageSrc+')';
    document.getElementById('loaderImage').style.width=cWidth+'px';
    document.getElementById('loaderImage').style.height=cHeight+'px';

    //FPS = Math.round(100/(maxSpeed+2-speed));
    FPS = Math.round(100/cSpeed);
    SECONDS_BETWEEN_FRAMES = 1 / FPS;

    cPreloaderTimeout=setTimeout('preloadFadeIn()', SECONDS_BETWEEN_FRAMES/1000);

}

function preloadFadeIn(){

    cXpos += cFrameWidth;
    //increase the index so we know which frame of our animation we are currently on
    cIndex += 1;

    //if our cIndex is higher than our total number of frames, we're at the end and should restart
    if (cIndex >= cTotalFrames) {
        cXpos =0;
        cIndex=0;
    }

    if(document.getElementById('loaderImage'))
        document.getElementById('loaderImage').style.backgroundPosition=(-cXpos)+'px 0';

    cPreloaderTimeout=setTimeout('preloadFadeIn()', SECONDS_BETWEEN_FRAMES*1000);

    $(".preload-mask").fadeIn();
}

function preloadStop() {
    $(".preload-mask").fadeOut();
    clearTimeout(cPreloaderTimeout);
    cPreloaderTimeout=false;
    $('.nav-root').removeClass('nav-is-open');
    $('html, body').removeClass('nav-is-activated');
    $('.nav-container').removeAttr('style');
}

function preloadLogoEnd() {
    preloadStop();
}

function preloadFadeOut() {
    preloadStop();
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
	
	$(window).resize(function(){
		if($(window).width()>=960){
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

function is_string( mixed_var ){
    return (typeof( mixed_var ) == 'string');
}

//test grunt

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

    function bindEventListeners() {
        app.logger.func('bindEventListeners()');
        bindAjaxLinks();

        preloadStart();
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

window.app.config = {};
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

            var arr = url.replace(/^\//, '').split('/');

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

                if (urlpath && urlpath != '/') {
                    urlpath = urlpath.replace(/^\/[\w]{2}/, '/' + linkLang);
                }

                if ('/' == urlpath) {
                    urlpath = urlpath + linkLang;
                }

                $(v).attr('href', app.config.frontend_app_frontend_url + urlpath);
            })
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

        app.view.wfn['footer']();

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

        app.bindAllAjaxLinks();

        setTimeout(function () {
            app.bindAllAjaxLinks();
        }, 3000);
    }



    function beforePageRender() {
        app.view.wfn['header']();

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

        body = body.replace(/\]\[/g, ',').replace(/,,/g, ',').replace(/\[,\]/g, '[]');

        return body;
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

    function loadData() {
        app.logger.func('loadData()');
        
        var data = widget;
        data.t = app.view.getTranslationsFromData(data);
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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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

    function loadData() {
        app.logger.func('loadData()');

        var data = widget;
        data.viewAllUrl = app.view.helper.preffix + '/models';

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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

        //data.datapicker = getDataPickerFromData(data);
        //console.log('sdfsf');
        //console.dir(data.datapicker);
        //console.log('sdfsf');
        //loadTranslation(data);

        //http://dealers.renault.ua/platformAjaxRequest.php

        $.getScript(
                app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
                );
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
            scrollwheel: false,
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
            });
        })

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
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize(data);
        $('.select-dealer-content').slideUp();
        $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

        setDefaultValues();
        setPredefinedValues(data);
    }

    function setDefaultValues() {
        var d = new Date();

        var curr_date = d.getDate() + 1;
        var curr_month = d.getMonth() + 1;
        if (curr_month < 10) {
            curr_month = '0' + curr_month;
        }
        var curr_year = d.getFullYear();
        window.testDriveData = {
            'selected_id': '', //dealer
            'punkt[5]': '', //Модель*
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
            'punkt[10]': 'yes', //Даю своё согласие на обработку указанных мной выше персональных данных*
            'punkt[11]': 'true', //Я хочу получать информацию от Renault
            'submit-val': '1',
            'RenaultDealerDomain': location.hostname
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
            $('.select-dealer-header').html(dealer['dealers_name_' + locale]);
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');
            $('.form .select-date-time-content').slideDown();
            $('.form .select-date-time-content, .form .select-date-time-header').attr('data-state', 'open');

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

        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');

        //app.logger.var(allMarkers);
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

        $.getScript(
                app.config.frontend_app_web_url + "/js/lib/validator/localization/messages_" + app.router.locale + ".js"
                );
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
            scrollwheel: false,
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
            });
        })

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
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize(data);
        $('.select-dealer-content').slideUp();
        $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');

        setDefaultValues();
        setPredefinedValues(data)

    }

    function setDefaultValues() {
        window.testDriveData = {
            'selected_id': '', //dealer
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
            'RenaultDealerDomain' : location.hostname
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
            $('.select-dealer-header').html(dealer['dealers_name_' + locale]);
            $('.select-dealer-content').slideUp();
            $('.form .select-dealer-content, .form .select-dealer-header').attr('data-state', 'closed');
            $('.form .select-date-time-content').slideDown();
            $('.form .select-date-time-content, .form .select-date-time-header').attr('data-state', 'open');

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

        changeDealerInfo(marker1.dealer);

        for (var i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setIcon('/img/ico-marker3.png');
        }

        marker1.setIcon('/img/ico-marker2.png');
        var formfields = document.getElementById('contactus');

        formfields.classList.remove('hidden');
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
        app.container.append(html);
        app.view.afterWidget(widget);

        mapInitialize();

        bindEvents();
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
            "fields": 'id,slug,title,price,thumbnail_base_url,thumbnail_path',
            "per-page": data.count,
            "sort": sort,
            "expand": "firstInfo",
            "where": {
                locale: app.config.frontend_app_locale,
                "domain_id": app.config.frontend_app_domain_id,
            }

        };

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
                                data.items[key].viewUrl = app.view.helper.preffix + '/info/' + val.firstInfo.slug;
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
                                            data.items[key].viewUrl = app.view.helper.preffix + '/info/' + val.firstInfo.slug;
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
        
        var v = app.config.frontend_app_files_midified[template];
        
        app.templateLoader.getTemplateAjax(app.config.frontend_app_web_url + template + '?v=' + v, function (template) {
            renderWidget(template(data));
        });
    }

    function renderWidget(html) {
        app.logger.func('renderWidget(html)');
        app.container.append(html);

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
                            data.items[key].viewUrl = app.view.helper.preffix + '/article/' + val.slug;
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
                                        data.items[key].viewUrl = app.view.helper.preffix + '/article/' + val.slug;
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
        app.container.append(html);

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
        app.container.append(html);

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
                            data.items[key].viewUrl = app.view.helper.preffix + '/article/' + val.slug;
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
                                        data.items[key].viewUrl = app.view.helper.preffix + '/article/' + val.slug;
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
        app.container.append(html);

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
            "domain_id": app.config.frontend_app_domain_id,
        },
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
        app.container.append(html);

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
        app.container.append(html);

        app.view.afterWidget(widget);
    }
});


app.view.wfn['i-want-to'] = (function () {
    /*** process   ***/
    //run()->loadData()->loadTemplate(data)->renderWidget(html);
    
    var widget = app.view.getCurrentWidget();
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
        app.container.append(html);

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
        app.container.append(html);

        app.view.afterWidget(widget);
    }


    function getFbItems(data) {
        FB.api('https://graph.facebook.com/renault.ua?locale=ru_RU&fields=posts.limit(18){full_picture,message,link,created_time}&access_token=677676795700961|6f7c3417d116450a1ff568ca9e64eed3', function (response) {
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

        var url = 'https://api.instagram.com/v1/users/2088219317/media/recent/?client_id=fa8f6abac0704d4d840759aa909201d8&count=18';
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
                app.logger.var(YtData)
                data.YtGroup = items_array_chunk(YtData, 2);
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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

        app.view.afterWidget(widget);
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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

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
        app.container.append(html);

        app.view.afterWidget(widget);
    }
});


//# sourceMappingURL=all.js.map