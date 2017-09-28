<?php
/**
 * TAXONOMY Integration
 * Autor: Edison Panchi
 */


//* Remove the entry header markup (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);

//* Remove the entry title (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_do_post_title');

//* Remove the entry meta in the entry header (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_post_info', 12);

//* Remove the post format image (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_do_post_format_image', 4);

// Add Header with background, function implemented : inc/hsqtheme-functions.php
remove_action('genesis_sidebar', 'genesis_do_sidebar');
add_action('genesis_after_header', 'add_after_header_title');


remove_action('genesis_entry_content','genesis_do_post_content');

add_action('genesis_entry_content', 'hsqtheme_markup_article_open', 10);

add_action('genesis_entry_content', 'hsqtheme_section_one', 20);
function hsqtheme_section_one()
{
    // TODO - MAURICIO Validate if post hast featured image or publish default image
    echo '<section class="product-cat-image col-md-5">
        <figure>
          '.genesis_get_image('post-image').'
        </figure>';
    if ($servicios = genesis_get_custom_field('room_services')) {
        echo '<h3>' . __('Servicios:', 'hsqtheme') . '</h3>';

        echo ' <nav id="double" class="single-icons-taxonomy col-md-10">';

        foreach ($servicios as $key => $servicio) {

            $str = $servicio;
            $item_data=get_string_between($servicio,'[',']');

            //default icon

            if (array_key_exists($item_data, get_icons_data())) {
                $class_icon = get_icons_data()[$item_data];
                echo '<li>
                <i class="' . $class_icon . '" aria-hidden="true"></i>
              </li>';
            }


        }

    }
     echo  '</section>';
}

add_action('genesis_entry_content', 'hsqtheme_section_two_markup_open', 30);
function hsqtheme_section_two_markup_open()
{
    echo '<section class="col-md-4 product-info">';
}

add_action('genesis_entry_content', 'genesis_do_post_title', 31);
//add_action('genesis_entry_content', 'genesis_post_info', 32);


add_action('genesis_entry_content', 'hsqtheme_section_two_markup_close', 33);
function hsqtheme_section_two_markup_close()
{

    if( $value = genesis_get_custom_field( 'room_description' ) )
        echo '<h5 class="room-capacity">'.$value.'</h5>';

    echo '<h3>'.__('Características:','hsqtheme').'</h3>';
    if( $value = genesis_get_custom_field( 'room_capacity' ) )
        echo '<p class="room-capacity">'.__('Personas :','hsqtheme').$value.'</p>';

    if( $value = genesis_get_custom_field( 'room_dimension' ) )
        echo '<p class="room-dimension">'.__('Dimensiones :','hsqtheme').$value.'</p>';

    if( $value = genesis_get_custom_field( 'room_bed_number' ) )
        echo '<p class="room_bed_number">'.__('Camas :','hsqtheme').$value.'</p>';
    echo '<hr/>';




    echo '</section>';
}

// TODO Improve section
add_action('genesis_entry_content', 'room_information', 40);
function room_information()
{
    echo '<section class="col-md-3 price-block">';


    if (genesis_get_custom_field('room_price')){
    echo ' <h4>' . __('Desde:', 'hsqtheme') . '</h4>
            <h1 class="price">$'.genesis_get_custom_field('room_price').'</h1>
            <h4>' . __('Por noche:', 'hsqtheme') . '</h4>';
    }
    echo '  <a href="'.get_permalink().'" class="btn btn-black">'.__('Más información','hsqtheme').'</a>';

    echo '</section>';
}

add_action('genesis_entry_content', 'hsqtheme_markup_article_close', 100);

genesis();
