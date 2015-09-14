$(document).ready(function() {

	$('.gallbox__list').flexslider({
		controlNav: false,

		start: function(slider) {
			$('.gallbox__count .total').text(slider.count);
		},

		before: function(slider) {
			$('.gallbox__count .index').text(slider.currentSlide + 1);
		},

		after: function(slider) {
			$('.gallbox__count .index').text(slider.currentSlide + 1);
		}
	});


	// Main slider 
	$('.main_slider').flexslider({});


	// Auto sel slider
	$('.auto_sel_slider').flexslider({
		animation: 'slide',
		controlNav: false,
	});



});


$(window).scroll(function() {});
$(window).resize(function() {});
$(window).load(function() {});