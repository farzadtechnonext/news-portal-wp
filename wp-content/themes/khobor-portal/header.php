<?php
/**
 * Site header.
 *
 * @package Khobor_Portal
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="topline">
	<div class="site-shell topline-inner">
		<span><?php echo esc_html( wp_date( 'l, j F Y' ) ); ?></span>
		<div class="topline-links">
			<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>"><?php esc_html_e( 'আরএসএস', 'khobor-portal' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'যোগাযোগ', 'khobor-portal' ); ?></a>
		</div>
	</div>
</div>
<header class="masthead">
	<div class="site-shell masthead-inner">
		<div class="brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand-mark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'হোম', 'khobor-portal' ); ?>">খ</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span class="brand-name"><?php bloginfo( 'name' ); ?></span>
					<span class="brand-tagline"><?php bloginfo( 'description' ); ?></span>
				</a>
			<?php endif; ?>
		</div>
		<?php get_search_form(); ?>
	</div>
</header>
<nav class="main-navigation" aria-label="<?php esc_attr_e( 'প্রধান নেভিগেশন', 'khobor-portal' ); ?>">
	<div class="site-shell nav-inner">
		<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'হোম', 'khobor-portal' ); ?>">⌂</a>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'category-nav',
			'fallback_cb'    => false,
			'depth'          => 1,
		) );
		?>
		<?php if ( ! has_nav_menu( 'primary' ) ) : ?>
			<ul class="category-nav">
				<?php foreach ( khobor_portal_get_categories() as $category ) : ?>
					<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
				<?php endforeach; ?>
				<?php if ( ! khobor_portal_get_categories() ) : ?>
					<li><a href="#latest"><?php esc_html_e( 'সর্বশেষ', 'khobor-portal' ); ?></a></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
	</div>
</nav>
