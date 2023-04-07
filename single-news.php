<?php get_header(); ?>
<div class="news_back">
	<div class="first-screen-boxer-shadow"></div>
	<div class="container backcrumbs_wrapper" >
		<div class="row">
			<div class="col-12">
				<?php breadcrumbs(); ?>
			</div>
		</div>
	</div>
	<?php $banner_id = get_field('back_image_news'); ?>
	<div class="news-banner-wrapper">
		<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>	
	</div>
	<?php $banner_id = get_field('back_image_new_mobile'); ?>
	<div class="news-banner-wrapper-mobile">
		<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
		<div class="categories_wrapper col-xxl-8 col-xl-8 col-md-10 col-12">
			<?php
				$boxers_moblie =  array();
				$output = '';
				if( have_rows('boxers') ):
				    while( have_rows('boxers') ) : the_row();
				        $boxers_moblie[] = get_sub_field('boxer');
				    endwhile;
			    endif;
				if ( ! empty( $boxers_moblie ) ) {
				foreach( $boxers_moblie as $boxer ) {
					if($boxer){
				    	$output .= '<a href="' . esc_url( get_post_permalink( $boxer ) ) . '" alt="' . esc_attr( sprintf( __( '%s', get_the_title($boxer) ), get_the_title($boxer) ) ) . '">' . esc_html( get_the_title($boxer) ) . '</a>' . $separator;
					}
				}
				echo trim( $output, $separator );
				}
			?>
		</div>	
	</div>
</div>
<div class="articles_content_wrapper">
	<div class="container" >
		<div class="row justify-content-center">
			<div class="categories_wrapper col-xxl-8 col-xl-8 col-md-10 col-12">
				<?php
					$boxers =  array();
					$output = '';
					if( have_rows('boxers') ):
					    while( have_rows('boxers') ) : the_row();
					        $boxers[] = get_sub_field('boxer');
					    endwhile;
				    endif;
				    
					if ( ! empty( $boxers ) ) {
					foreach( $boxers as $boxer ) {
						if($boxer){
					    	$output .= '<a href="' . esc_url( get_post_permalink( $boxer ) ) . '" alt="' . esc_attr( sprintf( __( '%s', get_the_title($boxer) ), get_the_title($boxer) ) ) . '">' . esc_html( get_the_title($boxer) ) . '</a>' . $separator;
					    }
					}
					echo trim( $output, $separator );
					}
				?>
			</div>
		</div>
	</div>
	<div class="container article_wrapper" >
		<div class="row justify-content-center">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('col-xxl-8 col-xl-8 col-md-10 col-12'); ?>>
				<header class="entry-header alignwide">
					<p class="date"><?php echo localize_date_d_F_Y(get_the_date('j F, Y')); ?></p>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
					the_content();
					?>
				</div><!-- .entry-content -->
				
					
					
				
				<!--
				<?php if ( ! is_singular( 'attachment' ) ) : ?>
					<?php get_template_part( 'template-parts/post/author-bio' ); ?>
				<?php endif; ?>
				-->
			</article><!-- #post-<?php the_ID(); ?> -->
		</div>
	</div>
	<?php
		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'news',
			'posts_per_page' 	=> -1,
			'orderby' 			=> 'publish_date',
			'order'				=> 'DESC',
			'post__not_in'		=> array(get_the_ID()),
			'filter_by_repeater'=> 'yes',
			'meta_query' 		=> array(
			)
		);

		$meta_query = array('relation' => 'AND');

		if (count($boxers)) {
			$meta_query[] = array(	
				'key'     => 'boxers_$_boxer',
				'value'   => $boxers,
				'compare' => 'IN',
			);
		}

		$news = new WP_Query($args);
		
		if ( $news->have_posts() ):
			include get_template_directory() .  '/template-parts/news-slider.php';
		endif;
	?>	
</div>
<?php get_footer(); ?>