
  function last_modified_header() {
    global $post;
    if(isset($post) && is_single()){
      $timestamp = strtotime($post->post_date_gmt);
      if(isset($post->post_modified)) {
        $timestamp = strtotime($post->post_modified);
      }
      $date = date("D, d M Y H:i:s", $timestamp);  // format podle RFC 2822
      header("Last-Modified: " . $date . " GMT");
    }
  }

  add_action('wp', 'last_modified_header');

