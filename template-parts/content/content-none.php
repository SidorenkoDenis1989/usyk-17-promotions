<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<?php
    $post_type = get_queried_object()->name;
    switch ($post_type) {
        case 'boxers':
            $message = esc_attr( pll__( 'Немає боксерів по даному запиту' ));
            break;
        case 'news':
            $message = esc_attr( pll__( 'Немає новин за даним запитом' ));
            break;
        case 'media':
            $message = esc_attr( pll__( 'Немає медіа по даному запиту' ));
            break;
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12 nothing-found-wrap">
            <p class="nothing-found"><?php echo $message; ?></p>
        </div>
    </div>
</div>