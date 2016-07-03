/**
    Custom JavaScript to handle De Anne's YouTube links
    
    Author: Aaron Snowberger
    Author URI: http://aaronsnowberger.com
    
    Fancy Box URI: http://fancybox.net
*/

(function( $ ){	
    
    $(".fancyYoutube").click(function() {
        
        $.fancybox({
        
                'overlayColor'	: '#000',
                'overlayOpacity': .75,
                'margin' 		: 0,
                'padding'       : 0,
                'autoScale'     : true,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic',
                'title'         : this.title,
                'width'         : 680,
                'height'        : 495,
                'href'          : this.href.replace( new RegExp( "watch\\?v=", "i" ), 'v/' ),
                'type'          : 'swf',
                'swf'           : {
                        'wmode'             : 'transparent',
                        'allowfullscreen'   : 'true',
                }
            
        });
        
        return false;
    });
    
    $(".fancyVimeo").click(function() {
       
        $.fancybox({
            
                'overlayColor'	: '#000',
                'overlayOpacity': .75,
                'margin' 		: 0,
                'padding'       : 0,
                'autoScale'     : true,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic',
                'title'         : this.title,
                'width'         : 640,
                'height'        : 480,
                'href'          : this.href,
                'type'          : 'iframe'
            
        });
        
        return false;
    });
    
}) (jQuery);