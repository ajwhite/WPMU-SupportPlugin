<?php

namespace Atticoos\Plugins\MultisiteSupport\Routers;

class NetworkAdminRouter {
  const VIEW_DIRECTORY = '../views/network_admin';

  public static function route($action) {
    switch ($action) {
      default:
        self::loadListRoute();
        break;
    }
  }

  private static function loadListRoute() {
    include(__DIR__ . '/' . self::VIEW_DIRECTORY . '/list.php');
  }
}
