jQuery(document).ready(function() {
	jQuery('.yf-accordion-title').on('click', function(e){
			e.preventDefault();
			var currentAttrValue = jQuery(this).next();
	 
			if(jQuery(this).is('.yf-active')) {
				yf_close_accordion_section();
			}
			else {
				yf_close_accordion_section();
				jQuery(this).find('.fa').removeClass('yf-fa-up');
				jQuery(this).find('.fa').addClass('yf-fa-down');
				jQuery(this).addClass('yf-active');
				jQuery(currentAttrValue).slideDown().addClass('yf-open');
			}
	});
});
function yf_close_accordion_section() {
	jQuery('.yf-accordion .yf-accordion-title .fa').removeClass('yf-fa-down');
	jQuery('.yf-accordion .yf-accordion-title .fa').addClass('yf-fa-up');
	jQuery('.yf-accordion .yf-accordion-title').removeClass('yf-active');
	jQuery('.yf-accordion .yf-accordion-content').slideUp().removeClass('yf-open');
}