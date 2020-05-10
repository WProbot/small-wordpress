

  function remove_wc_page_noindex(){
    remove_action( ‘wp_head’, ‘wc_page_noindex’ );
  }

  add_action( ‘init’, ‘remove_wc_page_noindex’ );


