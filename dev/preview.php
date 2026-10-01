<?php
/**
 * ดูหน้า /go ในเครื่องโดยไม่ต้องลง WordPress
 * จำลองฟังก์ชัน WordPress ที่ template-links.php ใช้
 *
 *   php -S 127.0.0.1:8090 dev/preview.php
 *   http://127.0.0.1:8090/          (ใช้โลโก้จริงจาก eawing.co)
 *   http://127.0.0.1:8090/?nologo   (ใช้โลโก้ชั่วคราวของธีม)
 */

define( 'ABSPATH', __DIR__ );
define( 'EAWING_THEME', dirname( __DIR__ ) . '/eawing' );

// ไฟล์ในธีม (css, svg)
$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
if ( 0 === strpos( $path, '/theme/' ) ) {
	$file = realpath( EAWING_THEME . substr( $path, 6 ) );
	if ( ! $file || 0 !== strpos( $file, realpath( EAWING_THEME ) ) ) {
		http_response_code( 404 );
		return true;
	}
	$types = array( 'css' => 'text/css', 'svg' => 'image/svg+xml' );
	header( 'Content-Type: ' . ( $types[ pathinfo( $file, PATHINFO_EXTENSION ) ] ?? 'application/octet-stream' ) );
	readfile( $file );
	return true;
}

function add_action() {}
function add_filter() {}
function add_theme_support() {}
function wp_body_open() {}
function wp_footer() {}

function bloginfo( $key ) {
	echo 'UTF-8';
}

function wp_head() {
	echo '<title>ติดต่อ EA WING · LINE และลิงก์รวม EA MT5</title>' . "\n";
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@500;600;700&family=Noto+Sans+Thai:wght@400;500;600&display=swap">' . "\n";
	echo '<link rel="stylesheet" href="/theme/style.css">' . "\n";
}

function body_class( $class = '' ) {
	echo 'class="' . $class . '"';
}

function esc_url( $url ) {
	return htmlspecialchars( $url, ENT_QUOTES );
}

function esc_attr( $text ) {
	return htmlspecialchars( $text, ENT_QUOTES );
}

function esc_html( $text ) {
	return htmlspecialchars( $text, ENT_QUOTES );
}

function get_theme_mod( $name, $default = false ) {
	if ( 'custom_logo' === $name ) {
		return isset( $_GET['nologo'] ) ? 0 : 1;
	}
	return $default;
}

function wp_get_attachment_image_src( $id, $size ) {
	return array( 'https://eawing.co/wp-content/uploads/2026/10/EA-WING-ORIGINAL-LOGO-300x214.png', 300, 214 );
}

function get_theme_file_uri( $file ) {
	return '/theme/' . $file;
}

// หน้าที่มีอยู่จริงบน eawing.co ตอนนี้
function get_page_by_path( $slug ) {
	$pages = array( 'privacy-policy', 'risk-warning' );
	return in_array( $slug, $pages, true ) ? (object) array( 'post_status' => 'publish', 'slug' => $slug ) : null;
}

function get_permalink( $page ) {
	return 'https://eawing.co/' . $page->slug . '/';
}

require EAWING_THEME . '/functions.php';
require EAWING_THEME . '/template-links.php';
