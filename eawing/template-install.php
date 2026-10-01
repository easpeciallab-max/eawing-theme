<?php
/**
 * Template Name: EA WING · หน้า How to Install
 *
 * หน้าตาเดียวกับหน้าคู่มือ (Glass Sky · ส่วนประกอบจาก inc/modules/guides.php · CSS ใน guides.css + pages.css):
 * หัวเพจแผงกระจก (breadcrumb + kicker + H1 + คำโปรย + ภาพรวมขั้นตอน) → เกริ่นนำ + สิ่งที่ต้องเตรียม
 * → 6 ขั้นตอนติดตั้ง (การ์ดเลขทอง | ภาพ) → เช็กว่า EA พร้อมทำงาน → เนื้อหายาวจากหน้าแก้ไขเพจบนการ์ดขาว
 * (สารบัญ + ตารางแก้ปัญหา + FAQ) → คู่มือที่ควรอ่านต่อ → ติดต่อทีมงาน
 * ข้อความและช่องรูปของแต่ละขั้นแก้ที่ ปรับแต่ง → 22) หน้า How to Install
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
$eaw_title  = get_the_title();
$eaw_kicker = eaw_mod( 'inst_kicker' );
$eaw_sub    = eaw_mod( 'install_sub' );
$eaw_hero   = function_exists( 'eaw_guide_hero' );

if ( $eaw_hero ) {
	/* ภาพรวมขั้นตอนอยู่ใน hero · .gd-top ด้านล่างจึงไม่พิมพ์ซ้ำ */
	eaw_guide_hero(
		$eaw_kicker,
		$eaw_title ? $eaw_title : $eaw_kicker,
		eaw_is_placeholder( $eaw_sub ) ? '' : $eaw_sub,
		eaw_mod( 'inst_quick_title' ),
		eaw_mod( 'inst_quick' )
	);
} else {
	eaw_page_hero( $eaw_kicker, $eaw_title ? $eaw_title : $eaw_kicker, eaw_is_placeholder( $eaw_sub ) ? '' : $eaw_sub );
}
?>

<main id="main" class="guide-page gd-page gd-page--install">

<?php
eaw_guide_top(
	array(
		'intro'       => eaw_mod( 'install_intro' ),
		'quick_title' => $eaw_hero ? '' : eaw_mod( 'inst_quick_title' ),
		'quick'       => $eaw_hero ? '' : eaw_mod( 'inst_quick' ),
		'prep_title'  => eaw_mod( 'inst_req_title' ),
		'prep'        => eaw_mod( 'install_req' ),
		'prep_note'   => eaw_mod( 'inst_req_note' ),
	)
);

eaw_guide_steps( 'inst_step', '', eaw_mod( 'install_note' ) );

eaw_guide_check( eaw_mod( 'inst_check_title' ), eaw_mod( 'inst_check' ), eaw_mod( 'inst_check_note' ) );

eaw_guide_longform();

eaw_guide_related( 'how-to-install' );

eaw_line_cta( eaw_mod( 'inst_cta_title' ), eaw_mod( 'inst_cta_text' ) );
?>

</main>

<?php
get_footer();
