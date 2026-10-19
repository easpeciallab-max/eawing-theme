<?php
/**
 * EA WING · สินค้าตัวที่สอง WING TWIN (เพิ่ม 19 ต.ค. 2026)
 *
 * - หน้าสินค้า /wing-twin/ (template-twin.php): หัวเพจ + การ์ดข้อมูลสินค้า (twin_stat1..8) + เนื้อหายาวจาก inc/content/pages/wing-twin.html
 * - การ์ดดาวน์โหลดใบที่สองในหน้า /go (go_twin_* · go.php เรียก eaw_go_download_card())
 * - ส่วนแนะนำสินค้าในหน้าแรก [twin] ต่อจากส่วนโหมดของ EA WING (front-page.php เรียก eaw_homeplus_section( 'twin' ))
 * - แผนภาพรายงาน MT5 ของ 4 ชุด [eawing_figure name="twin-set1..4"] และชื่อไฟล์ผ่าน [eawing_ea product="twin"]
 *
 * ข้อเท็จจริงทุกข้อมาจากชุดของเจ้าของ D:/EA VIDEO/EA META DATA/EA WING/EA FILE DOWNLOAD/WING_TWIN_V6.1/
 * (อ่านก่อน.txt · คู่มือการใช้งาน PDF · การตลาดสำหรับแอดมิน PDF · รายงาน MT5 4 ชุด) · ใช้ตัวเลขผลทดสอบเมื่อไหร่ต้องมีเงื่อนไข
 * ทรุดหนักสุดของชุดเดียวกัน สัดส่วนกำไรจากช่วงราคาจำลอง และคำว่าไม่มีตัดขาดทุน (กติกาในคู่มือการตลาดของเจ้าของ)
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'eaw_defaults', 'eaw_twin_defaults' );

function eaw_twin_defaults( $d ) {
	return array_merge(
		$d,
		array(
			/* ---------- รุ่นของไฟล์ (ใช้ใน [eawing_ea product="twin"]) ---------- */
			'twin_version'      => '6.1',

			/* ---------- หน้า /wing-twin/ ---------- */
			'twin_sub'          => 'EA เทรดทองคำ XAUUSD อัตโนมัติบน MT5 สินค้าตัวที่สองของ EA WING ทำงานด้วยเครื่องยนต์ DUAL GRID (กริดสองทาง) มีชุดค่าในตัว 4 ชุด เลือกขนาดได้ 1 ถึง 20 เท่า และตั้งเวลาเปิดรอบใหม่บนแดชบอร์ดได้ ไม่มีการตัดขาดทุน อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'twin_hero_img'     => 'assets/img/products/wing-twin-card-v1.webp',
			'twin_dl_url'       => 'assets/downloads/WING_TWIN_V6.1.zip',
			'twin_dl_label'     => 'ดาวน์โหลด WING TWIN V6.1',
			'twin_stat1_label'  => 'เครื่องยนต์',
			'twin_stat1_value'  => 'DUAL GRID (กริดสองทาง)',
			'twin_stat2_label'  => 'กราฟ',
			'twin_stat2_value'  => 'XAUUSD.s · M1',
			'twin_stat3_label'  => 'ชนิดบัญชี',
			'twin_stat3_value'  => 'Hedging · สกุล USD',
			'twin_stat4_label'  => 'ชุดค่าในตัว',
			'twin_stat4_value'  => '4 ชุด',
			'twin_stat5_label'  => 'ทุนขั้นต่ำ / แนะนำ ชุดที่ 1 ถึง 2',
			'twin_stat5_value'  => '10,000 / 20,000 USD',
			'twin_stat6_label'  => 'ทุนขั้นต่ำ / แนะนำ ชุดที่ 3 ถึง 4',
			'twin_stat6_value'  => '20,000 / 30,000 USD',
			'twin_stat7_label'  => 'ขนาด N',
			'twin_stat7_value'  => '1 ถึง 20 เท่า',
			'twin_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'twin_stat8_value'  => 'ไม่มี',
			'twin_note'         => 'ทุนขั้นต่ำและทุนแนะนำคิดต่อขนาด N = 1 ทุกชุดใช้บัญชี Hedging ที่ทอง 1 lot = 100 oz (XAUUSD.s) ไม่แนะนำบัญชีเซนต์ · WING TWIN เป็นสินค้าคนละตัวกับ EA WING 5.0 ใช้บัญชีและทุนต่างกัน',
			'twin_disclaimer'   => 'ไม่มีตัดขาดทุน · ผลทดสอบย้อนหลังไม่ใช่สัญญาว่าจะได้กำไร · การเทรดทองคำมีความเสี่ยงสูง อาจเสียเงินทั้งหมด',
			'twin_cta_title'    => 'สนใจ WING TWIN หรืออยากรู้ว่าชุดไหนเข้ากับทุนของคุณ',
			'twin_cta_text'     => 'ใช้แพ็กเกจและราคาเดียวกับ EA WING 5.0 ทักทีมงานทาง LINE ถามว่าชุดไหนเข้ากับบัญชีของคุณ และขอเปิดสิทธิ์ใช้งาน ส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์มาได้เลย',

			/* ---------- การ์ดดาวน์โหลดใบที่สองในหน้า /go ---------- */
			'go_twin_img'       => 'assets/img/products/wing-twin-go-card-v1.webp',
			'go_twin_url'       => 'assets/downloads/WING_TWIN_V6.1.zip',
			'go_twin_alt'       => 'ดาวน์โหลด EA WING TWIN Expert Advisor สำหรับ MT5',
			'go_twin_label'     => 'ดาวน์โหลด WING TWIN V6.1',
			'go_twin_version'   => 'V6.1',
			'go_twin_info_label' => 'อ่านก่อนใช้ WING TWIN',
			'go_twin_info_url'  => '/wing-twin/',

			/* ---------- หน้าแรก [twin] ---------- */
			'show_home_twin'    => true,
			'home_twin_title'   => 'สินค้าตัวที่สอง: WING TWIN',
			'home_twin_sub'     => 'EA ทองคำอีกแบบสำหรับบัญชีมาตรฐานสกุล USD ทำงานคนละวิธีกับ EA WING 5.0 จึงใช้บัญชีและทุนต่างกัน',
			'home_twin_name'    => 'WING TWIN 6.1',
			'home_twin_heading' => 'กริดสองทาง 4 ชุดในตัว',
			'home_twin_text'    => 'ราคาวิ่งครบระยะกริดเมื่อไหร่ EA เปิดออเดอร์ตามทางที่ราคาวิ่ง ถ้าราคากลับทิศจะเปิดออเดอร์ฝั่งตรงข้ามที่ใหญ่กว่า แล้วปิดทุกออเดอร์พร้อมกันเมื่อกำไรลอยรวมถึงเป้า ใช้บัญชี Hedging บนกราฟ XAUUSD.s',
			'home_twin_points'  => "4 ชุดในตัว: WING LIFE1 · WING LIFE2 · FULL TURBO1 · FULL TURBO2\nทุนขั้นต่ำ 10,000 USD (ชุดที่ 1 ถึง 2) และ 20,000 USD (ชุดที่ 3 ถึง 4) ต่อขนาด N = 1\nไม่มีการตัดขาดทุน ออเดอร์อาจค้างรอราคากลับได้หลายสัปดาห์",
			'home_twin_img'     => 'assets/img/products/wing-twin-card-v1.webp',
			'home_twin_img_alt' => 'การ์ดสินค้า EA WING TWIN Expert Advisor สำหรับ MT5',
			'home_twin_btn'     => 'ดูรายละเอียด WING TWIN',
			'home_twin_url'     => '/wing-twin/',
		)
	);
}

/* ==============================================================
 * Customizer
 * ============================================================== */

add_filter( 'eaw_customizer_sections', 'eaw_twin_customizer_sections', 12, 2 );

function eaw_twin_customizer_sections( $sections, $d ) {
	$rule   = 'ใช้ข้อเท็จจริงจากชุดเอกสารของเจ้าของเท่านั้น · ตัวเลขผลต้องมาคู่กับทรุดหนักสุดและเงื่อนไขทดสอบ';
	$stats  = array();
	for ( $i = 1; $i <= 8; $i++ ) {
		$stats[ 'twin_stat' . $i . '_label' ] = array( 'การ์ดข้อมูล ' . $i . ' · หัวข้อ (ว่าง = ซ่อน)', 'text' );
		$stats[ 'twin_stat' . $i . '_value' ] = array( 'การ์ดข้อมูล ' . $i . ' · ค่า', 'text' );
	}
	$sections['eaw_twin'] = array(
		'title'       => '31) สินค้า WING TWIN (หน้า /wing-twin/ · การ์ด /go · หน้าแรก)',
		'description' => 'สินค้าตัวที่สองของเว็บ · เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/wing-twin.html (EA WING Setup) · เปลี่ยนรุ่น = แก้เลขรุ่น + ลิงก์ไฟล์ zip ทั้งสองช่อง + ภาพรายงาน MT5',
		'fields'      => array_merge(
			array(
				'twin_version'  => array( 'เลขรุ่นของไฟล์ (เช่น 6.1 · ชื่อไฟล์ในเนื้อหาเป็น WING_TWIN_V6.1.ex5 ผ่าน [eawing_ea product="twin"])', 'text' ),
				'twin_sub'      => array( 'หน้าสินค้า · คำอธิบายใต้ชื่อ', 'textarea', $rule ),
				'twin_hero_img' => array( 'หน้าสินค้า · ภาพการ์ดสินค้าในหัวเพจ', 'image' ),
				'twin_dl_url'   => array( 'หน้าสินค้า · ลิงก์ดาวน์โหลดไฟล์ zip (ว่าง = ไม่มีปุ่ม)', 'path' ),
				'twin_dl_label' => array( 'หน้าสินค้า · ข้อความปุ่มดาวน์โหลด', 'text' ),
			),
			$stats,
			array(
				'twin_note'         => array( 'หน้าสินค้า · หมายเหตุใต้การ์ดข้อมูล', 'textarea' ),
				'twin_disclaimer'   => array( 'หน้าสินค้า · คำเตือนใต้การ์ดข้อมูล (ห้ามลบ)', 'textarea' ),
				'twin_cta_title'    => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · หัวข้อ', 'text' ),
				'twin_cta_text'     => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · คำอธิบาย', 'textarea' ),
				'go_twin_img'       => array( 'หน้า /go · ภาพการ์ดดาวน์โหลด WING TWIN (2:1)', 'image' ),
				'go_twin_url'       => array( 'หน้า /go · ลิงก์ไฟล์ WING TWIN (ว่าง = ไม่แสดงการ์ด)', 'path' ),
				'go_twin_alt'       => array( 'หน้า /go · คำอธิบายภาพการ์ด (alt)', 'text' ),
				'go_twin_label'     => array( 'หน้า /go · ข้อความปุ่มดาวน์โหลด', 'text' ),
				'go_twin_version'   => array( 'หน้า /go · เลขเวอร์ชันบนการ์ด (ว่าง = ไม่แสดงป้าย)', 'text' ),
				'go_twin_info_label' => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ข้อความ (ว่าง = ไม่มีปุ่ม)', 'text' ),
				'go_twin_info_url'  => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ลิงก์', 'path' ),
				'show_home_twin'    => array( 'หน้าแรก · แสดงส่วนสินค้า WING TWIN', 'checkbox' ),
				'home_twin_title'   => array( 'หน้าแรก · หัวข้อส่วน (H2)', 'text' ),
				'home_twin_sub'     => array( 'หน้าแรก · คำอธิบายใต้หัวข้อ', 'textarea' ),
				'home_twin_name'    => array( 'หน้าแรก · ชื่อสินค้าตัวใหญ่', 'text' ),
				'home_twin_heading' => array( 'หน้าแรก · หัวข้อย่อย', 'text' ),
				'home_twin_text'    => array( 'หน้าแรก · คำอธิบาย', 'textarea', $rule ),
				'home_twin_points'  => array( 'หน้าแรก · จุดสำคัญ (บรรทัดละ 1 ข้อ)', 'textarea', $rule ),
				'home_twin_img'     => array( 'หน้าแรก · ภาพสินค้า', 'image' ),
				'home_twin_img_alt' => array( 'หน้าแรก · คำอธิบายภาพ (alt)', 'text' ),
				'home_twin_btn'     => array( 'หน้าแรก · ข้อความปุ่ม', 'text' ),
				'home_twin_url'     => array( 'หน้าแรก · ลิงก์ปุ่ม', 'path', 'slug ในเว็บ เช่น /wing-twin/' ),
			)
		),
	);
	return $sections;
}

/* ==============================================================
 * ตัวช่วย
 * ============================================================== */

function eaw_twin_version() {
	$v = preg_replace( '/[^0-9.]/', '', (string) eaw_mod( 'twin_version' ) );
	return '' !== $v ? $v : '6.1';
}

function eaw_twin_name() {
	return 'WING_TWIN_V' . eaw_twin_version();
}

/* รายงาน MT5 ของ 4 ชุด (assets/img/results/ · ครอปตั้งแต่บรรทัด Company ถึงกราฟ Balance ในหน้าเดียวกัน ไม่ตัดต่อ) */
add_filter(
	'eaw_figure_registry',
	function ( $figs ) {
		$sets = array(
			1 => array( 'WING LIFE1', '124,656.12', '1.05', '53.99%', '7,334.50', '144,879' ),
			2 => array( 'WING LIFE2', '94,783.34', '1.06', '50.49%', '14,138.63', '68,301' ),
			3 => array( 'FULL TURBO1', '101,745.61', '1.06', '62.42%', '18,334.58', '97,088' ),
			4 => array( 'FULL TURBO2', '135,589.85', '1.05', '77.03%', '8,786.69', '132,780' ),
		);
		foreach ( $sets as $i => $s ) {
			$figs[ 'twin-set' . $i ] = array(
				'../results/eawing-twin-set' . $i . '-v1.webp',
				'',
				sprintf( 'ส่วน Results ของรายงาน Strategy Tester ของ WING TWIN 6.1 ชุดที่ %1$d %2$s ช่วง 1 ม.ค. ถึง 30 ก.ย. 2026: Initial Deposit 10,000 Total Net Profit %3$s Profit Factor %4$s Equity Drawdown Relative %5$s Equity Drawdown Maximal %6$s Total Trades %7$s และกราฟ Balance', $i, $s[0], $s[1], $s[2], $s[3], $s[4], $s[5] ),
				1120,
				836,
			);
		}
		return $figs;
	}
);

/* ==============================================================
 * หน้าแรก [twin] · ใช้โครงเดียวกับแผงโหมด (ภาพซ้าย ข้อความขวา) ไม่ต้องมี CSS เพิ่ม
 * ============================================================== */

function eaw_homeplus_twin() {
	$name = trim( (string) eaw_mod( 'home_twin_name' ) );
	if ( '' === $name ) {
		return;
	}
	$img    = eaw_theme_asset_url( eaw_mod( 'home_twin_img' ) );
	$points = eaw_lines( eaw_mod( 'home_twin_points' ) );
	$url    = eaw_home_link( eaw_mod( 'home_twin_url' ) );
	$warn   = trim( (string) eaw_mod( 'twin_disclaimer' ) );
	?>
<section class="glass-panel hm-panel hp-modes hp-twin" id="wing-twin" aria-labelledby="hp-twin-title">
	<?php eaw_homeplus_head( 'hp-twin-title', eaw_mod( 'home_twin_title' ), eaw_mod( 'home_twin_sub' ) ); ?>
	<div class="hp-modes-body">
		<div class="hp-modes-panels">
			<div class="hp-mode hp-mode--3">
				<?php if ( '' !== $img ) : ?>
					<?php $info = eaw_media_info( $img, 1200, 675 ); ?>
					<figure class="hp-shot">
						<span class="hp-shot-frame">
							<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( trim( (string) eaw_mod( 'home_twin_img_alt' ) ) ); ?>" width="<?php echo (int) $info['width']; ?>" height="<?php echo (int) $info['height']; ?>" loading="lazy" decoding="async">
						</span>
					</figure>
				<?php endif; ?>
				<div class="hp-mode-copy">
					<p class="hp-mode-name"><?php echo esc_html( $name ); ?></p>
					<?php if ( '' !== trim( (string) eaw_mod( 'home_twin_heading' ) ) ) : ?>
						<h3 class="hp-h3"><?php echo esc_html( eaw_mod( 'home_twin_heading' ) ); ?></h3>
					<?php endif; ?>
					<?php if ( '' !== trim( (string) eaw_mod( 'home_twin_text' ) ) ) : ?>
						<p><?php echo esc_html( eaw_mod( 'home_twin_text' ) ); ?></p>
					<?php endif; ?>
					<?php if ( $points ) : ?>
						<ul class="hp-checks">
							<?php foreach ( $points as $point ) : ?>
								<li><?php echo eaw_icon( 'check', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $point ); ?></span></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( '' !== $url && '' !== trim( (string) eaw_mod( 'home_twin_btn' ) ) ) : ?>
						<div class="hp-actions"><?php eaw_home_btn( eaw_mod( 'home_twin_btn' ), $url, 'btn btn-ghost hm-btn hm-btn--sm', 'arrow-ur' ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if ( '' !== $warn ) : ?>
		<p class="hm-note"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $warn ); ?></span></p>
	<?php endif; ?>
</section>
	<?php
}
