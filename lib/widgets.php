<?php 

genesis_register_sidebar( array(
	'id' 			=> 'widget_page_header_left',
    'name' 			=> __( 'Post Columna Izquierda', 'genesis' ),
    'description' 	=> __( 'Columna Izquierda', 'seasons-pro' ),
) );

genesis_register_sidebar( array(
	'id' 			=> 'widget_page_header_right',
    'name' 			=> __( 'Post Columna Derecha', 'genesis' ),
    'description' 	=> __( 'Columna Derecha', 'seasons-pro' ),
) );

 ?>