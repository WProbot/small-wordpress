<?php
/*
Plugin Name: Only Manage Your Posts
Version: 0.2
Plugin URI: http://code.mincus.com/41/manage-your-posts-only-in-wordpress/
Description: Makes it so normal users can see only their posts and drafts from the manage posts screen.  Great for multi-user blogs where you want users to only see posts that they have created.
Author: Patrick Rauland
Author URI: http://www.patrickrauland.com/
*/


/**
 * omyp_parse_query_useronly parse the query to only show one author
 * @since 	0.1
 * @param 	object $wp_query 
 */
function omyp_parse_query_useronly( $wp_query ) 
{
	// first check if we're on the right page
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) 
    {
    	// check to make sure the user doesn't have administrative capabilities
        if ( !current_user_can( 'edit_others_posts' ) ) 
        {
        	// if the user doesn't have administrative queries then limit the query to just that user
            global $current_user;
            $wp_query->set( 'author', $current_user->id );

            // add an action here so we can execute other functions
            do_action('omyp_restricting_by_author');
        }
    }
}

/**
 * omyp_parse_query_useronly add css for the show only one users' posts interface
 * @since 	0.2
 */
function omyp_useronly_assets( ) 
{
	// add some css
	wp_register_style( 'omyp_useronly_styles', plugins_url('assets/style.css', __FILE__) );
	wp_enqueue_style( 'omyp_useronly_styles' );
}

add_filter('parse_query', 'omyp_parse_query_useronly' );
add_action('omyp_restricting_by_author', 'omyp_useronly_assets')
?>
