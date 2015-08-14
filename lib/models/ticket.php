<?php
namespace Atticoos\Plugins\MultisiteSupport\Models;

class SupportTicket {
  private $assignee;
  private $threads;

  public function __construct ($postId, $siteId = null) {
    if ($siteId) {
      switch_to_blog($siteId);
    }
    $this->post = get_post($postId);
    if ($siteId) {
      restore_current_blog();
    }
  }

  public function getId() {
    return $this->post->ID;
  }

  public function getSubject() {
    return $this->post->post_title;
  }

  public function getDescription() {
    return $this->post->post_content;
  }

  public function hasSeen() {
    return false;
  }
}
