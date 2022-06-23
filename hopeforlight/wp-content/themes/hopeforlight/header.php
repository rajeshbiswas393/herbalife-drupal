<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 left-item">
                        <ul>
                            <li><i class="fas fa-envelope-square"></i> sales@smarteyeapps.com</li>
                            <li><i class="fas fa-phone-square"></i> +123 987 887 765</li>
                        </ul>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block right-item">
                        <ul>
                            <li><a><i class="fab fa-github"></i></a></li>
                            <li><a><i class="fab fa-google-plus-g"></i></a></li>
                            <li> <a><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a><i class="fab fa-twitter"></i></a></li>
                            <li> <a><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 no-padding col-sm-12 nav-img">
                        <img src="assets/images/logo.jpg" alt="Hope for Light">
                       <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                    </div>
                   <!-- <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
						
                      <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about_us.html">About Us</a></li>
                            <li><a href="events.html">Events</a></li>
                            <li><a href="portfolio.html">Portfolio</a></li>  
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="contact_us.html">Contact Us</a></li>
                        </ul>
                    </div> -->
					<?php
								$args = array(
									'menu' => 'Top Navigation',
									'container_class' => 'col-lg-8 col-md-9 d-none d-md-block nav-item',
									'container_id' => 'menu'
								);
								wp_nav_menu($args);
						
					?>
                    <div class="col-sm-2 d-none d-lg-block appoint">
                        <a href="https://pmny.in/EISnMulLmOWc" target="_blank"><button class="btn btn-success">Donate Now</button></a>
                    </div>
                </div>

            </div>
        </div>
		<div class="foating-donation-button">
			<a href="https://pmny.in/EISnMulLmOWc" target="_blank"><button class="btn btn-success">Donate Now</button></a>	
		</div>
    </header>
	
	<?php
		 if(!is_front_page()):

	
	?>
	 <!--  ************************* Page Title Starts Here ************************** -->
	 <div class="page-nav no-margin row">
                   <div class="container">
                       <div class="row">
                           <h2><?php single_post_title(); ?>
</h2>
                           <ul>
                               <li> <a href="/"><i class="fas fa-home"></i> Home</a></li>
                               <li><i class="fas fa-angle-double-right"></i><?php single_post_title(); ?>
</li>
                           </ul>
                       </div>
                   </div>
               </div>
       
    <!-- ######## Page  Title End ####### -->
	<?php
		endif;
	
	?>
