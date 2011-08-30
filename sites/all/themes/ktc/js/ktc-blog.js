(function ($) {

        
	$(document).ready(function() {

		// blog
		Cufon.replace('div.view-blog div.view-header h1');
		Cufon.replace('div.view-blog div.view-header h3');
		Cufon.replace('div.view-blog div.blog-date div.blog-date-field');
		Cufon.replace('div.view-blog div.views-field-title .field-content');
		Cufon.replace('div.view-blog div.views-field-name .field-content');
		Cufon.replace('div.view-blog div.views-field-body .field-content p');
		Cufon.replace('div.view-blog div.views-field-view-node .field-content');
		
		Cufon.replace('div.node h1');
		Cufon.replace('div.node div.blog-date div.blog-date-field');
		Cufon.replace('div.node-blog-post div.field-name-body p');
		
		Cufon.replace('#blog-archive div.view-content div.item-list h3');
		Cufon.replace('#blog-archive div.view-content div.item-list ul li .field-content a');
		Cufon.replace('#blog-archive .view-header p');
		
		Cufon.now();
		
		$('span.collapse-icon').text("►");
		$('#blog-archive div.view-content div.item-list h3').click(function() {
			//$(this).siblings('ul').children('li').slideToggle();
			var icon = $(this).children(".collapse-icon");
			$(this).siblings("ul").children('li').slideToggle(function()
			{
				(icon.text()=="▼") ? icon.text("►") : icon.text("▼");
			});
		})
		
	});
	
})(jQuery);