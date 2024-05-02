<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
// add action
 add_action('woocommerce_before_add_to_cart_button','add_heading_before_button');
 function add_heading_before_button(){
	echo "<h1>We are here</h1>";
 }

 // add filter
add_filter('woocommerce_cart_item_name','modify_name_of_product',40,60);
 function modify_name_of_product($item_name,$cart_item,$cart_item_key)
{
	$item_name="teststring";
	return  $item_name;

}

add_action('woocommerce_cart_calculate_fees', 'add_custom_fee');
function add_custom_fee() {


    $fee_amount = 10; // Amount of the fee
    $fee_name = 'Merchant Fee'; // Name of the fee


    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        WC()->cart->add_fee($fee_name, $fee_amount, true, '');
				}
}

add_action('woocommerce_cart_calculate_fees', 'add_custom_fee_insurance');
function add_custom_fee_insurance() {


    $fee_amount = 100; // Amount of the fee
    $fee_name = 'Insurance Fee'; // Name of the fee


    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        WC()->cart->add_fee($fee_name, $fee_amount, true, ''); // Add the fee
    }
}










add_action('woocommerce_cart_calculate_fees', 'extra_add_custom_fee_extra');

function extra_add_custom_fee_extra() {
    global $laptop_category_id, $cloths_category_id; // Declare as global

    // Get category IDs
    $laptop_category_id = get_term_by('slug', 'apple-products', 'product_cat')->term_id;
    $cloths_category_id = get_term_by('slug', 'mens-shirt', 'product_cat')->term_id;

    // Initialize cart flags
    $cart_has_laptop = false;
    $cart_has_cloths = false;

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product_id = $cart_item['product_id'];
        $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));

        if (in_array($laptop_category_id, $product_categories)) {
            // Set cart flag for laptop category
            $cart_has_laptop = true;
        }
        if (in_array($cloths_category_id, $product_categories)) {
            // Set cart flag for cloths category
            $cart_has_cloths = true;
        }
    }

    // Print the flags (for debugging)
    // echo "Laptop Category: " . ($cart_has_laptop ? 'Yes' : 'No') . "<br>";
    // echo "Cloths Category: " . ($cart_has_cloths ? 'Yes' : 'No') . "<br>";

    // If the cart contains products from the "Laptop" category, add the fee
    if ($cart_has_laptop) {
        // Calculate the fee amount as 10% of the cart subtotal
        $cart_subtotal = WC()->cart->subtotal;
        $fee_amount = $cart_subtotal * 0.10; // 10% of the subtotal
        $fee_name = 'Laptop Extra Fee (10%)'; // Name of the fee

        // Add the fee
        WC()->cart->add_fee($fee_name, $fee_amount, true, '');
    }

    // If the cart contains products from the "Cloths" category, add a fixed fee of 10 Rs
    if ($cart_has_cloths) {
        $fee_amount = 10; // Amount in Rs
        $fee_name = 'Cloths Extra Fee (Rs 10)'; // Name of the fee

        // Add the fee
        WC()->cart->add_fee($fee_name, $fee_amount, true, '');
    }
}









//
// add_action('woocommerce_cart_calculate_fees', 'add_custom_fee_extra');
// function add_custom_fee_extra() {
//     // Check if the cart contains products from the "Laptop" category
//     $laptop_category_id = get_term_by('slug', 'laptop', 'product_cat')->term_id;
//     $cloths_category_id = get_term_by('slug', 'cloths', 'product_cat')->term_id;
//
//     $cart_has_laptop = false; // Initialize as false
//     $cart_has_cloths = false; // Initialize as false
//
//     foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
// 			echo "string";
//         $product_categories = wp_get_post_terms($cart_item['product_id'], 'product_cat', array('fields' => 'ids'));
//
//         if (in_array($laptop_category_id, $product_categories)) {
//             $cart_has_laptop = true;
//         }
//         if (in_array($cloths_category_id, $product_categories)) {
//             $cart_has_cloths = true;
//         }
//     }
//
//     // If the cart contains products from the "Laptop" category, add the fee
//     if ($cart_has_laptop) {
//         // Calculate the fee amount as 10% of the cart subtotal
//         $cart_subtotal = WC()->cart->subtotal;
//         $fee_amount = $cart_subtotal * 0.10; // 10% of the subtotal
//         $fee_name = 'Laptop Extra Fee (10%)'; // Name of the fee
//
//         // Add the fee
//         WC()->cart->add_fee($fee_name, $fee_amount, true, '');
//     }
//
//     // If the cart contains products from the "Cloths" category, add a fixed fee of 10 Rs
//     if ($cart_has_cloths) {
//         $fee_amount = 10; // Amount in Rs
//         $fee_name = 'Cloths Extra Fee (Rs 10)'; // Name of the fee
//
//         // Add the fee
//         WC()->cart->add_fee($fee_name, $fee_amount, true, '');
//     }
// }
// add_filter( 'woocommerce_billing_fields', 'ts_unrequire_wc_phone_field');
// function ts_unrequire_wc_phone_field( $fields ) {
// $fields['billing_phone']['required'] = false;
// return $fields;
// }

add_filter( 'woocommerce_shipping_fields', 'custom_shipping_phone_field', 10, 1 );
function custom_shipping_phone_field( $fields ) {
    $fields['shipping_phone']['required'] = true;
    return $fields;
}

add_filter( 'woocommerce_billing_fields', 'custom_billing_phone_field', 10, 1 );
function custom_billing_phone_field( $fields ) {
    $fields['billing_phone']['required'] = true;
    return $fields;
}

// Add this code to your theme's functions.php file or a custom plugin

function modify_cart_text( $translated_text, $text, $domain ) {
    // Check if the text domain is relevant to the cart section
    if ( 'woocommerce' === $domain ) {
        // Check for the specific text you want to modify
        switch ( $translated_text ) {
            case 'Your Cart':
                // Replace 'Your Cart' with your desired text
                $translated_text = 'Your Shopping Cart';
                break;
            // Add more cases as needed for other text modifications
        }
    }

    return $translated_text;
}
// Hook the function to the 'gettext' filter
add_filter( 'gettext', 'modify_cart_text', 20, 3 );
