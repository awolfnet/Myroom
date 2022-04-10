<article id="page-<?php the_ID(); ?>" <?php post_class('content-inner'); ?>>

	<?php if( flatmobile::meta( 'flatmobile_page_title_hidden' ) != 'hidden' ): ?>
		<?php the_title('<h1 class="h2">','</h1>'); ?>
	<?php endif; ?>

	<?php the_content(); ?>
	<?php
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'flatmobile' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'flatmobile' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) );
	?>

	<?php edit_post_link( esc_html__( 'Edit', 'flatmobile' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>
</article><!-- #post-## -->