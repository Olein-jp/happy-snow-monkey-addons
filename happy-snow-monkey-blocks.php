<?php
/**
 * Plugin Name: HAPPY SNOW MONKEY BLOCKS
 */



function hsmb_scripts() {
	wp_enqueue_script(
		'hsmb-script',
		plugins_url( 'build/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'hsmb_scripts' );

function hsmb_styles() {
	wp_enqueue_style(
		'hsmb-styles',
		plugins_url( 'build/style.css', __FILE__ )
	);
}
add_action( 'enqueue_block_assets', 'hsmb_styles' );