<?php
/**
 * Displays the sidebar after menu widget area
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( is_active_sidebar( 'after-menu-widget-area' ) ) : ?>

	<aside class="widget-area sidebar-box" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar After Menu Widget Area', 'linna' ); ?>">
		<?php
		if ( is_active_sidebar( 'after-menu-widget-area' ) ) {
			?>
			<div class="widget-column">
				<?php dynamic_sidebar( 'after-menu-widget-area' ); ?>
			</div>
			<?php
		}
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>
