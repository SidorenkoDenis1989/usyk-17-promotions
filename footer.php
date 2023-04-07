	</main>
	<footer class="footer">
		<div class="container">
			<div class="row justify-content-xxl-between">
				<div class="col-xxl-9 col-xl-12">
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
						<ul class="footer__menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'items_wrap'     => '%3$s',
									'container'      => false,
									'depth'          => 1,
									'link_before'    => '',
									'link_after'     => '',
									'fallback_cb'    => false,
								)
							);
							?>
						</ul>
					<?php endif; ?>
					<div class="footer__confidential-wrapper">
						<span class="footer__copyright">Copyright © 2010-<?php echo date('Y'); ?></span>
						<?php if ( has_nav_menu( 'footer_сonfidantials' ) ) : ?>
							<ul class="footer__menu-confidential">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_сonfidantials',
										'items_wrap'     => '%3$s',
										'container'      => false,
										'depth'          => 1,
										'link_before'    => '',
										'link_after'     => '',
										'fallback_cb'    => false,
									)
								);
								?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-xxl-3 col-xl-12">
				<?php if( have_rows('social_icon', 'option') ): ?>
					<ul class="footer__social">
					<?php while( have_rows('social_icon', 'option') ): the_row(); ?>
						<?php 
							$icon_id = get_sub_field('icon', 'option');
						?>
						<li>
							<a href="<?php echo get_sub_field('social_link', 'option'); ?>" <?php if( get_sub_field('new_window', 'option') ): ?>target="_blank"<?php endif; ?>>
								<?php echo get_image_html_code_by_id($icon_id); ?>
							</a>
						</li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php 
					$creator_icon_id		= get_field('site_creator', 'option');
					$creator_url 			= get_field('creator_link', 'option');
				?>
				<?php if(get_field('site_creator', 'option')): ?>
					<div class="footer__created-by">
						<span><?php echo esc_attr( pll__( 'Розроблено в' )); ?></span>
						<a href="<?php echo $creator_url; ?>">
						<?php echo get_image_html_code_by_id($creator_icon_id); ?>
						</a>
					</div>
				<?php endif; ?>
				</div>
				<div class="col-12 footer__copyright-mobile">
					<span class="footer__copyright">Copyright © 2010-<?php echo date('Y'); ?></span>
				</div>
			</div>
		</div>
	</footer>
	<a href="#" class="back-to-top">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
<path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394  l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393  C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"/>
<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
</svg></a>
<?php wp_footer(); ?>
</body>
</html>