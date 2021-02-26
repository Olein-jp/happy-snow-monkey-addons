<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * include wp-admin/includes/plugin.php
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Check Snow Monkey Blocks activated
 */
if ( ! is_plugin_active( 'snow-monkey-blocks/snow-monkey-blocks.php' ) ) {
	add_action( 'admin_notices', 'hsma_admin_notice_no_snow_monkey_blocks' );
	return;
}

/**
 * Admin Notice : No Snow Monkey Blocks
 */
function hsma_admin_notice_no_snow_monkey_blocks() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p>
			<?php esc_html_e( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Blocks', 'happy-snow-monkey-addons' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Check version of Snow Monkey Blocks
 */
$active_plugins = get_option( 'active_plugins', array() );
foreach ( $active_plugins as $plugin ) {
	$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
	// Snow Monkey Blocks is activated
	if ( 'snow-monkey-blocks' === $plugin_data['TextDomain'] && ! version_compare( $plugin_data['Version'], '10.0.0', '>=' ) ) {
		add_action( 'admin_notices', 'hsma_admin_notice_invalid_snow_monkey_blocks_version' );
		return;
	}
}

/**
 * Admin Notice : Invalid Snow Monkey Blocks version
 */
function hsma_admin_notice_invalid_snow_monkey_blocks_version() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p>
			<?php
			echo sprintf(
			// translators: %1$s: version
				esc_html__( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Blocks %1$s or more', 'happy-snow-monkey-addons' ),
				'v11.0.0'
			);
			?>
		</p>
	</div>
	<?php
}

/**
 * Enqueue styles
 */
add_action(
	'enqueue_block_assets',
	function () {
		wp_enqueue_style(
			'hsma-block-styles',
			HAPPY_SNOW_MONKEY_ADDONS_URL . '/build/block-style.css',
			[],
			filemtime( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/build/block-style.css' )
		);
	}
);

/**
 * block styles
 */
$styles = include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/config/styles.php' );

foreach ( $styles as $style ) {
	register_block_style(
		$style['block_name'],
		array(
			'name'  => $style['style_name'],
			'label' => esc_html( $style['style_label'] ),
		)
	);
}
