(function ($) {
    
    $(document).ready(function() {
        
        // mini image popups
	$('#panel-mini-images div.views-field-field-gallery-large').click(function() {
	    $('div.views-field-field-gallery-large-1').hide();
	    $(this).next('div.views-field-field-gallery-large-1').show();
	});
	
	$('#panel-mini-images div.panels-popup-wrapper img.panels-popup-close').click(function() {
	    $('div.views-field-field-gallery-large-1').hide();
	});
	
	Cufon.replace('#home-panels #panel-mini-images div.mini-image-title');
    
    });
	
})(jQuery);