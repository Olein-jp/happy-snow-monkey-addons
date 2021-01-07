<?php
/**
 * Plugin Name: HAPPY SNOW MONKEY Add-ons
 * Description: You can added add-ons for Snow Monkey, Snow Monkey Blocks, Snow Monkey Editors.
 * Version: 0.0.1
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

function hsma_styles() {
	wp_enqueue_style(
		'hsma-styles',
		HAPPY_SNOW_MONKEY_ADDONS_URL . '/build/style.css',
		[],
		filemtime( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/build/style.css' )
	);
}
add_action( 'enqueue_block_assets', 'hsma_styles' );

function plugins_loaded() {

	$theme = wp_get_theme( get_template() );
	/**
	 * Check Snow Monkey activated
	 */
	if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
		add_action( 'admin_notices', 'hsma_admin_notice_no_snow_monkey' );
	}

	/**
	 * Check Snow Monkey version
	 */
	if ( ! version_compare( $theme->get( 'Version' ), '12.1.0', '>=' ) ) {
		add_action( 'admin_notices', 'hsma_admin_notice_invalid_snow_monkey_version' );
	}

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	/**
	 * Check Snow Monkey Blocks activated
	 */
	if ( ! is_plugin_active( 'snow-monkey-blocks/snow-monkey-blocks.php' ) ) {
		add_action( 'admin_notices', 'hsma_admin_notice_no_snow_monkey_blocks' );
	}

	/**
	 * Check Snow Monkey Editor activated
	 */
	if ( ! is_plugin_active( 'snow-monkey-editor/snow-monkey-editor.php' ) ) {
		add_action( 'admin_notices', 'hsma_admin_notice_no_snow_monkey_editor' );
	}

	/**
	 * Check version of Snow Monkey Blocks & Editor
	 */
	$active_plugins = get_option( 'active_plugins', array() );
	foreach ( $active_plugins as $plugin ) {
		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
		// Snow Monkey Blocks is activated
		if ( $plugin_data['TextDomain'] === 'snow-monkey-blocks' && ! version_compare( $plugin_data['Version'], '10.0.0', '>=' ) ) {
			add_action( 'admin_notices', 'hsma_admin_notice_invalid_snow_monkey_blocks_version' );
		}
		// Snow Monkey Editor is activated
		if ( $plugin_data['TextDomain'] === 'snow-monkey-editor' && ! version_compare( $plugin_data['Version'], '4.0.0', '>=' ) ) {
			add_action( 'admin_notices', 'hsma_admin_notice_invalid_snow_monkey_editor_version' );
		}
	}

	/**
	 * Admin Notice : No Snow Monkey
	 */
	function hsma_admin_notice_no_snow_monkey() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey.', 'happy-snow-monkey-addons' ); ?>
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
					esc_html__( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey %1$s or more.', 'happy-snow-monkey-addons' ),
					'v12.1.0'
				);
				?>
			</p>
		</div>
		<?php
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
	 * Admin Notice : No Snow Monkey Editor
	 */
	function hsma_admin_notice_no_snow_monkey_editor() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Editor.', 'happy-snow-monkey-addons' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Admin Notice : Invalid Snow Monkey Editor version
	 */
	function hsma_admin_notice_invalid_snow_monkey_editor_version() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php
				echo sprintf(
				// translators: %1$s: version
					esc_html__( '[HAPPY SNOW MONKEY Add-ons] Needs the Snow Monkey Editor %1$s or more.', 'happy-snow-monkey-addons' ),
					'v5.0.0'
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * add admin menu
	 */
	add_action( 'admin_menu', 'hsma_admin_menu' );
	function hsma_admin_menu() {
		add_options_page(
			__( 'HAPPY SNOW MONKEY Add-ons', 'happy-snow-monkey-addons' ),
			__( 'HAPPY SNOW MONKEY Add-ons', 'happy-snow-monkey-addons' ),
			'manage_options',
			'happy-snow-monkey-addons',
			function() {
				?>
				<div class="wrap">
					<h1><?php esc_html_e( 'HAPPY SNOW MONKEY Add-ons', 'happy-snow-monkey-addons' ); ?></h1>
					<form method="post" action="options.php">
						<?php
						settings_fields( 'happy-snow-monkey-addons' );
						do_settings_sections( 'happy-snow-monkey-addons' );
						submit_button();
						?>
					</form>
				</div>
				<?php
			}
		);
	}

	/**
	 * Setting sections & Fields
	 */
	add_action( 'admin_init', 'hsma_admin_init' );
	function hsma_admin_init() {

		/**
		 * Setting sections
		 */
		add_settings_section(
			'happy-snow-monkey-addons-show-action-hook-points',
			__( 'Show action hook points', 'happy-snow-monkey-addons' ),
			'hsma_show_action_hook_points_section_desc',
			'happy-snow-monkey-addons'
		);

		add_settings_section(
			'happy-snow-monkey-addons-extending-style',
			__( 'Extending styles', 'happy-snow-monkey-addons' ),
			'hsma_extending_style_section_desc',
			'happy-snow-monkey-addons'
		);

		/**
		 * section description
		 */
		function hsma_show_action_hook_points_section_desc() {
			?>
			<p><?php esc_html_e( 'Please check if you want to show action hook points.', 'happy-snow-monkey-addons' ); ?></p>
			<?php
		}

		function hsma_extending_style_section_desc() {
			?>
			<p><?php esc_html_e( 'Please check the items you do not want to use.', 'happy-snow-monkey-addons' ); ?></p>
			<?php
		}

		/**
		 * Register settings
		 */
		// Show action hook points
		register_setting( 'happy-snow-monkey-addons', 'show-action-hook-points' );

		// Extending styles
		register_setting( 'happy-snow-monkey-addons', 'lmb__right-image' );
		register_setting( 'happy-snow-monkey-addons', 'rp__undisplayed-author-name' );
		register_setting( 'happy-snow-monkey-addons', 'rp__undisplayed-date' );

		/**
		 * Setting fields
		 *
		 * Show action hook points
		 */
		add_settings_field(
			'show-action-hook-points',
			__( 'Show', 'happy-snow-monkey-addons' ),
			function () {
				?>
				<input type="checkbox" name="show-action-hook-points" value="1" <?php checked( 1, get_option( 'show-action-hook-points' ) ); ?>>
				<?php
			},
			'happy-snow-monkey-addons',
			'happy-snow-monkey-addons-show-action-hook-points'
		);

		/**
		 * Extending Styles
		 *
		 * [Like me box]Right image
		 */
		add_settings_field(
			'lmb__right-image',
			__( '[Like me box]Right image', 'happy-snow-monkey-addons' ),
			function () {
				?>
				<input type="checkbox" name="lmb__right-image" value="1" <?php checked( 1, get_option( 'lmb__right-image' ) ); ?>>
				<?php
			},
			'happy-snow-monkey-addons',
			'happy-snow-monkey-addons-extending-style'
		);

		/**
		 * [Recentry posts]Undisplayed author name
		 */
		add_settings_field(
			'rp__undisplayed-author-name',
			__( '[Recentry posts]Undisplayed author name', 'happy-snow-monkey-addons' ),
			function () {
				?>
				<input type="checkbox" name="rp__undisplayed-author-name" value="1" <?php checked( 1, get_option( 'rp__undisplayed-author-name' ) ); ?>>
				<?php
			},
			'happy-snow-monkey-addons',
			'happy-snow-monkey-addons-extending-style'
		);

		/**
		 * [Recentry posts]Undisplayed date
		 */
		add_settings_field(
			'rp__undisplayed-date',
			__( '[Recentry posts]Undisplayed date', 'happy-snow-monkey-addons' ),
			function () {
				?>
				<input type="checkbox" name="rp__undisplayed-date" value="1" <?php checked( 1, get_option( 'rp__undisplayed-date' ) ); ?>>
				<?php
			},
			'happy-snow-monkey-addons',
			'happy-snow-monkey-addons-extending-style'
		);

	}

	/**
	 * including files
	 */
	include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/extending-blocks.php' );

	if ( '1' === get_option( 'show-action-hook-points' ) ) {
		include( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/inc/show-action-hook-points.php' );
	}

	/**
	 * Updater
	 *
	 * @link https://github.com/inc2734/wp-github-plugin-updater
	 */
	$updater = new Inc2734\WP_GitHub_Plugin_Updater\Bootstrap(
		plugin_basename( __FILE__ ),
		'Olein-jp',
		'happy-snow-monkey-addons'
	);

}
add_action( 'plugins_loaded', 'plugins_loaded' );

require_once( HAPPY_SNOW_MONKEY_ADDONS_PATH . '/vendor/autoload.php' );
