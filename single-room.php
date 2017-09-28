<?php
/**
 * SINGLE ROOM
 * Author: Edison Panchi
 */

// Add Header with background, function implemented : inc/hsqtheme-functions.php
remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_after_header', 'add_after_header_title');

//* Remove the entry header markup (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);

//* Remove the entry meta in the entry header (requires HTML5 theme support)
remove_action('genesis_entry_content','genesis_do_post_content');
remove_action('genesis_entry_header', 'genesis_post_info', 12);


add_action('genesis_entry_content', 'hsqtheme_markup_article_open', 10);

add_action('genesis_entry_content', 'hsqtheme_info_header',20);
function hsqtheme_info_header()
{
    /*echo '
    <section class="col-md-12">
        <header>';
    if ($value = genesis_get_custom_field('room_description'))
        echo '<p class="room-description">' . $value . '</p>'
    $content = '';
    if (get_the_content())
        $content =get_the_content();
    elseif (genesis_get_image('post-image'))
        $content = genesis_get_image('post-image');


    echo '</header></section>';*/
    echo '<section class="product-cat-image col-md-8">';
}

add_action('genesis_entry_content','genesis_do_post_content',21);

add_action('genesis_entry_content', 'hsqtheme_info_footer',22);
function hsqtheme_info_footer()
{
    echo '<h3>' . __('Servicios:', 'hsqtheme') . '</h3>';
    if ($servicios = genesis_get_custom_field('room_services')) {

        echo ' <nav id="double" class="single-icons col-md-10">';

        foreach ($servicios as $key => $servicio) {

            $str = $servicio;
            $item_data=get_string_between($servicio,'[',']');

            //default icon
            $class_icon = 'fa fa-defaul';
            if (array_key_exists($item_data, get_icons_data())) {
                $str = str_replace('['.$item_data.']', "", $servicio);
                $class_icon = get_icons_data()[$item_data];
            }
            echo '<li>
                <i class="' . $class_icon . '" aria-hidden="true"></i>
                <span>' . $str . '</span>
              </li>';

        }
        echo ' </nav>';
    }

    echo   '

</section>
      <section class="single-info col-md-4">';

    echo '<h3>' . __('Características:', 'hsqtheme') . '</h3>';
    if ($value = genesis_get_custom_field('room_capacity'))
        echo '<p class="room-capacity">' . __('Personas :', 'hsqtheme') . $value . '</p>';

    if ($value = genesis_get_custom_field('room_dimension'))
        echo '<p class="room-dimension">' . __('Dimensiones :', 'hsqtheme') . $value . '</p>';

    if ($value = genesis_get_custom_field('room_bed_number'))
        echo '<p class="room_bed_number">' . __('Camas :', 'hsqtheme') . $value . '</p>';
    echo '<hr/>';
    if (genesis_get_custom_field('room_price')) {
        echo ' <h4>' . __('Desde:', 'hsqtheme') . '</h4>
            <h1 class="price">$' . genesis_get_custom_field('room_price') . '</h1>
            <h4>' . __('Por noche:', 'hsqtheme') . '</h4>';
    }
    //echo '  <a href="' . get_permalink() . '" class="btn btn-black">' . __('Reservar ahora', 'hsqtheme') . '</a>';
    if (hsqtheme_is_gravityforms_activated()) {
        $args=[
            'current_price'=>genesis_get_custom_field('room_price'),
            'current_title'=>get_the_title(),
            'current_description'=>genesis_get_custom_field('room_description'),
        ];

        gravity_form(1, true, false, true, $args, true, 12);
        echo'<a class="form-button col-md-12 col-xs-12 col-lg-12" target="_blank" href="#" >Pagar con Payphone</a>';
    }
    echo '</section>';
}

add_action('genesis_entry_content', 'hsqtheme_markup_article_close', 100);



genesis();
