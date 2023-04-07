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
<div class="news-slider-wrapper-home slider-container media-slider1">
	<div class="container slider-header">
		<div class="row">
			<div class="<?php echo implode(' ', $slider_header_classes); ?>">
				<h3 class="block-title ">
				<?php
					if( is_singular('news') ){
						echo esc_attr( pll__( 'Схожі новини' )); 
					} else {
						echo esc_attr( pll__( 'Новини' )); 
					}
				?></h3>
				
			</div>
			<div class="slider__show-all-posts <?php echo implode(' ', $slider_header_classes); ?>">
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
	<div class="container home-news-wrapper">
		<div class="row ">
		<?php 
			while ( $news->have_posts() ): $news->the_post();
				include get_template_directory() . '/template-parts/content/home-content-news.php';
			endwhile;	wp_reset_postdata(); 
		?>
		</div>
	</div>
	
</div>