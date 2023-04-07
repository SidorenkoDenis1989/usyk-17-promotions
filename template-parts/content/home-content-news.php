<?php
	$excerpt = wp_trim_words(get_the_content(), 17);
?>
<?php
$return = '<div class="single-news col-xxl-6 col-xl-6 col-md-6 col-12">';
	
		$return .= '<div class="news_image">';
			$return .= '<div class="boxers_news">';
				
					$boxers_array = array();
					if( have_rows('boxers') ):
					    while( have_rows('boxers') ) : the_row();
					        $boxers_array[] = get_sub_field('boxer');
					    endwhile;
				    endif;
					$separator = '';
					$output = '';
					if ( ! empty( $boxers_array ) ) {
					foreach( $boxers_array as $boxer ) {
						if($boxer) {
					    	$output .= '<span href="' .  get_post_permalink( $boxer ) . '" alt="' .  get_the_title($boxer) . '">' . get_the_title($boxer) . '</span>';
						}
					}
					$return .= $output;
					}
				
			$return .= '</div>';
			$return .= '<a href="'.get_permalink( get_the_ID() ).'">';
				$img =  get_post_thumbnail_id(); 
				$return .= get_image_html_code_by_id($img, array('full'));
			$return .= '</a>';
		$return .= '</div>';
			$return .= '<a href="'.get_permalink( get_the_ID() ).'">';
			$return .= '<p class="news_date">'. localize_date_d_F_Y(get_the_date('j F, Y')) . '</p>';
			$return .= '<h4>'. get_the_title() .'</h4>';
			$return .= '<p>'. $excerpt . '</p>';
		$return .= '</a>';
	
$return .= '</div>';
echo $return;
?>