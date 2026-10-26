<?php
/**
 * Site footer.
 *
 * @package Khobor_Portal
 */
?>
<footer class="site-footer">
	<div class="site-shell footer-inner">
		<div>
			<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<p class="footer-note"><?php esc_html_e( 'সত্য ও নির্ভরযোগ্য সংবাদ সবার আগে।', 'khobor-portal' ); ?></p>
		</div>
		<div class="footer-note">
			<?php
			printf(
				/* translators: %s: current year */
				esc_html__( '© %s সর্বস্বত্ব সংরক্ষিত', 'khobor-portal' ),
				esc_html( wp_date( 'Y' ) )
			);
			?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
