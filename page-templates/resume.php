<!-- Resume page -->

<div id="resume-page" class="page" data-id="resume" data-height-fixed="false" >
     <div class="pgContent">

<!-- If you need to show the page content inside the scroll bar, just enable the below div tag and
	 remove the data-height-fixed attribute on the above page div tag-->

		<!--<div class="add_scroll full_size">-->
        <!-- Below content are placed inside the Scrollbar -->


         <div class="row" > <div class="bottom_spacing"></div> </div>

         <div class="full_width" >
			<div class="mobile_spacing" >
            	<!-- Tab Example-->
             	<h1 class="title_light">Resume</h1>
             	<br>
        		 <!-- Tab Navigation Begin -->
                 <ul class="tabs">
                 	<!-- Set class name active to the required li tag-->
					<li><a class="active"  href="#stage">Stage</a></li>
                    <li><a href="#film">Film</a></li>
                    <li><a href="#vo">Voice Over</a></li>
                    <li><a href="#training">Training</a></li>
                 </ul>

                 <!-- Tab Content -->
                 <ul class="tabs-content">
					<!-- Set class name active to the corresponding li tag-->
                
                    <?php include( 'resume-tabs/stage-tab.php' ); ?>
                    <?php include( 'resume-tabs/film-tab.php' ); ?>
                    <?php include( 'resume-tabs/voice-over-tab.php' ); ?>
                    <?php include( 'resume-tabs/training-tab.php' ); ?>
                     
                </ul>
                <div class="separator_mini"></div>
                
        	</div>
        </div>
    </div>
</div>