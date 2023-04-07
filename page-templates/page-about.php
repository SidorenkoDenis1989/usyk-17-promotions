<?php /* Template Name: Про нас */ ?>

<?php get_header(); ?>
<div class="about_back">
	<div class="first-screen-boxer-shadow"></div>
	<div class="container backcrumbs_wrapper" >
		<div class="row">
			<div class="col-12">
				<?php breadcrumbs(); ?>
			</div>
		</div>
	</div>
	<?php 
		$banner_id = get_field('about_back'); 
		$mobile_id = get_field('mobile_screen');
		$add_class = '';
		if (!empty($mobile_id)){
			$add_class .= ' mobile_banner';
		}
	?>
	<div class="news-banner-wrapper <?php echo $add_class;?>">
		<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>	
		<?php 
			if (!empty($mobile_id)){
				echo get_image_html_code_by_id($mobile_id, array('mobile'));	
			}
		?>
		<?php the_title( '<h1 class="reb-block">', '</h1>' ); ?>
	</div>
	<?php $banner_id = get_field('back_image_new_mobile'); ?>
</div>
<div class="container about-wrapper">
	<div class="row">
		<div class="about-description-wrapper col-xl-11 offset-xl-1 col-12">
			<h2><?php the_field('about_title'); ?></h2>
			<div class="about-description">
				<div class="description-element left">
					<?php the_field('about_text_left'); ?>	
				</div>
				<div class="description-element right">
					<?php the_field('about_text_right'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about-team-wrapper">
	<div class="container">	
		<div class="row">
			<div class="about-team">
				<h2 class="block-title"><?php the_field('persons_title'); ?></h2>
				<?php
				if( have_rows('persons') ): ?>
					<div class="team-wrapper row">
					<?php while( have_rows('persons') ) : the_row(); ?>
						<div class="single-person col-xl-3 col-md-2 col-12">
							<?php $banner_id = get_sub_field('person_image'); ?>
							<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
							<h4><?php echo get_sub_field('person_name'); ?></h4>
							<p class="person-descr"><?php echo get_sub_field('person_desc'); ?></p>
						</div>
				    <?php 
						endwhile; 
					?>
				    </div>
			    <?php 
					endif;
			    ?>
			</div> 
		</div>
	</div>
</div>
<div class="container about-history-wrapper">
	<div class="row">
		<h2 class="bottom-red">
			<?php the_field('history_title'); ?>
		</h2>
		<?php
			if( have_rows('history_wrapper') ): $counter=1; ?>
				<div class="history-wrapper">

				<?php while( have_rows('history_wrapper') ) : the_row(); ?>
					<?php 
						$direction = 'right';
						if ($counter % 2 == 0){
							$direction = 'left';
						}
					?>

					<div class="col-12 history-element">
						<div class="line"></div>
						<div class="history-element-wrapper">
							<div class="date"><?php echo get_sub_field('history_date'); ?></div>
							<div class="history-description <?php echo $direction; ?>"><?php echo get_sub_field('history_decr'); ?></div>	
						</div>
					</div>
			    <?php
			    	$counter++; 
					endwhile; 
				?>
			    </div>
		    <?php 
				endif;
		    ?>
	</div>
</div>
<div class="about-counters">
	<div class="container ">
		<div class="row">
			<div class="about-conters-wrapper">
				<h2 class=""><?php the_field('counter_title'); ?></h2>
				<div class="counters-wrapper">
					<?php
						$counter_array = array();
						$counter_array['match'] = get_field('matches', 'option');
						$counter_array['boxers'] = get_field('boxers_qty', 'option');
						$counter_array['tituls'] = get_field('titles', 'option');
					?>
					<?php foreach($counter_array as $key => $value){
						if (!empty($value)){ ?>
							<div class="single-counter">
								<p class="title">
									<?php
										$argument = $key.'_title';
								 		echo get_field($argument);
								 	?>
								</p>
								<p class="value">
									<?php echo $value; ?>
								</p>
							</div>	
						<?php }	
					} ?>
				</div>
			</div>
		</div>	
	</div>
	<svg xmlns="http://www.w3.org/2000/svg" width="1920" height="300" viewBox="0 0 1920 300" fill="none" id="counters-uzor">
		<path d="M0 195.172L414.784 329H1158.73L1093.03 300.917L1204.31 244.751L1920 293.809V150.621L1525.32 118.031L1920 -33.3057V-289L744.288 187.545L0 -51.681V195.172Z" fill="white" fill-opacity="0.08"/>
	</svg>
</div>
<div id="photo">
	<?php
		$media_term = 'photo';
		$term = 'photo';
		$photos =  array();
		if( have_rows('media_photos') ):
		    while( have_rows('media_photos') ) : the_row();
		        $photos[] = get_sub_field('media_photo');
		    endwhile;
	    endif;
	    if (count($photos)) :
			$args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> 'media',
				'posts_per_page' 	=> -1,
				'post__in' 			=> $photos,
				'orderby' 			=> 'post__in'
			);
			
			$media = new WP_Query($args);
			if ( $media->have_posts() ):
				$arrow_classes = [];
	
				if( $media->found_posts < 4 ) {
					$arrow_classes[] = 'hide-for-xl';
				}

				if( $media->found_posts < 3 ) {
					$arrow_classes[] = 'hide-for-md';
				} 

				$slider_header_classes = ['col-sm-6 col-6'];
				$media_term_obj = get_term_by('slug', $term, 'media_cat');
	?>
				<div class="media-slider-wrapper slider-container media-slider media-slider__<?php echo $term; ?>">
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
									<a href="<?php echo get_term_link($media_term_obj->term_id); ?>" class="uppercase">
										<?php echo __('Подивитися всі фото', 'usyk17promotions'); ?>
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
							while($media->have_posts()) { $media->the_post();
			                    $post_counter = $media->found_posts;
			                    include get_template_directory() .  '/template-parts/content/content-media.php';
							}
			                wp_reset_postdata(); ?>
			            </div>
			        </div>
		        	<div class="container">
						<div class="row">
							<div class="col-12 slider__show-all-posts">
								<a href="<?php echo get_term_link($media_term_obj->term_id); ?>" class="uppercase">
									<?php 
											echo esc_attr ( pll__('Подивитися всі фото'));								 
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
    <?php 
			endif;
		endif;
	?>
</div>
<div id="video">
	<?php
		$media_term = 'video';
		$videos =  array();
		if( have_rows('media_videos') ):
		    while( have_rows('media_videos') ) : the_row();
		        $videos[] = get_sub_field('media_video');
		    endwhile;
	    endif;
	    if (count($videos)) : 
			$args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> 'media',
				'posts_per_page' 	=> -1,
				'post__in' 			=> $videos,
				'orderby' 			=> 'post__in'
			);
			
			$media = new WP_Query($args);
			if ( $media->have_posts() ):
				include get_template_directory() .  '/template-parts/about-media-slider.php';
			endif;
		endif;
		
	?>
</div>
<?php get_footer(); ?>