<?php 
	$arrow_classes = [];
	
	if(  ($media_term == 'photo' && $media->found_posts < 4) || ($media_term == 'video' && $media->found_posts < 3) ) {
		$arrow_classes[] = 'hide-for-xl';
	}

	if( ($media_term == 'photo' && $media->found_posts < 3) || ($media_term == 'video' && $media->found_posts < 2) ) {
		$arrow_classes[] = 'hide-for-md';
	} 

	$slider_header_classes = ['col-sm-6 col-6'];
	$media_term_obj = get_term_by('slug', $media_term, 'media_cat'); 
 
?>
<div class="media-slider-wrapper slider-container media-slider media-slider__<?php echo $media_term; ?>">
	<div class="container slider-header">
		<div class="row">
			<div class="<?php echo implode(' ', $slider_header_classes); ?>">
				<h3 class="block-title">
				<?php echo $media_term_obj->name; ?></h3>
			</div>
			<div class="col-sm-6 col-6 slider-arrows">
				<?php if( $media->found_posts > 1 ): ?>
				<a href="#" class="slider-arrow slider-arrow-prev <?php echo implode(' ', $arrow_classes); ?>">
					<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19 2.99951H5V4.99951H19V2.99951Z" fill="white"/>
						<path d="M0 3.99951L5 7.99951V-0.000488281L0 3.99951Z" fill="white"/>
					</svg>
				</a>
				<a href="#" class="slider-arrow slider-arrow-next <?php echo implode(' ', $arrow_classes); ?>">
					<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 2.99951H14V4.99951H0V2.99951Z" fill="white"/>
						<path d="M19 3.99951L14 7.99951V-0.000488281L19 3.99951Z" fill="white"/>
					</svg>
				</a>
				<?php endif ?>
				<div class="slider__show-all-posts only-mobile">
					<a href="<?php echo get_term_link($media_term_obj->term_id); if( $search_boxer_id) { echo '?boxer=' . $boxer_id; }; ?>" class="uppercase">
						<?php 
							if($media_term == 'video'){
								echo __('Подивитися всі вiдео', 'usyk17promotions');
							}
							if($media_term == 'photo'){
								echo __('Подивитися всі фото', 'usyk17promotions');
							}
							 
						?>
						<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 3H14V5H0V3Z" fill="black"/>
							<path d="M19 4L14 8V0L19 4Z" fill="black"/>
						</svg>		
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row <?php if( $media_term == 'video' ) { echo 'slider-row-video-about'; } else {echo 'slider-row-photo';} ?> slider-media">
		<?php 
			while ( $media->have_posts() ): $media->the_post();
				include get_template_directory() . '/template-parts/content/about-content-media.php';
			endwhile;	wp_reset_postdata(); 
		?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 slider__show-all-posts">
				<a href="<?php echo get_term_link($media_term_obj->term_id); if( $search_boxer_id) { echo '?boxer=' . $boxer_id; }; ?>" class="uppercase">
					<?php 
						if($media_term == 'video'){
							echo esc_attr ( pll__('Подивитися всі вiдео'));
						}
						if($media_term == 'photo'){
							echo esc_attr ( pll__('Подивитися всі фото'));
						}
						 
					?>
					<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 3H14V5H0V3Z" fill="black"/>
						<path d="M19 4L14 8V0L19 4Z" fill="black"/>
					</svg>		
				</a>
			</div>
		</div>
	</div>	
</div>