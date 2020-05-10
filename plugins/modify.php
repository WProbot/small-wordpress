
add_filter('wp_mail','redirect_mails', 10,1);

  function redirect_mails($args) {

    $to = $args['to'];

    // $args['subject']
    // $args['message']
    // $args['headers']
    // $args['attachments']

    $user = get_user_by( 'email', $to);
    $_role = get_user_meta($user->ID, 'my_custom_role', true);
    if ($role == 'opportunity-owner') {
      $test_mentor_email = get_option('test_mentor_email');
      if ($test_mentor_email != '') {
        $to = $test_mentor_email;
      }
    }
    $args['to']=$to;
    return $args;
  }

