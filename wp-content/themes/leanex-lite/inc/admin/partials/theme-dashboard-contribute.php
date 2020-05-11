<?php
// Define links.
$review_link = '<a href="https://wordpress.org/support/theme/leanex-lite/reviews/#new-post" target="_blank">' . esc_html__( 'review', 'leanex-lite' ) . '</a>';
$translate_link = '<a href="https://translate.wordpress.org/projects/wp-themes/leanex-lite/" target="_blank">' . esc_html__( 'translate this theme', 'leanex-lite' ) . '</a>';
?>

<div class="tab-section">
    <p><?php esc_html_e( 'Do you like the theme? I would love your help. There are ways in which you can help:', 'leanex-lite' ); ?></p>
</div><!-- .tab-section -->

<div class="tab-section action-section">
    <h3 class="section-title"><?php esc_html_e( 'Rate', 'leanex-lite' ); ?></h3>

    <p>
	   <?php
            /* translators: %s is a placeholders that will be replaced by variables passed as an argument. */
            printf( esc_html__( 'I will appreciate if you find a few minutes and leave a five stars %s. It is important for me, as we see it as a feedback and support from you.', 'leanex-lite' ), $review_link ); // WPCS: XSS OK.
       ?>
	</p>
</div><!-- .tab-section -->

<div class="tab-section action-section">
    <h3 class="section-title"><?php esc_html_e( 'Write', 'leanex-lite' ); ?></h3>
    <p>
        <?php
            /* translators: %s is a placeholders that will be replaced by variables passed as an argument. */
            printf( esc_html__( 'You can help to %s into your language at any time. Just log in to the translation platform with your WordPress.org account, and suggest translations.', 'leanex-lite' ), $translate_link ); // WPCS: XSS OK.
       ?>
    </p>
</div><!-- .tab-section -->
