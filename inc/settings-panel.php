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
		'happy-snow-monkey-addons-block-style',
		__( 'Block styles', 'happy-snow-monkey-addons' ),
		'hsma_block_style_section_desc',
		'happy-snow-monkey-addons'
	);

	/**
	 * section description / Show action hook points
	 */
	function hsma_show_action_hook_points_section_desc() {
		?>
		<p><?php esc_html_e( 'Please check if you want to show action hook points.', 'happy-snow-monkey-addons' ); ?></p>
		<?php
	}

	/**
	 * section description / Extending styles
	 */
	function hsma_block_style_section_desc() {
		?>
		<p><?php esc_html_e( 'Please check the styles you want to use.', 'happy-snow-monkey-addons' ); ?></p>
		<?php
	}

	/**
	 * Register settings : action hook points
	 */
	register_setting( 'happy-snow-monkey-addons', 'show-action-hook-points' );

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

	/*******
	 * Register settings : Block styles
	 */
	foreach ( HAPPY_SNOW_MONKEY_ADDONS_BLOCK_STYLES as list( , $block_style_name, $block_style_slug ) ) {
		register_setting( 'happy-snow-monkey-addons', $block_style_slug );
		add_settings_field(
			$block_style_slug,
			esc_html( $block_style_name, 'happy-snow-monkey-addons' ),
			function () use ( $block_style_slug ) {
				?>
				<input type="checkbox" name="<?php echo esc_html( $block_style_slug ); ?>" value="1" <?php checked( 1, get_option( $block_style_slug ) ); ?>>
				<?php
			},
			'happy-snow-monkey-addons',
			'happy-snow-monkey-addons-block-style'
		);
	}

}
