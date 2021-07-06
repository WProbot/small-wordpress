<?php


  function fixer_remove_post_dates() {
    add_filter('the_date', '__return_false  add_filter('the_time', '__return_false');
    add_filter('the_modified_date', '__return_false');
  } 

  add_action('loop_start', 'fixer_remove_post_dates');

