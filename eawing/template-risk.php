<?php
/**
 * Template Name: EA WING · หน้า Risk Disclosure
 *
 * โครง (Glass Sky): หัวเพจแผงกระจก + ภาพประกอบ → แผงความเสี่ยง (กล่องคำเตือนทองอ่อน + ภาพประกอบถ้ามี
 *       + การ์ดความเสี่ยง 01 ถึง 06 · id="risk-N") → เนื้อหายาวจาก editor (การ์ดขาว + สารบัญ)
 *       → วันที่ปรับปรุงล่าสุด (ท้ายเนื้อหาทั้งหมด) → แถบติดต่อ
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
$eaw_sub     = eaw_mod( 'riskpage_sub' );
$eaw_image   = trim( (string) eaw_mod( 'riskpage_image' ) );
$eaw_caption = trim( (string) eaw_mod( 'riskpage_image_caption' ) );
$eaw_updated = trim( (string) eaw_mod( 'riskpage_updated' ) );
?>

<main id="main" class="pg risk-page">

<?php
eaw_pages_hero(
	array(
		'kicker' => eaw_mod( 'riskpage_kicker' ),
		'title'  => $eaw_title ? $eaw_title : eaw_mod( 'riskpage_kicker' ),
		'grad'   => eaw_mod( 'riskpage_hero_grad' ),
		'lead'   => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
		'media'  => eaw_pages_hero_media( 'riskpage', 'risk' ),
	)
);
?>

<section class="pg-sec riskdoc-section">
	<div class="container">
		<div class="glass-panel pg-panel riskdoc-panel">

			<?php /* คำเตือนเกริ่นนำ · ไม่ใช้ .reveal เพื่อให้เห็นทันทีแม้ JS ไม่ทำงาน */ ?>
			<div class="pg-warn riskdoc-intro">
				<span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'warn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<p><?php echo eaw_text( eaw_mod( 'riskpage_intro' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
			</div>

			<?php if ( '' !== $eaw_image ) : ?>
				<figure class="riskdoc-figure media-frame">
					<?php
					echo eaw_media_open( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside
						$eaw_image,
						eaw_media_picture( '', $eaw_image, $eaw_caption, 1280, 720 ),
						$eaw_caption
					);
					?>
					<?php if ( '' !== $eaw_caption ) : ?>
						<figcaption class="media-cap"><?php echo esc_html( $eaw_caption ); ?></figcaption>
					<?php endif; ?>
				</figure>
			<?php endif; ?>

			<div class="riskdoc">
				<?php
				$eaw_n = 0;
				for ( $i = 1; $i <= 6; $i++ ) :
					$b_title = trim( (string) eaw_mod( 'rp_block' . $i . '_title' ) );
					$b_text  = trim( (string) eaw_mod( 'rp_block' . $i . '_text' ) );
					if ( '' === $b_title && '' === $b_text ) {
						continue;
					}
					$eaw_n++;
					?>
					<article class="riskdoc-block" id="<?php echo esc_attr( 'risk-' . $eaw_n ); ?>">
						<div class="riskdoc-top">
							<span class="riskdoc-num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $eaw_n ) ); ?></span>
							<span class="riskdoc-ic" aria-hidden="true"><?php echo eaw_icon( 'warn', 'icon icon-sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						</div>
						<?php if ( '' !== $b_title ) : ?>
							<h2><?php echo eaw_text( $b_title ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h2>
						<?php endif; ?>
						<p><?php echo nl2br( esc_html( $b_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
					</article>
				<?php endfor; ?>
			</div>

		</div>
	</div>
</section>

<?php
eaw_pages_enable_table_cards();
eaw_pages_longform();
?>

<?php if ( ! eaw_pages_date_pending( $eaw_updated ) ) : ?>
	<div class="pg-sec riskdoc-updated-wrap">
		<div class="container">
			<p class="pg-updated riskdoc-updated"><?php echo eaw_icon( 'clock', 'icon icon-sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $eaw_updated ); ?></span></p>
		</div>
	</div>
<?php endif; ?>

<?php eaw_line_cta( eaw_mod( 'riskpage_cta_title' ), eaw_mod( 'riskpage_cta_text' ) ); ?>

</main>

<?php
get_footer();
