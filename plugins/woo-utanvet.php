
  function custom_handling_fee ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
      return;
    }
    if ( 'cod' === WC()->session->get('chosen_payment_method') ) {
      $fee = 123;
      $cart->add_fee( 'Utánvét', $fee, true );
    }
  }


  add_action( 'woocommerce_cart_calculate_fees', 'custom_handling_fee', 10, 1 );


