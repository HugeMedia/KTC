(function ($) {
        
	$(document).ready(function() {
		
		$('#image-gallery-filter-title').click(function() {
			$('ul#image-gallery-categories').toggle();	
		});
		
		$('li.image-gallery-category').click(function() {
			var tid = $(this).attr('tid');
			$('select#edit-field-gallery-display-tid').val(tid);
			$('form#views-exposed-form-image-gallery-page').submit();
		});
		
	});
	
})(jQuery);