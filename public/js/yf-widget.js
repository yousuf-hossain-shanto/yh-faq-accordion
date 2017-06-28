(function($){
	var parent = $('body');
	if ($('body').hasClass('widgets-php')){
		parent = $('.widget-liquid-right');
	}
	jQuery(document).ready(function($) {
		parent.find('.yf_icon_bg').wpColorPicker({
			change:_.throttle(function(){
				$(this).trigger('change');
			}, 1000, {leading: false})
		});
	});
	jQuery(document).on('widget-added', function(e, widget){
		widget.find('.yf_icon_bg').wpColorPicker({
			change:_.throttle(function(){
				$(this).trigger('change');
			}, 1000, {leading: false})
		});
	});
	jQuery(document).on('widget-updated', function(e, widget){
		widget.find('.yf_icon_bg').wpColorPicker({
			change:_.throttle(function(){
				$(this).trigger('change');
			}, 1000, {leading: false})
		});
	});
})(jQuery);