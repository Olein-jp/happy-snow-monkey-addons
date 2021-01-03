<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * import style sheet
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'hsma-output-action-hook-styles',
			plugins_url( '../build/action-hook.css', __FILE__ )
		);
	}
);

/**
 * snow_monkey_prepend_drawer_nav
 */
add_action(
	'snow_monkey_prepend_drawer_nav',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_drawer_nav'; ?>" target="_blank">snow_monkey_prepend_drawer_nav</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_drawer_nav
 */
add_action(
	'snow_monkey_append_drawer_nav',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_drawer_nav'; ?>" target="_blank">snow_monkey_append_drawer_nav</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_body
 */
add_action(
	'snow_monkey_prepend_body',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_body'; ?>" target="_blank">snow_monkey_prepend_body</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_footer
 */
add_action(
	'snow_monkey_prepend_footer',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_footer'; ?>" target="_blank">snow_monkey_prepend_footer</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_footer
 */
add_action(
	'snow_monkey_append_footer',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_footer'; ?>" target="_blank">snow_monkey_append_footer</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_sidebar
 */
add_action(
	'snow_monkey_prepend_sidebar',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_sidebar'; ?>" target="_blank">snow_monkey_prepend_sidebar</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_sidebar
 */
add_action(
	'snow_monkey_append_sidebar',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_sidebar'; ?>" target="_blank">snow_monkey_append_sidebar</a></p>
		</div>
		<?php
	}
);


/**
 * snow_monkey_prepend_main
 */
add_action(
	'snow_monkey_prepend_main',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_main'; ?>" target="_blank">snow_monkey_prepend_main</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_main
 */
add_action(
	'snow_monkey_append_main',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_main'; ?>" target="_blank">snow_monkey_append_main</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_contents
 */
add_action(
	'snow_monkey_prepend_contents',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_contents'; ?>" target="_blank">snow_monkey_prepend_contents</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_contents
 */
add_action(
	'snow_monkey_append_contents',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_contents'; ?>" target="_blank">snow_monkey_append_contents</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_before_contents_inner
 */
add_action(
	'snow_monkey_before_contents_inner',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_before_contents_inner'; ?>" target="_blank">snow_monkey_before_contents_inner</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_after_contents_inner
 */
add_action(
	'snow_monkey_after_contents_inner',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_after_contents_inner'; ?>" target="_blank">snow_monkey_after_contents_inner</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_prepend_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_entry_content'; ?>" target="_blank">snow_monkey_prepend_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_append_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_entry_content'; ?>" target="_blank">snow_monkey_append_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_before_entry_content
 */
add_action(
	'snow_monkey_before_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_before_entry_content'; ?>" target="_blank">snow_monkey_before_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_after_entry_content
 */
add_action(
	'snow_monkey_after_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_after_entry_content'; ?>" target="_blank">snow_monkey_after_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_archive_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_append_archive_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_archive_entry_content'; ?>" target="_blank">snow_monkey_append_archive_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_prepend_archive_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_prepend_archive_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_prepend_archive_entry_content'; ?>" target="_blank">snow_monkey_prepend_archive_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_before_archive_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_before_archive_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_before_archive_entry_content'; ?>" target="_blank">snow_monkey_before_archive_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_append_archive_entry_content
 * @since 10.8.0
 */
add_action(
	'snow_monkey_append_archive_entry_content',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_archive_entry_content'; ?>" target="_blank">snow_monkey_append_archive_entry_content</a></p>
		</div>
		<?php
	}
);

/**
 * snow_monkey_entry_meta_items
 */
add_action(
	'snow_monkey_entry_meta_items',
	function() {
		?>
		<div class="c-btn c-btn--block c-hsma-hook-point">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_entry_meta_items'; ?>" target="_blank">snow_monkey_entry_meta_items</a></p>
		</div>
		<?php
	}
);