<?php
namespace Atticoos\Plugins\MultisiteSupport\Models;

class SupportTicket {
  const META_KEY_PRIORITY = 'priority';
  const META_KEY_ASSIGNEE = 'assignee';
  const META_KEY_CATEGORY = 'category'; // @TODO change to taxonomy

  public $assignee;
  public $thread;
  private $post;
  private $priority;
  private $category;

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

    $assigneeId = get_post_meta($postId, self::META_KEY_ASSIGNEE, true);
    if ($assigneeId) {
      $this->assignee = get_user_by('id', $assigneeId);
    }

    $this->priority = get_post_meta($postId, self::META_KEY_PRIORITY, true);
    $this->category = get_post_meta($postId, self::META_KEY_CATEGORY, true);
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

  public function getPriority() {
    return $this->priority;
  }

  public function getCategory() {
    return $this->category;
  }
}
