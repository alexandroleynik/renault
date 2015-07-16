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