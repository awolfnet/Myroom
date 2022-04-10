<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FlatMobile
 * @since FlatMobile 1.0
 */

get_header(); ?>

<div class="ms-shop">
	<div class="ms-card">
		<div class="content-inner">
			<?php woocommerce_content(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>