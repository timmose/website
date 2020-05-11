<?php
/**
 * Add WooCommerce compatibility functions
 * This file contains all WooCommerce specific hooks and custom functions
 *
 * @package Leanex Lite
 */

/**
 *
 * Adding additional setting section to WooCommerce customize panel
 *
 */
function leanex_lite_wc_customize_register( $wp_customize ) {
	// Add Section
    $wp_customize->add_section(
        'leanex_wc_section',
        array(
            'title'    => __( 'Shop Page Settings', 'leanex-lite' ),
            'priority' => 20,
            'panel'    => 'woocommerce',
            'description' => '', 
        )
    );

    // Add Settings
    $wp_customize->add_setting( 
    	'shop-headline', 
    	array(
    		'sanitize_callback' => 'sanitize_text_field',
    		'transport' => 'refresh' 
    	) 
    );
    $wp_customize->add_control( 'leanex_wc_section_control', 
        array(
            'label'     => __( 'Shop Title', 'leanex-lite' ),
            'type'      => 'text',
            'settings'  => 'shop-headline',
            'section'   => 'leanex_wc_section',
            'priority'  => 20,
        ) 
    );

    $wp_customize->add_setting(
    	'shop_header_image',
    	array(
		    'type' 				=> 'theme_mod',
		    'sanitize_callback' => 'absint'
		)
    );
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'shop_header_image',
			array(
			    'section' 		=> 'leanex_wc_section',
			    'label' 		=> __( 'Header Image', 'leanex-lite' ),
			    'width' 		=> 1900,
			    'height' 		=> 900
			)
		)
	);
}
add_action( 'customize_register', 'leanex_lite_wc_customize_register', 99 );

/**
 *
 * Default set for the columns and rows when WooCommerce store page
 *
 */
function leanex_lite_woocommerce_theme_support() {
    add_theme_support( 'woocommerce', array(
        // . . .
        // thumbnail_image_width, single_image_width, etc.
 
        // Product grid theme settings
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
             
            'default_columns' => 2,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ) );
}
add_action( 'after_setup_theme', 'leanex_lite_woocommerce_theme_support' );

/**
 * Enqueue theme scripts and styles for WooCommerce compatibility
 */
function leanex_lite_wc_enqueue() {
	if( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_account_page() 
		|| is_cart() ) ) {
		wp_enqueue_script('leanex-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array(), '', true);
	}
}
add_action( 'wp_enqueue_scripts', 'leanex_lite_wc_enqueue' );

/**
 * Replace WooCommerce wrappers to theme wrappers
 */
remove_action( 
	'woocommerce_before_main_content', 
	'woocommerce_output_content_wrapper', 10 );
remove_action( 
	'woocommerce_before_main_content', 
	'woocommerce_breadcrumb', 20 );
remove_action( 
	'woocommerce_after_main_content', 
	'woocommerce_output_content_wrapper_end', 10 );

/**
 * Remove actions
 */
remove_action( 
	'woocommerce_sidebar', 
	'woocommerce_get_sidebar', 10 );
remove_action( 
	'woocommerce_single_product_summary', 
	'woocommerce_template_single_title', 5 );
remove_action( 
	'woocommerce_archive_description', 
	'woocommerce_taxonomy_archive_description', 10 );
remove_action( 
	'woocommerce_archive_description', 
	'woocommerce_product_archive_description', 10 );
remove_action( 
	'woocommerce_after_shop_loop_item',
	'woocommerce_template_loop_add_to_cart', 10 );

/**
 *
 * Remove page title which display uses default templates
 *
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * To display the wrappers of this theme
 */

add_action( 
	'woocommerce_before_main_content', 
	'leanex_lite_woocommerce_wrapper_start', 10 );
add_action( 
	'woocommerce_after_main_content', 
	'leanex_lite_woocommerce_wrapper_end', 10 );

if ( ! function_exists( 'leanex_lite_woocommerce_wrapper_start' ) ) {
	function leanex_lite_woocommerce_wrapper_start() {
		get_template_part( 'template-parts/headline' );
		echo '<div id="primary" class="content-area container">';
		echo '<div class="row">';
		echo '<main id="main" class="site-main wc-content col-md-8';
		leanex_lite_main_class();
		echo '" role="main">';
	}
}

if ( ! function_exists( 'leanex_lite_woocommerce_wrapper_end' ) ) {
	function leanex_lite_woocommerce_wrapper_end() {
		echo '</main>';
		get_sidebar('woocommerce');
		echo '</div>';
		echo '</div>';
	}
}

/**
 * Change the markup the woocommerce pagination by default
 */
function leanex_lite_woo_pagination( $args ) {
	$args['prev_text'] = __('Previous','leanex-lite');
	$args['next_text'] = __('Next','leanex-lite');
	$args['type'] = 'plain';
	return $args;
}
add_filter( 'woocommerce_pagination_args', 	'leanex_lite_woo_pagination' );

/**
 * Change the layout before each item product listing
 */
function leanex_lite_before_shop_loop_item_title() {
	echo '<div class="' . apply_filters( 'leanex_product_card_classes', 'text-center card-body' ) . '">';
}
add_action ( 
	'woocommerce_before_shop_loop_item_title', 
	'leanex_lite_before_shop_loop_item_title' );

/**
 * Change the layout after each item product listing
 */
function leanex_lite_after_shop_loop_item() {
	echo '</div>';
}
add_action ( 
	'woocommerce_after_shop_loop_item', 
	'leanex_lite_after_shop_loop_item' );

/**
 * Change the markup the count category
 */
function leanex_lite_count_category_html( $html, $category ){
	$html = ' <span class="badge badge-primary badge-pill">' . esc_html( $category->count ) . '</span>';

	return $html;
}
add_filter( 'woocommerce_subcategory_count_html', 'leanex_lite_count_category_html', 10, 2 );

/**
 * A form classes change function
 * 
 * Modify each individual input type $args defaults
 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
 *
 * @param string $args Form attributes.
 * @param string $key Not in use.
 * @param null   $value Not in use.
 *
 * @return mixed
 */
add_filter( 
	'woocommerce_form_field_args', 
	'leanex_lite_wc_form_field_args', 10, 3 
);
if ( ! function_exists( 'leanex_lite_wc_form_field_args' ) ) {
	function leanex_lite_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			/* Targets all select input type elements, except the country and state select input types */
			case 'select':
				// Add a class to the field's html element wrapper - woocommerce
				// input types (fields) are often wrapped within a <p></p> tag.
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class']       = array( 'form-control', '' );
				$args['label_class']       = array( 'control-label' );
				//$args['custom_attributes']['data-plugin'] = 'select2';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
					// Add custom data attributes to the form input itself.
				);
				break;
			// By default WooCommerce will populate a select with the country names - $args
			// defined for this specific input type targets only the country select element.
			case 'country':
				$args['class'][]     = 'form-group single-country';
				$args['label_class'] = array( 'control-label' );
				break;
			// By default WooCommerce will populate a select with state names - $args defined
			// for this specific input type targets only the country select element.
			case 'state':
				// Add class to the field's html element wrapper.
				$args['class'][] = 'form-group';
				// add class to the form input itself.
				$args['input_class']       = array( '', '' );
				$args['label_class']       = array( 'control-label' );
				//$args['custom_attributes']['data-plugin'] = 'select2';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', '' );
				$args['label_class'] = array( 'control-label' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control', '' );
				//$args['label_class'] = array( 'control-label' );
				break;
			case 'checkbox':
				$args['label_class'] = array( 'form-check-label' );
				$args['input_class'] = array( 'form-check-input', '' );
				break;
			case 'radio':
				$args['label_class'] = array( 'form-check-input' );
				$args['input_class'] = array( 'form-check-label', '' );
				break;
			default:
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control', '' );
				//$args['label_class'] = array( 'control-label' );
				break;
		} // end switch ($args).
		return $args;
	}
}