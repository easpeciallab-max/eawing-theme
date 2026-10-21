<?php
/**
 * EA WING · สินค้า WING NITRO 4.2 (เพิ่ม 21 ต.ค. 2026)
 *
 * - หน้าสินค้า /wing-nitro/ (template-nitro.php → eaw_products_page( 'nitro' ) ใน products.php): หัวเพจ + การ์ดข้อมูล (nitro_stat1..8)
 *   + เนื้อหายาวจาก inc/content/pages/wing-nitro.html
 * - การ์ดดาวน์โหลดในขั้น 4 ของหน้า /go (go_nitro_*) และการ์ดในส่วนสินค้าหน้าแรก (home_nitro_*) · ลำดับตามเลขรุ่น (eaw_products())
 * - ภาพรายงาน MT5 [eawing_figure name="nitro-report"] · ภาพแดชบอร์ดตัวอย่าง [eawing_figure name="nitro-dashboard"]
 * - ชื่อไฟล์และช่วง Backtest ผ่าน [eawing_ea product="nitro" field="name|version|bt_range"]
 *
 * ข้อเท็จจริงทุกข้อมาจากชุดของเจ้าของ D:/EA VIDEO/EA META DATA/EA WING/EA FILE DOWNLOAD/WING_NITRO_V4.2/
 * (คู่มือลูกค้า PDF · วิธีใช้ · มีอะไรใหม่ · สรุปผลทดสอบ PDF · รายงาน MT5 · คำแคมเปญขาย) · ใช้ตัวเลขผลทดสอบเมื่อไหร่ต้องมีเงื่อนไข
 * ติดลบลอยสูงสุดคู่กับกำไร ปฏิทินวันงดเทรดที่รู้ล่วงหน้า สัดส่วนกำไรจากช่วงราคาจำลอง และคำว่าไม่มีจุดตัดขาดทุน
 * ห้ามใช้ % ต่อเดือน ผลรายเดือน ผลรอบทดสอบเพิ่ม (ทุนอื่น ตัวคูณอื่น) และรูปพร้อมโพสต์
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'eaw_defaults', 'eaw_nitro_defaults' );

function eaw_nitro_defaults( $d ) {
	return array_merge(
		$d,
		array(
			/* ---------- รุ่นของไฟล์และช่วง Backtest (ใช้ใน [eawing_ea product="nitro"]) ---------- */
			'nitro_version'      => '4.2',
			'nitro_bt_from'      => '2026.01.01',
			'nitro_bt_to'        => '2026.08.31',

			/* ---------- หน้า /wing-nitro/ ---------- */
			'nitro_sub'          => 'EA เทรดทองคำ XAUUSD อัตโนมัติบน MT5 มีชุดเดียวคือ NITRO (บินสูง · เน้นทำกำไร) ฝังในตัว ไม่ต้องเลือกโหมดหรือโหลดไฟล์ .set เปิดไม้เป็นตะกร้า ราคาสวนทางเติมไม้แก้และทบขนาดไม้ (ระบบมาร์ติงเกล) ไม่มีจุดตัดขาดทุน ขนาดไม้ตั้งด้วยระบบคูณ x1 ถึง x60 อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'nitro_hero_img'     => 'assets/img/products/wing-nitro-card-v2.webp',
			'nitro_dl_url'       => 'assets/downloads/WING_NITRO_V4.2.zip',
			'nitro_dl_label'     => 'ดาวน์โหลด WING NITRO V4.2',
			'nitro_stat1_label'  => 'ชุดค่าในตัว',
			'nitro_stat1_value'  => 'NITRO ชุดเดียว',
			'nitro_stat2_label'  => 'กราฟ',
			'nitro_stat2_value'  => 'XAUUSD · M1',
			'nitro_stat3_label'  => 'ระบบคูณ',
			'nitro_stat3_value'  => 'x1 ถึง x60',
			'nitro_stat4_label'  => 'เงินในบัญชีต่อ x1',
			'nitro_stat4_value'  => '15,000',
			'nitro_stat5_label'  => 'บัญชีเซนต์',
			'nitro_stat5_value'  => 'เริ่ม 15,000 เซนต์',
			'nitro_stat6_label'  => 'บัญชี USD',
			'nitro_stat6_value'  => '100,000 USD ขึ้นไป',
			'nitro_stat7_label'  => 'หลบข่าวแดง USD',
			'nitro_stat7_value'  => 'ก่อน 90 · หลัง 720 นาที',
			'nitro_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'nitro_stat8_value'  => 'ไม่มี',
			'nitro_note'         => 'ทุนคิดไม้ 10,000 ต่อเงินในบัญชี 15,000 คือ x1 เงินส่วนที่เกินทุนคิดไม้คือเงินกันชน · บัญชีที่ได้สิทธิ์ EA WING 5.0 แล้วใช้ WING NITRO ได้เลย ไม่ต้องขอสิทธิ์ใหม่ · ห้ามรันคู่กับไม้มือหรือ EA ตัวอื่นบนทองตัวเดียวกันในบัญชีเดียวกัน',
			'nitro_disclaimer'   => 'ระบบทบไม้ไม่มีจุดตัดขาดทุน อาจสูญเสียเงินทุนทั้งหมด · ผลทดสอบมีปฏิทินวันงดเทรดที่เลือกไว้ล่วงหน้าและช่วงราคาจำลอง จึงดีกว่าที่ควรคาดหวังตอนรันจริง · ผลในอดีตไม่ใช่สิ่งยืนยันผลในอนาคต',
			'nitro_cta_title'    => 'สนใจ WING NITRO หรืออยากรู้ว่าตัวคูณไหนเข้ากับเงินในบัญชี',
			'nitro_cta_text'     => 'บัญชีที่ใช้ EA WING 5.0 อยู่แล้วใช้ WING NITRO ได้ทันที ถ้ายังไม่มีสิทธิ์ ส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์ให้ทีมงานทาง LINE แล้วถามเรื่องเงินในบัญชีที่เหมาะกับคุณได้เลย',

			/* ---------- การ์ดดาวน์โหลดในหน้า /go ---------- */
			'go_nitro_img'        => 'assets/img/products/wing-nitro-go-card-v2.webp',
			'go_nitro_url'        => 'assets/downloads/WING_NITRO_V4.2.zip',
			'go_nitro_alt'        => 'ดาวน์โหลด WING NITRO Expert Advisor สำหรับ MT5',
			'go_nitro_label'      => 'ดาวน์โหลด WING NITRO V4.2',
			'go_nitro_version'    => 'V4.2',
			'go_nitro_info_label' => 'อ่านก่อนใช้ WING NITRO',
			'go_nitro_info_url'   => '/wing-nitro/',

			/* ---------- การ์ดในส่วนสินค้าหน้าแรก ---------- */
			'home_nitro_name'    => 'WING NITRO',
			'home_nitro_heading' => 'ชุดเดียว บินสูง เน้นทำกำไร',
			'home_nitro_text'    => 'เปิดไม้เป็นตะกร้า ราคาสวนทางเติมไม้แก้เป็นขั้นบันไดและทบขนาดไม้ แล้วปิดทั้งตะกร้าเมื่อกำไรรวมถึงเป้า ขนาดไม้ตั้งด้วยระบบคูณ x1 ถึง x60',
			'home_nitro_points'  => "ชุด NITRO ฝังในตัว ไม่ต้องเลือกโหมดหรือโหลดไฟล์ .set\nเงินในบัญชี 15,000 ต่อ x1 · บัญชีเซนต์เริ่ม 15,000 เซนต์ · บัญชี USD ต้องมี 100,000 USD ขึ้นไป\nระบบมาร์ติงเกล ไม่มีจุดตัดขาดทุน",
			'home_nitro_img'     => 'assets/img/products/wing-nitro-go-card-v2.webp',
			'home_nitro_img_alt' => 'การ์ดสินค้า WING NITRO Expert Advisor สำหรับ MT5',
			'home_nitro_btn'     => 'ดูรายละเอียด WING NITRO',
			'home_nitro_url'     => '/wing-nitro/',
		)
	);
}

/* ==============================================================
 * Customizer
 * ============================================================== */

add_filter( 'eaw_customizer_sections', 'eaw_nitro_customizer_sections', 12, 2 );

function eaw_nitro_customizer_sections( $sections, $d ) {
	$rule  = 'ใช้ข้อเท็จจริงจากชุดเอกสารของเจ้าของเท่านั้น · ตัวเลขผลต้องมาคู่กับติดลบลอยสูงสุดและเงื่อนไขทดสอบ · ไม่ใช้ % ต่อเดือน';
	$stats = array();
	for ( $i = 1; $i <= 8; $i++ ) {
		$stats[ 'nitro_stat' . $i . '_label' ] = array( 'การ์ดข้อมูล ' . $i . ' · หัวข้อ (ว่าง = ซ่อน)', 'text' );
		$stats[ 'nitro_stat' . $i . '_value' ] = array( 'การ์ดข้อมูล ' . $i . ' · ค่า', 'text' );
	}
	$sections['eaw_nitro'] = array(
		'title'       => '35) สินค้า WING NITRO (หน้า /wing-nitro/ · การ์ด /go · หน้าแรก)',
		'description' => 'เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/wing-nitro.html (EA WING Setup) · ลำดับสินค้าในหน้าแรก /go และเมนูเรียงตามเลขรุ่นเอง · เปลี่ยนรุ่น = แก้เลขรุ่น ช่วง Backtest ลิงก์ไฟล์ zip ทั้งสองช่อง และภาพรายงาน MT5',
		'fields'      => array_merge(
			array(
				'nitro_version'  => array( 'เลขรุ่นของไฟล์ (เช่น 4.2 · ชื่อไฟล์ในเนื้อหาเป็น WING_NITRO_V4.2.ex5 ผ่าน [eawing_ea product="nitro"])', 'text' ),
				'nitro_bt_from'  => array( 'ช่วง Backtest มาตรฐาน · วันเริ่ม (รูปแบบ 2026.01.01)', 'text' ),
				'nitro_bt_to'    => array( 'ช่วง Backtest มาตรฐาน · วันจบ (รูปแบบ 2026.08.31)', 'text' ),
				'nitro_sub'      => array( 'หน้าสินค้า · คำอธิบายใต้ชื่อ', 'textarea', $rule ),
				'nitro_hero_img' => array( 'หน้าสินค้า · ภาพการ์ดสินค้าในหัวเพจ', 'image' ),
				'nitro_dl_url'   => array( 'หน้าสินค้า · ลิงก์ดาวน์โหลดไฟล์ zip (ว่าง = ไม่มีปุ่ม)', 'path' ),
				'nitro_dl_label' => array( 'หน้าสินค้า · ข้อความปุ่มดาวน์โหลด', 'text' ),
			),
			$stats,
			array(
				'nitro_note'          => array( 'หน้าสินค้า · หมายเหตุใต้การ์ดข้อมูล', 'textarea' ),
				'nitro_disclaimer'    => array( 'หน้าสินค้า · คำเตือนใต้การ์ดข้อมูล (ห้ามลบ)', 'textarea' ),
				'nitro_cta_title'     => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · หัวข้อ', 'text' ),
				'nitro_cta_text'      => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · คำอธิบาย', 'textarea' ),
				'go_nitro_img'        => array( 'หน้า /go · ภาพการ์ดดาวน์โหลด WING NITRO (2:1)', 'image' ),
				'go_nitro_url'        => array( 'หน้า /go · ลิงก์ไฟล์ WING NITRO (ว่าง = ไม่แสดงการ์ด)', 'path' ),
				'go_nitro_alt'        => array( 'หน้า /go · คำอธิบายภาพการ์ด (alt)', 'text' ),
				'go_nitro_label'      => array( 'หน้า /go · ข้อความปุ่มดาวน์โหลด', 'text' ),
				'go_nitro_version'    => array( 'หน้า /go · เลขเวอร์ชันบนการ์ด (ว่าง = ไม่แสดงป้าย)', 'text' ),
				'go_nitro_info_label' => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ข้อความ (ว่าง = ไม่มีปุ่ม)', 'text' ),
				'go_nitro_info_url'   => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ลิงก์', 'path' ),
				'home_nitro_name'     => array( 'หน้าแรก การ์ดสินค้า · ชื่อ (เลขรุ่นต่อท้ายให้เอง)', 'text' ),
				'home_nitro_heading'  => array( 'หน้าแรก การ์ดสินค้า · หัวข้อย่อย', 'text' ),
				'home_nitro_text'     => array( 'หน้าแรก การ์ดสินค้า · คำอธิบาย', 'textarea', $rule ),
				'home_nitro_points'   => array( 'หน้าแรก การ์ดสินค้า · จุดสำคัญ (บรรทัดละ 1 ข้อ)', 'textarea', $rule ),
				'home_nitro_img'      => array( 'หน้าแรก การ์ดสินค้า · ภาพ (2:1)', 'image' ),
				'home_nitro_img_alt'  => array( 'หน้าแรก การ์ดสินค้า · คำอธิบายภาพ (alt)', 'text' ),
				'home_nitro_btn'      => array( 'หน้าแรก การ์ดสินค้า · ข้อความปุ่ม', 'text' ),
				'home_nitro_url'      => array( 'หน้าแรก การ์ดสินค้า · ลิงก์ปุ่ม', 'path', 'slug ในเว็บ เช่น /wing-nitro/' ),
			)
		),
	);
	return $sections;
}

/* ==============================================================
 * ตัวช่วย
 * ============================================================== */

function eaw_nitro_version() {
	$v = preg_replace( '/[^0-9.]/', '', (string) eaw_mod( 'nitro_version' ) );
	return '' !== $v ? $v : '4.2';
}

/* รายงาน MT5 (ส่วน Results ตั้งแต่บรรทัด Company + กราฟ Balance ของรายงานฉบับเดียวกัน) และแดชบอร์ดตัวอย่างจากคู่มือลูกค้า */
add_filter(
	'eaw_figure_registry',
	function ( $figs ) {
		$figs['nitro-report']    = array(
			'../results/eawing-nitro-report-v1.webp',
			'',
			'ส่วน Results และกราฟ Balance ของรายงาน Strategy Tester ของ WING NITRO 4.2 บน XAUUSD.c ช่วง 1 ม.ค. ถึง 31 ส.ค. 2026: Initial Deposit 10,000 Leverage 1:2000 Total Net Profit 122,230.66 Profit Factor 2.18 Equity Drawdown Maximal 14,762.52 (16.63%) Equity Drawdown Relative 28.27% Total Trades 37,926',
			1070,
			807,
		);
		$figs['nitro-dashboard'] = array(
			'../install/eawing-nitro-dashboard-v1.webp',
			'',
			'แดชบอร์ด WING NITRO ฝั่งซ้ายจากคู่มือลูกค้า: แถว AutoTrading การ์ดล็อกอินสีเขียว ยอดเงิน ข่าวแดงถัดไป กล่องโหมด NITRO ปุ่มหยุดเปิดไม้ใหม่ บรรทัดสถานะ และแถบติดลบ',
			560,
			736,
			true,
		);
		return $figs;
	}
);
