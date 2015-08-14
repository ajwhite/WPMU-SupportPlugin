<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;
use Atticoos\Plugins\MultisiteSupport\Models\SupportTicket;
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
        $tickets[] = array(
          'id' => get_the_ID(),
          'title' => get_the_title(),
          'message' => get_the_content(),
          'site' => array(
            'id' => $site['blog_id'],
            'url' => get_blog_option($site['blog_id'], 'siteurl'),
            'name' => get_blog_option($site['blog_id'], 'blogname'),
          )
        );
      }
    }
    restore_current_blog();
    return $tickets;
  }

  public function getTicket($id, $site) {
    $ticket = array();
    switch_to_blog($site);

    $post = get_post($id);



    restore_current_blog();
    return null;
  }
}
