<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;

class SiteModeratorSupportService extends AbstractSupportService {
  public function createTicket($title, $content) {
    wp_insert_post(array(
      'post_title' => $title,
      'post_content' => $content,
      'post_type' => self::POST_TYPE
    ))
  }

  public function getTickets() {
    return array();
  }

  public function getTicket($id) {
    return null;
  }
}
