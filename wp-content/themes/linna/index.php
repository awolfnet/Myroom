<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

get_header();
?>
	<div class="site-container-fluid site-mt-15px">
		<div class="site-row">

			<?php
			if (
				is_active_sidebar( 'sidebar-1' ) &&
				linna_option( 'blog-list-sidebar', true ) &&
				linna_option( 'blog-list-sidebar-position', 'right' ) === 'left'
			) :
				?>
				<div class="site-col-sm-<?php echo esc_attr( linna_option( 'blog-list-sidebar-size', 3 ) ); ?>">
					<?php get_template_part( 'template-parts/content/content', 'widgets' ); ?>
				</div>
			<?php endif; ?>

			<?php
			$blog_area_column_size = 12;
			if (
				is_active_sidebar( 'sidebar-1' ) &&
				linna_option( 'blog-list-sidebar', true )
			) {
				$blog_area_column_size -= linna_option( 'blog-list-sidebar-size', 3 );
			}
			?>
			<div class="site-col-sm-<?php echo esc_attr( $blog_area_column_size ); ?>">
				<section id="primary" class="content-area">
					<main id="main" class="site-main">

						<?php
						if ( have_posts() ) {

							$opt__blog_list_columns = linna_option( 'blog-list-columns', '12' );
							if ( '12' !== $opt__blog_list_columns ) {
								echo '<div class="site-row">';
							}

							// Load posts loop.
							while ( have_posts() ) {
								the_post();

								get_template_part( 'template-parts/content/content', get_post_format() );
							}

							if ( '12' !== $opt__blog_list_columns ) {
								echo '</div>';
							}

							// Previous/next page navigation.
							linna_the_posts_navigation();

						} else {

							// If no content, include the "No posts found" template.
							get_template_part( 'template-parts/content/content', 'none' );

						}
						?>

					</main><!-- .site-main -->
				</section><!-- .content-area -->
			</div>

			<?php
			if (
				is_active_sidebar( 'sidebar-1' ) &&
				linna_option( 'blog-list-sidebar', true ) &&
				linna_option( 'blog-list-sidebar-position', 'right' ) === 'right'
			) :
				?>
				<div class="site-col-sm-<?php _linna_option( 'blog-list-sidebar-size', '3' ); ?>">
					<?php get_template_part( 'template-parts/content/content', 'widgets' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
get_footer();
