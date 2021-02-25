<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * When 'show-action-hook-points is checked...
 */
if ( '1' === get_option( 'show-dashboard-widget' ) ) {

	/**
	 * admin enqueue style
	 */
	add_action(
		'admin_enqueue_scripts',
		function() {
			wp_enqueue_style( 'hsma-admin-styles', HAPPY_SNOW_MONKEY_ADDONS_URL . '/build/admin-style.css' );
		}
	);

	/**
	 * Dashboard setup
	 */
	add_action(
		'wp_dashboard_setup',
		function() {
			wp_add_dashboard_widget(
				'hsma_dasgboard_widget',
				__( 'If you have trouble with Snow Monkey...', 'happy-snow-monkey-addons' ),
				'hsma_dashboard_widget'
			);

			global $wp_meta_boxes;

			$hsma_normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

			$hsma_widget_backup = [
				'hsma_dasgboard_widget' => $hsma_normal_dashboard['hsma_dasgboard_widget'],
			];

			unset( $hsma_normal_dashboard['hsma_dasgboard_widget'] );

			$hsma_sorted_dashboard = array_merge( $hsma_widget_backup, $hsma_normal_dashboard );

			$wp_meta_boxes['dashboard']['normal']['core'] = $hsma_sorted_dashboard;
		}
	);

	/**
	 * Widget view
	 */
	function hsma_dashboard_widget() {
		$hsma_active_plugins = get_option( 'active_plugins', [] );
		?>
		<p>
			<?php
			/* translators: %1$s: Snow Monkey Forum URL */
			printf( esc_html__( 'Let\'s search your troubles in %1$s', 'happy-snow-monkey-addons' ), '<a href="https://snow-monkey.2inc.org/forums/" target="_blank">' . __( 'Snow Monkey Support Forum', 'happy-snow-monkey-addons' ) . '</a>' );
			?>
			<br>
			<?php
			/* translators: %1$s: Snow Monkey subscription licenses url %2$s: Snow Monkey Forum URL */
			printf( esc_html__( 'Or, I recommend to buy %1$s for making topics on %2$s', 'happy-snow-monkey-addons' ), '<a href="https://snow-monkey.2inc.org/product/snow-monkey/" target="_blank">' . __( 'subscription licenses', 'happy-snow-monkey-addons' ) . '</a>', __( 'Snow Monkey Support Forum', 'happy-snow-monkey-addons' ) );
			?>
		</p>
		<h3><?php __( 'Please use it to create a topic in the forum. (Be sure to check that it does not contain any information that should not be posted.', 'happy-snow-monkey-addons' ); ?></h3>
		<table>
			<tbody>
				<?php
				include_once( ABSPATH . 'wp-admin/includes/theme-install.php' );
				$hsma_active_theme  = wp_get_theme();
				$hsma_theme_version = $hsma_active_theme->version;
				?>
				<tr>
					<td data-export-label="Name"><?php echo __( 'Snow Monkey version', 'happy-snow-monkey-addons' ); ?></td>
					<td><?php echo esc_html( $hsma_theme_version ); ?></td>
				</tr>
				<?php
				foreach ( $hsma_active_plugins as $hsma_active_plugin ) {
					$hsma_plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $hsma_active_plugin );
					if ( preg_match( '/Snow Monkey/', $hsma_plugin_data['Name'] ) ) {
						$hsma_plugin_name = esc_html( $hsma_plugin_data['Name'] );
						?>
						<tr>
							<td>
								<?php
								/* translators: %1$s: plugin name */
								printf( esc_html__( '%1$s version', 'happy-snow-monkey-addons' ), $hsma_plugin_name );
								?>
							</td>
							<td><?php echo esc_html( $hsma_plugin_data['Version'] ); ?></td>
						</tr>
						<?php
					}
				}
				$hsma_browser = $_SERVER['HTTP_USER_AGENT'];
				?>
				<tr>
					<td><?php echo __( 'Using browser', 'happy-snow-monkey-addons' ); ?></td>
					<td><?php echo $hsma_browser; ?></td>
				</tr>
			<tr>
				<td><?php echo __( 'URL of the site', 'happy-snow-monkey-addons' ); ?></td>
				<td><?php echo esc_url( home_url() ); ?></td>
			</tr>
			</tbody>
		</table>
		<h3><?php echo __( 'We also recommend copying and pasting the following for reference information.', 'happy-snow-monkey-addons' ); ?></h3>
		<table>
			<tbody>
			<?php
			foreach ( $hsma_active_plugins as $hsma_active_plugin ) {
				$hsma_plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $hsma_active_plugin );
				if ( ! preg_match( '/Snow Monkey/', $hsma_plugin_data['Name'] ) ) {
					$hsma_plugin_name = esc_html( $hsma_plugin_data['Name'] );
					?>
					<tr>
						<td><?php echo $hsma_plugin_name; ?></td>
						<td><?php echo esc_html( $hsma_plugin_data['Version'] ); ?></td>
					</tr>
					<?php
				}
			}
			?>
			</tbody>
		</table>
		<h3>
			<?php
			echo __( 'If you still have trouble...', 'happy-snow-monkey-addons' );
			?>
			</h3>
		<p class="hsma-admin-cta">
			<?php
			/* translators: %1$s: Snow Monkey Expert URL */
			printf( esc_html__( 'Talk to %1$s', 'happy-snow-monkey-addons' ), '<a href="https://snow-monkey.2inc.org/snow-monkey-expert/" target="_blank">' . __( 'Olein Design as a Snow Monkey Expert', 'happy-snow-monkey-addons' ) . '</a>' );
			?>
		</p>
		<?php
	}
}
