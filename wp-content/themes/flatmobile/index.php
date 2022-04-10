<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage FlatMobile
 * @since FlatMobile 1.0
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

				if ( is_home() && ! is_front_page() ) :
					//single_post_title();
				endif;

				// Start the loop.
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
				?><div class="tc-pagination"><?php
				the_posts_pagination( array(
						'prev_text'          => '<i class="prev uiicon-left427"></i>',
						'next_text'          => '<i class="next uiicon-left413"></i>'
				) );
				?></div><?php
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