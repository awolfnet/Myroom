<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Flatmobile
 * @since Flatmobile 1.0
 */

get_header();

$tablet_size = 100;
if( is_active_sidebar( 'flatmobile-blog-sidebar' ) ){
	$tablet_size = 66;
} ?>
	<div class="row">
		<div class="col-100 tablet-<?php echo (int) $tablet_size ?>">
			<?php
			if ( have_posts() ) :

				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );

				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'flatmobile' ),
						'next_text'          => esc_html__( 'Next page', 'flatmobile' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'flatmobile' ) . ' </span>',
				) );

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );
			endif; ?>
		</div>
		<?php if ( is_active_sidebar( 'flatmobile-blog-sidebar' ) ) : ?>
			<div class="col-100 tablet-33">
				<div class="ms-card">
					<div class="content-inner">
						<div id="widget-area" class="widget-area" role="complementary">
							<?php dynamic_sidebar( 'flatmobile-blog-sidebar' ); ?>
						</div><!-- .widget-area -->
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer();