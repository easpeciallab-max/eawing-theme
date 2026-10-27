<?php
/**
 * EA WING · สินค้า WING TWIN (เพิ่ม 19 ต.ค. 2026)
 *
 * - หน้าสินค้า /wing-twin/ (template-twin.php → eaw_products_page( 'twin' )): หัวเพจ + การ์ดข้อมูลสินค้า (twin_stat1..8) + เนื้อหายาวจาก inc/content/pages/wing-twin.html
 * - การ์ดดาวน์โหลดในขั้น 4 ของหน้า /go (go_twin_*) และการ์ดในส่วนสินค้าหน้าแรก (home_twin_*) · ลำดับตามเลขรุ่น (products.php)
 * - ภาพรายงาน MT5 ของชุด WING LIFE ขนาด N 1 และ N 2 [eawing_figure name="twin-n1|twin-n2"] และชื่อไฟล์ผ่าน [eawing_ea product="twin"]
 *
 * ข้อเท็จจริงทุกข้อมาจากชุดของเจ้าของ D:/EA VIDEO/EA META DATA/EA WING/EA FILE DOWNLOAD/WING_TWIN_V6.3/
 * (อ่านก่อน - WING TWIN 6.3.txt · คู่มือการใช้งาน PDF · รายงาน MT5 N1 และ N2 · รุ่น 6.3 ตั้งแต่ 27 ต.ค. 2026) · ใช้ตัวเลขผลทดสอบเมื่อไหร่ต้องมีเงื่อนไข
 * ทรุดหนักสุดของชุดเดียวกัน สัดส่วนกำไรจากช่วงราคาจำลอง 5 วันที่ไม่เริ่มรอบใหม่ (เลือกจากผลย้อนหลัง) และคำว่าไม่มีตัดขาดทุน
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
			'twin_version'      => '6.3',

			/* ---------- หน้า /wing-twin/ ---------- */
			'twin_sub'          => 'EA เทรดทองคำ XAUUSD อัตโนมัติบน MT5 อีกหนึ่ง EA ของ EA WING ทำงานด้วยเครื่องยนต์ DUAL GRID (กริดสองทาง) ชุด WING LIFE ชุดเดียว ตะกร้าที่ค้างเกิน 90 นาทีเพิ่มไม้กู้แล้วปิดที่เสมอตัว เลือกขนาด N 1 ถึง 16 ไม่มีการตัดขาดทุน อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'twin_hero_img'     => 'assets/img/products/wing-twin-card-v2.webp',
			'twin_dl_url'       => 'assets/downloads/WING_TWIN_V6.3.zip',
			'twin_dl_label'     => 'ดาวน์โหลด WING TWIN V6.3',
			'twin_stat1_label'  => 'เครื่องยนต์',
			'twin_stat1_value'  => 'DUAL GRID + ไม้กู้',
			'twin_stat2_label'  => 'กราฟ',
			'twin_stat2_value'  => 'XAUUSD.s · M1',
			'twin_stat3_label'  => 'ชนิดบัญชี',
			'twin_stat3_value'  => 'Hedging · สกุล USD',
			'twin_stat4_label'  => 'ชุดค่าในตัว',
			'twin_stat4_value'  => 'WING LIFE ชุดเดียว',
			'twin_stat5_label'  => 'ทุนในผลทดสอบ',
			'twin_stat5_value'  => '10,000 USD ที่ N 1',
			'twin_stat6_label'  => 'ไม้กู้',
			'twin_stat6_value'  => 'ค้างเกิน 90 นาที · ฝั่งละไม่เกิน 9 ไม้',
			'twin_stat7_label'  => 'ขนาด N',
			'twin_stat7_value'  => '1 / 2 / 4 / 8 / 16 (N 1 = 0.02 lot)',
			'twin_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'twin_stat8_value'  => 'ไม่มี',
			'twin_note'         => 'เงินในบัญชีต้องรับติดลบลอยของขนาด N ที่เลือกได้ตั้งแต่วันแรก ผลทดสอบ N 1 ทุน 10,000 USD ติดลบลอยสูงสุด 13,566.10 USD ผู้เริ่มใหม่ควรเริ่มที่ N 1 · ใช้บัญชี Hedging ที่ทอง 1 lot = 100 oz (XAUUSD.s) ไม่แนะนำบัญชีเซนต์ · WING TWIN เป็นสินค้าคนละตัวกับ EA WING 5.0 ใช้บัญชีและทุนต่างกัน',
			'twin_disclaimer'   => 'ไม่มีตัดขาดทุน · ผลทดสอบย้อนหลังไม่ใช่สัญญาว่าจะได้กำไร · การเทรดทองคำมีความเสี่ยงสูง อาจเสียเงินทั้งหมด',
			'twin_cta_title'    => 'สนใจ WING TWIN หรืออยากรู้ว่าขนาด N ไหนเข้ากับเงินในบัญชี',
			'twin_cta_text'     => 'แพ็กเกจเดียวใช้ได้ทั้ง 3 ตัว บัญชีที่ได้สิทธิ์แล้วใช้ WING TWIN ได้เลย ทักทีมงานทาง LINE ถามว่าขนาด N ไหนเข้ากับบัญชีของคุณ และขอเปิดสิทธิ์ใช้งาน ส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์มาได้เลย',

			/* ---------- การ์ดดาวน์โหลดในหน้า /go ---------- */
			'go_twin_img'       => 'assets/img/products/wing-twin-go-card-v2.webp',
			'go_twin_url'       => 'assets/downloads/WING_TWIN_V6.3.zip',
			'go_twin_alt'       => 'ดาวน์โหลด EA WING TWIN Expert Advisor สำหรับ MT5',
			'go_twin_label'     => 'ดาวน์โหลด WING TWIN V6.3',
			'go_twin_version'   => 'V6.3',
			'go_twin_info_label' => 'อ่านก่อนใช้ WING TWIN',
			'go_twin_info_url'  => '/wing-twin/',

			/* ---------- การ์ดในส่วนสินค้าหน้าแรก ---------- */
			'home_twin_name'    => 'WING TWIN',
			'home_twin_heading' => 'กริดสองทาง พร้อมไม้กู้ตะกร้าค้าง',
			'home_twin_text'    => 'ราคาวิ่งครบระยะกริดเมื่อไหร่ EA เปิดออเดอร์ตามทางที่ราคาวิ่ง ถ้าราคากลับทิศจะเปิดออเดอร์ฝั่งตรงข้ามที่ใหญ่กว่า แล้วปิดทุกออเดอร์พร้อมกันเมื่อกำไรลอยรวมถึงเป้า ตะกร้าที่ค้างเกิน 90 นาทีเพิ่มไม้กู้ที่ขอบกรอบราคาแล้วปิดที่เสมอตัว ใช้บัญชี Hedging บนกราฟ XAUUSD.s',
			'home_twin_points'  => "ชุด WING LIFE ชุดเดียว · ขนาด N 1 / 2 / 4 / 8 / 16 (N 1 = ไม้แรก 0.02 lot)\nผลทดสอบ N 1 ใช้ทุน 10,000 USD ติดลบลอยสูงสุด 13,566.10 USD\nไม่มีการตัดขาดทุน ไม้กู้เพิ่ม lot เข้าตะกร้า ราคาลากต่อเสียหายหนักได้",
			'home_twin_img'     => 'assets/img/products/wing-twin-go-card-v2.webp',
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
		'title'       => '36) สินค้า WING TWIN (หน้า /wing-twin/ · การ์ด /go · หน้าแรก)',
		'description' => 'ลำดับสินค้าในหน้าแรก /go และเมนูเรียงตามเลขรุ่นเอง · เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/wing-twin.html (EA WING Setup) · เปลี่ยนรุ่น = แก้เลขรุ่น + ลิงก์ไฟล์ zip ทั้งสองช่อง + ภาพรายงาน MT5 (ขึ้นชื่อไฟล์ใหม่)',
		'fields'      => array_merge(
			array(
				'twin_version'  => array( 'เลขรุ่นของไฟล์ (เช่น 6.3 · ชื่อไฟล์ในเนื้อหาเป็น WING_TWIN_V6.3.ex5 ผ่าน [eawing_ea product="twin"])', 'text' ),
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
				'home_twin_name'    => array( 'หน้าแรก การ์ดสินค้า · ชื่อ (เลขรุ่นต่อท้ายให้เอง)', 'text' ),
				'home_twin_heading' => array( 'หน้าแรก การ์ดสินค้า · หัวข้อย่อย', 'text' ),
				'home_twin_text'    => array( 'หน้าแรก การ์ดสินค้า · คำอธิบาย', 'textarea', $rule ),
				'home_twin_points'  => array( 'หน้าแรก การ์ดสินค้า · จุดสำคัญ (บรรทัดละ 1 ข้อ)', 'textarea', $rule ),
				'home_twin_img'     => array( 'หน้าแรก การ์ดสินค้า · ภาพ (2:1)', 'image' ),
				'home_twin_img_alt' => array( 'หน้าแรก การ์ดสินค้า · คำอธิบายภาพ (alt)', 'text' ),
				'home_twin_btn'     => array( 'หน้าแรก การ์ดสินค้า · ข้อความปุ่ม', 'text' ),
				'home_twin_url'     => array( 'หน้าแรก การ์ดสินค้า · ลิงก์ปุ่ม', 'path', 'slug ในเว็บ เช่น /wing-twin/' ),
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
	return '' !== $v ? $v : '6.3';
}

function eaw_twin_name() {
	return 'WING_TWIN_V' . eaw_twin_version();
}

/* รายงาน MT5 ของชุด WING LIFE ขนาด N 1 และ N 2 (assets/img/results/ · ส่วน Results หน้า 2 ต่อด้วยกราฟ Balance หน้า 3 ของรายงานเดียวกัน ไม่ตัดต่อตัวเลข) */
add_filter(
	'eaw_figure_registry',
	function ( $figs ) {
		$sizes = array(
			1 => array( '10,000', '199,699.44', '1.15', '83.53%', '13,566.10', '96,635' ),
			2 => array( '20,000', '398,731.48', '1.14', '83.53%', '41,845.90', '96,517' ),
		);
		foreach ( $sizes as $n => $s ) {
			$figs[ 'twin-n' . $n ] = array(
				'../results/eawing-twin63-n' . $n . '-v1.webp',
				'',
				sprintf( 'ส่วน Results ของรายงาน Strategy Tester ของ WING TWIN 6.3 ชุด WING LIFE ขนาด N %1$d ช่วง 1 ม.ค. ถึง 30 ก.ย. 2026: Initial Deposit %2$s Total Net Profit %3$s Profit Factor %4$s Equity Drawdown Relative %5$s Equity Drawdown Maximal %6$s Total Trades %7$s และกราฟ Balance', $n, $s[0], $s[1], $s[2], $s[3], $s[4], $s[5] ),
				1120,
				893,
			);
		}
		return $figs;
	}
);
