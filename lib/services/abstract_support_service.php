<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;

abstract class AbstractSupportService {
  const POST_TYPE = 'support_ticket';

  abstract public function createTicket($title, $content);
  abstract public function getTickets();
  abstract public function getTicket($id, $site=null);

  public function respondToTicket($id, $message, $site=null) {
    $args = array(
      'post_title' => 'Response to ticket ' . $id,
      'post_content' => $message,
      'post_parent' => $id
    );
    if ($site) {
      switch_to_blog($site);
    }
    $id = wp_insert_post($args);

    if ($site) {
      restore_current_blog();
    }
    return $id;
  }
}
