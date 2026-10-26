<?php
/**
 * Search form.
 *
 * @package Khobor_Portal
 */
?>
<form class="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="portal-search"><?php esc_html_e( 'খুঁজুন', 'khobor-portal' ); ?></label>
	<input id="portal-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'খবর খুঁজুন…', 'khobor-portal' ); ?>">
	<button type="submit"><?php esc_html_e( 'খুঁজুন', 'khobor-portal' ); ?></button>
</form>
