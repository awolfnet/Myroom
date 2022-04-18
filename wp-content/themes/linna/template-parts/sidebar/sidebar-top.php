<?php

/**
 * Displays the top sidebar area
 *
 * @package WordPress
 * @subpackage Linna
 * @since 1.0.0
 */

?>
<div class="site-sidebar-top site-primary-bg sidebar-box">
	<?php global $current_user;
	wp_get_current_user();	?>
	<?php $sidebar_top_logo = get_avatar_url($current_user->ID, array('size' => 96)); ?>
	<?php $sidebar_top_logo_border_radius = linna_option('sidebar-top-logo-border-radius'); ?>
	<?php $sidebar_top_text_1 = $current_user->display_name; ?>
	<?php $sidebar_top_text_2 = linna_option('sidebar-top-text-2'); ?>

	<?php if (!empty($sidebar_top_logo)) : ?>
		<img src="<?php echo esc_attr($sidebar_top_logo); ?>" style="
		<?php
		if (!empty($sidebar_top_logo_border_radius)) :
		?>
				border-radius:<?php echo esc_attr($sidebar_top_logo_border_radius); ?>%;<?php endif; ?>" alt="">
	<?php endif; ?>

	<?php
	if (!empty($sidebar_top_text_1)) :
	?>
		<h3><?php echo esc_html($sidebar_top_text_1); ?></h3><?php endif; ?>
	<?php
	if (!empty($sidebar_top_text_2)) :
	?>
		<h5><?php echo esc_html($sidebar_top_text_2); ?></h5><?php endif; ?>
</div>