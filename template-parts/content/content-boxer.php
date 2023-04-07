<?php
	$boxer_photo_id 	= get_field('archive_image', $boxer_id);
	$boxer_name 		= get_field('name', $boxer_id);
	$boxer_lastname 	= get_field('lastname', $boxer_id);
	$boxer_titles		= get_field('titles', $boxer_id);
	$boxer_statistics	= get_field('statistics', $boxer_id);
	$boxer_category		= wp_get_post_terms( $boxer_id, 'weight_cat' )[0];
?>
<div class="col-xxl-4 col-xl-4 col-md-6 col-12 archive-boxer-item">
	<a href="<?php echo get_the_permalink($boxer_id); ?>">
		<div class="archive-boxer-item-background">
			<svg width="410" height="600" viewBox="0 0 410 600" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0 119.083L410 217.965V136.977L320.8 114.284H410V15.4759L395.386 0H288.243L358.796 58.3695L97.006 84.4851L0 60.4528V119.083Z" fill="#D61D1D"/>
				<path d="M0 290.359L276.663 373.728L410 333.55V307.286L386.914 311.155L0 215.137V290.359Z" fill="#D61D1D"/>
				<path d="M236.41 382.991L0 435.892V373.319L42.3615 370.045L0 348.915V318.26L236.41 382.991Z" fill="#D61D1D"/>
				<path d="M0 522.684L383.103 458.697L410 468.704V359.815L0 459.739V522.684Z" fill="#D61D1D"/>
				<path d="M0 599.766L258.424 663.344L66.8905 740.5H193.827L338.263 681.87L410 699.653V600.026L340.52 630.123L0 545.712V599.766Z" fill="#D61D1D"/>
			</svg>
		</div>
		<div class="archive-boxer-item-content-wrapper">
			<?php echo get_img_html_code($boxer_photo_id ); ?>
			<div class="archive-boxer-item-shadow"></div>
			
			<div class="archive-boxer-item-content">
				<div class="archive-boxer-item-name-container">
					<p class="archive-boxer-item-name"><?php echo $boxer_name; ?></p>
					<p class="archive-boxer-item-lastname"><?php echo $boxer_lastname; ?></p>
				</div>

				<?php if( count($boxer_titles) ): ?>
					<div class="archive-boxer-item-titles">
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

				<div class="archive-boxer-item-statistics">
					<ul>
						<li>
							<?php $wins = $boxer_statistics['wins'] ? $boxer_statistics['wins'] : '0'; ?>
							<p class="archive-boxer-item-statistics-value"><?php echo $wins; ?></p>
							<p class="archive-boxer-item-statistics-name">wins</p>
						</li>
						<li>
							<?php $kos = $boxer_statistics['kos'] ? $boxer_statistics['kos'] : '0'; ?>
							<p class="archive-boxer-item-statistics-value"><?php echo $kos; ?></p>
							<p class="archive-boxer-item-statistics-name">kos</p>
						</li>
						<li>
							<?php $losses = $boxer_statistics['losses'] ? $boxer_statistics['losses'] : '0'; ?>
							<p class="archive-boxer-item-statistics-value"><?php echo $losses; ?></p>
							<p class="archive-boxer-item-statistics-name">losses</p>
						</li>
						<li>
							<?php $draws = $boxer_statistics['draws'] ? $boxer_statistics['draws'] : '0'; ?>
							<p class="archive-boxer-item-statistics-value"><?php echo $draws; ?></p>
							<p class="archive-boxer-item-statistics-name">draws</p>
						</li>
					</ul>
				</div>
				<div class="archive-boxer-item-category">
					<?php
						if($boxer_category): 
							echo $boxer_category->name;
						endif; 
					?>
				</div>
			</div>
		</div>
	</a>
</div>