<?php


namespace Drupal\owlcarousel;


use Drupal\Component\Utility\Html;
use Drupal\views\ViewExecutable;

class OwlCarouselView {

  public static function getUniqueId(ViewExecutable $view) {
    $id = $view->storage->id() . '-' . $view->current_display;

    return Html::getUniqueId('owlcarousel-views-' . $id);
  }
}