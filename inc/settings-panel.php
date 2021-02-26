<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * Add admin menu
 */
add_action( 'admin_menu', 'hsma_admin_menu' );
/**
 * Add option page
 */
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
/**
 * Setting sections
 */
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
		'happy-snow-monkey-addons-show-dashboard-widget',
		__( 'Show dashboard widget', 'happy-snow-monkey-addons' ),
		'hsma_show_dashboard_widget_section_desc',
		'happy-snow-monkey-addons'
	);

	/**
	 * section description / Show action hook points
	 */
	function hsma_show_action_hook_points_section_desc() {
		?>
		<p><?php esc_html_e( 'Please check if you want to show action hook points', 'happy-snow-monkey-addons' ); ?></p>
		<?php
	}

	/**
	 * section description / Show dashboard widget
	 */
	function hsma_show_dashboard_widget_section_desc() {
		?>
		<p><?php esc_html_e( 'Please check if you want to show HAPPY SNOW MONKEY Addons dashboard widget', 'happy-snow-monkey-addons' ); ?></p>
		<?php
	}

	/**
	 * Register settings : action hook points
	 */
	register_setting( 'happy-snow-monkey-addons', 'show-action-hook-points' );

	/**
	 * Register settings : dashboard widget
	 */
	register_setting( 'happy-snow-monkey-addons', 'show-dashboard-widget' );

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
	 * Show dashboard widget
	 */
	add_settings_field(
		'show-dashboard-widget',
		__( 'Show', 'happy-snow-monkey-addons' ),
		function () {
			?>
			<input type="checkbox" name="show-dashboard-widget" value="1" <?php checked( 1, get_option( 'show-dashboard-widget' ) ); ?>>
			<?php
		},
		'happy-snow-monkey-addons',
		'happy-snow-monkey-addons-show-dashboard-widget'
	);

}
