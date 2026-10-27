<?php
/**
 * EA WING · รายการสินค้าทั้งหมด เรียงตามเลขรุ่น (เจ้าของขอ 21 ต.ค. 2026 "จัดลำดับตามเลข")
 *
 * - eaw_products(): WING NITRO (nitro_version) · EA WING (ea_version) · WING TWIN (twin_version) เรียงจากเลขรุ่นน้อยไปมาก
 *   เปลี่ยนเลขรุ่นใน Customizer เมื่อไหร่ ลำดับในหน้าแรก /go และเมนูที่สร้างจาก Setup เปลี่ยนตาม
 * - eaw_products_page( $prefix ): โครงหน้าสินค้า (template-nitro.php · template-eawing.php · template-twin.php)
 * - eaw_homeplus_products(): ส่วน "EA ทองคำของ EA WING" ในหน้าแรก การ์ดละ 1 สินค้า (home_{key}_*)
 * - eaw_go_product_downloads(): การ์ดดาวน์โหลดทุกสินค้าในขั้น 4 ของหน้า /go (go_fast_* · go_nitro_* · go_twin_*)
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * สินค้าทั้งหมด เรียงตามเลขรุ่น
 *
 * @return array[] { key, name, file (ชื่อไฟล์ไม่มีนามสกุล), version, slug (เพจสินค้า), go (prefix การ์ด /go), pos, bt }
 */
function eaw_products() {
	$items = array(
		array(
			'key'     => 'nitro',
			'name'    => 'WING NITRO',
			'version' => function_exists( 'eaw_nitro_version' ) ? eaw_nitro_version() : '4.2',
			'prefix'  => 'WING_NITRO_V',
			'slug'    => 'wing-nitro',
			'go'      => 'go_nitro',
			'pos'     => 'go-download-nitro',
			'bt'      => array( 'nitro_bt_from', 'nitro_bt_to' ),
		),
		array(
			'key'     => 'eawing',
			'name'    => 'EA WING',
			'version' => eaw_ea_version(),
			'prefix'  => 'EA_WING_V',
			'slug'    => 'ea-wing',
			'go'      => 'go_fast',
			'pos'     => 'go-download',
			'bt'      => array( 'ea_bt_from', 'ea_bt_to' ),
		),
		array(
			'key'     => 'twin',
			'name'    => 'WING TWIN',
			'version' => function_exists( 'eaw_twin_version' ) ? eaw_twin_version() : '6.3',
			'prefix'  => 'WING_TWIN_V',
			'slug'    => 'wing-twin',
			'go'      => 'go_twin',
			'pos'     => 'go-download-twin',
			'bt'      => array(),
		),
	);
	foreach ( $items as $i => $item ) {
		$items[ $i ]['file']  = $item['prefix'] . $item['version'];
		$items[ $i ]['label'] = $item['name'] . ' ' . $item['version'];
		$items[ $i ]['order'] = $i;
	}
	usort(
		$items,
		static function ( $a, $b ) {
			$cmp = version_compare( $a['version'], $b['version'] );
			return 0 !== $cmp ? $cmp : $a['order'] - $b['order'];
		}
	);
	return (array) apply_filters( 'eaw_products', $items );
}

/**
 * สินค้าตาม key ('nitro' | 'eawing' | 'twin') · ไม่พบ = null
 */
function eaw_product( $key ) {
	foreach ( eaw_products() as $item ) {
		if ( $item['key'] === $key ) {
			return $item;
		}
	}
	return null;
}

/**
 * ช่วง Backtest มาตรฐานของสินค้า ("2026.01.01 ถึง 2026.08.31") · ไม่มี = ''
 */
function eaw_product_bt_range( $item ) {
	if ( empty( $item['bt'] ) ) {
		return '';
	}
	$from = trim( (string) eaw_mod( $item['bt'][0] ) );
	$to   = trim( (string) eaw_mod( $item['bt'][1] ) );
	return '' !== $from && '' !== $to ? $from . ' ถึง ' . $to : '';
}

/* ==============================================================
 * หน้าสินค้า (template-nitro.php · template-eawing.php · template-twin.php)
 * โครง (Glass Sky): หัวเพจ (ชื่อ คำอธิบาย ปุ่ม LINE ปุ่มดาวน์โหลด ภาพการ์ดสินค้า)
 *       → แผงการ์ดข้อมูล ({prefix}_stat1..8 · หมายเหตุ · คำเตือน) → เนื้อหายาวจาก editor → แถบติดต่อ
 * ============================================================== */

function eaw_products_page( $prefix ) {
	get_header();

	if ( have_posts() ) {
		the_post();
	}
	$sub     = eaw_mod( $prefix . '_sub' );
	$note    = eaw_mod( $prefix . '_note' );
	$actions = eaw_pages_capture(
		'eaw_contact_button',
		array(
			'class' => 'btn btn-fire',
			'pos'   => $prefix . '-hero',
		)
	);
	$dl      = eaw_theme_asset_url( eaw_mod( $prefix . '_dl_url' ) );
	if ( '' !== $dl && '' !== trim( (string) eaw_mod( $prefix . '_dl_label' ) ) ) {
		$actions .= sprintf(
			'<a class="btn btn-ghost" href="%1$s"%2$s data-go-pos="%3$s-download">%4$s<span>%5$s</span></a>',
			esc_url( $dl ),
			preg_match( '/\.(zip|ex5|pdf)([?#]|$)/i', $dl ) ? ' download' : '',
			esc_attr( $prefix ),
			eaw_icon( 'download' ),
			esc_html( eaw_mod( $prefix . '_dl_label' ) )
		);
	}
	?>

<main id="main" class="pg tests-page product-page product-page--<?php echo esc_attr( $prefix ); ?>">

	<?php
	eaw_pages_hero(
		array(
			'title'   => get_the_title(),
			'lead'    => eaw_pages_has( $sub ) ? $sub : '',
			'actions' => $actions,
			'media'   => eaw_pages_hero_media( $prefix, '' ),
		)
	);
	?>

	<section class="pg-sec tests-top">
		<div class="container">
			<div class="glass-panel pg-panel tests-panel">
				<?php eaw_pages_stats( $prefix, 8, $prefix ); ?>
				<div class="tests-notes<?php echo eaw_pages_has( $note ) ? '' : ' tests-notes--solo'; ?>">
					<?php if ( eaw_pages_has( $note ) ) : ?>
						<p class="pg-note tests-note"><span class="tile tile--sky" aria-hidden="true"><?php echo eaw_icon( 'cpu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( $note ); ?></span></p>
					<?php endif; ?>
					<?php /* คำเตือน · ไม่ใช้ .reveal เพื่อให้เห็นทันทีแม้ JS ไม่ทำงาน */ ?>
					<div class="pg-warn tests-disclaimer">
						<span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'warn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<p><?php echo esc_html( eaw_mod( $prefix . '_disclaimer' ) ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	eaw_pages_enable_table_cards();
	eaw_pages_longform();
	eaw_line_cta( eaw_mod( $prefix . '_cta_title' ), eaw_mod( $prefix . '_cta_text' ) );
	?>

</main>

	<?php
	get_footer();
}

/* ==============================================================
 * หน้าแรก [products] · การ์ดสินค้าเรียงตามเลขรุ่น (home_{key}_* ของแต่ละสินค้า)
 * ============================================================== */

add_filter( 'eaw_defaults', 'eaw_products_defaults' );

function eaw_products_defaults( $d ) {
	return array_merge(
		$d,
		array(
			'show_home_products'  => true,
			'home_products_title' => 'EA ทองคำของ EA WING ทั้ง 3 ตัว',
			'home_products_sub'   => 'เรียงตามเลขรุ่น ทั้งสามตัวเทรดทองคำ XAUUSD บน MT5 แต่ทำงานคนละวิธี ใช้บัญชีและเงินทุนต่างกัน แพ็กเกจเดียวใช้ได้ทั้ง 3 ตัว เลือกตัวที่เข้ากับบัญชีของคุณ หรือถามทีมงานทาง LINE ก่อนก็ได้',
			'home_products_note'  => 'ทั้งสามตัวไม่มีการตัดขาดทุนอัตโนมัติ บัญชีเสียหายหนักได้ถึงเสียเงินทั้งหมด · ผลทดสอบย้อนหลังไม่ใช่สัญญาว่าจะได้กำไร · ห้ามรันสองตัวบนทองตัวเดียวกันในบัญชีเดียวกัน',

			/* ---------- หน้า /ea-wing/ (ข้อเท็จจริงจากเอกสาร EA WING 5.0 ของเจ้าของ · หลักข้อ 2 ใน CLAUDE.md) ---------- */
			'eawing_sub'          => 'EA เทรดทองคำ XAUUSD อัตโนมัติบน MT5 มีสามโหมด Lite Advance Full ในไฟล์เดียว เปิดออเดอร์เป็นชุด ราคาสวนทางเติมไม้แก้เป็นขั้นบันไดสูงสุด 9 ขั้น แล้วปิดทั้งชุดเมื่อถึงเป้ากำไร โหมดสำเร็จรูปไม่มีการตัดขาดทุนอัตโนมัติ อ่านความเสี่ยงให้ครบก่อนใช้เงินจริง',
			'eawing_hero_img'     => 'assets/img/products/ea-wing-card-v2.webp',
			'eawing_dl_url'       => 'assets/downloads/EA_WING_V5.0.zip',
			'eawing_dl_label'     => 'ดาวน์โหลด EA WING V5.0',
			'eawing_stat1_label'  => 'โหมดในตัว',
			'eawing_stat1_value'  => 'Lite · Advance · Full',
			'eawing_stat2_label'  => 'กราฟ',
			'eawing_stat2_value'  => 'XAUUSD · M1',
			'eawing_stat3_label'  => 'ไม้แก้',
			'eawing_stat3_value'  => 'สูงสุด 9 ขั้น',
			'eawing_stat4_label'  => 'เงินในบัญชีที่แนะนำ',
			'eawing_stat4_value'  => '1 / 2 / 3 เท่าของทุนคิดไม้',
			'eawing_stat5_label'  => 'ทุนแนะนำ บัญชีเซนต์',
			'eawing_stat5_value'  => 'ราว 1,000 USD ขึ้นไป',
			'eawing_stat6_label'  => 'ทุนแนะนำ บัญชีมาตรฐาน',
			'eawing_stat6_value'  => 'ราว 100,000 USD ขึ้นไป',
			'eawing_stat7_label'  => 'หลบข่าวแดง USD',
			'eawing_stat7_value'  => 'ก่อน 90 · หลัง 720 นาที',
			'eawing_stat8_label'  => 'ตัดขาดทุนอัตโนมัติ',
			'eawing_stat8_value'  => 'ไม่มีในโหมดสำเร็จรูป',
			'eawing_note'         => 'ทุนคิดไม้คือตัวเลขที่ EA ใช้คิดขนาดออเดอร์ เงินในบัญชีที่เกินทุนคิดไม้คือเงินกันชน · Lite 1 เท่า Advance 2 เท่า Full 3 เท่าของทุนคิดไม้ · แพ็กเกจเดียวใช้ได้ทั้ง 3 ตัว · ห้ามรันคู่กับไม้มือหรือ EA ตัวอื่นบนทองตัวเดียวกันในบัญชีเดียวกัน',
			'eawing_disclaimer'   => 'ระบบทบไม้ โหมดสำเร็จรูปไม่มีการตัดขาดทุนอัตโนมัติ บัญชีเสียหายหนักได้ถึงเสียเงินทั้งหมด · ผลทดสอบย้อนหลังไม่ใช่ผลการเทรดจริงและไม่รับประกันผลในอนาคต',
			'eawing_cta_title'    => 'สนใจ EA WING หรืออยากรู้ว่าโหมดไหนเข้ากับเงินในบัญชี',
			'eawing_cta_text'     => 'แพ็กเกจเดียวใช้ได้ทั้ง 3 ตัว ทักทีมงานทาง LINE ถามเรื่องโหมดและเงินในบัญชี แล้วส่งเลขบัญชี MT5 กับชื่อเซิร์ฟเวอร์เพื่อขอเปิดสิทธิ์ใช้งาน',

			/* การ์ด EA WING ในส่วนสินค้าหน้าแรก */
			'home_eawing_name'    => 'EA WING',
			'home_eawing_heading' => 'สามโหมด Lite Advance Full',
			'home_eawing_text'    => 'เปิดออเดอร์เป็นชุด ราคาสวนทางเติมไม้แก้ที่ใหญ่ขึ้นเป็นขั้นบันไดสูงสุด 9 ขั้น แล้วปิดทั้งชุดเมื่อถึงเป้ากำไร เลือกระดับความเสี่ยงได้สามโหมดจากแดชบอร์ด',
			'home_eawing_points'  => "เงินในบัญชีที่แนะนำ 1 / 2 / 3 เท่าของทุนคิดไม้ ตามโหมด Lite Advance Full\nทุนแนะนำ: บัญชีเซนต์ราว 1,000 USD ขึ้นไป · บัญชีมาตรฐานราว 100,000 USD ขึ้นไป\nโหมดสำเร็จรูปไม่มีการตัดขาดทุนอัตโนมัติ",
			'home_eawing_img'     => 'assets/img/products/ea-wing-go-card-v2.webp',
			'home_eawing_img_alt' => 'การ์ดสินค้า EA WING Expert Advisor สำหรับ MT5',
			'home_eawing_btn'     => 'ดูรายละเอียด EA WING',
			'home_eawing_url'     => '/ea-wing/',
		)
	);
}

add_filter( 'eaw_customizer_sections', 'eaw_products_customizer_sections', 12, 2 );

function eaw_products_customizer_sections( $sections, $d ) {
	$rule                      = 'ใช้ข้อเท็จจริงจากเอกสาร EA WING 5.0 ของเจ้าของ · ต้องบอกว่าไม่มีการตัดขาดทุนอัตโนมัติ';
	$stats                     = array();
	for ( $i = 1; $i <= 8; $i++ ) {
		$stats[ 'eawing_stat' . $i . '_label' ] = array( 'การ์ดข้อมูล ' . $i . ' · หัวข้อ (ว่าง = ซ่อน)', 'text' );
		$stats[ 'eawing_stat' . $i . '_value' ] = array( 'การ์ดข้อมูล ' . $i . ' · ค่า', 'text' );
	}
	$sections['eaw_eawing']    = array(
		'title'       => '34.5) สินค้า EA WING (หน้า /ea-wing/)',
		'description' => 'เนื้อหายาวของหน้าอยู่ที่ inc/content/pages/ea-wing.html (EA WING Setup) · ชื่อไฟล์และเลขรุ่นมาจากหมวด 29 · การ์ด /go ใช้ go_fast_* ในหมวด /go',
		'fields'      => array_merge(
			array(
				'eawing_sub'      => array( 'หน้าสินค้า · คำอธิบายใต้ชื่อ', 'textarea', $rule ),
				'eawing_hero_img' => array( 'หน้าสินค้า · ภาพการ์ดสินค้าในหัวเพจ', 'image' ),
				'eawing_dl_url'   => array( 'หน้าสินค้า · ลิงก์ดาวน์โหลดไฟล์ zip (ว่าง = ไม่มีปุ่ม)', 'path' ),
				'eawing_dl_label' => array( 'หน้าสินค้า · ข้อความปุ่มดาวน์โหลด', 'text' ),
			),
			$stats,
			array(
				'eawing_note'       => array( 'หน้าสินค้า · หมายเหตุใต้การ์ดข้อมูล', 'textarea' ),
				'eawing_disclaimer' => array( 'หน้าสินค้า · คำเตือนใต้การ์ดข้อมูล (ห้ามลบ)', 'textarea' ),
				'eawing_cta_title'  => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · หัวข้อ', 'text' ),
				'eawing_cta_text'   => array( 'หน้าสินค้า · แถบติดต่อท้ายหน้า · คำอธิบาย', 'textarea' ),
			)
		),
	);
	$sections['eaw_products']  = array(
		'title'       => '37) หน้าแรก · ส่วนสินค้า (เรียงตามเลขรุ่น)',
		'description' => 'การ์ดสินค้าเรียงตามเลขรุ่นเอง (WING NITRO · EA WING · WING TWIN) · ข้อความการ์ด WING NITRO อยู่หมวด 35 · WING TWIN อยู่หมวด 36 · การ์ด EA WING อยู่ที่นี่',
		'fields'      => array(
			'show_home_products'  => array( 'แสดงส่วนสินค้าในหน้าแรก', 'checkbox' ),
			'home_products_title' => array( 'หัวข้อส่วน (H2)', 'text' ),
			'home_products_sub'   => array( 'คำอธิบายใต้หัวข้อ', 'textarea' ),
			'home_products_note'  => array( 'คำเตือนใต้การ์ด (ห้ามลบ)', 'textarea' ),
			'home_eawing_name'    => array( 'การ์ด EA WING · ชื่อ (เลขรุ่นต่อท้ายให้เอง)', 'text' ),
			'home_eawing_heading' => array( 'การ์ด EA WING · หัวข้อย่อย', 'text' ),
			'home_eawing_text'    => array( 'การ์ด EA WING · คำอธิบาย', 'textarea', $rule ),
			'home_eawing_points'  => array( 'การ์ด EA WING · จุดสำคัญ (บรรทัดละ 1 ข้อ)', 'textarea', $rule ),
			'home_eawing_img'     => array( 'การ์ด EA WING · ภาพ (2:1)', 'image' ),
			'home_eawing_img_alt' => array( 'การ์ด EA WING · คำอธิบายภาพ (alt)', 'text' ),
			'home_eawing_btn'     => array( 'การ์ด EA WING · ข้อความปุ่ม', 'text' ),
			'home_eawing_url'     => array( 'การ์ด EA WING · ลิงก์ปุ่ม', 'path', 'slug ในเว็บ เช่น /ea-wing/' ),
		),
	);
	return $sections;
}

function eaw_homeplus_products() {
	$cards = '';
	foreach ( eaw_products() as $item ) {
		$p    = 'home_' . $item['key'];
		$name = trim( (string) eaw_mod( $p . '_name' ) );
		if ( '' === $name ) {
			continue;
		}
		$img    = eaw_theme_asset_url( eaw_mod( $p . '_img' ) );
		$points = eaw_lines( eaw_mod( $p . '_points' ) );
		$url    = eaw_home_link( eaw_mod( $p . '_url' ) );
		ob_start();
		?>
		<article class="hp-prod hp-prod--<?php echo esc_attr( $item['key'] ); ?>">
			<?php if ( '' !== $img ) : ?>
				<?php $info = eaw_media_info( $img, 960, 480 ); ?>
				<span class="hp-prod-shot">
					<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( trim( (string) eaw_mod( $p . '_img_alt' ) ) ); ?>" width="<?php echo (int) $info['width']; ?>" height="<?php echo (int) $info['height']; ?>" loading="lazy" decoding="async">
				</span>
			<?php endif; ?>
			<div class="hp-prod-copy">
				<h3 class="hp-prod-name"><?php echo esc_html( $name ); ?> <span class="hp-prod-ver"><?php echo esc_html( $item['version'] ); ?></span></h3>
				<?php if ( '' !== trim( (string) eaw_mod( $p . '_heading' ) ) ) : ?>
					<p class="hp-prod-tag"><?php echo esc_html( eaw_mod( $p . '_heading' ) ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== trim( (string) eaw_mod( $p . '_text' ) ) ) : ?>
					<p><?php echo esc_html( eaw_mod( $p . '_text' ) ); ?></p>
				<?php endif; ?>
				<?php if ( $points ) : ?>
					<ul class="hp-checks">
						<?php foreach ( $points as $point ) : ?>
							<li><?php echo eaw_icon( 'check', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $point ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if ( '' !== $url && '' !== trim( (string) eaw_mod( $p . '_btn' ) ) ) : ?>
					<div class="hp-actions"><?php eaw_home_btn( eaw_mod( $p . '_btn' ), $url, 'btn btn-ghost hm-btn hm-btn--sm', 'arrow-ur' ); ?></div>
				<?php endif; ?>
			</div>
		</article>
		<?php
		$cards .= ob_get_clean();
	}
	if ( '' === $cards ) {
		return;
	}
	$warn = trim( (string) eaw_mod( 'home_products_note' ) );
	?>
<section class="glass-panel hm-panel hp-products" id="products" aria-labelledby="hp-products-title">
	<?php eaw_homeplus_head( 'hp-products-title', eaw_mod( 'home_products_title' ), eaw_mod( 'home_products_sub' ) ); ?>
	<div class="hp-prod-grid">
		<?php echo $cards; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above ?>
	</div>
	<?php if ( '' !== $warn ) : ?>
		<p class="hm-note"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $warn ); ?></span></p>
	<?php endif; ?>
</section>
	<?php
}

/* ==============================================================
 * หน้า /go ขั้น 4 · การ์ดดาวน์โหลดทุกสินค้าตามลำดับเลขรุ่น
 * ใบแรกไม่มีกรอบคั่น ใบถัดไปห่อด้วย .lh-product (เส้นคั่นบน) · มีปุ่มเล็ก {go}_info_label / {go}_info_url ได้
 * ============================================================== */

function eaw_go_product_downloads() {
	$html  = '';
	$first = true;
	foreach ( eaw_products() as $item ) {
		$card = eaw_go_download_card( $item['go'], $item['pos'] );
		if ( '' === $card ) {
			continue;
		}
		$card .= eaw_go_button( 'lh-mini-btn', eaw_go_mod( $item['go'] . '_info_label' ), eaw_go_mod( $item['go'] . '_info_url' ), 'book' );
		$html .= $first ? $card : '<div class="lh-product">' . $card . '</div>';
		$first = false;
	}
	return $html;
}
