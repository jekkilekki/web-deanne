<?php
/**
    Website Author: Aaron Snowberger
    Author URL: http://aaronsnowberger.com
    Author Date: July 1, 2016
 */
?>

<!DOCTYPE html>

                <!-- /** HTML TEMPLATE
                    Solidaire | Responsive one page Creative Template
                    Copyright (c) 2012, Subramanian

                    Author: Subramanian
                    Profile: themeforest.net/user/FMedia/

                    Version: 1.0.0
                    Release Date: 20 July 2012
                **/ -->

<html lang="en">
        
<?php include( 'private/custom-mailer.php' ); ?>
<?php include( 'private/head.php' );    // Contains <head> info ?>
    
    <body>

        <?php
        include( 'private/container.php' ); // Contains <header>, top bar, and page structure
        include( 'private/footer.php' );    // Contains <footer>

        ?>

        <!-- End site main frame -->


        <!--
        Begin Page content

        Note: mobile_spacing class is used to add spacing arround the content in mobile device not in desktop,
        if you remove the mobile_spacing class, the layout design doesn't effect in desktop it only effect in mobile device

        If you need to show the page content on full height (liquid height), just add the attribute data-height-fixed="false" in page class div tag
         -->

        <?php

        /** Page Templates **/

        include( 'page-templates/home.php' );
        include( 'page-templates/about.php' );
        include( 'page-templates/resume.php' ); // NEW Page
        include( 'page-templates/portfolio.php' );
        include( 'page-templates/contact.php' );

            /** Ununsed templates on this site
                include( 'page-templates/blog.php' );
                include( 'page-templates/features.php' );
                include( 'page-templates/gallery.php' );
                include( 'page-templates/slideshow.php' );
            **/

        ?>
        
        <?php include( 'private/functions.php' ); // JavaScript files for the site ?>

    </body>
</html>