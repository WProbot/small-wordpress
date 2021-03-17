<?php

function register_awaiting_shipment_order_status() {
    
    //register_post_status - first para lenght limit is 20
    register_post_status( 'wc-awaiting-shipment', array(
        'label'                     => 'Awaiting shipment',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Awaiting shipment <span class="count">(%s)</span>', 'Awaiting shipment <span class="count">(%s)</span>' )
    ) );
   
    
    register_post_status( 'wc-awaiting-ship', array(
        'label'                     => 'Awaiting ship',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Awaiting ship <span class="count">(%s)</span>', 'Awaiting ship <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_awaiting_shipment_order_status' );

// Add to list of WC Order statuses
function add_awaiting_shipment_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        //add two custom status after processing status
        if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-awaiting-shipment'] = 'Awaiting shipment';
            $new_order_statuses['wc-awaiting-ship'] = 'Awaiting ship';
        }
    }

    return $new_order_statuses;
}

add_filter( 'wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );



/
function register_my_bulk_actions( $bulk_actions ) {
	$bulk_actions['wc-awaiting-shipment'] = __( 'Custom Bulk Action-awaiting-shipment', 'domain' );
	$bulk_actions['wc-awaiting-ship'] = __( 'Custom Bulk Action-awaiting-ship', 'domain' );
	return $bulk_actions;
}

add_filter( 'bulk_actions-edit-shop_order', 'register_my_bulk_actions' );



function my_bulk_action_handler( $redirect_to, $action, $post_ids ) {
	if ( ! in_array($action, array('wc-awaiting-shipment', 'wc-awaiting-ship'))) {
		return $redirect_to;
	}

	foreach ( $post_ids as $post_id ) {
		wp_update_post( array(
			'ID'          => $post_id,
			'post_status' => $action,
		) );
	}

	$redirect_to = add_query_arg( 'bulk_draft_posts', count( $post_ids ), $redirect_to );

	return $redirect_to;
}

add_filter( 'handle_bulk_actions-edit-shop_order', 'my_bulk_action_handler', 10, 3 );


function my_bulk_action_admin_notice() {
	if ( ! empty( $_REQUEST['bulk_draft_posts'] ) ) {
		$drafts_count = intval( $_REQUEST['bulk_draft_posts'] );

		printf(
			'<div id="message" class="updated fade">' .
			_n( '%s post moved to drafts.', '%s posts moved to drafts.', $drafts_count, 'domain' )
			. '</div>',
			$drafts_count
		);
	}
}

add_action( 'admin_notices', 'my_bulk_action_admin_notice' );

