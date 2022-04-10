<div class="ms-card">
	<div class="content-inner">
		<article id="post-<?php the_ID(); ?>" <?php post_class('tc-blog-item clearfix'); ?>>
			<?php flatmobile::postThumbnail()?>

			<header class="entry-header">
				<?php if ( is_single() ) :
					the_title( '<h1 class="entry-title title">', '</h1>' );
				else :
					the_title( sprintf( '<a href="%s" rel="bookmark" class="title"><h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2></a>' );
				endif; ?>
				<small class="subtitle">
					<span><?php esc_html_e('Posted', 'flatmobile') ?></span>
					<?php flatmobile::getPostDate() ?>
					<?php flatmobile::getPostAuthor() ?>
					<?php flatmobile::getPostCategories() ?>
					<?php flatmobile::getPostTags() ?>
				</small>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				/* translators: %s: Name of current post */
				if( !is_single() && $post->post_excerpt ){
					the_excerpt();
				}else{
					the_content( sprintf(
							esc_html__( 'Continue reading %s', 'flatmobile' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
					) );
				}

				wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'flatmobile' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'flatmobile' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			</div><!-- .entry-content -->

			<?php if ( !is_single() ) : ?>
				<div class="text-right">
					<a href="<?php the_permalink() ?>"><?php esc_html_e( 'Go to Post', 'flatmobile' ) ?> <i class="uiicon-arrow413"></i></a>
				</div>
			<?php endif; ?>

			<?php
			// Author bio.
			if ( is_single() && get_the_author_meta( 'description' ) ) :
				get_template_part( 'author-bio' );
			endif;
			?>

			<footer class="entry-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'flatmobile' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->

		</article><!-- #post-## -->
	</div>
</div>