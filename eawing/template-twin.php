<?php
/**
 * Template Name: EA WING · หน้าสินค้า WING TWIN
 *
 * โครง (Glass Sky): หัวเพจ (ชื่อสินค้า คำอธิบาย ปุ่ม LINE ปุ่มดาวน์โหลด ภาพการ์ดสินค้า)
 *       → แผงการ์ดข้อมูลสินค้า (twin_stat1..8 · หมายเหตุ · คำเตือน)
 *       → เนื้อหายาวจาก editor (inc/content/pages/wing-twin.html · การ์ดขาว + สารบัญ) → แถบติดต่อ
 * ค่าทั้งหมดอยู่ใน Customizer หมวด 31 (inc/modules/twin.php)
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
$eaw_title   = get_the_title();
$eaw_sub     = eaw_mod( 'twin_sub' );
$eaw_note    = eaw_mod( 'twin_note' );
$eaw_actions = eaw_pages_capture(
	'eaw_contact_button',
	array(
		'class' => 'btn btn-fire',
		'pos'   => 'twin-hero',
	)
);
$eaw_dl      = trim( (string) eaw_mod( 'twin_dl_url' ) );
$eaw_dl      = 0 === strpos( $eaw_dl, 'assets/' ) ? get_template_directory_uri() . '/' . $eaw_dl : $eaw_dl;
if ( '' !== $eaw_dl && '' !== trim( (string) eaw_mod( 'twin_dl_label' ) ) ) {
	$eaw_actions .= sprintf(
		'<a class="btn btn-ghost" href="%1$s"%2$s data-go-pos="twin-download">%3$s<span>%4$s</span></a>',
		esc_url( $eaw_dl ),
		preg_match( '/\.(zip|ex5|pdf)([?#]|$)/i', $eaw_dl ) ? ' download' : '',
		eaw_icon( 'download' ),
		esc_html( eaw_mod( 'twin_dl_label' ) )
	);
}
?>

<main id="main" class="pg tests-page twin-page">

	<?php
	eaw_pages_hero(
		array(
			'title'   => $eaw_title,
			'lead'    => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
			'actions' => $eaw_actions,
			'media'   => eaw_pages_hero_media( 'twin', '' ),
		)
	);
	?>

	<section class="pg-sec tests-top">
		<div class="container">
			<div class="glass-panel pg-panel tests-panel">
				<?php eaw_pages_stats( 'twin', 8, 'twin' ); ?>
				<div class="tests-notes<?php echo eaw_pages_has( $eaw_note ) ? '' : ' tests-notes--solo'; ?>">
					<?php if ( eaw_pages_has( $eaw_note ) ) : ?>
						<p class="pg-note tests-note"><span class="tile tile--sky" aria-hidden="true"><?php echo eaw_icon( 'cpu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( $eaw_note ); ?></span></p>
					<?php endif; ?>
					<?php /* คำเตือน · ไม่ใช้ .reveal เพื่อให้เห็นทันทีแม้ JS ไม่ทำงาน */ ?>
					<div class="pg-warn tests-disclaimer">
						<span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'warn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<p><?php echo esc_html( eaw_mod( 'twin_disclaimer' ) ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	eaw_pages_enable_table_cards();
	eaw_pages_longform();
	?>

	<?php eaw_line_cta( eaw_mod( 'twin_cta_title' ), eaw_mod( 'twin_cta_text' ) ); ?>

</main>

<?php
get_footer();
