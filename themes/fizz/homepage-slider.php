<!-- begin #slider -->

<div id="slider_container">
	<div class="flexslider loading wrapper <?php echo of_get_option('slidereffect'); ?>">
		<ul class="slides">
			
			<?php
				$captions = array();
				$tmp = $wp_query;
				$slider = get_term_by('id', of_get_option('slidertag'), 'sliders' ) ;
				$slider = $slider->slug;
				$wp_query = new WP_Query('post_type=featured&orderby=menu_order&order=ASC&sliders='. $slider.'&posts_per_page=99');
				if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
				$fitemlink = get_post_meta($post->ID,'snbf_fitemlink',true);
				$fitemcaption = get_post_meta($post->ID,'snbf_fitemcaption',true);

			?>
        	

			<?php
				$thumbId = get_image_id_by_link ( get_post_meta($post->ID, 'snbf_slideimage_src', true) );
				$thumb = wp_get_attachment_image_src($thumbId, 'slide', false);

			?>
			<li>
				<?php if ($fitemlink!='') : ?>
				<a href="<?php echo $fitemlink ?>"><img src="<?php echo $thumb[0] ?>" alt="<?php echo $fitemcaption ?>" /></a>
				<?php else : ?>
				<img src="<?php echo $thumb[0] ?>" alt="<?php echo $fitemcaption ?>" />	
				<?php endif ?>
				
			<?php if ($fitemcaption!='') : ?>
			<div class="flex-caption">
				<h3><?php echo $fitemcaption ?></h3>
			</div>
			<?php endif ?>
			</li>


		    <?php
		    endwhile; wp_reset_query();
		    endif;
		    $wp_query = $tmp;
	    	?>
		</ul>
	</div>
</div>

<!-- end #slider -->


<!-- flex slider & slider settings -->
<script type="text/javascript">
jQuery.noConflict();
	jQuery(document).ready(function(){


		function getSliderDirection() {
		    return (jQuery(window).width() < 768) ? "horizontal" : "vertical";
		}


		if ( jQuery( '.flexslider' ).length && jQuery() ) {
		jQuery('.flexslider').flexslider({ 
			animation:'<?php if(of_get_option('slidereffect')==''): echo 'slide';
				  else: echo of_get_option('slidereffect');
				  endif;?>',
			direction: getSliderDirection(),
			controlNav:true,
			directionNav:false,
			animationLoop: true,  
			controlsContainer:"",
			pauseOnHover: true,  
			nextText:"&rsaquo;",
			prevText:"&lsaquo;",
			keyboardNav: true,  
			slideshowSpeed: <?php if(of_get_option('sliderpausetime')==''): echo '3000';
				  else: echo of_get_option('sliderpausetime');
				  endif;?>,
			animationSpeed: <?php if(of_get_option('slideranimationspeed')==''): echo '500';
				  else: echo of_get_option('slideranimationspeed');
				  endif;?>,
			start: function(slider) {
				slider.removeClass('loading');
			}

		});
		}
	});
</script>

<!-- end flex slider & slider settings -->