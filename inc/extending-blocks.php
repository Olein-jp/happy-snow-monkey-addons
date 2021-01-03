<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */
/**
 * Enqueue styles
 */
add_action( 'enqueue_block_assets', function() {
	wp_enqueue_style(
		'hsma-extending-styles',
		plugins_url( '../build/style.css', __FILE__ )
	);
} );

/**
 * Extending styles : [Like me box]
 * 
 * Right image
 * 
 */
function hsma_extending_style__lmb__right_image() {
	wp_enqueue_script(
		'hsma--lmb--right-image',
		plugins_url( '../build/like-me-box/right-image/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}

if ( '' === get_option( 'lmb__right-image' ) ) {
	add_action( 'enqueue_block_editor_assets', 'hsma_extending_style__lmb__right_image' );
}

/**
 * Extending styles : [recent posts]
 * 
 * Undisplayed author name
 * 
 */
function hsma_extending_style__rp__undisplayed_author_name() {
	wp_enqueue_script(
		'hsma--rp--undisplayed-author-name',
		plugins_url( '../build/recent-posts/undisplayed-author-name/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'hsma_extending_style__rp__undisplayed_author_name');

/**
 * Undisplayed date
 */
function hsma_extending_style__rp__undisplayed_date() {
	wp_enqueue_script(
		'hsma--rp--undisplayed-date',
		plugins_url( '../build/recent-posts/undisplayed-date/index.js', __FILE__ ),
		array( 'wp-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'hsma_extending_style__rp__undisplayed_date');