(function ($) {
	
        function setOffset(el, newOffset){
		var $el = $(el);

		// get the current css position of the element
		var cssPosition = $el.css('position');

		// whether or not element is hidden
		var hidden = false;

		// if element was hidden, show it
		if($el.css('display') == 'none'){
			hidden = true;
			$el.show();
		}

		// get the current offset of the element
		var curOffset = $el.offset();

		// if there is no current jQuery offset, give up
		if(!curOffset){
			// if element was hidden, hide it again
			if(hidden)
				$el.hide();
			return;
		}

		// set position to relative if it's static
		if (cssPosition == 'static') {
			$el.css('position', 'relative');
			cssPosition = 'relative';
		}

		// get current 'left' and 'top' values from css
		// this is not necessarily the same as the jQuery offset
		var delta = {
			left : parseInt($el.css('left'), 10),
			top: parseInt($el.css('top'), 10)
		};

		// if the css left or top are 'auto', they aren't numbers
		if (isNaN(delta.left)){
			delta.left = (cssPosition == 'relative') ? 0 : el.offsetLeft;
		}
		if (isNaN(delta.top)){
			delta.top = (cssPosition == 'relative') ? 0 : el.offsetTop;
		}

		if (newOffset.left || 0 === newOffset.left){
			$el.css('left', newOffset.left - curOffset.left + delta.left + 'px');
		}
		if (newOffset.top || 0 === newOffset.top){
			$el.css('top', newOffset.top - curOffset.top + delta.top + 'px');
		}

		// if element was hidden, hide it again
		if(hidden)
			$el.hide();
	}

	$.fn.extend({

		/**
		 * Store the original version of offset(), so that we don't lose it
		 */
		_offset : $.fn.offset,

		/**
		 * Set or get the specific left and top position of the matched
		 * elements, relative the the browser window by calling setXY
		 * @param {Object} newOffset
		 */
		offset : function(newOffset){
			return !newOffset ? this._offset() : this.each(function(){
				setOffset(this, newOffset);
			});
		}
	});
        
	$(document).ready(function() {
            //console.log('offset of view is');
            var viewoffset = $('div.view-documents-by-category div.view-content').offset();
            //console.log(viewoffset);
            $('.view-documents-by-category td.views-field-title a').hover(
                function() {

                    var linkoffset = ($(this).offset());
                    var linkpos = $(this).position();
                    var popoffset1 = $(this).siblings('.abstract-pop').offset();
                    //console.log(linkpos);
                    //console.log(linkoffset);
                    //console.log(popoffset1);
                    //console.log('height of popoffset: ');
                    var popheight = $(this).siblings('.abstract-pop').height();
                    //console.log(popheight);
                    //console.log(linkoffset);
                    // move the popup to right above the link, accounting for height of the popup
                    var popoffset = { top: linkoffset.top-popheight-5, left: linkoffset.left };
                    //var popoffset = { top: linkoffset.top-437.5-popheight, left: 0 };
                    // get the height of the popup box and subtract that as well
                    //console.log(popoffset);
                   // console.log('---------------');
                    //var popoffset = linkoffset;
                    //var poppos = linkpos;
                    //popoffset.top = popoffset.top - 30;
                    //console.log(popoffset);
                    $(this).siblings('.abstract-pop').offset(popoffset).show();
                },
                function() {
                    $(this).siblings('.abstract-pop').hide();
                }
            )
	    
	    
	    // menu
	    $('ul#superfish-1 li li.menuparent > a').hover(function() {
		//console.log('hov');
		//$(this).parent('li.sf-depth-1 > ul').css({backgroundPosition: '0 -8px'});
		$(this).parents('li.sf-depth-1 ul').css({backgroundPosition: '0 -8px'});
	    },
	    function() {
		//console.log('outt');
		$(this).parents('li.sf-depth-1 ul').css({backgroundPosition: '0 0'});
	    });
	    
	    $('ul#superfish-1 a.sf-depth-3').hover(function() {
		//console.log('hov');
		//$(this).parent('li.sf-depth-1 > ul').css({backgroundPosition: '0 -8px'});
		$(this).parents('li.sf-depth-1 > ul').css({backgroundPosition: '0 -8px'});
	    },
	    function() {
		//console.log('outt');
		$(this).parents('li.sf-depth-1 > ul').css({backgroundPosition: '0 0'});
	    });
	    
	    
	    //$('#header-top .ktc-fact').each(function() {
	    //
	    //});
	    
		//$('#ktc-facts').cycle({ 
		//	fx:    'fade',
		//	fit: 1,
		//	speed:  2500,
		//	height: 35,
		//	width: 780
		//});
	    



	    //$('a[title=Advocacy Tools]').addClass('ctools-use-modal');
		
		// CUFON font replacement. using this method is always legal as far as I know,
		// and seems to render nicer looking fonts than @font-face across all browsers.
		// I try to only target specific elements, because if used to replace 'body' for example,
		// Cufon adds a lot of extra space by wrapping blank areas with spans.
		
		// general replacement
		Cufon.replace('#site-slogan, h1.title, form.search-form label, #header-top .facts-label, #footer #footer-text span, div.node h2, div.node h3, div.node p, div.node #interior-footnotes ol li');
		Cufon.replace('ul#superfish-1 li a', { hover: true });
		//Cufon.replace('h1.title');
		//Cufon.replace('form.search-form label');
		//Cufon.replace('#header-top .facts-label');
		//Cufon.replace('#header-top .ktc-fact');
		
		// home pages
		Cufon.replace('#home-top-right div.field-name-field-home-header div.field-item p');
		Cufon.replace('#home-top-right div.field-name-body div.field-item p');
		Cufon.replace('#home-top-left ul.home-section-menu li a');
		Cufon.replace('#home-section-bottom #panels-header span');
		
		// footer
		Cufon.replace('#footer ul.menu li a', { hover: true });
		//Cufon.replace('#footer #footer-text span');
		
		//Cufon.replace('div.node h2');
		//Cufon.replace('div.node h3');
		//Cufon.replace('div.node p');
		//Cufon.replace('div.node #interior-footnotes ol li');
		
		// image gallery
		//Cufon.replace('body.page-image-gallery div.view-image-gallery h1');
		//Cufon.replace('body.page-image-gallery #image-gallery-filter ul');
		//Cufon.replace('body.page-image-gallery div.image-gallery-pager ul');
		//Cufon.replace('body.page-image-gallery #image-gallery-filter #image-gallery-filter-title');
		//Cufon.replace('body.page-image-gallery #image-gallery-filter ul#image-gallery-category li div.image-gallery-category-inner');
		
		// documents page
		
		
		
		
		Cufon.now();
            
	});
	
})(jQuery);