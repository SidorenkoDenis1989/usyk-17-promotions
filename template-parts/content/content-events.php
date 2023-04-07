<?php
    $post_img_id    = get_field('main_img', $post_id);
    $events_slider_item = $home_events_slider ? 'col-md-6' : 'col-lg-6';
?>
<div class="archive-events-item <?php echo $events_slider_item; ?> col-12">
    <a href="<?php echo get_the_permalink($post_id); ?>" title="<?php echo get_the_title($post_id); ?>">
        <?php echo get_img_html_code($post_img_id, 'full'); ?>
    </a>
</div>