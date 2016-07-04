<!-- Included javascript files
================================================== -->


<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/custom.min.js"></script>
<script type="text/javascript" src="js/jquery.vegas.min.js" ></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.4.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js" ></script>
<script type="text/javascript" src="js/jquery.flexslider.min.js"></script>
<script type="text/javascript" src="js/main-fm.js"></script>
<script type="text/javascript" src="js/deanne-fancy-video-box.js"></script>

<script>

  /* Google font load checking */

  var googleFontLoad = true;
    /*googleFontLoad = true;*/

  if(!googleFontLoad){
    google.load("webfont", "1");
    google.setOnLoadCallback(function() {
    WebFont.load({
      google: {
        families: [ 'EB+Garamond']
      }});
      googleFontLoad = true;
    });
  }


  /* Site Main plug-in initilize */

  jQuery(function($){
    $("body").mainFm({
      /*
      Set page background for each page. Just add src(Desktop size image) and src_small(Mobile size image) variables.
      Add those variables as per number of pages, If you need to remove the page background, just remove the src value and leave it blank
      [Ex: src : '', src_small : '']
       */
      pageBackground 	: [	{ src : 'images/site/background-images/background1_2.jpg', src_small : 'images/site/background-images/background1_2.jpg'},
                { src : 'images/site/background-images/background2.jpg', src_small : 'images/site/background-images/background2.jpg'},
                { src : 'images/site/training-images/training1.jpg', src_small : 'images/site/training-images/training1.jpg'},
                { src : 'images/site/background-images/background4.jpg', src_small : 'images/site/background-images/background4.jpg'},
                { src : 'images/site/background-images/background3.jpg', src_small : 'images/site/background-images/background3.jpg'},
                  ],

      /* Set the opening page.
      leave it blank value if you need to show the home page as a opening page*/
      homePage : "",

      /* Set fade / slide animation for page transition */
      pageAnimationType : 'fade',

      /* set pageHolder height, if you need to set all the page height in liquid and not align to center,
       just set value "100%" to the below 2 varaibles */
      pageHolderHeight_desktop : 420,
      pageHolderHeight_ipad : 380,

      /* Full screen gallery options for autoplay and slideshow delay time*/
      galleryAutoplay : "false",
      gallerySlideshowDelay : 3,
      /* Full screen gallery default image resize types. Options are fill/fit/none */
      galleryImageResize : "fill"

    });
  });


$(document).ready(function(){


  /* Hook up the FlexSlider */
    $('.flexslider').flexslider({
           slideshow: true,
       slideshowSpeed: 5000
      });


  /* Remove google map. This map will add when page display
    $(".page").find('#mapWrapper').each(function(){
        $(this).data('map', $(this).children(':first-child'));
        if(!$.browser.msie){
          $(this).children(':first-child').remove();
        }
    }); */


  /* Initialize portfolio - isotope */
    $(function(){

      var $container = $('#portfolio_container_1');
      var $optionSets = $('#options .option-set'),
        $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
      var $this = $(this);

      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return false;
      }
      var $optionSet = $this.parents('.option-set');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      // make option object dynamically, i.e. { filter: '.my-filter-class' }
         var options = {},
          key = $optionSet.attr('data-option-key'),
          value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
        // changes in layout modes need extra logic
        changeLayoutMode( $this, options )
        } else {
        // otherwise, apply new options
        $container.isotope( options );
        }

      return false;
      });

    });


  /* Initialize the fancybox plug-in for portfolio */
    var fancy_Obj = $("a[rel=example_group]");
    fancy_Obj.fancybox({
      'transitionIn'		: 'elastic',
      'transitionOut'		: 'elastic',
        'hideOnOverlayClick': true,

      'overlayColor'		: '#000',
      'padding' 			: 0,
      'margin' 			: 0,
      'overlayOpacity'	:.75

    });

    // Remove title tag, so that the title text doesn't show one tooltip when mouse hover the thumbnail
    fancy_Obj.each(function(){
      $(this).attr(('data-title'),$(this).find(".img_text").html());
      if($(this).attr('title')){
        $($(this).find(('.img_text')).html(String('<span class="img_txt_hold">'+$(this).attr('title')))+'</span>');
      }
      $(this).attr('title', '');
    })

  /* End fancybox plug-in for portfolio */

  /* End portfolio - isotope */


    // Email submit action
    $("#email_submit").click(function() {

      $('#reply_message').removeClass();
      $('#reply_message').html('')
      var regEx = "";

      // validate Name
      var name = $("input#name").val();
      regEx=/^[A-Za-z .'-]+$/;
      if (name == "" || name == "Name"  || !regEx.test(name)) {
        $("input#name").val('');
        $("input#name").focus();
        return false;
      }

      // validate Email
      var email = $("input#email").val();
      regEx=/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
      if (email == "" || email == "Email" || !regEx.test(email)) {
        $("input#email").val('');
        $("input#email").focus();
        return false;
      }

      // validate comment
      var comments = $("textarea#comments").val();
      if (comments == "" || comments == "Comments..." || comments.length < 2) {
        $("textarea#comments").val('');
        $("textarea#comments").focus();
        return false;
      }

      var dataString = 'name='+ $("input#name").val() + '&email=' + $("input#email").val() + '&comments=' + $("textarea#comments").val();
      $('#reply_message').addClass('email_loading');

      // Send form data to mailer.php
      $.ajax({
        type: "POST",
        url: "mailer.php",
        data: dataString,
        success: function() {
            // Clear the inputs
            $("input#name").val('');
            $("input#email").val('');
            $("textarea#comments").val('');
            
            
          $('#reply_message').removeClass('email_loading');
          $('#reply_message').addClass('list3');
          $('#reply_message').html("Mail sent sucessfully")
          .hide()
          .fadeIn(1500);
            }
          });
      return false;
        
      

    });

  });

</script>