<?php
namespace Atticoos\Plugins\MultisiteSupport\Models;

class SupportTicket {
  public $assignee;
  public $thread;
  private $post;

  public function __construct ($postId, $siteId = null) {
    if ($siteId) {
      switch_to_blog($siteId);
    }
    $this->post = get_post($postId);
    $this->post->author = get_user_by('id', $this->post->post_author);
    $this->thread = get_children(array(
      'post_parent' => $postId,
      'order' => 'asc'
    ));
    foreach ($this->thread as $key=>$message) {
      $this->thread[$key]->author = get_user_by('id', $message->post_author);
    }

    $assigneeId = get_post_meta($postId, 'assignee', true);
    if ($assigneeId) {
      $this->assignee = get_user_by('id', $assigneeId);
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

  public function getAuthor() {
    return $this->post->author;
  }

  public function hasAssignee() {
    return !empty($this->assignee);
  }

  public function getAssignee() {
    return $this->assignee;
  }
}
