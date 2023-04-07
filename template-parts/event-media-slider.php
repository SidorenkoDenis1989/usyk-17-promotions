<?php 
	$arrow_classes = [];
	
	if( $media->found_posts < 4 ) {
		$arrow_classes[] = 'hide-for-xl';
	}

	if( $media->found_posts < 3 ) {
		$arrow_classes[] = 'hide-for-md';
	} 

	$slider_header_classes = ['col-sm-6, col-6'];
	$media_post_type_obj = get_post_type_object( 'media' );
	$title = apply_filters('post_type_archive_title', $media_post_type_obj->labels->name );
	$post_counter = true;
	$event_media_sider = true;
 
?>
<div class="media-slider-wrapper slider-container media-slider media-slider__<?php echo $media_term; ?>">
	<div class="container slider-header">
		<div class="row">
			<div class="<?php echo implode(' ', $slider_header_classes); ?>">
				<h3 class="block-title"><?php echo $title; ?></h3>
			</div>
			<div class="col-sm-6 col-6 slider-arrows">
			<?php 
				if($home_page_media): ?>
				<div class="slider__show-all-posts">
					<a href="<?php echo get_post_type_archive_link('media'); ?>" class="uppercase">
						<?php echo esc_attr( pll__( 'Більше медіа' )); ?>
						<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 3H14V5H0V3Z" fill="black"/>
							<path d="M19 4L14 8V0L19 4Z" fill="black"/>
						</svg>		
					</a>
				</div>
			<?php 
				else: 
					if( $media->found_posts > 1 ): ?>
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
					<?php endif;
				endif;
			?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row slider-media slider-row event-slider-media">
		<?php 
			while ( $media->have_posts() ): $media->the_post();
				$post_id = get_the_ID();
				$term = wp_get_post_terms( $post_id, 'media_cat' )[0]->slug;
				include get_template_directory() . '/template-parts/content/content-media.php';
			endwhile;	wp_reset_postdata(); 
		?>
		</div>
	</div>	
</div>