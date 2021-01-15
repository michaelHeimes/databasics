<?php
$display_ctas    = true;
$call_to_actions = get_field('call_to_actions', 'option');
$show_on         = get_field('show_on', 'option');

$show_on_visibility = $show_on['visibility'];
$show_on_pages      = explode("\n", $show_on['pages']);

foreach ($show_on_pages as $page) :
	$_page = trim($page);
	$_page = trim($_page, '/');
	$_page = str_replace('*', '([^/]+)', $_page);
	$_page = '/' . $_page;

	if (preg_match('@' . $_page . '@', $_SERVER['REQUEST_URI'])) :
		if ($show_on_visibility === 'exclude') :
			$display_ctas = false;
		elseif ($show_on_visibility === 'include') :
			$display_ctas = true;
		endif;

		break;
	endif;
endforeach;

if ($call_to_actions && $display_ctas) :
?>

<div class="ctas">
	<ul>
<?php
	foreach ($call_to_actions as $call_to_action) :
		$cta        = $call_to_action['cta'];
		$cta_target = $cta['target'] ? ' target="' . $cta['target'] . '"' : '';
		?>
		<li>
			<a href="<?php echo $cta['url']; ?>"<?php echo $cta_target; ?>><?php echo $cta['title']; ?></a>
		</li>
		<?php
	endforeach;
?>
	</ul>
</div><!-- .ctas -->

<?php
endif;