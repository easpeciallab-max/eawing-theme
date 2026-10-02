<?php
/**
 * EA WING · โครงสร้างเพจ + ตัวช่วยตั้งค่าเว็บ (รูปแบบ → EA WING Setup)
 *
 * - eaw_site_pages()     : รายการเพจทั้งหมดของเว็บ (slug → template, เนื้อหาเริ่มต้น, กลุ่มเมนู)
 * - eaw_seed_articles()  : บทความ SEO เริ่มต้น (นำเข้าเป็นฉบับร่าง)
 * - หน้า admin             : สร้างเพจที่ยังไม่มี, ตั้งหน้าแรก/หน้าบทความ, สร้างเมนู, นำเข้าบทความ
 *
 * เนื้อหาเริ่มต้นอยู่ใน inc/content/pages/*.html และ inc/content/articles/*.html
 * บรรทัดแรกของไฟล์เป็น <!--meta {...json...} --> (title, seo_title, description, keyword, excerpt, category, kicker)
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * รายการเพจของเว็บ (ลำดับ = ลำดับที่แสดงในหน้า Setup)
 * group: test | guide | pricing | doc | hub
 * status: publish | draft (เพจกฎหมายสร้างเป็นร่างให้เจ้าของตรวจก่อนเผยแพร่)
 */
function eaw_site_pages() {
	return array(
		'home'             => array( 'title' => 'หน้าแรก', 'template' => '', 'content' => '', 'group' => 'hub', 'front' => true, 'seo' => array( 'seo_title' => 'EA WING · EA MT5 ผู้ช่วยเทรดอัตโนมัติอย่างมีแบบแผน', 'description' => 'EA WING ผู้ช่วยเทรดอัตโนมัติสำหรับ MetaTrader 5 ทำงานตามเงื่อนไขที่ตั้งไว้ เน้นวางแผน ติดตามผล และบริหารความเสี่ยง มีคู่มือภาษาไทยและทีมงานช่วยติดตั้งทาง LINE', 'keyword' => 'EA WING EA MT5' ) ),
		'backtest'         => array( 'title' => 'ทดสอบ EA ย้อนหลังใน MT5', 'template' => 'template-backtest.php', 'content' => 'pages/backtest', 'group' => 'test', 'menu' => 'Backtest' ),
		'forward-test'     => array( 'title' => 'ทดสอบ EA กับตลาดจริง', 'template' => 'template-forward.php', 'content' => 'pages/forward-test', 'group' => 'test', 'menu' => 'Forward Test' ),
		'how-to-install'   => array( 'title' => 'วิธีติดตั้ง EA ใน MT5', 'template' => 'template-install.php', 'content' => 'pages/how-to-install', 'group' => 'guide', 'menu' => 'วิธีติดตั้ง EA บน MT5' ),
		'open-mt5-account' => array( 'title' => 'เปิดบัญชี MT5', 'template' => 'template-guide.php', 'content' => 'pages/open-mt5-account', 'group' => 'guide', 'menu' => 'เปิดบัญชีเทรด MT5' ),
		'mt5-login'        => array( 'title' => 'ติดตั้งและล็อกอิน MT5', 'template' => 'template-guide.php', 'content' => 'pages/mt5-login', 'group' => 'guide', 'menu' => 'ติดตั้งและล็อกอิน MT5' ),
		'vps-windows'      => array( 'title' => 'คู่มือ VPS บน Windows', 'template' => 'template-guide.php', 'content' => 'pages/vps-windows', 'group' => 'guide', 'menu' => 'VPS บน Windows' ),
		'vps-android'      => array( 'title' => 'คู่มือ VPS บน Android', 'template' => 'template-guide.php', 'content' => 'pages/vps-android', 'group' => 'guide', 'menu' => 'VPS บน Android' ),
		'vps-ios'          => array( 'title' => 'คู่มือ VPS บน iPhone', 'template' => 'template-guide.php', 'content' => 'pages/vps-ios', 'group' => 'guide', 'menu' => 'VPS บน iPhone / iPad' ),
		'tools'            => array( 'title' => 'เครื่องมือคำนวณ', 'template' => 'template-guide.php', 'content' => 'pages/tools', 'group' => 'guide', 'menu' => 'เครื่องคำนวณ Lot / Drawdown' ),
		'pricing'          => array( 'title' => 'แพ็กเกจและราคา', 'template' => 'template-pricing.php', 'content' => 'pages/pricing', 'group' => 'pricing' ),
		'risk-disclosure'  => array( 'title' => 'ประกาศความเสี่ยง', 'template' => 'template-risk.php', 'content' => 'pages/risk-disclosure', 'group' => 'doc' ),
		'about'            => array( 'title' => 'เกี่ยวกับเรา', 'template' => '', 'content' => 'pages/about', 'group' => 'doc' ),
		'privacy-policy'   => array( 'title' => 'นโยบายความเป็นส่วนตัว', 'template' => '', 'content' => 'pages/privacy-policy', 'group' => 'doc', 'status' => 'draft' ),
		'terms-of-use'     => array( 'title' => 'ข้อกำหนดและเงื่อนไขการใช้บริการ', 'template' => '', 'content' => 'pages/terms-of-use', 'group' => 'doc', 'status' => 'draft' ),
		'data-deletion'    => array( 'title' => 'คำขอลบข้อมูลส่วนบุคคล', 'template' => '', 'content' => 'pages/data-deletion', 'group' => 'doc', 'status' => 'draft' ),
		'go'               => array( 'title' => 'ติดต่อ EA WING', 'template' => 'template-go.php', 'content' => '', 'group' => 'hub', 'seo' => array( 'seo_title' => 'ติดต่อ EA WING · LINE และลิงก์รวมสำหรับเริ่มใช้งาน', 'description' => 'ทัก LINE ทีมงาน EA WING หรือเข้ากลุ่ม OpenChat แล้วเดินตาม 6 ขั้นตอนเริ่มใช้งาน: เปิดบัญชี ติดตั้ง MT5 ฝากเงิน รับไฟล์ EA ติดตั้ง และรันบน VPS', 'keyword' => 'ติดต่อ EA WING' ) ),
		'articles'         => array( 'title' => 'บทความ EA WING', 'template' => '', 'content' => '', 'group' => 'hub', 'posts' => true, 'seo' => array( 'seo_title' => 'บทความวางแผน ติดตามผล และบริหารความเสี่ยง · EA WING', 'description' => 'บทความภาษาไทยสำหรับคนใช้ EA บน MT5: เขียนแผนการเทรด แบ่งทุน ตั้งเพดานขาดทุน ติดตามพอร์ตบนมือถือ อ่าน Log และคุมความเสี่ยงอย่างเป็นระบบ', 'keyword' => 'บทความ EA MT5' ) ),
	);
}

/**
 * รายการบทความเริ่มต้น: slug => แบนเนอร์สำรอง
 * (ใช้เมื่อยังไม่มีรูปปกเฉพาะบทความที่ assets/img/covers/<slug>.webp · สร้างด้วย dev/make-covers.php)
 * ฟังก์ชันนี้ไม่อ่านไฟล์ จึงเรียกจากหน้าเว็บได้ทุกคำขอ
 */
function eaw_seed_article_covers() {
	/* บทความรอบแรกของ EA WING (docs/plan.md ข้อ 4) · slug ที่ยังไม่มีไฟล์เนื้อหาจะถูกข้ามอัตโนมัติ */
	return array(
		'trading-plan-for-ea'     => 'eawing-plan-fly-further-sky.webp',
		'risk-per-trade'          => 'eawing-plan-blue-icons.webp',
		'capital-split-ea'        => 'eawing-plan-white-wing.webp',
		'daily-loss-limit'        => 'eawing-plan-track-risk-light.webp',
		'mt5-mobile-monitor'      => 'eawing-mt5-laptop-phone.webp',
		'mt5-push-notification'   => 'eawing-plan-sky-blue.webp',
		'mt5-journal-experts-tab' => 'eawing-mt5-navigator-laptop.webp',
		'mt5-history-report'      => 'eawing-plan-sky-chart.webp',
		'equity-vs-balance'       => 'eawing-plan-sky-clouds.webp',
		'risk-reward-ratio'       => 'eawing-plan-feathers.webp',
		'currency-correlation'    => 'eawing-plan-track-risk-night.webp',
		'weekend-gap-ea'          => 'eawing-plan-feathers-night.webp',
	);
}

/**
 * บทความเริ่มต้น (slug => ไฟล์ + รูปหน้าปก) · อ่านไฟล์เนื้อหา ใช้ในหน้า Setup เท่านั้น
 */
function eaw_seed_articles() {
	static $list = null;
	if ( null !== $list ) {
		return $list;
	}
	$img  = get_template_directory() . '/assets/img/';
	$list = array();
	foreach ( eaw_seed_article_covers() as $slug => $banner ) {
		$meta = eaw_seed_meta( 'articles/' . $slug );
		if ( null === $meta ) {
			continue; // ยังไม่มีไฟล์เนื้อหา
		}
		$own           = 'covers/' . $slug . '.webp';
		$list[ $slug ] = array(
			'title'   => ! empty( $meta['title'] ) ? $meta['title'] : $slug,
			'content' => 'articles/' . $slug,
			'cover'   => file_exists( $img . $own ) ? $own : 'banners/' . $banner,
			'meta'    => $meta,
		);
	}
	return $list;
}

/**
 * อ่านไฟล์เนื้อหาเริ่มต้น → array( 'meta' => array, 'body' => string ) หรือ null ถ้าไม่มีไฟล์
 */
function eaw_seed_file( $rel ) {
	static $cache = array();
	if ( isset( $cache[ $rel ] ) ) {
		return $cache[ $rel ];
	}
	$rel  = preg_replace( '#[^a-z0-9/_\-]#', '', strtolower( (string) $rel ) );
	$path = get_template_directory() . '/inc/content/' . $rel . '.html';
	if ( '' === $rel || ! file_exists( $path ) ) {
		$cache[ $rel ] = null;
		return null;
	}
	$raw  = (string) file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$meta = array();
	if ( preg_match( '/^\s*<!--meta\s+(\{.*?\})\s*-->\s*/s', $raw, $m ) ) {
		$decoded = json_decode( $m[1], true );
		if ( is_array( $decoded ) ) {
			$meta = $decoded;
		}
		$raw = substr( $raw, strlen( $m[0] ) );
	}
	$cache[ $rel ] = array(
		'meta' => $meta,
		'body' => trim( $raw ),
	);
	return $cache[ $rel ];
}

function eaw_seed_meta( $rel ) {
	$file = eaw_seed_file( $rel );
	return $file ? $file['meta'] : null;
}

/**
 * เนื้อหาพร้อมใช้ ({{home}} → URL เว็บ)
 */
function eaw_seed_content( $rel ) {
	$file = eaw_seed_file( $rel );
	if ( ! $file ) {
		return '';
	}
	return str_replace( '{{home}}', untrailingslashit( home_url() ), $file['body'] );
}

/**
 * ป้ายเล็กเหนือหัวเพจ (kicker) จากไฟล์เนื้อหา หรือกลุ่มเพจ
 */
function eaw_page_kicker( $slug ) {
	$pages = eaw_site_pages();
	if ( isset( $pages[ $slug ] ) && ! empty( $pages[ $slug ]['content'] ) ) {
		$meta = eaw_seed_meta( $pages[ $slug ]['content'] );
		if ( ! empty( $meta['kicker'] ) ) {
			return $meta['kicker'];
		}
	}
	$groups = array(
		'test'    => 'Testing',
		'guide'   => 'Guide',
		'pricing' => 'Pricing',
		'doc'     => 'Document',
	);
	$group = isset( $pages[ $slug ]['group'] ) ? $pages[ $slug ]['group'] : '';
	return isset( $groups[ $group ] ) ? $groups[ $group ] : 'EA WING';
}

/**
 * รายการคู่มือ (ใช้ในเมนู, footer, หน้า /articles/, กล่องคู่มือที่เกี่ยวข้อง)
 */
function eaw_guide_links( $groups = array( 'guide', 'test' ) ) {
	$out = array();
	foreach ( eaw_site_pages() as $slug => $page ) {
		if ( in_array( $page['group'], (array) $groups, true ) ) {
			$out[ $slug ] = array(
				'label' => ! empty( $page['menu'] ) ? $page['menu'] : $page['title'],
				'url'   => home_url( '/' . $slug . '/' ),
			);
		}
	}
	return $out;
}

/**
 * URL ของเพจตาม slug เฉพาะเมื่อเผยแพร่แล้ว (ฉบับร่าง/ไม่มี = '') · กันลิงก์ 404 ไปยังเพจกฎหมายที่ยังเป็นร่าง
 */
function eaw_published_page_url( $slug ) {
	static $cache = array();
	if ( isset( $cache[ $slug ] ) ) {
		return $cache[ $slug ];
	}
	$page            = get_page_by_path( $slug );
	$cache[ $slug ] = ( $page && 'publish' === get_post_status( $page ) ) ? get_permalink( $page ) : '';
	return $cache[ $slug ];
}

/**
 * slug ของบทความเริ่มต้นที่ผู้เข้าชมยังเปิดไม่ได้ (ยังไม่ได้นำเข้า หรือยังเป็นฉบับร่าง)
 * · 1 query (อ่านเฉพาะคอลัมน์ post_name) ต่อคำขอ
 */
function eaw_unpublished_seed_articles() {
	if ( isset( $GLOBALS['eaw_unpublished_seed'] ) ) {
		return $GLOBALS['eaw_unpublished_seed'];
	}
	global $wpdb;
	$slugs = array_keys( eaw_seed_article_covers() );
	$in    = implode( ',', array_fill( 0, count( $slugs ), '%s' ) );
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.PreparedSQLPlaceholders.UnfinishedPrepare -- $in มีแต่ %s
	$have = (array) $wpdb->get_col( $wpdb->prepare( "SELECT post_name FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_name IN ($in)", $slugs ) );

	$GLOBALS['eaw_unpublished_seed'] = array_values( array_diff( $slugs, $have ) );
	return $GLOBALS['eaw_unpublished_seed'];
}

/**
 * เผยแพร่/ถอนบทความระหว่างคำขอ (เช่นนำเข้าแบบเผยแพร่ทันที) → คำนวณรายการใหม่
 */
function eaw_unpublished_seed_reset() {
	unset( $GLOBALS['eaw_unpublished_seed'] );
}
add_action( 'transition_post_status', 'eaw_unpublished_seed_reset' );

/**
 * ตัดลิงก์ที่ชี้ไปยัง slug ในรายการ $slugs (ปลายทางที่ผู้เข้าชมยังเปิดไม่ได้) ออกจาก HTML
 * 1) ประโยคอ้างอิงที่ห่อด้วย <span class="xref"> หรือ <p class="xref"> → ลบทั้งประโยค
 * 2) รายการ <li> ที่มีแต่ลิงก์นั้น (เช่นในกล่อง "ที่เกี่ยวข้อง") → ลบทั้งรายการ · กล่องที่ว่างลงถูกลบด้วย
 * 3) ลิงก์ที่เหลือในเนื้อความ → ข้อความธรรมดา
 * กติกาความปลอดภัย: ทุกขั้นหยุดที่ขอบบล็อก (li, p, ul, div, h2 ...) และไม่ข้ามแท็กซ้อนชนิดเดียวกัน
 * ถ้า HTML ผิดรูปจน match ไม่ได้ ขั้นนั้นไม่ทำอะไร (ลิงก์อาจยังเหลือ แต่เนื้อหาไม่มีวันหาย)
 * · ขั้นใดล้มเหลว (null) จะข้ามขั้นนั้น · ใช้ quantifier แบบ possessive จึงไม่ติด backtrack/JIT limit
 */
function eaw_unlink_slugs( $content, $slugs ) {
	if ( ! $slugs || false === stripos( (string) $content, '<a' ) ) {
		return $content;
	}
	// ที่อยู่ปลายทาง: แบบเต็ม (http/https หรือ //), แบบ /slug/ ภายในเว็บ · ท้ายมี ?query หรือ #anchor ได้
	$parts = wp_parse_url( home_url() );
	$host  = isset( $parts['host'] ) ? preg_quote( $parts['host'], '#' ) : '';
	$path  = isset( $parts['path'] ) ? preg_quote( untrailingslashit( $parts['path'] ), '#' ) : '';
	$alt   = implode( '|', array_map( function ( $s ) { return preg_quote( $s, '#' ); }, $slugs ) );
	$url   = '(?:(?:https?:)?//' . $host . '(?::\d+)?)?' . $path . '/(?:' . $alt . ')/?(?:[?\#][^"\'\s>]*)?';
	$href  = '<a\s[^>]*?href\s*=\s*(?:"' . $url . '"|\'' . $url . '\')[^>]*>';
	$block = '(?:li|p|ul|ol|div|h[1-6]|table|thead|tbody|tr|td|th|details|summary|blockquote|section|figure)\b';
	// ข้อความในลิงก์: ห้ามข้าม </a> และห้ามข้ามขอบบล็อก
	$text  = '((?:[^<]++|<(?!/a\s*>|/?' . $block . '))*+)';
	$link  = $href . $text . '</a\s*>';
	// ข้อความในประโยค xref: ห้ามมีแท็กชนิดเดียวกันซ้อน และห้ามข้ามขอบบล็อก
	$xtext = '(?:(?!</?(?:\1\b|' . $block . ')).)*';
	$steps = array(
		array( '#\s*<(p|span) class="xref">' . $xtext . '?' . $href . $xtext . '</\1>#is', '' ),
		array( '#<li>\s*' . $link . '\s*</li>\s*#is', '' ),
		array( '#<div class="related-links">\s*<h2[^>]*>(?:(?!</?h2\b).)*</h2>\s*<ul[^>]*>\s*</ul>\s*</div>#is', '' ),
		array( '#' . $link . '#is', '$1' ),
	);
	foreach ( $steps as $step ) {
		$next = preg_replace( $step[0], $step[1], $content );
		if ( null !== $next ) {
			$content = $next;
		}
	}
	return $content;
}

/**
 * ในเนื้อหา: ลิงก์ไปเพจที่ Setup สร้างเป็นฉบับร่าง (เพจกฎหมาย) หรือบทความเริ่มต้นที่ยังไม่เผยแพร่
 * จะไม่เป็นลิงก์จนกว่าปลายทางจะเผยแพร่ (กันลิงก์ 404 ระหว่างทยอยเผยแพร่บทความ) · กติกาอยู่ที่ eaw_unlink_slugs()
 * · priority 15: หลัง wpautop (10) และ shortcode (11) ก่อนสร้างสารบัญ (20) สารบัญจึงไม่มีหัวข้อที่ถูกลบ
 * · ทำเฉพาะตอนแสดงผลให้ผู้เข้าชม ไม่ทำในหลังบ้าน/REST/cron (ปลั๊กอิน SEO ที่นับลิงก์ภายในจะเห็นลิงก์ครบ)
 */
function eaw_unlink_draft_pages( $content ) {
	if ( false === stripos( (string) $content, '<a' ) ) {
		return $content;
	}
	if ( ( is_admin() && ! wp_doing_ajax() ) || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $content;
	}
	return eaw_unlink_slugs( $content, eaw_unreachable_slugs() );
}

/**
 * slug ที่ผู้เข้าชมยังเปิดไม่ได้: เพจที่ Setup สร้างเป็นฉบับร่าง (เพจกฎหมาย) + บทความเริ่มต้นที่ยังไม่เผยแพร่
 * ใช้ทั้งกับเนื้อหาเพจ (eaw_unlink_draft_pages) และลิงก์ [ข้อความ](/slug/) ในข้อความ Customizer (eaw_rich_inline)
 */
function eaw_unreachable_slugs() {
	$drafts = array();
	foreach ( eaw_site_pages() as $slug => $page ) {
		if ( isset( $page['status'] ) && 'draft' === $page['status'] && ! eaw_published_page_url( $slug ) ) {
			$drafts[] = $slug;
		}
	}
	return array_merge( $drafts, eaw_unpublished_seed_articles() );
}
add_filter( 'the_content', 'eaw_unlink_draft_pages', 15 );

/* ==============================================================
 * Admin · รูปแบบ → EA WING Setup
 * ============================================================== */

function eaw_setup_menu() {
	add_theme_page( 'EA WING Setup', 'EA WING Setup', 'edit_theme_options', 'eawing-setup', 'eaw_setup_screen' );
}
add_action( 'admin_menu', 'eaw_setup_menu' );

/**
 * หา page จาก slug (รวมฉบับร่าง)
 */
function eaw_find_page( $slug ) {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page ) {
		return $page;
	}
	$q = get_posts(
		array(
			'name'           => $slug,
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
			'posts_per_page' => 1,
		)
	);
	return $q ? $q[0] : null;
}

function eaw_find_post( $slug ) {
	$q = get_posts(
		array(
			'name'           => $slug,
			'post_type'      => 'post',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private', 'future' ),
			'posts_per_page' => 1,
		)
	);
	return $q ? $q[0] : null;
}

/**
 * ใส่ SEO meta ให้ Yoast / Rank Math (ถ้ามีค่าในไฟล์)
 */
function eaw_apply_seo_meta( $post_id, $meta ) {
	$meta = wp_slash( $meta ); // update_post_meta() คาดหวังข้อมูลแบบ slashed
	if ( ! empty( $meta['seo_title'] ) ) {
		update_post_meta( $post_id, '_yoast_wpseo_title', $meta['seo_title'] );
		update_post_meta( $post_id, 'rank_math_title', $meta['seo_title'] );
	}
	if ( ! empty( $meta['description'] ) ) {
		update_post_meta( $post_id, '_yoast_wpseo_metadesc', $meta['description'] );
		update_post_meta( $post_id, 'rank_math_description', $meta['description'] );
		update_post_meta( $post_id, 'eaw_meta_description', $meta['description'] );
	}
	if ( ! empty( $meta['keyword'] ) ) {
		update_post_meta( $post_id, '_yoast_wpseo_focuskw', $meta['keyword'] );
		update_post_meta( $post_id, 'rank_math_focus_keyword', $meta['keyword'] );
	}
}

/**
 * นำรูปแบนเนอร์ในธีมเข้า Media Library (ครั้งเดียว) เพื่อใช้เป็นรูปหน้าปกบทความ
 */
function eaw_banner_attachment( $file, $alt = '' ) {
	// $file = พาธใต้ assets/img/ เฉพาะโฟลเดอร์ banners/ covers/ หรือ brand/ (ชื่อไฟล์ล้วน = banners/)
	$file = ltrim( str_replace( '\\', '/', (string) $file ), '/' );
	if ( false === strpos( $file, '/' ) ) {
		$file = 'banners/' . $file;
	}
	if ( ! preg_match( '#^(banners|covers|brand)/[a-z0-9._-]+$#i', $file ) ) {
		return 0;
	}
	$map = get_option( 'eaw_banner_attachments', array() );
	if ( ! empty( $map[ $file ] ) && get_post( $map[ $file ] ) ) {
		return (int) $map[ $file ];
	}
	$src = get_template_directory() . '/assets/img/' . $file;
	if ( ! file_exists( $src ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = wp_tempnam( basename( $file ) );
	if ( ! $tmp || ! copy( $src, $tmp ) ) {
		return 0;
	}
	$id = media_handle_sideload(
		array(
			'name'     => basename( $file ),
			'tmp_name' => $tmp,
		),
		0,
		'' !== $alt ? $alt : 'EA WING · ภาพประกอบ'
	);
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		return 0;
	}
	update_post_meta( $id, '_wp_attachment_image_alt', '' !== $alt ? $alt : 'EA WING ผู้ช่วยเทรดอัตโนมัติสำหรับ MT5 (ภาพประกอบ)' );
	$map[ $file ] = (int) $id;
	update_option( 'eaw_banner_attachments', $map, false );
	return (int) $id;
}

/**
 * สร้างเพจที่ยังไม่มี · ไม่แตะเนื้อหาเพจที่มีอยู่แล้ว (เว้นแต่เลือก overwrite)
 */
function eaw_setup_create_pages( $overwrite = false ) {
	$log = array();
	foreach ( eaw_site_pages() as $slug => $page ) {
		$meta    = ! empty( $page['content'] ) ? eaw_seed_meta( $page['content'] ) : ( isset( $page['seo'] ) ? $page['seo'] : array() );
		$title   = ! empty( $meta['title'] ) ? $meta['title'] : $page['title'];
		$content = ! empty( $page['content'] ) ? eaw_seed_content( $page['content'] ) : '';
		$status  = isset( $page['status'] ) ? $page['status'] : 'publish';
		$found   = eaw_find_page( $slug );

		$seed_rev = ! empty( $meta['rev'] ) ? (int) $meta['rev'] : 1;
		if ( ! $found ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_status'  => $status,
					'post_title'   => wp_slash( $title ),
					'post_name'    => $slug,
					'post_content' => wp_slash( $content ),
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				$log[] = '✗ ' . $slug . ' · ' . $id->get_error_message();
				continue;
			}
			update_post_meta( $id, 'eaw_seed_rev', $seed_rev );
			$log[] = '✓ สร้าง /' . $slug . '/' . ( 'draft' === $status ? ' (ฉบับร่าง รอตรวจ)' : '' );
			if ( 'privacy-policy' === $slug ) {
				update_option( 'wp_page_for_privacy_policy', (int) $id ); // ตั้งเป็นเพจนโยบายความเป็นส่วนตัวของเว็บ
			}
		} else {
			$id = $found->ID;
			// เพจ Privacy Policy ฉบับร่างที่ WordPress สร้างให้ตอนติดตั้ง (ยังไม่เคยแก้) → แทนด้วยเนื้อหาของธีม
			$core_privacy = 'privacy-policy' === $slug
				&& (int) get_option( 'wp_page_for_privacy_policy' ) === (int) $id
				&& 'draft' === $found->post_status
				&& $found->post_modified === $found->post_date;
			if ( $core_privacy && $content && ! $overwrite ) {
				wp_update_post(
					array(
						'ID'           => $id,
						'post_title'   => wp_slash( $title ),
						'post_content' => wp_slash( $content ),
					)
				);
				update_post_meta( $id, '_wp_page_template', $page['template'] );
				update_post_meta( $id, 'eaw_seed_rev', ! empty( $meta['rev'] ) ? (int) $meta['rev'] : 1 );
				eaw_apply_seo_meta( $id, $meta );
				$log[] = '↻ แทนเพจ Privacy Policy เริ่มต้นของ WordPress ด้วยฉบับของธีม (ยังเป็นฉบับร่าง)';
				continue;
			}
			if ( $overwrite && $content ) {
				wp_update_post(
					array(
						'ID'           => $id,
						'post_content' => wp_slash( $content ),
					)
				);
				update_post_meta( $id, 'eaw_seed_rev', $seed_rev );
				$log[] = '↻ เขียนทับเนื้อหา /' . $slug . '/';
			}
		}

		if ( ! empty( $page['template'] ) ) {
			$current = get_post_meta( $id, '_wp_page_template', true );
			// ว่าง / ปกติ / เขียนทับ / ไฟล์เทมเพลตเดิมไม่มีในธีมนี้แล้ว (มาจากธีมก่อนหน้า) → ใช้เทมเพลตของธีม
			if ( ! $current || 'default' === $current || $overwrite || ! locate_template( $current ) ) {
				update_post_meta( $id, '_wp_page_template', $page['template'] );
			}
		}
		// เพจเดิมจากธีมก่อนหน้าที่ไม่มีไฟล์เนื้อหา (หน้าแรก /go บทความ) รับชื่อและ SEO ของธีมครั้งแรกครั้งเดียว
		$adopt = $found && empty( $page['content'] ) && '' === (string) get_post_meta( $id, 'eaw_seed_rev', true );
		if ( $adopt ) {
			if ( ! empty( $page['title'] ) && $found->post_title !== $page['title'] && empty( $page['front'] ) ) {
				wp_update_post(
					array(
						'ID'         => $id,
						'post_title' => wp_slash( $page['title'] ),
					)
				);
			}
			update_post_meta( $id, 'eaw_seed_rev', 1 );
			$log[] = '↻ ปรับชื่อและ SEO ของ /' . $slug . '/ ให้เป็นของ EA WING';
		}
		if ( $meta && ( ! $found || $overwrite || $adopt ) ) {
			eaw_apply_seo_meta( $id, $meta );
		}
	}
	return $log;
}

/**
 * ตั้งหน้าแรก (home) + หน้าบทความ (articles)
 */
function eaw_setup_reading() {
	$home     = eaw_find_page( 'home' );
	$articles = eaw_find_page( 'articles' );
	if ( ! $home || ! $articles ) {
		return array( '✗ ต้องสร้างเพจ home และ articles ก่อน' );
	}
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
	update_option( 'page_for_posts', $articles->ID );
	return array( '✓ ตั้ง "หน้าแรก" เป็นหน้าเว็บหลัก และ "บทความ" เป็นหน้ารวมบทความ' );
}

/**
 * สร้างเมนูหลัก (ถ้ายังไม่มีเมนูที่ตำแหน่ง primary)
 */
function eaw_setup_menu_build() {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( ! empty( $locations['primary'] ) && wp_get_nav_menu_object( $locations['primary'] ) ) {
		return array( '• มีเมนูหลักอยู่แล้ว (ไม่สร้างซ้ำ) · แก้ได้ที่ รูปแบบ → เมนู' );
	}
	// มีเมนู EA WING อยู่แล้ว (เช่นกดซ้ำ หรือเคยถอดออกจากตำแหน่ง) → แค่ตั้งตำแหน่งให้ ไม่เพิ่มรายการซ้ำ
	$existing = wp_get_nav_menu_object( 'EA WING · เมนูหลัก' );
	if ( $existing ) {
		$locations['primary'] = $existing->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
		return array( '• ใช้เมนู "EA WING · เมนูหลัก" ที่มีอยู่แล้ว และตั้งเป็นเมนู Header' );
	}
	$menu_id = wp_create_nav_menu( 'EA WING · เมนูหลัก' );
	if ( is_wp_error( $menu_id ) ) {
		return array( '✗ สร้างเมนูไม่สำเร็จ: ' . $menu_id->get_error_message() );
	}
	// ตั้งตำแหน่งก่อนเพิ่มรายการ เพื่อให้การกดซ้ำระหว่างทำงานเจอเมนูนี้และไม่สร้างซ้ำ
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	// $target = slug ของเพจ (ลิงก์แบบ page object ให้ไฮไลต์เมนูปัจจุบันได้) หรือ URL เต็ม
	$add = function ( $title, $target, $parent = 0 ) use ( $menu_id ) {
		$args = array(
			'menu-item-title'     => $title,
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent,
		);
		$page = 0 === strpos( $target, 'http' ) ? null : eaw_find_page( $target );
		if ( $page ) {
			$args['menu-item-type']      = 'post_type';
			$args['menu-item-object']    = 'page';
			$args['menu-item-object-id'] = $page->ID;
		} else {
			$args['menu-item-type'] = 'custom';
			$args['menu-item-url']  = 0 === strpos( $target, 'http' ) ? $target : home_url( '/' . $target . '/' );
		}
		return wp_update_nav_menu_item( $menu_id, 0, $args );
	};

	$add( 'หน้าแรก', home_url( '/' ) );
	$test = $add( 'การทดสอบ', 'backtest' );
	foreach ( eaw_guide_links( array( 'test' ) ) as $slug => $link ) {
		$add( $link['label'], $slug, $test );
	}
	$guide = $add( 'คู่มือการใช้งาน', 'how-to-install' );
	foreach ( eaw_guide_links( array( 'guide' ) ) as $slug => $link ) {
		$add( $link['label'], $slug, $guide );
	}
	$add( 'แพ็กเกจ', 'pricing' );
	$add( 'บทความ', 'articles' );
	$add( 'ติดต่อ', 'go' );

	return array( '✓ สร้างเมนูหลักและตั้งที่ตำแหน่ง Header แล้ว' );
}

/**
 * นำเข้าบทความ (ข้ามบทความที่มี slug อยู่แล้ว)
 */
function eaw_setup_import_articles( $publish = false ) {
	$log = array();
	foreach ( eaw_seed_articles() as $slug => $art ) {
		if ( eaw_find_post( $slug ) ) {
			$log[] = '• มีอยู่แล้ว: ' . $slug;
			continue;
		}
		$meta = $art['meta'];
		$cat  = 0;
		if ( ! empty( $meta['category'] ) ) {
			$cat_slug = eaw_article_category_slug( $meta['category'] );
			$term     = term_exists( $cat_slug, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $meta['category'], 'category', array( 'slug' => $cat_slug ) );
			}
			if ( ! is_wp_error( $term ) ) {
				$cat = (int) ( is_array( $term ) ? $term['term_id'] : $term );
			}
		}
		$id = wp_insert_post(
			array(
				'post_type'     => 'post',
				'post_status'   => $publish ? 'publish' : 'draft',
				'post_title'    => wp_slash( $art['title'] ),
				'post_name'     => $slug,
				'post_content'  => wp_slash( eaw_seed_content( $art['content'] ) ),
				'post_excerpt'  => isset( $meta['excerpt'] ) ? wp_slash( $meta['excerpt'] ) : '',
				'post_category' => $cat ? array( $cat ) : array(),
			),
			true
		);
		if ( is_wp_error( $id ) ) {
			$log[] = '✗ ' . $slug . ' · ' . $id->get_error_message();
			continue;
		}
		eaw_apply_seo_meta( $id, $meta );
		// รูปปกเฉพาะบทความ (covers/) ใช้ชื่อบทความเป็น alt · แบนเนอร์สำรองใช้ alt กลาง
		$thumb = eaw_banner_attachment( $art['cover'], 0 === strpos( $art['cover'], 'covers/' ) ? $art['title'] : '' );
		if ( $thumb ) {
			set_post_thumbnail( $id, $thumb );
		}
		$log[] = '✓ ' . ( $publish ? 'เผยแพร่' : 'ฉบับร่าง' ) . ': ' . $art['title'];
	}
	return $log ? $log : array( '• ไม่มีไฟล์บทความให้นำเข้า' );
}

/**
 * คำอธิบายหมวดบทความ (ใช้เป็น meta description ของหน้าหมวดผ่าน %%term_description%% ของ Yoast)
 */
function eaw_article_category_descriptions() {
	return array(
		'trading-plan'    => 'บทความวางแผนการเทรดสำหรับคนใช้ EA บน MT5: เขียนแผนก่อนเริ่ม กำหนดความเสี่ยงต่อออเดอร์ แบ่งทุนหลายบัญชี และตั้งเพดานขาดทุนรายวัน',
		'monitoring'      => 'บทความติดตามผล EA บน MT5: ดูพอร์ตผ่านแอปมือถือ ตั้งแจ้งเตือนด้วย MetaQuotes ID อ่าน Log ในแท็บ Journal และ Experts และดึงรายงานประวัติมาทบทวน',
		'risk-management' => 'บทความบริหารความเสี่ยงสำหรับคนใช้ EA: แยก Equity กับ Balance คำนวณ Risk Reward ระวังความเสี่ยงซ้อนจาก Correlation และเตรียมพอร์ตรับ Gap วันจันทร์',
	);
}

/**
 * ตั้งค่า SEO และระบบครั้งเดียว: Yoast (องค์กร โลโก้ รูปแชร์ ชื่อหน้าภาษาไทย ปิด archive ที่ไม่ใช้)
 * ปิดคอมเมนต์ทั้งเว็บ · alt ของโลโก้ใน Media · คำอธิบายหมวดบทความ · กดซ้ำได้ (ทับด้วยค่าเดิม)
 */
function eaw_setup_seo() {
	$log = array();

	/* 1) ปิดคอมเมนต์และ pingback ทั้งเว็บ (ธีมปิดในโค้ดอยู่แล้ว ตั้งค่า WordPress ซ้ำไว้เผื่อเปลี่ยนธีม) */
	update_option( 'default_comment_status', 'closed' );
	update_option( 'default_ping_status', 'closed' );
	update_option( 'default_pingback_flag', 0 );
	global $wpdb;
	$closed = (int) $wpdb->query( "UPDATE {$wpdb->posts} SET comment_status = 'closed', ping_status = 'closed' WHERE comment_status = 'open' OR ping_status = 'open'" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	clean_post_cache( 0 );
	$log[] = '✓ ปิดคอมเมนต์และ pingback ทั้งเว็บ (ปิดเพิ่ม ' . $closed . ' เรื่อง/เพจ)';

	/* 2) alt ของโลโก้ใน Media (ไอคอนเว็บ + โลโก้ที่ตั้งไว้) */
	$logo_ids = array_filter( array_unique( array( (int) get_option( 'site_icon' ), (int) get_theme_mod( 'custom_logo' ) ) ) );
	foreach ( get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'posts_per_page' => 20, 's' => 'EA-WING', 'fields' => 'ids' ) ) as $att ) {
		$logo_ids[] = (int) $att;
	}
	$alt_done = 0;
	foreach ( array_unique( $logo_ids ) as $att ) {
		if ( '' === trim( (string) get_post_meta( $att, '_wp_attachment_image_alt', true ) ) ) {
			update_post_meta( $att, '_wp_attachment_image_alt', 'โลโก้ EA WING' );
			++$alt_done;
		}
	}
	$log[] = '✓ เติม alt ให้โลโก้ใน Media ' . $alt_done . ' ไฟล์';

	/* 3) คำอธิบายหมวดบทความ */
	foreach ( eaw_article_category_descriptions() as $slug => $desc ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( $term && '' === trim( (string) $term->description ) ) {
			wp_update_term( $term->term_id, 'category', array( 'description' => $desc ) );
			$log[] = '✓ ใส่คำอธิบายหมวด ' . $term->name;
		}
	}

	/* 4) Yoast */
	if ( ! class_exists( 'WPSEO_Options' ) ) {
		$log[] = '• ไม่พบ Yoast SEO · ข้ามการตั้งค่า Yoast';
		return $log;
	}
	$name = get_bloginfo( 'name' );
	$logo = (int) get_option( 'site_icon' );
	if ( ! $logo ) {
		$logo = (int) get_theme_mod( 'custom_logo' );
	}
	$share = eaw_banner_attachment( 'brand/eawing-share-1200x630.jpg', $name . ' · ผู้ช่วยเทรดอัตโนมัติสำหรับ MT5' );

	$set = array(
		'website_name'                => $name,
		'company_or_person'           => 'company',
		'company_name'                => $name,
		'separator'                   => 'sc-middot',
		'disable-author'              => true,
		'disable-date'                => true,
		'disable-post_format'         => true,
		'title-tax-category'          => 'หมวด %%term_title%% %%page%% %%sep%% %%sitename%%',
		'metadesc-tax-category'       => '%%term_description%%',
		'title-search-wpseo'          => 'ผลการค้นหา %%searchphrase%% %%page%% %%sep%% %%sitename%%',
		'title-404-wpseo'             => 'ไม่พบหน้าที่ต้องการ %%sep%% %%sitename%%',
		'rssbefore'                   => '',
		'rssafter'                    => 'บทความ %%POSTLINK%% เผยแพร่ครั้งแรกที่ %%BLOGLINK%%',
		'remove_feed_global_comments' => true,
		'remove_feed_post_comments'   => true,
		'remove_shortlinks'           => true,
	);
	if ( $logo && wp_get_attachment_url( $logo ) ) {
		$set['company_logo']    = wp_get_attachment_url( $logo );
		$set['company_logo_id'] = $logo;
	}
	if ( $share && wp_get_attachment_url( $share ) ) {
		$set['og_default_image']    = wp_get_attachment_url( $share );
		$set['og_default_image_id'] = $share;
	}
	$facebook = trim( (string) eaw_mod( 'facebook_url' ) );
	if ( '' !== $facebook && '#' !== $facebook ) {
		$set['facebook_site'] = esc_url_raw( $facebook );
	}
	$failed = array();
	foreach ( $set as $key => $value ) {
		WPSEO_Options::set( $key, $value );
		/* ตรวจด้วยการอ่านกลับ (update_option คืน false เมื่อค่าเดิมเท่ากัน จึงใช้ผลของ set ไม่ได้) */
		if ( (string) WPSEO_Options::get( $key ) !== (string) $value ) {
			$failed[] = $key;
		}
	}
	$log[] = '✓ ตั้งค่า Yoast: องค์กร "' . $name . '" · โลโก้ · รูปแชร์เริ่มต้น · Facebook · ตัวคั่นหัวเรื่อง (จุดกลาง) · ปิดหน้า author / date / format · ชื่อหน้าหมวด ค้นหา 404 เป็นภาษาไทย · ตัด feed คอมเมนต์';
	if ( $failed ) {
		$log[] = '✗ Yoast ไม่รับค่า: ' . implode( ', ', $failed );
	}
	return $log;
}

/**
 * slug ภาษาอังกฤษของหมวดบทความ (URL อ่านง่าย ไม่เป็นภาษาไทยเข้ารหัส)
 */
function eaw_article_category_slug( $name ) {
	$map = array(
		'วางแผนการเทรด'   => 'trading-plan',
		'ติดตามผล'        => 'monitoring',
		'บริหารความเสี่ยง' => 'risk-management',
	);
	return isset( $map[ $name ] ) ? $map[ $name ] : sanitize_title( $name );
}

/**
 * แทนเนื้อหาเพจเดียวด้วยเนื้อหาตั้งต้นรุ่นล่าสุด (เก็บรุ่นเก่าเป็น revision ของ WP)
 */
function eaw_setup_replace_page( $slug ) {
	$pages = eaw_site_pages();
	if ( ! isset( $pages[ $slug ] ) || empty( $pages[ $slug ]['content'] ) ) {
		return array( '✗ ไม่พบเนื้อหาตั้งต้นของ /' . $slug . '/' );
	}
	$found = eaw_find_page( $slug );
	if ( ! $found ) {
		return array( '✗ ยังไม่มีเพจ /' . $slug . '/ · กด "สร้างเพจ" ก่อน' );
	}
	$meta   = eaw_seed_meta( $pages[ $slug ]['content'] );
	$update = array(
		'ID'           => $found->ID,
		'post_content' => wp_slash( eaw_seed_content( $pages[ $slug ]['content'] ) ),
	);
	if ( ! empty( $meta['title'] ) ) {
		$update['post_title'] = wp_slash( $meta['title'] );
	}
	wp_update_post( $update );
	update_post_meta( $found->ID, 'eaw_seed_rev', ! empty( $meta['rev'] ) ? (int) $meta['rev'] : 1 );
	if ( $meta ) {
		eaw_apply_seo_meta( $found->ID, $meta );
	}
	return array( '↻ แทนเนื้อหา /' . $slug . '/ ด้วยรุ่นล่าสุดแล้ว (รุ่นเดิมอยู่ใน Revisions ของเพจ)' );
}

function eaw_setup_handle() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( 'ไม่มีสิทธิ์' );
	}
	check_admin_referer( 'eaw_setup' );

	// กันกดซ้ำขณะกำลังทำงาน (ดับเบิลคลิก / สองแท็บ)
	if ( get_transient( 'eaw_setup_lock' ) ) {
		set_transient( 'eaw_setup_log', array( '• กำลังทำงานอยู่ · รอสักครู่แล้วรีเฟรชหน้านี้' ), 120 );
		wp_safe_redirect( admin_url( 'themes.php?page=eawing-setup' ) );
		exit;
	}
	set_transient( 'eaw_setup_lock', 1, 120 );

	$do  = isset( $_POST['eaw_do'] ) ? sanitize_key( wp_unslash( $_POST['eaw_do'] ) ) : '';
	$log = array();

	if ( 'pages' === $do || 'all' === $do ) {
		$log = array_merge( $log, eaw_setup_create_pages( ! empty( $_POST['eaw_overwrite'] ) ) );
	}
	if ( 'reading' === $do || 'all' === $do ) {
		$log = array_merge( $log, eaw_setup_reading() );
	}
	if ( 'menu' === $do || 'all' === $do ) {
		$log = array_merge( $log, eaw_setup_menu_build() );
	}
	if ( 'replace' === $do ) {
		$slug = isset( $_POST['eaw_slug'] ) ? sanitize_key( wp_unslash( $_POST['eaw_slug'] ) ) : '';
		$log  = array_merge( $log, eaw_setup_replace_page( $slug ) );
	}
	if ( 'articles' === $do ) {
		$log = array_merge( $log, eaw_setup_import_articles( ! empty( $_POST['eaw_publish'] ) ) );
	}
	if ( 'seo' === $do ) {
		$log = array_merge( $log, eaw_setup_seo() );
	}
	if ( 'all' === $do ) {
		flush_rewrite_rules( false );
	}

	delete_transient( 'eaw_setup_lock' );
	set_transient( 'eaw_setup_log', $log, 120 );
	wp_safe_redirect( admin_url( 'themes.php?page=eawing-setup&done=1' ) );
	exit;
}
add_action( 'admin_post_eaw_setup', 'eaw_setup_handle' );

function eaw_setup_screen() {
	$log   = get_transient( 'eaw_setup_log' );
	$pages = eaw_site_pages();
	delete_transient( 'eaw_setup_log' );
	?>
	<div class="wrap">
		<h1>EA WING · ตั้งค่าเว็บ</h1>
		<p>กดครั้งเดียวได้ครบทุกเพจของ EA WING พร้อมเทมเพลตและเนื้อหาตั้งต้น ส่วนเพจที่มีอยู่แล้วจะ<strong>ไม่ถูกแตะ</strong> เว้นแต่ติ๊กช่องเขียนทับ</p>

		<?php if ( ! get_option( 'blog_public' ) ) : ?>
			<div class="notice notice-warning"><p><strong>เว็บยังปิดไม่ให้ Google ทำดัชนี</strong> · ไปที่ <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>">ตั้งค่า → การอ่าน</a> แล้วเอาเครื่องหมายออกจาก "ขอให้ search engines ไม่ทำดัชนีเว็บไซต์นี้" เมื่อพร้อมเปิดตัว</p></div>
		<?php endif; ?>
		<?php if ( ! get_option( 'permalink_structure' ) ) : ?>
			<div class="notice notice-warning"><p><strong>ลิงก์ถาวรยังเป็นแบบ ?p=</strong> · ไปที่ <a href="<?php echo esc_url( admin_url( 'options-permalink.php' ) ); ?>">ตั้งค่า → ลิงก์ถาวร</a> แล้วเลือก "ชื่อเรื่อง (Post name)"</p></div>
		<?php endif; ?>
		<?php if ( '#' === eaw_mod( 'line_url' ) || ! eaw_mod( 'line_url' ) ) : ?>
			<div class="notice notice-warning"><p><strong>ยังไม่ได้ใส่ลิงก์ LINE OA</strong> · ปุ่มติดต่อทุกปุ่มจะพาไปหน้า /go/ แทน (ถ้าหน้า /go/ ยังไม่เผยแพร่ ปุ่มจะถูกซ่อน) · ตั้งค่าที่ <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=eaw_general' ) ); ?>">ปรับแต่ง → ช่องทางติดต่อ</a></p></div>
		<?php endif; ?>

		<?php if ( $log ) : ?>
			<div class="notice notice-success"><p><?php echo implode( '<br>', array_map( 'esc_html', (array) $log ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p></div>
		<?php endif; ?>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:18px 0 26px;padding:18px 20px;background:#fff;border:1px solid #dcdcde;border-radius:8px;max-width:760px">
			<?php wp_nonce_field( 'eaw_setup' ); ?>
			<input type="hidden" name="action" value="eaw_setup">
			<h2 style="margin-top:0">1) ตั้งค่าเว็บทั้งหมด</h2>
			<p>สร้างเพจที่ยังไม่มี → ตั้งหน้าแรก/หน้าบทความ → สร้างเมนูหลัก</p>
			<p><label><input type="checkbox" name="eaw_overwrite" value="1"> เขียนทับเนื้อหาเพจที่มีอยู่ด้วยเนื้อหาเริ่มต้นของธีม (ระวัง: ข้อความที่แก้ไว้จะหาย)</label></p>
			<p><button class="button button-primary" name="eaw_do" value="all">ตั้งค่าเว็บทั้งหมด</button>
				<button class="button" name="eaw_do" value="pages">สร้างเพจอย่างเดียว</button>
				<button class="button" name="eaw_do" value="menu">สร้างเมนูอย่างเดียว</button></p>
		</form>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0 0 26px;padding:18px 20px;background:#fff;border:1px solid #dcdcde;border-radius:8px;max-width:760px">
			<?php wp_nonce_field( 'eaw_setup' ); ?>
			<input type="hidden" name="action" value="eaw_setup">
			<h2 style="margin-top:0">2) นำเข้าบทความ SEO (<?php echo (int) count( eaw_seed_articles() ); ?> บทความ)</h2>
			<p>บทความเข้ามาเป็น <strong>ฉบับร่าง</strong> พร้อมหมวด (วางแผนการเทรด · ติดตามผล · บริหารความเสี่ยง) คำอธิบาย SEO และรูปหน้าปก · ตรวจอ่านแล้วค่อยเผยแพร่ทีละเรื่อง ตามแผนคือวันเว้นวัน เวลา 09:00 น.</p>
			<p><label><input type="checkbox" name="eaw_publish" value="1"> เผยแพร่ทันที (ไม่แนะนำ)</label></p>
			<p><button class="button button-primary" name="eaw_do" value="articles">นำเข้าบทความ</button></p>
		</form>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0 0 26px;padding:18px 20px;background:#fff;border:1px solid #dcdcde;border-radius:8px;max-width:760px">
			<?php wp_nonce_field( 'eaw_setup' ); ?>
			<input type="hidden" name="action" value="eaw_setup">
			<h2 style="margin-top:0">3) ตั้งค่า SEO และระบบ</h2>
			<p>ตั้ง Yoast ให้ครบ (ชื่อองค์กร โลโก้ รูปแชร์เริ่มต้น Facebook ชื่อหน้าหมวด/ค้นหา/404 ภาษาไทย ปิดหน้า author และ date archive) · ปิดคอมเมนต์ทั้งเว็บ · เติม alt ให้โลโก้ · ใส่คำอธิบายหมวดบทความ · กดซ้ำได้</p>
			<p><button class="button button-primary" name="eaw_do" value="seo">ตั้งค่า SEO และระบบ</button></p>
		</form>

		<h2>สถานะเพจ</h2>
		<table class="widefat striped" style="max-width:980px">
			<thead><tr><th>URL</th><th>ชื่อเพจ</th><th>สถานะ</th><th>เทมเพลต</th><th>เนื้อหาตั้งต้น</th><th></th></tr></thead>
			<tbody>
			<?php
			foreach ( $pages as $slug => $page ) :
				$found = eaw_find_page( $slug );
				$tpl   = $found ? get_post_meta( $found->ID, '_wp_page_template', true ) : '';
				$ok    = ! $page['template'] || $tpl === $page['template'];
				$smeta = ! empty( $page['content'] ) ? eaw_seed_meta( $page['content'] ) : null;
				$srev  = $smeta ? ( ! empty( $smeta['rev'] ) ? (int) $smeta['rev'] : 1 ) : 0;
				$prev  = $found ? (int) get_post_meta( $found->ID, 'eaw_seed_rev', true ) : 0;
				$stale = $found && $srev && $prev < $srev;
				?>
				<tr>
					<td><code>/<?php echo esc_html( $slug ); ?>/</code></td>
					<td><?php echo esc_html( $found ? $found->post_title : $page['title'] ); ?></td>
					<td><?php echo $found ? esc_html( 'publish' === $found->post_status ? 'เผยแพร่' : 'ฉบับร่าง' ) : '<span style="color:#b32d2e">ยังไม่มี</span>'; ?></td>
					<td><?php echo $page['template'] ? ( $ok ? '✓ ' : '<span style="color:#b32d2e">✗ </span>' ) . esc_html( $page['template'] ) : 'เทมเพลตปกติ'; ?></td>
					<td>
						<?php if ( ! $srev ) : ?>ไม่มี<?php elseif ( ! $found ) : ?>รุ่น <?php echo (int) $srev; ?><?php elseif ( $stale ) : ?>
							<span style="color:#b26c09">มีรุ่นใหม่ (<?php echo (int) $prev; ?> → <?php echo (int) $srev; ?>)</span>
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline;margin-left:6px" onsubmit="return confirm('แทนเนื้อหาเพจนี้ด้วยรุ่นล่าสุด? ข้อความที่แก้เองในเพจนี้จะถูกแทน (รุ่นเดิมยังอยู่ใน Revisions)');">
								<?php wp_nonce_field( 'eaw_setup' ); ?>
								<input type="hidden" name="action" value="eaw_setup">
								<input type="hidden" name="eaw_slug" value="<?php echo esc_attr( $slug ); ?>">
								<button class="button button-small" name="eaw_do" value="replace">แทนด้วยรุ่นล่าสุด</button>
							</form>
						<?php else : ?>✓ รุ่น <?php echo (int) $srev; ?><?php endif; ?>
					</td>
					<td><?php if ( $found ) : ?><a href="<?php echo esc_url( get_edit_post_link( $found->ID ) ); ?>">แก้ไข</a> · <a href="<?php echo esc_url( get_permalink( $found ) ); ?>" target="_blank" rel="noopener">ดู</a><?php endif; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p style="max-width:980px;color:#50575e">เพจ <strong>นโยบายความเป็นส่วนตัว / เงื่อนไขการใช้บริการ / คำขอลบข้อมูล</strong> เริ่มต้นเป็นฉบับร่าง เพราะยังต้องเติมข้อมูลจริงของผู้ให้บริการ เช่น ชื่อ ที่อยู่ อีเมลติดต่อ และนโยบายยกเลิกหรือคืนเงิน (หรือระบุว่าไม่มี) · เปิดโหมดแก้ไขโค้ดแล้วค้นคำว่า "เจ้าของเว็บ" จะเจอทุกจุดที่ต้องกรอก</p>
		<p style="max-width:980px;color:#50575e">อย่าแก้เพจเหล่านี้ด้วย Elementor · ตัวแก้ไขของ Elementor จะทับหน้าตาที่เทมเพลตของธีมจัดไว้</p>
	</div>
	<?php
}
