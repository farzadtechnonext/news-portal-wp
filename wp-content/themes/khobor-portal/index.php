<?php
/**
 * Default archive and fallback template.
 *
 * @package Khobor_Portal
 */
get_header();
?>
<main class="site-shell page-content">
	<section class="archive-panel">
		<h1 class="archive-heading">
			<?php
			if ( is_search() ) {
				printf( esc_html__( '“%s” খুঁজুন', 'khobor-portal' ), esc_html( get_search_query() ) );
			} elseif ( is_home() ) {
				esc_html_e( 'সর্বশেষ সংবাদ', 'khobor-portal' );
			} else {
				the_archive_title();
			}
			?>
		</h1>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="latest-item">
					<a class="story-image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>"><?php echo wp_kses_post( khobor_portal_post_image( get_the_ID(), 'medium' ) ); ?></a>
					<div>
						<a class="story-category" href="<?php echo esc_url( khobor_portal_category_link() ); ?>"><?php echo wp_kses_post( khobor_portal_category_label() ); ?></a>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( khobor_portal_excerpt( get_the_ID(), 25 ) ); ?></p>
						<div class="story-meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time></div>
					</div>
				</article>
			<?php endwhile; ?>
			<div class="pagination"><?php the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'এই মুহূর্তে কোনো সংবাদ পাওয়া যায়নি।', 'khobor-portal' ); ?></p>
		<?php endif; ?>
	</section>
</main>
<?php get_footer(); ?>
