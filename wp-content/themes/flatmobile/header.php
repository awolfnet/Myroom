<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "page-content" div.
 *
 * @package WordPress
 * @subpackage FlatMobile
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<?php $body_bg_image = ''; if( '' != flatmobile::option( 'flatmobile_layout_coloring', 'flatmobile_body_image' ) ): ?>
	<?php $body_bg_image = 'background-image: url('.flatmobile::option( 'flatmobile_layout_coloring', 'flatmobile_body_image' ).');'; ?>
<?php endif; ?>
<body <?php body_class(flatmobile::option('flatmobile_mspanels', 'flatmobile_panels_type','ms-panels-blur')); ?> style="<?php echo esc_attr($body_bg_image) ?>">
<?php wp_body_open(); ?>
<?php if( 'on' == flatmobile::option('flatmobile_loading_screen', 'flatmobile_ls_switch', 'on') ): ?>
	<div class="ms-page-loading <?php if( 'on' == flatmobile::option('flatmobile_loading_screen', 'flatmobile_ls_show', 'off') ) echo 'show-always' ?>">
		<?php if( '' != flatmobile::option('flatmobile_logo','flatmobile_url', '') ): ?>
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="tc-logo"><img src="<?php echo esc_url( flatmobile::option('flatmobile_logo','flatmobile_url','') ) ?>" alt="<?php bloginfo() ?>" /></a>
		<?php endif; ?>
		<div>
			<?php switch( flatmobile::option('flatmobile_loading_screen', 'flatmobile_ls_type', 'twelve') ){
				case 'one': ?>
					<div class="ms-loading-1"></div>
					<?php break; ?>
				<?php case 'two': ?>
					<div class="ms-loading-2">
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>
					<?php break; ?>
				<?php case 'three': ?>
					<div class="ms-loading-3">
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>
					<?php break; ?>
				<?php case 'four': ?>
					<div class="ms-loading-4">
						<div class="cube1"></div>
						<div class="cube2"></div>
					</div>
					<?php break; ?>
				<?php case 'five': ?>
					<div class="ms-loading-5"></div>
					<?php break; ?>
				<?php case 'six': ?>
					<div class="ms-loading-6">
						<div class="dot1"></div>
						<div class="dot2"></div>
					</div>
					<?php break; ?>
				<?php case 'seven': ?>
					<div class="ms-loading-7">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
					<?php break; ?>
				<?php case 'eight': ?>
					<div class="ms-loading-8">
						<div class="sk-circle1 sk-child"></div>
						<div class="sk-circle2 sk-child"></div>
						<div class="sk-circle3 sk-child"></div>
						<div class="sk-circle4 sk-child"></div>
						<div class="sk-circle5 sk-child"></div>
						<div class="sk-circle6 sk-child"></div>
						<div class="sk-circle7 sk-child"></div>
						<div class="sk-circle8 sk-child"></div>
						<div class="sk-circle9 sk-child"></div>
						<div class="sk-circle10 sk-child"></div>
						<div class="sk-circle11 sk-child"></div>
						<div class="sk-circle12 sk-child"></div>
					</div>
					<?php break; ?>
				<?php case 'nine': ?>
					<div class="ms-loading-9">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
					<?php break; ?>
				<?php case 'ten': ?>
					<div class="ms-loading-10">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>
					<?php break; ?>
				<?php case 'eleven': ?>
					<div class="ms-loading-11">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>
					<?php break; ?>
				<?php case 'twelve': ?>
					<div class="ms-loading-12">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
					<?php break; ?>
				<?php } ?>
		</div>
		<div class="sub-text"><?php echo flatmobile::option('flatmobile_loading_screen', 'flatmobile_bottom_text', 'Loading, Please Wait...'); ?></div>
	</div>
<?php endif; ?>
<aside class="ms-panel position-left">
	<div class="inner">
		<div class="content-inner">
			<?php if( '' != flatmobile::option('flatmobile_logo','flatmobile_url', '') ): ?>
				<a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="tc-logo"><img src="<?php echo esc_url( flatmobile::option('flatmobile_logo','flatmobile_url','') ) ?>" alt="<?php bloginfo() ?>" /></a>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'flatmobile-before-menu' ) ) : ?>
				<?php dynamic_sidebar( 'flatmobile-before-menu' ); ?>
			<?php endif; ?>

			<?php
			$args = array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu-list',
					'fallback_cb'     => false,
			);
			wp_nav_menu( $args ); ?>

			<?php if ( is_active_sidebar( 'flatmobile-after-menu' ) ) : ?>
				<?php dynamic_sidebar( 'flatmobile-after-menu' ); ?>
			<?php endif; ?>
		</div>
	</div>
</aside>

<main class="tc-page">
	<header class="navbar <?php echo flatmobile::meta( 'flatmobile_navbar_style' ); ?>">
		<a href="#" data-panel="left" class="icon-only uiicon-bullet4 pull-left"></a>
		<?php if( '' != flatmobile::option('flatmobile_logo','flatmobile_url', '') ): ?>
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="tc-logo"><img src="<?php echo esc_url( flatmobile::option('flatmobile_logo','flatmobile_url','') ) ?>" alt="<?php bloginfo() ?>" /></a>
		<?php endif; ?>
		<a href="#" data-panel="right" class="icon-only uiicon-menu19 pull-right"></a>

		<?php if( class_exists('woocommerce') ): ?>
			<a href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flatmobile' ); ?>" class="icon-only header-shop-icon pull-right"><i class="uiicon-shopping58"></i><span><?php echo WC()->cart->cart_contents_count ?></span></a>
		<?php endif; ?>

	</header>
	<!--<div class="toolbar"></div>-->
	<div class="inner">
