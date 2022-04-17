<?php
/**
 * Custom comment walker for this theme
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

/**
 * This class outputs custom comment walker for HTML5 friendly WordPress comment and threaded replies.
 *
 * @since 1.0.0
 */
class Linna_Walker_Comment extends Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth Depth of the current comment.
	 * @param array      $args An array of arguments.
	 *
	 * @see wp_list_comments()
	 */
	protected function html5_comment( $comment, $depth, $args ) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		?>
		<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					$comment_author_url = get_comment_author_url( $comment );
					$comment_author     = get_comment_author( $comment );
					$avatar             = get_avatar( $comment, $args['avatar_size'] );
					if ( 0 !== $args['avatar_size'] ) {
						if ( empty( $comment_author_url ) ) {
							echo wp_kses( $avatar, linna_get_kses_extended_ruleset() );
						} else {
							printf( '<a href="%s" rel="external nofollow" class="url">', esc_url( $comment_author_url ) );
							echo wp_kses( $avatar, linna_get_kses_extended_ruleset() );
						}
					}

					/*
					 * Using the `check` icon instead of `check_circle`, since we can't add a
					 * fill color to the inner check shape when in circle form.
					 */
					if ( linna_is_comment_by_post_author( $comment ) ) {
						printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', wp_kses( linna_get_icon_svg( 'check', 24 ), linna_get_kses_extended_ruleset() ) );
					}

					/*
					 * Using the `check` icon instead of `check_circle`, since we can't add a
					 * fill color to the inner check shape when in circle form.
					 */
					if ( linna_is_comment_by_post_author( $comment ) ) {
						printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', wp_kses( linna_get_icon_svg( 'check', 24 ), linna_get_kses_extended_ruleset() ) );
					}

					printf(
						wp_kses(
							/* translators: %s: comment author link */
							__( '%s <span class="screen-reader-text says">says:</span>', 'linna' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						'<b class="fn">' . wp_kses( $comment_author, linna_get_kses_extended_ruleset() ) . '</b>'
					);

					if ( ! empty( $comment_author_url ) ) {
						echo '</a>';
					}
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
						<?php
						/* translators: 1: comment date, 2: comment time */
						$comment_timestamp = sprintf( __( '%1$s at %2$s', 'linna' ), get_comment_date( '', $comment ), get_comment_time() );
						?>
						<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo esc_attr( $comment_timestamp ); ?>">
							<?php echo esc_html( $comment_timestamp ); ?>
						</time>
					</a>
					<?php
					$edit_comment_icon = linna_get_icon_svg( 'edit', 16 );
					edit_comment_link( __( 'Edit', 'linna' ), '<span class="edit-link-sep">&mdash;</span> <span class="edit-link">' . $edit_comment_icon, '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'linna' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

		</article><!-- .comment-body -->

		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="comment-reply">',
					'after'     => '</div>',
				)
			)
		);
		?>
		<?php
	}
}
