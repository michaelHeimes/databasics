<?php

/**
 * Template for the Team page
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php get_template_part('template-parts/content-blocks'); ?>

	<?php get_template_part('template-parts/team-grid'); ?>

</main><!-- #main -->

<?php
get_footer();
