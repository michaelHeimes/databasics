<?php

/**
 * The template for displaying the front page
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php get_template_part('template-parts/content-blocks'); ?>

</main><!-- #primary -->

<?php
get_footer();
