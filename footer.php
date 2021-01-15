<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DATABASICS
 */

?>

		<footer id="site-footer" class="site-footer">
			<div class="container">
				<div class="site-info">
					<section id="media_image-2" class="widget widget_media_image">
						<a href="/" rel="home">
							<?php echo file_get_contents(get_theme_file_path('images/logo/databasics-logo-white.svg')); ?>
						</a>
					</section>
					<?php
					if (is_active_sidebar('footer')) :
						dynamic_sidebar('footer');
					endif;
					?>
				</div><!-- .site-info -->
				<nav id="footer-navigation" class="footer-navigation">
					<?php
					wp_nav_menu([
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
					]);
					?>
					
					<?php 
					$image = get_field('awards_image', 'option');
					if( !empty( $image ) ): ?>
					<div class="awards-img-wrap">
					    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
					</div>
					
				</nav><!-- #footer-navigation -->
				<div class="copyright">
					Copyright &copy; <?php echo date('Y'); ?> DATABASICS Inc. All rights reserved.
					|
					<a href="<?php echo get_permalink(get_page_by_title('Privacy Policy')); ?>">Privacy Policy</a>
					|
					Created with ♥ by <a href="http://www.pomagency.com" target="_blank">Pomerantz</a>
				</div><!-- .copyright -->
				<div class="social-links">
					<?php
					if (is_active_sidebar('social')) :
						dynamic_sidebar('social');
					endif;
					?>
				</div><!-- .social-links -->
			</div><!-- .container -->
		</footer><!-- #site-footer -->
	</div><!-- #page -->

<?php get_template_part('template-parts/call-to-actions'); ?>

<?php // get_template_part('template-parts/video-modal'); ?>

<?php wp_footer(); ?>

</body>

</html>
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"25024137"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>