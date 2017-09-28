<?php
//* Wordpress Dashicons
 add_action( 'wp_enqueue_scripts', 'b3m_enqueue_dashicons' );
 function b3m_enqueue_dashicons() {
 	wp_enqueue_style( 'dashicons' );

 }
