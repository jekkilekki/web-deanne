/**
    Custom JavaScript to handle De Anne's YouTube links
    
    Author: Aaron Snowberger
    Author URI: http://aaronsnowberger.com
    
    Fancy Box URI: http://fancybox.net
    
    FYI: Autoplay video doesn't work on mobile - here are the reasons
    
        @link: http://stackoverflow.com/questions/8141652/youtube-embedded-video-autoplay-feature-not-working-in-iphone/8142187#8142187
        @link: http://stackoverflow.com/questions/3009888/autoplay-audio-files-on-an-ipad-with-html5/3056220#3056220
*/

(function( $ ){	
    
    // Set default video width and height
    var vidWidth = 680;
    var vidHeight = 495;
    
    var mobile = $(window).width() <= 767;
    
    if( mobile ) {
        vidWidth = Math.ceil(($(document).width()*95)/100);
        vidHeight = vidWidth / 1.3737373737;
    }
    
    $(".fancyYoutube").click(function() {
        
        $.fancybox({
        
                'overlayColor'	: '#000',
                'overlayOpacity': .75,
                'margin' 		: 0,
                'padding'       : 0,
                'autoScale'     : true,
                'fitToView'     : true,
                'titleShow'     : true,
                'hideOnOverlayClick'    : true,
                'showCloseButton'       : false,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic',
                'title'         : this.title,
                'width'         : vidWidth,
                'height'        : vidHeight,
                'href'          : this.href.replace( new RegExp( "watch\\?v=", "i" ), 'embed/' ),
                'type'          : 'iframe', // Don't use Flash (swf), embed in iframe to use HTML5 video
//                'swf'           : {
//                        'wmode'             : 'transparent',
//                        'allowfullscreen'   : 'true',
//                }
            
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
                'fitToView'     : true,
                'titleShow'     : true,
                'hideOnOverlayClick'    : true,
                'showCloseButton'       : false,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'elastic',
                'title'         : this.title,
                'width'         : vidWidth,
                'height'        : vidHeight,
                'href'          : this.href,
                'type'          : 'iframe'
            
        });
        
        return false;
    });
    
//    document.onclick= function(event) {
//    // Compensate for IE<9's non-standard event model
//    //
//    if (event===undefined) event= window.event;
//    var target= 'target' in event? event.target : event.srcElement;
//
//    alert('clicked on '+target.tagName + target.id);
//        
//        
//    $(document).ready(function() {
//        $("*").click(function(event) {
//            alert(event.target.className);
//        });
//    });
//};
    
}) (jQuery);