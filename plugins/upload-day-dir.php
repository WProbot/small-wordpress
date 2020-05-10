
  function fixer9_upload_dir_filter($uploads) {
    $day = date('d');
    $uploads['path'] .= '/' . $day;
    $uploads['url']  .= '/' . $day;
    return $uploads;
  }

  add_filter('upload_dir','fixer9_upload_dir_filter');

