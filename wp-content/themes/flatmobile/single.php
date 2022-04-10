<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FlatMobile
 * @since FlatMobile 1.0
 */

get_header();

$tablet_size = 100;
if( is_active_sidebar( 'flatmobile-blog-sidebar' ) ){
	$tablet_size = 66;
}
?>
<div class="row">
	<div class="col-100 tablet-<?php echo (int) $tablet_size ?>">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() ); ?>

			<div class="ms-card">
				<div class="content-inner">
					<?php // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					// Previous/next post navigation.
					?>
					<div class="clearfix"> <?php
						the_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'flatmobile' ) . '</span> ' .
								               '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'flatmobile' ) . '</span> ' .
								               '<span class="post-title">%title</span><i class="uiicon-arrow413"></i>',
								'prev_text' => '<i class="uiicon-arrow427"></i><span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'flatmobile' ) . '</span> ' .
								               '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'flatmobile' ) . '</span> ' .
								               '<span class="post-title">%title</span>',
						) ); ?>
					</div>
				</div>
			</div><?php
		endwhile; ?>
	</div><!-- .col-100.tablet-66 | ENDS -->

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
</div><!-- .row | ENDS -->
<?php get_footer(); ?>
