
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
});

add_filter('wp_update_attachment_metadata', function( $data ) {
    if ( isset( $data['thumb'] ) ) {
        $data['thumb'] = basename($data['thumb']);
    }

    return $data;
});

add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) )
        unset( $endpoints['/wp/v2/users'] );

    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) )
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );

    return $endpoints;
});

add_filter('xmlrpc_enabled', '__return_false');

add_filter('mod_rewrite_rules', function( $rules ) {

    $insert_before_wp_defaults = [
        '<IfModule mod_rewrite.c>',
        '  RewriteEngine On',
        '  RewriteBase /',
        '  RewriteRule \.(?:psd|log|cmd|exe|bat|c?sh)$ - [NC,F]',
        '  RewriteRule (?:readme|license|changelog|-config|-sample)\.(?:php|md|txt|html?) - [R=404,NC,L]',
        '</IfModule>',
    ];

    $insert_before_wp_defaults = implode("\n", $insert_before_wp_defaults) . "\n\n";

    return $insert_before_wp_defaults . $rules;

});

