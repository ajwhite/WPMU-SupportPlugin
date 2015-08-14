<?php

namespace Atticoos\Plugins\MultisiteSupport\Init;
use Atticoos\Plugins\MultisiteSupport\Routers\SiteModeratorRouter;

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

function register_site_moderator_menus() {
  add_menu_page(
    'Support',
    'Support',
    'manage_options',
    'moderator_support_tickets',
    __NAMESPACE__ . '\\render_site_moderator_page',
    'dashicons-format-status'
  );
}
add_action('admin_menu', __NAMESPACE__ . '\\register_site_moderator_menus');

function register_network_admin_menus() {
  add_menu_page(
    'Support',
    'Support',
    'manage_options',
    'admin_support_tickets',
    __NAMESPACE__ . '\\render_network_admin_page',
    'dashicons-format-status'
  );
}
add_action('network_admin_menu', __NAMESPACE__ . '\\register_network_admin_menus');

function render_site_moderator_page() {
  SiteModeratorRouter::route($_REQUEST['action']);
}

function render_network_admin_page() {
  include('views/network_admin/list.php');
}
