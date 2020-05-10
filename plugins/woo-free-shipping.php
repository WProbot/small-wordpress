

function fixerv9_shipping( $rates ) {

  $free = array();

  foreach ( $rates as $rate_id => $rate ) {
    if ( 'free_shipping' === $rate->method_id ) {
      $free[ $rate_id ] = $rate;
    }
    if ( 'local_pickup' === $rate->method_id ) {
      $lpid = $rate_id;
      $lpr  = $rate;
    }
  }

  if( ! empty( $free ) && isset( $lpid ) ) {
       $free[ $lpid ] = $lpr;
  }

  return ! empty( $free ) ? $free : $rates;
}

add_filter( 'woocommerce_package_rates', 'fixerv9_shipping', 100 );


