<?php
namespace Atticoos\Plugins\MultisiteSupport\Services;

class AbstractSupportService {
  const POST_TYPE = 'support_ticket';

  abstract public function createTicket();
  abstract public function getTickets();
  abstract public function getTicket($id);
}
