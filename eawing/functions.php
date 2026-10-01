<?php
/**
 * ธีม EA WING
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'width'       => 168,
		'height'      => 168,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'html5', array( 'style', 'script' ) );
} );

/* ---------- ฟอนต์และสไตล์ ---------- */

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'eawing-fonts',
		'https://fonts.googleapis.com/css2?family=Kanit:wght@500;600;700&family=Noto+Sans+Thai:wght@400;500;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'eawing',
		get_stylesheet_uri(),
		array( 'eawing-fonts' ),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
} );

add_filter( 'wp_resource_hints', function ( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}, 10, 2 );

/* ---------- ลิงก์ติดต่อ · แก้ได้ที่ ลักษณะ > ปรับแต่ง > ลิงก์ติดต่อ EA WING ---------- */

function eawing_links() {
	return array(
		'line'     => array(
			'label'   => 'ลิงก์ LINE OA',
			'default' => 'https://lin.ee/ye11pwm6',
		),
		'openchat' => array(
			'label'   => 'ลิงก์ LINE OpenChat',
			'default' => 'https://line.me/ti/g2/qTYSY_8S0GMMPoqbW8RcRuFo4VkvtfqYNU9-pA?utm_source=invitation&utm_medium=link_copy&utm_campaign=default',
		),
		'portal'   => array(
			'label'   => 'ลิงก์ Portal โบรกเกอร์ (Zaurix)',
			'default' => 'https://portal.zaurix.com/',
		),
	);
}

function eawing_link( $key ) {
	$links = eawing_links();
	return get_theme_mod( 'eawing_link_' . $key, $links[ $key ]['default'] );
}

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'eawing_links', array(
		'title'    => 'ลิงก์ติดต่อ EA WING',
		'priority' => 30,
	) );

	foreach ( eawing_links() as $key => $link ) {
		$wp_customize->add_setting( 'eawing_link_' . $key, array(
			'default'           => $link['default'],
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'eawing_link_' . $key, array(
			'label'   => $link['label'],
			'section' => 'eawing_links',
			'type'    => 'url',
		) );
	}
} );

/* ---------- หน้า /go ---------- */

// สร้างหน้า /go ให้อัตโนมัติตอนเปิดใช้ธีม (ถ้ายังไม่มี)
add_action( 'after_switch_theme', function () {
	if ( get_page_by_path( 'go' ) ) {
		return;
	}

	$page_id = wp_insert_post( array(
		'post_type'   => 'page',
		'post_title'  => 'ติดต่อ EA WING · LINE และลิงก์รวม EA MT5',
		'post_name'   => 'go',
		'post_status' => 'publish',
	) );

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', 'template-links.php' );
	}
} );

// หน้าลิงก์รวมไม่ต้องติดอันดับค้นหา (เหมือน ea2000.co/go)
add_filter( 'wp_robots', function ( $robots ) {
	if ( is_page_template( 'template-links.php' ) ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
} );

// ชื่อหน้าครบอยู่แล้ว ไม่ต้องต่อท้ายด้วยชื่อเว็บ
add_filter( 'document_title_parts', function ( $parts ) {
	if ( is_page_template( 'template-links.php' ) ) {
		unset( $parts['site'] );
	}
	return $parts;
} );

// ระหว่างที่ยังไม่ได้ออกแบบหน้าแรก: เข้าหน้าแรกแล้วพาไป /go/
// หยุดทำงานเองเมื่อธีมมีไฟล์ front-page.php
add_action( 'template_redirect', function () {
	if ( ! is_front_page() || is_page( 'go' ) || locate_template( 'front-page.php' ) ) {
		return;
	}

	$go = get_page_by_path( 'go' );
	if ( $go && 'publish' === $go->post_status ) {
		wp_safe_redirect( get_permalink( $go ), 302 );
		exit;
	}
} );
