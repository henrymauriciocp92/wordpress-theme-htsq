<?php
// Quitar titulo
remove_action( 'genesis_entry_header', 'genesis_do_post_title');

//js




// -------------------------------------------------------Slide temporal
add_action('genesis_after_header','add_after_header_slide');

// -------------------------------------------------------Slide temporal

// 2 columnas footer
add_filter('genesis_before_footer', 'cld_widget_page_header_left');
function cld_widget_page_header_left() {

     genesis_widget_area( 'widget_page_header_left', array(
     'before' => '<div class="page-header-left"><div class="wrap">',
     'after'  => '</div></div>',
    ) );

}

add_filter('genesis_before_footer', 'cld_widget_page_header_right');
function cld_widget_page_header_right() {

     genesis_widget_area( 'widget_page_header_right', array(
     'before' => '<div class="page-header-right"><div class="wrap">',
     'after'  => '</div></div>',
    ) );

}
genesis();
