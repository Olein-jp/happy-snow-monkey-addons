<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
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
//add_action(
//	'enqueue_block_assets',
//	function() {
//		wp_enqueue_style(
//			'hsma-block-styles',
//			HAPPY_SNOW_MONKEY_ADDONS_URL . '/build/style.css',
//			[],
//			filemtime( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/build/style.css' )
//		);
//	}
//);

/**
 * block styles : [Like me box]
 *
 * Right image
 */
function hsma_block_style__lmb__right_image() {
	wp_enqueue_script(
		'hsma--lmb--right-image',
		plugins_url( '../build/like-me-box/right-image/index.js', __FILE__ ),
		[ 'wp-blocks' ],
		fileatime( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/build/like-me-box/right-image/index.js' ),
		false
	);
}

if ( '' === get_option( 'lmb__right-image' ) ) {
	add_action( 'enqueue_block_editor_assets', 'hsma_block_style__lmb__right_image' );
}

/**
 * Block styles : [recent posts]
 *
 * Undisplayed author name
 */
function hsma_block_style__rp__undisplayed_author_name() {
	wp_enqueue_script(
		'hsma--rp--undisplayed-author-name',
		plugins_url( '../build/recent-posts/undisplayed-author-name/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}

if ( '' === get_option( 'rp__undisplayed-author-name' ) ) {
	add_action( 'enqueue_block_editor_assets', 'hsma_block_style__rp__undisplayed_author_name' );
}

/**
 * Undisplayed date
 */
function hsma_block_style__rp__undisplayed_date() {
	wp_enqueue_script(
		'hsma--rp--undisplayed-date',
		plugins_url( '../build/recent-posts/undisplayed-date/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}

if ( '' === get_option( 'rp__undisplayed-date' ) ) {
	add_action( 'enqueue_block_editor_assets', 'hsma_block_style__rp__undisplayed_date' );
}
