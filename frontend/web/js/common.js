function urlencode(v) {
    return encodeURIComponent(v).replace(/%20/g, '+');
}

function urldecode(v) {
    return uri = decodeURIComponent(v);
}

//on first load
function preloadStart() {
    loaderStart();
}

//on first load end
function preloadLogoEnd() {
    loaderStop();
}

//on ajax link click
function preloadFadeIn() {
    $(".preload-mask").fadeIn();
    loaderStart();
}

//on ajax link click end
function preloadFadeOut() {
    loaderStop();
}

//loader
var logoAnimation = 0;
var currentFrame = 0;
var prevFrame = 0;

function loaderStop() {

	$('.nav-root').removeClass('nav-is-open');
	$('html, body').removeClass('nav-is-activated');
	$('.nav-container').removeAttr('style');
		
    $(".preload-mask").fadeOut();

    clearInterval(logoAnimation);
}

function loaderStart() {
    currentFrame = 43;

    logoAnimation = setInterval(function () {
        $(".preload-logo").addClass("frame-" + currentFrame);
        $(".preload-logo").removeClass("frame-" + prevFrame);

        if (currentFrame < 98) {
            currentFrame++;
            prevFrame = currentFrame - 1;
        }
        else {
            currentFrame = 43;
            prevFrame = 98;
        }
    }, 20);
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
