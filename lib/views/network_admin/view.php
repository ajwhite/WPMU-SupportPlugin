<?php
use Atticoos\Plugins\MultisiteSupport\Services\NetworkAdminSupportService;
$service = new NetworkAdminSupportService()
$ticket = $service->getTicket($_REQUEST['post'], $_REQUEST['site']);
?>
