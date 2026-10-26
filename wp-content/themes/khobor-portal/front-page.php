<?php
/**
 * Homepage layout.
 *
 * @package Khobor_Portal
 */
get_header();

$lead_query = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 5,
	'ignore_sticky_posts' => false,
) );
$lead_posts = $lead_query->posts;
$lead_ids   = wp_list_pluck( $lead_posts, 'ID' );
$categories = khobor_portal_get_categories();
$section_settings = get_option( 'khobor_portal_homepage_sections', array() );
$curated_sections = isset( $section_settings['curated'] ) && is_array( $section_settings['curated'] ) ? $section_settings['curated'] : array();
$selected_sections = isset( $section_settings['posts'] ) && is_array( $section_settings['posts'] ) ? $section_settings['posts'] : array();
?>
<main class="site-shell page-content">
	<?php if ( ! empty( $lead_posts ) ) : ?>
		<?php
		$breaking_query = new WP_Query( array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => false,
		) );
		?>
		<?php if ( $breaking_query->have_posts() ) : ?>
			<div class="ticker">
				<div class="ticker-inner">
					<span class="ticker-label"><?php esc_html_e( 'সর্বশেষ', 'khobor-portal' ); ?></span>
					<?php while ( $breaking_query->have_posts() ) : $breaking_query->the_post(); ?>
						<a class="ticker-story" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		<section aria-labelledby="top-stories-title">
			<div class="section-heading">
				<h2 id="top-stories-title"><?php esc_html_e( 'আজকের প্রধান খবর', 'khobor-portal' ); ?></h2>
				<a href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>"><?php esc_html_e( 'সব খবর', 'khobor-portal' ); ?> →</a>
			</div>
			<div class="lead-grid<?php echo count( $lead_posts ) < 2 ? ' lead-grid--single' : ''; ?>">
				<?php $lead_post = $lead_posts[0]; ?>
				<article class="lead-story">
					<a class="story-image" href="<?php echo esc_url( get_permalink( $lead_post ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $lead_post ) ); ?>">
						<?php echo wp_kses_post( khobor_portal_post_image( $lead_post->ID, 'large' ) ); ?>
					</a>
					<div class="story-copy">
						<a class="story-category" href="<?php echo esc_url( khobor_portal_category_link( $lead_post->ID ) ); ?>"><?php echo wp_kses_post( khobor_portal_category_label( $lead_post->ID ) ); ?></a>
						<h1><a href="<?php echo esc_url( get_permalink( $lead_post ) ); ?>"><?php echo esc_html( get_the_title( $lead_post ) ); ?></a></h1>
						<?php $excerpt = khobor_portal_excerpt( $lead_post->ID, 32 ); ?>
						<?php if ( $excerpt ) : ?><p class="story-excerpt"><?php echo esc_html( $excerpt ); ?></p><?php endif; ?>
						<div class="story-meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $lead_post ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y', $lead_post ) ); ?></time></div>
					</div>
				</article>
				<?php if ( count( $lead_posts ) > 1 ) : ?>
					<div class="lead-list">
						<?php foreach ( array_slice( $lead_posts, 1 ) as $post ) : ?>
							<article class="compact-story">
								<a class="story-image" href="<?php echo esc_url( get_permalink( $post ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $post ) ); ?>"><?php echo wp_kses_post( khobor_portal_post_image( $post->ID, 'medium' ) ); ?></a>
								<div>
									<a class="story-category" href="<?php echo esc_url( khobor_portal_category_link( $post->ID ) ); ?>"><?php echo wp_kses_post( khobor_portal_category_label( $post->ID ) ); ?></a>
									<h2><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h2>
									<div class="story-meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $post ) ); ?>"><?php echo esc_html( get_the_date( 'j F', $post ) ); ?></time></div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<div class="content-columns">
			<section class="latest-panel" id="latest" aria-labelledby="latest-title">
				<div class="section-heading">
					<h2 id="latest-title"><?php esc_html_e( 'সর্বশেষ সংবাদ', 'khobor-portal' ); ?></h2>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>"><?php esc_html_e( 'আরও দেখুন', 'khobor-portal' ); ?> →</a>
				</div>
				<?php
				$latest_query = new WP_Query( array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      => 6,
					'post__not_in'        => $lead_ids,
					'ignore_sticky_posts' => true,
				) );
				?>
				<?php if ( $latest_query->have_posts() ) : ?>
					<?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
						<article class="latest-item">
							<a class="story-image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>"><?php echo wp_kses_post( khobor_portal_post_image( get_the_ID(), 'medium' ) ); ?></a>
							<div>
								<a class="story-category" href="<?php echo esc_url( khobor_portal_category_link() ); ?>"><?php echo wp_kses_post( khobor_portal_category_label() ); ?></a>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo esc_html( khobor_portal_excerpt( get_the_ID(), 18 ) ); ?></p>
								<div class="story-meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time></div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<p><?php esc_html_e( 'আরও খবর প্রকাশ হলে এখানে দেখা যাবে।', 'khobor-portal' ); ?></p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</section>

			<aside class="sidebar-column" aria-label="<?php esc_attr_e( 'জনপ্রিয় সংবাদ', 'khobor-portal' ); ?>">
				<section class="sidebar-panel">
					<div class="section-heading"><h2><?php esc_html_e( 'পাঠকপ্রিয়', 'khobor-portal' ); ?></h2></div>
					<ol class="numbered-list">
						<?php foreach ( array_slice( $lead_posts, 0, 5 ) as $post ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></li>
						<?php endforeach; ?>
					</ol>
				</section>
			</aside>
		</div>

		<?php if ( $categories ) : ?>
			<div class="category-sections">
				<?php foreach ( $categories as $category ) : ?>
					<section class="category-panel" aria-labelledby="category-<?php echo esc_attr( $category->term_id ); ?>">
						<div class="section-heading">
							<h2 id="category-<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></h2>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php esc_html_e( 'সব খবর', 'khobor-portal' ); ?> →</a>
						</div>
						<?php
						$category_id = (int) $category->term_id;
						$is_curated  = ! empty( $curated_sections[ $category_id ] );
						$category_posts = array();

						if ( $is_curated ) {
							$selected_ids = isset( $selected_sections[ $category_id ] ) && is_array( $selected_sections[ $category_id ] )
								? array_values( array_filter( array_map( 'absint', $selected_sections[ $category_id ] ) ) )
								: array();

							if ( $selected_ids ) {
								$category_query = new WP_Query( array(
									'cat'                 => $category_id,
									'post__in'            => $selected_ids,
									'orderby'             => 'post__in',
									'posts_per_page'      => count( $selected_ids ),
									'ignore_sticky_posts' => true,
								) );
								$category_posts = $category_query->posts;
							}
						} else {
							$category_query = new WP_Query( array(
								'cat'                 => $category_id,
								'posts_per_page'      => -1,
								'ignore_sticky_posts' => true,
							) );
							$category_posts = $category_query->posts;
						}
						?>
						<?php if ( $category_posts ) : ?>
							<div class="category-story-grid">
								<div class="category-column">
									<?php if ( isset( $category_posts[0] ) ) : ?>
										<?php get_template_part( 'template-parts/category-story', null, array( 'post_id' => $category_posts[0]->ID, 'variant' => 'feature' ) ); ?>
									<?php endif; ?>
									<?php foreach ( array_slice( $category_posts, 1, 2 ) as $category_post ) : ?>
										<?php get_template_part( 'template-parts/category-story', null, array( 'post_id' => $category_post->ID, 'variant' => 'compact' ) ); ?>
									<?php endforeach; ?>
								</div>
								<div class="category-column">
									<?php foreach ( array_slice( $category_posts, 3, 2 ) as $category_post ) : ?>
										<?php get_template_part( 'template-parts/category-story', null, array( 'post_id' => $category_post->ID, 'variant' => 'compact' ) ); ?>
									<?php endforeach; ?>
									<?php if ( isset( $category_posts[5] ) ) : ?>
										<?php get_template_part( 'template-parts/category-story', null, array( 'post_id' => $category_posts[5]->ID, 'variant' => 'feature' ) ); ?>
									<?php endif; ?>
								</div>
								<div class="category-column category-column--right">
									<?php foreach ( array_slice( $category_posts, 6 ) as $category_post ) : ?>
										<?php get_template_part( 'template-parts/category-story', null, array( 'post_id' => $category_post->ID, 'variant' => 'compact' ) ); ?>
									<?php endforeach; ?>
								</div>
							</div>
						<?php elseif ( $is_curated ) : ?>
							<p><?php esc_html_e( 'No posts have been selected for this section yet.', 'khobor-portal' ); ?></p>
						<?php else : ?>
							<p><?php esc_html_e( 'এই বিভাগে নতুন খবর আসছে।', 'khobor-portal' ); ?></p>
						<?php endif; ?>
					</section>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<section class="empty-state">
			<h2><?php esc_html_e( 'আপনার সংবাদপোর্টাল প্রস্তুত', 'khobor-portal' ); ?></h2>
			<p><?php esc_html_e( 'প্রথম সংবাদটি প্রকাশ করুন—আপনার খবর এখানে স্বয়ংক্রিয়ভাবে সাজানো হবে।', 'khobor-portal' ); ?></p>
		</section>
	<?php endif; ?>
</main>
<?php
wp_reset_postdata();
get_footer();
