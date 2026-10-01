<?php
/**
 * EA WING · Shortcodes สำหรับใช้ในเนื้อหาเพจ/บทความ
 *
 * [eawing_line pos="xxx"]ข้อความปุ่ม[/eawing_line]  ปุ่ม LINE (ลิงก์จาก Customizer)
 * [eawing_brand]                                   ชื่อแบรนด์
 * [eawing_broker] / [eawing_broker field="server"] ชื่อโบรกเกอร์ / ชื่อเซิร์ฟเวอร์ MT5 (ตั้งค่าใน Customizer)
 * [eawing_calc type="lot|drawdown"]                เครื่องคำนวณ (JS ใน main.js)
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
