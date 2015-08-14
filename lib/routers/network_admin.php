<?php

namespace Atticoos\Plugins\MultisiteSupport\Routers;

class NetworkAdminRouter {
  const VIEW = 'view';
  const VIEW_DIRECTORY = '../views/network_admin';

  public static function route($action) {
    switch ($action) {
      case self::VIEW:
        self::loadViewRoute();
        break;
      default:
        self::loadListRoute();
        break;
    }
  }

  private static function loadListRoute() {
    include(__DIR__ . '/' . self::VIEW_DIRECTORY . '/list.php');
  }

  private static function loadViewRoute() {
    include(__DIR__ . '/' . self::VIEW_DIRECTORY . '/view.php');
  }
}
