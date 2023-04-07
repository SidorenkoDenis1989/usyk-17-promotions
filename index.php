<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<?php breadcrumbs(); ?>
		</div>
	</div>
	<form class="row" action="<?php echo get_post_type_archive_link('post'); ?>" method="GET">
		<div class="col-lg-4">
			<h1 class="block-title"><?php echo single_post_title(); ?></h1>
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
				<input class="search-input uppercase" type="text" name="sn" placeholder="<?php echo esc_attr( pll__( 'Пошук боксерів' )); ?>" value="<?php echo $searched_name; ?>">
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
				<option <?php if( isset($_GET['order']) && $_GET['order'] == 'DESC' ) { echo 'selected'; } ?> value="DESC"><?php echo esc_attr( pll__( 'Я-А' )); ?></option>
			</select>
		</div>	
	</form>
</div>
<div class="container news-archive">
	<div class="row">
		<?php if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/content/content-news');
			}

			// Previous/next page navigation.
			echo get_custom_pagination();

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content-none' );

		}
		?>
	</div>
</div>
<?php
get_footer();
