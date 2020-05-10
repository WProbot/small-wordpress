

function load_external_api( $atts ) {

  $url = 'https:// .... api url';

  $request = wp_remote_get($url, array(
    'timeout' => 120,
    'headers' => array(
      'AccessToken'  => 'XXXXX',
      'Content-Type' => 'application/json',
     ),
  ));


  if ( is_array( $response ) && ! is_wp_error( $response ) ) {

    $headers = $response['headers'];
    $body    = $response['body'];

    $api = json_decode( $body, true );

    return  var_export( $api, true );

  }


add_shortcode( 'shortcodename', 'load_external_api' );

