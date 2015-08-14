<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;

abstract class AbstractSupportService {
  const POST_TYPE = 'support_ticket';

  abstract public function createTicket($title, $content);
  abstract public function getTickets();
  abstract public function getTicket($id, $site=null);
}
