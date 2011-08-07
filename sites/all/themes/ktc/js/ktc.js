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
                    var popoffset = { top: linkoffset.top-popheight-10, left: linkoffset.left };
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
            
	});
	
})(jQuery);