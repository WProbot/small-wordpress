
  function fixer9_change_text($translation, $text) {
    if($text == 'fromtext') {
      return    'totext';
    } else {
      return $translation;
    }
  }


  add_filter('gettext', 'fixer9_change_text', 10, 2);


