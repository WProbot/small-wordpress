

  add_action('admin_footer', 'fixerv9_admin_style');

  function fixerv9_admin_style() {

    echo '<style>'
       .   '.wp_xxx_style { display: none; }'
       . '</style>'
    ;

  }


