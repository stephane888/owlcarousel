<?php

namespace Drupal\owlcarousel\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\owlcarousel\OwlCarouselGlobal;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\layoutgenentitystyles\Services\LayoutgenentitystylesServices;

/**
 * Style plugin to render each item into owl carousel.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "owlcarousel",
 *   title = @Translation("OwlCarousel"),
 *   help = @Translation("Displays rows as OwlCarousel."),
 *   theme = "owlcarousel_views",
 *   display_types = {"normal"}
 * )
 */
class OwlCarouselViews extends StylePluginBase {
  
  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;
  
  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;
  
  /**
   *
   * @var LayoutgenentitystylesServices
   */
  protected $LayoutgenentitystylesServices;
  
  // function __construct($configuration, $plugin_id, $plugin_definition,
  // ExtensionPathResolver $ExtensionPathResolver) {
  // parent::__construct($configuration, $plugin_id, $plugin_definition);
  // $this->ExtensionPathResolver = $ExtensionPathResolver;
  // }
  
  /**
   *
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->LayoutgenentitystylesServices = $container->get('layoutgenentitystyles.add.style.theme');
    return $instance;
  }
  
  /**
   * Set default options.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['owl_settings'] = [
      'default' => OwlCarouselGlobal::defaultSettings()
    ];
    
    $options['layoutgenentitystyles_view'] = [
      'default' => ''
    ];
    $options['owl_class'] = [
      'default' => ''
    ];
    
    return $options;
  }
  
  public function submitOptionsForm(&$form, FormStateInterface $form_state) {
    parent::submitOptionsForm($form, $form_state);
    // On recupere la valeur de la librairie et on ajoute:
    
    $library = $form_state->getValue([
      'style_options',
      'layoutgenentitystyles_view'
    ]);
    if (!empty($library)) {
      $this->LayoutgenentitystylesServices->addStyleFromView($library, $this->view->id(), $this->view->current_display);
    }
  }
  
  /**
   * Render the given style.
   *
   * @see \Drupal\views\Plugin\views\PluginBase::setOptionDefaults for more
   *      informations
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    
    $form['default_options'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use default settings'),
      '#description' => $this->t('By selecting this the default settings will be used and overwrite your custom settings.'),
      '#default_value' => $this->options['default_options']
    ];
    
    $form['owl_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Custom settings')
    ];
    
    $form['owl_settings']['items'] = [
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('Maximum amount of items displayed at a time with the widest browser width.'),
      '#default_value' => $this->options['owl_settings']['items']
    ];
    
    $form['owl_settings']['itemsDesktop'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemsDesktop'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_settings']['itemsDesktop']
    ];
    
    $form['owl_settings']['itemsDesktopSmall'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemsDesktopSmall'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_settings']['itemsDesktopSmall']
    ];
    
    $form['owl_settings']['itemsTablet'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemsTablet'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_settings']['itemsTablet']
    ];
    
    $form['owl_settings']['itemsMobile'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemsMobile'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_settings']['itemsMobile']
    ];
    
    $form['owl_settings']['itemsSmallMobile'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemsSmallMobile'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_settings']['itemsSmallMobile']
    ];
    
    $form['owl_settings']['margin'] = [
      '#type' => 'number',
      '#title' => $this->t('Margin (px)'),
      '#default_value' => $this->options['owl_settings']['margin']
    ];
    
    $form['owl_settings']['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Loop'),
      '#default_value' => $this->options['owl_settings']['loop'],
      '#description' => $this->t('Infinity loop. Duplicate last and first items to get loop illusion.')
    ];
    
    $form['owl_settings']['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Center'),
      '#description' => $this->t('Center item. Works well with even an odd number of items.'),
      '#default_value' => $this->options['owl_settings']['center']
    ];
    
    $form['owl_settings']['mouseDrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $this->options['owl_settings']['mouseDrag']
    ];
    $form['owl_settings']['autoPlay'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('autoPlay'),
      '#default_value' => $this->options['owl_settings']['autoPlay']
    ];
    $form['owl_settings']['nav'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show next/prev buttons'),
      '#default_value' => $this->options['owl_settings']['nav']
    ];
    $form['owl_settings']['dots'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show dots navigation'),
      '#default_value' => $this->options['owl_settings']['dots']
    ];
    
    $form['owl_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('class container owl'),
      '#description' => $this->t(''),
      '#default_value' => $this->options['owl_class']
    ];
    
    $form['layoutgenentitystyles_view'] = [
      '#type' => 'select',
      '#title' => $this->t('Custom theme'),
      '#options' => OwlCarouselGlobal::defaultThemes(),
      '#default_value' => $this->options['layoutgenentitystyles_view'],
      '#empty_option' => '- Select -'
    ];
  }
  
}
