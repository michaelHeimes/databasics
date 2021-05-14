<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DATABASICS
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MFRZJSD');</script>
	<!-- End Google Tag Manager -->

	<!-- Lucky Orange -->
	<script type='text/javascript'>
		window.__lo_site_id = 120494;

		(function() {
			var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
			wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
		})();
	</script>
	<!-- End Lucky Orange -->
	
	<!-- ACF Header Script Field -->
	<?php if ( $header_code = get_field('psh_code_snippet') ):?>
		<?php echo $header_code;?>	
	<?php endif;?>
	<!-- End Header Script Field -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFRZJSD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'databasics'); ?></a>

		<nav id="utility-navigation" class="utility-navigation">
			<div class="container">
				<button class="menu-toggle" aria-controls="utility-menu" aria-expanded="false"><?php esc_html_e('Utility Menu', 'databasics'); ?></button>
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'utility',
						'menu_id'        => 'utility-menu',
					]
				);
				?>
				<div class="social-links">
					<a href="https://www.linkedin.com/company/databasics/" class="circle-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a><a href="https://twitter.com/databasicsinc" class="circle-icon" target="_blank"><i class="fab fa-twitter"></i></a>
				</div><!-- .social-links -->
			</div><!-- .container -->
		</nav><!-- #utility-navigation -->
		<div class="mobile-nav-overlay"></div>
		<header id="masthead" class="site-header">
			<div class="container">
				<div class="site-branding">
					<a href="/" class="custom-logo-link" rel="home">
						<?php echo file_get_contents(get_theme_file_path('images/logo/databasics-logo.svg')); ?>
					</a>
					<?php if (is_front_page() && is_home()) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>
					<?php
					$databasics_description = get_bloginfo('description', 'display');
					if ($databasics_description || is_customize_preview()) :
					?>
						<p class="site-description"><?php echo $databasics_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
				<button type="button" class="hamburger" aria-label="Menu" arial-controls="mobile-nav">
					<div></div>
				</button>
				<div class="mobile-nav" id="mobile-nav">
					<div class="mobile-nav-inner">
						<ul class="mobile-nav-inner-nav">
							<?php
							$mobilemenu = wp_nav_menu(array(
								'theme_location' => 'main',
								'container' => false,
								'items_wrap' => '%3$s',
								'echo' => false,
							));
							echo $mobilemenu;
							?>
						</ul>
						<ul class="mobile-nav-inner-nav">
							<?php
							$mobileutil = wp_nav_menu(array(
								'theme_location' => 'utility',
								'container' => false,
								'items_wrap' => '%3$s',
								'echo' => false,
							));
							echo $mobileutil;
							?>
						</ul>
						<a href="/demo/" class="mobile-nav-demo">Request Demo</a>
					</div>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu([
						'theme_location' => 'main',
						'menu_id'        => 'main-menu',
					]);
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .container -->
		</header><!-- #masthead -->