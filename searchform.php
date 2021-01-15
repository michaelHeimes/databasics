<?php

/**
 * The template for displaying search forms
 *
 * @package DATABASICS
 */
?>

<form method="get" id="searchform" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<label for="s" class="screen-reader-text"><?php _e('Search', 'databasics'); ?></label>
	<div class="search-input-wrapper">
		<button type="submit" class="submit" id="searchsubmit"><?php esc_attr_e('Search', 'databasics'); ?></button>
		<input type="text" class="field" name="s" id="s" value="<?php //the_search_query(); ?>" />
		<label for="s"><?php esc_attr_e('Search', 'databasics'); ?></label>
	</div>
</form>