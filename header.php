<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P663SXZ');</script>
<!-- End Google Tag Manager -->	
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P663SXZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->	
<?php wp_body_open(); ?>
<?php 
	$header_class 		= is_black_header() ? 'header-black' : '';
	$hamburger_color 	= is_black_header() ? 'white' : 'black';
?>
	<header class="header <?php echo $header_class; ?>">
		<div class="container">
			<div class="row">
				<div class="mobile-menu-hamburger col-2 align-self-center">
					<a href="" class="open-mobile-menu">
						<svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0H20V2H0V0Z" fill="<?php echo $hamburger_color; ?>"/>
							<path d="M0 6H20V8H0V6Z" fill="<?php echo $hamburger_color; ?>"/>
							<path d="M0 12H20V14H0V12Z" fill="<?php echo $hamburger_color; ?>"/>
						</svg>
					</a>
				</div>
				<div class="header__logo-phone col-xxl-4 col-8">
					<?php
						$black_logo_id	= get_theme_mod( 'black_logo' );
						$white_logo_id 	= get_theme_mod( 'custom_logo' );
						$logo_id 		= is_black_header() ? $white_logo_id : $black_logo_id;
					?>
					<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php echo get_image_html_code_by_id($logo_id, array('header__logo')); ?>
					</a>
					<?php 
						$phone = get_field("phone_header", 'option');
						$phone_mailto = get_phone_as_mailto_link($phone);
					?>
					<div class="header__phone-сontainer">
						<span><?php echo esc_attr( pll__('тел.')); ?>:</span>
						<a href="tel: <?php echo $phone_mailto; ?>"><?php echo $phone; ?></a>
					</div>
				</div>
				<div class="header__main-menu col-xxl-8 col-2">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<ul class="main-menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'items_wrap'     => '%3$s',
									'container'      => false,
									'depth'          => 2,
									'link_before'    => '',
									'link_after'     => '',
									'fallback_cb'    => false,
								)
							);
							?>
						</ul>
					<?php endif; ?>
					<?php $shop_link = get_field('shop_link', 'option'); ?>
					<a href="<?php echo $shop_link; ?>" class="header__shop-link" target="_blank">SHOP</a>
					<div class="lang-switcher-container">
						<?php 
							$current_lang = pll_current_language();
							if($current_lang == 'ua') {
								$current_lang = 'uk';
							}
						?>
						<a href="#" class="current-lang"><?php echo get_locale_languge_country($current_lang); ?></a>
							<?php 
								$langs_array = pll_the_languages( array( 'dropdown' => 1, 'hide_current' => 1, 'raw' => 1 ) );
							?>
							<?php if ($langs_array) : ?>
							  <ul>
							    <?php 
							    	foreach ($langs_array as $lang) :
							    		if($lang['slug'] == 'ua'){
							    			$lang['slug'] = 'uk';
							    		} 
						    	?>
								<li>    
							    	<a href="<?php echo $lang['url']; ?>" class="drop-block__link">
							        	<?php echo get_locale_languge_country($lang['slug']); ?>
							        </a>
							    </li>
							    <?php endforeach; ?>
							  </ul>
							<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-12 header-underline"></div>
		</div>
	</header>
	<div class="mobile-menu-wrapper">
		<div class="mobile-menu-content">
			<ul class="main-menu__mobile">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'items_wrap'     => '%3$s',
						'container'      => false,
						'depth'          => 2,
						'link_before'    => '',
						'link_after'     => '',
						'fallback_cb'    => false,
					)
				);
			?>
			</ul>
			<a href="<?php echo $shop_link; ?>" class="header__shop-link" target="_blank">SHOP</a>
			<div class="header__phone-сontainer">
				<span><?php echo esc_attr( pll__('тел.')); ?>:</span>
				<a href="tel: <?php echo $phone_mailto; ?>"><?php echo $phone; ?></a>
			</div>
			<a href="#" class="close-mobile-menu">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M2 2L22 22M22 2L2 22" stroke="white" stroke-width="2" stroke-linecap="square" stroke-linejoin="round"/>
				</svg>
			</a>			
		</div>
	</div>
	<main>
		