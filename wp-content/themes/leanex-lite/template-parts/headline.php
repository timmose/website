<?php
/**
 * Template part for displaying headline section.
 *
 * @package Leanex Lite
 */
?>

<?php
	$thumbnail_id = '';

	// Set header Image
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'leanex-lite-header' );

	if( !is_singular() ) {
		$bgimage = get_header_image();
	}
	if( is_home() && !is_front_page() && get_theme_mod( 'blog-header' ) ) {
		$bgimage = get_theme_mod( 'blog-header' );
	}
	if( is_singular() && $thumbnail ) {
		$bgimage = $thumbnail[0];
	}
	if( is_singular() && !$thumbnail ) {
		$bgimage = get_header_image();
	}

	// Additional class if the headline is empty to keep indented from the top panel
	if ( is_home() && ! get_theme_mod( 'blog-headline-content' ) || is_front_page() && ! get_theme_mod( 'headline-text' ) ) {
		$class = ' space';
	} else {
		$class = '';
	}

	// Add class if is a singular without sidebar
	if( is_singular( 'post' ) && !is_active_sidebar( 'sidebar-post' )
	|| !is_front_page() && is_singular( 'page' ) && !is_active_sidebar( 'sidebar-page' ) ) :
		$class = 'text-center ';
	endif;

	// Singular without Sidebar
	if( is_singular( 'post' ) || !is_front_page() && is_singular( 'page' ) ) :
	?>
	<section id="headline" class="<?php echo esc_attr( $class ); ?>headline-section"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content container">
            		<?php the_title( '<h1>', '</h1>' ); ?>
         		</div>
				<span class="overlay-header"></span>
    </section>
<?php
	endif;

	// Front Display
	if( is_front_page() ) : ?>

		<section id="headline" class="headline-section text-center<?php echo esc_attr( $class ); ?>"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
			<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'headline-text' ) ) ); ?>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;

	// Blog Page
	if( !is_front_page() && is_home() ) : ?>

		<section id="headline" class="headline-section text-center<?php echo esc_attr( $class ); ?>"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
			<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'blog-headline-content' ) ) ); ?>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;
	
	// Archive
	if( is_archive() && ! class_exists( 'WooCommerce' ) || ( is_archive() && class_exists( 'WooCommerce' ) && !is_shop() && !is_product_category() ) ) : ?>

		<section id="headline" class="headline-section text-center<?php echo esc_attr( $class ); ?>"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
					<?php
							the_archive_title( '<h1>', '</h1>' );
							the_archive_description( '<p class="taxonomy-description">', '</p>' );
					?>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;
	
	// Search
	if( is_search() ) : ?>

		<section id="headline" class="headline-section text-center<?php echo esc_attr( $class ); ?>"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
					<h1><?php printf( esc_html__( 'Search Results for: %s', 'leanex-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;
	if( is_404() ) : ?>

		<section id="headline" class="headline-section text-center"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
            			<h1><?php esc_html_e( 'Error 404', 'leanex-lite' ); ?></h1>
            			<p class="lead"><?php esc_html_e( 'Oops! That page cant be found.', 'leanex-lite' ); ?></p>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;

if( class_exists( 'WooCommerce' ) ) {

	if( !is_active_sidebar( 'woocommerce' ) ) :
		$class = 'text-center ';
	endif;

	// Store Archive / WooCommerce
	if( is_product_category() ) :
	?>
		<section id="headline" class="<?php echo esc_attr( $class ); ?>headline-section"<?php leanex_lite_header_bg(); ?>>
         		<div class="head-content">
					<?php
							the_archive_title( '<h1>', '</h1>' );
							the_archive_description( '<p class="lead">', '</p>' );
					?>
         		</div>
		<span class="overlay-header"></span>
      	</section>
<?php
	endif;
	
	// WooCommerce Shop
	if ( is_shop() ) :
		if ( ! get_theme_mod( 'shop-headline' ) ) {
			$class .= 'space ';
		} else {
			$class .= '';
		}
	?>

	<section id="headline" class="<?php echo esc_attr( $class ); ?>headline-section"<?php leanex_lite_header_bg(); ?>>
		<div class="head-content container">
			<h1><?php echo esc_html( get_theme_mod( 'shop-headline' ) ); ?></h1>
		</div>
		<span class="overlay-header"></span>
	</section>

<?php
	endif;

	// WooCommerce Product
	if( is_product() ) :
	?>
	
	<section id="headline" class="<?php echo esc_attr( $class ); ?>headline-section"<?php leanex_lite_header_bg(); ?>>
		<div class="head-content container">
			<?php
				if ( $thumbnail_id && get_theme_mod( 'header-alt' ) == 'alt' ) {
				?>
				<img src="<?php echo esc_url( $thumbnail_url[0] ); ?>" class="post-img" />
			<?php
				}
				?>
            <?php the_title( '<h1>', '</h1>' ); ?>
		</div>
		<span class="overlay-header"></span>
	</section>
<?php
	endif;
} //class_exists( 'WooCommerce' ) ?>