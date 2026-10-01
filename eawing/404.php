<?php
/**
 * 404 · ไม่พบหน้า
 *
 * Glass Sky: แผงกระจกกลางจอ (ตัวเลข 404 ไล่สี · H1 · คำอธิบาย · ช่องค้นหาแคปซูลกระจก · ปุ่ม) → การ์ดลิงก์ด่วน
 * ปุ่มติดต่อใช้ eaw_contact_target(): LINE (ปุ่มทอง) → หน้า /go/ → ไม่แสดง (ไม่มีลิงก์ '#')
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$eaw_target = eaw_contact_target();
$eaw_links  = eaw_pages_pairs( eaw_mod( 'err404_links' ) );
?>

<main id="main" class="pg err-page">
	<section class="pg-sec error-404">
		<div class="container">
			<div class="glass-panel pg-panel err-panel">
				<span class="orb err-orb err-orb--a" aria-hidden="true"></span>
				<span class="orb err-orb err-orb--b" aria-hidden="true"></span>

				<div class="err-main">
					<p class="error-code" aria-hidden="true">404</p>
					<h1 class="error-title"><?php echo eaw_text( eaw_mod( 'err404_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h1>
					<p class="error-text"><?php echo esc_html( eaw_mod( 'err404_text' ) ); ?></p>

					<?php eaw_pages_search_form( eaw_mod( 'err404_search_placeholder' ), 'error-search' ); ?>

					<div class="error-actions">
						<a class="btn btn-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php echo eaw_icon( 'home', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
							<span><?php echo esc_html( eaw_mod( 'err404_home_label' ) ); ?></span>
						</a>
						<?php
						eaw_contact_button(
							array(
								'text'  => eaw_mod( 'err404_contact_text' ),
								'class' => $eaw_target['is_line'] ? 'btn btn-fire' : 'btn btn-ghost',
								'pos'   => '404',
								'arrow' => false,
							)
						);
						?>
					</div>
				</div>

				<?php if ( $eaw_links ) : ?>
					<nav class="error-links" aria-label="<?php echo esc_attr( eaw_mod( 'err404_title' ) ); ?>">
						<ul>
							<?php foreach ( $eaw_links as $eaw_link ) : ?>
								<?php if ( '' !== $eaw_link[1] ) : ?>
									<li><a class="err-link" href="<?php echo esc_url( eaw_link_url( $eaw_link[1] ) ); ?>"><span><?php echo esc_html( $eaw_link[0] ); ?></span><span class="err-link-ar" aria-hidden="true"><?php echo eaw_icon( 'arrow', 'icon icon-sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
