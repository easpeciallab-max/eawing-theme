<?php
/**
 * Template Name: EA WING · หน้า Pricing
 *
 * โครง (Glass Sky):
 * หัวเพจแผงกระจก (ปุ่ม LINE + เลื่อนไปตารางเทียบ) → การ์ดแพ็กเกจกระจก 3 ใบ (ใบแนะนำมีเส้นทอง + ป้าย) + หมายเหตุ
 * → ตารางเปรียบเทียบ (หัวตารางกรมท่า · คอลัมน์แพ็กเกจแนะนำเน้นสีทองอ่อน) → สิทธิ์ใช้งาน/VPS → ขั้นตอนสั่งซื้อ
 * → เนื้อหายาวจาก editor (การ์ดขาว + สารบัญ) → แถบติดต่อ
 * โหมด "ติดต่อสอบถาม" (ค่าเริ่มต้น): การ์ดไม่แสดงราคา ปุ่มทุกใบเปิด LINE พร้อม data-line-pkg = ชื่อแพ็กเกจ
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
$eaw_title    = get_the_title();
$eaw_sub      = eaw_mod( 'pricing_sub' );
$eaw_mode     = eaw_mod( 'pricing_mode' );
$eaw_has_line = eaw_has_line_url();
$eaw_rows     = eaw_lines( eaw_mod( 'compare_rows' ) );
$eaw_show_cmp = count( $eaw_rows ) >= 2;

/* ปุ่มบนหัวเพจ: ติดต่อทีมงาน (ทอง) + เลื่อนไปตารางเปรียบเทียบ (กระจก) */
$eaw_actions = eaw_pages_capture(
	'eaw_contact_button',
	array(
		'text'  => eaw_mod( 'pricing_order_btn_text' ),
		'class' => 'btn btn-fire',
		'pos'   => 'pricing-hero',
	)
);
$eaw_jump = trim( (string) eaw_mod( 'pricing_hero_jump_label' ) );
if ( '' !== $eaw_jump && $eaw_show_cmp ) {
	$eaw_actions .= '<a class="btn btn-ghost" href="#compare"><span>' . esc_html( $eaw_jump ) . '</span>' . eaw_icon( 'arrow', 'icon icon-sm pg-ic-down' ) . '</a>';
}

/* ชื่อแพ็กเกจที่ติ๊ก "แนะนำ" (ใช้เน้นคอลัมน์ในตารางเปรียบเทียบ) */
$eaw_featured_names = array();
for ( $i = 1; $i <= 3; $i++ ) {
	if ( eaw_mod( 'pkg' . $i . '_featured' ) && '' !== trim( (string) eaw_mod( 'pkg' . $i . '_name' ) ) ) {
		$eaw_featured_names[] = trim( (string) eaw_mod( 'pkg' . $i . '_name' ) );
	}
}
?>

<main id="main" class="pg pricing-page">

<?php
eaw_pages_hero(
	array(
		'kicker'  => eaw_mod( 'pricing_page_kicker' ),
		'title'   => $eaw_title ? $eaw_title : eaw_mod( 'pricing_title' ),
		'grad'    => eaw_mod( 'pricing_hero_grad' ),
		'lead'    => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
		'actions' => $eaw_actions,
		'media'   => eaw_pages_hero_media( 'pricing', 'pricing' ),
	)
);
?>

<?php /* การ์ดแพ็กเกจ (ปิดได้ที่ ปรับแต่ง → 10) แพ็กเกจราคา → แสดงส่วนนี้) */ ?>
<?php if ( eaw_mod( 'show_pricing' ) ) : ?>
<section class="pg-sec pricing-packages" id="packages">
	<div class="container">
		<div class="glass-panel pg-panel">
			<?php eaw_pages_sec_head( eaw_mod( 'pricing_kicker' ), eaw_mod( 'pricing_title' ), eaw_mod( 'pricing_subtitle' ), 'pg-head--center' ); ?>

			<div class="plan-grid">
				<?php
				for ( $i = 1; $i <= 3; $i++ ) :
					$k_name = trim( (string) eaw_mod( 'pkg' . $i . '_name' ) );
					if ( '' === $k_name ) {
						continue;
					}
					$k_featured = (bool) eaw_mod( 'pkg' . $i . '_featured' );
					$k_price    = eaw_mod( 'pkg' . $i . '_price' );
					$k_tag      = eaw_mod( 'pkg' . $i . '_tag' );
					$k_flag     = $k_featured ? trim( (string) eaw_mod( 'pricing_flag_label' ) ) : '';
					?>
					<article class="plan-card reveal<?php echo $k_featured ? ' is-featured' : ''; ?>">
						<?php if ( '' !== $k_flag ) : ?>
							<span class="plan-flag"><?php echo esc_html( $k_flag ); ?></span>
						<?php endif; ?>
						<h3 class="plan-name"><?php echo esc_html( $k_name ); ?></h3>
						<?php if ( eaw_pages_has( $k_tag ) ) : ?>
							<p class="plan-tag"><?php echo eaw_text( $k_tag ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
						<?php endif; ?>
						<?php if ( 'price' === $eaw_mode && eaw_pages_price_ready( $k_price ) ) : ?>
							<div class="plan-price">
								<strong><?php echo esc_html( $k_price ); ?></strong>
								<span><?php echo esc_html( eaw_mod( 'pkg' . $i . '_period' ) ); ?></span>
							</div>
						<?php else : ?>
							<div class="plan-price plan-price--contact">
								<strong><?php echo esc_html( eaw_mod( 'pricing_contact_label' ) ); ?></strong>
								<?php if ( $eaw_has_line && eaw_mod( 'pricing_contact_via' ) ) : ?>
									<span><?php echo esc_html( eaw_mod( 'pricing_contact_via' ) ); ?></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<ul class="plan-feats">
							<?php foreach ( eaw_lines( eaw_mod( 'pkg' . $i . '_features' ) ) as $eaw_item ) : ?>
								<li><span class="plan-check" aria-hidden="true"><?php echo eaw_icon( 'check', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( $eaw_item ); ?></span></li>
							<?php endforeach; ?>
						</ul>
						<?php eaw_pages_package_button( $k_name, $k_featured ); ?>
					</article>
				<?php endfor; ?>
			</div>

			<?php if ( eaw_pages_has( eaw_mod( 'pricing_note' ) ) ) : ?>
				<p class="pg-note pricing-note"><span class="tile tile--sky" aria-hidden="true"><?php echo eaw_icon( 'tag' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( eaw_mod( 'pricing_note' ) ); ?></span></p>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php /* ตารางเปรียบเทียบ · จอแคบเรียงเป็นการ์ดทีละหัวข้อ */ ?>
<?php
if ( $eaw_show_cmp ) :
	$eaw_table = array();
	foreach ( $eaw_rows as $eaw_row ) {
		$eaw_table[] = array_map( 'trim', explode( '|', $eaw_row ) );
	}
	$eaw_head     = array_shift( $eaw_table );
	$eaw_feat_col = array();
	foreach ( $eaw_head as $idx => $eaw_cell ) {
		if ( $idx > 0 && in_array( $eaw_cell, $eaw_featured_names, true ) ) {
			$eaw_feat_col[] = $idx;
		}
	}
	?>
	<section class="pg-sec compare-section" id="compare">
		<div class="container">
			<div class="glass-panel pg-panel">
				<?php eaw_pages_sec_head( eaw_mod( 'compare_kicker' ), eaw_mod( 'compare_title' ) ); ?>
				<div class="cmp-wrap reveal">
					<table class="cmp-table">
						<thead>
							<tr>
								<?php foreach ( $eaw_head as $idx => $eaw_cell ) : ?>
									<th scope="col"<?php echo 0 === $idx ? ' class="cmp-rowhead"' : ( in_array( $idx, $eaw_feat_col, true ) ? ' class="is-featured"' : '' ); ?>><?php echo esc_html( $eaw_cell ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $eaw_table as $eaw_trow ) : ?>
								<tr>
									<?php
									foreach ( $eaw_trow as $idx => $eaw_cell ) :
										$eaw_yes = '✓' === $eaw_cell;
										$eaw_no  = '✗' === $eaw_cell || 'x' === strtolower( $eaw_cell );
										$eaw_lbl = isset( $eaw_head[ $idx ] ) ? $eaw_head[ $idx ] : '';
										if ( 0 === $idx ) :
											?>
											<th scope="row" class="cmp-rowhead"><?php echo esc_html( $eaw_cell ); ?></th>
											<?php
											continue;
										endif;
										$eaw_td = $eaw_yes ? 'cell-yes' : ( $eaw_no ? 'cell-no' : 'cell-text' );
										if ( in_array( $idx, $eaw_feat_col, true ) ) {
											$eaw_td .= ' is-featured';
										}
										?>
										<td class="<?php echo esc_attr( $eaw_td ); ?>" data-label="<?php echo esc_attr( $eaw_lbl ); ?>">
											<?php
											if ( $eaw_yes ) {
												echo '<span class="cmp-mark cmp-mark--yes" aria-hidden="true">' . eaw_icon( 'check', 'icon' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
												echo '<span class="sr-only">' . esc_html( eaw_mod( 'compare_yes_label' ) ) . '</span>';
											} elseif ( $eaw_no ) {
												echo '<span class="cmp-mark cmp-mark--no" aria-hidden="true">' . eaw_icon( 'x', 'icon' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
												echo '<span class="sr-only">' . esc_html( eaw_mod( 'compare_no_label' ) ) . '</span>';
											} else {
												echo esc_html( $eaw_cell );
											}
											?>
										</td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php /* สิทธิ์ใช้งาน / VPS */ ?>
<?php
$eaw_license = trim( (string) eaw_mod( 'pricing_license_rows' ) );
$eaw_points  = eaw_lines( eaw_mod( 'pricing_license_points' ) );
$eaw_steps   = eaw_pages_pairs( eaw_mod( 'pricing_order_steps' ) );
if ( '' !== $eaw_license || $eaw_points ) :
	?>
	<section class="pg-sec pricing-terms" id="license">
		<div class="container">
			<div class="glass-panel pg-panel pricing-license">
				<?php eaw_pages_sec_head( eaw_mod( 'pricing_license_kicker' ), eaw_mod( 'pricing_license_title' ), eaw_mod( 'pricing_license_text' ) ); ?>
				<?php if ( '' !== $eaw_license ) : ?>
					<div class="pricing-license-table reveal">
						<?php echo str_replace( 'table-wrap table-wrap--stack', 'table-wrap table-wrap--stack table-wrap--cards', eaw_rich_text( $eaw_license ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside eaw_rich_text ?>
					</div>
				<?php endif; ?>
				<?php if ( $eaw_points ) : ?>
					<ul class="pricing-points">
						<?php foreach ( $eaw_points as $eaw_point ) : ?>
							<li class="reveal"><span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo eaw_rich_inline( $eaw_point ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php /* ขั้นตอนสั่งซื้อ · การ์ดเลขทอง + ปุ่มติดต่อ */ ?>
<?php if ( $eaw_steps ) : ?>
	<section class="pg-sec pricing-order-sec" id="order">
		<div class="container">
			<div class="glass-panel pg-panel pricing-order">
				<?php eaw_pages_sec_head( eaw_mod( 'pricing_order_kicker' ), eaw_mod( 'pricing_order_title' ), eaw_mod( 'pricing_order_sub' ) ); ?>
				<ol class="order-flow order-flow--<?php echo esc_attr( (string) min( 5, count( $eaw_steps ) ) ); ?>">
					<?php foreach ( $eaw_steps as $eaw_n => $eaw_step ) : ?>
						<li class="order-step reveal">
							<span class="order-num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $eaw_n + 1 ) ); ?></span>
							<h3><?php echo eaw_text( $eaw_step[0] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h3>
							<?php if ( '' !== $eaw_step[1] ) : ?>
								<p><?php echo eaw_rich_inline( $eaw_step[1] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ol>
				<div class="order-action">
					<?php
					eaw_contact_button(
						array(
							'text'  => eaw_mod( 'pricing_order_btn_text' ),
							'class' => 'btn btn-fire',
							'pos'   => 'pricing-order',
						)
					);
					?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
eaw_pages_enable_table_cards();
eaw_pages_longform();
?>

<?php eaw_line_cta( eaw_mod( 'pricing_cta_title' ), eaw_mod( 'pricing_cta_text' ) ); ?>

</main>

<?php
get_footer();
