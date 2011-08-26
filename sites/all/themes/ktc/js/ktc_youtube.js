(function ($) {
	
	$(document).ready(function() {
		
		//$.superbox();
		//$.superbox.settings['closeTxt'] = "none";
		//$('#superbox-container p.close').appendTo('#superbox-container #superbox-innerbox');
		
		var yt = $('#ktc-soda-story-video').attr('vid');
		
		var params = { allowScriptAccess: "always" };
		var atts = { id: "myytplayer" };
		var embedStr = "http://www.youtube.com/e/" + yt + "?enablejsapi=1&playerapiid=ytplayer"
		swfobject.embedSWF(embedStr, "ktc-soda-story-video", "425", "356", "8", null, null, params, atts);
		
		//$('#sfai-home-video-wrapper').dialog({
		//	width: 'auto',
		//	modal: true,
		//	resizable: false,
		//	autoOpen: false,
		//	position: 'center',
		//	show: 'fade'
		//});
		
		//url = $.jYoutube(yt);
		//$('#sfai-home-youtube-thumb .home-box-content a').append($('<img src="'+url+'" width="220" height="141" />'));
		//$('#sfai-home-youtube-thumb').click(function() {
			//$.modal("<div><h1>SimpleModal</h1></div>");
			//$('#sfai-home-video-wrapper').dialog('open');
		//	return false;	
		//});
		//$('#home-video-link').click(function() {
			//$.modal("<div><h1>SimpleModal</h1></div>");
		//	$('#sfai-home-video-wrapper').dialog('open');
		//	return false;	
		//});
            
	});
	
})(jQuery);