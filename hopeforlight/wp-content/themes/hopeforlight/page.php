<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>
   <section class="with-medical">
        <div class="container">
            
            <div class="row">
               <!--<div class="col-lg-12 col-md-12">
                    <img src="<?php echo get_template_directory_uri() ;?>/assets/images/about.jpg" alt="">
                </div> -->
                <div class="col-lg-12 col-md-12 txtr">
						<?php the_content(); ?>
                </div>
                
            </div>
        </div>
    </section>
<?php

get_footer();
