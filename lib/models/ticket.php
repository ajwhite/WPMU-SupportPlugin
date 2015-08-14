<?php
namespace Atticoos\Plugins\MultisiteSupport\Models;

class SupportTicket {
  public $assignee;
  public $thread;

  public function __construct ($postId, $siteId = null) {
    if ($siteId) {
      switch_to_blog($siteId);
    }
    $this->post = get_post($postId);
    $this->thread = get_children(array(
      'post_parent' => $postId,
      'order' => 'asc'
    ));
    foreach ($this->thread as $key=>$message) {
      $this->thread[$key]->author = get_user_by('id', $message->post_author);
    }

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
