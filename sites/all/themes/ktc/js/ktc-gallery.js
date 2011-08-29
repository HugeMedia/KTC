(function ($) {
        
	$(document).ready(function() {
		
		function setFont() {
			Cufon.replace('#cboxTitle');
		}
		
		$('#image-gallery-filter-title').click(function() {
			$('ul#image-gallery-categories').toggle();	
		});
		
		$('li.image-gallery-category').click(function() {
			var tid = $(this).attr('tid');
			$('select#edit-field-gallery-display-tid').val(tid);
			$('form#views-exposed-form-image-gallery-page').submit();
		});
		
		//$().piroBox_ext({
		//	piro_speed : 700,
		//	bg_alpha : 0.5,
		//	piro_scroll : true //pirobox always positioned at the center of the page
		//});
		
		$('a.pirobox_gall').colorbox( { current: '', opacity: 0, top: "100px", onComplete: setFont } );
		
	});
	
})(jQuery);