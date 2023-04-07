<?php 
	get_header();
	$post_img_id = get_field('main_img', $post_id);
	$mobile_id = get_field('mobile_screen');
	$add_class = '';
	if (!empty($mobile_id)){
		$add_class .= ' mobile_banner';
	} 
?>
<div class="first-screen first-screen__media <?php echo $add_class;?>">
	<?php
		echo get_image_html_code_by_id($post_img_id, array('full'));
		if (!empty($mobile_id)){
			echo get_image_html_code_by_id($mobile_id, array('mobile'));	
		} 
	?>
	<div class="first-screen-boxer-shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php breadcrumbs(); ?>
			</div>
		</div>
	</div>
</div>
<?php 
	$event_description = get_the_content($post_id);
	$title = get_the_title();
	if($title || $event_description):
?>
	<div class="media-about">
		<div class="container">
			<div class="row align-content-center">
				<div class="col-xl-6 media-phrase uppercase">
					<h1 class="media-phrase uppercase"><?php echo $title; ?></h1>
				</div>
				<div class="col-xl-6 media-about-content">
					<?php echo $event_description; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;
	$media_gallery_ids 	= get_field('media', $post_id);
	$news_ids 			= get_field('news', $post_id);
?>
<div class="events__media">
<?php 
	if( count($media_gallery_ids) > 0 ): 
		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'media',
			'posts_per_page' 	=> -1,
			'post__in' 			=> $media_gallery_ids,
		);
		
		$media = new WP_Query($args);
		if ( $media->have_posts() ):
			include get_template_directory() .  '/template-parts/event-media-slider.php';
		endif;
	endif; 
?>
</div>
<div class="events__news">
<?php
	if( count($news_ids) > 0 ): 
		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'news',
			'posts_per_page' 	=> -1,
			'post__in' 			=> $news_ids,
		);
		$news = new WP_Query($args);
		if ( $news->have_posts() ):
			include get_template_directory() .  '/template-parts/news-slider.php';
		endif;
	endif;
?>
</div>
<?php get_footer(); ?>