<?php
namespace Atticoos\Plugins\MultisiteSupport\Models;

class NetworkSupportTicket extends SupportTicket {
  private $site;

  public function __construct($postId, $siteId) {
    parent::__construct($postId, $siteId);
    $this->site = array(
      'id' => $siteId,
      'url' => get_blog_option($siteId, 'siteurl'),
      'name' => get_blog_option($siteId, 'blogname')
    );
  }
}
