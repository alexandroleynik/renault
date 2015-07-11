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
	        slides: '> .item',
	    });
	}

});