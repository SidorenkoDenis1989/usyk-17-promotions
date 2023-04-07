<?php
    get_header();
?>
<svg id="archive-events-bg" width="1920" height="1432" viewBox="0 0 1920 1432" fill="none" xmlns="http://www.w3.org/2000/svg">
	<g opacity="0.06">
		<path d="M0 350.248L1295.59 738.432L1920 551.355V429.063L1811.89 447.078L0 0V350.248Z" fill="white"/>
		<path d="M1107.09 781.563L0 1027.88V736.526L198.376 721.283L0 622.895V480.163L1107.09 781.563Z" fill="white"/>
		<path d="M0 1432L1794.04 1134.06L1920 1180.66V673.648L0 1138.91V1432Z" fill="white"/>
	</g>
</svg>
<div class="container archive-header">
	<div class="row">
		<div class="col-12">
			<?php breadcrumbs(); ?>
		</div>
	</div>
	<form class="row" action="<?php echo get_post_type_archive_link('events'); ?>" method="GET">
		<div class="col-lg-4">
			<h1 class="block-title block-title-white"><?php post_type_archive_title( '', true ); ?></h1>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="search-input-wrapper">
				<?php
					if( isset($_GET['sn']) ) {
						$searched_name = $_GET['sn'];
					} else {
						$searched_name = '';
					}
			 	?>
			 	<?php $search_placeholder = esc_attr( pll__( 'Пошук заходів' )); ?>
				<input class="search-input uppercase" type="text" name="sn" placeholder="<?php echo $search_placeholder; ?>" value="<?php echo $searched_name; ?>" maxlength="170">
				<div class="search-icon uppercase">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.3955 12.3955C9.78864 15.0024 5.56204 15.0024 2.95516 12.3955C0.34828 9.78864 0.34828 5.56204 2.95516 2.95516C5.56204 0.34828 9.78864 0.34828 12.3955 2.95516C15.0024 5.56204 15.0024 9.78864 12.3955 12.3955ZM12.3955 12.3955L17 17" stroke="white" stroke-width="1.6"/>
					</svg>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<select class="order-select" name="order">
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'dateASC' ) { echo 'selected'; } ?> value="dateASC"><?php echo esc_attr( pll__( 'Від старих до нових' )); ?></option>
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'dateDESC' ) { echo 'selected'; } ?> value="dateDESC"><?php echo esc_attr( pll__( 'Від нових до старих' )); ?></option>
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'alphabetASC' ) { echo 'selected'; } ?> value="alphabetASC"><?php echo esc_attr( pll__( 'А-Я' )); ?></option>
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'alphabetDESC' ) { echo 'selected'; } ?> value="alphabetDESC"><?php echo esc_attr( pll__( 'Я-А' )); ?></option>
				<?php
				    $years_of_media_posts = get_option('years_of_events_posts');
				    if( is_array($years_of_media_posts) && count($years_of_media_posts) > 0 ):
				        foreach($years_of_media_posts as $year):
				            echo "<option ";
				            if( isset($_GET['order']) && $_GET['order'] == $year ) {
				                echo 'selected';
                            }
                            echo " value='" . $year . "'>" . $year . "</option>";
				        endforeach;
				    endif;
				?>
			</select>
		</div>
	</form>
</div>
<?php if ( have_posts() ) : ?>
<div class="archive-container archive-events">
	<div class="posts-list">
		<div class="container">
			<div class="row">
			<?php
                while ( have_posts() ) : the_post();
                    $post_id = get_the_ID();
                    include get_template_directory() .  '/template-parts/content/content-events.php';
                endwhile;
			?>
			</div>
		</div>
		<div class="container">
			<div class="row pagination-wrapper">
				<div class="col-12">
					<?php echo get_custom_pagination();	?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
    else:
        get_template_part( 'template-parts/content/content-none' );
    endif;
?>

<?php get_footer(); ?>