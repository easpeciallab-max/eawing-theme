<?php
/**
 * EA WING · Shortcodes สำหรับใช้ในเนื้อหาเพจ/บทความ
 *
 * [eawing_line pos="xxx"]ข้อความปุ่ม[/eawing_line]  ปุ่ม LINE (ลิงก์จาก Customizer)
 * [eawing_brand]                                   ชื่อแบรนด์
 * [eawing_broker] / [eawing_broker field="server"] ชื่อโบรกเกอร์ / ชื่อเซิร์ฟเวอร์ MT5 (ตั้งค่าใน Customizer)
 * [eawing_calc type="lot|drawdown"]                เครื่องคำนวณ (JS ใน main.js)
 * [eawing_figure name="license-flow" alt="" caption=""] แผนภาพในธีม (assets/img/illus · รายชื่อใน eaw_figure_registry())
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function eaw_sc_line( $atts, $content = '' ) {
	$atts = shortcode_atts( array( 'pos' => 'content' ), $atts, 'eawing_line' );
	$text = trim( wp_strip_all_tags( (string) $content ) );
	if ( '' === $text ) {
		$text = 'สอบถามทีมงานทาง LINE';
	}
	// ไม่มี LINE → ใช้หน้า /go/ แทน · ไม่มีทั้งคู่ = ไม่แสดงปุ่ม (ไม่ชี้ไปที่ '#')
	$target = eaw_contact_target();
	if ( '' === $target['url'] ) {
		return '';
	}
	if ( ! $target['is_line'] ) {
		$text = eaw_mod( 'contact_fallback_text' );
	}
	return '<span class="sc-line"><a class="btn btn-fire" href="' . esc_url( $target['url'] ) . '"' . ( $target['is_line'] ? ' target="_blank" rel="noopener"' : '' ) . ' data-line-pos="' . esc_attr( sanitize_key( $atts['pos'] ) ) . '">'
		. eaw_icon( $target['is_line'] ? 'line' : 'chat' ) . '<span>' . esc_html( $text ) . '</span>' . eaw_icon( 'arrow' ) . '</a></span>';
}
add_shortcode( 'eawing_line', 'eaw_sc_line' );

function eaw_sc_brand() {
	return esc_html( eaw_mod( 'hero_title' ) ? eaw_mod( 'hero_title' ) : 'EA WING' );
}
add_shortcode( 'eawing_brand', 'eaw_sc_brand' );

function eaw_sc_broker( $atts ) {
	$atts = shortcode_atts( array( 'field' => 'name' ), $atts, 'eawing_broker' );
	$key  = 'server' === $atts['field'] ? 'broker_server' : ( 'url' === $atts['field'] ? 'broker_signup_url' : 'broker_name' );
	$val  = eaw_mod( $key );
	if ( 'broker_signup_url' === $key ) {
		return $val ? '<a class="btn btn-dark" href="' . esc_url( $val ) . '" target="_blank" rel="noopener sponsored">' . esc_html( eaw_mod( 'broker_signup_text' ) ) . ' ' . eaw_icon( 'external', 'icon icon-sm' ) . '</a>' : '';
	}
	return esc_html( $val );
}
add_shortcode( 'eawing_broker', 'eaw_sc_broker' );

/**
 * แผนภาพในเนื้อหา (สร้างด้วย dev/make-art.php) · ชื่อ => ไฟล์กว้าง, ไฟล์มือถือ, alt ตั้งต้น
 * เปลี่ยนภาพเมื่อไหร่ให้เปลี่ยนเลข v ในชื่อไฟล์ (Cloudflare แคชตาม URL)
 */
function eaw_figure_registry() {
	return (array) apply_filters(
		'eaw_figure_registry',
		array(
			'how-it-works' => array( 'eawing-how-it-works-v2.webp', 'eawing-how-it-works-mobile-v2.webp', 'แผนภาพ EA WING ทำงานอย่างไร 4 ขั้น จากกราฟ XAUUSD M1 ถึงการติดตามจากมือถือ' ),
			'license-flow' => array( 'eawing-license-flow-v2.webp', 'eawing-license-flow-mobile-v2.webp', 'แผนภาพขั้นตอนเปิดสิทธิ์ EA WING: ส่งเลขบัญชีทาง LINE ทีมงานเปิดสิทธิ์ใน 5 นาที การ์ดล็อกอินเป็นสีเขียว และทำงานต่อได้ 72 ชั่วโมงเมื่อเน็ตหลุด' ),
			'vps-flow'     => array( 'eawing-vps-flow-v2.webp', 'eawing-vps-flow-mobile-v2.webp', 'แผนภาพการใช้ Windows VPS รัน EA: เช่า VPS ลง MT5 และ EA ต่อจากคอมหรือมือถือ แล้วปิดเครื่องของคุณได้' ),
			'account-flow' => array( 'eawing-account-flow-v2.webp', 'eawing-account-flow-mobile-v2.webp', 'แผนภาพเปิดบัญชี MT5 สำหรับใช้ EA 4 ขั้น: สมัคร ยืนยันตัวตน สร้างบัญชีเทรด และส่งเลขบัญชีให้ทีมงาน' ),
			/* ภาพหน้าจอ MT5 (assets/img/install/) · ช่อง 4-5 = ขนาดจริง · ช่อง 6 = แสดงขนาดจริงกลางกรอบ (ภาพเล็ก) */
			'mt5-open-data-folder' => array( '../install/eawing-mt5-open-data-folder-v1.webp', '', 'เมนู File ของ MT5 ที่ชี้ไปที่ Open Data Folder', 620, 300, true ),
			'mt5-navigator'        => array( '../install/eawing-mt5-navigator-v1.webp', '', 'หน้าต่าง Navigator ของ MT5 หมวด Expert Advisors ที่มี EA_WING_V4.2', 210, 270, true ),
			/* ครอปจากแดชบอร์ดในคู่มือ PDF ของชุดส่งลูกค้า V4.2 (ไม่มีตัวเลขเทรด/ส่วนตั้งค่า) */
			'login-card-states'    => array( '../install/eawing-login-card-states-v1.webp', '', 'การ์ดล็อกอินบนแดชบอร์ด EA WING 4 แบบ: ล็อกอินสำเร็จ (เขียว) กำลังตรวจสิทธิ์และใช้แบบผ่อนผัน (เหลือง) และล็อกอินไม่ผ่าน (แดง)', 822, 350 ),
			'modes-version'        => array( '../install/eawing-modes-version-v1.webp', '', 'ปุ่มเลือกโหมด Lite และ Full บนแดชบอร์ด EA WING และแถบท้ายแผงที่บอกเวอร์ชัน EA WING v4.2', 822, 370 ),
		)
	);
}

function eaw_sc_figure( $atts ) {
	$atts = shortcode_atts(
		array(
			'name'    => '',
			'alt'     => '',
			'caption' => '',
		),
		$atts,
		'eawing_figure'
	);
	$all  = eaw_figure_registry();
	$name = sanitize_key( $atts['name'] );
	if ( ! isset( $all[ $name ] ) ) {
		return '';
	}
	$fig  = $all[ $name ];
	$base = get_template_directory_uri() . '/assets/img/illus/';
	$alt  = '' !== trim( (string) $atts['alt'] ) ? $atts['alt'] : $fig[2];
	$w    = isset( $fig[3] ) ? (int) $fig[3] : 1600;
	$h    = isset( $fig[4] ) ? (int) $fig[4] : 760;
	$html = '<figure class="eaw-figure' . ( ! empty( $fig[5] ) ? ' eaw-figure--fit' : '' ) . '"><picture>';
	if ( ! empty( $fig[1] ) ) {
		$html .= '<source media="(max-width: 680px)" srcset="' . esc_url( $base . $fig[1] ) . '" width="800" height="1140">';
	}
	$html .= '<img src="' . esc_url( $base . $fig[0] ) . '" alt="' . esc_attr( $alt ) . '" width="' . $w . '" height="' . $h . '" loading="lazy" decoding="async"></picture>';
	if ( '' !== trim( (string) $atts['caption'] ) ) {
		$html .= '<figcaption>' . esc_html( $atts['caption'] ) . '</figcaption>';
	}
	return $html . '</figure>';
}
add_shortcode( 'eawing_figure', 'eaw_sc_figure' );

function eaw_sc_calc( $atts ) {
	$atts = shortcode_atts( array( 'type' => 'lot' ), $atts, 'eawing_calc' );
	static $n = 0;
	$n++;
	$id = 'calc-' . $n;

	ob_start();
	if ( 'drawdown' === $atts['type'] ) :
		?>
		<div class="calc" data-calc="drawdown" id="<?php echo esc_attr( $id ); ?>">
			<div class="calc-head">
				<?php echo eaw_icon_badge( 'chart' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div>
					<strong>เครื่องคำนวณการฟื้นตัวจาก Drawdown</strong>
					<small>ใส่เปอร์เซ็นต์ที่พอร์ตลดลง แล้วดูว่าต้องเติบโตกลับอีกเท่าไรจึงกลับมาที่ทุนเดิม</small>
				</div>
			</div>
			<div class="calc-grid">
				<label class="calc-field">
					<span>พอร์ตลดลง (Drawdown %)</span>
					<input type="number" inputmode="decimal" min="0" max="99" step="0.1" value="20" data-in="dd">
				</label>
				<label class="calc-field">
					<span>ทุนตั้งต้น (USD) · ใส่หรือไม่ก็ได้</span>
					<input type="number" inputmode="decimal" min="0" step="1" value="1000" data-in="balance">
				</label>
			</div>
			<div class="calc-out" aria-live="polite">
				<div><span>ต้องเติบโตกลับ</span><strong data-out="gain">-</strong></div>
				<div><span>ทุนหลังลดลง</span><strong data-out="left">-</strong></div>
			</div>
			<div class="calc-bar" aria-hidden="true"><i data-out="bar"></i></div>
			<p class="calc-note">สูตรที่ใช้: ส่วนที่ต้องเติบโตกลับ = DD ÷ (1 - DD) · เป็นคณิตศาสตร์ล้วน ไม่ใช่ผลการเทรดของระบบใด</p>
		</div>
		<?php
	else :
		?>
		<div class="calc" data-calc="lot" id="<?php echo esc_attr( $id ); ?>">
			<div class="calc-head">
				<?php echo eaw_icon_badge( 'calc' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div>
					<strong>เครื่องคำนวณ Lot ตามเงินที่ยอมเสีย</strong>
					<small>เริ่มจากทุน เปอร์เซ็นต์ที่ยอมเสียต่อออเดอร์ และระยะ Stop Loss แล้วได้ขนาด Lot ที่สอดคล้อง</small>
				</div>
			</div>
			<div class="calc-grid">
				<label class="calc-field">
					<span>ทุนในบัญชี (USD)</span>
					<input type="number" inputmode="decimal" min="0" step="1" value="1000" data-in="balance">
				</label>
				<label class="calc-field">
					<span>ยอมเสียต่อออเดอร์ (%)</span>
					<input type="number" inputmode="decimal" min="0" max="100" step="0.1" value="1" data-in="risk">
				</label>
				<label class="calc-field">
					<span>ระยะ Stop Loss (pips)</span>
					<input type="number" inputmode="decimal" min="0" step="0.1" value="50" data-in="sl">
				</label>
				<label class="calc-field">
					<span>ตัวอย่างสินทรัพย์</span>
					<select data-in="preset">
						<option value="10">คู่เงินที่ USD เป็นสกุลหลัง เช่น EURUSD · บัญชี USD</option>
						<option value="10">ทองคำ XAUUSD สัญญา 100 oz (นับ 1 pip = 0.10)</option>
						<option value="custom">ใส่มูลค่า pip เอง</option>
					</select>
				</label>
				<label class="calc-field">
					<span>มูลค่า 1 pip ที่ 1 lot (USD)</span>
					<input type="number" inputmode="decimal" min="0" step="0.01" value="10" data-in="pipval">
				</label>
				<label class="calc-field">
					<span>ขั้นของ Lot (เช่น 0.01)</span>
					<input type="number" inputmode="decimal" min="0.001" step="0.01" value="0.01" data-in="step">
				</label>
			</div>
			<div class="calc-out" aria-live="polite">
				<div><span>เงินที่ยอมเสียต่อออเดอร์</span><strong data-out="money">-</strong></div>
				<div><span>ขนาด Lot ที่ได้</span><strong data-out="lot">-</strong></div>
			</div>
			<p class="calc-note">ตัวเลขนี้เป็นค่าประมาณ มูลค่า pip จริงขึ้นกับสินทรัพย์ โบรกเกอร์ และสกุลเงินของบัญชี · ดูค่าจริงใน MT5 ได้ที่ Market Watch: คลิกขวาที่สินทรัพย์ แล้วเลือก Specification</p>
		</div>
		<?php
	endif;
	return ob_get_clean();
}
add_shortcode( 'eawing_calc', 'eaw_sc_calc' );
