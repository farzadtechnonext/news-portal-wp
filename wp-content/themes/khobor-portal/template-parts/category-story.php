<?php
/**
 * Story card used in the homepage category layout.
 *
 * @package Khobor_Portal
 */
$post_id = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : 0;
$variant = isset( $args['variant'] ) && 'feature' === $args['variant'] ? 'feature' : 'compact';

if ( ! $post_id ) {
	return;
}
?>
<article class="category-story category-story--<?php echo esc_attr( $variant ); ?>">
	<?php if ( 'feature' === $variant ) : ?>
		<h3><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h3>
		<a class="story-image" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"><?php echo wp_kses_post( khobor_portal_post_image( $post_id, 'large' ) ); ?></a>
	<?php else : ?>
		<a class="story-image" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"><?php echo wp_kses_post( khobor_portal_post_image( $post_id, 'medium' ) ); ?></a>
		<h3><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h3>
	<?php endif; ?>
</article>
