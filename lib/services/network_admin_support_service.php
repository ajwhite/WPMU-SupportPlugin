<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;
use WP_Query;

class NetworkAdminSupportService extends AbstractSupportService {
  public function createTicket($title, $content) {

  }

  public function getTickets() {
    $tickets = array();
    $query = new WP_Query(array(
      'post_type' => self::POST_TYPE
    ));

    while ($query->have_posts()) {
      $query->the_post();
      $tickets[] = array(
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'message' => get_the_content()
      );
    }
    return $tickets;
  }

  public function getTicket($id) {
    return null;
  }
}
