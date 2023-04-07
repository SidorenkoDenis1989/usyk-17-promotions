<?php

    $first_post     = $post_counter ? false : true;
    $post_img_id    = get_field('main_img', $post_id);
?>
<div class="archive-media-item-about archive-media-item <?php 
    if( $first_post && !$single_boxer_media_slider ){ 
        echo 'col-lg-12'; 
    } else { 
        echo ($single_boxer_media_slider && $media_term == 'video') ? 'col-lg-6' : 'col-lg-3'; 
    } ?>">
    <a href="<?php echo get_the_permalink($post_id); ?>">
        <?php
            echo get_img_html_code($post_img_id);
            /*if($first_post){
                echo get_img_html_code($post_img_id);
            } else {
                echo get_img_html_code($post_img_id, 'img_410_280');
            }*/
        ?>
        <?php echo get_media_icon_html($media_term); ?>
        
    </a>
</div>