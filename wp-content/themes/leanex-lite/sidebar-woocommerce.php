<?php
/**
 * The Page sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leanex
 */
if ( ! is_active_sidebar( 'woocommerce' ) ) {
	return;
} ?>

<aside id="secondary" class="widget-area col-md-4<?php if ( true == get_theme_mod( 'page-sidebar-left' ) ) { ?> col-md-pull-8<?php } ?>" role="complementary">
	<?php dynamic_sidebar( 'woocommerce' ); ?>
</aside><!-- #secondary -->
