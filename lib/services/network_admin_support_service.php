<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;
use Atticoos\Plugins\MultisiteSupport\Models\NetworkSupportTicket;
use WP_Query;

class NetworkAdminSupportService extends AbstractSupportService {
  public function createTicket($title, $content) {

  }

  public function getTickets() {
    $tickets = array();
    $sites = wp_get_sites();
    foreach ($sites as $site) {
      switch_to_blog($site['blog_id']);

      $query = new WP_Query(array(
        'post_type' => self::POST_TYPE
      ));

      while ($query->have_posts()) {
        $query->the_post();
        $tickets[] = new NetworkSupportTicket(get_the_ID(), $site['blog_id']);
      }
    }
    restore_current_blog();
    return $tickets;
  }

  public function getTicket($id, $site=null) {
    $ticket = new NetworkSupportTicket($id, $site);
    return $ticket;
  }
}
