(function ($) {

        
	$(document).ready(function() {

		// blog
		Cufon.replace('div.view-blog div.view-header h1, div.view-blog div.view-header h3, div.view-blog div.blog-date div.blog-date-field, div.view-blog div.views-field-name .field-content, div.view-blog div.views-field-body .field-content p, div.view-blog div.views-field-title span, div.view-blog div.views-field-view-node .field-content, div.node div.blog-date div.blog-date-field, div.node-blog-post div.field-name-body p, #block-views-recent-blog-posts-block div.view-content div.item-list h3, #block-views-recent-blog-posts-block div.view-content div.item-list ul li .field-content a, #block-views-recent-blog-posts-block .view-header p, #blog-feed a, body.page-blog .block-tagadelic h2, body.page-blog .block-tagadelic a');
		//Cufon.replace('div.view-blog div.view-header h3');
		//Cufon.replace('div.view-blog div.blog-date div.blog-date-field');
		//Cufon.replace('div.view-blog div.blog-date div.blog-date-field');
		//Cufon.replace('div.view-blog div.views-field-name .field-content');
		//Cufon.replace('div.view-blog div.views-field-body .field-content p');
		//Cufon.replace('div.view-blog div.views-field-view-node .field-content');
		
		//Cufon.replace('div.node h1');
		//Cufon.replace('div.node div.blog-date div.blog-date-field');
		//Cufon.replace('div.node-blog-post div.field-name-body p');
		
		//Cufon.replace('#blog-archive div.view-content div.item-list h3');
		//Cufon.replace('#blog-archive div.view-content div.item-list ul li .field-content a');
		//Cufon.replace('#blog-archive .view-header p');
		
		Cufon.now();
		
		$('span.collapse-icon').text("►");
		$('#block-views-recent-blog-posts-block div.view-content div.item-list h3').click(function() {
			//$(this).siblings('ul').children('li').slideToggle();
			var icon = $(this).children(".collapse-icon");
			$(this).siblings("ul").children('li').slideToggle(function()
			{
				(icon.text()=="▼") ? icon.text("►") : icon.text("▼");
			});
		})
		
	});
	
})(jQuery);