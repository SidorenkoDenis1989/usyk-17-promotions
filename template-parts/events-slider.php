<?php
	$arrow_classes = [];
	if( count($events_ids) < 3 ) {
		$arrow_classes[] = 'hide-for-xl';
	}

	if( count($events_ids) < 2 ) {
		$arrow_classes[] = 'hide-for-md';
	}
	$home_events_slider = true;
?>
<div class="boxers-slider-wrapper slider-container media-slider">
	<div class="container slider-header">
		<div class="row justify-content-center">
			<div class="col-12">
				<h3 class="block-title block-title-white">
				<?php echo esc_attr( pll__( 'Заходи' )); ?></h3>
			</div>
		</div>
	</div>
	<div class="container">
        <?php if( count(get_field('boxers')) > 1 ): ?>
            <a href="#" class="slider-arrow slider-arrow-prev <?php echo implode(' ', $arrow_classes); ?>">
                <svg width="33" height="62" viewBox="0 0 33 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 1L2 31L32 61" stroke="white" stroke-width="2"/>
                </svg>
            </a>
            <a href="#" class="slider-arrow slider-arrow-next <?php echo implode(' ', $arrow_classes); ?>">
                <svg width="33" height="62" viewBox="0 0 33 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L31 31L1 61" stroke="white" stroke-width="2"/>
                </svg>
            </a>
        <?php endif; ?>
		<div class="row slider-row-events">
		<?php 
			foreach($events_ids as $post_id):
				include get_template_directory() . '/template-parts/content/content-events.php';
			endforeach; 
		?>
		</div>
	</div>	
</div>