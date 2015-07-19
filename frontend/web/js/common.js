function urlencode(v) {
    return encodeURIComponent(v).replace(/%20/g, '+');
}

function urldecode(v) {
    return uri = decodeURIComponent(v);
}

/*uri = decodeURIComponent(encodedURIComponent)*/


//on first load
function preloadStart() {
    $(".mask").fadeIn();



}

//on first load end
function preloadLogoEnd() {
    $(".mask").fadeOut()
}

//on ajax link click
function preloadFadeIn() {
    $(".mask").fadeIn()
}

//on ajax link click end
function preloadFadeOut() {
    $(".mask").fadeOut()
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



$(function(){

	//nav behavior
	var tm_nav=null;
	$('.show-menu').click(function(e){
		e.preventDefault();
		$('.nav-container').css({'min-height':$(window).height()});
		clearTimeout(tm_nav);
		$('html, body').addClass('nav-is-activated');
		tm_nav=setTimeout(function(){
			$('.nav-root').addClass('nav-is-open');
		}, 20);
	});
	$('.close-menu').click(function(e){
		e.preventDefault();
		clearTimeout(tm_nav);
		$('.nav-root').removeClass('nav-is-open');
		tm_nav=setTimeout(function(){
			$('html, body').removeClass('nav-is-activated');
			$('.nav-container').css({'min-height':'auto'});
		}, 300);
	});

});