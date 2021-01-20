<?php
/**
 * Plugin Name: HAPPY SNOW MONKEY Add-ons
 * Description: You can added add-ons for Snow Monkey, Snow Monkey Blocks, Snow Monkey Editors.
 * Version: 0.1.4
 * Tested up to: 5.6
 * Requires at least: 5.6
 * Requires PHP: 7.0
 * Author: Olein-jp
 * Author URI: https://olein-design.com
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: happy-snow-monkey-addons
 *
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

define( 'HAPPY_SNOW_MONKEY_ADDONS_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'HAPPY_SNOW_MONKEY_ADDONS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'HAPPY_SNOW_MONKEY_WEBSITE_URL', 'https://happy-snow-monkey.olein-design.com' );

define(
	'HAPPY_SNOW_MONKEY_ADDONS_BLOCK_STYLES',
	[
		[
			'snow-monkey-blocks/like-me-box',
			'[Like me box] Right image',
			'hsma--lmb--right-image',
		],
		[
			'snow-monkey-blocks/recent-posts',
			'[Recent posts] Undisplayed author name',
			'hsma--rp--undisplayed-author-name',
		],
		[
			'snow-monkey-blocks/recent-posts',
			'[Recent posts] Undisplayed author date',
			'hsma--rp--undisplayed-author-date',
		],
	]
);

/**
 * Function : plugin loaded
 */
function plugins_loaded() {

	/**
	 * Include : Show action hook points
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/show-action-hook-points.php' );

	/**
	 * Include : Block styles
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/block-styles.php' );

	/**
	 * Include : Settings panel
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/settings-panel.php' );

	/**
	 * Updater
	 *
	 * @link https://github.com/inc2734/wp-github-plugin-updater
	 */
	new Inc2734\WP_GitHub_Plugin_Updater\Bootstrap(
		plugin_basename( __FILE__ ),
		'Olein-jp',
		'happy-snow-monkey-addons'
	);

}
add_action( 'plugins_loaded', 'plugins_loaded' );

/**
 * jobs when activated for action hooks
 */
register_activation_hook(
	__FILE__,
	function() {
		add_option( 'show-action-hook-points', '' );
	}
);

/**
 * jobs when deactivated for action hooks.
 */
register_deactivation_hook(
	__FILE__,
	function() {
		delete_option( 'show-action-hook-points' );
	}
);

/**
 * Register activation & deactivation jobs for block styles
 */
foreach ( HAPPY_SNOW_MONKEY_ADDONS_BLOCK_STYLES as list( , , $block_style_slug ) ) {
	register_activation_hook(
		__FILE__,
		function() use ( $block_style_slug ) {
			add_option( $block_style_slug, '1' );
		}
	);
	register_deactivation_hook(
		__FILE__,
		function() use ( $block_style_slug ) {
			delete_option( $block_style_slug );
		}
	);
}

/**
 * for composer
 */
require_once( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/vendor/autoload.php' );
