<?php
/**
 * Template Name: EA WING · หน้า Backtest
 *
 * โครง (Glass Sky): หัวเพจแผงกระจก + ภาพประกอบ → แผงสรุปผล/สถานะ + ภาพประกอบวิธีทดสอบ + หมายเหตุ + คำเตือน
 *       → เนื้อหายาวจาก editor (การ์ดขาว + สารบัญ) → แถบติดต่อ
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( have_posts() ) {
	the_post();
}
$eaw_title = get_the_title();
$eaw_sub   = eaw_mod( 'backtest_sub' );
?>

<main id="main" class="pg tests-page tests-page--backtest">

	<?php
	eaw_pages_hero(
		array(
			'kicker' => eaw_mod( 'backtest_kicker' ),
			'title'  => $eaw_title ? $eaw_title : eaw_mod( 'backtest_kicker' ),
			'grad'   => eaw_mod( 'backtest_hero_grad' ),
			'lead'   => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
			'media'  => eaw_pages_hero_media( 'backtest', 'backtest' ),
		)
	);
	?>

	<?php eaw_pages_tests_top( 'backtest' ); ?>

	<?php
	eaw_pages_enable_table_cards();
	eaw_pages_longform();
	?>

	<?php eaw_line_cta( eaw_mod( 'backtest_cta_title' ), eaw_mod( 'backtest_cta_text' ) ); ?>

</main>

<?php
get_footer();
