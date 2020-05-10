
  add_filter( 'ajax_query_attachments_args', 'mrfx_show_current_user_attachments' );

  function mrfx_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('administrator') && !current_user_can('editor') ) {
        $query['author'] = $user_id;
    }
    return $query;
  }



