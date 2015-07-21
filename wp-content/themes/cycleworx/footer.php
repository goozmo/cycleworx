		<?php
		global $avia_config;
		$blank = isset($avia_config['template']) ? $avia_config['template'] : "";

		//reset wordpress query in case we modified it
		wp_reset_query();


		//get footer display settings
		$the_id 				= avia_get_the_id(); //use avia get the id instead of default get id. prevents notice on 404 pages
		$footer 				= get_post_meta($the_id, 'footer', true);
		$footer_widget_setting 	= !empty($footer) ? $footer : avia_get_option('display_widgets_socket');


		//check if we should display a footer
		if(!$blank && $footer_widget_setting != 'nofooterarea' )
		{
			if( $footer_widget_setting != 'nofooterwidgets' )
			{
				//get columns
				$columns = avia_get_option('footer_columns');
		?>
				<div class='container_wrap footer_color' id='footer'>

					<div class='container'>

						<?php
						do_action('avia_before_footer_columns');

						//create the footer columns by iterating

						
				        switch($columns)
				        {
				        	case 1: $class = ''; break;
				        	case 2: $class = 'av_one_half'; break;
				        	case 3: $class = 'av_one_third'; break;
				        	case 4: $class = 'av_one_fourth'; break;
				        	case 5: $class = 'av_one_fifth'; break;
				        	case 6: $class = 'av_one_sixth'; break;
				        }
				        
				        $firstCol = "first el_before_{$class}";

						//display the footer widget that was defined at appearenace->widgets in the wordpress backend
						//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
						for ($i = 1; $i <= $columns; $i++)
						{
							$class2 = ""; // initialized to avoid php notices
							if($i != 1) $class2 = " el_after_{$class}  el_before_{$class}";
							echo "<div class='flex_column {$class} {$class2} {$firstCol}'>";
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
							echo "</div>";
							$firstCol = "";
						}

						do_action('avia_after_footer_columns');

						?>


					</div>


				<!-- ####### END FOOTER CONTAINER ####### -->
				</div>

	<?php   } //endif nofooterwidgets ?>



			

			<?php

			//copyright
			$copyright = do_shortcode( avia_get_option('copyright', "&copy; ".__('Copyright','avia_framework')."  - <a href='".home_url('/')."'>".get_bloginfo('name')."</a>") );

			// you can filter and remove the backlink with an add_filter function
			// from your themes (or child themes) functions.php file if you dont want to edit this file
			// you can also just keep that link. I really do appreciate it ;)
			// $kriesi_at_backlink = kriesi_backlink(get_option(THEMENAMECLEAN."_initial_version"));
			$kriesi_at_backlink = "Powered by <a href='http://goozmo.com'>Goozmo Systems.</a> Printed on recycled data.";

			//you can also remove the kriesi.at backlink by adding [nolink] to your custom copyright field in the admin area
			if($copyright && strpos($copyright, '[nolink]') !== false)
			{
				$kriesi_at_backlink = "";
				$copyright = str_replace("[nolink]","",$copyright);
			}

			if( $footer_widget_setting != 'nosocket' )
			{

			?>

				<footer class='container_wrap socket_color' id='socket' <?php avia_markup_helper(array('context' => 'footer')); ?>>
                    <div class='container'>

                        <span class='copyright'><?php echo $copyright . ' ' . $kriesi_at_backlink; ?></span>

                        <?php
                        	if(avia_get_option('footer_social', 'disabled') != "disabled")
                            {
                            	$social_args 	= array('outside'=>'ul', 'inside'=>'li', 'append' => '');
								echo avia_social_media_icons($social_args, false);
                            }
                        
                            echo "<nav class='sub_menu_socket' ".avia_markup_helper(array('context' => 'nav', 'echo' => false)).">";
                                $avia_theme_location = 'avia3';
                                $avia_menu_class = $avia_theme_location . '-menu';

                                $args = array(
                                    'theme_location'=>$avia_theme_location,
                                    'menu_id' =>$avia_menu_class,
                                    'container_class' =>$avia_menu_class,
                                    'fallback_cb' => '',
                                    'depth'=>1
                                );

                                wp_nav_menu($args);
                            echo "</nav>";
        
                        ?>

                    </div>

	            <!-- ####### END SOCKET CONTAINER ####### -->
				</footer>


			<?php
			} //end nosocket check


		
		
		} //end blank & nofooterarea check
		?>
		<!-- end main -->
		</div>
		
		<?php
		//display link to previeous and next portfolio entry
		echo avia_post_nav();

		echo "<!-- end wrap_all --></div>";


		if(isset($avia_config['fullscreen_image']))
		{ ?>
			<!--[if lte IE 8]>
			<style type="text/css">
			.bg_container {
			-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale')";
			filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale');
			}
			</style>
			<![endif]-->
		<?php
			echo "<div class='bg_container' style='background-image:url(".$avia_config['fullscreen_image'].");'></div>";
		}
	?>


<?php




	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */


	wp_footer();


?>
<a href='#top' title='<?php _e('Scroll to top','avia_framework'); ?>' id='scroll-top-link' <?php echo av_icon_string( 'scrolltop' ); ?>><span class="avia_hidden_link_text"><?php _e('Scroll to top','avia_framework'); ?></span></a>

<div id="fb-root"></div>

<script>
var _cjTransitionProp = candyjar.api.evCSSanimationProperty( [ 'webkitTransitionEnd', 'transitionend', 'otransitionend', 'transitionend'] ),  
_cjTransformProp = candyjar.api.evCSSanimationProperty( [ 'webkitTransform', 'transform', 'msTransform', 'mozTransform', 'oTranform'] ), requestAnimationFrame = window.webkitRequestAnimationFrame || window.requestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame,
_cjTransition = candyjar.api.evCSSanimationProperty( ['webkitTransition', 'transition' ] );

// console.log( _cjTransition );

var docInst = {
	// header
	cj_header : document.getElementById( 'header' ),
	
	init : function(){
		// header
		this.cj_header.style[_cjTransformProp] = "translate( 0px, -" + this.cj_header.offsetHeight + "px )";
		
		// animations
		// var animateMePlease = new Array();
		// var aData = { ele : $('#_cj-hSection2').find( '._cj-content-container' )[0], cardinal : 'left' };
		// animateMePlease.push( aData );
		// candyAnimationHandler.init( animateMePlease );
		
		console.log( 'init' );
		
	},
	
	getScrollPos : function(){
		if( document.documentElement.scrollTop == 0 ){
			return document.body.scrollTop;
		}
		else{
			return document.documentElement.scrollTop;
		}
	},
	
	setTranslate : function( ele, yPos ){
			var value = "translate( 0px, " + yPos + "px )";
			ele.style[_cjTransformProp] = value;
	},
	
	handler : function( ovr ){
		// header
		
		//console.log( this.cj_header.offsetHeight );
		
		if( this.getScrollPos() > this.cj_header.offsetHeight || ovr ){
			this.setTranslate( this.cj_header, 0 );
			candyjar.api.classify( this.cj_header, 'candyjarScroll-active' );
		}
		else if( this.getScrollPos() < this.cj_header.offsetHeight ){
			this.setTranslate( this.cj_header, this.cj_header.offsetHeight * -1 );
			candyjar.api.declassify( this.cj_header, 'candyjarScroll-active' );
		}
	},
}
candyjar.api.evLoad(function(){
	if( window.innerWidth > 766 && document.getElementsByClassName( 'home' ).length > 0 ){
		docInst.init();
	}
	else
	{
		document.getElementById( 'header' ).style[_cjTransformProp] = "translate( 0,0 )";
	}
	
	candyjar.api.evResize( function(){
		if( window.innerWidth > 766 ){
			docInst.init();
		}
		else{
			document.getElementById( 'header' ).style[_cjTransformProp] = "translate( 0,0 )";
		}
	});
	
	var sooperdooperfunction = function(){
		if( window.innerWidth > 766 ){
			docInst.handler();
		}
	}	
	candyjar.api.evScrollFunc(function(){
		sooperdooperfunction();
	});
	
	//button_inst = [];
	//var menu_triggers = document.getElementById('_goo-header-hotlink').getElementsByClassName( '_quo-fast-button' );
	//var _goo_override = true;
	//for( var i = 0; i < menu_triggers.length; i++ ){
	//	button_inst[i] = new candyjar.ui.fastButton( menu_triggers[i], function(){docInst.handler( _goo_override )} );
	//}
	
	
	
	if( client.browser.safari === 0 ){
		// logo animations
		var layer1 = document.getElementById( '_goo-layer1' );
		var layer2 = document.getElementById( '_goo-layer2' );
		var layer3 = document.getElementById( '_goo-layer3' );
		var layer4 = document.getElementById( '_goo-layer4' );
		
		layer2.style.opacity = 0;
		layer2.style[_cjTransition] = "opacity 0.2s ease-out";
		layer3.style.opacity = 0;
		layer3.style[_cjTransition] = "opacity 0.2s ease-out";
		layer4.style.opacity = 0;
		layer4.style[_cjTransformProp] = "translate(200px,0)";
		
		var _cjPreLoaderCheck = setInterval(
		function(){
			// console.log( _cjPreLoader.complete );
			/*
				I stuck this variable in /Volumes/Macintosh HD/Users/clintoncantrell/Sites/cycleworx/www/wp-content/themes/enfold/js/avia.js
				
			*/
			if( _cjPreLoader.complete ){
				dothething();
				clearInterval( _cjPreLoaderCheck );
			}
		}, 50);
		
		function dothething(){
			layer1.style[_cjTransformProp] = 'rotate(360deg)';
			layer4.style[_cjTransitionProp] = "opacity 0.2s ease-out, transform 0.2s ease-out";
			dothethingVal = true;
			// console.log( 'do the thing' );
		}
		
		//console.log( _cjTransitionProp )
		
		layer1.addEventListener( _cjTransitionProp, function(){
			layer4.style[_cjTransformProp] = "translate(-6px,0)";
			layer4.style.opacity = 1;
			
			layer4.addEventListener( _cjTransitionProp, function(){
				layer2.style.opacity = 1;
				layer3.style.opacity = 1;
			});
		});
	}
	
});	
</script>

<script>
candyjar.api.evLoad(function(){
	var _cjPreLoaderCheck = setInterval(
		function(){
			console.log( _cjPreLoader.complete );
			if( _cjPreLoader.complete ){
				clearInterval( _cjPreLoaderCheck );
			}
		}, 50);
});
</script>

</body>
</html>
