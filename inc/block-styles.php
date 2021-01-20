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
			<?php esc_html_e( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Blocks.', 'happy-snow-monkey-addons' ); ?>
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
				esc_html__( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Blocks %1$s or more.', 'happy-snow-monkey-addons' ),
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
			filemtime( HAPPY_SNOW_MONKEY_ADDONS_PATH )
		);
	}
);

/**
 * block styles
 */
foreach ( HAPPY_SNOW_MONKEY_ADDONS_BLOCK_STYLES as list( $target_block, $block_style_name, $block_style_slug ) ) {
	if ( '1' === get_option( $block_style_slug ) ) {
		register_block_style(
			$target_block,
			array(
				'name'  => $block_style_slug,
				'label' => __( '[HSMA]' . $block_style_name, 'happy-snow-monkey-addons' ),
			)
		);
	}
}
