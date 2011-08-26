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
				fx:     'shuffle', 
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
            newoffset.left -= 100;
            if (catoffset.left - mainoffset.left <  10) {
                //console.log('close to edge');
                newoffset.left = mainoffset.left - 50;
            }
            $('#vids-by-cat').offset( newoffset );
        });
        
        $(document).keyup(function(e) {
            if (e.keyCode == 27) { $('div.vids-by-cat-view').hide(); }   // esc
            $('#video-player-wrapper').html('').hide();
        });
        
        $('div.views-field-field-story-thumb .field-content').click(function() {
            $('#video-player-wrapper').html('').append('<div id="video-player"></div>');
            var yt = $(this).next('.youtube-helper').attr('yt');
            var params = { allowScriptAccess: "always" };
	    var atts = { id: "myytplayer" };
            var embedStr = "http://www.youtube.com/e/" + yt + "?enablejsapi=1&playerapiid=ytplayer"
            swfobject.embedSWF(embedStr, "video-player", "425", "356", "8", null, null, params, atts);
            var origoffset = $(this).offset();
            origoffset.top -= 20;
            origoffset.left -= 5;
            $('#video-player-wrapper').show().offset(origoffset);
        });
    
    });
	
})(jQuery);