<?php
/**
 * Template Name: EA WING · หน้า Forward Test
 *
 * โครง (Glass Sky): หัวเพจแผงกระจก + ภาพประกอบ → แผงสรุปผล/สถานะ + ลิงก์ผลที่ตรวจสอบได้ + ภาพประกอบวิธีอ่านผล
 *       + หมายเหตุ + คำเตือน → เนื้อหายาวจาก editor (การ์ดขาว + สารบัญ) → แถบติดต่อ
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
$eaw_sub   = eaw_mod( 'forward_sub' );
?>

<main id="main" class="pg tests-page tests-page--forward">

	<?php
	eaw_pages_hero(
		array(
			'kicker' => eaw_mod( 'forward_kicker' ),
			'title'  => $eaw_title ? $eaw_title : eaw_mod( 'forward_kicker' ),
			'grad'   => eaw_mod( 'forward_hero_grad' ),
			'lead'   => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
			'media'  => eaw_pages_hero_media( 'forward', 'forward' ),
		)
	);
	?>

	<?php eaw_pages_tests_top( 'forward' ); ?>

	<?php
	eaw_pages_enable_table_cards();
	eaw_pages_longform();
	?>

	<?php eaw_line_cta( eaw_mod( 'forward_cta_title' ), eaw_mod( 'forward_cta_text' ) ); ?>

</main>

<?php
get_footer();
