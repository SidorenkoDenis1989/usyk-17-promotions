<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<div class="news_back">
	<div class="container backcrumbs_wrapper" >
		<div class="row">
			<div class="col-12">
				<?php breadcrumbs(); ?>
			</div>
		</div>
	</div>
	<?php $banner_id = get_field('back_image_news'); ?>
	<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
	
	
</div>
<div class="articles_content_wrapper">
	<div class="container" >
		<div class="row justify-content-center">
			<div class="categories_wrapper col-xxl-8 col-xl-8 col-md-10 col-12">
				<?php
					$boxers = get_field('boxers');
					$separator = ' ';
					$output = '';
					if ( ! empty( $boxers ) ) {
					foreach( $boxers as $boxer ) {
					    $output .= '<a href="' . esc_url( get_post_permalink( $boxer ) ) . '" alt="' . esc_attr( sprintf( __( '%s', get_the_title($boxer) ), get_the_title($boxer) ) ) . '">' . esc_html( get_the_title($boxer) ) . '</a>' . $separator;
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
		$currect_post_id = array();
		$currect_post_id[] = get_the_ID(); 
		$related_tax = 'category';
		// получаем ID всех элементов (категорий, меток или таксономий), к которым принадлежит текущий пост
		$cats_tags_or_taxes = wp_get_object_terms( $post->ID, $related_tax, array( 'fields' => 'ids' ) );
		// массив параметров для WP_Query
		$args = array(
			'posts_per_page' => 10,
			'post__not_in' => $currect_post_id, // сколько похожих постов нужно вывести,
		    'post_type' => 'post',
		    'meta_query' => array(
		        array(
		            'key' => 'boxers',
		            'value' => $boxers,
		            'compare' => 'IN'
		        )
		    )
		);
		
		$related_news_query = new WP_Query( $args );
		// если посты, удовлетворяющие нашим условиям, найдены
		if( $related_news_query->have_posts() ) :
			// выводим заголовок блока похожих постов
			echo '<div class="related_news container">';
				echo '<div class="row">';
					echo '<h2 class="block-title">'.esc_attr( pll__( 'Схожі новини' )).'</h2>';
					// запускаем цикл
					while( $related_news_query->have_posts() ) : $related_news_query->the_post();
						// в данном случае посты выводятся просто в виде ссылок
						get_template_part( 'template-parts/content/content-news' ); 
						
					endwhile;
				echo '</div>';
			echo '</div>';
		endif;
		// не забудьте про эту функцию, её отсутствие может повлиять на другие циклы на странице
		wp_reset_postdata();
	?>	
</div>


