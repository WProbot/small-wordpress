
  // => mu-plugins


  add_filter( 'option_active_plugins', function( $plugins ){

    $request_uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );

    $is_admin = strpos( $request_uri, '/wp-admin/' );

    if ( $is_admin ) {

      unset( $plugins['plugin-slug'] );

    }

    return $plugins;

  });


