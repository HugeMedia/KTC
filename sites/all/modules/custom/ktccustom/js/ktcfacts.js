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
	
	console.log($(this));
	var fact_text = $(this).find('.fact-text');
	var learn_more = $(this).find('.ktc-learn-more a');
	var fact_tweet = $(this).find('.ktc-fact-tweet');
	//console.log($(this).attr('style'));
	
	Cufon.replace(fact_text);
	Cufon.replace(learn_more);
	Cufon.replace(fact_tweet);
	//Cufon.replace(this + ' .fact-text');
	//Cufon.replace(this + ' .ktc-learn-more a');
	//Cufon.replace(this + ' .ktc-fact-tweet');
    }
    
    $(document).ready(function() {
	
	Cufon.replace('#ktc-facts #facts-label');
	
        $('#facts-listing').cycle({ 
	    fx:    'fade',
	    width: 854,
	    speed: 'slow',
	    timeout: 5000,
	    fit: 1,
	    before: preFact,
	    pause:  1 
	});    
    
    Cufon.replace('.fact-text:first');
    Cufon.replace('.ktc-learn-more:first a');
    Cufon.replace('.ktc-fact-tweet');
    
    });
	
})(jQuery);