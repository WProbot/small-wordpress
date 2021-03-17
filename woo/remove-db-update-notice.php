<?php

function woocommerce_set_database_update_notice_as_actioned() {
    // Bail if WoocCommerce notes class is not present.
    if ( ! class_exists( 'WC_Notes_Run_Db_Update' ) ) {
        return;
    }

    $woocommerce_notes_db = new WC_Notes_Run_Db_Update();
    $woocommerce_notes_db->set_notice_actioned();
}

add_action( 'admin_notices', 'woocommerce_set_database_update_notice_as_actioned' );

