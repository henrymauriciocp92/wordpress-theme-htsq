<?php
/**
 *  hsqtheme functions
 * @package hsqtheme
 */

if (!function_exists('hsqtheme_is_woocommerce_activated')) {
    /**
     * Query WooCommerce activation
     */
    function hsqtheme_is_woocommerce_activated()
    {
        return class_exists('WooCommerce') ? true : false;
    }

}

if (!function_exists('hsqtheme_is_gravityforms_activated')) {
    /**
     * Gravity Forms activation
     */
    function hsqtheme_is_gravityforms_activated()
    {
        return class_exists('GFForms') ? true : false;
    }
}

function add_after_header_title()
{
    echo '<div id="page-heading" class="blog-heading">
		<div class="col-full site-inner">
			<div id="page-title">
				<h2 class="page-title-header">Habitaciones</h1>
				<h1 class="page-title-header">y suites</h1>
			</div>
		</div>
	</div><!-- /#page-heading -->
';

}


function hsqtheme_markup_article_open()
{
    echo '<article class="item">';
}

function hsqtheme_markup_article_close()
{
    echo '</article>';
}


function add_after_header_slide()
{
    echo '<div id="tabs">';

    $args = array(
        'post_type' => 'room',
        'posts_per_archive_page'=>4,
        'meta_key' => 'room_is_featured',
        'meta_key' => 'room_price',
        'orderby'=>'room_price',
        'order'      => 'ASC',
        //'meta_value' => true,
    );

    $rooms = new WP_Query($args);


    if ($rooms->have_posts()) {
        $tab = 1;
        while ($rooms->have_posts()) {

            $rooms->the_post();

            // TODO Verify is room_header is setted
            $image = get_field('room_header');

            echo '<div id="tabs-' . $tab . '">';
            echo '<div class="slide slidehome">';

                echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';

            // TODO Featured Text
            echo '<div class="text1">
             <h5>' . genesis_get_custom_field('room_h1_principal') . '</h5>
            </div>
            <div class="text2">
             <h5 >' . genesis_get_custom_field('room_h1_secundario') . '</h5>
           </div>
              <a href="' . get_permalink() . '" class="button-slide ">' . strtoupper(__('Reservar ahora', 'hsqtheme')) . '</a>';
            echo '</div>';
            echo '</div>';
            $tab++;

        }

        $tab = 1;
        echo '<div class="icon-slider">';
        echo '<ul>';                
                while ($rooms->have_posts()) {
            $rooms->the_post();
            $title=(get_the_title());
            if (strlen(get_the_title())>20)
                $title = substr(get_the_title(), 0, 20).'...';

        echo '<li >
        <a class"active" href="#tabs-' . $tab . '">
      <ul class="columns">
        <li class="column-left column-one"><i class="fa fa-bed" aria-hidden="true"></i></li>
        <li class="column-left column-two"><p>' . $title . '</p></li>
        <li class="column-left column-three"><h1>$</h1></li>
        <li class="column-left column-four">
          <p>' . __('Desde:', 'hsqtheme') . '</p>
          <h1>' . genesis_get_custom_field('room_price') . '</h1>
        </li>
      </ul>
    </a></li>';
    $tab++;
    }

    echo '</ul>';
    echo '</div>';
  //       echo '<ul>';
  //       while ($rooms->have_posts()) {
  //           $rooms->the_post();

  //           $title=(get_the_title());
  //           if (strlen(get_the_title())>20)
  //               $title = substr(get_the_title(), 0, 20).'...';

  //           echo '<li class="col-xs-6 col-md-6 col-lg-3 slidehome">
		// <a href="#tabs-' . $tab . '" class="slidehome">
		// 	<div class="col-sm-2 contenedor1">
		// 		<i class="fa fa-bed" aria-hidden="true"></i>
		// 	</div>
		// 	<div class="col-sm-6">
		// 		<h1>' . $title . '</h1>
		// 	</div>
		// 	<div class="col-md-4">
		// 		<h4>$</h4>
		// 		<p class="arriba">' . __('Desde:', 'hsqtheme') . '</p>
		// 		<p class="abajo">' . genesis_get_custom_field('room_price') . '</p>
		// 	</div>
		// </a>';
  //           echo '</li>';
  //           $tab++;

  //       }
  //       echo '</ul>';
    }

    echo '</div>';

}

/**
 * Get string between [TV]
 */
function get_icons_data(){
    return [ 'TV' => 'fa fa-television',
        'WIFI' => 'fa fa-wifi',
        'BATH' => 'fa fa-bath',
        'PHONE' => 'fa fa-phone',
        'MINIBAR' => 'fa fa-th-large',
        'BREAKFAST' => 'fa fa-cutlery',
        'HAIRDRYER' => 'fa fa-plug',
    ];
}
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
