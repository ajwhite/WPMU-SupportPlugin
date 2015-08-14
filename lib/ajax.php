<?php

namespace Atticoos\Plugins\MultisiteSupport\Ajax;
use Atticoos\Plugins\MultisiteSupport\Services\SiteModeratorSupportService;

function compose_site_moderator_ticket() {
  $service = new SiteModeratorSupportService();
  $service->createTicket($_POST['title'], $_POST['message']);
}
add_action('wp_ajax_composeSiteModeratorTicket', __NAMESPACE__ . '\\compose_site_moderator_ticket');