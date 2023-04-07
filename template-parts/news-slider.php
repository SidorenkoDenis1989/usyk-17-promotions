<?php 
	$arrow_classes = [];
	
	if( $news->found_posts < 4 ) {
		$arrow_classes[] = 'hide-for-xl';
	}

	if( $news->found_posts < 3 ) {
		$arrow_classes[] = 'hide-for-md';
	} 

	$slider_header_classes = ['col-sm-6 col-6'];

	if( is_singular('news') ) {
		$arrow_classes[] = 'col-12';
	} else {
		$arrow_classes[] = 'col-6';
	}
 
?>
<div class="news-slider-wrapper slider-container media-slider1">
	<div class="container slider-header">
		<div class="row">
			<div class="<?php echo implode(' ', $slider_header_classes); ?>">
				<h3 class="block-title">
				<?php
					if( is_singular('news') ){
						echo esc_attr( pll__( 'Схожі новини' )); 
					} else {
						echo esc_attr( pll__( 'Новини' )); 
					}
				?></h3>
			</div>
			<div class="col-sm-6 col-6 slider-arrows">
				<?php if( $news->found_posts > 1 ): ?>
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
					<a href="<?php echo get_post_type_archive_link('news'); if( $search_boxer_id) { echo '?boxer=' . $boxer_id; }; ?>" class="uppercase">
						<?php echo esc_attr( pll__( 'Подивитися всі новини' )); ?>
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
		<div class="row slider-row slider-news">
		<?php 
			while ( $news->have_posts() ): $news->the_post();
				include get_template_directory() . '/template-parts/content/content-news.php';
			endwhile;	wp_reset_postdata(); 
		?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 slider__show-all-posts">
				<a href="<?php echo get_post_type_archive_link('news'); if( $search_boxer_id) { echo '?boxer=' . $boxer_id; }; ?>" class="uppercase">
					<?php echo esc_attr( pll__( 'Подивитися всі новини' )); ?>
					<svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 3H14V5H0V3Z" fill="black"/>
						<path d="M19 4L14 8V0L19 4Z" fill="black"/>
					</svg>		
				</a>
			</div>
		</div>
	</div>	
</div>