<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

if ( ! function_exists( 'linna_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function linna_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			wp_kses( linna_get_icon_svg( 'watch', 16 ), linna_get_kses_extended_ruleset() ),
			esc_url( get_permalink() ),
			wp_kses( $time_string, linna_get_kses_extended_ruleset() )
		);
	}
endif;

if ( ! function_exists( 'linna_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function linna_posted_by() {
		printf(
			/* translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link. */
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			wp_kses( linna_get_icon_svg( 'person', 16 ), linna_get_kses_extended_ruleset() ),
			esc_html__( 'Posted by', 'linna' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'linna_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function linna_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo wp_kses( linna_get_icon_svg( 'comment', 16 ), linna_get_kses_extended_ruleset() );

			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'linna' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'linna_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function linna_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by.
			linna_posted_by();

			// Posted on.
			linna_posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'linna' ) );
			if ( $categories_list ) {
				printf(
					/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
					'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
					wp_kses( linna_get_icon_svg( 'archive', 16 ), linna_get_kses_extended_ruleset() ),
					esc_html__( 'Posted in', 'linna' ),
					wp_kses( $categories_list, linna_get_kses_extended_ruleset() )
				);
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'linna' ) );
			if ( $tags_list ) {
				printf(
					/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
					'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
					wp_kses( linna_get_icon_svg( 'tag', 16 ), linna_get_kses_extended_ruleset() ),
					esc_html__( 'Tags:', 'linna' ),
					wp_kses( $tags_list, linna_get_kses_extended_ruleset() )
				);
			}

			if ( ! is_singular() && empty( get_the_title() ) ) {
				printf(
					/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
					'<span class="read-more-meta-link">%1$s<a href="%2$s">%3$s</a></span>',
					wp_kses( linna_get_icon_svg( 'link', 16 ), linna_get_kses_extended_ruleset() ),
					esc_url( get_the_permalink() ),
					esc_html__( 'Read More', 'linna' )
				);
			}
		}

		// Comment count.
		if ( ! is_singular() ) {
			linna_comment_count();
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'linna' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . linna_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'linna_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function linna_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'linna' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

if ( ! function_exists( 'linna_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function linna_post_thumbnail() {
		if ( ! linna_can_show_post_thumbnail() ) {
			return;
		}

		if ( get_the_post_thumbnail() ) :
			if ( is_singular() ) :
				?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<?php
			else :
				?>

				<a class="post-thumbnail option-position-<?php echo esc_attr( linna_option( 'blog-list-preview-position', 'top' ) ); ?>" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
				</a>

				<?php
			endif;
		endif;
	}
endif;

if ( ! function_exists( 'linna_get_user_avatar_markup' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 *
	 * @param null|string|int $id_or_email Id or email of a user.
	 */
	function linna_get_user_avatar_markup( $id_or_email = null ) {

		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="comment-user-avatar comment-author vcard">%s</div>', get_avatar( $id_or_email, linna_get_avatar_size() ) );
	}
endif;

if ( ! function_exists( 'linna_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 *
	 * @param null|array $comment_authors Array of id or email of comment authors' .
	 */
	function linna_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<ol class="discussion-avatar-list">', "\n";
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<li>%s</li>\n",
				wp_kses( linna_get_user_avatar_markup( $id_or_email ), linna_get_kses_extended_ruleset() )
			);
		}
		echo '</ol><!-- .discussion-avatar-list -->', "\n";
	}
endif;

if ( ! function_exists( 'linna_comment_form' ) ) :
	/**
	 * Comment form.
	 *
	 * @param bool|string $order Comment order as boolean, asc or desc.
	 */
	function linna_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {

			comment_form(
				array(
					'logged_in_as' => null,
					'title_reply'  => null,
				)
			);
		}
	}
endif;

if ( ! function_exists( 'linna_the_posts_navigation' ) ) :
	/**
	 * Posts navigation.
	 */
	function linna_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf(
					'%s',
					linna_get_icon_svg( 'chevron-left', 10 )
				),
				'next_text' => sprintf(
					'%s',
					linna_get_icon_svg( 'chevron-right', 10 )
				),
			)
		);
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Linna 1.4
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Linna 1.4
		 */
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'linna_excerpt_length' ) ) :
	/**
	 * Filter the "excerpt length" with the character count set on option panel with default 55 characters.
	 *
	 * @param int $length Character length.
	 */
	function linna_excerpt_length( $length ) {
		return linna_option( 'blog-list-excerpt-length', $length );
	}

	add_filter( 'excerpt_length', 'linna_excerpt_length', 999 );
endif;

if ( ! function_exists( 'linna_excerpt_more' ) ) :
	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 *
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	function linna_excerpt_more( $more ) {
		if ( ! is_single() ) {
			$more = sprintf(
				'%3$s<a class="read-more" href="%1$s">%2$s ' . linna_get_icon_svg( 'chevron-right', 8, 8 ) . '</a>',
				get_permalink( get_the_ID() ),
				__( 'Read More', 'linna' ),
				'...'
			);
		}

		return $more;
	}

	add_filter( 'excerpt_more', 'linna_excerpt_more', 999 );
endif;

if ( ! function_exists( 'linna_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function linna_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'linna' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
