<?php
/**
* Template Name: Gallery
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header();

?>
  <!-- ################# Slider Starts Here#######################--->
    
 <!--  ************************* Portfolio Starts Here ************************** -->
        <div class="gallery">    
           <div class="container">
              <div class="row">
                

        <div class="gallery-filter d-none d-sm-block">
            <button class="btn btn-default filter-button" data-filter="all">All</button>
            <button class="btn btn-default filter-button" data-filter="hdpe">Finance</button>
            <button class="btn btn-default filter-button" data-filter="sprinkle">Child Education</button>
            <button class="btn btn-default filter-button" data-filter="spray"> Fund Raising</button>
            <button class="btn btn-default filter-button" data-filter="irrigation">Donation</button>
        </div>
        <br/>



            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_01.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_02.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_03.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_04.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_05.jpg" class="img-responsive">
            </div>

          

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_06.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_06.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_08.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_09.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_10.jpg" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_11.jpg" class="img-responsive">
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="<?php echo get_template_directory_uri() ;?>/assets/images/gallery/gallery_12.jpg" class="img-responsive">
            </div>
        </div>
    </div>
       
       
       </div>
        <!-- ######## Gallery End ####### -->

<?php

get_footer();
