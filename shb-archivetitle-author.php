<?php

/**
 * Plugin Name:       Block: Author archive title
 * Description:       Provides a block which shows the name of the current author on the author archive page.
 * Requires at least: 5.9
 * Requires PHP:      8.0
 * Version:           1.0.0
 * Author:            Say Hello GmbH
 * Author URI:        https.//sayhello.ch/
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       shb-archivetitle-author
 */

function shb_archivetitle_author_block_init()
{
	register_block_type_from_metadata(__DIR__ . '/build', [
		'render_callback' => 'shb_archivetitle_author_render_block',
	]);
}
add_action('init', 'shb_archivetitle_author_block_init');

/**
 * Renders the `sht/query-no-results` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapped block HTML.
 */
function shb_archivetitle_author_render_block($attributes, $content, $block)
{

	if (!is_author()) {
		return apply_filters('shb/archivetitle-author/notauthor', '');
	}

	ob_start();
	$classes = [];
	if (!empty($text_align = $attributes['textAlign'] ?? '')) {
		$classes[] = "has-text-align-{$text_align}";
	}

	if (!empty($classes)) {
		$blockWrapperAttributes = get_block_wrapper_attributes(['class' => implode(' ', $classes)]);
	} else {
		$blockWrapperAttributes = get_block_wrapper_attributes();
	}

	$author = apply_filters('shb/archivetitle-author/queried_object', get_queried_object());

?>
	<h1 class="<?php echo "{$attributes['classNameBase']}__title"; ?>"><?php echo get_the_author_meta('display_name', $author->ID); ?></h1>
<?php
	$content = ob_get_contents();
	ob_end_clean();

	$content = apply_filters('shb/archivetitle-author/block-content', $content);

	return sprintf(
		'<div %1$s>%2$s</div>',
		$blockWrapperAttributes,
		$content
	);
}
