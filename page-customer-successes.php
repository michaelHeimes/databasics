<?php

/**
 * Template for the Customer Successes page
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php get_template_part('template-parts/content-blocks'); ?>

	<?php
	/*
	$customer_successes = get_field('customer_successes');

	if ($customer_successes) :
		$background = 'yellow';

		foreach ($customer_successes as $key => $customer_success) :
			$background       = 'white'; // $background === 'yellow' ? 'white' : 'yellow';
			$company_name     = $customer_success['company_name'];
			$company_industry = $customer_success['company_industry'];
			$customer_comment = $customer_success['customer_comment'];
	?>

	<section class="customer-successes background-color--<?php echo $background; ?> text-align--left" id="customer-success-<?php echo sanitize_title($company_name); ?>">
		<div class="container">
			<?php echo $customer_comment; ?>
			<strong><em>&ndash; <?php echo $company_name; ?></em></strong>
		</div><!-- .container -->
	</section><!-- .customer-success -->

		<?php endforeach; ?>
	<?php endif; ?>
	*/
	?>

</main><!-- #main -->

<?php
get_footer();
