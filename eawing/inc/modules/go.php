<?php
/**
 * EA WING · โมดูลหน้า /go (ลิงก์รวม) · template-go.php
 *
 * โครงหน้า (ลำดับตามหน้าลิงก์รวมของเว็บในเครือ · หน้าตา Glass Sky: การ์ดกระจกกลางจอ CSS ใน assets/css/go.css):
 *   โลโก้กลม + ชื่อ + คำโปรย + ป้าย → กลุ่มติดต่อทีม (LINE ปุ่มทอง, OpenChat ปุ่มกรมท่า) → ขั้นตอนเริ่มใช้งานเลขทอง 01..
 *   → ข้อมูลก่อนเริ่ม (ปุ่ม 1 ถึง 6) → โซเชียล → เนื้อหาเพจ (ปิดไว้) → คำเตือนความเสี่ยงฉบับเต็ม → ลิงก์เอกสาร + ตั้งค่าคุกกี้
 *
 * กติกา
 * - ขั้นตอนที่ไม่มีปุ่มจะถูกซ่อน และเลขขั้นเรียงใหม่ตามที่เหลือจริง ({n} ในหัวข้อ = จำนวนขั้นที่แสดง)
 * - ปุ่มที่มีข้อความแต่ไม่มีลิงก์ หรือชี้ไปเพจของเว็บที่ยังไม่เผยแพร่ = ปุ่มเส้นประ กดไม่ได้ พร้อมป้าย "เร็ว ๆ นี้"
 * - ปุ่ม LINE ทุกปุ่มใช้ eaw_contact_target() / eaw_contact_button() · ไม่มีลิงก์ LINE = ไม่แสดงปุ่ม
 * - ข้อความทุกคำเป็น setting ในหมวด "30) หน้า /go" และ "31) หน้า /go · ขั้นตอนเริ่มใช้งาน"
 * - คีย์เดิม go_step1..6 ย้ายไปคีย์ใหม่ผ่านค่าเริ่มต้น (ค่าที่เจ้าของเคยบันทึกไว้ยังถูกใช้ต่อ)
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ==============================================================
 * ค่าเริ่มต้น (ข้อความของ EA WING เอง)
 * ============================================================== */

/**
 * ค่าที่เจ้าของเคยบันทึกไว้ในคีย์เดิม (go_step1..6) · ไม่มี = ใช้ค่าใหม่
 */
function eaw_go_legacy( $old_key, $fallback ) {
	$value = get_theme_mod( $old_key, '' );
	return ( is_string( $value ) && '' !== trim( $value ) ) ? $value : $fallback;
}

function eaw_go_defaults( $d ) {
	/* คีย์เดิมของหน้า /go (ชื่อขั้นอย่างเดียว) · ย้ายไปคีย์ใหม่ด้านล่าง */
	foreach ( array( 'go_step1', 'go_step2', 'go_step3', 'go_step4', 'go_step5', 'go_step6' ) as $old ) {
		unset( $d[ $old ] );
	}

	return array_merge(
		$d,
		array(
			/* ส่วนหัวการ์ด */
			'go_logo'                => '',
			'go_title'               => 'EA WING',
			'go_sub'                 => "บินอย่างมีแบบแผน ไปได้ไกลกว่าเดิม\nEA บน MetaTrader 5 พร้อมทีมงานคนไทยช่วยทาง LINE",
			'go_badges'              => "วางแผน\nติดตาม\nบริหารความเสี่ยง",

			/* กลุ่มติดต่อทีม */
			'go_help_title'          => 'ติดขั้นตอนไหน ทักทีมงานได้',
			'go_line_label'          => 'ทัก LINE ปรึกษาทีมงาน',
			'go_openchat_label'      => 'เข้ากลุ่ม EA WING OpenChat',

			/* ขั้นตอน · ส่วนรวม */
			'go_steps_title'         => 'เริ่มใช้งาน EA WING ใน {n} ขั้นตอน',
			'go_step_word'           => 'ขั้นที่',
			'go_pending_label'       => 'กำลังเตรียม',

			/* ขั้น 1 · เปิดบัญชี */
			'go_step1_title'         => eaw_go_legacy( 'go_step1', 'เปิดบัญชี MT5' ),
			'go_step1_desc'          => 'สมัครบัญชี Zaurix จากปุ่มด้านล่าง ยืนยันอีเมลและตัวตน แล้วเก็บเลข Login ไว้ใช้ขั้นถัดไป (ลิงก์พาร์ตเนอร์: หากเปิดบัญชีผ่านลิงก์นี้ Zaurix จะจ่ายค่าตอบแทนให้ EA WING)',
			'go_step1_note'          => '',
			'go_step1_badge'         => '',
			'go_signup_line_label'   => 'ขอลิงก์สมัครทาง LINE',
			'go_account_guide_label' => eaw_go_legacy( 'go_step2', 'วิธีสมัครและยืนยันตัวตน' ),
			'go_account_guide_url'   => '/open-mt5-account/',

			/* ขั้น 2 · แอป MT5 (ลิงก์ร้านแอปใช้คีย์เดิม mt5_dl_*) */
			'go_step2_title'         => eaw_go_legacy( 'go_step3', 'ติดตั้งแอป MT5 และล็อกอิน' ),
			'go_step2_desc'          => 'โหลด MetaTrader 5 ให้ตรงกับเครื่องของคุณ แล้วเข้าบัญชีด้วยข้อมูลสามอย่างจากขั้นแรก คือ Login รหัสผ่าน และ Server',
			'go_step2_note'          => 'แอปบนมือถือมีไว้ดูบัญชีและออเดอร์ ส่วน EA ต้องรันบน MT5 เวอร์ชัน Windows บนคอมหรือ VPS',
			'go_step2_badge'         => '',
			'go_mt5_ios_label'       => 'iPhone',
			'go_mt5_android_label'   => 'Android',
			'go_mt5_windows_label'   => 'Windows',
			'go_mt5_macos_label'     => '',
			'go_mt5_macos_url'       => '',
			'go_mt5_login_label'     => 'คู่มือล็อกอิน MT5 ทีละขั้น',
			'go_mt5_login_url'       => '/mt5-login/',

			/* ขั้น 3 · ฝากเงิน (ไม่มีลิงก์ = ซ่อนทั้งขั้น) */
			'go_step3_title'         => 'ฝากเงินเข้าบัญชีเทรด',
			'go_step3_desc'          => 'ฝากเงินผ่านหน้า Portal ของ Zaurix ก่อนเปิดใช้ EA และใช้เฉพาะเงินที่รับความเสี่ยงได้',
			'go_step3_note'          => '',
			'go_step3_badge'         => '',
			'go_deposit_label'       => 'เข้า Portal Zaurix',
			'go_deposit_url'         => 'https://portal.zaurix.com/',
			'go_deposit_guide_label' => '',
			'go_deposit_guide_url'   => '',

			/* ขั้น 4 · ไฟล์ EA */
			'go_step4_title'         => 'ดาวน์โหลดไฟล์ EA WING',
			'go_step4_desc'          => 'กดที่การ์ดเพื่อดาวน์โหลด ในไฟล์ .zip มีตัว EA คู่มือ PDF และวิธีติดตั้ง',
			'go_step4_note'          => 'EA WING ทำงานกับบัญชีที่ได้รับสิทธิ์แล้วเท่านั้น ส่งเลขบัญชี MT5 และชื่อเซิร์ฟเวอร์ให้ทีมงานทาง LINE เพื่อเปิดสิทธิ์',
			'go_step4_badge'         => '',
			'go_download_line_label' => eaw_go_legacy( 'go_step4', 'ขอรับไฟล์ EA ทาง LINE' ),
			'go_fast_img'            => 'assets/img/eawing-download-card-v42.webp',
			'go_fast_url'            => 'assets/downloads/EA_WING_V4.2.zip',
			'go_fast_alt'            => 'ดาวน์โหลด EA WING Expert Advisor สำหรับ MT5',
			'go_fast_label'          => 'ดาวน์โหลด EA WING V4.2 (.zip)',
			'go_fast_version'        => 'V4.2',
			'go_fast_version_label'  => 'อัปเดตล่าสุด',
			'go_license_line_label'  => 'ส่งเลขบัญชีขอเปิดสิทธิ์ทาง LINE',

			/* ขั้น 5 · ติดตั้ง EA */
			'go_step5_title'         => eaw_go_legacy( 'go_step5', 'ติดตั้ง EA บน MT5' ),
			'go_step5_desc'          => 'วางไฟล์ใน MQL5 → Experts ติ๊ก Allow DLL imports และเปิด Algo Trading แล้วลาก EA ลงกราฟ XAUUSD M1',
			'go_step5_note'          => '',
			'go_step5_badge'         => '',
			'go_install1_label'      => 'คู่มือติดตั้ง EA ทีละขั้น',
			'go_install1_url'        => '/how-to-install/',
			'go_install2_label'      => 'คำนวณขนาด Lot ก่อนเริ่ม',
			'go_install2_url'        => '/tools/',

			/* ขั้น 6 · VPS */
			'go_step6_title'         => eaw_go_legacy( 'go_step6', 'รันบน VPS' ),
			'go_step6_desc'          => 'MT5 ต้องเปิดอยู่ตลอด EA จึงทำงานได้ Windows VPS คือเครื่องที่ไม่ต้องปิด ใช้แทนคอมที่บ้าน ดูคู่มือของอุปกรณ์ที่คุณจะใช้เปิดหน้าจอ VPS',
			'go_step6_note'          => '',
			'go_step6_badge'         => 'แนะนำ',
			'go_vps_windows_label'   => 'Windows',
			'go_vps_windows_url'     => '/vps-windows/',
			'go_vps_android_label'   => 'Android',
			'go_vps_android_url'     => '/vps-android/',
			'go_vps_ios_label'       => 'iPhone / iPad',
			'go_vps_ios_url'         => '/vps-ios/',
			'go_vps_macos_label'     => 'macOS',
			'go_vps_macos_url'       => '',

			/* กลุ่มข้อมูลก่อนเริ่ม */
			'go_info_title'          => 'ข้อมูลก่อนตัดสินใจ',
			'go_btn1_label'          => 'Forward Test คืออะไร ดูผลอย่างไร',
			'go_btn1_url'            => '/forward-test/',
			'go_btn2_label'          => 'แพ็กเกจ & ราคา',
			'go_btn2_url'            => '/pricing/',
			'go_btn3_label'          => 'รู้จัก EA WING',
			'go_btn3_url'            => '/about/',
			'go_btn4_label'          => 'บทความวางแผนและบริหารความเสี่ยง',
			'go_btn4_url'            => '/articles/',
			'go_btn5_label'          => '',
			'go_btn5_url'            => '',
			'go_btn6_label'          => '',
			'go_btn6_url'            => '',

			/* ท้ายการ์ด */
			'go_show_doc'            => false,
			'go_home_label'          => 'ไปหน้าแรกของ EA WING',
		)
	);
}
add_filter( 'eaw_defaults', 'eaw_go_defaults' );

/* ==============================================================
 * Customizer · แทนหมวด eaw_go เดิม (คงตำแหน่งเดิม) + หมวดขั้นตอนต่อท้าย
 * ============================================================== */

function eaw_go_sections( $sections, $d ) {
	$link_rule = 'ใส่ slug เช่น /pricing/ หรือ URL เต็ม · เว้นว่างแต่มีข้อความ = ปุ่มเส้นประ "เร็ว ๆ นี้" · slug ของเพจที่ยังไม่เผยแพร่ก็แสดงเป็นปุ่มเส้นประจนกว่าจะเผยแพร่';

	$head = array(
		'title'       => '30) หน้า /go (ลิงก์รวม) · ส่วนหัวและลิงก์',
		'description' => 'หน้าลิงก์รวมสำหรับใส่ในโปรไฟล์ LINE OA / Facebook / TikTok และใช้เป็นปลายทางโฆษณา · เป็นหน้าเดี่ยว ไม่มีเมนูและท้ายเว็บ · เพจต้องใช้เทมเพลต "EA WING · หน้ารวมลิงก์ (/go)" · ปุ่ม LINE ใช้ลิงก์จากหมวด 1 · ท้ายการ์ดแสดงคำเตือนความเสี่ยงฉบับเต็มจากหมวดคำเตือนเสมอ · ช่องที่เว้นว่างจะถูกซ่อน',
		'fields'      => array(
			'go_logo'           => array( 'โลโก้วงกลม (ไม่ใส่ = ใช้ไอคอน EA WING ของธีม)', 'image', 'แนะนำภาพจัตุรัสอย่างน้อย 176×176px เพราะแสดงในกรอบวงกลม' ),
			'go_title'          => array( 'ชื่อบนการ์ด (H1 · เว้นว่าง = ใช้ชื่อเพจ)', 'text' ),
			'go_sub'            => array( 'คำโปรยใต้ชื่อ (ขึ้นบรรทัดใหม่ได้)', 'textarea' ),
			'go_badges'         => array( 'ป้ายเล็กใต้คำโปรย (บรรทัดละ 1 ป้าย · เว้นว่าง = ซ่อน)', 'textarea', 'ห้ามใส่ตัวเลขผลเทรดหรือคำรับประกันกำไร' ),
			'go_help_title'     => array( 'กลุ่มติดต่อทีม · หัวข้อ', 'text' ),
			'go_line_label'     => array( 'กลุ่มติดต่อทีม · ข้อความปุ่ม LINE', 'text', 'ลิงก์ใช้ค่า LINE จากหมวด 1 · ไม่มีลิงก์ LINE = ไม่แสดงปุ่ม' ),
			'go_openchat_label' => array( 'กลุ่มติดต่อทีม · ข้อความปุ่ม OpenChat', 'text', 'ลิงก์ใช้ค่า "ลิงก์ LINE OpenChat" จากหมวด 1 · ไม่มีลิงก์ = ไม่แสดงปุ่ม' ),
			'go_pending_label'  => array( 'ป้ายของปุ่มที่ยังไม่มีลิงก์', 'text', 'ปุ่มที่มีข้อความแต่ไม่มีลิงก์จะเป็นเส้นประ กดไม่ได้ พร้อมป้ายนี้' ),
			'go_info_title'     => array( 'กลุ่มข้อมูลก่อนเริ่ม · หัวข้อ', 'text' ),
			'go_btn1_label'     => array( 'ปุ่ม 1 · ข้อความ', 'text' ),
			'go_btn1_url'       => array( 'ปุ่ม 1 · ลิงก์', 'path', $link_rule ),
			'go_btn2_label'     => array( 'ปุ่ม 2 · ข้อความ', 'text' ),
			'go_btn2_url'       => array( 'ปุ่ม 2 · ลิงก์', 'path' ),
			'go_btn3_label'     => array( 'ปุ่ม 3 · ข้อความ', 'text' ),
			'go_btn3_url'       => array( 'ปุ่ม 3 · ลิงก์', 'path' ),
			'go_btn4_label'     => array( 'ปุ่ม 4 · ข้อความ', 'text' ),
			'go_btn4_url'       => array( 'ปุ่ม 4 · ลิงก์', 'path' ),
			'go_btn5_label'     => array( 'ปุ่ม 5 · ข้อความ (เว้นว่าง = ซ่อน)', 'text' ),
			'go_btn5_url'       => array( 'ปุ่ม 5 · ลิงก์', 'path' ),
			'go_btn6_label'     => array( 'ปุ่ม 6 · ข้อความ (เว้นว่าง = ซ่อน)', 'text' ),
			'go_btn6_url'       => array( 'ปุ่ม 6 · ลิงก์', 'path' ),
			'go_show_doc'       => array( 'แสดงเนื้อหาของเพจ /go (จากตัวแก้ไข WordPress) ใต้ปุ่มโซเชียล', 'checkbox' ),
			'go_home_label'     => array( 'ท้ายการ์ด · ข้อความลิงก์กลับหน้าแรก (เว้นว่าง = ซ่อน)', 'text', 'ลิงก์เอกสาร (นโยบายความเป็นส่วนตัว · เงื่อนไข · ประกาศความเสี่ยง) แสดงเองเมื่อเพจเผยแพร่แล้ว · ไอคอนโซเชียลใช้ลิงก์จากหมวดช่องทางติดต่อ' ),
		),
	);

	$steps = array(
		'title'       => '31) หน้า /go · ขั้นตอนเริ่มใช้งาน',
		'description' => 'ขั้นตอนที่ไม่มีปุ่มจะถูกซ่อน และเลขขั้นเรียงใหม่อัตโนมัติ · ทุกขั้นมี หัวข้อ / คำอธิบาย / หมายเหตุ / ป้ายเล็ก (เว้นว่าง = ซ่อน) · ห้ามใส่ตัวเลขผลเทรดสมมติหรือคำรับประกันกำไร',
		'fields'      => array(
			'go_steps_title'         => array( 'หัวข้อรวมของขั้นตอน', 'text', 'ใส่ {n} เพื่อแสดงจำนวนขั้นที่แสดงจริงอัตโนมัติ' ),
			'go_step_word'           => array( 'คำนำหน้าเลขขั้นสำหรับโปรแกรมอ่านหน้าจอ', 'text' ),

			'go_step1_title'         => array( 'ขั้นเปิดบัญชี · หัวข้อ', 'text' ),
			'go_step1_desc'          => array( 'ขั้นเปิดบัญชี · คำอธิบาย', 'textarea' ),
			'go_step1_note'          => array( 'ขั้นเปิดบัญชี · หมายเหตุเพิ่มเติม', 'textarea', 'ข้อความเปิดเผยว่า EA WING เป็นพาร์ตเนอร์ของ Zaurix และได้รับค่าตอบแทนอยู่ในคำอธิบายขั้นแล้ว ถ้าแก้คำอธิบาย ต้องคงข้อความเปิดเผยไว้ในขั้นนี้ (ย้ายมาไว้ช่องนี้ได้) · แสดงใต้คำอธิบาย ก่อนปุ่ม' ),
			'go_step1_badge'         => array( 'ขั้นเปิดบัญชี · ป้ายเล็ก', 'text' ),
			'go_signup_line_label'   => array( 'ขั้นเปิดบัญชี · ข้อความปุ่ม LINE ขอลิงก์สมัคร', 'text', 'EA WING ส่งลิงก์สมัครทาง LINE เท่านั้น จึงควรเว้น "ลิงก์สมัครบัญชี" ในหมวดโบรกเกอร์ไว้ว่าง ปุ่ม LINE นี้จะแสดง · ถ้ากรอกลิงก์นั้น ปุ่มสมัครตรงจะมาแทนปุ่มนี้' ),
			'go_account_guide_label' => array( 'ขั้นเปิดบัญชี · ข้อความปุ่มคู่มือ', 'text' ),
			'go_account_guide_url'   => array( 'ขั้นเปิดบัญชี · ลิงก์ปุ่มคู่มือ', 'path', $link_rule ),

			'go_step2_title'         => array( 'ขั้นแอป MT5 · หัวข้อ', 'text' ),
			'go_step2_desc'          => array( 'ขั้นแอป MT5 · คำอธิบาย', 'textarea' ),
			'go_step2_note'          => array( 'ขั้นแอป MT5 · หมายเหตุ', 'textarea' ),
			'go_step2_badge'         => array( 'ขั้นแอป MT5 · ป้ายเล็ก', 'text' ),
			'go_mt5_ios_label'       => array( 'ขั้นแอป MT5 · ปุ่ม iPhone', 'text' ),
			'mt5_dl_ios'             => array( 'ขั้นแอป MT5 · ลิงก์ App Store', 'url' ),
			'go_mt5_android_label'   => array( 'ขั้นแอป MT5 · ปุ่ม Android', 'text' ),
			'mt5_dl_android'         => array( 'ขั้นแอป MT5 · ลิงก์ Google Play', 'url' ),
			'go_mt5_windows_label'   => array( 'ขั้นแอป MT5 · ปุ่ม Windows', 'text' ),
			'mt5_dl_windows'         => array( 'ขั้นแอป MT5 · ลิงก์ดาวน์โหลด Windows', 'url' ),
			'go_mt5_macos_label'     => array( 'ขั้นแอป MT5 · ปุ่ม macOS (เว้นว่าง = ซ่อน)', 'text' ),
			'go_mt5_macos_url'       => array( 'ขั้นแอป MT5 · ลิงก์ดาวน์โหลด macOS', 'url' ),
			'go_mt5_login_label'     => array( 'ขั้นแอป MT5 · ข้อความปุ่มคู่มือล็อกอิน', 'text' ),
			'go_mt5_login_url'       => array( 'ขั้นแอป MT5 · ลิงก์ปุ่มคู่มือล็อกอิน', 'path', $link_rule ),

			'go_step3_title'         => array( 'ขั้นฝากเงิน · หัวข้อ', 'text' ),
			'go_step3_desc'          => array( 'ขั้นฝากเงิน · คำอธิบาย', 'textarea' ),
			'go_step3_note'          => array( 'ขั้นฝากเงิน · หมายเหตุ', 'textarea' ),
			'go_step3_badge'         => array( 'ขั้นฝากเงิน · ป้ายเล็ก', 'text' ),
			'go_deposit_label'       => array( 'ขั้นฝากเงิน · ข้อความปุ่มหลัก', 'text', 'ขั้นนี้ซ่อนอยู่จนกว่าจะกรอกลิงก์ปุ่มหลัก หรือข้อความปุ่มคู่มือ' ),
			'go_deposit_url'         => array( 'ขั้นฝากเงิน · ลิงก์ปุ่มหลัก (เช่น หน้าสมาชิกของโบรกเกอร์ · ว่าง = ซ่อนปุ่ม)', 'path' ),
			'go_deposit_guide_label' => array( 'ขั้นฝากเงิน · ข้อความปุ่มคู่มือ', 'text' ),
			'go_deposit_guide_url'   => array( 'ขั้นฝากเงิน · ลิงก์ปุ่มคู่มือ', 'path', $link_rule ),

			'go_step4_title'         => array( 'ขั้นรับไฟล์ EA · หัวข้อ', 'text' ),
			'go_step4_desc'          => array( 'ขั้นรับไฟล์ EA · คำอธิบาย', 'textarea' ),
			'go_step4_note'          => array( 'ขั้นรับไฟล์ EA · หมายเหตุ', 'textarea' ),
			'go_step4_badge'         => array( 'ขั้นรับไฟล์ EA · ป้ายเล็ก', 'text' ),
			'go_download_line_label' => array( 'ขั้นรับไฟล์ EA · ข้อความปุ่ม LINE เมื่อยังไม่มีลิงก์ไฟล์', 'text' ),
			'go_fast_url'            => array( 'ขั้นรับไฟล์ EA · ลิงก์ดาวน์โหลดไฟล์ (ว่าง = ใช้ปุ่ม LINE ด้านบน)', 'path', 'EA WING ส่งไฟล์ทาง LINE หลังยืนยันคุณสมบัติ จึงควรเว้นว่างไว้ · ถ้าจำเป็นต้องใช้ลิงก์ อัปโหลดที่ สื่อ → เพิ่มใหม่ แล้ววาง URL ที่นี่ ห้ามใส่ไฟล์ .ex5/.zip ไว้ในโฟลเดอร์ธีม' ),
			'go_fast_label'          => array( 'ขั้นรับไฟล์ EA · ข้อความปุ่มดาวน์โหลด (ใช้เมื่อไม่มีรูปการ์ด)', 'text' ),
			'go_fast_img'            => array( 'ขั้นรับไฟล์ EA · รูปการ์ดดาวน์โหลด (ไม่บังคับ)', 'image', 'แนะนำภาพแนวนอน 1200×630px · มีรูป + ลิงก์ = แสดงเป็นการ์ดรูปแทนปุ่ม' ),
			'go_fast_alt'            => array( 'ขั้นรับไฟล์ EA · คำอธิบายรูปการ์ด (alt)', 'text' ),
			'go_fast_version'        => array( 'ขั้นรับไฟล์ EA · เลขเวอร์ชันบนการ์ด (เช่น V4.2 · ว่าง = ไม่แสดงป้าย)', 'text' ),
			'go_fast_version_label'  => array( 'ขั้นรับไฟล์ EA · คำหน้าเลขเวอร์ชัน', 'text' ),
			'go_license_line_label'  => array( 'ขั้นรับไฟล์ EA · ปุ่ม LINE ขอเปิดสิทธิ์ (แสดงคู่กับไฟล์ดาวน์โหลด · ว่าง = ซ่อน)', 'text' ),

			'go_step5_title'         => array( 'ขั้นติดตั้ง EA · หัวข้อ', 'text' ),
			'go_step5_desc'          => array( 'ขั้นติดตั้ง EA · คำอธิบาย', 'textarea' ),
			'go_step5_note'          => array( 'ขั้นติดตั้ง EA · หมายเหตุ', 'textarea' ),
			'go_step5_badge'         => array( 'ขั้นติดตั้ง EA · ป้ายเล็ก', 'text' ),
			'go_install1_label'      => array( 'ขั้นติดตั้ง EA · ปุ่มคู่มือ 1 · ข้อความ', 'text' ),
			'go_install1_url'        => array( 'ขั้นติดตั้ง EA · ปุ่มคู่มือ 1 · ลิงก์', 'path', $link_rule ),
			'go_install2_label'      => array( 'ขั้นติดตั้ง EA · ปุ่มคู่มือ 2 · ข้อความ (เว้นว่าง = ซ่อน)', 'text' ),
			'go_install2_url'        => array( 'ขั้นติดตั้ง EA · ปุ่มคู่มือ 2 · ลิงก์', 'path' ),

			'go_step6_title'         => array( 'ขั้น VPS · หัวข้อ', 'text' ),
			'go_step6_desc'          => array( 'ขั้น VPS · คำอธิบาย', 'textarea' ),
			'go_step6_note'          => array( 'ขั้น VPS · หมายเหตุ', 'textarea' ),
			'go_step6_badge'         => array( 'ขั้น VPS · ป้ายเล็ก', 'text' ),
			'go_vps_windows_label'   => array( 'ขั้น VPS · ปุ่ม Windows · ข้อความ', 'text' ),
			'go_vps_windows_url'     => array( 'ขั้น VPS · ปุ่ม Windows · ลิงก์', 'path', $link_rule ),
			'go_vps_android_label'   => array( 'ขั้น VPS · ปุ่ม Android · ข้อความ', 'text' ),
			'go_vps_android_url'     => array( 'ขั้น VPS · ปุ่ม Android · ลิงก์', 'path' ),
			'go_vps_ios_label'       => array( 'ขั้น VPS · ปุ่ม iPhone · ข้อความ', 'text' ),
			'go_vps_ios_url'         => array( 'ขั้น VPS · ปุ่ม iPhone · ลิงก์', 'path' ),
			'go_vps_macos_label'     => array( 'ขั้น VPS · ปุ่ม macOS · ข้อความ (เว้นว่าง = ซ่อน)', 'text' ),
			'go_vps_macos_url'       => array( 'ขั้น VPS · ปุ่ม macOS · ลิงก์ (ว่าง = ปุ่มเส้นประ "เร็ว ๆ นี้")', 'path' ),
		),
	);

	/* แทนหมวดเดิมในตำแหน่งเดิม แล้วต่อหมวดขั้นตอนไว้ถัดไป */
	$out   = array();
	$added = false;
	foreach ( $sections as $section_id => $section ) {
		if ( 'eaw_go' === $section_id ) {
			$out['eaw_go']       = $head;
			$out['eaw_go_steps'] = $steps;
			$added                 = true;
			continue;
		}
		if ( 'eaw_go_steps' === $section_id ) {
			continue;
		}
		$out[ $section_id ] = $section;
	}
	if ( ! $added ) {
		$out['eaw_go']       = $head;
		$out['eaw_go_steps'] = $steps;
	}

	/* คีย์ของหน้านี้อยู่ที่หมวด /go ที่เดียว (กันซ้ำจากหมวดอื่น) */
	$own = array_merge( array_keys( $head['fields'] ), array_keys( $steps['fields'] ) );
	foreach ( $out as $section_id => $section ) {
		if ( 'eaw_go' === $section_id || 'eaw_go_steps' === $section_id || empty( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
			continue;
		}
		foreach ( $own as $key ) {
			unset( $out[ $section_id ]['fields'][ $key ] );
		}
	}

	return $out;
}
add_filter( 'eaw_customizer_sections', 'eaw_go_sections', 20, 2 );

/* ==============================================================
 * ตัวช่วยของหน้า /go
 * ============================================================== */

/**
 * ค่า setting ที่ตัดช่องว่างแล้ว
 */
function eaw_go_mod( $key ) {
	return trim( (string) eaw_mod( $key ) );
}

/**
 * แปลงลิงก์ที่ตั้งค่าไว้เป็น URL ที่กดได้จริง · '' = ยังไม่มีปลายทาง (แสดงเป็นปุ่ม "เร็ว ๆ นี้")
 * slug ของเพจในเว็บ (eaw_site_pages) ที่ยังไม่เผยแพร่ถือว่ายังไม่มีปลายทาง กันลิงก์ 404
 */
function eaw_go_href( $url ) {
	$url = trim( (string) $url );
	if ( '' === $url || '#' === $url ) {
		return '';
	}
	if ( preg_match( '#^/?([a-z0-9][a-z0-9\-]*)/?$#i', $url, $m ) && function_exists( 'eaw_site_pages' ) ) {
		$pages = eaw_site_pages();
		$slug  = strtolower( $m[1] );
		if ( isset( $pages[ $slug ] ) && empty( $pages[ $slug ]['front'] ) && function_exists( 'eaw_published_page_url' ) && '' === eaw_published_page_url( $slug ) ) {
			return '';
		}
	}
	return eaw_link_url( $url );
}

/**
 * ลิงก์ออกนอกเว็บ (เปิดแท็บใหม่)
 */
function eaw_go_is_external( $href ) {
	if ( ! preg_match( '#^(https?:)?//#i', (string) $href ) ) {
		return false;
	}
	$host = wp_parse_url( home_url( '/' ), PHP_URL_HOST );
	$to   = wp_parse_url( ( 0 === strpos( $href, '//' ) ? 'https:' : '' ) . $href, PHP_URL_HOST );
	return $host && $to ? strtolower( $host ) !== strtolower( $to ) : true;
}

/**
 * attribute เพิ่ม (escape ในนี้)
 */
function eaw_go_attrs( $attrs ) {
	$out = '';
	foreach ( (array) $attrs as $name => $value ) {
		if ( true === $value ) {
			$out .= ' ' . esc_attr( $name );
		} elseif ( null !== $value && false !== $value ) {
			$out .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
		}
	}
	return $out;
}

/**
 * ป้าย "เร็ว ๆ นี้"
 */
function eaw_go_pending_tag() {
	$label = eaw_go_mod( 'go_pending_label' );
	return '' !== $label ? '<span class="lh-pending-tag">' . esc_html( $label ) . '</span>' : '';
}

/**
 * ปุ่มบนการ์ด · มีลิงก์ = <a> · มีข้อความแต่ไม่มีลิงก์ = ปุ่มเส้นประ กดไม่ได้ + ป้าย "เร็ว ๆ นี้" · ไม่มีข้อความ = ไม่แสดง
 *
 * @param string $class  lh-btn (เต็มความกว้าง) หรือ lh-mini-btn (ปุ่มรอง)
 * @param string $label  ข้อความ
 * @param string $url    ลิงก์ที่ตั้งค่าไว้ (slug หรือ URL เต็ม)
 * @param string $icon   ชื่อไอคอนของ eaw_icon()
 * @param array  $attrs  attribute เพิ่ม
 * @return string HTML ที่ escape แล้ว
 */
function eaw_go_button( $class, $label, $url, $icon, $attrs = array() ) {
	$label = trim( (string) $label );
	if ( '' === $label ) {
		return '';
	}
	$href   = eaw_go_href( $url );
	$is_btn = false !== strpos( ' ' . $class . ' ', ' lh-btn ' );

	if ( '' !== $href ) {
		$external = eaw_go_is_external( $href );
		if ( $external && ! isset( $attrs['target'] ) ) {
			$attrs['target'] = '_blank';
			$attrs['rel']    = isset( $attrs['rel'] ) ? $attrs['rel'] : 'noopener';
		}
		return sprintf(
			'<a class="%1$s" href="%2$s"%3$s><span class="lh-ic">%4$s</span><span class="lh-lbl">%5$s</span>%6$s</a>',
			esc_attr( $class ),
			esc_url( $href ),
			eaw_go_attrs( $attrs ),
			eaw_icon( $icon ),
			eaw_text( $label ),
			$is_btn ? '<span class="lh-ar" aria-hidden="true">' . eaw_icon( $external ? 'external' : 'arrow' ) . '</span>' : ''
		);
	}

	/* ลิงก์ที่ยังกดไม่ได้: บอกโปรแกรมอ่านหน้าจอว่าเป็นลิงก์ที่ปิดอยู่ (ไม่อยู่ในลำดับ Tab) */
	return sprintf(
		'<span class="%1$s is-pending" role="link" aria-disabled="true"><span class="lh-ic">%2$s</span><span class="lh-lbl">%3$s</span>%4$s</span>',
		esc_attr( $class ),
		eaw_icon( $icon ),
		eaw_text( $label ),
		eaw_go_pending_tag()
	);
}

/**
 * ปุ่ม LINE ภายในขั้นตอน (ขอลิงก์เปิดบัญชี / ขอไฟล์ EA) · แสดงเฉพาะเมื่อมีลิงก์ LINE จริง
 */
function eaw_go_line_button( $label, $pos ) {
	$label  = trim( (string) $label );
	$target = eaw_contact_target();
	if ( '' === $label || '' === $target['url'] || ! $target['is_line'] ) {
		return '';
	}
	return sprintf(
		'<a class="lh-btn lh-btn-line lh-btn-line-step" href="%1$s" target="_blank" rel="noopener" data-line-pos="%2$s">%3$s<span class="lh-lbl">%4$s</span></a>',
		esc_url( $target['url'] ),
		esc_attr( $pos ),
		eaw_icon( 'line' ),
		eaw_text( $label )
	);
}

/**
 * ตารางปุ่มตามอุปกรณ์ (แอป MT5 / คู่มือ VPS) · รายการ: array( label, url, icon )
 */
function eaw_go_tiles( $items, $class = '' ) {
	$html  = '';
	$count = 0;
	foreach ( $items as $item ) {
		$label = trim( (string) $item[0] );
		if ( '' === $label ) {
			continue;
		}
		$href = eaw_go_href( $item[1] );
		++$count;
		if ( '' !== $href ) {
			$html .= sprintf(
				'<a class="lh-tile" href="%1$s"%2$s><span class="lh-tile-ic">%3$s</span><span class="lh-tile-lbl">%4$s</span></a>',
				esc_url( $href ),
				eaw_go_is_external( $href ) ? ' target="_blank" rel="noopener"' : '',
				eaw_icon( $item[2] ),
				esc_html( $label )
			);
			continue;
		}
		$html .= sprintf(
			'<span class="lh-tile is-pending" role="link" aria-disabled="true"><span class="lh-tile-ic">%1$s</span><span class="lh-tile-lbl">%2$s</span>%3$s</span>',
			eaw_icon( $item[2] ),
			esc_html( $label ),
			eaw_go_pending_tag()
		);
	}
	if ( ! $count ) {
		return '';
	}
	return '<div class="' . esc_attr( trim( 'lh-tiles lh-tiles--' . min( $count, 4 ) . ' ' . $class ) ) . '">' . $html . '</div>';
}

/**
 * ไฟล์ในธีม (assets/...) → URL เต็ม · อย่างอื่นส่งต่อให้ eaw_go_href()
 */
function eaw_go_asset_href( $url ) {
	$url = trim( (string) $url );
	if ( 0 === strpos( $url, 'assets/' ) ) {
		return get_template_directory_uri() . '/' . $url;
	}
	return eaw_go_href( $url );
}

/**
 * การ์ดดาวน์โหลดไฟล์ EA (รูป + ป้ายเวอร์ชัน + ปุ่มดาวน์โหลด) · ไม่มีลิงก์ไฟล์ = ''
 */
function eaw_go_download() {
	$href = eaw_go_asset_href( eaw_go_mod( 'go_fast_url' ) );
	if ( '' === $href ) {
		return '';
	}
	$attrs = array( 'data-go-pos' => 'go-download' );
	if ( preg_match( '/\.(zip|ex5|set|pdf)([?#]|$)/i', $href ) ) {
		$attrs['download'] = true;
	}
	if ( eaw_go_is_external( $href ) ) {
		$attrs['target'] = '_blank';
		$attrs['rel']    = 'noopener';
	}

	$html = '';
	$img  = eaw_go_asset_href( eaw_go_mod( 'go_fast_img' ) );
	if ( '' !== $img ) {
		$version = eaw_go_mod( 'go_fast_version' );
		$badge   = '';
		if ( '' !== $version ) {
			$badge = sprintf(
				'<span class="lh-ver"><span class="lh-ver-label">%1$s</span><span class="lh-ver-num">%2$s</span></span>',
				esc_html( eaw_go_mod( 'go_fast_version_label' ) ),
				esc_html( $version )
			);
		}
		$html .= sprintf(
			'<a class="lh-feature" href="%1$s"%2$s><img src="%3$s" alt="%4$s" width="960" height="480" loading="lazy" decoding="async">%5$s</a>',
			esc_url( $href ),
			eaw_go_attrs( $attrs ),
			esc_url( $img ),
			esc_attr( eaw_go_mod( 'go_fast_alt' ) ),
			$badge
		);
	}

	$label = eaw_go_mod( 'go_fast_label' );
	if ( '' !== $label ) {
		$html .= sprintf(
			'<a class="lh-btn lh-btn-download" href="%1$s"%2$s><span class="lh-ic">%3$s</span><span class="lh-lbl">%4$s</span></a>',
			esc_url( $href ),
			eaw_go_attrs( $attrs ),
			eaw_icon( 'download' ),
			eaw_text( $label )
		);
	}
	return $html;
}

/**
 * ขั้นตอนเริ่มใช้งาน · ขั้นที่ไม่มีปุ่มถูกตัดออก ลำดับใน array = เลขที่แสดง
 *
 * @return array[] { key, n (เลข setting go_stepN_*), body (HTML ที่ escape แล้ว) }
 */
function eaw_go_steps() {
	$steps = array();

	// 1 · เปิดบัญชี: ปุ่มสมัคร (หมวดโบรกเกอร์) หรือปุ่ม LINE ขอลิงก์ + ปุ่มคู่มือ.
	$signup_url   = eaw_go_mod( 'broker_signup_url' );
	$signup_label = eaw_go_mod( 'broker_signup_text' );
	$body         = '';
	if ( '' !== eaw_go_href( $signup_url ) && '' !== $signup_label ) {
		$href  = eaw_go_href( $signup_url );
		$body .= sprintf(
			'<a class="lh-btn lh-btn-signup" href="%1$s" target="_blank" rel="sponsored noopener" data-go-pos="go-signup"><span class="lh-ic">%2$s</span><span class="lh-lbl">%3$s</span><span class="lh-ar" aria-hidden="true">%4$s</span></a>',
			esc_url( $href ),
			eaw_icon( 'user' ),
			eaw_text( $signup_label ),
			eaw_icon( 'external' )
		);
	} else {
		$body .= eaw_go_line_button( eaw_go_mod( 'go_signup_line_label' ), 'go-signup' );
	}
	$body   .= eaw_go_button( 'lh-mini-btn', eaw_go_mod( 'go_account_guide_label' ), eaw_go_mod( 'go_account_guide_url' ), 'book' );
	$steps[] = array( 'key' => 'account', 'n' => 1, 'body' => $body );

	// 2 · แอป MT5 ตามอุปกรณ์ + คู่มือล็อกอิน.
	$body  = eaw_go_tiles(
		array(
			array( eaw_go_mod( 'go_mt5_ios_label' ), eaw_go_mod( 'mt5_dl_ios' ), 'apple' ),
			array( eaw_go_mod( 'go_mt5_android_label' ), eaw_go_mod( 'mt5_dl_android' ), 'android' ),
			array( eaw_go_mod( 'go_mt5_windows_label' ), eaw_go_mod( 'mt5_dl_windows' ), 'windows' ),
			array( eaw_go_mod( 'go_mt5_macos_label' ), eaw_go_mod( 'go_mt5_macos_url' ), 'macos' ),
		),
		'lh-tiles--apps'
	);
	$body   .= eaw_go_button( 'lh-mini-btn', eaw_go_mod( 'go_mt5_login_label' ), eaw_go_mod( 'go_mt5_login_url' ), 'book' );
	$steps[] = array( 'key' => 'mt5', 'n' => 2, 'body' => $body );

	// 3 · ฝากเงิน (ปุ่มหลักแสดงเมื่อมีลิงก์เท่านั้น).
	$body = '';
	if ( '' !== eaw_go_href( eaw_go_mod( 'go_deposit_url' ) ) ) {
		$body .= eaw_go_button( 'lh-btn lh-btn-accent', eaw_go_mod( 'go_deposit_label' ), eaw_go_mod( 'go_deposit_url' ), 'dollar' );
	}
	$body   .= eaw_go_button( 'lh-mini-btn', eaw_go_mod( 'go_deposit_guide_label' ), eaw_go_mod( 'go_deposit_guide_url' ), 'book' );
	$steps[] = array( 'key' => 'deposit', 'n' => 3, 'body' => $body );

	// 4 · ไฟล์ EA: การ์ด/ปุ่มดาวน์โหลด หรือปุ่ม LINE ขอไฟล์.
	$body = eaw_go_download();
	if ( '' === $body ) {
		$body = eaw_go_line_button( eaw_go_mod( 'go_download_line_label' ), 'go-download' );
	} else {
		$body .= eaw_go_line_button( eaw_go_mod( 'go_license_line_label' ), 'go-license' );
	}
	$steps[] = array( 'key' => 'download', 'n' => 4, 'body' => $body );

	// 5 · ติดตั้ง EA.
	$body    = eaw_go_button( 'lh-btn', eaw_go_mod( 'go_install1_label' ), eaw_go_mod( 'go_install1_url' ), 'gear' );
	$body   .= eaw_go_button( 'lh-btn', eaw_go_mod( 'go_install2_label' ), eaw_go_mod( 'go_install2_url' ), 'calc' );
	$steps[] = array( 'key' => 'install', 'n' => 5, 'body' => $body );

	// 6 · VPS ตามอุปกรณ์ที่ใช้เชื่อมต่อ.
	$body    = eaw_go_tiles(
		array(
			array( eaw_go_mod( 'go_vps_windows_label' ), eaw_go_mod( 'go_vps_windows_url' ), 'windows' ),
			array( eaw_go_mod( 'go_vps_android_label' ), eaw_go_mod( 'go_vps_android_url' ), 'android' ),
			array( eaw_go_mod( 'go_vps_ios_label' ), eaw_go_mod( 'go_vps_ios_url' ), 'apple' ),
			array( eaw_go_mod( 'go_vps_macos_label' ), eaw_go_mod( 'go_vps_macos_url' ), 'macos' ),
		),
		'lh-tiles--vps'
	);
	$steps[] = array( 'key' => 'vps', 'n' => 6, 'body' => $body );

	return array_values(
		array_filter(
			$steps,
			static function ( $step ) {
				return '' !== trim( $step['body'] ) && '' !== eaw_go_mod( 'go_step' . $step['n'] . '_title' );
			}
		)
	);
}

/**
 * ปุ่มกลุ่มข้อมูลก่อนเริ่ม (1 ถึง 6)
 */
function eaw_go_info_buttons() {
	$icons = array( 1 => 'pulse', 2 => 'tag', 3 => 'users', 4 => 'book', 5 => 'flask', 6 => 'arrow' );
	$html  = '';
	for ( $i = 1; $i <= 6; $i++ ) {
		$html .= eaw_go_button( 'lh-btn', eaw_go_mod( 'go_btn' . $i . '_label' ), eaw_go_mod( 'go_btn' . $i . '_url' ), $icons[ $i ] );
	}
	return $html;
}

/**
 * โซเชียลที่กรอกลิงก์ไว้ (facebook_url จากหมวด 1 · instagram/tiktok/youtube จากโมดูล chrome)
 *
 * @return array[] { name, url, label }
 */
function eaw_go_socials() {
	$out = array();
	foreach ( array(
		'facebook'  => array( 'facebook_url', 'footer_facebook_text', 'Facebook' ),
		'instagram' => array( 'instagram_url', 'footer_instagram_text', 'Instagram' ),
		'tiktok'    => array( 'tiktok_url', 'footer_tiktok_text', 'TikTok' ),
		'youtube'   => array( 'youtube_url', 'footer_youtube_text', 'YouTube' ),
	) as $name => $social ) {
		$url = eaw_go_mod( $social[0] );
		if ( '' === $url || '#' === $url ) {
			continue;
		}
		/* ชื่อช่องทาง (aria-label) ใช้ข้อความเดียวกับท้ายเว็บ · ไม่มี = ชื่อแพลตฟอร์ม */
		$label = eaw_go_mod( $social[1] );
		$out[] = array(
			'name'  => $name,
			'url'   => $url,
			'label' => '' !== $label ? $label : $social[2],
		);
	}
	return $out;
}

/**
 * ลิงก์เอกสารท้ายการ์ด · เฉพาะเพจที่เผยแพร่แล้ว ใช้ชื่อเพจจริง
 *
 * @return array[] { url, label }
 */
function eaw_go_legal_links() {
	$pages = function_exists( 'eaw_site_pages' ) ? eaw_site_pages() : array();
	$out   = array();
	foreach ( array( 'privacy-policy', 'terms-of-use', 'risk-disclosure' ) as $slug ) {
		$url = function_exists( 'eaw_published_page_url' ) ? eaw_published_page_url( $slug ) : '';
		if ( '' === $url ) {
			continue;
		}
		$page  = get_page_by_path( $slug );
		$label = $page ? trim( (string) get_post_field( 'post_title', $page ) ) : '';
		if ( '' === $label && isset( $pages[ $slug ]['title'] ) ) {
			$label = $pages[ $slug ]['title'];
		}
		if ( '' !== $label ) {
			$out[] = array(
				'url'   => $url,
				'label' => $label,
			);
		}
	}
	return $out;
}

/**
 * โลโก้วงกลม · ไม่ตั้งค่า = ไอคอน EA WING ของธีม (180px สำหรับกรอบ 88px)
 */
function eaw_go_logo_url() {
	$logo = eaw_go_mod( 'go_logo' );
	return '' !== $logo ? $logo : get_template_directory_uri() . '/assets/img/brand/eawing-icon-180.png';
}

/**
 * คำที่ห้ามตัดบรรทัดกลางคำบนหน้า /go (การ์ดกว้างไม่เกิน 460px ตัดบรรทัดบ่อย)
 * template-go.php เพิ่มฟิลเตอร์ eaw_keep_words เฉพาะตอนแสดงหน้านี้ · "|" = รอยต่อที่เบราว์เซอร์มักตัดผิด
 */
function eaw_go_keep_words( $words ) {
	return array_merge(
		(array) $words,
		array( 'ยืนยัน|ตัว|ตน', 'ต่อ|ไป', 'ค่า|เริ่ม|ต้น', 'เริ่ม|ต้น', 'ติด|ตั้ง', 'เซิร์ฟ|เวอร์', 'คอม|พิว|เตอร์', 'ด้าน|ล่าง', 'รหัส|ผ่าน' )
	);
}

/**
 * คลาสของ <body> บนหน้านี้ (template-go.php เพิ่มฟิลเตอร์ก่อนเรียก body_class)
 */
function eaw_go_body_class( $classes ) {
	$classes[] = 'link-hub-page';
	/* หน้านี้ไม่มีบาร์ล่างมือถือ · เอาคลาสที่ใช้เว้นที่ให้บาร์ (โมดูล chrome) ออก */
	return array_values( array_unique( array_diff( $classes, array( 'has-dock', 'has-mobile-app-nav' ) ) ) );
}
