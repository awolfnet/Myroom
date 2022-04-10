<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FlatMobile
 * @since FlatMobile 1.0
 */

get_header(); ?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();

	// Include the page content template.
	echo '<div class="ms-card">';
		get_template_part( 'content', 'page' );
	echo '</div>';

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		echo '<div class="ms-card">';
			echo '<div class="content-inner">';
				comments_template();
			echo '</div>';
		echo '</div>';
	endif;

	// End the loop.
endwhile;
?>
<?php get_footer(); ?>
