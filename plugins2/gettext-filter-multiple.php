<?php

/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */

function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Sale!' :
			$translated_text = __( 'Clearance!', 'woocommerce' );
			break;
		case 'Add to cart' :
			$translated_text = __( 'Add to basket', 'woocommerce' );
			break;
		case 'Related Products' :
			$translated_text = __( 'Check out these related products', 'woocommerce' );
			break;
	}
	return $translated_text;
}

add_filter( 'gettext', 'my_text_strings', 20, 3 );
