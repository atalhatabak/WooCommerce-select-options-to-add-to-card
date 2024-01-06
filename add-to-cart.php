<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if( $product->is_type('variable') ){
        $default_attributes = $product->get_default_attributes();
        foreach($product->get_available_variations() as $variation_values ){
            foreach($variation_values['attributes'] as $key => $attribute_value ){
                $attribute_name = str_replace( 'attribute_', '', $key );
                $default_value = $product->get_variation_default_attribute($attribute_name);
                if( $default_value == $attribute_value ){
                    $is_default_variation = true;
                } else {
                    $is_default_variation = false;
                    break; // Stop this loop to start next main lopp
                }
            }
        if( $is_default_variation ){
                $variation_id = $variation_values['variation_id'];
                break; // Stop the main loop
            }
        }

        // Now we get the default variation data
        if( $is_default_variation ){
            // Raw output of available "default" variation details data

            // Get the "default" WC_Product_Variation object to use available methods
            $default_variation = wc_get_product($variation_id);
            // for id
            $id = $default_variation->get_id();
            // Get The active price
            $price = $default_variation->get_price(); 
            $yyy = $product->get_id();
            $xxx=wc_implode_html_attributes( $args['attributes'] );
            $son = str_replace($yyy, $id, $xxx);
    
        }
    }
    else{
        $id=$product->get_id();
        $son=wc_implode_html_attributes( $args['attributes'] );
    }
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( "/?add-to-cart=$id" ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? "button product_type_simple add_to_cart_button ajax_add_to_cart" : 'button' ),
	isset( $args['attributes'] ) ? $son : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
