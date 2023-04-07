<?php 
	get_header();
	$media_cat = get_the_terms(get_the_ID(), 'media_cat')[0]->slug;
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
		/*if( $media_cat === 'video' ){
			echo get_media_icon_html($media_cat);	
		}*/ 
	?>
	<div class="first-screen-boxer-shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php breadcrumbs(); ?>
			</div>
		</div>
		<div class="row media-title-wrap">
			<div class="col-lg-7 col-12 media-title">
				<span><?php echo localize_date_d_F_Y(get_the_date('j F, Y')); ?></span>
				<h1 class="uppercase"><?php echo get_the_title($post_id); ?></h1>
			</div>
		</div>
	</div>
</div>
<?php 
	$phrase = get_field('phrase'. $post_id);
	$media_description = get_the_content($post_id);
	if($phrase || $media_description):
?>
	<div class="media-about">
		<div class="container">
			<div class="row align-content-center">
				<div class="col-xl-6 media-phrase uppercase">
					<?php echo $phrase; ?>
				</div>
				<div class="col-xl-6 media-about-content">
					<?php echo $media_description; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;
	if($media_cat == 'video'){
		$media_gallery = get_field('youtube_video_list', $post_id);
	}
	if($media_cat == 'photo'){
		$gallery_wrapper_classes = 'zoom-gallery';
		$media_gallery = get_field('photos', $post_id);
	}
	if( count($media_gallery) > 0 ): 
?>
	<div class="media-gallery">
		<div class="container">
			<div class="row <?php echo $gallery_wrapper_classes; ?>">
				<?php 
					if($media_cat == 'photo'):
						foreach($media_gallery as $photo_id):
							$photo_url_full = wp_get_attachment_image_src($photo_id,  'full', true)[0];
				?>
						<a class="media-gallery-item media-gallery-photo col-lg-4 col-6" href="<?php echo $photo_url_full; ?>">
							<div>
								<?php echo get_img_html_code($photo_id, 'img_410_280' ); ?>
							</div>	
						</a>
				<?php endforeach;
					elseif($media_cat == 'video'): 
						while( have_rows('youtube_video_list', $post_id) ): the_row();
							$video_preview_id = get_sub_field('preview', $post_id);
							$youtube_video_id = get_sub_field('youtube_video_id', $post_id);
							$preview_url_full = wp_get_attachment_image_src($video_preview_id,  'full', true)[0];
							if($youtube_video_id):
				?>
								<a href="#" class="media-gallery-item media-gallery-video col-lg-4 col-6" dara-full_preview="<?php echo $preview_url_full; ?>" data-youtube_id="<?php echo $youtube_video_id; ?>">
									<div>
										<?php echo get_media_icon_html($media_cat); ?>
										<?php echo get_img_html_code($video_preview_id, 'img_410_280' ); ?>
									</div>	
								</a>
				<?php
							endif;
						endwhile; ?>
						<div class="watch-video__overlay">
							<a href="#" class="watch-video__close">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2 2L22 22M22 2L2 22" stroke="white" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
						<div class="watch-video__wrapper"></div>
				<?php
					endif;
				?>
			</div>
		</div>	
	</div>
	<?php endif; ?>
<?php get_footer(); ?>