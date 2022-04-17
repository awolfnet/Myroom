<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

get_header();
?>
	<section id="primary" class="site-container-fluid">
		<main id="main" class="site-row">
			<div class="site-col">
				<div class="site-404">
					<?php if ( linna_option( 'page-not-found-first-line-status', true ) ) : ?>
						<div><h1><?php esc_html_e( '4o4', 'linna' ); ?></h1></div>
					<?php endif; ?>

					<?php if ( linna_option( 'page-not-found-second-line-status', true ) ) : ?>
						<div><span><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'linna' ); ?></span></div>
					<?php endif; ?>

					<?php if ( linna_option( 'page-not-found-third-line-status', true ) ) : ?>
						<div>
							<article><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'linna' ); ?></article>
						</div>
					<?php endif; ?>

					<?php if ( linna_option( 'page-not-found-search', true ) ) : ?>
						<div><?php get_search_form(); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</main>
	</section>
<?php
get_footer();
