<div class="row archive-media-row">
    <?php
        $term_obj = get_term_by('slug', $term, 'media_cat');
    ?>
    <div class="col-6"><h3 class="block-title"><?php echo $term_obj->name; ?></h3></div>
    <div class="col-6 slider__show-all-posts">
        <a class="uppercase" href="<?php echo get_term_link($term_obj->term_id); ?>">
            <?php echo esc_attr( pll__('До всіх')); ?> <?php echo strtolower($term_obj->name); ?>
            <svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 3H14V5H0V3Z" fill="black"></path>
                <path d="M19 4L14 8V0L19 4Z" fill="black"></path>
            </svg>
        </a>
    </div>
</div>
<div class="row archive-media-row archive-media-row-<?php echo $term; ?> archive-media-slider">
    <?php
        $post_counter = 0;
        while($posts->have_posts()): $posts->the_post();
            $post_id        = get_the_ID();
            $first_post     = $post_counter ? false : true;
            $post_img_id    = get_field('main_img', $post_id);
    ?>
        <div class="archive-media-item <?php if($first_post){ echo 'col-lg-12 archive-media-item-first'; } else { echo 'col-lg-4'; } ?>">
            <a href="<?php echo get_the_permalink($post_id); ?>">
                <?php
                    if($first_post){
                        echo get_img_html_code($post_img_id);
                    } else {
                        echo get_img_html_code($post_img_id, 'img_410_280');
                    }
                ?>
                <?php echo get_media_icon_html($term); ?>
                <div class="archive-media-item-title-wrap">
                    <span><?php echo localize_date_d_F_Y(get_the_date('j F, Y')); ?></span>
                    <h4 class="uppercase"><?php echo get_the_title($post_id); ?></h4>
                </div>
            </a>
        </div>
    <?php
        $post_counter++;
        endwhile;
        wp_reset_postdata();
    ?>
</div>
