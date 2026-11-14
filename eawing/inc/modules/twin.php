<?php
/**
 * EA WING · สินค้า WING TWIN (เพิ่ม 19 ต.ค. 2026)
 *
 * - หน้าสินค้า /wing-twin/ (template-twin.php → eaw_products_page( 'twin' )): หัวเพจ + การ์ดข้อมูลสินค้า (twin_stat1..8) + เนื้อหายาวจาก inc/content/pages/wing-twin.html
 * - การ์ดดาวน์โหลดในขั้น 4 ของหน้า /go (go_twin_*) และการ์ดในส่วนสินค้าหน้าแรก (home_twin_*) · ลำดับตามเลขรุ่น (products.php)
 * - ชื่อไฟล์ผ่าน [eawing_ea product="twin"] · รุ่น 26.11 ไม่มีรายงาน MT5 ให้ลูกค้า จึงไม่มีภาพรายงานบนเว็บ (ห้ามใช้รายงานหรือรูปของรุ่นก่อน)
 *
 * ข้อเท็จจริงทุกข้อมาจากชุดของเจ้าของ D:/EA VIDEO/EA META DATA/EA WING/EA FILE DOWNLOAD/WING_TWIN_V26.11/
 * (อ่านก่อน - WING TWIN 26.11.txt · คู่มือการใช้งาน PDF 30 หน้า · เอกสารการตลาดของแอดมิน · รุ่น 26.11 ตั้งแต่ 14 พ.ย. 2026) · ใช้ตัวเลขผลทดสอบเมื่อไหร่ต้องมีเงื่อนไข
 * DD ของขนาดเดียวกัน (คู่แบบไม่ปิดวัน) สัดส่วนกำไรจากช่วงราคาจำลอง 5 วันที่ไม่เริ่มเที่ยวใหม่ (เลือกจากผลย้อนหลัง) และคำว่าไม่มีตัดขาดทุน · ไม่มีทุนแนะนำ
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
			'twin_version'      => '26.11',

			/* ---------- หน้า /wing-twin/ ---------- */
			'twin_sub'          => 'EA เทรดทองคำ XAUUSD อัตโนมัติบน MT5 อีกหนึ่ง EA ของ EA WING ทำงานได้สองทิศ ส่งออเดอร์ตามระยะราคาทั้ง BUY และ SELL แล้วปิดทั้งเที่ยวพร้อมกันที่เป้า เที่ยวที่ค้างเกิน 90 นาทีใช้ออเดอร์กู้แล้วปิดที่เสมอตัว โปรไฟล์ WING LIFE ในตัว เลือกขนาด LOTx1 ถึง LOTx32 ไม่มีการตัดขาดทุน อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'twin_hero_img'     => 'assets/img/products/wing-twin-card-v2.webp',
			'twin_dl_url'       => 'assets/downloads/WING_TWIN_V26.11.zip',
			'twin_dl_label'     => 'ดาวน์โหลด WING TWIN V26.11',
			'twin_stat1_label'  => 'ระบบ',
			'twin_stat1_value'  => 'สองทิศตามระยะ + ออเดอร์กู้',
			'twin_stat2_label'  => 'กราฟ',
			'twin_stat2_value'  => 'XAUUSD.s · M1',
			'twin_stat3_label'  => 'ชนิดบัญชี',
			'twin_stat3_value'  => 'Hedging · สกุล USD',
			'twin_stat4_label'  => 'โปรไฟล์ในตัว',
			'twin_stat4_value'  => 'WING LIFE (ค่าที่ทดสอบ)',
			'twin_stat5_label'  => 'ทุนในตัวทดสอบ (ไม่ใช่ทุนแนะนำ)',
			'twin_stat5_value'  => '20,000 USD ต่อ LOTx1',
			'twin_stat6_label'  => 'ออเดอร์กู้',
			'twin_stat6_value'  => 'เที่ยวค้างเกิน 90 นาที · ฝั่งละไม่เกิน 9',
			'twin_stat7_label'  => 'ขนาด LOT',
			'twin_stat7_value'  => 'LOTx1 ถึง LOTx32 (LOTx1 = 0.02 lot)',
			'twin_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'twin_stat8_value'  => 'ไม่มี',
			'twin_note'         => 'ไม่มีทุนแนะนำ เงินในบัญชีต้องรับ DD ของขนาด LOT ที่เลือกได้ตั้งแต่วันแรก ตัวเลข DD ของแต่ละขนาดพร้อมเงื่อนไขอยู่ในหัวข้อขนาด LOT ด้านล่าง ผู้เริ่มใหม่ควรเริ่มที่ LOTx1 · ใช้บัญชี Hedging ที่ทอง 1 lot = 100 oz (XAUUSD.s) บัญชีเซนต์ยังไม่ได้ทดสอบ · WING TWIN เป็นสินค้าคนละตัวกับ EA WING ใช้บัญชีและทุนต่างกัน',
			'twin_disclaimer'   => 'ไม่มีตัดขาดทุน · ผลทดสอบย้อนหลังไม่ใช่สัญญาว่าจะได้กำไร · การเทรดทองคำมีความเสี่ยงสูง อาจเสียเงินทั้งหมด',
			'twin_cta_title'    => 'สนใจ WING TWIN หรืออยากรู้ว่าขนาด LOT ไหนเข้ากับเงินในบัญชี',
			'twin_cta_text'     => 'แพ็กเกจเดียวใช้ได้ทุกตัว บัญชีที่ได้สิทธิ์แล้วใช้ WING TWIN ได้เลย ทักทีมงานทาง LINE ถามว่าขนาด LOT ไหนเข้ากับบัญชีของคุณ และขอเปิดสิทธิ์ใช้งาน ส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์มาได้เลย',

			/* ---------- การ์ดดาวน์โหลดในหน้า /go ---------- */
			'go_twin_img'       => 'assets/img/products/wing-twin-go-card-v2.webp',
			'go_twin_url'       => 'assets/downloads/WING_TWIN_V26.11.zip',
			'go_twin_alt'       => 'ดาวน์โหลด EA WING TWIN Expert Advisor สำหรับ MT5',
			'go_twin_label'     => 'ดาวน์โหลด WING TWIN V26.11',
			'go_twin_version'   => 'V26.11',
			'go_twin_info_label' => 'อ่านก่อนใช้ WING TWIN',
			'go_twin_info_url'  => '/wing-twin/',

			/* ---------- การ์ดในส่วนสินค้าหน้าแรก ---------- */
			'home_twin_name'    => 'WING TWIN',
			'home_twin_heading' => 'ระบบสองทิศ พร้อมออเดอร์กู้เที่ยวค้าง',
			'home_twin_text'    => 'ราคาวิ่งครบระยะเมื่อไหร่ EA ส่งออเดอร์ตามทางที่ราคาวิ่ง ถ้าราคากลับทิศจะส่งออเดอร์ฝั่งตรงข้ามที่ใหญ่กว่า แล้วปิดทุกออเดอร์ของเที่ยวพร้อมกันเมื่อกำไรลอยรวมถึงเป้า เที่ยวที่ค้างเกิน 90 นาทีใช้ออเดอร์กู้ที่ขอบกรอบราคาแล้วปิดที่เสมอตัว ใช้บัญชี Hedging บนกราฟ XAUUSD.s',
			'home_twin_points'  => "โปรไฟล์ WING LIFE ในตัว · ขนาด LOTx1 ถึง LOTx32 (LOTx1 = ออเดอร์แรก 0.02 lot)\nไม่มีทุนแนะนำ เงินในบัญชีต้องรับ DD ของขนาดที่เลือกได้ตั้งแต่วันแรก\nไม่มีการตัดขาดทุน ออเดอร์กู้เพิ่ม lot ราคาลากต่อเสียหายหนักได้",
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
		'description' => 'ลำดับสินค้าในหน้าแรก /go และเมนูเรียงตามเลขรุ่นเอง · เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/wing-twin.html (EA WING Setup) · เปลี่ยนรุ่น = แก้เลขรุ่น + ลิงก์ไฟล์ zip ทั้งสองช่อง + ป้ายเวอร์ชัน /go',
		'fields'      => array_merge(
			array(
				'twin_version'  => array( 'เลขรุ่นของไฟล์ (เช่น 26.11 · ชื่อไฟล์ในเนื้อหาเป็น WING_TWIN_V26.11.ex5 ผ่าน [eawing_ea product="twin"])', 'text' ),
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
	return '' !== $v ? $v : '26.11';
}

function eaw_twin_name() {
	return 'WING_TWIN_V' . eaw_twin_version();
}
