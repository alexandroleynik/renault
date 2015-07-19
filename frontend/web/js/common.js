function urlencode(v) {
    return encodeURIComponent(v).replace(/%20/g, '+');
}

function urldecode(v) {
    return uri = decodeURIComponent(v);
}

uri = decodeURIComponent(encodedURIComponent)


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
	$('.show-menu').click(function(e){
		$('.html, body').addClass('nav-is-activated');
		$('.nav-root').addClass('nav-is-open');
		return false;
	});
	$('.close-menu').click(function(e){
		$('.html, body').removeClass('nav-is-activated');
		$('.nav-root').removeClass('nav-is-open');
		return false;
	});

});