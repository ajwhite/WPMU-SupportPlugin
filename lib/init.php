<?php

namespace SandersForPresident\Plugins\MultisiteSupport\Init;

function custom_post_types() {
  $args = array(
    'labels' => array(
      'name' => 'Support Tickets',
      'singular_name' => 'Support Ticket'
    ),
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => false,
    'show_in_menu' => false,
    'query_var' => false
  );
  register_post_type('support_ticket', $args);
}
add_action('init', __NAMESPACE__ . '\\custom_post_types');
