<?php
/**
 * Front page · EA WING · ดีไซน์ Glass Sky (docs/design.md · ต้นแบบ dev/mockup/index.html)
 *
 * hero → about → story → features (4 การ์ด) → modes (Lite/Full) → devices → license (การ์ดล็อกอิน) → tests (3 การ์ด)
 * → compare → how (6 ขั้น) → ready (เช็กลิสต์) → pricing → articles → faq (14 ข้อ) → risk
 * - ส่วนเสริม story/modes/license/compare/ready/articles อยู่ใน inc/modules/homeplus.php
 * - แต่ละส่วนเป็นแผงกระจก (.glass-panel) ห่างกัน 14px อยู่ในกรอบหน้าเว็บที่ header เปิดไว้ (โมดูล chrome)
 * - แถบติดต่อท้ายหน้า (LINE / OpenChat) อยู่ใน footer (โมดูล chrome) ไม่ซ้ำที่นี่
 * - ข้อความทุกคำมาจาก setting (ค่าเริ่มต้นใน inc/modules/home.php) · escape ทุก output
 * - ไม่มีตัวเลขผลเทรด · ภาพในการ์ดมีคำบรรยายว่าเป็นภาพประกอบ · คำเตือนความเสี่ยงแสดงเต็ม ไม่ตัด
 * - ไม่มี JS ก็ใช้ได้ครบ (FAQ ใช้ details · home.js ช่วยเฉพาะเบราว์เซอร์ที่ยังไม่รองรับ details[name])
 *
 * @package eawing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( eaw_has_elementor_content() && eaw_uses_elementor_page_template() ) :
	?>
	<main id="main" class="elementor-page-shell elementor-page-shell--front">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'elementor-entry' ); ?>>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	</main>
	<?php
	get_footer();
	return;
endif;
?>

<main id="main" class="home-v3">

<?php /* ============ HERO · ซ้าย: kicker + H1 + คำอธิบาย + ปุ่ม + คำเตือน + ใช้งานร่วมกับ · ขวา: แผง EA ในกรอบกระจก + การ์ดลอย ============ */ ?>
<?php if ( eaw_mod( 'show_hero' ) ) : ?>
	<?php
	$eaw_hero_brand = trim( (string) eaw_mod( 'hero_title' ) );
	$eaw_hero_line  = trim( (string) eaw_mod( 'hero_subtitle' ) );
	$eaw_hero_em    = trim( (string) eaw_mod( 'hero_subtitle_em' ) );
	$eaw_hero_desc  = trim( (string) eaw_mod( 'hero_desc' ) );
	$eaw_hero_note  = trim( (string) eaw_mod( 'hero_note' ) );
	$eaw_hero_img   = trim( (string) eaw_mod( 'hero_image' ) );
	$eaw_hero_btn1  = eaw_home_link( eaw_mod( 'hero_btn1_url' ) );
	$eaw_hero_btn2  = eaw_home_link( eaw_mod( 'hero_btn2_url' ) );
	$eaw_works      = eaw_home_pairs( eaw_mod( 'home_hero_works_items' ) );
	$eaw_works_lbl  = trim( (string) eaw_mod( 'home_hero_works_label' ) );
	$eaw_chips      = eaw_home_pairs( eaw_mod( 'home_hero_chips' ), false, 2 );
	$eaw_chip_icons = array( array( 'clock', 'gold' ), array( 'shield', 'sky' ) );
	$eaw_panel_cap  = trim( (string) eaw_mod( 'hero_panel_caption' ) );
	?>
<section class="hm-hero<?php echo esc_attr( eaw_home_tone( 'hero' ) ); ?>" id="hero" aria-labelledby="hm-hero-title">
	<div class="hm-hero-copy">
		<?php eaw_home_kicker( eaw_mod( 'hero_badge' ) ); ?>
		<h1 class="hm-hero-title" id="hm-hero-title">
			<?php if ( '' !== $eaw_hero_brand ) : ?>
				<span class="hm-hero-brand"><?php echo esc_html( $eaw_hero_brand ); ?></span>
			<?php endif; ?>
			<?php if ( '' !== $eaw_hero_line ) : ?>
				<span class="hm-hero-line"><?php echo eaw_text( $eaw_hero_line ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span>
			<?php endif; ?>
			<?php if ( '' !== $eaw_hero_em ) : ?>
				<span class="hm-hero-em"><span class="grad-word"><?php echo eaw_text( $eaw_hero_em ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></span>
			<?php endif; ?>
		</h1>
		<?php if ( '' !== $eaw_hero_desc ) : ?>
			<p class="hm-hero-text"><?php echo eaw_text( $eaw_hero_desc ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
		<?php endif; ?>
		<?php if ( '' !== $eaw_hero_btn1 || '' !== $eaw_hero_btn2 ) : ?>
			<div class="hm-hero-cta">
				<?php eaw_home_btn( eaw_mod( 'hero_btn1_text' ), $eaw_hero_btn1, 'btn btn-dark hm-btn', 'arrow-ur' ); ?>
				<?php eaw_home_btn( eaw_mod( 'hero_btn2_text' ), $eaw_hero_btn2, 'btn btn-ghost hm-btn', 'download' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( '' !== $eaw_hero_note ) : ?>
			<p class="hm-hero-note"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo eaw_text( $eaw_hero_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></p>
		<?php endif; ?>
		<?php if ( ! empty( $eaw_works ) ) : ?>
			<div class="hm-works">
				<?php if ( '' !== $eaw_works_lbl ) : ?>
					<p class="hm-works-label"><?php echo esc_html( $eaw_works_lbl ); ?></p>
				<?php endif; ?>
				<ul class="hm-works-list">
					<?php foreach ( $eaw_works as $eaw_item ) : ?>
						<li><?php echo eaw_home_icon( eaw_home_platform_icon( $eaw_item[0] ), 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $eaw_item[0] ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>

	<div class="hm-hero-visual">
		<div class="hm-stage">
			<span class="orb hm-orb hm-orb--1" aria-hidden="true"></span>
			<div class="hm-squircle">
				<?php if ( '' !== $eaw_hero_img ) : ?>
					<img class="hm-hero-img" src="<?php echo esc_url( $eaw_hero_img ); ?>" alt="<?php echo esc_attr( eaw_mod( 'home_hero_img_alt' ) ); ?>" width="1000" height="1000" loading="eager" decoding="async">
				<?php else : ?>
					<?php get_template_part( 'inc/parts/ea-panel' ); ?>
				<?php endif; ?>
			</div>
			<?php foreach ( $eaw_chips as $eaw_ci => $eaw_chip ) : ?>
				<div class="hm-chip hm-chip--<?php echo 0 === $eaw_ci ? 'a' : 'b'; ?>">
					<span class="tile tile--<?php echo esc_attr( $eaw_chip_icons[ $eaw_ci ][1] ); ?>"><?php echo eaw_icon( $eaw_chip_icons[ $eaw_ci ][0], 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="hm-chip-text"><strong><?php echo esc_html( $eaw_chip[0] ); ?></strong><?php if ( '' !== $eaw_chip[1] ) : ?> <span><?php echo esc_html( $eaw_chip[1] ); ?></span><?php endif; ?></span>
				</div>
			<?php endforeach; ?>
			<span class="orb hm-orb hm-orb--2" aria-hidden="true"></span>
		</div>
		<?php if ( '' === $eaw_hero_img && '' !== $eaw_panel_cap ) : ?>
			<p class="hm-visual-cap"><?php echo esc_html( $eaw_panel_cap ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php else : /* ให้มี h1 เสมอ แม้ปิด hero (SEO / โปรแกรมอ่านหน้าจอ) */ ?>
	<?php $eaw_h1 = trim( eaw_mod( 'hero_title' ) . ' ' . eaw_mod( 'hero_subtitle' ) . ' ' . eaw_mod( 'hero_subtitle_em' ) ); ?>
<h1 class="sr-only"><?php echo esc_html( '' !== $eaw_h1 ? $eaw_h1 : get_bloginfo( 'name' ) ); ?></h1>
<?php endif; ?>

<?php /* ============ ABOUT · หัวข้อ + การ์ดข้อมูล (ไม่ใช่ผลเทรด) ซ้าย · ย่อหน้า + ปุ่มกระจก ขวา ============ */ ?>
<?php if ( eaw_mod( 'show_about' ) ) : ?>
	<?php
	$eaw_stats      = eaw_home_pairs( eaw_mod( 'home_about_stats' ), false, 3 );
	$eaw_stat_icons = array( 'chart', 'plan', 'group' );
	?>
<section class="glass-panel hm-panel hm-about<?php echo esc_attr( eaw_home_tone( 'what' ) ); ?>" id="what" aria-labelledby="hm-about-title">
	<span id="about" class="hm-anchor" aria-hidden="true"></span>
	<div class="hm-about-grid">
		<div class="hm-about-main">
			<?php eaw_home_kicker( eaw_mod( 'home_what_kicker' ) ); ?>
			<h2 class="hm-h2" id="hm-about-title"><?php echo eaw_text( eaw_mod( 'about_title' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h2>
			<?php if ( ! empty( $eaw_stats ) ) : ?>
				<ul class="hm-stats" style="--n:<?php echo (int) count( $eaw_stats ); ?>">
					<?php foreach ( $eaw_stats as $eaw_si => $eaw_stat ) : ?>
						<li class="hm-stat"><?php echo eaw_home_icon( $eaw_stat_icons[ $eaw_si ], 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><b><?php echo esc_html( $eaw_stat[0] ); ?></b><?php if ( '' !== $eaw_stat[1] ) : ?><span><?php echo esc_html( $eaw_stat[1] ); ?></span><?php endif; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="hm-about-copy">
			<?php eaw_home_paragraphs( eaw_mod( 'about_text' ) ); ?>
			<?php eaw_home_btn( eaw_mod( 'home_about_btn_text' ), eaw_home_link( eaw_mod( 'home_about_btn_url' ) ), 'btn btn-ghost hm-btn hm-btn--sm', 'arrow-ur' ); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php eaw_homeplus_section( 'story' ); ?>

<?php /* ============ WHAT IT DOES · 4 การ์ดกระจก กระเบื้องไอคอน + ลูกศร (จุดเด่น 1-4) ============ */ ?>
<?php if ( eaw_mod( 'show_features' ) ) : ?>
	<?php
	$eaw_feats     = array();
	$eaw_feat_look = array( array( 'gear', 'sky' ), array( 'plan', 'gold' ), array( 'chart', 'blue' ), array( 'shield', 'navy' ) );
	for ( $i = 1; $i <= 4; $i++ ) {
		$eaw_f_title = trim( (string) eaw_mod( 'feat' . $i . '_title' ) );
		$eaw_f_desc  = trim( (string) eaw_mod( 'feat' . $i . '_desc' ) );
		if ( '' === $eaw_f_title && '' === $eaw_f_desc ) {
			continue;
		}
		$eaw_feats[] = array(
			'title' => $eaw_f_title,
			'desc'  => $eaw_f_desc,
			'url'   => eaw_home_link( eaw_mod( 'home_feat' . $i . '_url' ) ),
			'look'  => $eaw_feat_look[ $i - 1 ],
		);
	}
	?>
<section class="glass-panel hm-panel hm-features<?php echo esc_attr( eaw_home_tone( 'features' ) ); ?>" id="features" aria-labelledby="hm-features-title">
	<?php eaw_home_head( 'hm-features-title', eaw_mod( 'home_features_kicker' ), eaw_mod( 'features_title' ), eaw_mod( 'features_subtitle' ) ); ?>
	<?php if ( ! empty( $eaw_feats ) ) : ?>
		<ul class="hm-grid hm-grid--4" style="--n:<?php echo (int) count( $eaw_feats ); ?>">
			<?php foreach ( $eaw_feats as $eaw_feat ) : ?>
				<?php $eaw_tag = '' !== $eaw_feat['url'] ? 'a' : 'div'; ?>
				<li>
					<<?php echo $eaw_tag; // phpcs:ignore WordPress.Security.EscapeOutput -- a|div ?> class="glass-card hm-card"<?php echo '' !== $eaw_feat['url'] ? ' href="' . esc_url( $eaw_feat['url'] ) . '"' : ''; ?>>
						<span class="tile tile--<?php echo esc_attr( $eaw_feat['look'][1] ); ?>"><?php echo eaw_home_icon( $eaw_feat['look'][0], 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<?php if ( '' !== $eaw_feat['title'] ) : ?>
							<h3 class="hm-card-title"><?php echo eaw_text( $eaw_feat['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h3>
						<?php endif; ?>
						<?php if ( '' !== $eaw_feat['desc'] ) : ?>
							<p class="hm-card-text"><?php echo eaw_text( $eaw_feat['desc'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
						<?php endif; ?>
						<?php if ( '' !== $eaw_feat['url'] ) : ?>
							<span class="hm-arrow" aria-hidden="true"><?php echo eaw_home_icon( 'arrow-ur', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<?php endif; ?>
					</<?php echo $eaw_tag; // phpcs:ignore WordPress.Security.EscapeOutput -- a|div ?>>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php eaw_homeplus_section( 'modes' ); ?>

<?php /* ============ WORKS ON · กระเบื้องอุปกรณ์ ลิงก์ไปคู่มือ + หมายเหตุเรื่องมือถือ ============ */ ?>
<?php if ( eaw_mod( 'home_show_devices' ) ) : ?>
	<?php
	$eaw_devices     = eaw_home_pairs( eaw_mod( 'home_devices_items' ) );
	$eaw_device_note = trim( (string) eaw_mod( 'install_home_note' ) );
	?>
	<?php if ( ! empty( $eaw_devices ) ) : ?>
<section class="glass-panel hm-panel hm-devices<?php echo esc_attr( eaw_home_tone( 'devices' ) ); ?>" id="devices" aria-labelledby="hm-devices-title">
	<?php eaw_home_head( 'hm-devices-title', eaw_mod( 'home_devices_kicker' ), eaw_mod( 'home_devices_title' ) ); ?>
	<ul class="hm-device-grid" style="--n:<?php echo (int) min( 6, count( $eaw_devices ) ); ?>">
		<?php foreach ( $eaw_devices as $eaw_device ) : ?>
			<?php $eaw_dev_url = eaw_home_link( $eaw_device[1] ); ?>
			<li>
				<?php if ( '' !== $eaw_dev_url ) : ?>
					<a class="hm-device" href="<?php echo esc_url( $eaw_dev_url ); ?>"><?php echo eaw_home_icon( eaw_home_platform_icon( $eaw_device[0] ), 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $eaw_device[0] ); ?></span></a>
				<?php else : ?>
					<span class="hm-device"><?php echo eaw_home_icon( eaw_home_platform_icon( $eaw_device[0] ), 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $eaw_device[0] ); ?></span></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
		<?php if ( '' !== $eaw_device_note ) : ?>
	<p class="hm-note"><?php echo eaw_icon( 'phone', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo eaw_text( $eaw_device_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></p>
		<?php endif; ?>
</section>
	<?php endif; ?>
<?php endif; ?>

<?php eaw_homeplus_section( 'license' ); ?>

<?php /* ============ BEFORE YOU DECIDE · การ์ดภาพ Backtest / Forward Test / ติดตั้ง · ภาพประกอบเท่านั้น ไม่มีตัวเลขผล ============ */ ?>
<?php
$eaw_shots = array();
if ( eaw_mod( 'show_tests' ) ) {
	$eaw_shots[] = array(
		'key'   => 'tests_bt',
		'art'   => 'bt',
		'title' => eaw_mod( 'tests_bt_title' ),
		'text'  => eaw_mod( 'tests_bt_text' ),
		'more'  => eaw_mod( 'home_tests_bt_btn' ),
		'url'   => eaw_home_link( '/backtest/' ),
	);
	$eaw_shots[] = array(
		'key'   => 'tests_fw',
		'art'   => 'fw',
		'title' => eaw_mod( 'tests_fw_title' ),
		'text'  => eaw_mod( 'tests_fw_text' ),
		'more'  => eaw_mod( 'home_tests_fw_btn' ),
		'url'   => eaw_home_link( '/forward-test/' ),
	);
}
if ( eaw_mod( 'show_install_home' ) ) {
	$eaw_shots[] = array(
		'key'   => 'ih_step1',
		'art'   => 'install',
		'title' => eaw_mod( 'install_home_title' ),
		'text'  => eaw_mod( 'install_home_sub' ),
		'more'  => eaw_mod( 'home_install_btn' ),
		'url'   => eaw_home_link( eaw_mod( 'home_install_btn_url' ) ),
	);
}
?>
<?php if ( ! empty( $eaw_shots ) ) : ?>
	<?php
	$eaw_shots_note = trim( (string) eaw_mod( 'home_shots_note' ) );
	$eaw_tests_note = trim( (string) eaw_mod( 'tests_note' ) );
	// ยังไม่มีตัวเลขจริงทั้ง Backtest และ Forward → เติมประโยค "ยังไม่มีผลทดสอบ" ข้างหน้า
	$eaw_no_stats = true;
	foreach ( array( array( 'bt_stat', 8 ), array( 'fw_stat', 6 ) ) as $eaw_sp ) {
		for ( $eaw_si = 1; $eaw_si <= $eaw_sp[1]; $eaw_si++ ) {
			if ( ! eaw_is_placeholder( eaw_mod( $eaw_sp[0] . $eaw_si . '_value' ) ) ) {
				$eaw_no_stats = false;
			}
		}
	}
	if ( eaw_mod( 'show_tests' ) && $eaw_no_stats && trim( (string) eaw_mod( 'tests_pending_note' ) ) ) {
		$eaw_tests_note = trim( trim( (string) eaw_mod( 'tests_pending_note' ) ) . ' · ' . $eaw_tests_note, ' ·' );
	}
	?>
<section class="glass-panel hm-panel hm-info<?php echo esc_attr( eaw_home_tone( 'tests' ) ); ?>" id="tests" aria-labelledby="hm-info-title">
	<span id="install" class="hm-anchor" aria-hidden="true"></span>
	<?php eaw_home_head( 'hm-info-title', eaw_mod( 'tests_kicker' ), eaw_mod( 'tests_title' ), eaw_mod( 'tests_subtitle' ), eaw_mod( 'home_info_more_text' ), eaw_home_link( eaw_mod( 'home_info_more_url' ) ) ); ?>
	<ul class="hm-grid hm-grid--3" style="--n:<?php echo (int) count( $eaw_shots ); ?>">
		<?php foreach ( $eaw_shots as $eaw_shot ) : ?>
			<?php
			$eaw_tag  = '' !== $eaw_shot['url'] ? 'a' : 'div';
			$eaw_more = trim( (string) $eaw_shot['more'] );
			?>
			<li>
				<<?php echo $eaw_tag; // phpcs:ignore WordPress.Security.EscapeOutput -- a|div ?> class="glass-card hm-card hm-shot"<?php echo '' !== $eaw_shot['url'] ? ' href="' . esc_url( $eaw_shot['url'] ) . '"' : ''; ?>>
					<?php eaw_home_shot_media( $eaw_shot['key'], $eaw_shot['art'] ); ?>
					<?php if ( '' !== trim( (string) $eaw_shot['title'] ) ) : ?>
						<h3 class="hm-card-title"><?php echo eaw_text( $eaw_shot['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h3>
					<?php endif; ?>
					<?php if ( '' !== trim( (string) $eaw_shot['text'] ) ) : ?>
						<p class="hm-card-text hm-clamp"><?php echo eaw_text( $eaw_shot['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
					<?php endif; ?>
					<?php if ( '' !== $eaw_shot['url'] ) : ?>
						<?php if ( '' !== $eaw_more ) : ?>
							<span class="hm-more"><?php echo esc_html( $eaw_more ); ?></span>
						<?php endif; ?>
						<span class="hm-arrow" aria-hidden="true"><?php echo eaw_home_icon( 'arrow-ur', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<?php endif; ?>
				</<?php echo $eaw_tag; // phpcs:ignore WordPress.Security.EscapeOutput -- a|div ?>>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php if ( '' !== $eaw_shots_note ) : ?>
		<p class="hm-illus-note"><?php echo esc_html( $eaw_shots_note ); ?></p>
	<?php endif; ?>
	<?php if ( '' !== $eaw_tests_note ) : ?>
		<p class="hm-note"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo eaw_text( $eaw_tests_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></p>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php eaw_homeplus_section( 'compare' ); ?>

<?php /* ============ HOW TO START · การ์ดขั้น 01-06 ต่อด้วยเส้นประ แต่ละขั้นลิงก์ไปคู่มือ (ขั้น line = ทัก LINE) ============ */ ?>
<?php if ( eaw_mod( 'show_steps' ) ) : ?>
	<?php
	$eaw_steps     = array();
	$eaw_step_look = array( array( 'user', 'sky' ), array( 'download', 'blue' ), array( 'wallet', 'gold' ), array( 'line', 'sky' ), array( 'plug', 'blue' ), array( 'server', 'navy' ) );
	for ( $i = 1; $i <= 6; $i++ ) {
		$eaw_s_title = trim( (string) eaw_mod( 'step' . $i . '_title' ) );
		if ( '' === $eaw_s_title ) {
			continue;
		}
		$eaw_steps[] = array(
			'n'     => sprintf( '%02d', count( $eaw_steps ) + 1 ),
			'title' => $eaw_s_title,
			'desc'  => trim( (string) eaw_mod( 'step' . $i . '_desc' ) ),
			'url'   => trim( (string) eaw_mod( 'step' . $i . '_url' ) ),
			'look'  => $eaw_step_look[ $i - 1 ],
		);
	}
	$eaw_step_link = trim( (string) eaw_mod( 'home_steps_link_text' ) );
	?>
	<?php if ( ! empty( $eaw_steps ) ) : ?>
<section class="glass-panel hm-panel hm-steps<?php echo esc_attr( eaw_home_tone( 'how' ) ); ?>" id="how" aria-labelledby="hm-steps-title">
	<span id="how-it-works" class="hm-anchor" aria-hidden="true"></span>
	<?php eaw_home_head( 'hm-steps-title', eaw_mod( 'steps_kicker' ), eaw_mod( 'steps_title' ), eaw_mod( 'steps_subtitle' ) ); ?>
	<ol class="hm-step-list" style="--n:<?php echo (int) count( $eaw_steps ); ?>">
		<?php foreach ( $eaw_steps as $eaw_step ) : ?>
			<li class="hm-step">
				<div class="hm-step-top">
					<span class="hm-step-no"><?php echo esc_html( $eaw_step['n'] ); ?></span>
					<span class="tile tile--<?php echo esc_attr( $eaw_step['look'][1] ); ?>"><?php echo eaw_home_icon( $eaw_step['look'][0], 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</div>
				<div class="hm-step-body">
					<h3 class="hm-step-title"><?php echo eaw_text( $eaw_step['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h3>
					<?php if ( '' !== $eaw_step['desc'] ) : ?>
						<p class="hm-step-text"><?php echo eaw_text( $eaw_step['desc'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
					<?php endif; ?>
					<?php
					if ( 'line' === strtolower( $eaw_step['url'] ) ) {
						eaw_home_contact_link( eaw_mod( 'home_steps_line_text' ), 'hm-step-link', 'home-steps', '', false );
					} else {
						$eaw_step_url = eaw_home_link( $eaw_step['url'] );
						if ( '' !== $eaw_step_url && '' !== $eaw_step_link ) {
							printf( '<a class="hm-step-link" href="%s">%s</a>', esc_url( $eaw_step_url ), esc_html( $eaw_step_link ) );
						}
					}
					?>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
	<?php endif; ?>
<?php endif; ?>

<?php eaw_homeplus_section( 'ready' ); ?>

<?php /* ============ PRICING · การ์ดกระจกโหมดสอบถาม (ไม่มีราคาจนกว่าจะตั้งโหมดแสดงราคา + ราคาจริง) ============ */ ?>
<?php if ( eaw_mod( 'show_pricing_home' ) ) : ?>
	<?php
	$eaw_pmode = eaw_mod( 'pricing_mode' );
	$eaw_tiers = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$eaw_pk_name = trim( (string) eaw_mod( 'pkg' . $i . '_name' ) );
		if ( '' === $eaw_pk_name ) {
			continue;
		}
		$eaw_pk_price = trim( (string) eaw_mod( 'pkg' . $i . '_price' ) );
		$eaw_tiers[]  = array(
			'name'     => $eaw_pk_name,
			'tag'      => trim( (string) eaw_mod( 'pkg' . $i . '_tag' ) ),
			'price'    => 'price' === $eaw_pmode && eaw_home_price_ready( $eaw_pk_price ) ? $eaw_pk_price : '',
			'period'   => trim( (string) eaw_mod( 'pkg' . $i . '_period' ) ),
			'features' => eaw_lines( eaw_mod( 'pkg' . $i . '_features' ) ),
			'featured' => (bool) eaw_mod( 'pkg' . $i . '_featured' ),
		);
	}
	$eaw_rec_label    = trim( (string) eaw_mod( 'home_pricing_rec_label' ) );
	$eaw_contact_text = trim( (string) eaw_mod( 'home_pricing_contact_text' ) );
	$eaw_margin_note  = trim( (string) eaw_mod( 'home_pricing_margin_note' ) );
	$eaw_pricing_note = trim( (string) eaw_mod( 'pricing_note' ) );
	?>
<section class="glass-panel hm-panel hm-pricing<?php echo esc_attr( eaw_home_tone( 'pricing' ) ); ?>" id="pricing" aria-labelledby="hm-pricing-title">
	<?php eaw_home_head( 'hm-pricing-title', eaw_mod( 'home_pricing_kicker' ), eaw_mod( 'pricing_home_title' ), eaw_mod( 'pricing_home_sub' ), eaw_mod( 'home_pricing_more_text' ), eaw_home_link( '/pricing/' ) ); ?>
	<?php if ( ! empty( $eaw_tiers ) ) : ?>
		<ul class="hm-grid hm-grid--3 hm-tiers" style="--n:<?php echo (int) count( $eaw_tiers ); ?>">
			<?php foreach ( $eaw_tiers as $eaw_tier ) : ?>
				<li class="glass-card hm-tier<?php echo $eaw_tier['featured'] ? ' is-featured' : ''; ?>">
					<div class="hm-tier-head">
						<h3 class="hm-tier-name"><?php echo esc_html( $eaw_tier['name'] ); ?></h3>
						<?php if ( $eaw_tier['featured'] && '' !== $eaw_rec_label ) : ?>
							<span class="hm-tier-rec"><?php echo esc_html( $eaw_rec_label ); ?></span>
						<?php endif; ?>
					</div>
					<?php if ( '' !== $eaw_tier['tag'] ) : ?>
						<p class="hm-tier-tag"><?php echo eaw_text( $eaw_tier['tag'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
					<?php endif; ?>
					<p class="hm-tier-price">
						<?php if ( '' !== $eaw_tier['price'] ) : ?>
							<span class="hm-tier-amt"><?php echo esc_html( $eaw_tier['price'] ); ?></span><?php if ( '' !== $eaw_tier['period'] ) : ?> <span class="hm-tier-period"><?php echo esc_html( $eaw_tier['period'] ); ?></span><?php endif; ?>
						<?php else : ?>
							<span class="hm-tier-amt hm-tier-amt--contact"><?php echo esc_html( $eaw_contact_text ); ?></span>
						<?php endif; ?>
					</p>
					<?php if ( ! empty( $eaw_tier['features'] ) ) : ?>
						<ul class="hm-checks">
							<?php foreach ( $eaw_tier['features'] as $eaw_item ) : ?>
								<li><?php echo eaw_icon( 'check', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo eaw_text( $eaw_item ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php eaw_home_contact_link( eaw_mod( 'pricing_btn_text' ), $eaw_tier['featured'] ? 'btn btn-fire hm-tier-btn' : 'btn btn-ghost hm-tier-btn', 'home-pricing', $eaw_tier['name'] ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if ( '' !== $eaw_margin_note ) : ?>
		<p class="hm-note hm-note--warn"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo eaw_text( $eaw_margin_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span></p>
	<?php endif; ?>
	<?php if ( '' !== $eaw_pricing_note ) : ?>
		<p class="hm-illus-note"><?php echo eaw_text( $eaw_pricing_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php eaw_homeplus_section( 'articles' ); ?>

<?php /* ============ FAQ · details.faq-item 2 คอลัมน์ (schema อ่านจาก key faqN_q / faqN_a เดียวกัน) · เปิดได้ทีละข้อ ============ */ ?>
<?php if ( eaw_mod( 'show_faq' ) ) : ?>
	<?php
	$eaw_faqs = array();
	for ( $i = 1; $i <= ( function_exists( 'eaw_home_faq_count' ) ? eaw_home_faq_count() : 10 ); $i++ ) {
		$eaw_q = trim( (string) eaw_mod( 'faq' . $i . '_q' ) );
		$eaw_a = trim( (string) eaw_mod( 'faq' . $i . '_a' ) );
		if ( '' !== $eaw_q && '' !== $eaw_a ) {
			$eaw_faqs[] = array( $eaw_q, $eaw_a );
		}
	}
	$eaw_faq_cols = array_chunk( $eaw_faqs, max( 1, (int) ceil( count( $eaw_faqs ) / 2 ) ) );
	?>
	<?php if ( ! empty( $eaw_faqs ) ) : ?>
<section class="glass-panel hm-panel hm-faq<?php echo esc_attr( eaw_home_tone( 'faq' ) ); ?>" id="faq" aria-labelledby="hm-faq-title">
	<?php eaw_home_head( 'hm-faq-title', eaw_mod( 'home_faq_kicker' ), eaw_mod( 'faq_title' ), eaw_mod( 'faq_subtitle' ) ); ?>
	<div class="hm-faq-grid">
		<?php foreach ( $eaw_faq_cols as $eaw_col ) : ?>
			<div class="hm-faq-col">
				<?php foreach ( $eaw_col as $eaw_faq ) : ?>
					<details class="faq-item hm-q" name="eawing-faq">
						<summary class="hm-q-sum"><span class="hm-q-text"><?php echo eaw_text( $eaw_faq[0] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></span><i class="hm-q-mark" aria-hidden="true"></i></summary>
						<div class="hm-q-ans"><?php eaw_home_paragraphs( $eaw_faq[1] ); ?></div>
					</details>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
	<?php endif; ?>
<?php endif; ?>

<?php /* ============ RISK · กล่องทองอ่อน ข้อความเต็ม ไม่พับ ไม่ตัด ============ */ ?>
<?php if ( eaw_mod( 'show_risk' ) ) : ?>
	<?php
	$eaw_risk_label = trim( (string) eaw_mod( 'home_risk_label' ) );
	$eaw_risk_title = trim( (string) eaw_mod( 'risk_title' ) );
	$eaw_risk_text  = trim( (string) eaw_mod( 'risk_text' ) );
	?>
<section class="hm-risk<?php echo esc_attr( eaw_home_tone( 'risk' ) ); ?>" id="risk"<?php echo '' !== $eaw_risk_title ? ' aria-labelledby="hm-risk-title"' : ''; ?>>
	<?php if ( '' !== $eaw_risk_label ) : ?>
		<p class="hm-risk-label"><?php echo eaw_icon( 'warn', 'icon' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $eaw_risk_label ); ?></p>
	<?php endif; ?>
	<?php if ( '' !== $eaw_risk_title ) : ?>
		<h2 class="hm-risk-title" id="hm-risk-title"><?php echo eaw_text( $eaw_risk_title ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></h2>
	<?php endif; ?>
	<?php if ( '' !== $eaw_risk_text ) : ?>
		<p class="hm-risk-text"><?php echo nl2br( esc_html( $eaw_risk_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside ?></p>
	<?php endif; ?>
	<?php eaw_home_btn( eaw_mod( 'home_risk_more_text' ), eaw_home_link( '/risk-disclosure/' ), 'btn btn-ghost hm-btn hm-btn--sm', 'shield' ); ?>
</section>
<?php endif; ?>

</main>

<?php
get_footer();
