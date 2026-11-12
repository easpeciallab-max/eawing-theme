<?php
/**
 * EA WING · สินค้า WING BTC (เพิ่ม 12 พ.ย. 2026)
 *
 * - หน้าสินค้า /wing-btc/ (template-btc.php → eaw_products_page( 'btc' )): หัวเพจ + การ์ดข้อมูลสินค้า (btc_stat1..8) + เนื้อหายาวจาก inc/content/pages/wing-btc.html
 * - การ์ดดาวน์โหลดในขั้น 4 ของหน้า /go (go_btc_*) และการ์ดในส่วนสินค้าหน้าแรก (home_btc_*) · ลำดับตามเลขรุ่น (products.php)
 * - ภาพส่วนขนาด LOT ของแดชบอร์ด [eawing_figure name="btc-lot"] และชื่อไฟล์ผ่าน [eawing_ea product="btc"]
 *
 * ข้อเท็จจริงทุกข้อมาจากชุดของเจ้าของ D:/EA VIDEO/EA META DATA/EA WING/EA FILE DOWNLOAD/WING_BTC_V2.1/
 * (อ่านก่อน WING BTC 2.1.md · รายงานผลทดสอบ LOTx1 และ LOTx32 · คู่มือการตลาดสำหรับแอดมิน) · ใช้ตัวเลขผลทดสอบเมื่อไหร่ต้องมี
 * DD สูงสุดของขนาดเดียวกัน ทุนที่ใช้ทดสอบ บรรทัดเงื่อนไข (ราคาจำลอง 15 ม.ค. ถึง 3 มิ.ย.) และคำว่าไม่มีตัดขาดทุน
 * ใช้ตัวเลขของ LOTx1 / LOTx32 เท่านั้น · ไม่ลงผลรายเดือนและ % ต่อเดือน · ห้ามแนะนำทุนต่ำกว่า 3,125 ต่อ LOTx1
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'eaw_defaults', 'eaw_btc_defaults' );

function eaw_btc_defaults( $d ) {
	return array_merge(
		$d,
		array(
			/* ---------- รุ่นของไฟล์ (ใช้ใน [eawing_ea product="btc"]) ---------- */
			'btc_version'      => '2.1',

			/* ---------- หน้า /wing-btc/ ---------- */
			'btc_sub'          => 'EA เทรด Bitcoin (BTCUSD) อัตโนมัติบน MT5 ระบบกริดชุด SKY ฝังในตัว ระยะกริดขยายเองตามแรงตลาด ตะกร้าที่ค้างนานมีไม้ช่วยปิดที่เสมอตัว ปรับขนาด LOTx1 ถึง LOTx64 บนหน้าจอ ไม่มีการตัดขาดทุน อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'btc_hero_img'     => '',
			'btc_dl_url'       => 'assets/downloads/WING_BTC_V2.1.zip',
			'btc_dl_label'     => 'ดาวน์โหลด WING BTC V2.1',
			'btc_stat1_label'  => 'ระบบ',
			'btc_stat1_value'  => 'กริด ชุด SKY',
			'btc_stat2_label'  => 'กราฟ',
			'btc_stat2_value'  => 'BTCUSD · M1',
			'btc_stat3_label'  => 'ชนิดบัญชี',
			'btc_stat3_value'  => 'Hedging · เซนต์หรือ USD',
			'btc_stat4_label'  => 'ขนาด LOT',
			'btc_stat4_value'  => 'LOTx1 ถึง LOTx64',
			'btc_stat5_label'  => 'ทุนต่อ LOTx1',
			'btc_stat5_value'  => '3,125 (เซนต์ = USC · USD = USD)',
			'btc_stat6_label'  => 'เริ่มรอบใหม่',
			'btc_stat6_value'  => '14:00 ถึง 24:00 น. ไทย',
			'btc_stat7_label'  => 'ตะกร้าค้างเกิน 3 ชม.',
			'btc_stat7_value'  => 'ไม้ช่วยปิดที่เสมอตัว',
			'btc_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'btc_stat8_value'  => 'ไม่มี',
			'btc_note'         => 'ทุนต้องไม่น้อยกว่าที่หน้าจอบอก คือ 3,125 ต่อ LOTx1 (บัญชีเซนต์นับเป็น USC บัญชี USD นับเป็น USD) กดปุ่ม "จัด LOT อัตโนมัติจากเงินในบัญชี" ให้ EA เลือกขนาดให้ได้ · ใช้กราฟ BTCUSD.c หรือ BTCUSD.s ไม่ใช่กราฟทอง จึงเป็นคนละสินค้ากับ EA WING และ WING TWIN',
			'btc_disclaimer'   => 'ไม่มี SL ไม่ตัดขาดทุน · ผลทดสอบย้อนหลังไม่ใช่สัญญาว่าจะได้กำไรในอนาคต · BTC ผันผวนสูง เงินลงทุนลดลงได้มากในช่วงที่ราคาวิ่งทางเดียว · ใช้เงินที่เสียได้เท่านั้น',
			'btc_cta_title'    => 'สนใจ WING BTC หรืออยากรู้ว่าขนาด LOT ไหนเข้ากับเงินในบัญชี',
			'btc_cta_text'     => 'แพ็กเกจเดียวใช้ได้ทุกตัว บัญชีที่ได้สิทธิ์แล้วใช้ WING BTC ได้เลย ทักทีมงานทาง LINE ถามเรื่องขนาด LOT และขอเปิดสิทธิ์ใช้งาน ส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์มาได้เลย ทดลองกับบัญชีเดโมก่อนก็ได้',

			/* ---------- การ์ดดาวน์โหลดในหน้า /go ---------- */
			'go_btc_img'       => '',
			'go_btc_url'       => 'assets/downloads/WING_BTC_V2.1.zip',
			'go_btc_alt'       => 'ดาวน์โหลด EA WING BTC Expert Advisor สำหรับ MT5',
			'go_btc_label'     => 'ดาวน์โหลด WING BTC V2.1',
			'go_btc_version'   => 'V2.1',
			'go_btc_info_label' => 'อ่านก่อนใช้ WING BTC',
			'go_btc_info_url'  => '/wing-btc/',

			/* ---------- การ์ดในส่วนสินค้าหน้าแรก ---------- */
			'home_btc_name'    => 'WING BTC',
			'home_btc_heading' => 'กริด Bitcoin ชุด SKY',
			'home_btc_text'    => 'ระบบกริดบนกราฟ BTCUSD M1 ระยะกริดขยายเองตามแรงตลาด ราคาวิ่งสวนจะทบ lot แล้วปิดทั้งรอบเมื่อกำไรลอยถึงเป้า ตะกร้าที่ค้างเกิน 3 ชั่วโมงใช้ไม้ช่วยปิดที่เสมอตัว ปรับขนาด LOT บนหน้าจอ และหน้าจอบอกทุนที่ต้องใช้',
			'home_btc_points'  => "ขนาด LOTx1 ถึง LOTx64 · ทุน 3,125 ต่อ LOTx1 (เซนต์ = USC)\nใช้ได้ทั้งบัญชีเซนต์และบัญชี USD แบบ Hedging\nไม่มีการตัดขาดทุน BTC ผันผวนสูง ราคาวิ่งทางเดียวเสียหายหนักได้",
			'home_btc_img'     => '',
			'home_btc_img_alt' => 'การ์ดสินค้า EA WING BTC Expert Advisor สำหรับ MT5',
			'home_btc_btn'     => 'ดูรายละเอียด WING BTC',
			'home_btc_url'     => '/wing-btc/',
		)
	);
}

/* ==============================================================
 * Customizer
 * ============================================================== */

add_filter( 'eaw_customizer_sections', 'eaw_btc_customizer_sections', 12, 2 );

function eaw_btc_customizer_sections( $sections, $d ) {
	$rule   = 'ใช้ข้อเท็จจริงจากชุดเอกสารของเจ้าของเท่านั้น · ตัวเลขผลต้องมาคู่กับ DD สูงสุดของขนาดเดียวกัน ทุนที่ใช้ทดสอบ และเงื่อนไขทดสอบ';
	$stats  = array();
	for ( $i = 1; $i <= 8; $i++ ) {
		$stats[ 'btc_stat' . $i . '_label' ] = array( 'การ์ดข้อมูล ' . $i . ' · หัวข้อ (ว่าง = ซ่อน)', 'text' );
		$stats[ 'btc_stat' . $i . '_value' ] = array( 'การ์ดข้อมูล ' . $i . ' · ค่า', 'text' );
	}
	$sections['eaw_btc'] = array(
		'title'       => '38) สินค้า WING BTC (หน้า /wing-btc/ · การ์ด /go · หน้าแรก)',
		'description' => 'ลำดับสินค้าในหน้าแรก /go และเมนูเรียงตามเลขรุ่นเอง · เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/wing-btc.html (EA WING Setup) · เปลี่ยนรุ่น = แก้เลขรุ่น + ลิงก์ไฟล์ zip ทั้งสองช่อง + ตัวเลขผลในเนื้อหาเพจ',
		'fields'      => array_merge(
			array(
				'btc_version'  => array( 'เลขรุ่นของไฟล์ (เช่น 2.1 · ชื่อไฟล์ในเนื้อหาเป็น WING_BTC_V2.1.ex5 ผ่าน [eawing_ea product="btc"])', 'text' ),
				'btc_sub'      => array( 'หน้าสินค้า · คำอธิบายใต้ชื่อ', 'textarea', $rule ),
				'btc_hero_img' => array( 'หน้าสินค้า · ภาพการ์ดสินค้าในหัวเพจ (16:9 · ว่าง = ภาพประกอบของธีม)', 'image' ),
				'btc_dl_url'   => array( 'หน้าสินค้า · ลิงก์ดาวน์โหลดไฟล์ zip (ว่าง = ไม่มีปุ่ม)', 'path' ),
				'btc_dl_label' => array( 'หน้าสินค้า · ข้อความปุ่มดาวน์โหลด', 'text' ),
			),
			$stats,
			array(
				'btc_note'          => array( 'หน้าสินค้า · หมายเหตุใต้การ์ดข้อมูล', 'textarea' ),
				'btc_disclaimer'    => array( 'หน้าสินค้า · คำเตือนใต้การ์ดข้อมูล (ห้ามลบ)', 'textarea' ),
				'btc_cta_title'     => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · หัวข้อ', 'text' ),
				'btc_cta_text'      => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · คำอธิบาย', 'textarea' ),
				'go_btc_img'        => array( 'หน้า /go · ภาพการ์ดดาวน์โหลด WING BTC (2:1 · ว่าง = มีแค่ปุ่ม)', 'image' ),
				'go_btc_url'        => array( 'หน้า /go · ลิงก์ไฟล์ WING BTC (ว่าง = ไม่แสดงการ์ด)', 'path' ),
				'go_btc_alt'        => array( 'หน้า /go · คำอธิบายภาพการ์ด (alt)', 'text' ),
				'go_btc_label'      => array( 'หน้า /go · ข้อความปุ่มดาวน์โหลด', 'text' ),
				'go_btc_version'    => array( 'หน้า /go · เลขเวอร์ชันบนการ์ด (ว่าง = ไม่แสดงป้าย)', 'text' ),
				'go_btc_info_label' => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ข้อความ (ว่าง = ไม่มีปุ่ม)', 'text' ),
				'go_btc_info_url'   => array( 'หน้า /go · ปุ่มเล็กใต้การ์ด · ลิงก์', 'path' ),
				'home_btc_name'     => array( 'หน้าแรก การ์ดสินค้า · ชื่อ (เลขรุ่นต่อท้ายให้เอง)', 'text' ),
				'home_btc_heading'  => array( 'หน้าแรก การ์ดสินค้า · หัวข้อย่อย', 'text' ),
				'home_btc_text'     => array( 'หน้าแรก การ์ดสินค้า · คำอธิบาย', 'textarea', $rule ),
				'home_btc_points'   => array( 'หน้าแรก การ์ดสินค้า · จุดสำคัญ (บรรทัดละ 1 ข้อ)', 'textarea', $rule ),
				'home_btc_img'      => array( 'หน้าแรก การ์ดสินค้า · ภาพ (2:1)', 'image' ),
				'home_btc_img_alt'  => array( 'หน้าแรก การ์ดสินค้า · คำอธิบายภาพ (alt)', 'text' ),
				'home_btc_btn'      => array( 'หน้าแรก การ์ดสินค้า · ข้อความปุ่ม', 'text' ),
				'home_btc_url'      => array( 'หน้าแรก การ์ดสินค้า · ลิงก์ปุ่ม', 'path', 'slug ในเว็บ เช่น /wing-btc/' ),
			)
		),
	);
	return $sections;
}

/* ==============================================================
 * ตัวช่วย
 * ============================================================== */

function eaw_btc_version() {
	$v = preg_replace( '/[^0-9.]/', '', (string) eaw_mod( 'btc_version' ) );
	return '' !== $v ? $v : '2.1';
}

/* ภาพส่วนขนาด LOT จากภาพแดชบอร์ดตัวอย่างของเจ้าของ (ภาพ "ภาพหน้าจอ WING BTC 2.1.png" ในชุดการตลาด · ครอปเฉพาะส่วน LOT ไม่แก้ตัวเลข) */
add_filter(
	'eaw_figure_registry',
	function ( $figs ) {
		$figs['btc-lot'] = array( '../install/eawing-btc-lot-v1.webp', '', 'ส่วนขนาด LOT บนหน้าจอ WING BTC: ปุ่มลด LOT และเพิ่ม LOT ขนาดที่ใช้อยู่ ทุนที่ต้องใช้ ปุ่มจัด LOT อัตโนมัติจากเงินในบัญชี DD สูงสุดในผลทดสอบ และ lot สูงสุดของขนาดนั้น', 296, 206, true );
		return $figs;
	}
);
