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
		
		navinDropdown();
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
	
	navinDropdown();
	
	function navinDropdown(){
	
		var navin_width=$('.navin').width()-40,
		navin_inner_width=0,
		$subnav=$('<div class="sub-nav visible active" style="float:right;">'+
                                                        '<button type="button" class="btn-more">'+
                                                            '<span></span>'+
                                                       '</button>'+
                                                        '<ul class="nav-primary"></ul>'+
                                                    '</div>);');
		$('.navin>ul>li').each(function(){
			if($('.navin').find('.sub-nav').length>0){
				$subnav.find('.nav-primary').prepend($(this).clone());
				$(this).addClass('hide');
				//$('.navin').prepend($subnav);
			}
			else if(navin_inner_width+=$(this).width()>navin_width){
				niw_toggle=1;
				$subnav.find('.nav-primary').prepend($(this).clone());
				$(this).addClass('hide');
				$('.navin').append($subnav);
			}
			else{
				navin_inner_width+=$(this).width();
				$subnav.detach();
			}
		});	
	}

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

//test grunt 3
