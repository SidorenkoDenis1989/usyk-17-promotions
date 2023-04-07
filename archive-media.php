<?php get_header(); ?>
    <?php
        $mobile_id = get_field('media_mobile', 'option');
        $add_class = '';
        if (!empty($mobile_id)){
            $add_class .= ' mobile_banner';
        } 
    ?>
    <div class="archive-media first-screen <?php echo $add_class;?>">
        <?php
            $first_screen_id = get_field('media_bg', 'option');

            echo get_image_html_code_by_id($first_screen_id, array('full'));
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
            <div class="row archive-media-title-wrap">
                <div class="col-12">
                    <h1 class="page-title page-title-white"><?php post_type_archive_title( '', true ); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <?php
        $args_photo = array(
            'post_status'		=> 'publish',
            'post_type' 		=> 'media',
            'posts_per_page' 	=> 4,
            'orderby' 			=> 'publish_date',
            'order'				=> 'DESC',
            'tax_query' 		=> array(
                'relation'      => 'AND',
                array(
                    'taxonomy'  => 'media_cat',
                    'field'     => 'slug',
                    'terms'     => 'photo',
                )
            )
        );

        $photos = new WP_Query($args_photo);

        $args_video = array(
            'post_status'		=> 'publish',
            'post_type' 		=> 'media',
            'posts_per_page' 	=> 4,
            'orderby' 			=> 'publish_date',
            'order'				=> 'DESC',
            'tax_query' 		=> array(
                'relation'      => 'AND',
                array(
                    'taxonomy'  => 'media_cat',
                    'field'     => 'slug',
                    'terms'     => 'video',
                )
            )
        );

        $videos = new WP_Query($args_video);
    ?>
    <?php if( $photos->found_posts || $videos->found_posts ): ?>
    <div class="archive-media-content">
        <div class="container">
            <?php
                if($photos->found_posts) {
                    $posts = $photos;
                    $term = 'photo';
                    include get_template_directory() .  '/template-parts/archive-media-category-part.php';
                }
            ?>
            <?php
                if($videos->found_posts) {
                    $posts = $videos;
                    $term = 'video';
                    include get_template_directory() .  '/template-parts/archive-media-category-part.php';
                }
            ?>
        </div>
    </div>
    <?php
        else:
            get_template_part( 'template-parts/content/content-none' );
        endif;
    ?>
<?php get_footer(); ?>