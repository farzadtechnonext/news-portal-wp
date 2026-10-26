<?php
/**
 * Theme setup and shared presentation helpers.
 *
 * @package Khobor_Portal
 */

function khobor_portal_setup() {
	load_theme_textdomain( 'khobor-portal', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary navigation', 'khobor-portal' ),
	) );
}
add_action( 'after_setup_theme', 'khobor_portal_setup' );

function khobor_portal_enqueue_styles() {
	$style_path = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style(
		'khobor-portal-style',
		get_stylesheet_uri(),
		array(),
		file_exists( $style_path ) ? (string) filemtime( $style_path ) : '1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'khobor_portal_enqueue_styles' );

function khobor_portal_register_homepage_sections_setting() {
	register_setting(
		'khobor_portal_homepage_sections_group',
		'khobor_portal_homepage_sections',
		array(
			'type'              => 'array',
			'default'           => array(),
			'sanitize_callback' => 'khobor_portal_sanitize_homepage_sections',
		)
	);
}
add_action( 'admin_init', 'khobor_portal_register_homepage_sections_setting' );

function khobor_portal_sanitize_homepage_sections( $input ) {
	if ( ! is_array( $input ) ) {
		return array();
	}

	$sanitized = array(
		'curated' => array(),
		'posts'   => array(),
	);
	$curated_input = isset( $input['curated'] ) && is_array( $input['curated'] ) ? $input['curated'] : array();
	$posts_input   = isset( $input['posts'] ) && is_array( $input['posts'] ) ? $input['posts'] : array();
	$categories = get_categories( array(
		'hide_empty' => false,
		'number'     => 0,
	) );

	foreach ( $categories as $category ) {
		$category_id = (int) $category->term_id;

		if ( empty( $curated_input[ $category_id ] ) ) {
			continue;
		}

		$sanitized['curated'][ $category_id ] = 1;
		$requested_ids = isset( $posts_input[ $category_id ] ) && is_array( $posts_input[ $category_id ] )
			? array_values( array_unique( array_filter( array_map( 'absint', $posts_input[ $category_id ] ) ) ) )
			: array();

		if ( ! $requested_ids ) {
			$sanitized['posts'][ $category_id ] = array();
			continue;
		}

		$valid_ids = get_posts( array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => count( $requested_ids ),
			'numberposts'    => count( $requested_ids ),
			'post__in'       => $requested_ids,
			'orderby'        => 'post__in',
			'cat'            => $category_id,
			'fields'         => 'ids',
		) );

		$sanitized['posts'][ $category_id ] = array_values( array_intersect( $requested_ids, array_map( 'absint', $valid_ids ) ) );
	}

	return $sanitized;
}

function khobor_portal_add_homepage_sections_page() {
	add_theme_page(
		__( 'Homepage Sections', 'khobor-portal' ),
		__( 'Homepage Sections', 'khobor-portal' ),
		'edit_theme_options',
		'khobor-portal-homepage-sections',
		'khobor_portal_render_homepage_sections_page'
	);
}
add_action( 'admin_menu', 'khobor_portal_add_homepage_sections_page' );

function khobor_portal_render_homepage_sections_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$categories = get_categories( array(
		'hide_empty' => false,
		'number'     => 0,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );
	$settings = get_option( 'khobor_portal_homepage_sections', array() );
	$curated  = isset( $settings['curated'] ) && is_array( $settings['curated'] ) ? $settings['curated'] : array();
	$selected = isset( $settings['posts'] ) && is_array( $settings['posts'] ) ? $settings['posts'] : array();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Homepage Sections', 'khobor-portal' ); ?></h1>
		<p><?php esc_html_e( 'Choose which published posts appear in each category section. Sections not enabled below will continue to show all posts in that category automatically.', 'khobor-portal' ); ?></p>
		<?php settings_errors(); ?>
		<form action="options.php" method="post">
			<?php settings_fields( 'khobor_portal_homepage_sections_group' ); ?>
			<?php foreach ( $categories as $category ) : ?>
				<?php
				$category_id  = (int) $category->term_id;
				$category_posts = get_posts( array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'cat'            => $category_id,
				) );
				$selected_ids = isset( $selected[ $category_id ] ) && is_array( $selected[ $category_id ] )
					? array_map( 'absint', $selected[ $category_id ] )
					: array();
				?>
				<div class="card" style="max-width: 900px; padding: 16px 20px; margin: 16px 0;">
					<h2 style="margin-top: 0;"><?php echo esc_html( $category->name ); ?></h2>
					<p>
						<label>
							<input
								type="checkbox"
								name="khobor_portal_homepage_sections[curated][<?php echo esc_attr( $category_id ); ?>]"
								value="1"
								<?php checked( ! empty( $curated[ $category_id ] ) ); ?>
							>
							<?php esc_html_e( 'Show only the posts selected below for this section', 'khobor-portal' ); ?>
						</label>
					</p>
					<?php if ( $category_posts ) : ?>
						<label for="homepage-section-posts-<?php echo esc_attr( $category_id ); ?>">
							<strong><?php esc_html_e( 'Select posts (use Ctrl or Command to select multiple):', 'khobor-portal' ); ?></strong>
						</label><br>
						<select
							id="homepage-section-posts-<?php echo esc_attr( $category_id ); ?>"
							name="khobor_portal_homepage_sections[posts][<?php echo esc_attr( $category_id ); ?>][]"
							multiple
							size="<?php echo esc_attr( min( 10, max( 4, count( $category_posts ) ) ) ); ?>"
							style="width: 100%; max-width: 700px; margin-top: 8px;"
						>
							<?php foreach ( $category_posts as $category_post ) : ?>
								<option value="<?php echo esc_attr( $category_post->ID ); ?>" <?php selected( in_array( (int) $category_post->ID, $selected_ids, true ) ); ?>>
									<?php echo esc_html( get_the_title( $category_post ) ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					<?php else : ?>
						<p><?php esc_html_e( 'There are no published posts in this category yet.', 'khobor-portal' ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
			<?php submit_button( __( 'Save Homepage Sections', 'khobor-portal' ) ); ?>
		</form>
	</div>
	<?php
}

function khobor_portal_get_categories() {
	$categories = get_categories( array(
		'hide_empty' => true,
		'number'     => 0,
		'orderby'    => 'count',
		'order'      => 'DESC',
	) );

	return is_array( $categories ) ? $categories : array();
}

function khobor_portal_category_label( $post_id = 0 ) {
	$categories = get_the_category( $post_id );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		return esc_html( $categories[0]->name );
	}

	return esc_html__( 'সর্বশেষ', 'khobor-portal' );
}

function khobor_portal_category_link( $post_id = 0 ) {
	$categories = get_the_category( $post_id );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		return get_category_link( $categories[0]->term_id );
	}

	return home_url( '/' );
}

function khobor_portal_post_image( $post_id = 0, $size = 'medium_large' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size, array( 'loading' => 'lazy' ) );
	}

	return '';
}

function khobor_portal_excerpt( $post_id = 0, $length = 24 ) {
	$text = get_the_excerpt( $post_id );

	if ( '' === trim( $text ) ) {
		return '';
	}

	return wp_trim_words( $text, $length, '…' );
}
