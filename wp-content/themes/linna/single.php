<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content/content', 'single' );

							if ( is_singular( 'attachment' ) ) {
								// Parent post navigation.
								the_post_navigation(
									array(
										'prev_text' => sprintf(
											/* translators: %s: parent post link */
											__(
												'<span class="meta-nav">Published in</span><span class="post-title">%s</span>',
												'linna'
											),
											'%title'
										),
									)
								);
							} elseif ( is_singular( 'post' ) ) {
								// Previous/next post navigation.
								the_post_navigation(
									[
										'next_text' => sprintf(
											'<span class="meta-nav" aria-hidden="true">%s</span> <span class="screen-reader-text">%s</span><span class="post-title">%%title</span>',
											__(
												'Next Post',
												'linna'
											),
											__(
												'Next post:',
												'linna'
											)
										),
										'prev_text' => sprintf(
											'<span class="meta-nav" aria-hidden="true">%s</span> <span class="screen-reader-text">%s</span><span class="post-title">%%title</span>',
											__(
												'Previous Post',
												'linna'
											),
											__(
												'Previous post:',
												'linna'
											)
										),
									]
								);
							}

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

						endwhile; // End of the loop.
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
