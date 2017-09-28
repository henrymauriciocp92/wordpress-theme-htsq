<?php
/**
 * Hotel Sol de Quito Theme
 *    Author: Edison Panchi / Mauricio Cruz
 * June 8 2017
 */

include_once(get_template_directory() . '/lib/init.php');
include_once(get_stylesheet_directory() . '/lib/widgets.php');


// HSQ Functions 
require 'inc/hsqtheme-functions.php';


require_once 'lib/form.php';


remove_action('genesis_meta', 'genesis_load_stylesheet');
add_action('wp_enqueue_scripts', 'my_enqueue_styles');

function my_enqueue_styles()
{


    /* Carga de estilos desde el template Parent. */
    if (is_child_theme()) {
        wp_enqueue_style('parent-style', trailingslashit(get_template_directory_uri()) . 'style.css');

    }

    /* Estilos adicionales que se podrán configurar por plantillas*/
    wp_enqueue_style('css-sections', get_stylesheet_directory_uri() . '/css/colors.css', '1.0.0', true);
    wp_enqueue_style('css-rooms', get_stylesheet_directory_uri() . '/css/rooms.css', '1.0.0', true);
    wp_enqueue_style('css-tabs', get_stylesheet_directory_uri() . '/css/tabs.css', '1.0.0', true);

    /* Always load active theme's style.css. */
    wp_enqueue_style('style', get_stylesheet_uri());

    /* Estilos adicionales que se podrán configurar por plantillas*/
    //wp_enqueue_style( 'css-sections', get_stylesheet_directory_uri() . '/css/sections.css', '1.0.0', true );
    wp_enqueue_style('css-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', '3.3.7', true);
    wp_enqueue_style('css-woocommerce', get_stylesheet_directory_uri() . '/css/woocommerce.css', '1.0.0', true);
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Libre+Baskerville', array());
    wp_enqueue_script('follow', 'https://use.fontawesome.com/a7f4ec96ca.js', array('jquery'), '', true);

    wp_enqueue_script('followjquery', 'https://code.jquery.com/jquery-1.12.4.js', array('jquery'), '', true);
    wp_enqueue_script('followjqueryui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '', true);
    wp_enqueue_script('customscript', get_stylesheet_directory_uri() . '/js/slide.js', array('jquery'), '', true);
    // wp_enqueue_style( 'css-jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', '1.0.0', true );
    //wp_enqueue_style('css-jquery-ui', get_stylesheet_directory_uri() . '/css/jquery-ui.css', '1.0.0', true);

    // Responsive navigation
    wp_enqueue_script('responsive-menu-js', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('responsive-menu-css', get_stylesheet_directory_uri() . '/css/responsive-menu.css', '1.0.0', true);

}


add_theme_support('html5');
add_theme_support('genesis-structural-wraps', array('header', 'footer-widgets', 'footer'));
// Add custom body class to the head
add_filter('body_class', 'add_body_class');
function add_body_class($classes)
{
    $classes[] = 'agentpress-custom';
    return $classes;
}

//* Add support for custom header
add_theme_support('custom-header', array(
    'width' => 235,
    'height' => 210,
    'header-selector' => '.site-title a',
    'header-text' => false,
    'flex-height' => true,
));

// if header image is set, remove Header Right widget area and inject CSS to apply the header image as background image for home menu item and more
add_action('wp_head', 'sk_home_menu_item_background_image');
function sk_home_menu_item_background_image()
{

    if (get_header_image()) {
        // Remove the header right widget area
        unregister_sidebar('header-right'); ?>

        <style type="text/css">
            .nav-primary li.menu-item-home a {
                background-image: url(<?php echo get_header_image(); ?>);
                text-indent: -9999em;
                width: 100px;
                height: 100px;
            }

            @media only screen and (min-width: 1024px) {
                .site-header > .wrap {
                    padding: 0;
                }

                .title-area {
                    display: none;
                }

                .nav-primary {
                    padding: 20px 0;
                }

                .menu-primary {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-pack: center;
                    -webkit-justify-content: center;
                    -ms-flex-pack: center;
                    justify-content: center; /* center flex items horizontally */
                    -webkit-box-align: center;
                    -webkit-align-items: center;
                    -ms-flex-align: center;
                    align-items: center; /* center flex items vertically */
                }
            }
        </style>
    <?php
    }

}


// Force full width page layout
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');


// configuración menu
/**
 * Menú secundario
 */
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');

add_action('genesis_header', 'genesis_do_nav');

/**
 * Eliminar Footer por defecto
 */
remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'sp_custom_footer');
function sp_custom_footer()
{
    ?>
    <p> Derechos reservados &copy;  <?= date('Y') ?> &minus; Hotel Sol de Quito </p>
<?php
}


/**
 *  WOOCOMMERCE INTEGRATION
 */

/*add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}*/

/**
 * Hook in on activation
 */
/**
 * Define image sizes
 */
/*function yourtheme_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
  	$catalog = array(
		'width' 	=> '550',	// px
		'height'	=> '342',	// px
		'crop'		=> 0 		// true
	);
	$single = array(
		'width' 	=> '900',	// px
		'height'	=> '900',	// px
		'crop'		=> 0 		// true
	);
	$thumbnail = array(
		'width' 	=> '182',	// px
		'height'	=> '115',	// px
		'crop'		=> 0 		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
add_action( 'after_switch_theme', 'yourtheme_woocommerce_image_dimensions', 1 );*/

/*
function tutsplus_excerpt_in_product_archives() {

  the_excerpt();

}

add_action( 'woocommerce_after_shop_loop_item_title', 'tutsplus_excerpt_in_product_archives', 40 );
*/


/*
*   Requerido para corregir visualizaciónes en boostrap
*/

/*add_filter( 'body_class', 'wpse15850_body_class', 10, 2 );

function wpse15850_body_class( $wp_classes, $extra_classes ) {

    // List of the only WP generated classes not allowed

    $blacklist = array( 'woocommerce','woocommerce-page');
    //$blacklist = array( 'woocommerce-page');


    // Filter the body classes
    $wp_classes = array_diff( $wp_classes, $blacklist );

    // Add the extra classes back untouched
    return array_merge( $wp_classes, (array) $extra_classes );
}
*/

/**
 * Agregar clases separadas para el formulario en pagina especifica PAGE.PHP
 */

add_filter('body_class', 'custom_class');
function custom_class($classes)
{
    if (is_front_page('page.php')) {
        $classes[] = 'home-htsq';
    }
    return $classes;
}