<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer site-container-fluid">
	<div class="site-info site-row">
		<div class="site-col site-mb-0">
			<?php
			$footer_socials = linna_option( 'footer-socials', null );
			?>
			<?php if ( ! empty( $footer_socials ) ) : ?>
				<div class="footer-box site-text-center">
					<?php foreach ( $footer_socials as $footer_social ) : ?>
						<?php preg_match( '/data-title="([\w\d\-]+)"/', $footer_social['icon'], $data_title ); ?>
						<a href="<?php echo esc_url( $footer_social['href'] ); ?>" target="_blank" <?php echo esc_attr( $data_title[0] ); ?> class="site-social-link-ball" style="background-color: <?php echo esc_attr( $footer_social['backgroundcolor'] ); ?>; color: <?php echo esc_attr( $footer_social['color'] ); ?>;">
							<?php echo wp_kses( $footer_social['icon'], linna_get_kses_extended_ruleset() ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="site-footer-text site-mt-3">
				<?php echo esc_html( linna_option( 'footer-text', get_bloginfo( 'name' ) ) ); ?>
			</div>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->


<?php if ( linna_option( 'sidebar-position', 'side="left"' ) !== 'disabled' ) : ?>
	<aside class="site-sidebar" <?php echo esc_attr( linna_option( 'sidebar-position' ) ); ?>>
		<?php get_template_part( 'template-parts/sidebar/sidebar', 'top' ); ?>

		<button type="button" class="site-sidebar-toggle"><?php echo wp_kses( linna_get_icon_svg( 'caret-left', 16, 16 ), linna_get_kses_extended_ruleset() ); ?></button>

		<?php get_template_part( 'template-parts/sidebar/sidebar', 'before-menu-widget' ); ?>

		<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Sidebar Menu', 'linna' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_class'     => 'main-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</nav> <!--#site-navigation -->
		<?php endif; ?>

		<div class="site-divider"></div>

		<?php get_template_part( 'template-parts/sidebar/sidebar', 'after-menu-widget' ); ?>

		<?php
		$sidebar_socials = linna_option( 'sidebar-socials', null );
		?>
		<?php if ( ! empty( $sidebar_socials ) ) : ?>
			<div class="sidebar-box">
				<?php foreach ( $sidebar_socials as $sidebar_social ) : ?>
					<?php preg_match( '/data-title="([\w\d\-]+)"/', $sidebar_social['icon'], $data_title ); ?>
					<a href="<?php echo esc_url( $sidebar_social['href'] ); ?>" target="_blank" <?php echo esc_attr( $data_title[0] ); ?> class="site-social-link-ball" style="background-color: <?php echo esc_attr( $sidebar_social['backgroundcolor'] ); ?>; color: <?php echo esc_attr( $sidebar_social['color'] ); ?>;">
						<?php echo wp_kses( $sidebar_social['icon'], linna_get_kses_extended_ruleset() ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</aside>
	<div class="site-sidebar-tint site-sidebar-toggle"></div>
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
