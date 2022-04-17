<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

$discussion = linna_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
	<div class="<?php echo $discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
		<h2 class="comments-title">
			<?php
			if ( comments_open() ) {
				if ( have_comments() ) {
					esc_html_e( 'Join the Conversation', 'linna' );
				} else {
					esc_html_e( 'Leave a comment', 'linna' );
				}
			} else {
				if ( '1' === $discussion->responses ) {
					/* translators: %s: post title */
					printf( esc_html_x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'linna' ), esc_html( get_the_title() ) );
				} else {
					printf(
						esc_html(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'%1$s reply on &ldquo;%2$s&rdquo;',
								'%1$s replies on &ldquo;%2$s&rdquo;',
								$discussion->responses,
								'comments title',
								'linna'
							)
						),
						esc_html( number_format_i18n( $discussion->responses ) ),
						esc_html( get_the_title() )
					);
				}
			}
			?>
		</h2><!-- .comments-title -->
		<?php
		// Only show discussion meta information when comments are open and available.
		if ( have_comments() && comments_open() ) {
			get_template_part( 'template-parts/post/discussion', 'meta' );
		}
		?>
	</div><!-- .comments-title-flex -->
	<?php
	if ( have_comments() ) :

		// Show comment form at top if showing newest comments at the top.
		if ( comments_open() ) {
			linna_comment_form( 'desc' );
		}

		?>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'walker'      => new Linna_Walker_Comment(),
					'avatar_size' => linna_get_avatar_size(),
					'short_ping'  => true,
					'style'       => 'ol',
				)
			);
			?>
		</ol><!-- .comment-list -->
		<?php

		// Show comment navigation.
		if ( have_comments() ) :
			$prev_icon     = linna_get_icon_svg( 'chevron_left', 22 );
			$next_icon     = linna_get_icon_svg( 'chevron_right', 22 );
			$comments_text = __( 'Comments', 'linna' );
			the_comments_navigation(
				array(
					'prev_text' => sprintf(
						'%s <span class="nav-prev-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span>',
						$prev_icon,
						__( 'Previous', 'linna' ),
						__( 'Comments', 'linna' )
					),
					'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span> %s', __( 'Next', 'linna' ), __( 'Comments', 'linna' ), $next_icon ),
				)
			);
		endif;

		// Show comment form at bottom if showing newest comments at the bottom.
		if ( comments_open() && 'asc' === strtolower( get_option( 'comment_order', 'asc' ) ) ) :
			?>
			<div class="comment-form-flex">
				<span class="screen-reader-text"><?php esc_html_e( 'Leave a comment', 'linna' ); ?></span>
				<?php linna_comment_form( 'asc' ); ?>
				<h2 class="comments-title" aria-hidden="true"><?php esc_html_e( 'Leave a comment', 'linna' ); ?></h2>
			</div>
			<?php
		endif;

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'linna' ); ?>
			</p>
			<?php
		endif;

		else :

			// Show comment form.
			linna_comment_form( true );

	endif; // if have comments.
		?>
</div><!-- #comments -->
