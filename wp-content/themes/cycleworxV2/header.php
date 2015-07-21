<?php
	global $avia_config;

	$style 		= $avia_config['box_class'];
	$responsive	= avia_get_option('responsive_active') != "disabled" ? "responsive" : "fixed_layout";
	$blank 		= isset($avia_config['template']) ? $avia_config['template'] : "";	
	$av_lightbox= avia_get_option('lightbox_active') != "disabled" ? 'av-default-lightbox' : 'av-custom-lightbox';
	$preloader	= avia_get_option('preloader') == "preloader" ? 'av-preloader-active av-preloader-enabled' : 'av-preloader-disabled';

	
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo " html_{$style} ".$responsive." ".$preloader." ".$av_lightbox." ".avia_header_class_string();?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- page title, displayed in your browser bar -->
<title><?php if(function_exists('avia_set_title_tag')) { echo avia_set_title_tag(); } ?></title>

<?php
/*
 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
 * located in framework/php/function-set-avia-frontend.php
 */
 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }


 /*
 * outputs a favicon if defined
 */
 if (function_exists('avia_favicon'))    { echo avia_favicon(avia_get_option('favicon')); }
?>


<!-- mobile setting -->
<?php

if( strpos($responsive, 'responsive') !== false ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
?>


<!-- Scripts/CSS and wp_head hook -->
<?php
/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */

wp_head();

?>

</head>




<body id="top" <?php body_class($style." ".$avia_config['font_stack']." ".$blank); avia_markup_helper(array('context' => 'body')); ?>>

	<?php 
		
	if("av-preloader-active av-preloader-enabled" === $preloader)
	{
		echo avia_preload_screen(); 
	}
		
	?>

	<div id='wrap_all'>

	<?php 
	if(!$blank) //blank templates dont display header nor footer
	{ 
		 //fetch the template file that holds the main menu, located in includes/helper-menu-main.php
         get_template_part( 'includes/helper', 'main-menu' );

	} ?>
		
	<div id='main' data-scroll-offset='<?php echo avia_header_setting('header_scroll_offset'); ?>'>
	
	<style>
		
		#tysons-buttons
		{
			width: 100%;
			position: absolute;
			top: 550px;
			z-index: 100;
			text-align: center;
		}
			#tysons-buttons .tysons-buttons-container a.button
			{
				display: inline-table;
				min-width: 250px;
				padding: 15px 40px;
				margin: 0 5px;
				
				background-color: rgb( 148, 29, 30 );
				border-radius: 4px;
				
				color: #fff;
				font-size: 1.6em;
				font-weight: bold;
				font-family: 'Raleway', sans-serif;
				text-transform: uppercase;
			}
			
			#tysons-buttons .tysons-buttons-container a.button:hover
			{
				background-color: rgb( 118, 0, 0 );
			}
			
			@media screen and ( max-width: 720px ){
				
				#tysons-buttons .tysons-buttons-container a.button
				{
					width: 90%;
					margin: 5%;	
				}
				
				#tysons-buttons
				{
					top: 400px;
				}
				
			}
		
	</style>
	
	<div id="tysons-buttons">
		<div class="tysons-buttons-container">
			
			<a href="/" class="button">Services</a>
			<a href="/" class="button">Visit Us</a>
			
		</div>
	</div>
	
	<?php do_action('ava_after_main_container'); ?>
