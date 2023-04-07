<?php
function add_themes_assets() {
	wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2', 'all' );
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/slick/slick.css', array(), '1.8.1', 'all' );
	wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), '1.8.1', 'all' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.1.0', 'all' );
	wp_enqueue_style( 'styles-denis', get_template_directory_uri() . '/assets/css/styles-denis.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'styles-alex', get_template_directory_uri() . '/assets/css/styles-alex.css', array(), '1.0', 'all' );

	wp_enqueue_script('slick-js', 
		get_template_directory_uri() . '/assets/slick/slick.min.js',
		array( 'jquery' ),
		'1.8.1',
		true
	);

	wp_enqueue_script('jquery.magnific-popup', 
		get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js',
		array( 'jquery' ),
		'1.1.0',
		true
	);

	wp_enqueue_script('scripts-denis', 
		get_template_directory_uri() . '/assets/js/scripts-denis.js',
		array( 'jquery', 'slick-js', 'jquery.magnific-popup' ),
		'1.0',
		true
	); 	
}
add_action( 'wp_enqueue_scripts', 'add_themes_assets' );

add_action('customize_register', 'add_black_logo_to_customizers');
function add_black_logo_to_customizers($wp_customize){
	$wp_customize->add_setting('black_logo');
	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'black_logo', array(
	    'label'    => esc_attr( pll__( 'Чорне лого' )),
	    'section'  => 'title_tagline',
	    'settings' => 'black_logo',
	    'priority' => 5,
	)));
}

add_action( 'admin_menu', 'remove_default_post_type' );
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}

add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}

add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );
function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> esc_attr( pll__( 'Налаштування теми' )),
		'menu_title'	=> esc_attr( pll__( 'Налаштування теми' )),
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

function get_image_html_code_by_id($image_id, $classes = array() ) {
	$img_url 		= wp_get_attachment_url($image_id);
	$img_parts 		= pathinfo($img_url);
	$img_extention	= $img_parts['extension'];

	if($img_extention == 'svg'):
		return file_get_contents($img_url);
	else:
		return get_img_html_code($image_id, 'full', $classes);
	endif; 
}

function get_phone_as_mailto_link($phone){
	$phone = get_field("phone_header", 'option');
	$phone_link = str_replace(' ', '', $phone);
	$phone_link = str_replace('-', '', $phone_link);
	$phone_link = str_replace('(', '', $phone_link);
	$phone_link = str_replace(')', '', $phone_link);
	return $phone_link; 
}

add_action('init', 'register_boxers_post_type');
function register_boxers_post_type(){
	register_post_type('boxers', array(
		'labels'             => array(
			'name'               => esc_attr( pll__( 'Боксери' )),
			'singular_name'      => esc_attr( pll__( 'Боксер' )),
			'add_new'            => esc_attr( pll__( 'Додати боксера' )),
			'add_new_item'       => esc_attr( pll__( 'Додати нового боксера' )),
			'edit_item'          => esc_attr( pll__( 'Редагувати боксера' )),
			'new_item'           => esc_attr( pll__( 'Новий боксер' )),
			'view_item'          => esc_attr( pll__( 'Подивитися боксера' )),
			'search_items'       => esc_attr( pll__( 'Знайти боксера' )),
			'not_found'          => esc_attr( pll__( 'Нічого не знайдено' )),
			'not_found_in_trash' => esc_attr( pll__( 'Нічого не знайдено корзині' )),
			'parent_item_colon'  => '',
			'menu_name'          => esc_attr( pll__( 'Боксери' )),

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => 'boxers',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor'),
		'menu_icon'          => 'dashicons-id-alt',
		'taxonomies'          => array('weight_cat'),
	) );
}

function add_weight_cat_taxonomy() { 
    register_taxonomy('weight_cat', 'boxers', array(
        'hierarchical' => true,
        'labels' => array(
          'name' 				=> esc_attr( pll__( 'Вагові категорії' )),
          'singular_name' 		=> esc_attr( pll__( 'Вагова категорія' )),
          'search_items' 		=> esc_attr( pll__( 'Знайти вагову категорію' )),
          'all_items' 			=> esc_attr( pll__( 'Всі вагові категорії' )),
          'parent_item' 		=> esc_attr( pll__( 'Батьківська вагова категорія' )),
          'parent_item_colon'	=> esc_attr( pll__( 'Батьківська вагова категорія' )),
          'edit_item' 			=> esc_attr( pll__( 'Редагувати вагову категорію' )),
          'update_item' 		=> esc_attr( pll__( 'Оновити вагову категорію' )),
          'add_new_item' 		=> esc_attr( pll__( 'Додати вагову категорію' )),
          'new_item_name' 		=> esc_attr( pll__( 'Нова вагова категорія' )),
          'menu_name' 			=> esc_attr( pll__( 'Вагові категорії' )),
        ),
        'rewrite' => array(
          'slug' => 'weight-category',
          'with_front' => false,
          'hierarchical' => false
        ),
    ));
}
add_action( 'init', 'add_weight_cat_taxonomy', 0 );

function get_img_html_code($image_id, $thumbnail_slug = 'full', $classes = array() ) {
	if(!$image_id){
		return null;
	}
	$img_url 		= wp_get_attachment_image_src($image_id,  $thumbnail_slug, true)[0];
	$img_parts 		= pathinfo($img_url);
	$img_sizes 		= getimagesize($img_url);
	$img_width 		= $img_sizes[0];
	$img_height 	= $img_sizes[1];
	$img_alt 		= get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
	if(!$img_alt){
		$img_alt 	= 'image';
	}
	return '<img class="' . implode(' ', $classes) . '" src="' . $img_url . '" alt="' . $img_alt . '" width="' . $img_width . '" height="' . $img_height . '">';
}

add_action('save_post', 'create_fake_title_for_boxer_for_search');

function create_fake_title_for_boxer_for_search($post_id)
{
	if(	get_post_type($post_id) == 'boxers' || 
		get_post_type($post_id) == 'news' 	||
		get_post_type($post_id) == 'media' 	|| 
		get_post_type($post_id) == 'events'  ) {

		update_post_meta($post_id, 'fake_title', get_the_title($post_id)); 
	
	}

	if( get_post_type($post_id) == 'media' ) {
	    $years_of_media_posts = get_option('years_of_media_posts');
	    $post_year = get_the_date('Y', $post_id);

	    if( !is_array( $years_of_media_posts ) ) {
            $years_of_media_posts = [];
	    }

	    array_push($years_of_media_posts, $post_year);
	    $years_of_media_posts = array_unique($years_of_media_posts);
	    rsort($years_of_media_posts);
	    update_option('years_of_media_posts', $years_of_media_posts);
	}

	if( get_post_type($post_id) == 'events' ) {
	    $years_of_events_posts = get_option('years_of_events_posts');
	    $post_year = get_the_date('Y', $post_id);

	    if( !is_array( $years_of_events_posts ) ) {
            $years_of_events_posts = [];
	    }

	    array_push($years_of_events_posts, $post_year);
	    $years_of_events_posts = array_unique($years_of_events_posts);
	    rsort($years_of_events_posts);
	    update_option('years_of_events_posts', $years_of_events_posts);
	}
}

add_action( 'pre_get_posts', 'change_main_post_query' );
function change_main_post_query( $query ){

	if (!is_admin() && $query->is_main_query() && is_post_type_archive('boxers')) {
		
		$query->set('order', 'ASC');
		$query->set('meta_key', 'lastname');
		$query->set('orderby', 'meta_value');
		
		
		if(isset($_GET['sn'])){
		   	$meta_query = [
                'relation' => 'OR',
                [
                    'key' 		=> 'fake_title',
                    'value' 	=> $_GET['sn'],
                    'compare' 	=> 'LIKE',
                ],
                [
                    'key' 		=> 'name',
                    'value' 	=> $_GET['sn'],
                    'compare' 	=> 'LIKE',
                ],
                [
                    'key' 		=> 'lastname',
                    'value' 	=> $_GET['sn'],
                    'compare' 	=> 'LIKE',
                ]

            ];
            $query->set('meta_query', $meta_query);
		}

        if( isset($_GET['order']) ){
            $query->set('order', $_GET['order']);
        }
	}

	if(!is_admin() && $query->is_main_query() && (is_post_type_archive('news') || is_tax('media_cat') || is_post_type_archive('events') )) {

		$query->set('order', 'DESC');
		$query->set('orderby', 'publish_date');
		$meta_query = ['relation' => 'AND'];

		if( isset($_GET['order']) ){

			switch ( $_GET['order'] ) {
			    
			    case 'alphabetASC':
			    	$query->set('order', 'ASC');
			       	$query->set('meta_key', 'fake_title');
					$query->set('orderby', 'meta_value');
			        break;
			    
			    case 'alphabetDESC':
			    	$query->set('order', 'DESC');
			       	$query->set('meta_key', 'fake_title');
					$query->set('orderby', 'meta_value');
			        break;
			    
			    case 'dateASC':
			    	$query->set('order', 'ASC');
					$query->set('orderby', 'publish_date');
			        break;
			    
			    case 'dateDESC':
			    	$query->set('order', 'DESC');
					$query->set('orderby', 'publish_date');
			        break;
		        default:
		        	$date_query = array(
		        		'relation' => 'AND',
		        		array(
		        			'year' => $_GET['order']
		        		)
		        	);
		        	$query->set('date_query', $date_query);
		        	break;
			}
		}

		if( isset($_GET['boxer']) ){
			
			$meta_query[] = [
				'key'     => 'boxers_$_boxer',
				'value'   => intval($_GET['boxer']),
				'compare' => '=',
            ];
            add_filter( 'posts_request', 'change_sql_request_for_searching_post_by_boxer_id' );
		}

		if( isset($_GET['sn']) && $_GET['sn'] != '' ){

			$boxers_args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> 'boxers',
				'posts_per_page' 	=> -1,
				'fields'			=> 'ids',
				'meta_query' 		=> array(
					'relation' => 'AND',
					[
		                'relation' => 'OR',
		                [
		                    'key' 		=> 'fake_title',
		                    'value' 	=> $_GET['sn'],
		                    'compare' 	=> 'LIKE',
		                ],
		                [
		                    'key' 		=> 'name',
		                    'value' 	=> $_GET['sn'],
		                    'compare' 	=> 'LIKE',
		                ],
		                [
		                    'key' 		=> 'lastname',
		                    'value' 	=> $_GET['sn'],
		                    'compare' 	=> 'LIKE',
		                ]

		            ],
				),
			);
			$found_boxers = new WP_Query($boxers_args);
			$found_boxers_ids = $found_boxers->posts;

			if( count($found_boxers_ids) ){
				
				$meta_query = ['relation' => 'OR'];
				$meta_query[] = array(	
					'key'     => 'boxers_$_boxer',
					'value'   => $found_boxers_ids,
					'compare' => 'IN',
				);
				add_filter( 'posts_request', 'change_sql_request_for_searching_post_by_boxer_id' );
			}

		   	$meta_query[] = [
                'key' 		=> 'fake_title',
                'value' 	=> $_GET['sn'],
                'compare' 	=> 'LIKE',
            ];
		}
		$query->set('meta_query', $meta_query);
		
	}

	if(!is_admin() && $query->is_main_query() && (is_post_type_archive('news') || is_post_type_archive('boxers') ) ){
		$query->set('posts_per_page', 15);
	}

	if(!is_admin() && $query->is_main_query() && is_post_type_archive('events')){
		$query->set('posts_per_page', 12);
	}
}

function get_custom_pagination() {
	$prev_arrow = '<svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M12 21L2 11L12 1" stroke="black" stroke-width="2"/>
	</svg>';
	$next_arrow = '<svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M1 21L11 11L0.999999 1" stroke="black" stroke-width="2"/>
	</svg>';
	$nav = get_the_posts_pagination( 
		array(
			'show_all'     => false,
			'end_size'     => 1,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => $prev_arrow,
			'next_text'    => $next_arrow	,
			'add_args'     => false,
			'add_fragment' => '',
			'screen_reader_text' =>	'Posts navigation',
		) );
	return str_replace('<h2 class="screen-reader-text">Posts navigation</h2>', '', $nav);
}

function add_fixes_for_filtering_posts_by_boxers( $where, $query ) {
	
	$label = $query->query['filter_by_repeater'] ?? '';
	if($label === 'yes') {
		$where = str_replace("meta_key = 'boxers_$", "meta_key LIKE 'boxers_%", $where);
	}
	return $where;
}
add_filter('posts_where', 'add_fixes_for_filtering_posts_by_boxers', 10, 2);


function change_sql_request_for_searching_post_by_boxer_id( $input ) {
	$input = str_replace("meta_key = 'boxers_$", "meta_key LIKE 'boxers_%", $input);
	return $input;
}

add_action('init', 'register_media_post_type');
function register_media_post_type(){
	register_post_type('media', array(
		'labels'             => array(
			'name'               => esc_attr( pll__( 'Медіа' )),
			'singular_name'      => esc_attr( pll__( 'Медіа' )),
			'add_new'            => esc_attr( pll__( 'Додати медіа' )),
			'add_new_item'       => esc_attr( pll__( 'Додати нове медіа' )),
			'edit_item'          => esc_attr( pll__( 'Редагувати медіа' )),
			'new_item'           => esc_attr( pll__( 'Нове медіа' )),
			'view_item'          => esc_attr( pll__( 'Подивитися медіа' )),
			'search_items'       => esc_attr( pll__( 'Знайти медіа' )),
			'not_found'          => esc_attr( pll__( 'Нічого не знайдено' )),
			'not_found_in_trash' => esc_attr( pll__( 'Нічого не знайдено корзині' )),
			'parent_item_colon'  => '',
			'menu_name'          => esc_attr( pll__( 'Медіа' )),

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor'),
		'menu_icon'          => 'dashicons-camera',
		'taxonomies'          => array('media_cat'),
	) );
}

function add_media_cat_taxonomy() {
    register_taxonomy('media_cat', 'media', array(
        'hierarchical' => true,
        'labels' => array(
          'name' 				=> esc_attr( pll__( 'Категорії медіа' )),
          'singular_name' 		=> esc_attr( pll__( 'Категорія медіа' )),
          'search_items' 		=> esc_attr( pll__( 'Знайти категорію' )),
          'all_items' 			=> esc_attr( pll__( 'Всі категорії' )),
          'parent_item' 		=> esc_attr( pll__( 'Батьківська категорія' )),
          'parent_item_colon'	=> esc_attr( pll__( 'Батьківська категорія' )),
          'edit_item' 			=> esc_attr( pll__( 'Редагувати категорію' )),
          'update_item' 		=> esc_attr( pll__( 'Оновити категорію' )),
          'add_new_item' 		=> esc_attr( pll__( 'Додати категорію' )),
          'new_item_name' 		=> esc_attr( pll__( 'Додати категорію' )),
          'menu_name' 			=> esc_attr( pll__( 'Категорії медіа' )),
        ),
        'rewrite' => array(
          'slug' => 'media-category',
          'with_front' => false,
          'hierarchical' => false
        ),
    ));
}
add_action( 'init', 'add_media_cat_taxonomy', 0 );

function get_media_icon_html($category){
    if(!$category || ($category != 'photo' && $category != 'video')){
        return null;
    }
    $media_icon = '<div class="media-icon media-icon-' . $category .'">';
    $media_icon .= ($category == 'photo') ?
        '<svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.8417 10.475C17.1305 11.7779 17.1305 13.8903 15.8417 15.1932C14.553 16.4961 12.4635 16.4961 11.1747 15.1932C9.88593 13.8903 9.88593 11.7779 11.1747 10.475C12.4635 9.17209 14.553 9.17209 15.8417 10.475Z" fill="#D61D1D"/>
            <path d="M23.4085 3.65939H22.3702C21.6096 3.65939 20.9149 3.22803 20.5776 2.54638L20.0283 1.43614C19.691 0.754482 18.9963 0.32312 18.2357 0.32312H8.78065C8.0197 0.32312 7.32467 0.754944 6.98758 1.43716L6.43811 2.54922C6.1016 3.23028 5.4083 3.6619 4.64865 3.66326L3.61189 3.66513C1.79669 3.66841 0.319025 5.16385 0.317458 6.99976L0.308594 20.3399C0.308594 22.1799 1.78864 23.677 3.6087 23.677H23.4085C25.2285 23.677 26.7086 22.1807 26.7086 20.3407V6.99561C26.7085 5.15566 25.2285 3.65939 23.4085 3.65939ZM13.5082 19.5066C9.86885 19.5066 6.90795 16.5133 6.90795 12.8341C6.90795 9.15488 9.86885 6.16153 13.5082 6.16153C17.1475 6.16153 20.1084 9.15488 20.1084 12.8341C20.1084 16.5133 17.1475 19.5066 13.5082 19.5066Z" fill="#D61D1D"/>
        </svg>' :
        '<svg width="21" height="23" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.0952 11.5077L0.384766 22.677L0.384767 0.338501L20.0952 11.5077Z" fill="#D61D1D"/>
        </svg>';
    $media_icon .= '</div>';
    return $media_icon;
}

add_action('init', 'register_events_post_type');
function register_events_post_type(){
	register_post_type('events', array(
		'labels'             => array(
			'name'               => esc_attr( pll__( 'Заходи' )),
			'singular_name'      => esc_attr( pll__( 'Захід' )),
			'add_new'            => esc_attr( pll__( 'Додати захід' )),
			'add_new_item'       => esc_attr( pll__( 'Додати новий захід' )),
			'edit_item'          => esc_attr( pll__( 'Редагувати захід' )),
			'new_item'           => esc_attr( pll__( 'Новий захід' )),
			'view_item'          => esc_attr( pll__( 'Подивитися захід' )),
			'search_items'       => esc_attr( pll__( 'Знайти захід' )),
			'not_found'          => esc_attr( pll__( 'Нічого не знайдено' )),
			'not_found_in_trash' => esc_attr( pll__( 'Нічого не знайдено корзині' )),
			'parent_item_colon'  => '',
			'menu_name'          => esc_attr( pll__( 'Заходи' )),

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor'),
		'menu_icon'          => 'dashicons-tickets-alt',
		'taxonomies'         => null,
	) );
}

function localize_date_F_d_Y( $date_string ) {
	if(pll_current_language() == 'ru'){
		$date_string = str_replace('January', 'Январь', $date_string);
		$date_string = str_replace('February', 'Февраль', $date_string);
		$date_string = str_replace('March', 'Март', $date_string);
		$date_string = str_replace('April', 'Апрель', $date_string);
		$date_string = str_replace('May', 'Май', $date_string);
		$date_string = str_replace('June', 'Июнь', $date_string);
		$date_string = str_replace('July', 'Июль', $date_string);
		$date_string = str_replace('August', 'Август', $date_string);
		$date_string = str_replace('September', 'Сентябрь', $date_string);
		$date_string = str_replace('October', 'Октябрь', $date_string);
		$date_string = str_replace('November', 'Ноябрь', $date_string);
		$date_string = str_replace('December', 'Декабрь', $date_string);
	}
	if(pll_current_language() == 'ua'){
		$date_string = str_replace('January', 'Січень', $date_string);
		$date_string = str_replace('February', 'Лютий', $date_string);
		$date_string = str_replace('March', 'Березень', $date_string);
		$date_string = str_replace('April', 'Квітень', $date_string);
		$date_string = str_replace('May', 'Травень', $date_string);
		$date_string = str_replace('June', 'Червень', $date_string);
		$date_string = str_replace('July', 'Липень', $date_string);
		$date_string = str_replace('August', 'Серпень', $date_string);
		$date_string = str_replace('September', 'Вересень', $date_string);
		$date_string = str_replace('October', 'Жовтень', $date_string);
		$date_string = str_replace('November', 'Листопад', $date_string);
		$date_string = str_replace('December', 'Грудень', $date_string);
	}
	return $date_string;
}

function localize_date_d_F_Y( $date_string ) {
	if(pll_current_language() == 'ru'){
		$date_string = str_replace('January', 'Января', $date_string);
		$date_string = str_replace('February', 'Февраля', $date_string);
		$date_string = str_replace('March', 'Марта', $date_string);
		$date_string = str_replace('April', 'Апреля', $date_string);
		$date_string = str_replace('May', 'Мая', $date_string);
		$date_string = str_replace('June', 'Июня', $date_string);
		$date_string = str_replace('July', 'Июля', $date_string);
		$date_string = str_replace('August', 'Августа', $date_string);
		$date_string = str_replace('September', 'Сентября', $date_string);
		$date_string = str_replace('October', 'Октября', $date_string);
		$date_string = str_replace('November', 'Ноября', $date_string);
		$date_string = str_replace('December', 'Декабря', $date_string);
	}
	if(pll_current_language() == 'ua'){
		$date_string = str_replace('January', 'Січня', $date_string);
		$date_string = str_replace('February', 'Лютого', $date_string);
		$date_string = str_replace('March', 'Березеня', $date_string);
		$date_string = str_replace('April', 'Квітня', $date_string);
		$date_string = str_replace('May', 'Травня', $date_string);
		$date_string = str_replace('June', 'Червня', $date_string);
		$date_string = str_replace('July', 'Липня', $date_string);
		$date_string = str_replace('August', 'Серпня', $date_string);
		$date_string = str_replace('September', 'Вересня', $date_string);
		$date_string = str_replace('October', 'Жовтня', $date_string);
		$date_string = str_replace('November', 'Листопаду', $date_string);
		$date_string = str_replace('December', 'Груденя', $date_string);
	}
	return $date_string;
}