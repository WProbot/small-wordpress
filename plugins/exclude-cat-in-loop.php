
function remove_home_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-4' );
    }
}

add_action( 'pre_get_posts', 'remove_home_category' );
