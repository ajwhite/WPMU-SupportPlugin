<?php
/**
 * Plugin Name: Multisite Support
 * Description: Allows multisite instances to have support access with the network admins
 * Version: 1.0
 * Author: Atticus White
 * Author URI: http://atticuswhite.com
 */

$includes = array(
  'lib/init.php',
  'lib/services/abstract_support_service.php',
  'lib/services/network_admin_support_service.php',
  'lib/services/site_moderator_support_service.php',
  'lib/tables/site_moderator_table.php',
  'lib/tables/network_admin_table.php',
  'lib/routers/site_moderator.php',
  'lib/routers/network_admin.php',
  'lib/models/ticket.php',
  'lib/models/network_ticket.php',
  'lib/ajax.php'
);

foreach ($includes as $file) {
  require_once($file);
}

// cleanup global vars
unset($file);
