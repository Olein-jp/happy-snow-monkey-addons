<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

$theme = wp_get_theme( get_template() );
/**
 * Check Snow Monkey activated
 */
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	add_action( 'admin_notices', 'hsma_admin_notice_no_snow_monkey' );
	return;
}
/**
 * Check Snow Monkey version
 */
if ( ! version_compare( $theme->get( 'Version' ), '12.1.0', '>=' ) ) {
	add_action( 'admin_notices', 'hsma_admin_notice_invalid_snow_monkey_version' );
	return;
}
/**
 * Admin Notice : No Snow Monkey
 */
function hsma_admin_notice_no_snow_monkey() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p>
			<?php esc_html_e( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey', 'happy-snow-monkey-addons' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Admin Notice : Invalid Snow Monkey version
 */
function hsma_admin_notice_invalid_snow_monkey_version() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p>
			<?php
			echo sprintf(
			// translators: %1$s: version
				esc_html__( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey %1$s or more', 'happy-snow-monkey-addons' ),
				'v12.1.0'
			);
			?>
		</p>
	</div>
	<?php
}

/**
 * When 'show-action-hook-points is checked...
 */
if ( '1' === get_option( 'show-action-hook-points' ) ) {

	/**
	 * import style sheet
	 */
	add_action(
		'wp_enqueue_scripts',
		function () {
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
		'snow_monkey_after_header_site_branding_column',
		'snow_monkey_before_header_site_branding_column',
	];

	foreach ( $action_hooks as $action_hook ) {
		add_action(
			$action_hook,
			function () use ( $action_hook ) {
				?>
				<div class="c-btn c-btn--block c-hsma-hook-point p-<?php echo esc_html( $action_hook ); ?>">
					<p><a href="<?php echo esc_url( HAPPY_SNOW_MONKEY_WEBSITE_URL . '/' . $action_hook ); ?>" target="_blank" title="<?php printf ( esc_html__( 'Here is %1$s', 'happy-snow-monkey-addons' ), $action_hook ); ?>"><?php echo esc_html( $action_hook ); ?></a></p>
				</div>
				<?php
			}
		);
	}
}
