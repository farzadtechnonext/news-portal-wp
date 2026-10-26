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
