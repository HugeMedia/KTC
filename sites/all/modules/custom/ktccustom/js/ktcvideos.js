(function ($) {
    
    $(document).ready(function() {
        
        Cufon.replace('h4');
        Cufon.replace('#videos-top p');
        Cufon.replace('#views_slideshow_cycle_main_video_categories-block div.views-field-name span');
        
//        $('div.view-videos-by-category div.view-content') 
//			//.before('<div id="nav">')
//			.cycle({ 
//				fx:     'shuffle', 
//				speed:  'slow', 
//				timeout: 0, 
//				pager:  '#nav' ,
//				//next:   '#vid-next', 
//				//prev:   '#vid-prev' 
//			});
        
        $('#views_slideshow_cycle_main_video_categories-block div.views-field-name').click(function() {
            $('#video-player-wrapper').html('').hide();
            var l = $(this).siblings('.views-field-field-desc-left');
            var r = $(this).siblings('.views-field-field-desc-right');
            var tid = $(this).siblings('.views-field-tid').text();
            $('#body-left').html(l.html());
            $('#body-right').html(r.html());
            Cufon.replace('#body-left p');
            Cufon.replace('#body-right p');
            //$('#vids-by-cat').show();
            //alert(tid);
            var vidsdiv = 'div.cat-' + $.trim(tid);
            var vidscontrols = vidsdiv + ' div.vids-controls-' + $.trim(tid);
            //$('div.cat-' + tid).show();
            //alert(vidsdiv);
            $('div.vids-by-cat-view').hide();
            $(vidsdiv).show();
            $(vidsdiv + ' div.view-content')
                .cycle({ 
				fx:     'scrollHorz', 
				speed:  'fast', 
				timeout: 0,
				//pager:  '#nav' ,
				next:   vidscontrols + ' a.vid-next',
				prev:   vidscontrols + ' a.vid-prev'
			});
            //$('#video-cats').appendTo($(this).parents('div.views-slideshow-cycle-main-frame-row-item'));
            //console.log('cat offset:');
            //console.log($(this).offset());
            //console.log('main offset:');
            //console.log($('#main').offset());
            var catoffset = $(this).offset();
            var mainoffset = $('#main').offset();
            var newoffset = catoffset;
            newoffset.top -= 60;
            newoffset.left -= 90;
            if (catoffset.left - mainoffset.left <  10) {
                //console.log('close to edge');
                newoffset.left = mainoffset.left - 50;
            }
            $('#vids-by-cat').offset( newoffset );
            Cufon.replace('div.vids-by-cat-view div.vid-desc-label');
        });
        
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                if ($('#video-player-wrapper').is(':visible')) {
                    $('#video-player-wrapper').html('').hide();
                }
                else {
                    $('div.vids-by-cat-view').hide();
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
            var params = { allowScriptAccess: "always", config: { 'autoPlay':true } };
	    var atts = { id: "myytplayer" };
            var embedStr = "http://www.youtube.com/e/" + yt + "?enablejsapi=1&playerapiid=ytplayer&autoplay=1"
            swfobject.embedSWF(embedStr, "video-player", "382", "211", "8", null, null, params, atts);
            var origoffset = $(this).offset();
            origoffset.top -= 2;
            origoffset.left -= 2;
            $('#video-player-wrapper').show().offset(origoffset);
        });
        
        $('div.view-most-viewed-videos div.views-field-field-story-thumb .field-content').click(function() {
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
            var origoffset = $('div.view-most-viewed-videos').offset();
            origoffset.top -= 2;
            origoffset.left -= 2;
            $('#video-player-wrapper').show().offset(origoffset);
        });
        
        $('div.views-field-field-story-desc div.vid-desc-label').click(function() {
            $(this).next('.vid-desc').toggle();
            //alert($(this).parents('div.view-content').height() + ' , ' + $(this).next('.vid-desc').height());
            if ($(this).next('.vid-desc').is(':visible')) {
                $(this).parents('div.view-content').height(  $(this).parents('div.view-content').height() +  $(this).next('.vid-desc').height()  + 10 );  //10 for padding
            }
            else {
                $(this).parents('div.view-content').height(  211  );
            }
        });
        
        // close description boxes when advancing to the next or previous video
        $('a.vid-next').click(function() {
            $('div.vid-desc:visible').hide();
            $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
        });
        $('a.vid-prev').click(function() {
            $('div.vid-desc:visible').hide();
            $('div.vids-by-cat-view div.view-videos-by-category > div.view-content').height( 211 );
        });
    
    });
	
})(jQuery);