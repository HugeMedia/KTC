(function ($) {
    
    $(document).ready(function() {
        
        Cufon.replace('h4');
        //Cufon.replace('#videos-top p');
        Cufon.replace('div.view-video-categories div.views-field-name span');
	Cufon.replace('.category-index');
	
	var totalCats = $('span.category-index').size();
        
	function showVideos(stack) {
	    //console.log(stack);
	    var tid = $(stack).find('.views-field-tid').text();
	    var l = $(stack).find('.views-field-field-desc-left');
            var r = $(stack).find('.views-field-field-desc-right');
	    var catname = $(stack).find('.views-field-name span').text();
	    //console.log(catname);
	    $('#body-left').html(l.html());
            $('#body-right').html(r.html());
            Cufon.replace('#body-left p');
            Cufon.replace('#body-right p');
	    //console.log($('h1#page-title').text());
	    $('h1#page-title').text(catname);
	    Cufon.replace('h1#page-title');
	    var vidsdiv = 'div.cat-' + $.trim(tid);
	    //console.log(vidsdiv);
            var vidscontrols = vidsdiv + ' div.vids-controls-' + $.trim(tid);
	    $('div.vids-by-cat-view').hide();
            $(vidsdiv).fadeIn();
	    $('#vids-by-cat').fadeIn();
	    $('div.vids-by-cat-view div.view-content').cycle('destroy');
		
	    if ($(vidsdiv + ' div.view-content').size() > 0) {
		$(vidsdiv + ' div.view-content')
		    .cycle({ 
				fx:     'shuffle', 
				speed:  'fast', 
				timeout: 0,
				//pager:  '#nav' ,
				next:   vidscontrols + ' a.vid-next',
				prev:   vidscontrols + ' a.vid-prev',
                                after: nextVid
				//before: nextVid
			});
		Cufon.replace('div.vids-by-cat-view div.vid-desc-label');
		var totalvids = $(vidsdiv + ' div.views-row').size();
		$('div.vid-counter').text('1/' + totalvids);
		Cufon.replace('div.vid-counter');
		
		
	    }
	    $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
	}
	
	function carouselAfter(cats) {
	    //console.log(cats[1]);
	    var tid = $(cats[1]).find('.views-field-tid').text();
	    //console.log(tid);
	    var l = $(cats[1]).find('.views-field-field-desc-left');
            var r = $(cats[1]).find('.views-field-field-desc-right');
	    var catname = $(cats[1]).find('.views-field-name span').text();
	    //console.log(catname);
	    $('#body-left').html(l.html());
            $('#body-right').html(r.html());
            Cufon.replace('#body-left p');
            Cufon.replace('#body-right p');
	    //console.log($('h1#page-title').text());
	    $('h1#page-title').text(catname);
	    Cufon.replace('h1#page-title');
	    var vidsdiv = 'div.cat-' + $.trim(tid);
	    //console.log(vidsdiv);
            var vidscontrols = vidsdiv + ' div.vids-controls-' + $.trim(tid);
	    $('div.vids-by-cat-view').hide();
            $(vidsdiv).fadeIn();
	    $('#vids-by-cat').fadeIn();
	    $('div.vids-by-cat-view div.view-content').cycle('destroy');
	    
	    var currentCat = parseInt($('span.current-cat').text());
	    //var currentCatSpan = $('span.current-cat');
	    var nextCat = currentCat < totalCats ? currentCat + 1 : 1;
	    $('.category-index').removeClass('current-cat');
	    $('span#cat-index-' + nextCat).addClass('current-cat');
	    Cufon.replace('.category-index');
		
	    if ($(vidsdiv + ' div.view-content').size() > 0) {
		$(vidsdiv + ' div.view-content')
		    .cycle({ 
				fx:     'shuffle', 
				speed:  'fast', 
				timeout: 0,
				//pager:  '#nav' ,
				next:   vidscontrols + ' a.vid-next',
				prev:   vidscontrols + ' a.vid-prev',
                                after: nextVid
				//before: nextVid
			});
		Cufon.replace('div.vids-by-cat-view div.vid-desc-label');
		var totalvids = $(vidsdiv + ' div.views-row').size();
		$('div.vid-counter').text('1/' + totalvids);
		Cufon.replace('div.vid-counter');
		
		
	    }
	    else {
		//console.log('empty');
		$('#vids-by-cat').hide();
	    }
	}
	
	
        function nextVid(curr, next, opts) {
            //console.log(opts.nextSlide);
	    //console.log(opts);
	   // var title = $(this).parents('.view-videos-by-category').siblings('.vids-controls').attr('title');
	   var title = $(this).find('.soda-story-title').attr('title');
	   if (title.length>42) { title = title.substring(0, 42) + '...'; }
	    $(this).parents('.view-videos-by-category').siblings('.vids-controls').find('.vid-title').text(title);
            var totalvids = $(this).siblings('div.views-row').size() + 1;
	    //console.log('total vids: ' + totalvids);
            var curSlide;
            if (opts.nextSlide == 0) {  curSlide = totalvids; }
            else { curSlide = opts.nextSlide; }
	    //console.log('cur slide: ' + curSlide);
            //console.log(totalvids);
            $('div.vid-counter').text(curSlide + '/' + totalvids);
            Cufon.replace('div.vid-counter');
	    Cufon.replace( $(this).parents('.view-videos-by-category').siblings('.vids-controls').find('.vid-title'));
        }
        

        
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                if ($('#video-player-wrapper').is(':visible')) {
                    $('#video-player-wrapper').html('').hide();
                }
                else {
                    $('div.vids-by-cat-view').hide();
		    $('#vids-by-cat').hide();
                    $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
                }
            }
        });
        
        $('a#youtube-close').click(function() {
            $('#video-player-wrapper').html('').hide();
            return false;
        });
        
        $('div.view-videos-by-category div.views-field-field-story-thumb .field-content').click(function() {
            $('#video-player-wrapper').html('').append('<div id="video-close"><a id="youtube-close" href="#">X</a></div><div id="video-player"></div>');
            $('a#youtube-close').click(function() {
                $('#video-player-wrapper').html('').hide();
                return false;
            });
            var yt = $(this).next('.youtube-helper').attr('yt');
	    var popup =  $(this).find('.soda-story-popup').attr('popup');
	    if (popup == 1) {
		var vidurl =  $(this).find('.soda-story-link').attr('url');
		window.open(vidurl, '_blank', 'width=660,height=600');
	    }
	    else {
		var params = { allowScriptAccess: "always", config: { 'autoPlay':true } };
		var atts = { id: "myytplayer" };
		var embedStr = "http://www.youtube.com/e/" + yt + "?enablejsapi=1&playerapiid=ytplayer&autoplay=1"
		swfobject.embedSWF(embedStr, "video-player", "382", "211", "8", null, null, params, atts);
		var origoffset = $(this).offset();
		origoffset.top -= 2;
		origoffset.left -= 2;
		$('#video-player-wrapper').show().offset(origoffset);
	    }
        });
        
	
	
        $('div.view-featured-videos div.views-field-field-story-thumb .field-content').click(function() {    
	    var popup =  $(this).find('.soda-story-popup').attr('popup');
	    if (popup == 1) {
		var vidurl =  $(this).find('.soda-story-link').attr('url');
		window.open(vidurl, '_blank', 'width=660,height=600');
	    }
	    else {
		$('#video-player-wrapper').html('').append('<div id="video-close"><a id="youtube-close" href="#">X</a></div><div id="video-player"></div>');
		$('a#youtube-close').click(function() {
		    $('#video-player-wrapper').html('').hide();
		    return false;
		});
		var yt = $(this).next('.youtube-helper').attr('yt');
		var params = { allowScriptAccess: "always", config: { 'autoPlay':true } };
		var atts = { id: "myytplayer" };
		var embedStr = "http://www.youtube.com/e/" + yt + "?enablejsapi=1&playerapiid=ytplayer&autoplay=1"
		swfobject.embedSWF(embedStr, "video-player", "382", "211", "8", null, null, params, atts);
		var origoffset = $(this).offset();
		origoffset.top -= 2;
		origoffset.left -= 2;
		$('#video-player-wrapper').show().offset(origoffset);
	    }
        });
        
	
	
        $('div.views-field-field-story-desc div.vid-desc-label').click(function() {
            $(this).next('.vid-desc').toggle();
            //alert($(this).parents('div.view-content').height() + ' , ' + $(this).next('.vid-desc').height());
            if ($(this).next('.vid-desc').is(':visible')) {
                $(this).parents('div.view-content').height(  $(this).parents('div.view-content').height() +  $(this).next('.vid-desc').height()  +5 );  //10 for padding
		Cufon.replace($(this).next('.vid-desc').find('p'));
            }
            else {
                $(this).parents('div.view-content').height(  211  );
            }
        });
        
        // close description boxes when advancing to the next or previous video
        $('a.vid-next').click(function() {
            //var cl = $(this).parents('div.vids-by-cat-view').find('div.view-videos-by-category div.views-row:visible').attr('class');
            //alert(cl);
            $('div.vid-desc:visible').hide();
            $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
        });
        $('a.vid-prev').click(function() {
            $('div.vid-desc:visible').hide();
            $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
        });
	
	$('div.view-video-categories div.view-content div.item-list').jCarouselLite({
	    btnNext: ".next",
	    btnPrev: ".prev",
	    visible: 4,
	    afterEnd: carouselAfter
	});
	
	
	//showVideos($('div.view-video-categories ul.video-cat-carousel li.views-row-1:first').next('li.views-row-2'));
	showVideos($('div.view-video-categories ul li.views-row-2')[1]);
    
    });
	
})(jQuery);