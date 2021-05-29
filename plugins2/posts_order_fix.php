<?php

function posts_order_fix() {
    add_post_type_support( 'post', 'page-attributes' );
}

add_action( 'admin_init', 'posts_order_fix' );
