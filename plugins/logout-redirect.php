<?php

add_action('wp_logout','redirect_after_logout');

function redirect_after_logout(){
  if( is_admin() ) {
    wp_redirect( home_url() );
    exit();
  }
}
