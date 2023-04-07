<?php /* Template Name: Текстова сторінка */ ?>

<?php get_header(); ?>
<div class="text-page__first-screen">
	<div class="container">
		<div class="row">
			<!--<div class="col-12"><?php /*breadcrumbs();*/ ?></div>-->
			<div class="col-12 text-page__title"><h1><?php echo get_the_title(); ?></h1></div>
		</div>
	</div>
</div>
<?php 
	$content = get_field('content');
	if(is_array($content) && count($content) > 0 ):
?>
<div class="container text-page__block-wrapper">
	<div class="row justify-content-center">
		<?php while(have_rows('content')): the_row(); ?>
		<div class="col-lg-8 col-md-10 col-12">
			<h3 class="text-page__block-title"><?php echo get_sub_field('title'); ?></h3>
			<div class="text-page__block-text"><?php echo get_sub_field('text'); ?></div>	
		</div>
		<?php endwhile; ?>
	</div>
</div>
<?php
	endif; 
	get_footer(); 
?>