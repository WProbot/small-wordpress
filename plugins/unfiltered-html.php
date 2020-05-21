
function add_unfiltered_html_capability( $caps, $cap, $user_id ) {
	if ( 'unfiltered_html' === $cap && user_can( $user_id, 'editor' ) ) {
		$caps = array( 'unfiltered_html' );
	}
	return $caps;
}

add_filter( 'map_meta_cap', 'add_unfiltered_html_capability', 1, 3 );
