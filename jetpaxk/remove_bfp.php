function jetpackcom_rm_jp_dashboard_stats_admins() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die();
	}
}

add_action( 'jetpack_dashboard_widget', 'jetpackcom_rm_jp_dashboard_stats_admins', 1 );
