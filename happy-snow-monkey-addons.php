<?php
/**
 * Plugin Name: HAPPY SNOW MONKEY Add-ons
 * Description: You can added add-ons for Snow Monkey, Snow Monkey Blocks, Snow Monkey Editors
 * Version: 0.3.4
 * Tested up to: 5.6
 * Requires at least: 5.6
 * Requires PHP: 5.6
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

/**
 * Function : plugin loaded
 */
function plugins_loaded() {
	load_plugin_textdomain( 'happy-snow-monkey-addons', false, basename( __DIR__ ) . '/languages' );
	/**
	 * Include : Show action hook points
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/show-action-hook-points.php' );

	/**
	 * Include : Block styles
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/block-styles.php' );

	/**
	 * Include : Dashboard Widget
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/show-dashboard-widget.php' );

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
		add_option( 'show-action-hook-points', '1' );
		add_option( 'show-dashboard-widget', '1' );
	}
);

/**
 * jobs when deactivated for action hooks.
 */
register_deactivation_hook(
	__FILE__,
	function() {
		delete_option( 'show-action-hook-points' );
		delete_option( 'show-dashboard-widget' );
	}
);

/**
 * for composer
 */
require_once( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/vendor/autoload.php' );
