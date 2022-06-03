<?php
use Drupal\owlcarousel\OwlCarouselView;
use Drupal\Component\Serialization\Json;
use Drupal\owlcarousel\OwlCarouselGlobal;
use Drupal\Core\Template\Attribute;

/**
 * Prepares variables for views carousel template.
 *
 * Default template: views-bootstrap-carousel.html.twig.
 *
 * @param array $vars
 *        An associative array containing:
 *        - view: A ViewExecutable object.
 *        - rows: The raw row data.
 */
function template_preprocess_owlcarousel_views(array &$vars) {
  $wrappers_attributes = new Attribute();
  $view = $vars['view'];
  $handler = $vars['view']->style_plugin;
  $settings = $handler->options;
  // $settingsOwl = OwlCarouselGlobal::cleanSettings($settings);
  $settingsOwl = OwlCarouselGlobal::formatSettings($settings['owl_settings']);
  // dump($settings);
  $vars['id'] = OwlCarouselView::getUniqueId($view);
  $vars['attributes']['class'][] = 'owl-carousel';
  $vars['attributes']['class'][] = 'owl-theme';
  $vars['attributes']['id'] = $vars['id'];
  $vars['#attached']['library'][] = 'owlcarousel/owlcarousel_config';
  // Config set for owlcarousel.
  // This is then accessible in JS via drupalSettings.
  $vars['#attached']['drupalSettings']['owlcarousel_views'][$vars['id']] = Json::encode($settingsOwl);
  if (!empty($settings['layoutgenentitystyles_view'])) {
    $class = explode("/", $settings['layoutgenentitystyles_view']);
    $wrappers_attributes->addClass($class);
  }
  $wrappers_attributes->addClass($settings['owl_class']);
  $vars['wrappers_attributes'] = $wrappers_attributes;
}
