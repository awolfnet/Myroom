<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage FlatMobile
 * @since FlatMobile 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="tc-blog-sidebar-box">
	<?php comment_form(); ?>
</div><!-- .tc-blog-sidebar-box | ENDS -->

<div class="tc-divider dark"></div>

<div id="comments" class="comments-area tc-blog-sidebar-box">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'flatmobile' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h3>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 40,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php next_comments_link(); ?>
		<?php previous_comments_link(); ?>

		<?php wp_enqueue_script( "comment-reply" ); ?>
	<?php endif; // have_comments() ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'flatmobile' ); ?></p>
	<?php endif; ?>
</div><!-- .comments-area -->
