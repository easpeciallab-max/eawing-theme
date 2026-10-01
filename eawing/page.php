<?php
/**
 * เพจทั่วไป / เพจเอกสาร (เกี่ยวกับเรา, นโยบายความเป็นส่วนตัว, เงื่อนไขการใช้บริการ, คำขอลบข้อมูล)
 *
 * Glass Sky: หัวเพจกระจกขนาดเล็ก (breadcrumb · ป้ายเล็ก · H1 · วันที่ปรับปรุงล่าสุด)
 * → การ์ดขาวอ่านง่ายคอลัมน์เดียว (สารบัญติดข้างบนจอคอม / พับได้บนมือถือ เมื่อมี H2 ตั้งแต่ 4 หัวข้อ)
 * ไม่มีบล็อกติดต่อในหน้า ยกเว้นเพจ about · เพจที่สร้างด้วย Elementor แสดงผลของ Elementor ตามเดิม
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$eaw_is_elementor = eaw_is_elementor_page();
?>

<main id="main"<?php echo $eaw_is_elementor ? ' class="elementor-page-shell elementor-page-shell--auto"' : ' class="pg doc-page"'; ?>>
	<?php if ( $eaw_is_elementor ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'elementor-entry' ); ?>>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>

	<?php else : ?>

		<?php
		while ( have_posts() ) :
			the_post();

			$eaw_slug = (string) get_post_field( 'post_name', get_the_ID() );

			eaw_pages_enable_table_cards();
			$GLOBALS['eaw_toc'] = array();
			$eaw_content        = apply_filters( 'the_content', get_the_content() );
			$eaw_content        = str_replace( ']]>', ']]&gt;', $eaw_content );
			$eaw_toc            = isset( $GLOBALS['eaw_toc'] ) ? $GLOBALS['eaw_toc'] : array();
			$eaw_updated        = eaw_pages_thai_date( get_the_modified_date( 'c' ) );

			$eaw_meta = '';
			if ( '' !== $eaw_updated ) {
				$eaw_meta = '<p class="pg-updated doc-updated">' . eaw_icon( 'clock', 'icon icon-sm' )
					. '<span>' . esc_html( eaw_mod( 'doc_updated_label' ) ) . ':</span> '
					. '<time datetime="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . esc_html( $eaw_updated ) . '</time></p>';
			}

			eaw_pages_hero(
				array(
					'kicker' => function_exists( 'eaw_page_kicker' ) ? eaw_page_kicker( $eaw_slug ) : '',
					'title'  => wp_strip_all_tags( get_the_title() ),
					'meta'   => $eaw_meta,
					'size'   => 'compact',
					'class'  => 'doc-hero',
				)
			);

			$eaw_before = '';
			if ( has_post_thumbnail() ) {
				$eaw_before = '<figure class="article-thumb doc-thumb">' . eaw_pages_capture( 'the_post_thumbnail', 'large', array( 'alt' => eaw_pages_featured_alt( get_the_ID() ) ) ) . '</figure>';
			}
			$eaw_after = eaw_pages_capture(
				'wp_link_pages',
				array(
					'before' => '<div class="page-links">',
					'after'  => '</div>',
				)
			);

			eaw_pages_longform(
				array(
					'content'    => $eaw_content,
					'toc'        => $eaw_toc,
					'min'        => 4,
					'class'      => 'doc-section-wrap',
					'body_class' => 'doc-body',
					'before'     => $eaw_before,
					'after'      => $eaw_after,
				)
			);

			if ( 'about' === $eaw_slug ) {
				eaw_line_cta( eaw_mod( 'aboutpage_cta_title' ), eaw_mod( 'aboutpage_cta_text' ) );
			}
			?>

		<?php endwhile; ?>

	<?php endif; ?>
</main>

<?php
get_footer();
