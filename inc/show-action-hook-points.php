<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * import style sheet
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'hsma-output-action-hook-styles',
			HAPPY_SNOW_MONKEY_ADDONS_URL . '/build/action-hook.css',
			[ \Framework\Helper::get_main_style_handle() ],
			filemtime( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/build/action-hook.css' )
		);
	}
);

$action_hooks = [
	'snow_monkey_prepend_drawer_nav',
	'snow_monkey_append_drawer_nav',
	'snow_monkey_prepend_body',
	'snow_monkey_prepend_footer',
	'snow_monkey_append_footer',
	'snow_monkey_prepend_sidebar',
	'snow_monkey_append_sidebar',
	'snow_monkey_prepend_main',
	'snow_monkey_append_main',
	'snow_monkey_prepend_contents',
	'snow_monkey_append_contents',
	'snow_monkey_before_contents_inner',
	'snow_monkey_after_contents_inner',
	'snow_monkey_prepend_entry_content',
	'snow_monkey_append_entry_content',
	'snow_monkey_before_entry_content',
	'snow_monkey_after_entry_content',
	'snow_monkey_append_archive_entry_content',
	'snow_monkey_prepend_archive_entry_content',
	'snow_monkey_before_archive_entry_content',
	'snow_monkey_append_archive_entry_content',
	'snow_monkey_entry_meta_items',
];

foreach ( $action_hooks as $action_hook ) {
	add_action(
		$action_hook,
		function() use ( $action_hook ) {
			?>
			<div class="c-btn c-btn--block c-hsma-hook-point">
				<p><a href="<?php echo esc_url( HAPPY_SNOW_MONKEY_WEBSITE_URL . '/' . $action_hook ); ?>" target="_blank"><?php echo esc_html( $action_hook ); ?></a></p>
			</div>
			<?php
		}
	);
}
