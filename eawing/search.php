<?php
/**
 * หน้าผลการค้นหา
 *
 * Glass Sky: หัวเพจกระจกขนาดเล็ก (คำค้น + ช่องค้นหาแคปซูลกระจก + จำนวนผล) → การ์ดบทความกระจก + โหลดเพิ่ม
 *            ไม่พบผล: แผงข้อความแนะนำ + การ์ดคู่มือ (เฉพาะเพจที่เผยแพร่แล้ว)
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$eaw_found = (int) $GLOBALS['wp_query']->found_posts;
$eaw_has   = have_posts();
$eaw_query = get_search_query();

$eaw_after = '<div class="search-bar">' . eaw_pages_capture( 'eaw_pages_search_form', eaw_mod( 'search_placeholder' ), 'search-bar-form' );
if ( $eaw_found ) {
	$eaw_after .= '<p class="archive-count">' . esc_html( eaw_pages_count_text( 'search_count_text', $eaw_found ) ) . '</p>';
}
$eaw_after .= '</div>';
?>

<main id="main" class="pg search-page">

	<?php
	eaw_pages_hero(
		array(
			'title' => eaw_mod( 'search_title' ) . ( '' !== $eaw_query ? ': “' . $eaw_query . '”' : '' ),
			'after' => $eaw_after,
			'size'  => 'compact',
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

				<?php $eaw_guides = eaw_pages_guide_items(); ?>
				<div class="glass-panel pg-panel articles-empty">
					<p class="pg-empty no-posts"><span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'book' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><?php echo esc_html( eaw_mod( 'search_empty_text' ) ); ?></span></p>
					<?php if ( $eaw_guides ) : ?>
						<?php eaw_pages_sec_head( eaw_mod( 'articles_guides_kicker' ), eaw_mod( 'articles_guides_title' ), eaw_mod( 'articles_guides_sub' ) ); ?>
						<?php eaw_pages_guide_grid( $eaw_guides ); ?>
					<?php endif; ?>
				</div>

			<?php endif; ?>

		</div>
	</section>

</main>

<?php
get_footer();
