<?php

namespace Atticoos\Plugins\MultisiteSupport\Routers;

class SiteModeratorRouter {
  const CREATE = 'create';
  const VIEW_DIRECTORY = '../views/site_moderator';

  public static function route($action) {
    switch ($action) {
      case self::CREATE:
        self::loadCreateRoute();
        break;
      default:
        self::loadListRoute();
        break;
    }
  }

  private static function loadCreateRoute() {
    include(__DIR__ . '/' . self::VIEW_DIRECTORY . '/create.php');
  }

  private static function loadListRoute() {
    include(__DIR__ . '/' . self::VIEW_DIRECTORY . '/list.php');
  }
}
