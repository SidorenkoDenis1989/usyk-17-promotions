<?php
	$arrow_classes = [];
	if( count(get_field('boxers')) < 4 ) {
		$arrow_classes[] = 'hide-for-xl';
	}

	if( count(get_field('boxers')) < 3 ) {
		$arrow_classes[] = 'hide-for-md';
	}

?>
<div class="boxers-slider-wrapper slider-container media-slider">
	<div class="container slider-header">
		<div class="row">
			<div class="col-6">
				<h3 class="block-title">
				<?php echo esc_attr( pll__( 'Боксери' )); ?></h3>
			</div>
			<div class="col-6 slider-arrows">
				<div class="slider__show-all-posts">
					<a href="<?php echo get_post_type_archive_link('boxers'); ?>" class="uppercase">
						<?php echo esc_attr( pll__( 'Подивитися всіх боксерів' )); ?>
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
        <?php if( count(get_field('boxers')) > 1 ): ?>
            <a href="#" class="slider-arrow slider-arrow-prev <?php echo implode(' ', $arrow_classes); ?>">
                <svg width="33" height="62" viewBox="0 0 33 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 1L2 31L32 61" stroke="black" stroke-width="2"/>
                </svg>
            </a>
            <a href="#" class="slider-arrow slider-arrow-next <?php echo implode(' ', $arrow_classes); ?>">
                <svg width="33" height="62" viewBox="0 0 33 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L31 31L1 61" stroke="black" stroke-width="2"/>
                </svg>
            </a>
        <?php endif; ?>
		<div class="row slider-row">
		<?php 
			while ( have_rows('boxers') ): the_row();
				$boxer_id = get_sub_field('boxer');
				include get_template_directory() . '/template-parts/content/content-boxer.php';
			endwhile;	wp_reset_postdata(); 
		?>
		</div>
	</div>	
</div>