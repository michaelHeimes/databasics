<?php

/**
 * Template Name: News & Events
 *
 * @package DATABASICS
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php get_template_part('template-parts/hero'); ?>

	<?php if( '' !== get_post()->post_content ):?>
	<section class="content-block content-block--intro background-color--white">
		<div class="container">
			<div class="content-block--intro--text">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php endif;?>

	<div class="library-wrap archive">
		<div class="library-list-menu-toggle-wrap"><button type="button" class="library-list-menu-toggle"><span>Filter Projects</span></button></div>
		<div class="library-filters">
			<div class="library-filters-header">
				<h3 class="library-filters-title">Filter</h3>
				<button type="button" class="clear-all-filters filter-button">Clear All</button>
			</div>

			<?php if ($terms = get_terms('news-event-type', [
				'orderby' => 'term_order',
				'order'   => 'ASC',
			])) : ?>

			<div class="library-list-filter-box category-group filter-card" data-filter="news-event-type">
				<div class="library-filter-checkboxes">

				<?php foreach ($terms as $term) : ?>

					<div class="library-list-filter-box-checkbox">
						<input type="checkbox" name="integrationLibraryType-<?php echo $term->term_id; ?>" id="integrationLibraryType-<?php echo $term->term_id; ?>" value="<?php echo $term->term_id; ?>" data-tax="library-integrationLibraryType" class="category checkbox-<?php echo $term->slug; ?>">
						<label for="integrationLibraryType-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>
					</div>

				<?php endforeach; ?>
				</div>
			</div>

			<?php endif; ?>
		</div>
		<div class="library-list">
			<div class="library-search">
				<form class="library-list-search" method="post" action="index.php">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="26" height="26" class="search-icon"><path d="M19.9 17.7l-5.5-5.6c.7-1.2 1.2-2.6 1.2-4.2 0-4.3-3.5-7.8-7.7-7.8C3.6.1.2 3.6.2 7.9s3.5 7.8 7.7 7.8c1.6 0 3.2-.5 4.4-1.4l5.4 5.5 2.2-2.1zM7.8 13.2c-2.9 0-5.2-2.4-5.2-5.3S5 2.6 7.8 2.6C10.7 2.6 13 5 13 7.9s-2.3 5.3-5.2 5.3z" fill-rule="evenodd" clip-rule="evenodd" fill="#00a0df" /></svg>
					<input type="search" class="library-list-search-input" name="library-search" placeholder="Search Content">
				</form>
			</div>

			<div class="archive-grid"></div>

			<div class="library-list-wrap archive-footer is-hidden">
				<div class="library-list-wrap-left"></div>
				<div class="library-list-wrap-right">
					<div class="library-list-pagination">
						<div class="library-list-pagination-pages">
							<div class="pagination">
								<a href="#" data-page="" class="prev">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 24" width="15" height="24"><path d="M12.2 0L15 2.8 5.7 12l9.3 9.2-2.8 2.8L0 12 12.2 0z" /></svg>
									Prev
								</a>
								<a href="#" data-page="" class="next">
									Next
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 24" width="15" height="24"><path d="M2.8 24L0 21.2 9.3 12 0 2.8 2.8 0 15 12 2.8 24z" /></svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</main><!-- #main -->

<?php
$args = [
	'post_type'        => 'news_event',
	'post_status'      => 'publish',
	'posts_per_page'   => -1,
	'suppress_filters' => false,
];

$posts = get_posts($args);

if ($posts) :
	foreach ($posts as $k => $post) {
		$source[$k]['ID']        = $post->ID;
		$source[$k]['label']     = $post->post_title; // The name of the post
		$source[$k]['permalink'] = get_permalink($post->ID);
		$source[$k]['content']   = $post->post_content;
	}
?>
	<script type="text/javascript">
		jQuery(document).ready(function() {

			var posts = <?php echo json_encode(array_values($source)); ?>;

			jQuery('input[name="library-search"]').autocomplete({
				source: posts,
				minLength: 1,
				appendTo: ".library-search"
			});
		});
	</script>
<?php endif; ?>

<?php
get_footer();
