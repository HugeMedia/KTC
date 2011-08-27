(function ($) {
    
    // do this so Cufon doesn't have to replace tons of text at once
    function preFact() {
	//console.log(this);
	var slidetype = $(this).attr('type');
	if (slidetype == 'news_flash') {
	    $('#label-fact').hide();
	    $('#label-news').show();
	}
	else if (slidetype == 'fast_fact') {
	    $('#label-news').hide();
	    $('#label-fact').show();
	}
	//console.log($(this).attr('style'));
	Cufon.replace(this);
    }
    
    $(document).ready(function() {
	
	Cufon.replace('#ktc-facts #facts-label');
	
        $('#facts-listing').cycle({ 
	    fx:    'fade',
	    width: 700,
	    speed: 'slow',
	    timeout: 5000,
	    fit: 1,
	    before: preFact,
	    pause:  1 
	});    
    
    });
	
})(jQuery);