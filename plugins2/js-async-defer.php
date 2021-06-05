
function fx9_script_loader_async_defer( $tag, $handle, $src ) {

    $async = array(
        'recaptcha',
        'adsense',
    );

    $defer = array(
        'facebook',
    );

    if ( ! fx9_tag_has_attribute( $tag, 'async' ) ) {
        foreach ( $async as $partial ) {
            if ( strpos( $src, $partial ) !== false ) {
                $tag = str_replace( '<script ', '<script async ', $tag );
            }
        }
    }

    if ( ! fx9_tag_has_attribute( $tag, 'defer' ) ) {
        foreach ( $defer as $partial ) {
            if ( strpos( $src, $partial ) !== false ) {
                $tag = str_replace( '<script ', '<script defer ', $tag );
            }
        }
    }

    return $tag;
}

function fx9_tag_has_attribute( $tag, $attr ) {
    return strpos( $tag, " $attr " ) !== false || strpos( $tag, " $attr>" ) !== false || strpos( $tag, " $attr=" ) !== false;
}

add_filter('script_loader_tag', 'fx9_script_loader_async_defer', 15, 3);
