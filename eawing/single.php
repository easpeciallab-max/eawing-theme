<?php
/**
 * บทความเดี่ยว (คอนเทนต์ SEO)
 *
 * Glass Sky:
 * แถบความคืบหน้าการอ่าน (ทองไล่สี) → หัวบทความแผงกระจก (breadcrumb · ชิปหมวด · H1 · วันที่เผยแพร่/อัปเดต · เวลาอ่าน
 * · รูปหน้าปกในกรอบโค้ง) → สารบัญ (จอคอม: การ์ดกระจกติดข้าง · มือถือ: พับได้) + การ์ดขาวอ่านง่าย (เนื้อหา → แชร์
 * → ป้ายกำกับ → กล่องผู้เขียน → คำเตือนความเสี่ยง) → บทความในหมวดเดียวกัน (แถบเลื่อน) → แถบติดต่อ
 *
 * ข้อความที่ผู้เข้าชมเห็นมาจาก Customizer → "หน้ารวมบทความ & บทความ"
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$eaw_cats   = get_the_category();
	$eaw_cat    = ! empty( $eaw_cats ) ? $eaw_cats[0] : null;
	$eaw_thumb  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$eaw_meta   = eaw_pages_article_meta();
	$eaw_about  = eaw_pages_about_url();
	$eaw_link   = get_permalink();
	$eaw_author = trim( (string) eaw_mod( 'article_author_name' ) );
	$eaw_title  = wp_strip_all_tags( get_the_title() );

	/* เนื้อหาก่อน (สารบัญเก็บหัวข้อระหว่าง the_content) */
	eaw_pages_enable_table_cards();
	$GLOBALS['eaw_toc'] = array();
	$eaw_content        = apply_filters( 'the_content', get_the_content() );
	$eaw_content        = str_replace( ']]>', ']]&gt;', $eaw_content );
	$eaw_art_toc        = eaw_pages_toc_items( isset( $GLOBALS['eaw_toc'] ) ? $GLOBALS['eaw_toc'] : array(), $eaw_content, array( 2, 3 ) );
	$eaw_has_toc        = count( $eaw_art_toc ) >= 2;

	/* ชิปหมวด + บรรทัดวันที่/เวลาอ่าน + รูปปก สำหรับหัวบทความ */
	$eaw_chip = '';
	if ( $eaw_cat ) {
		$eaw_chip = '<a class="article-cat" href="' . esc_url( get_category_link( $eaw_cat->term_id ) ) . '">' . esc_html( $eaw_cat->name ) . '</a>';
	}
	$eaw_meta_html = '<div class="article-meta">';
	if ( '' !== $eaw_meta['published'] ) {
		$eaw_meta_html .= '<span class="article-meta-item">' . eaw_icon( 'clock', 'icon icon-sm' ) . '<span>' . esc_html( eaw_mod( 'article_published_label' ) ) . '</span> <time datetime="' . esc_attr( $eaw_meta['published_iso'] ) . '">' . esc_html( $eaw_meta['published'] ) . '</time></span>';
	}
	if ( '' !== $eaw_meta['modified'] ) {
		$eaw_meta_html .= '<span class="article-meta-item"><span>' . esc_html( eaw_mod( 'article_updated_label' ) ) . '</span> <time datetime="' . esc_attr( $eaw_meta['modified_iso'] ) . '">' . esc_html( $eaw_meta['modified'] ) . '</time></span>';
	}
	$eaw_meta_html .= '<span class="article-meta-item">' . eaw_icon( 'book', 'icon icon-sm' ) . '<span>' . esc_html( eaw_pages_count_text( 'article_reading_text', $eaw_meta['minutes'] ) ) . '</span></span>';
	$eaw_meta_html .= '</div>';

	$eaw_media = '';
	if ( has_post_thumbnail() ) {
		$eaw_media = '<div class="pg-hero-media pg-hero-media--cover"><figure class="pg-squircle article-thumb">'
			. eaw_pages_capture( 'the_post_thumbnail', 'large', array( 'alt' => eaw_pages_featured_alt( get_the_ID() ) ) )
			. '</figure></div>';
	}
	?>

	<div class="reading-progress" aria-hidden="true"><span></span></div>

	<main id="main" class="pg article-page">
		<article <?php post_class( 'single-article' ); ?>>

			<?php
			eaw_pages_hero(
				array(
					'tag'   => 'header',
					'title' => $eaw_title,
					'chip'  => $eaw_chip,
					'meta'  => $eaw_meta_html,
					'media' => $eaw_media,
					'class' => 'pg-hero--article',
				)
			);
			?>

			<div class="pg-sec article-main">
				<div class="container">
					<div class="longform-layout<?php echo $eaw_has_toc ? '' : ' longform-layout--solo'; ?>">
						<?php
						if ( $eaw_has_toc ) {
							eaw_pages_toc( $eaw_art_toc, eaw_mod( 'article_toc_label' ) );
						}
						?>

						<div class="lf-card article-card">
							<div class="entry-content guide-content article-content<?php echo eaw_pages_self_numbered( $eaw_art_toc ) ? ' lf-self-num' : ''; ?>">
								<?php echo $eaw_content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
							</div>

							<?php
							wp_link_pages(
								array(
									'before' => '<div class="page-links">',
									'after'  => '</div>',
								)
							);
							?>

							<?php
							if ( function_exists( 'eaw_cluster_box' ) ) {
								eaw_cluster_box();
							}
							?>

							<div class="article-share">
								<span class="article-share-label"><?php echo esc_html( eaw_mod( 'article_share_label' ) ); ?></span>
								<div class="article-share-btns">
									<a class="share-btn share-line" href="<?php echo esc_url( 'https://social-plugins.line.me/lineit/share?url=' . rawurlencode( $eaw_link ) ); ?>" target="_blank" rel="noopener"><?php echo eaw_icon( 'line' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span>LINE</span></a>
									<a class="share-btn share-fb" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $eaw_link ) ); ?>" target="_blank" rel="noopener"><?php echo eaw_icon( 'facebook' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span>Facebook</span></a>
									<button class="share-btn share-copy" type="button" data-url="<?php echo esc_url( $eaw_link ); ?>"><?php echo eaw_icon( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo eaw_icon( 'check', 'icon share-done' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( eaw_mod( 'article_copy_label' ) ); ?></span></button>
								</div>
							</div>

							<?php
							$eaw_tags = get_the_tag_list( '<ul class="article-tags"><li>', '</li><li>', '</li></ul>' );
							if ( $eaw_tags ) {
								echo wp_kses_post( $eaw_tags );
							}
							?>

							<?php if ( '' !== $eaw_author ) : ?>
								<aside class="author-box">
									<span class="tile tile--navy" aria-hidden="true"><?php echo eaw_icon( 'users' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
									<div class="author-box-body">
										<span class="pg-label"><?php echo esc_html( eaw_mod( 'article_author_kicker' ) ); ?></span>
										<p class="author-box-name"><?php echo esc_html( $eaw_author ); ?></p>
										<?php if ( eaw_pages_has( eaw_mod( 'article_author_bio' ) ) ) : ?>
											<p class="author-box-bio"><?php echo esc_html( eaw_mod( 'article_author_bio' ) ); ?></p>
										<?php endif; ?>
										<?php if ( '' !== $eaw_about && '' !== trim( (string) eaw_mod( 'article_author_link' ) ) ) : ?>
											<a class="author-box-link" href="<?php echo esc_url( $eaw_about ); ?>"><span><?php echo esc_html( eaw_mod( 'article_author_link' ) ); ?></span> <?php echo eaw_icon( 'arrow', 'icon icon-sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
										<?php endif; ?>
									</div>
								</aside>
							<?php endif; ?>

							<?php /* คำเตือนความเสี่ยง · ข้อความหลักเต็มเสมอ + คำเตือนเพิ่มของบทความ · ไม่ใช้ .reveal ให้เห็นทันทีแม้ JS ไม่ทำงาน */ ?>
							<div class="pg-warn article-disclaimer">
								<span class="tile tile--gold" aria-hidden="true"><?php echo eaw_icon( 'warn' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
								<div>
									<p><?php echo esc_html( eaw_mod( 'risk_text' ) ); ?></p>
									<?php if ( eaw_pages_has( eaw_mod( 'article_disclaimer_text' ) ) ) : ?>
										<p><?php echo esc_html( eaw_mod( 'article_disclaimer_text' ) ); ?></p>
									<?php endif; ?>
									<?php
									$eaw_risk_url = function_exists( 'eaw_published_page_url' ) ? eaw_published_page_url( 'risk-disclosure' ) : '';
									if ( '' !== $eaw_risk_url && '' !== trim( (string) eaw_mod( 'article_disclaimer_link' ) ) ) :
										?>
										<p><a href="<?php echo esc_url( $eaw_risk_url ); ?>"><?php echo esc_html( eaw_mod( 'article_disclaimer_link' ) ); ?></a></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</article>

		<?php
		if ( $eaw_cat ) :
			$eaw_related = new WP_Query(
				array(
					'category__in'        => array( $eaw_cat->term_id ),
					'post__not_in'        => array( get_the_ID() ),
					'posts_per_page'      => 9,
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
				)
			);
			if ( $eaw_related->have_posts() ) :
				?>
				<section class="pg-sec related-section" aria-labelledby="related-title">
					<div class="container">
						<div class="glass-panel pg-panel">
							<div class="related-head">
								<h2 id="related-title"><?php echo eaw_text( eaw_mod( 'article_related_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h2>
								<div class="rail-nav">
									<button type="button" class="rail-btn rail-prev" data-dir="-1" aria-label="<?php echo esc_attr( eaw_mod( 'articles_prev_label' ) ); ?>"><?php echo eaw_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
									<button type="button" class="rail-btn rail-next" data-dir="1" aria-label="<?php echo esc_attr( eaw_mod( 'articles_next_label' ) ); ?>"><?php echo eaw_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
								</div>
							</div>
							<div class="related-rail">
								<?php
								while ( $eaw_related->have_posts() ) :
									$eaw_related->the_post();
									?>
									<article <?php post_class( 'post-card' ); ?>>
										<?php if ( has_post_thumbnail() ) : ?>
											<a class="post-card-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
												<?php the_post_thumbnail( 'medium_large', array( 'alt' => eaw_pages_featured_alt( get_the_ID() ) ) ); ?>
											</a>
										<?php endif; ?>
										<div class="post-card-body">
											<span class="post-meta"><?php echo esc_html( eaw_pages_thai_date( get_the_date( 'c' ) ) ); ?></span>
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<span class="post-card-more" aria-hidden="true"><?php echo eaw_icon( 'arrow', 'icon icon-sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
										</div>
									</article>
									<?php
								endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</section>
				<?php
			endif;
		endif;
		?>

		<?php /* บล็อกติดต่อปิดท้าย · อยู่ติดส่วนท้ายเว็บ (หลังบทความในหมวดเดียวกัน) */ ?>
		<?php eaw_line_cta(); ?>

	</main>

	<?php
	/* BlogPosting · ผู้เขียนเป็นทีมงาน (Organization) ตามกล่องผู้เขียน ไม่เปิดเผยชื่อผู้ใช้ WordPress */
	$eaw_author_node = array(
		'@type' => 'Organization',
		'name'  => '' !== $eaw_author ? $eaw_author : get_bloginfo( 'name' ),
	);
	if ( '' !== $eaw_about ) {
		$eaw_author_node['url'] = $eaw_about;
	}
	$eaw_schema = array(
		'@context'         => 'https://schema.org',
		'@type'            => 'BlogPosting',
		'headline'         => wp_strip_all_tags( get_the_title() ),
		'datePublished'    => get_the_date( 'c' ),
		'dateModified'     => get_the_modified_date( 'c' ),
		'author'           => $eaw_author_node,
		'publisher'        => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'logo'  => array(
				'@type' => 'ImageObject',
				'url'   => eaw_logo_url(),
			),
		),
		'mainEntityOfPage' => $eaw_link,
	);
	if ( $eaw_thumb ) {
		$eaw_schema['image'] = $eaw_thumb;
	}
	if ( ! eaw_has_seo_plugin() ) {
		$eaw_schema['description'] = eaw_meta_description();
		echo '<script type="application/ld+json">' . wp_json_encode( $eaw_schema, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	?>

	<?php
endwhile;

get_footer();
