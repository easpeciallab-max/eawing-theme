<?php
/**
 * หน้าทั่วไป · ใช้กับทุกหน้าที่ยังไม่มี template เฉพาะ
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html lang="th">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#D4E6FB">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php if ( is_singular() ) : ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php else : ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1>ไม่พบหน้าที่ต้องการ</h1>
		<p><a href="<?php echo esc_url( home_url( '/go/' ) ); ?>">กลับไปหน้าหลัก EA WING</a></p>
	<?php endif; ?>
</main>

<?php wp_footer(); ?>
</body>
</html>
