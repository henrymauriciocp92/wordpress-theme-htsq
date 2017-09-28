<?php
/**
*   WooCommerce custom Hooks
* @package  hsqtheme
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',     20, 0 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'hsqtheme_product_content',    'hsqtheme_product_content',          10 );
