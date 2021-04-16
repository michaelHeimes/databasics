<?php
while (have_posts()) : the_post();
	// Check for content blocks
	if (have_rows('content_blocks')) :
		// Loop through content blocks
		while (have_rows('content_blocks')) : the_row();
			$row_layout = get_row_layout();

			if ($row_layout == 'intro') :
				get_template_part('template-parts/content-block', 'intro');
			elseif ($row_layout == 'blurb') :
				get_template_part('template-parts/content-block', 'blurb');
			elseif ($row_layout == 'highlight_blurb') :
				get_template_part('template-parts/content-block', 'highlight-blurb');
			elseif ($row_layout == 'media_block') :
				get_template_part('template-parts/content-block', 'media-block');
			elseif ($row_layout == 'recent_posts') :
				get_template_part('template-parts/content-block', 'recent-posts');
			elseif ($row_layout == 'product_info') :
				get_template_part('template-parts/content-block', 'product-info');
			elseif ($row_layout == 'feature_grid') :
				get_template_part('template-parts/content-block', 'feature-grid');
			elseif ($row_layout == 'better_integration') :
				get_template_part('template-parts/content-block', 'better-integration');
			elseif ($row_layout == 'industry_slider') :
				get_template_part('template-parts/content-block', 'industry-slider');
			elseif ($row_layout == 'customer_successes') :
				get_template_part('template-parts/content-block', 'customer-successes');
			elseif ($row_layout == 'raw_js') :
				get_template_part('template-parts/content-block', 'raw-js');
			elseif ($row_layout == 'two_columns') :
				get_template_part('template-parts/content-block', 'two-columns');
			elseif ($row_layout == 'three_cta_set') :
				get_template_part('template-parts/content-block', 'three-cta-set');
			elseif ($row_layout == 'gravity_form') :
				get_template_part('template-parts/content-block', 'gravity-form');
			elseif ($row_layout == 'steps') :
				get_template_part('template-parts/content-block', 'steps');
			elseif ($row_layout == 'accordion') :
				get_template_part('template-parts/content-block', 'accordion');
			elseif ($row_layout == 'wysiwyg') :
				get_template_part('template-parts/content-block', 'wysiwyg');
			endif;
		endwhile;
	endif;
endwhile;
