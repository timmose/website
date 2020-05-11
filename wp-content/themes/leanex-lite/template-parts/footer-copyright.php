<?php
/**
 * Template part for displaying the copyright on the footer.
 * @package Leanex Lite
 */
?>

<p class="credit">
	<?php echo '&copy; '. esc_html( date('Y') ) . '&nbsp;'; ?>
	<?php echo esc_html( get_theme_mod( 'copyright-text' ) ); ?>
</p>