<?php
/**
 * Template Name: EA WING · หน้าคู่มือ / เนื้อหายาว
 *
 * ใช้กับ: เปิดบัญชี MT5, ติดตั้งและล็อกอิน MT5, VPS (Windows / Android / iOS) และหน้าเครื่องมือคำนวณ
 * หน้าตา Glass Sky (docs/design.md) · CSS ใน assets/css/guides.css
 * - หน้าคู่มือ (slug อยู่ใน eaw_guide_map() ของ inc/modules/guides.php):
 *   hero แผงกระจก (breadcrumb + kicker + H1 + คำโปรย + ภาพรวมขั้นตอน) → เกริ่นนำ + สิ่งที่ต้องเตรียม
 *   → ขั้นตอน #steps (การ์ดเลขทอง) + การ์ดดาวน์โหลดแอป → เช็กลิสต์ → เนื้อหายาวจากหน้าแก้ไขเพจบนการ์ดขาว (สารบัญ + ตาราง + FAQ)
 *   → คู่มือที่ควรอ่านต่อ #guides → ติดต่อทีมงาน
 *   ขั้นตอน / เช็กลิสต์ / การ์ดดาวน์โหลด / ข้อความติดต่อ แก้ที่ ปรับแต่ง → "คู่มือ · …"
 *   คำอธิบายยาว ตารางแก้ปัญหา และ FAQ แก้ในหน้าแก้ไขเพจ
 * - เพจอื่นที่เลือกเทมเพลตนี้ (เช่น /tools/): hero → เนื้อหาเพจ + สารบัญ → คู่มือที่ควรอ่านต่อ → ติดต่อทีมงาน (ไม่มีหน้าว่าง)
 * - หน้าเอกสาร (about / privacy / terms / data-deletion) ใช้ page.php
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

$eaw_slug  = (string) get_post_field( 'post_name', get_the_ID() );
$eaw_pages = eaw_site_pages();
$eaw_group = isset( $eaw_pages[ $eaw_slug ]['group'] ) ? $eaw_pages[ $eaw_slug ]['group'] : '';
$eaw_p     = function_exists( 'eaw_guide_prefix' ) ? eaw_guide_prefix() : '';

if ( $eaw_p ) {
	$eaw_kicker = eaw_mod( $eaw_p . '_kicker' );
	$eaw_sub    = eaw_mod( $eaw_p . '_sub' );
} else {
	$eaw_kicker = eaw_page_kicker( $eaw_slug );
	$eaw_sub    = has_excerpt() ? get_the_excerpt() : (string) get_post_meta( get_the_ID(), 'eaw_meta_description', true );
}

if ( function_exists( 'eaw_guide_hero' ) ) {
	/* ภาพรวมขั้นตอน (คำตอบสั้น) อยู่ใน hero · .gd-top ด้านล่างจึงไม่พิมพ์ซ้ำ */
	eaw_guide_hero(
		$eaw_kicker,
		get_the_title(),
		eaw_is_placeholder( $eaw_sub ) ? '' : $eaw_sub,
		$eaw_p ? eaw_mod( $eaw_p . '_quick_title' ) : '',
		$eaw_p ? eaw_mod( $eaw_p . '_quick' ) : ''
	);
} else {
	eaw_page_hero( $eaw_kicker, get_the_title(), eaw_is_placeholder( $eaw_sub ) ? '' : $eaw_sub );
}
?>

<main id="main" class="guide-page gd-page<?php echo esc_attr( $eaw_p ? ' gd-page--' . $eaw_p : ' gd-page--' . sanitize_key( $eaw_slug ) ); ?>">

<?php if ( $eaw_p ) : ?>

	<?php
	eaw_guide_top(
		array(
			'intro'       => eaw_mod( $eaw_p . '_intro' ),
			'quick_title' => '',
			'quick'       => '',
			'prep_title'  => eaw_mod( $eaw_p . '_prep_title' ),
			'prep'        => eaw_mod( $eaw_p . '_prep' ),
			'prep_note'   => eaw_mod( $eaw_p . '_prep_note' ),
		)
	);

	eaw_guide_steps( $eaw_p . '_step', in_array( $eaw_p, eaw_guide_dl_prefixes(), true ) ? $eaw_p : '' );

	eaw_guide_check( eaw_mod( $eaw_p . '_check_title' ), eaw_mod( $eaw_p . '_check' ), eaw_mod( $eaw_p . '_check_note' ) );

	eaw_guide_longform();

	eaw_guide_related( $eaw_slug );

	eaw_line_cta( eaw_mod( $eaw_p . '_cta_title' ), eaw_mod( $eaw_p . '_cta_text' ) );
	?>

<?php else : ?>

	<?php
	if ( function_exists( 'eaw_guide_longform' ) ) {
		eaw_guide_longform();
	} else {
		eaw_page_longform( 'section section--flush-top' );
	}

	if ( 'guide' === $eaw_group && function_exists( 'eaw_guide_related' ) ) {
		eaw_guide_related( $eaw_slug );
	}

	if ( 'tools' === $eaw_slug ) {
		eaw_line_cta( eaw_mod( 'gtools_cta_title' ), eaw_mod( 'gtools_cta_text' ) );
	} else {
		eaw_line_cta();
	}
	?>

<?php endif; ?>

</main>

<?php
get_footer();
