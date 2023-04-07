<?php get_header(); ?>
<?php 
	$boxer_id 			= get_the_ID();
	$boxer_big_photo_id = get_field('big_image', $boxer_id);
	$boxer_about_img_id = get_field('about_photo', $boxer_id);
	$boxer_name 		= get_field('name', $boxer_id);
	$boxer_lastname 	= get_field('lastname', $boxer_id);
	$boxer_titles		= get_field('titles', $boxer_id);
	$boxer_statistics	= get_field('statistics', $boxer_id);
	$boxer_category		= wp_get_post_terms( $boxer_id, 'weight_cat' )[0];
	$boxer_about		= get_field('about', $boxer_id);
	$boxer_country 		= $boxer_about['country'];
	$boxer_city 		= $boxer_about['city'];
	$boxer_birthday 	= $boxer_about['birthday'];
	$boxer_height 		= $boxer_about['height'];
	$boxer_weight 		= $boxer_about['weight'];
	if($boxer_birthday) {
		$boxer_birthday_date = new DateTime($boxer_birthday);
		$today_date = new DateTime();
		$boxer_age = $boxer_birthday_date->diff($today_date);
	}
	$boxer_social 		= get_field('social', $boxer_id);
	$boxer_instagram	= $boxer_social['instagram'];
	$boxer_facebook		= $boxer_social['facebook'];
	$boxer_twitter		= $boxer_social['twitter'];
	$boxer_fights		= get_field('figths'. $boxer_id);

?>
<div class="boxer-page">
	<div class="first-screen first-screen-boxer">
		<?php if ($boxer_big_photo_id): ?>
			<div class="first-screen-boxer-big-photo" >
				<?php echo get_img_html_code($boxer_big_photo_id); ?>
			</div>
		<?php endif; ?>
		<div class="first-screen-boxer-shadow"></div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php breadcrumbs(); ?>
				</div>
			</div>
			<div class="row align-items-center justify-content-xxl-end justify-content-xl-end first-screen-content">
				<div class="col-xxl-5 col-xl-6 col-12">
					<h1>
						<p class="boxer-page-name"><?php echo $boxer_name; ?></p>
						<p class="boxer-page-lastname"><?php echo $boxer_lastname; ?></p>
					</h1>
					<?php if( count($boxer_titles) ): ?>
					<div class="boxer-page-titles">
						<span><?php echo esc_attr( pll__( 'Титули' )); ?></span>
						<ul>
						<?php 
							foreach ($boxer_titles as $title => $showTitle):
								if($showTitle): ?>
							<li>
							<?php 
								$icon_id = get_field($title, 'option');
								echo get_image_html_code_by_id($icon_id);
							?>
							</li>
						<?php 
								endif;
							endforeach; ?>
						</ul>					
					</div>
					<?php endif; ?>
					<div class="boxer-page-statistics">
						<ul>	
							<li>
								<?php $wins = $boxer_statistics['wins'] ? $boxer_statistics['wins'] : '0'; ?>
								<p class="boxer-page-statistics-value"><?php echo $wins; ?></p>
								<p class="boxer-page-statistics-name">wins</p>
							</li>
							<li>
								<?php $kos = $boxer_statistics['kos'] ? $boxer_statistics['kos'] : '0'; ?>
								<p class="boxer-page-statistics-value"><?php echo $kos; ?></p>
								<p class="boxer-page-statistics-name">kos</p>
							</li>
							<li>
								<?php $losses = $boxer_statistics['losses'] ? $boxer_statistics['losses'] : '0'; ?>
								<p class="boxer-page-statistics-value"><?php echo $losses; ?></p>
								<p class="boxer-page-statistics-name">losses</p>
							</li>
							<li>
								<?php $draws = $boxer_statistics['draws'] ? $boxer_statistics['draws'] : '0'; ?>
								<p class="boxer-page-statistics-value"><?php echo $draws; ?></p>
								<p class="boxer-page-statistics-name">draws</p>
							</li>
						</ul>
					</div>
					<?php if($boxer_category): ?>
						<div class="boxer-page-category"><?php echo $boxer_category->name; ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if($boxer_country || $boxer_city || $boxer_weight || $boxer_birthday || $boxer_height || 
		$boxer_about_img_id || $boxer_instagram || $boxer_facebook || $boxer_twitter): ?>
	<div class="container boxer-page-about">
		<div class="row justify-content-lg-end">
			<div class="col-lg-6 boxer-page-about-content-wrapper">
				<div class="row justify-content-lg-end">
					<div class="col-6 boxer-page-about-content_bg"></div>
					<div class="col-xl-10 boxer-page-about-content">
						<h2 class="uppercase"><?php echo esc_attr( pll__( 'Про боксера' )); ?></h2>
						<ul class="boxer-page-about-list">
							<?php if($boxer_country): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Країна' )); ?>:
								<strong><?php echo $boxer_country; ?></strong> 
							</li>
							<?php endif; ?>

							<?php if($boxer_weight): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Вага' )); ?>:
								<strong><?php echo $boxer_weight; ?> <?php echo esc_attr( pll__( 'кг' )); ?></strong> 
							</li>
							<?php endif; ?>

							<?php if($boxer_city): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Місто' )); ?>:
								<strong><?php echo $boxer_city; ?></strong> 
							</li>
							<?php endif; ?>

							<?php if($boxer_height): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Зріст' )); ?>:
								<strong><?php echo $boxer_height; ?><?php echo esc_attr( pll__( 'см' )); ?></strong> 
							</li>
							<?php endif; ?>

							<?php if($boxer_birthday): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Дата народження' )); ?>:
								<strong><?php echo $boxer_birthday_date->format('d.m.Y'); ?></strong>
							</li>
							<?php endif; ?>

							
							<?php if($boxer_birthday): ?>
							<li class="uppercase">
								<?php echo esc_attr( pll__( 'Повних років' )); ?>:
								<strong><?php echo $boxer_age->format('%Y'); ?></strong>
							</li>
							<?php endif; ?>
						</ul>
						<div class="boxer-page-about-bio">
							<?php the_content(); ?>
						</div>					
					</div>
				</div>
				<div class="boxer-page-social row justify-content-xl-end">
					<div class="col-xl-10">
						<?php if ($boxer_name ||  $boxer_lastname): ?>
							<div class="boxer-page-social-name-wrapper uppercase">
								<span class="boxer-page-social-name"><?php echo $boxer_name . ' ' . $boxer_lastname; ?></span><br>
								<?php echo esc_attr( pll__( 'у соціальних мережах' )); ?>: 
							</div>							
						<?php endif; ?>
						<?php if ($boxer_instagram || $boxer_facebook || $boxer_twitter): ?>
						<ul>
							<?php if($boxer_instagram): ?>
								<li><a href="<?php echo $boxer_instagram; ?>" <?php if( $boxer_social['new_windows_instagram'] ): ?>target="_blank"<?php endif; ?>>
									<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.0325 0H4.96724C2.22831 0 0 2.22974 0 4.97031V13.0404C0 15.7811 2.22831 18.0107 4.96724 18.0107H13.0325C15.7717 18.0107 18 15.781 18 13.0404V4.97031C18.0001 2.22974 15.7717 0 13.0325 0ZM16.4031 13.0404C16.4031 14.9 14.8911 16.4127 13.0327 16.4127H4.96724C3.10892 16.4128 1.59705 14.9 1.59705 13.0404V4.97031C1.59705 3.11088 3.10892 1.598 4.96724 1.598H13.0325C14.891 1.598 16.403 3.11088 16.403 4.97031V13.0404H16.4031Z" fill="black"/>
										<path d="M9 4.36467C6.44249 4.36467 4.36186 6.44654 4.36186 9.00558C4.36186 11.5645 6.44249 13.6463 9 13.6463C11.5575 13.6463 13.6381 11.5645 13.6381 9.00558C13.6381 6.44654 11.5575 4.36467 9 4.36467ZM9 12.0482C7.32321 12.0482 5.9589 10.6833 5.9589 9.00547C5.9589 7.32757 7.3231 5.96256 9 5.96256C10.6769 5.96256 12.0411 7.32757 12.0411 9.00547C12.0411 10.6833 10.6768 12.0482 9 12.0482Z" fill="black"/>
										<path d="M13.8327 3.00967C13.525 3.00967 13.2227 3.13432 13.0054 3.35271C12.787 3.57004 12.6615 3.87259 12.6615 4.18154C12.6615 4.48953 12.7871 4.79197 13.0054 5.01037C13.2226 5.2277 13.525 5.3534 13.8327 5.3534C14.1414 5.3534 14.4427 5.2277 14.661 5.01037C14.8793 4.79197 15.0038 4.48942 15.0038 4.18154C15.0038 3.87259 14.8793 3.57004 14.661 3.35271C14.4438 3.13432 14.1414 3.00967 13.8327 3.00967Z" fill="black"/>
									</svg>
								</a></li>
							<?php endif ?>
							<?php if($boxer_facebook): ?>
								<li><a href="<?php echo $boxer_facebook; ?>" <?php if( $boxer_social['new_windows_facebook'] ): ?>target="_blank"<?php endif; ?>>
									<svg width="9" height="19" viewBox="0 0 9 19" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.9453 3.48811C1.9453 3.94199 1.9453 5.96783 1.9453 5.96783H0V9.00005H1.9453V18.0107H5.94137V9.0003H8.62291C8.62291 9.0003 8.87405 7.54638 8.99579 5.95665C8.64677 5.95665 5.95648 5.95665 5.95648 5.95665C5.95648 5.95665 5.95648 4.1926 5.95648 3.8834C5.95648 3.57353 6.39217 3.15671 6.82279 3.15671C7.25261 3.15671 8.15978 3.15671 9 3.15671C9 2.74387 9 1.31741 9 1.08315e-08C7.87833 1.08315e-08 6.60224 1.08315e-08 6.03974 1.08315e-08C1.84652 -0.000209362 1.9453 3.03502 1.9453 3.48811Z" fill="black"/>
									</svg>
								</a></li>
							<?php endif ?>
							<?php if($boxer_twitter): ?>
								<li><a href="<?php echo $boxer_twitter; ?>" <?php if( $boxer_social['new_windows_twitter'] ): ?>target="_blank"<?php endif; ?>>
									<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18 1.77784C17.3306 2.07918 16.6174 2.27892 15.8737 2.37591C16.6388 1.90715 17.2226 1.17055 17.4971 0.282689C16.7839 0.719113 15.9964 1.02738 15.1571 1.19941C14.4799 0.459337 13.5146 0.000976562 12.4616 0.000976562C10.4186 0.000976562 8.77387 1.7028 8.77387 3.78909C8.77387 4.08927 8.79862 4.37791 8.85938 4.6527C5.7915 4.49914 3.07687 2.99013 1.25325 0.691403C0.934875 1.25829 0.748125 1.90715 0.748125 2.60566C0.748125 3.91724 1.40625 5.07989 2.38725 5.75299C1.79437 5.74145 1.21275 5.5648 0.72 5.28655C0.72 5.2981 0.72 5.31311 0.72 5.32812C0.72 7.16848 1.99912 8.69712 3.6765 9.04926C3.37612 9.13354 3.04875 9.17395 2.709 9.17395C2.47275 9.17395 2.23425 9.1601 2.01038 9.1093C2.4885 10.6091 3.84525 11.7117 5.4585 11.7475C4.203 12.7554 2.60888 13.3627 0.883125 13.3627C0.5805 13.3627 0.29025 13.3488 0 13.3107C1.63462 14.3926 3.57188 15.0103 5.661 15.0103C12.4515 15.0103 16.164 9.23746 16.164 4.23359C16.164 4.06618 16.1584 3.90454 16.1505 3.74406C16.8829 3.21065 17.4982 2.54447 18 1.77784Z" fill="black"/>
									</svg>
								</a></li>
							<?php endif ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 boxer-page-about-small-photo">
				<div class="boxer-page-company-logo">
					<svg width="520" height="788" viewBox="0 0 520 788" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M215.309 262.369H0V788H215.309V262.369Z" fill="#D61D1D"/>
						<path d="M0 0V181.981H304.691V788H520V0" fill="#D61D1D"/>
					</svg>
				</div>
				<?php 
					if($boxer_about_img_id):
						echo get_image_html_code_by_id($boxer_about_img_id);
					endif; 
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(have_rows('figths')): ?>
		<div class="boxer-page-fights-wrapper">
			<?php 
				$fights_block_bg_id = get_field('fights_bg', 'option');
				if($fights_block_bg_id): 
					echo get_image_html_code_by_id($fights_block_bg_id);
				endif;
				$rows_count = 0;
			?>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="block-title block-title-white"><?php echo esc_attr( pll__( 'Історія поєдинків' )); ?></h3>
						<table>
							<thead>
								<tr>
									<th><?php echo esc_attr( pll__( 'Результат')); ?></th>
									<th><?php echo esc_attr( pll__( 'Супротивник' )); ?></th>
									<th><?php echo esc_attr( pll__( 'Дата' )); ?></th>
									<th><?php echo esc_attr( pll__( 'Метод' )); ?></th>
									<th><?php echo esc_attr( pll__( 'Раунд' )); ?></th>
									<th><?php echo esc_attr( pll__( 'Час' )); ?></th>
									<th><?php echo esc_attr( pll__( 'Замітка' )); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php while(have_rows('figths')): the_row(); $rows_count++; ?>
								<tr>
									<?php 
										$result = get_sub_field('result');
									?>
									<td data-title="<?php echo esc_attr( pll__( 'Результат' )); ?>">
										<div class="result-wrapper-<?php echo $result; ?> uppercase">
											<?php 
												switch ($result) {
													case 'win':
														echo esc_attr( pll__( 'Перемога' ));
														break;
													case 'lose':
														echo esc_attr( pll__( 'Поразка' ));
														break;
													case 'draw':
														echo esc_attr( pll__( 'Нічия' ));
														break;
												}
											?>
										</div>		
									</td>
									<td class="uppercase" data-title="<?php echo esc_attr( pll__( 'Супротивник' )); ?>"><?php echo get_sub_field('opponent'); ?></td>
									<td data-title="<?php echo esc_attr( pll__( 'Дата' )); ?>"><?php echo localize_date_F_d_Y(get_sub_field('date')); ?></td>
									<td data-title="<?php echo esc_attr( pll__( 'Метод' )); ?>"><?php echo get_sub_field('method'); ?></td>
									<td data-title="<?php echo esc_attr( pll__( 'Раунд' )); ?>"><?php echo get_sub_field('round'); ?></td>
									<td data-title="<?php echo esc_attr( pll__( 'Час' )); ?>"><?php echo get_sub_field('time'); ?></td>
									<td data-title="<?php echo esc_attr( pll__( 'Замітка' )); ?>"><?php echo get_sub_field('notice'); ?></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
						<?php if($rows_count > 5): ?>
							<a href="#" class="show-more-fights"><?php echo esc_attr( pll__( 'Показати ще бої' )); ?> +</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php 

		$search_boxer_id = $boxer_id;
		$single_boxer_media_slider = true;

		$media_term = 'video';
		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'media',
			'posts_per_page' 	=> 10,
			'orderby' 			=> 'publish_date',
			'order'				=> 'DESC',
			'filter_by_repeater'=> 'yes',
			'meta_query' 		=> array(
				'relation' 		=> 'AND',
				array(	
					'key'     => 'boxers_$_boxer',
					'value'   => $boxer_id,
					'compare' => '=',
				),
			),
			'tax_query'	=> array(
				'relation' 		=> 'AND',
				array(
					'taxonomy' 	=> 'media_cat',
					'field'		=> 'slug',
					'terms'		=> array( $media_term ),

				),
			),
		);
		$media = new WP_Query($args);
		
		if ( $media->have_posts() ):
			include get_template_directory() .  '/template-parts/media-slider.php';
		endif;


		
		$media_term = 'photo';
		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'media',
			'posts_per_page' 	=> 10,
			'orderby' 			=> 'publish_date',
			'order'				=> 'DESC',
			'filter_by_repeater'=> 'yes',
			'meta_query' 		=> array(
				'relation' 		=> 'AND',
				array(	
					'key'     => 'boxers_$_boxer',
					'value'   => $boxer_id,
					'compare' => '=',
				),
			),
			'tax_query'	=> array(
				'relation' 		=> 'AND',
				array(
					'taxonomy' 	=> 'media_cat',
					'field'		=> 'slug',
					'terms'		=> array( $media_term ),

				),
			),
		);
		$media = new WP_Query($args);
		


		if ( $media->have_posts() ):
			include get_template_directory() .  '/template-parts/media-slider.php';
		endif;


		$args = array(
			'post_status'		=> 'publish',
			'post_type' 		=> 'news',
			'posts_per_page' 	=> 10,
			'orderby' 			=> 'publish_date',
			'order'				=> 'DESC',
			'filter_by_repeater'=> 'yes',
			'meta_query' 		=> array(
			'relation' => 'AND',
				array(	
					'key'     => 'boxers_$_boxer',
					'value'   => $boxer_id,
					'compare' => '=',
				),
			)
		);
		$news = new WP_Query($args);
		
		if ( $news->have_posts() ):
			include get_template_directory() .  '/template-parts/news-slider.php';
		endif; 
	?>
</div>
<?php get_footer(); ?>