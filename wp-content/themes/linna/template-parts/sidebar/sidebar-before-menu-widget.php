<?php
/**
 * Displays the sidebar before menu widget area
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( is_active_sidebar( 'before-menu-widget-area' ) ) : ?>

	<aside class="widget-area sidebar-box" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar Before Menu Widget Area', 'linna' ); ?>">
		<?php
		if ( is_active_sidebar( 'before-menu-widget-area' ) ) {
			?>
			<div class="widget-column">
				<?php dynamic_sidebar( 'before-menu-widget-area' ); ?>
			</div>
			<?php
		}
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>
