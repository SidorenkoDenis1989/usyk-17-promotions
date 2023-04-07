<?php
add_action('wp_enqueue_scripts', 'alex_scripts');
function alex_scripts() {
    wp_enqueue_script('lazyload', get_theme_file_uri('/assets/js/lazyload.min.js'));
	wp_enqueue_script('basic', get_theme_file_uri('/assets/js/scripts-alex.js'),'','',true);
}
function change_excerpt( $more ) {
        
     return '';
}
add_filter('excerpt_more', 'change_excerpt');

add_action('init', 'register_news_post_type');
function register_news_post_type(){
	register_post_type('news', array(
		'labels'             => array(
			'name'               => esc_attr( pll__( 'Новини' ) ),
			'singular_name'      => esc_attr( pll__( 'Новина' ) ),
			'add_new'            => esc_attr( pll__( 'Додати новину' ) ),
			'add_new_item'       => esc_attr( pll__( 'Додати нову новину' ) ),
			'edit_item'          => esc_attr( pll__( 'Редагувати новину' ) ),
			'new_item'           => esc_attr( pll__( 'Нова новина' ) ),
			'view_item'          => esc_attr( pll__( 'Подивитися новину' ) ),
			'search_items'       => esc_attr( pll__( 'Знайти новину' ) ),
			'not_found'          => esc_attr( pll__( 'Нічого не знайдено' ) ),
			'not_found_in_trash' => esc_attr( pll__( 'Нічого не знайдено корзині' ) ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_attr( pll__( 'Новини' ) ),

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => 'news',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'thumbnail', 'date'),
		'menu_icon'          => 'dashicons-media-text',
		
	) );
}
function get_locale_languge_country($lang){
	$out = '';
	switch ($lang) {
	    case 'ru':
	        $out = "RU";
	        break;
	    case 'uk':
	        $out = "UA";
	        break;
	    case 'en':
	        $out = "EN";
	        break;
	}
	return $out;
}
/*add_action('after_setup_theme', 'true_load_theme_textdomain');
 
function true_load_theme_textdomain(){
	load_theme_textdomain( 'usyk17promotions', get_template_directory() . '/languages' );

}

add_filter( 'locale', 'true_localize_theme' );
 
function true_localize_theme( $locale ) {
	if ( isset( $_GET['lang'] ) ) {
		return esc_attr( $_GET['lang'] );
	}
	return $locale;
}*/

add_action('init', 'truemisha_polylang_strings' );
 
function truemisha_polylang_strings() {
 
	if( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	require_once( get_template_directory() . '/functions/functions-translates.php');
 
	
 
 
}

if( ! function_exists( 'pll__' ) ) {
	function pll__( $string ) {
		return $string;
	}
}
 
if( ! function_exists( 'pll_e' ) ) {
	function pll_e( $string ) {
		echo $string;
	}
}