<?php /* Template Name: Контакти */ ?>

<?php get_header(); ?>
<div class="blurable">
	<div class="about_back">
		<div class="first-screen-boxer-shadow"></div>
		<div class="container backcrumbs_wrapper" >
			<div class="row">
				<div class="col-12">
					<?php breadcrumbs(); ?>
				</div>
			</div>
		</div>
		<?php 
			$banner_id = get_field('contact_back'); 
			$mobile_id = get_field('mobile_screen');
			$add_class = '';
			if (!empty($mobile_id)){
				$add_class .= ' mobile_banner';
			}
		?>
		<div class="news-banner-wrapper <?php echo $add_class;?>">
			<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>	
			<?php 
				if (!empty($mobile_id)){
					echo get_image_html_code_by_id($mobile_id, array('mobile'));	
				}
			?>
			<?php the_title( '<h1 class="reb-block">', '</h1>' ); ?>
		</div>
	</div>
	<div class="container contact-section-wrapper remove-thank-you" >
		
		<div class="row">
			<div class="col-xl-5  col-12">
				<div class="desciption-block">
					<div class="description">
						<?php echo get_field('contact_description'); ?>
					</div>
					<div class="contacts">
						<div class="address">
							<div class="marker">
								<?php $banner_id = get_field('address_marker'); ?>
								<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
							</div>
							<div class="contact-block">
								<a href="<?php echo get_field('address_ulr'); ?>" target="_blank"><?php echo get_field('address_link'); ?></a>
							</div>
						</div>
						<?php 
							if( have_rows('emails_repeater') ):
						?>
						<div class="emails">
							<div class="marker">
								<?php $banner_id = get_field('email_marker'); ?>
								<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
							</div>
							<div class="contact-block">
							<?php  while( have_rows('emails_repeater') ) : the_row(); ?>
								<a href="mailto:<?php echo get_sub_field('email'); ?>" target="_blank"><?php echo get_sub_field('email'); ?></a>
							<?php endwhile;?>
							</div>
						</div>
						<?php 
							endif;
						?>
						<?php 
							if( have_rows('phones_repeater') ):
						?>
						<div class="phones">
							<div class="marker">
								<?php $banner_id = get_field('phone_marker'); ?>
								<?php echo get_image_html_code_by_id($banner_id, array('full')); ?>
							</div>
							<div class="contact-block">
							<?php  while( have_rows('phones_repeater') ) : the_row(); ?>
									<a href="tel:<?php echo get_sub_field('phone'); ?>" target="_blank"><?php echo get_sub_field('phone'); ?></a>
							<?php endwhile;?>
							</div>
						</div>
						<div class="social">
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
						</div>
						<?php 
							endif;
						?>
					</div>
				</div>
			</div>
			<div class="offset-xl-1  col-xl-5  col-12 ">
				<div class="block-contact-form-wrapper form-validate-wrapper">
					<h4><?php echo get_field('form_title'); ?></h4>
					<div class="contact-form">
						<?php echo do_shortcode(get_field('form_shortcode')); ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="thank-you-overlay">
	<div class="thank-you">
		<a href="#" class="close">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
				<path d="M2 2L14 14M14 2L2 14" stroke="black" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"/>
			</svg>
		</a>
		<h4><?php echo get_field('form_thank_you_title'); ?></h4>
		<p><?php echo get_field('form_thank_you'); ?></p>
		<a href="#" class="close-form">OK</a>
	</div>
</div>	
	
<?php get_footer(); ?>