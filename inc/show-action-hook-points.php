<?php
/**
 * @package happy-snow-monkey-addons
 * @author Olein-jp
 * @license GPL-2.0+
 */

//
// できればループで回して楽したい
//
//$hsma_action_hooks = array(
//	'snow_monkey_prepend_drawer_nav',
//	'snow_monkey_append_drawer_nav',
//	'snow_monkey_prepend_body',
//);
//
//foreach ( $hsma_action_hooks as $hsma_action_hook_name ) {
//	add_action(
//		$hsma_action_hook_name,
//		function() {
//			?>
<!--			<div class="c-hsma-hook-point c-blinking">-->
<!--				<p><a href="--><?php //echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/' . $hsma_action_hook ?><!--">--><?php //echo $hsma_action_hook; ?><!--</a></p>-->
<!--			</div>-->
<!--			--><?php
//		}
//	);
//}

/**
 * snow_monkey_prepend_drawer_nav
 */
add_action(
	'snow_monkey_prepend_drawer_nav',
	function() {
		?>
		<div class="c-hsma-hook-point c-blinking">
			<p><a href="<?php echo HAPPY_SNOW_MONKEY_WEBSITE_URL . '/snow_monkey_append_drawer_nav'; ?>">snow_monkey_prepend_drawer_nav</a></p>
		</div>
		<?php
	}
);