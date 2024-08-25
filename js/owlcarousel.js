/**
 * @file
 * OwlCarousel Drupal JS.
 */
(function ($, Drupal, drupalSettings) {
  "use strict";
  /**
   * OwlCarousel views js.
   * @type {{attach: Drupal.behaviors.owlcarousel_views.attach}}
   */
  Drupal.behaviors.owlcarousel_views = {
    attach: function (context, settings) {
      // Declare the owlcarousel views settings object.
      const owlCarouselViews = drupalSettings.owlcarousel_views;
      // console.log("owlCarouselViews : ", owlCarouselViews);
      // Loop the carousel object and output settings into our carousel.
      for (const item in owlCarouselViews) {
        if ($("#" + item, context)[0]) {
          const thisSettings = JSON.parse(owlCarouselViews[item]);
           console.log(thisSettings);
          $("#" + item, context).owlCarousel(thisSettings);
        }
      }
    },
  };
})(jQuery, Drupal, drupalSettings);
