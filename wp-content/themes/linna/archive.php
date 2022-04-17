<?php
/**
 * The template for displaying archive pages
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

						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								?>
							</header><!-- .page-header -->

							<?php
							// Start the Loop.
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content/content', 'excerpt' );

								// End the loop.
							endwhile;

							// Previous/next page navigation.
							linna_the_posts_navigation();

							// If no content, include the "No posts found" template.
							else :
								get_template_part( 'template-parts/content/content', 'none' );

						endif;
							?>
					</main><!-- #main -->
				</section><!-- #primary -->
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
