<?php
/**
 * Plugin Name: HAPPY SNOW MONKEY BLOCKS
 * Description: You can added extending styles for Snow Monkey Blocks.
 * Version: 0.0.1
 * Tested up to: 5.6
 * Requires at least: 5.6
 * Requires PHP: 5.6
 * Author: Olein-jp
 * Author URI: https://olein-design.com
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: happy-snow-monkey-blocks
 *
 * @package happy-snow-monkey-blocks
 * @author inc2734
 * @license GPL-2.0+
 */
function hsmb_styles() {
	wp_enqueue_style(
		'hsmb-styles',
		plugins_url( 'build/style.css', __FILE__ )
	);
}
add_action( 'enqueue_block_assets', 'hsmb_styles' );


define( 'HAPPY_SNOW_MONKEY_BLOCKS_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'HAPPY_SNOW_MONKEY_BLOCKS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class Bootstrap {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, '_plugins_loaded' ] );
	}

	/**
	 * Plugins loaded.
	 */
	public function _plugins_loaded() {
//		load_plugin_textdomain( 'happy-snow-monkey-blocks', false, basename( __DIR__ ) . '/languages' );

//		add_action( 'init', [ $this, '_activate_autoupdate' ] );

		$theme = wp_get_theme( get_template() );
		if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_no_snow_monkey' ] );
			return;
		}

		if ( ! version_compare( $theme->get( 'Version' ), '11.1.0', '>=' ) ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_invalid_snow_monkey_version' ] );
			return;
		}

		add_action( 'admin_menu', [ $this, '_admin_menu' ] );
		add_action( 'admin_init', [ $this, '_admin_init' ] );

		$this->_disable();
	}

	/**
	 * Admin notice for no Snow Monkey
	 *
	 * @return void
	 */
	public function _admin_notice_no_snow_monkey() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[HAPPY SNOW MONKEY BLOCKS] Needs the Snow Monkey.', 'happy-snow-monkey-blocks' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Admin notice for invalid Snow Monkey version
	 *
	 * @return void
	 */
	public function _admin_notice_invalid_snow_monkey_version() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php
				echo sprintf(
				// translators: %1$s: version
					esc_html__( '[HAPPY SNOW MONKEY BLOCKS] Needs the Snow Monkey %1$s or more.', 'happy-snow-monkey-blocks' ),
					'v11.1.0'
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Add admin menu.
	 */
	public function _admin_menu() {
		add_options_page(
			__( 'HAPPY SNOW MONKEY BLOCKS', 'happy-snow-monkey-blocks' ),
			__( 'HAPPY SNOW MONKEY BLOCKS', 'happy-snow-monkey-blocks' ),
			'manage_options',
			'happy-snow-monkey-blocks',
			function() {
				?>
				<div class="wrap">
					<h1><?php esc_html_e( 'HAPPY SNOW MONKEY BLOCKS', 'happy-snow-monkey-blocks' ); ?></h1>
					<p>
						<?php esc_html_e( 'Suspended setting items may need to be re-setting when re-enabled.', 'happy-snow-monkey-blocks' ); ?>
					</p>
					<form method="post" action="options.php">
						<?php
						settings_fields( 'happy-snow-monkey-blocks' );
						do_settings_sections( 'happy-snow-monkey-blocks' );
						submit_button();
						?>
					</form>
				</div>
				<?php
			}
		);
	}

	/**
	 * Register setting.
	 */
	public function _admin_init() {
		register_setting(
			'happy-snow-monkey-blocks',
			'happy-snow-monkey-blocks',
			function( $option ) {
				$default_option = [
					'like-me-box--left-image'         => false,
				];

				$new_option = [];
				foreach ( $default_option as $key => $value ) {
					$new_option[ $key ] = ! empty( $option[ $key ] ) ? 1 : $value;
				}

				return $new_option;
			}
		);

		add_settings_section(
			'happy-snow-monkey-blocks-disable',
			__( 'Settings', 'happy-snow-monkey-blocks' ),
			function() {
			},
			'happy-snow-monkey-blocks'
		);

		add_settings_field(
			'like-me-box--left-image',
			__( '[Like me box]Left image', 'happy-snow-monkey-blocks' ),
			function() {
				?>
				<input type="checkbox" name="happy-snow-monkey-blocks[like-me-box--left-image]" value="1" <?php checked( 1, get_option( 'like-me-box--left-image' ) ); ?>>
				<?php
			},
			'happy-snow-monkey-blocks',
			'happy-snow-monkey-blocks-disable'
		);
		
	}

	/**
	 * Main processes.
	 */
	public function _disable() {
		if ( 0 === get_option( 'like-me-box--left-image' ) ) {
			add_action( 'enqueue_block_editor_assets', function(){
				wp_enqueue_script(
					'hsmb-like-me-box--left-image-js',
					plugins_url( 'build/left-image/index.js', __FILE__ ),
					array( 'wp-blocks' )
				);
			});
		}

	}

	/**
	 * Return option.
	 *
	 * @param string $key The option key.
	 * @return mixed
	 */
//	protected function _get_option( $key ) {
//		$option = get_option( 'happy-snow-monkey-blocks' );
//		return isset( $option[ $key ] ) ? (int) $option[ $key ] : false;
//	}

	/**
	 * Activate auto update using GitHub
	 *
	 * @return void
	 */
//	public function _activate_autoupdate() {
//		new Updater(
//			plugin_basename( __FILE__ ),
//			'inc2734',
//			'happy-snow-monkey-blocks',
//			[
//				'homepage' => 'https://snow-monkey.2inc.org',
//			]
//		);
//	}
}

//require_once( SNOW_MONKEY_DIET_PATH . '/vendor/autoload.php' );
new Bootstrap();