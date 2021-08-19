<?php

//
//  /wp-content/mu-plugins/404.php
//

  function wpd_on_404(){
    if( is_404() ){
      header("HTTP/1.1 302 Found");
      header("Location: " . get_bloginfo('url'));
      exit();
    }
  }

  add_action( 'template_redirect', 'wpd_on_404' );


