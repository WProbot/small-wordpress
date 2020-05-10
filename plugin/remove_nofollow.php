
  function remove_nofollow($string) {
    $string = str_ireplace(' rel="nofollow"', '', $string);
    return $string;
  }

  add_filter('the_content', 'remove_nofollow');

