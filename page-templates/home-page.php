<?php /* Template Name: Головна */ ?>

<?php get_header(); ?>
	<?php
		$banner_id = get_field('banner_image');
		$mobile_id = get_field('mobile_screen');
		$add_class = '';
		if (!empty($mobile_id)){
			$add_class .= ' mobile_banner';
		} 
		if($banner_id): 
	?>
	<section id="banner" class="section-banner section-wrapper light first-screen">
		<div class="banner-wrapper <?php echo $add_class;?>">
			<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
			<?php 
				if (!empty($mobile_id)){
					echo get_image_html_code_by_id($mobile_id, array('mobile'));	
				}
			?>
		</div>
		<div class="banner-text-wrapper">
			<div class="container content-wrapper">
				<div class="row">
					<div class="banner-text">
						<h2 class="dark"><?php the_field('banner_header'); ?></h2>
						<h3><?php the_field('banner_text'); ?></h3>
						<a href="<?php the_field('banner_link_href'); ?>"><?php the_field('banner_link_text'); ?> 
							<svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
								<path d="M0.000976562 3H14.001V5H0.000976562V3Z" fill="white"/>
								<path d="M19.001 4L14.001 8V0L19.001 4Z" fill="white"/>
							</svg>
						</a>
					</div>
				</div>
			</div>	
		</div>
	</section>
	<?php endif; ?>
	<section id="about-us" class="section-wrapper light section-padding about-us">
		<div class="container content-wrapper">
			<div class="row">
				<svg xmlns="http://www.w3.org/2000/svg" class="logo17" width="386" height="1043" viewBox="0 0 386 1043" fill="none">
					<path d="M160.41 194.216H0.998291V1043H160.41V194.216Z" fill="#F4F4F4"/>
					<path d="M0.998291 0V134.71H226.587V1042.64H385.998V0" fill="#F4F4F4"/>
				</svg>
				<div class="section-row">
						<h2 class="block-title"><?php the_field('about_us_title'); ?></h2>
				</div>
				<div class="section-row">
					<div class="about image">
						<?php $banner_id = get_field('about_us_img'); ?>
						<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
						<?php echo get_image_html_code_by_id($banner_id, array('full opacity')); ?>
					</div>
					<div class="about content">
						<div class="about counter-wrapper">
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
												$argument = 'about_us_'.$key.'_title';
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
						<div class="about text">
							<?php the_field('about_text'); ?>
						</div>
						<a href="<?php the_field('about_us_link_href'); ?>"><?php the_field('about_us_link_text'); ?> 
							<svg xmlns="http://www.w3.org/2000/svg" width="19" height="8" viewBox="0 0 19 8" fill="none">
								<path d="M0.000976562 3H14.001V5H0.000976562V3Z" fill="white"/>
								<path d="M19.001 4L14.001 8V0L19.001 4Z" fill="white"/>
							</svg>
						</a>
					</div>
				</div>
			</div>	
		</div>
	</section>
	<?php 
		$events_ids = get_field('events');
		if( is_array($events_ids) && count($events_ids) > 0 ):
	?>
	<section id="home-events">
		<svg width="1920" height="940" viewBox="0 0 1920 940" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g opacity="0.06">
			<path d="M0 104.248L1295.59 492.432L1920 305.355V183.063L1811.89 201.078L0 -246V104.248Z" fill="white"/>
			<path d="M1107.09 535.563L0 781.88V490.526L198.376 475.283L0 376.895V234.163L1107.09 535.563Z" fill="white"/>
			<path d="M0 1186L1794.04 888.064L1920 934.66V427.648L0 892.914V1186Z" fill="white"/>
			</g>
		</svg>
		<?php include get_template_directory() .  '/template-parts/events-slider.php'; ?>
	</section>
	<?php
		endif; 
		if( have_rows('boxers') ): ?>
	<section id="home-boxers">
		 <?php include get_template_directory() .  '/template-parts/boxers-slider.php'; ?>	
	</section>
	<?php endif; ?>
	<?php 
		$news_ids = get_field('news');
		if( is_array($news_ids) && count($news_ids) > 0 ):
	?>
	<section id="home-news">
		<?php
			$args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> 'news',
				'posts_per_page' 	=> -1,
				'orderby' 			=> 'publish_date',
				'order'				=> 'DESC',
				'post__in'			=> $news_ids,
				'filter_by_repeater'=> 'yes',
				'meta_query' 		=> array(
				)
			);

			$meta_query = array('relation' => 'AND');
			$news = new WP_Query($args);
			
			if ( $news->have_posts() ):
				include get_template_directory() .  '/template-parts/home-news-slider.php';
			endif;
		?>
	</section>
	<?php endif; ?>
	
	
	<section id="subscribe" class="section-wrapper light subscribe">
		<div class="subscribe_image">
			<?php $banner_id = get_field('subscribe_background'); ?>
			<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
		</div>
		<div class="container content-wrapper">
			<div class="row">
				<div class="section-row">
						<?php echo do_shortcode(get_field('subscribe_form')); ?>
				</div>
			</div>	
		</div>
	</section>
	<?php 
		$media_ids = get_field('media');
		if( $media_ids ):
			$args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> 'media',
				'posts_per_page' 	=> -1,
				'post__in' 			=> $media_ids,
				'orderby'			=> 'post__in'
			);
			
			$media = new WP_Query($args);
			$home_page_media = true;
	?>
		<section id="home-media">
		<?php
			if ( $media->have_posts() ):
				include get_template_directory() .  '/template-parts/event-media-slider.php';
			endif;
		?>
		</section>
	<?php
		endif; 
	?>
	<section id="shop" class="section-wrapper light shop">
		<div class="usik_back">
			<?php $banner_id = get_field('usik_back'); ?>
			<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
		</div>
		<div class="container content-wrapper">
			<div class="row">
				<div class="logo_17_yellow">
					<svg xmlns="http://www.w3.org/2000/svg" width="300" height="398" viewBox="0 0 300 398" fill="none">
						<g style="mix-blend-mode:difference">
							<path d="M124.217 151.016H0V811H124.217V151.016Z" fill="#FFB32C"/>
							<path d="M0 0V104.746H175.784V810.716H300V0" fill="#FFB32C"/>
						</g>
					</svg>
				</div>
				<div class="img_usik">
					<?php $banner_id = get_field('usik'); ?>
					<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
					<?php $banner_id_mobile = get_field('usik_mobile'); ?>
					<?php echo get_image_html_code_by_id($banner_id_mobile, array('usyk-mobile')); ?>
				</div>
				<div class="usik_content">
					
					<h2><?php the_field('usik_title'); ?></h2>
					<h3><?php the_field('usik_subtitle'); ?></h2>
					<a href="<?php echo get_field('shop_link', 'option'); ?>" target="_blank">
						<?php the_field('usik_button'); ?>							
					</a>	
				</div>	
			</div>
		</div>
	</section>
<?php get_footer(); ?>