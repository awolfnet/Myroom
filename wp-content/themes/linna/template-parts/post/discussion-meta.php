<?php
/**
 * The template for displaying Current Discussion on posts
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

/* Get data from current discussion on post. */
$discussion    = linna_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %1(X comments)$s */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses, 'linna' ), $discussion->responses );
} else {
	$meta_label = __( 'No comments', 'linna' );
}
?>

<div class="discussion-meta">
	<?php
	if ( $has_responses ) {
		linna_discussion_avatars_list( $discussion->authors );
	}
	?>
	<p class="discussion-meta-info">
		<?php echo wp_kses( linna_get_icon_svg( 'comment', 24 ), linna_get_kses_extended_ruleset() ); ?>
		<span><?php echo esc_html( $meta_label ); ?></span>
	</p>
</div><!-- .discussion-meta -->
