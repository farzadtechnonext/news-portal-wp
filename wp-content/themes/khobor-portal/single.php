<?php
/**
 * Single article template.
 *
 * @package Khobor_Portal
 */
get_header();
?>
<main class="site-shell page-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="article-panel">
			<a class="story-category" href="<?php echo esc_url( khobor_portal_category_link() ); ?>"><?php echo wp_kses_post( khobor_portal_category_label() ); ?></a>
			<h1><?php the_title(); ?></h1>
			<div class="story-meta">
				<span><?php echo esc_html( get_the_author() ); ?></span>
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y, g:i a' ) ); ?></time>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="article-featured-image"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>
			<div class="article-body"><?php the_content(); ?></div>
			<?php wp_link_pages(); ?>
		</article>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
