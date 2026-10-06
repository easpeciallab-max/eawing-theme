<?php
/**
 * Footer · กระจกสว่างในกรอบเว็บ (Glass Sky · docs/design.md)
 * 0) แผงติดต่อ (เฉพาะหน้าที่ยังไม่ได้พิมพ์ผ่าน eaw_line_cta() เช่น หน้าแรก) · inc/modules/chrome.php
 * 1) คอลัมน์แบรนด์ (โลโก้ ข้อความสั้น โซเชียล) · คู่มือ · หน้าในเว็บ · เอกสาร
 * 2) คำเตือนความเสี่ยงแบบสั้นในกล่องทองอ่อน + ลิงก์ไปหน้าประกาศความเสี่ยง (เจ้าของขอให้สั้น 6 ต.ค. 2026 · ฉบับเต็มอยู่หน้าแรก /go บทความ และ /risk-disclosure/)
 * 3) แถวลิขสิทธิ์ · ลิงก์นโยบาย · ตั้งค่าคุกกี้ · กลับขึ้นด้านบน
 * ปิดกรอบเว็บ .site-frame (เปิดใน header.php) แล้วจึงพิมพ์แถบล่างมือถือและปุ่ม LINE ลอย (position: fixed)
 * การ์ดความยินยอมคุกกี้พิมพ์ผ่าน wp_footer (inc/modules/consent.php) ไม่ใช่ไฟล์นี้
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'eaw_chrome_dock' ) ) {
	echo "</div>\n";
	wp_footer();
	echo "</body>\n</html>\n";
	return;
}

$eaw_guides = eaw_chrome_guide_items();
$eaw_index  = eaw_chrome_index_items();
$eaw_docs   = eaw_chrome_doc_items();
$eaw_legal  = eaw_chrome_legal_items();
/* ลิงก์เปิดการ์ดคุกกี้ · ชื่อลิงก์ตั้งที่หมวดคุกกี้ (inc/modules/consent.php) */
$eaw_cookie = ( function_exists( 'eaw_consent_link' ) && '' !== trim( (string) eaw_mod( 'consent_link_label' ) ) ) ? eaw_consent_link( array( 'echo' => false ) ) : '';
$eaw_about  = trim( (string) eaw_mod( 'footer_status_text' ) );
$eaw_points = eaw_lines( eaw_mod( 'footer_about_points' ) );
$eaw_top    = trim( (string) eaw_mod( 'footer_backtop_text' ) );
$eaw_risk   = trim( (string) eaw_mod( 'footer_risk_short' ) );
$eaw_risk   = '' !== $eaw_risk ? $eaw_risk : trim( (string) eaw_mod( 'risk_text' ) );
$eaw_rlink  = function_exists( 'eaw_published_page_url' ) ? eaw_published_page_url( 'risk-disclosure' ) : '';
$eaw_rmore  = trim( (string) eaw_mod( 'footer_risk_more' ) );
$eaw_copy   = trim( (string) eaw_mod( 'footer_copyright_text' ) );
$eaw_cols   = array(
	array( eaw_mod( 'nav_guide_label' ), $eaw_guides ),
	array( eaw_mod( 'footer_index_title' ), $eaw_index ),
	array( eaw_mod( 'footer_docs_title' ), $eaw_docs ),
);
?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
<footer class="site-footer site-foot" id="site-footer">

	<?php eaw_chrome_footer_contact(); ?>

	<div class="foot glass-panel">
		<div class="foot-top">
			<div class="foot-brand">
				<?php eaw_chrome_brand( 'brand--foot' ); ?>
				<?php if ( '' !== $eaw_about ) : ?>
					<p class="foot-about"><?php echo esc_html( $eaw_about ); ?></p>
				<?php endif; ?>
				<?php if ( $eaw_points ) : ?>
					<ul class="foot-points">
						<?php foreach ( $eaw_points as $eaw_point ) : ?>
							<li><?php echo eaw_icon( 'check', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $eaw_point ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php eaw_chrome_social_row( 'foot-social' ); ?>
			</div>

			<nav class="foot-cols" aria-label="ลิงก์ท้ายเว็บ">
				<?php
				foreach ( $eaw_cols as $eaw_col ) :
					if ( empty( $eaw_col[1] ) ) {
						continue;
					}
					?>
					<div class="foot-col">
						<?php if ( '' !== trim( (string) $eaw_col[0] ) ) : ?>
							<h2 class="foot-col-title"><?php echo esc_html( $eaw_col[0] ); ?></h2>
						<?php endif; ?>
						<ul class="foot-list">
							<?php foreach ( $eaw_col[1] as $eaw_entry ) : ?>
								<li><a href="<?php echo esc_url( $eaw_entry[1] ); ?>"><?php echo esc_html( $eaw_entry[0] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</nav>
		</div>

		<?php if ( '' !== $eaw_risk ) : ?>
			<div class="foot-risk" role="note">
				<span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<p><?php echo esc_html( $eaw_risk ); ?><?php if ( $eaw_rlink && '' !== $eaw_rmore ) : ?> <a class="foot-risk-more" href="<?php echo esc_url( $eaw_rlink ); ?>"><?php echo esc_html( $eaw_rmore ); ?></a><?php endif; ?></p>
			</div>
		<?php endif; ?>

		<div class="foot-bar">
			<p class="foot-copy">&copy; <?php echo esc_html( wp_date( 'Y', null, new DateTimeZone( 'Asia/Bangkok' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?><?php echo '' !== $eaw_copy ? ' · ' . esc_html( $eaw_copy ) : ''; ?></p>
			<?php if ( $eaw_legal || '' !== $eaw_cookie || '' !== $eaw_top ) : ?>
				<ul class="foot-legal">
					<?php foreach ( $eaw_legal as $eaw_entry ) : ?>
						<li><a href="<?php echo esc_url( $eaw_entry[1] ); ?>"><?php echo esc_html( $eaw_entry[0] ); ?></a></li>
					<?php endforeach; ?>
					<?php if ( '' !== $eaw_cookie ) : ?>
						<li><?php echo $eaw_cookie; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside eaw_consent_link ?></li>
					<?php endif; ?>
					<?php if ( '' !== $eaw_top ) : ?>
						<li><a class="foot-top-link" href="#top"><span><?php echo esc_html( $eaw_top ); ?></span><?php echo eaw_icon( 'arrow', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php endif; ?>

</div><!-- /.site-frame -->

<?php if ( eaw_mod( 'show_mobile_nav' ) ) : ?>
	<?php $eaw_dock = eaw_chrome_dock(); ?>
	<?php if ( $eaw_dock['items'] ) : ?>
<nav class="mobile-app-nav dock" aria-label="เมนูลัดมือถือ">
		<?php
		foreach ( $eaw_dock['items'] as $eaw_slot => $eaw_item ) :
			$eaw_is_action = ! empty( $eaw_item['action'] );
			$eaw_is_here   = ! $eaw_is_action && (int) $eaw_slot === $eaw_dock['active'];
			$eaw_cls       = 'dock-key';
			if ( $eaw_is_action ) {
				$eaw_cls .= ' is-action' . ( ! empty( $eaw_item['line'] ) ? ' is-line' : '' );
			} elseif ( $eaw_is_here ) {
				$eaw_cls .= ' is-active';
			}
			?>
	<a class="<?php echo esc_attr( $eaw_cls ); ?>" href="<?php echo esc_url( $eaw_item['url'] ); ?>" data-slot="<?php echo esc_attr( (string) $eaw_slot ); ?>"<?php echo $eaw_is_here ? ' aria-current="page"' : ''; ?><?php echo ! empty( $eaw_item['line'] ) ? ' target="_blank" rel="noopener"' : ''; ?><?php echo $eaw_is_action ? ' data-line-pos="dock"' : ''; ?>>
		<span class="dock-cap"><?php echo eaw_icon( $eaw_item['icon'], 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span class="dock-label"><?php echo esc_html( $eaw_item['label'] ); ?></span>
	</a>
		<?php endforeach; ?>
</nav>
	<?php endif; ?>
<?php endif; ?>

<?php if ( eaw_has_line_url() && eaw_mod( 'show_float_line' ) ) : ?>
<a class="float-line" href="<?php echo esc_url( trim( (string) eaw_mod( 'line_url' ) ) ); ?>" target="_blank" rel="noopener" data-line-pos="float">
	<span class="fab-core" aria-hidden="true"><?php echo eaw_icon( 'line' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
	<span class="float-line-text"><?php echo esc_html( eaw_mod( 'float_line_text' ) ); ?></span>
</a>
<?php endif; ?>

<?php if ( eaw_has_line_url() && ! eaw_mod( 'show_float_line' ) ) : ?>
<a class="line-fab" href="<?php echo esc_url( trim( (string) eaw_mod( 'line_url' ) ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( eaw_mod( 'float_line_text' ) ); ?>" data-line-pos="fab">
	<span class="fab-core" aria-hidden="true"><?php echo eaw_icon( 'line' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
