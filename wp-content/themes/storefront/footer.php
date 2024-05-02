<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<div class="footer-widgets">
				<div class="footer-widget-column">
					<?php
					// First footer widget area.
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
					?>
				</div><!-- .footer-widget-column -->

				<div class="footer-widget-column">
					<?php
					// Second footer widget area.
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
					?>
				</div><!-- .footer-widget-column -->

				<div class="footer-widget-column">
					<?php
					// Third footer widget area.
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
					?>
				</div><!-- .footer-widget-column -->

				<div class="footer-widget-column">
					<?php
					// Fourth footer widget area.
					if ( is_active_sidebar( 'footer-4' ) ) {
						dynamic_sidebar( 'footer-4' );
					}
					?>
				</div><!-- .footer-widget-column -->
			</div><!-- .footer-widgets -->
			<?php
			// Output the shortcode content
			echo do_shortcode("[hfe_template id='54']");
			?>
		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
