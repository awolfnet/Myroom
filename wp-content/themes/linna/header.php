<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php wp_head(); ?>
	<?php _linna_option_css_code( 'header_css' ); ?>

	<?php $ga_id = linna_option( 'google_anaytics_id' ); ?>

	<?php if ( ! empty( $ga_id ) ) : ?>
		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo esc_html( $ga_id ); ?>', 'auto');
			ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
	<?php endif; ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header site-container-fluid site-primary-bg <?php echo esc_attr( linna_option( 'header-sticky' ) ); ?>">

		<?php get_template_part( 'template-parts/header/header' ); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
