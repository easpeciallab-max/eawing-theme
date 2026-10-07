<?php
/**
 * หน้ารวมบทความ (/articles/) + หน้าหมวดหมู่/ป้ายกำกับ
 *
 * Glass Sky: หัวเพจแผงกระจก (H1 · คำโปรย · จำนวนบทความ · ชิปหมวด) → การ์ดบทความกระจก + ปุ่มโหลดเพิ่ม (แคปซูลกระจก)
 *            ยังไม่มีบทความ: แผง "กำลังเตรียมบทความ" + การ์ดคู่มือ (เฉพาะเพจที่เผยแพร่แล้ว)
 *            มีบทความ (หน้าแรกของรายการ): แผงรายการคู่มือท้ายหน้า
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$eaw_desc   = get_the_archive_description();
$eaw_found  = (int) $GLOBALS['wp_query']->found_posts;
$eaw_guides = eaw_pages_guide_items();
$eaw_has    = have_posts();

if ( is_home() && ! is_front_page() ) {
	$eaw_posts_page = (int) get_option( 'page_for_posts' );
	$eaw_h1         = $eaw_posts_page ? get_the_title( $eaw_posts_page ) : eaw_mod( 'articles_title' );
} elseif ( is_search() ) {
	$eaw_h1 = eaw_mod( 'search_title' ) . ': ' . get_search_query();
} elseif ( is_archive() ) {
	$eaw_h1 = wp_strip_all_tags( get_the_archive_title() );
} else {
	$eaw_h1 = eaw_mod( 'articles_title' );
}
$eaw_sub = $eaw_desc ? wp_strip_all_tags( $eaw_desc ) : ( is_home() ? eaw_mod( 'blog_subtitle' ) : '' );

/* จำนวนบทความ + ชิปหมวด (อยู่ในหัวเพจ) */
$eaw_cats      = is_search() ? array() : get_categories( array( 'hide_empty' => true ) );
$eaw_posts_url = (int) get_option( 'page_for_posts' ) ? get_permalink( (int) get_option( 'page_for_posts' ) ) : home_url( '/articles/' );
$eaw_bar       = '';
if ( $eaw_found || count( $eaw_cats ) > 1 ) {
	$eaw_bar .= '<div class="archive-bar">';
	if ( $eaw_found ) {
		$eaw_bar .= '<p class="archive-count">' . esc_html( eaw_pages_count_text( 'articles_count_text', $eaw_found ) ) . '</p>';
	}
	if ( count( $eaw_cats ) > 1 ) {
		$eaw_bar .= '<nav class="cat-chips" aria-label="' . esc_attr( eaw_mod( 'articles_kicker' ) ) . '">';
		$eaw_bar .= '<a class="chip-link' . ( is_home() ? ' is-active' : '' ) . '" href="' . esc_url( $eaw_posts_url ) . '"' . ( is_home() ? ' aria-current="page"' : '' ) . '>' . esc_html( eaw_mod( 'articles_all_label' ) ) . '</a>';
		foreach ( $eaw_cats as $eaw_cat ) {
			$eaw_on   = is_category( $eaw_cat->term_id );
			$eaw_bar .= '<a class="chip-link' . ( $eaw_on ? ' is-active' : '' ) . '" href="' . esc_url( get_category_link( $eaw_cat ) ) . '"' . ( $eaw_on ? ' aria-current="page"' : '' ) . '>' . esc_html( $eaw_cat->name ) . '</a>';
		}
		$eaw_bar .= '</nav>';
	}
	$eaw_bar .= '</div>';
}
?>

<main id="main" class="pg articles-page">

	<?php
	eaw_pages_hero(
		array(
			'kicker' => eaw_mod( 'articles_kicker' ),
			'title'  => $eaw_h1,
			'grad'   => is_home() ? eaw_mod( 'articles_hero_grad' ) : '',
			'lead'   => eaw_pages_has( $eaw_sub ) ? $eaw_sub : '',
			'after'  => $eaw_bar,
			'media'  => is_home() ? eaw_pages_hero_media( '', 'articles' ) : '',
		)
	);
	?>

	<section class="pg-sec posts-wrap">
		<div class="container">

			<?php if ( $eaw_has ) : ?>

				<div class="posts-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						eaw_post_card();
					endwhile;
					?>
				</div>

				<?php eaw_pages_load_more(); ?>

			<?php else : ?>

				<div class="glass-panel pg-panel articles-empty">
					<p class="pg-empty no-posts"><span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'book' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( eaw_mod( is_search() ? 'search_empty_text' : 'articles_empty_text' ) ); ?></span></p>
					<?php if ( $eaw_guides ) : ?>
						<?php eaw_pages_sec_head( eaw_mod( 'articles_guides_kicker' ), eaw_mod( 'articles_guides_title' ), eaw_mod( 'articles_guides_sub' ) ); ?>
						<?php eaw_pages_guide_grid( $eaw_guides ); ?>
					<?php endif; ?>
				</div>

			<?php endif; ?>

		</div>
	</section>

	<?php
	$eaw_pillars = ( is_home() && ! is_paged() && $eaw_has && eaw_pages_has( eaw_mod( 'articles_pillars_title' ) ) ) ? eaw_pages_pillar_items() : array();
	if ( count( $eaw_pillars ) > 1 ) :
		?>
		<section class="pg-sec pillar-hub">
			<div class="container">
				<div class="glass-panel pg-panel">
					<?php eaw_pages_sec_head( '', eaw_mod( 'articles_pillars_title' ), eaw_mod( 'articles_pillars_sub' ) ); ?>
					<?php eaw_pages_guide_grid( $eaw_pillars ); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( is_home() && ! is_paged() && $eaw_has && $eaw_guides ) : ?>
		<section class="pg-sec guide-hub">
			<div class="container">
				<div class="glass-panel pg-panel">
					<?php eaw_pages_sec_head( eaw_mod( 'articles_guides_kicker' ), eaw_mod( 'articles_guides_title' ), eaw_mod( 'articles_guides_sub' ) ); ?>
					<?php eaw_pages_guide_grid( $eaw_guides ); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();
