<?php
/**
 * Displays header
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */
?>
<div class="site-row">

	<?php if ( linna_option( 'sidebar-position', 'side="left"' ) !== 'disabled' ) : ?>
		<button type="button" class="site-col-auto site-sidebar-opener site-sidebar-toggle site-header-icon-container">
			<?php echo wp_kses( linna_get_icon_svg( 'menu', 14.56, 17 ), linna_get_kses_extended_ruleset() ); ?>
		</button>

	<?php endif; ?>

	<?php if ( linna_option( 'header-logo-type', 'text' ) === 'text' ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-col site-align-self-center site-logo <?php echo esc_attr( linna_option( 'header-logo-position' ) ); ?>">
			<span class="d-flex site-align-self-center site-logo-text"><?php echo esc_html( linna_option( 'header-logo-text', get_bloginfo( 'name' ) ) ); ?></span>
		</a>
	<?php else : ?>

		<?php $logo = linna_option( array( 'header-logo', 'url' ), 'https://img.mobius.studio/themes/pinna/LTR/assets/img/logo@2x.png' ); ?>

		<?php if ( ! empty( $logo ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-col site-align-self-center site-logo <?php echo esc_attr( linna_option( 'header-logo-position' ) ); ?>">
				<img class="d-flex site-align-self-center" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			</a>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( class_exists( 'woocommerce' ) ) : ?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'linna' ); ?>" class="site-col-auto site-header-icon-container site-woocommerce-header-count">
			<?php echo wp_kses( linna_get_icon_svg( 'shopping-cart', 20, 20 ), linna_get_kses_extended_ruleset() ); ?>
			<span><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
	<?php endif; ?>

<!--	<a href="#" class="site-col-auto site-header-icon-container">--><?php //echo wp_kses( linna_get_icon_svg( 'envelope', 18, 18 ), linna_get_kses_extended_ruleset() ); ?><!--</a>-->

	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) :
		?>
		<!--<p class="site-description">
				<?php echo esc_html( $description ); ?>
			</p>-->
	<?php endif; ?>

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<!-- <nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'linna' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links-menu',
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>' . linna_get_icon_svg( 'link' ),
					'depth'          => 1,
				)
			);
			?>
		</nav>.social-navigation -->
	<?php endif; ?>
</div>
