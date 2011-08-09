(function ($) {
	
        function resetHover() {
            expandIt(null, true);
        }
        
        function expandIt(panelWrapper, reset) {
            expandIt.winopen = false;
            if (reset) {
                expandIt.winopen = false;
                return;
            }
            
            var config = {
                over:  function() {
                        //if (expandIt.winopen == false) {
                            $(this).find('.panel-expanded').show();
                            //expandIt.winopen = true;
                        //}
                    },
                timeout: 5000,
                out: function () {
                        //console.log('exit');
                        //expandIt.winopen = false;
                    }
            }
            
            panelWrapper.hoverIntent( config );
        }
        
	$(document).ready(function() {
            
            var wrapset = $('.panel-wrapper');
            //console.log(wrapset);
            expandIt(wrapset);
            
            // panel close button
            $('.panel-close').click(function() {
               $('.panel-expanded').hide('slow', function() {
                    //setTimeout(function() { expandIt(null, true) }, 1000);
               }); 
            });
            
            
        });
            
})(jQuery);