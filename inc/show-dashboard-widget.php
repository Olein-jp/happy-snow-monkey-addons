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
	 * Dashboard setup
	 */
	add_action(
		'wp_dashboard_setup',
		function() {
			wp_add_dashboard_widget(
				'hsma_dasgboard_widget',
				'Snow Monkeyで困ったら…',
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
		?>
		<p>Snow Monkey で困ったら以下の順で対応方法を検討することをお勧めします。</p>
		<ol>
			<li><a href="https://snow-monkey.2inc.org/forums/" target="_blank">Snow Monkey サポートフォーラム</a>でトラブル内容を検索する</li>
			<li>Snow Monkey <a href="https://snow-monkey.2inc.org/product/snow-monkey/" target="_blank">サブスクリプション契約</a>を行い、<a href="https://snow-monkey.2inc.org/forums/" target="_blank">Snow Monkey サポートフォーラム</a>で質問をする</li>
			<li><a href="https://snow-monkey.2inc.org/snow-monkey-expert/" target="_blank">Snow Monkey公認エキスパート</a>に対応を依頼する</li>
		</ol>
		<?php
	}
}
