<?php

namespace Drupal\owlcarousel;

class OwlCarouselGlobal {
  
  /**
   * Default settings for owl.
   */
  public static function defaultSettings($key = NULL) {
    $settings = [
      'items' => 5,
      'itemsDesktop' => '[1199,4]',
      'itemsDesktopSmall' => '[979,3]',
      'itemsTablet' => '[768,2]',
      'itemsMobile' => '[575,1]',
      'itemsSmallMobile' => '[400,1]',
      'singleItem' => FALSE,
      'itemsScaleUp' => FALSE,
      // 'slideSpeed' => 200,
      // 'paginationSpeed' => 800,
      // 'rewindSpeed' => 1000,
      'autoPlay' => FALSE,
      'stopOnHover' => FALSE,
      // prevText'prevText' => t('prev')->render(),
      // 'nextText' => t('next')->render(),
      // 'rewindNav' => TRUE,
      // 'scrollPerPage' => FALSE,
      'pagination' => TRUE,
      
      'responsiveRefreshRate' => 200,
      'mouseDrag' => TRUE,
      'touchDrag' => TRUE,
      'responsiveClass' => true,
      'margin' => 10,
      'center' => true,
      'loop' => true,
      'nav' => true,
      'dots' => true
    ];
    return isset($settings[$key]) ? $settings[$key] : $settings;
  }
  
  public static function defaultThemes($key = null) {
    $themes = [
      'owlcarousel/owl-default' => 'Theme default',
      'owlcarousel/owl-rc-web' => 'Theme rc-web',
      'owlcarousel/owl-rc-web-container' => 'Theme rc-web with container'
    ];
    return isset($themes[$key]) ? $themes[$key] : $themes;
  }
  
  /**
   *
   * @param array $settings
   * @return array []
   */
  public static function cleanSettings(Array $settings) {
    $news = [];
    $defaulSettings = self::defaultSettings();
    foreach ($settings as $k => $value) {
      if (isset($defaulSettings[$k]))
        $news[$k] = $value;
    }
    return $news;
  }
  
  /**
   * Return formatted js array of settings.
   */
  public static function formatSettings($settings) {
    $settings['items'] = (int) $settings['items'];
    $settings['responsive'] = [];
    $settings['itemsSmallMobile'] = _owlcarousel_string_to_array($settings['itemsSmallMobile']);
    $v = $settings['itemsSmallMobile'];
    $settings['responsive'][0]['items'] = (int) $v[1];
    unset($settings['itemsSmallMobile']);
    //
    $settings['itemsMobile'] = _owlcarousel_string_to_array($settings['itemsMobile']);
    $v = $settings['itemsMobile'];
    $settings['responsive'][(int) $v[0]]['items'] = (int) $v[1];
    unset($settings['itemsMobile']);
    //
    $settings['itemsTablet'] = _owlcarousel_string_to_array($settings['itemsTablet']);
    $v = $settings['itemsTablet'];
    $settings['responsive'][(int) $v[0]]['items'] = (int) $v[1];
    unset($settings['itemsTablet']);
    //
    $settings['itemsDesktopSmall'] = _owlcarousel_string_to_array($settings['itemsDesktopSmall']);
    $v = $settings['itemsDesktopSmall'];
    $settings['responsive'][(int) $v[0]]['items'] = (int) $v[1];
    unset($settings['itemsDesktopSmall']);
    //
    $settings['itemsDesktop'] = _owlcarousel_string_to_array($settings['itemsDesktop']);
    $v = $settings['itemsDesktop'];
    $settings['responsive'][(int) $v[0]]['items'] = (int) $v[1];
    unset($settings['itemsDesktop']);
    //
    $settings['mouseDrag'] = (bool) $settings['mouseDrag'];
    $settings['pagination'] = (bool) $settings['pagination'];
    // $settings['responsive'] = (bool) $settings['responsive'];
    // $settings['paginationSpeed'] = (int) $settings['paginationSpeed'];
    $settings['responsiveRefreshRate'] = (int) $settings['responsiveRefreshRate'];
    // $settings['rewindNav'] = (bool) $settings['rewindNav'];
    // $settings['rewindSpeed'] = (int) $settings['rewindSpeed'];
    // $settings['scrollPerPage'] = (bool) $settings['scrollPerPage'];
    $settings['margin'] = (int) $settings['margin'];
    $settings['center'] = (bool) $settings['center'];
    $settings['touchDrag'] = (bool) $settings['touchDrag'];
    $settings['loop'] = (bool) $settings['loop'];
    $settings['autoPlay'] = (bool) $settings['autoPlay'];
    return $settings;
  }
  
}