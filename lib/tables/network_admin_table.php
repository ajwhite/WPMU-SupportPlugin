<?php
namespace Atticoos\Plugins\MultisiteSupport\Tables;
use Atticoos\Plugins\MultisiteSupport\Services\NetworkAdminSupportService;
use Atticoos\Plugins\MultisiteSupport\Models\NetworkSupportTicket;

if(!class_exists('WP_List_Table')){
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

use WP_List_Table;

class NetworkAdminSupportTicketTable extends WP_List_Table {
  private $service;

  public function __construct() {
    parent::__construct(array(
      'singular' => 'Support Ticket',
      'plural' => 'Support Tickets',
      'ajax' => false
    ));
    $this->service = new NetworkAdminSupportService();
  }

  public function get_columns() {
    return array(
      'cb' => '<input type="checkbox" />',
      'message_title' => 'Title',
      'message_count' => 'Replies',
      'message_site' => 'Site',
      'message_from' => 'From',
      'message_assignee' => 'Assignee',
      'message_date' => 'Date'
    );
  }

  public function get_views() {
    return array(
      'all' => '<a href="#">All</a>',
      'opened' => '<a href="#">Opened</a>',
      'closed' => '<a href="#">Closed</a>'
    );
  }

  public function column_cb($item) {
    return "<input type=\"checkbox\" name=\"ticket[]\" value=\"{$item->id}\" />";
  }

  public function column_message_title($item) {
    $title = $item->getSubject();
    // if (!$item->read) {
    //   $title = "<strong>{$item->title}</strong>";
    // } else {
    //   $title = $item->title;
    // }
    $actions = array(
      'view' => "<a href=\"?page={$_REQUEST['page']}&action=view&post={$item->getId()}&site={$item->site['id']}\">View</a>",
      'resolve' => "<a href=\"?page={$_REQUEST['page']}&action=resolve&post={$item->getId()}\">Mark as Resolved</a>"
    );
    return $title . $this->row_actions($actions, false);
  }

  public function column_message_site($item) {
    return $item->site['name'];
  }

  public function column_message_count() {
    return 3;
  }

  public function column_message_assignee() {
    return 'Atticus';
  }

  public function column_message_from($item) {
    return 'Mark';
    $name = $item->from['name'];
    $email = "<a href=\"mailto:{$item->from['email']}\">{$item->from['email']}</a>";
    return $name . "<br/>" . $email;
  }

  public function column_message_date($item) {
    return 'August 13, 2015';
    return $item->getDate();
  }

  public function get_sortable_columns() {
    return array(
      'message_title' => array('message_title', false)
    );
  }

  public function get_bulk_actions() {
    return array(
      'delete' => 'Delete'
    );
  }

  public function prepare_items() {
    $this->_column_headers = array($this->get_columns(), array(), array());
    $this->items = $this->service->getTickets();
    $this->set_pagination_args(array(
      'total_items' => count($this->items),
      'per_page' => 10
    ));
  }
}
