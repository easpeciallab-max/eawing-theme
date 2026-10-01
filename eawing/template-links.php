<?php
/**
 * Template Name: ลิงก์รวม (Link Hub)
 *
 * หน้า /go · ลิงก์ติดต่อทีมงาน + 6 ขั้นตอนเริ่มใช้งาน
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$line     = eawing_link( 'line' );
$openchat = eawing_link( 'openchat' );
$portal   = eawing_link( 'portal' );

// โลโก้จาก ลักษณะ > ปรับแต่ง > เอกลักษณ์ของเว็บไซต์ · ถ้ายังไม่ตั้งใช้โลโก้ชั่วคราว
$logo_id   = get_theme_mod( 'custom_logo' );
$logo     = $logo_id ? wp_get_attachment_image_src( $logo_id, 'medium' ) : false;
$has_logo = (bool) $logo;
if ( ! $has_logo ) {
	$logo = array( get_theme_file_uri( 'assets/img/logo-mark.svg' ), 84, 84 );
}

// ลิงก์ท้ายการ์ด · แสดงเฉพาะหน้าที่มีอยู่จริง
$legal_pages = array(
	'privacy-policy' => 'นโยบายความเป็นส่วนตัว',
	'terms-of-use'   => 'เงื่อนไขการใช้บริการ',
	'risk-warning'   => 'คำเตือนความเสี่ยงการใช้ EA',
);
$legal_links = array();
foreach ( $legal_pages as $slug => $label ) {
	$page = get_page_by_path( $slug );
	if ( $page && 'publish' === $page->post_status ) {
		$legal_links[ $label ] = get_permalink( $page );
	}
}
?>
<!doctype html>
<html lang="th">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#D4E6FB">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'link-hub-page' ); ?>>
<?php wp_body_open(); ?>

<!-- ไอคอนที่ใช้ซ้ำ -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
	<symbol id="i-line" viewBox="0 0 24 24"><path fill="currentColor" d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.348 0 .63.283.63.63 0 .344-.282.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></symbol>
	<symbol id="i-group" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M16.5 19.5c0-2.1-1.8-3.8-4.5-3.8s-4.5 1.7-4.5 3.8"/><circle cx="12" cy="9" r="3.2"/><path d="M20.5 18.5c0-1.7-1.2-3-3-3.4"/><path d="M16.8 6.3a2.6 2.6 0 0 1 0 5.1"/><path d="M3.5 18.5c0-1.7 1.2-3 3-3.4"/><path d="M7.2 6.3a2.6 2.6 0 0 0 0 5.1"/></symbol>
	<symbol id="i-book" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21V5.5z"/><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5A2.5 2.5 0 0 1 20 21V5.5z"/><path d="M7 7h1.6M7 10h1.6M15.4 7H17M15.4 10H17"/></symbol>
	<symbol id="i-apple" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M16.6 13.1c0-2.1 1.7-3.1 1.8-3.2-1-1.5-2.5-1.7-3-1.7-1.3-.1-2.5.7-3.1.7-.7 0-1.7-.7-2.8-.7-1.5 0-2.9.9-3.6 2.2-1.6 2.7-.4 6.6 1.1 8.8.7 1.1 1.6 2.3 2.8 2.2 1.1 0 1.5-.7 2.8-.7 1.3 0 1.7.7 2.8.7 1.2 0 1.9-1.1 2.6-2.2.8-1.2 1.1-2.3 1.2-2.4-.1 0-2.6-1-2.6-3.7z"/><path d="M14.7 5.9c.6-.8 1-1.8.9-2.9-.9.1-1.9.6-2.5 1.3-.6.7-1.1 1.7-.9 2.8.9.1 1.9-.5 2.5-1.2z"/></symbol>
	<symbol id="i-android" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 8.5h8a3 3 0 0 1 3 3V17a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-5.5a3 3 0 0 1 3-3z"/><path d="M8.5 5 7 2.8M15.5 5 17 2.8"/><path d="M9 19v2M15 19v2M3 12v4M21 12v4"/><path d="M9.2 12h.01M14.8 12h.01"/></symbol>
	<symbol id="i-windows" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3.5 5.5 10.5 4.5v6.8h-7z"/><path d="M13 4.1 20.5 3v8.3H13z"/><path d="M3.5 12.7h7v6.8l-7-1z"/><path d="M13 12.7h7.5V21L13 19.9z"/></symbol>
	<symbol id="i-deposit" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M3.8 19c.7-3 2.8-4.6 5.2-4.6 1.4 0 2.7.5 3.7 1.5"/><circle cx="17" cy="16.5" r="4"/><path d="M17 14.5v4M15 16.5h4"/></symbol>
	<symbol id="i-install" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v10M7.5 10.5L12 15l4.5-4.5"/><path d="M5 19h14"/></symbol>
	<symbol id="i-server" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="6.5" rx="1.6"/><rect x="4" y="13.5" width="16" height="6.5" rx="1.6"/><path d="M7.5 7.25h.01M7.5 16.75h.01M11 7.25h5.5M11 16.75h5.5"/></symbol>
	<symbol id="i-chart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5"/><path d="M4 19h16"/><path d="M7 15l3-3 2.4 2.4L17.5 9"/><path d="M15 9h2.5v2.5"/></symbol>
	<symbol id="i-tag" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12.5 12.5 20 4 11.5V4h7.5L20 12.5z"/><circle cx="8.2" cy="8.2" r="0.8"/></symbol>
</svg>

<main class="link-hub">
	<div class="lh-card">

		<div class="<?php echo $has_logo ? 'lh-logo is-custom' : 'lh-logo'; ?>">
			<img src="<?php echo esc_url( $logo[0] ); ?>" alt="EA WING" width="<?php echo (int) $logo[1]; ?>" height="<?php echo (int) $logo[2]; ?>">
		</div>
		<?php // โลโก้จริงมีชื่อแบรนด์อยู่แล้ว ซ่อนหัวข้อซ้ำไว้ให้โปรแกรมอ่านหน้าจอ ?>
		<h1 class="<?php echo $has_logo ? 'screen-reader-text' : 'lh-title'; ?>">EA WING</h1>
		<p class="lh-tagline">ระบบเทรดอัตโนมัติบน MetaTrader 5 พร้อมคู่มือภาษาไทยและทีมงานไทยช่วยแนะนำการติดตั้ง</p>

		<!-- ติดต่อทีมงาน -->
		<section class="lh-group lh-group--help" aria-labelledby="lh-help-title">
			<h2 class="lh-section-title" id="lh-help-title">ติดขั้นตอนไหน ทักทีมงานได้</h2>
			<a class="lh-btn lh-btn-line" href="<?php echo esc_url( $line ); ?>" target="_blank" rel="noopener" data-line-pos="go-top">
				<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-line"/></svg></span>
				<span class="lh-lbl">ทัก LINE ปรึกษาทีมงาน</span>
			</a>
			<a class="lh-btn lh-btn-openchat" href="<?php echo esc_url( $openchat ); ?>" target="_blank" rel="noopener" data-line-pos="go-openchat">
				<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-group"/></svg></span>
				<span class="lh-lbl">เข้ากลุ่ม EA WING OpenChat</span>
			</a>
		</section>

		<!-- ขั้นตอนเริ่มใช้งาน -->
		<section class="lh-journey" aria-labelledby="lh-steps-title">
			<h2 class="lh-steps-title" id="lh-steps-title">เริ่มใช้งาน EA WING ใน 6 ขั้นตอน</h2>
			<ol class="lh-steps">

				<li class="lh-step lh-step--account">
					<span class="lh-step-num" aria-hidden="true">1</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 1 </span>เปิดบัญชี MT5 กับ Zaurix</h3>
						<p class="lh-step-desc">สมัครและยืนยันตัวตน (KYC) เพื่อรับเลขบัญชีและรหัสผ่าน MT5</p>
						<p class="lh-step-note">EA WING เป็นพันธมิตรของ Zaurix และได้รับค่าตอบแทนเมื่อเปิดบัญชีผ่านลิงก์ของทีมงาน</p>
					</div>
					<div class="lh-step-body">
						<a class="lh-btn lh-btn-line lh-btn-line-step" href="<?php echo esc_url( $line ); ?>" target="_blank" rel="noopener" data-line-pos="go-signup">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-line"/></svg></span>
							<span class="lh-lbl">ขอลิงก์เปิดบัญชีจากทีมงานทาง LINE</span>
						</a>
						<span class="lh-mini-btn is-pending" aria-disabled="true">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-book"/></svg></span>
							<span class="lh-lbl">สอนเปิดบัญชีทีละขั้น</span>
							<span class="lh-pending-tag">เร็ว ๆ นี้</span>
						</span>
					</div>
				</li>

				<li class="lh-step lh-step--mt5">
					<span class="lh-step-num" aria-hidden="true">2</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 2 </span>ติดตั้งแอป MT5 และล็อกอิน</h3>
						<p class="lh-step-desc">เลือกอุปกรณ์ที่ใช้ แล้วล็อกอินด้วยบัญชีจากขั้นที่ 1</p>
					</div>
					<div class="lh-step-body">
						<div class="lh-vps-grid lh-mt5-grid lh-mt5-grid--3">
							<a class="lh-vps-item" href="https://apps.apple.com/us/app/metatrader-5/id413251709" target="_blank" rel="noopener">
								<span class="lh-vps-ic"><svg aria-hidden="true" focusable="false"><use href="#i-apple"/></svg></span>
								<span class="lh-vps-lbl">iPhone</span>
							</a>
							<a class="lh-vps-item" href="https://play.google.com/store/apps/details?id=net.metaquotes.metatrader5" target="_blank" rel="noopener">
								<span class="lh-vps-ic"><svg aria-hidden="true" focusable="false"><use href="#i-android"/></svg></span>
								<span class="lh-vps-lbl">Android</span>
							</a>
							<a class="lh-vps-item" href="https://www.metatrader5.com/en/download" target="_blank" rel="noopener">
								<span class="lh-vps-ic"><svg aria-hidden="true" focusable="false"><use href="#i-windows"/></svg></span>
								<span class="lh-vps-lbl">Windows</span>
							</a>
						</div>
						<span class="lh-mini-btn is-pending" aria-disabled="true">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-book"/></svg></span>
							<span class="lh-lbl">วิธีล็อกอินเข้า Zaurix-Server</span>
							<span class="lh-pending-tag">เร็ว ๆ นี้</span>
						</span>
					</div>
				</li>

				<li class="lh-step lh-step--deposit">
					<span class="lh-step-num" aria-hidden="true">3</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 3 </span>ฝากเงินเข้าบัญชีเทรด</h3>
						<p class="lh-step-desc">ฝากเงินผ่านหน้า Portal ของ Zaurix ก่อนเริ่มใช้ EA</p>
					</div>
					<div class="lh-step-body">
						<a class="lh-btn" href="<?php echo esc_url( $portal ); ?>" target="_blank" rel="noopener">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-deposit"/></svg></span>
							<span class="lh-lbl">เข้า Portal Zaurix</span>
							<span class="lh-ar" aria-hidden="true">›</span>
						</a>
						<span class="lh-mini-btn is-pending" aria-disabled="true">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-book"/></svg></span>
							<span class="lh-lbl">คู่มือฝากเงิน</span>
							<span class="lh-pending-tag">เร็ว ๆ นี้</span>
						</span>
					</div>
				</li>

				<li class="lh-step lh-step--download">
					<span class="lh-step-num" aria-hidden="true">4</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 4 </span>รับไฟล์ EA WING</h3>
						<p class="lh-step-desc">ทีมงานส่งไฟล์ EA WING ให้ทาง LINE หลังยืนยันสิทธิ์การใช้งาน</p>
					</div>
					<div class="lh-step-body">
						<a class="lh-btn lh-btn-line lh-btn-line-step" href="<?php echo esc_url( $line ); ?>" target="_blank" rel="noopener" data-line-pos="go-download">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-line"/></svg></span>
							<span class="lh-lbl">ขอรับไฟล์ EA WING ทาง LINE</span>
						</a>
					</div>
				</li>

				<li class="lh-step lh-step--install">
					<span class="lh-step-num" aria-hidden="true">5</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 5 </span>ติดตั้ง EA บน MT5</h3>
						<p class="lh-step-desc">วางไฟล์ EA ลงใน MT5 แล้วเปิด Algo Trading</p>
					</div>
					<div class="lh-step-body">
						<span class="lh-mini-btn is-pending" aria-disabled="true">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-install"/></svg></span>
							<span class="lh-lbl">คู่มือติดตั้ง EA WING</span>
							<span class="lh-pending-tag">เร็ว ๆ นี้</span>
						</span>
					</div>
				</li>

				<li class="lh-step lh-step--vps">
					<span class="lh-step-num" aria-hidden="true">6</span>
					<div class="lh-step-head">
						<h3 class="lh-step-title"><span class="screen-reader-text">ขั้นที่ 6 </span>ให้ EA ทำงาน 24 ชั่วโมงด้วย VPS <span class="lh-step-badge">แนะนำ</span></h3>
						<p class="lh-step-desc">ใช้ VPS เพื่อให้ MT5 เปิดค้างไว้ตลอด แม้ปิดคอมหรือมือถือ</p>
					</div>
					<div class="lh-step-body">
						<span class="lh-mini-btn is-pending" aria-disabled="true">
							<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-server"/></svg></span>
							<span class="lh-lbl">คู่มือตั้งค่า VPS</span>
							<span class="lh-pending-tag">เร็ว ๆ นี้</span>
						</span>
					</div>
				</li>

			</ol>
		</section>

		<!-- ข้อมูลก่อนตัดสินใจ -->
		<section class="lh-group lh-group--info" aria-labelledby="lh-info-title">
			<h2 class="lh-section-title" id="lh-info-title">ข้อมูลก่อนตัดสินใจ</h2>
			<a class="lh-btn" href="<?php echo esc_url( $line ); ?>" target="_blank" rel="noopener" data-line-pos="go-pricing">
				<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-tag"/></svg></span>
				<span class="lh-lbl">สอบถามแพ็กเกจ &amp; ราคา</span>
				<span class="lh-ar" aria-hidden="true">›</span>
			</a>
			<span class="lh-mini-btn is-pending" aria-disabled="true">
				<span class="lh-ic"><svg aria-hidden="true" focusable="false"><use href="#i-chart"/></svg></span>
				<span class="lh-lbl">ผล Forward Test</span>
				<span class="lh-pending-tag">เร็ว ๆ นี้</span>
			</span>
		</section>

		<p class="lh-note">การเทรด Forex, CFD และสินทรัพย์ทางการเงินอื่น ๆ มีความเสี่ยงสูง คุณอาจสูญเสียเงินลงทุนบางส่วนหรือทั้งหมด ผลในอดีตไม่รับประกันผลในอนาคต · EA WING เป็นเครื่องมือช่วยเทรดตามเงื่อนไขที่กำหนด ไม่ใช่คำแนะนำการลงทุนและไม่ใช่การรับประกันผลกำไร</p>

		<?php if ( $legal_links ) : ?>
			<p class="lh-legal">
				<?php foreach ( $legal_links as $label => $url ) : ?>
					<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
			</p>
		<?php endif; ?>

	</div>
</main>

<?php wp_footer(); ?>
</body>
</html>
