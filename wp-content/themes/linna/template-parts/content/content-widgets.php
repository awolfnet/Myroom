<?php
/**
 * Displays the footer widget area
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( is_active_sidebar( 'sidebar-1' ) && linna_option( 'blog-list-sidebar', true ) ) : ?>

	<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog', 'linna' ); ?>">
		<div class="widget-column footer-widget-1">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
