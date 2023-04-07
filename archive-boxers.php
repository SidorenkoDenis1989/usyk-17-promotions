<?php get_header(); ?>
<div class="container archive-header">
	<div class="row">
		<div class="col-12">
			<?php breadcrumbs(); ?>
		</div>
	</div>
	<form class="row" action="<?php echo get_post_type_archive_link('boxers'); ?>" method="GET">
		<div class="col-lg-4">
			<h1 class="block-title"><?php post_type_archive_title( '', true ); ?></h1>
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
				<input class="search-input uppercase" type="text" name="sn" placeholder="<?php echo esc_attr( pll__( 'Пошук боксерів' )); ?>" value="<?php echo $searched_name; ?>" maxlength="170">
				<div class="search-icon uppercase">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.3955 12.3955C9.78864 15.0024 5.56204 15.0024 2.95516 12.3955C0.34828 9.78864 0.34828 5.56204 2.95516 2.95516C5.56204 0.34828 9.78864 0.34828 12.3955 2.95516C15.0024 5.56204 15.0024 9.78864 12.3955 12.3955ZM12.3955 12.3955L17 17" stroke="white" stroke-width="1.6"/>
					</svg>
				</div>
			</div>
		</div>	
		<div class="col-lg-4 col-md-6">
			<select class="order-select" name="order">
				<option <?php if(isset($_GET['order']) && $_GET['order'] == 'ASC' ) { echo 'selected'; } ?> value="ASC"><?php echo esc_attr( pll__( 'А-Я' )); ?></option>
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'DESC' ) { echo 'selected'; } ?> value="DESC"><?php echo  esc_attr( pll__( 'Я-А' )); ?></option>
			</select>
		</div>	
	</form>
</div>
<?php if ( have_posts() ) : ?>
<div class="archive-container archive-boxers">
	<div class="posts-list grey-bg">
		<svg width="1920" height="761" viewBox="0 0 1920 761" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 761L262.307 517.265L1180.9 186.222L1920 473.611V374.697L1352.07 120.222L1679 1H1155.5L674.824 184.663L884.5 1H452.5L0 0V150.883L253.297 181.545L0 397.736V761Z" fill="white"/>
		</svg>
		<div class="container">
			<div class="row">
			<?php
                while ( have_posts() ) : the_post();
                    $boxer_id = get_the_ID();
                    include get_template_directory() .  '/template-parts/content/content-boxer.php';
                endwhile;
			?>
			</div>
		</div>
		<?php if($wp_query->max_num_pages > 1): ?>
            <div class="container">
                <div class="row pagination-wrapper">
                    <div class="col-12">
                        <?php echo get_custom_pagination();	?>
                    </div>
                </div>
            </div>
		<?php endif; ?>
	</div>
</div>
<?php
    else:
        get_template_part( 'template-parts/content/content-none' );
    endif;
?>

<?php get_footer(); ?>