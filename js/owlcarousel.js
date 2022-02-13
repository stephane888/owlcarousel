/**
 * @file
 * OwlCarousel Drupal JS.
 */
(function ($, Drupal, drupalSettings) {
  "use strict";
  // @todo: Currently this is breaking JS in Drupal.
  Drupal.behaviors.owl = {
    attach: function (context, settings) {
      // $('.owl-slider-wrapper', context).each(function () {
      //     var $this = $(this);
      //     var $this_settings = $.parseJSON($this.attr('data-settings'));
      //     $this.owlCarousel($this_settings);
      // });
    },
  };

  /**
   * OwlCarousel views js.
   * @type {{attach: Drupal.behaviors.owlcarousel_views.attach}}
   */
  Drupal.behaviors.owlcarousel_views = {
    attach: function (context, settings) {
      const settingOwl = {
        center: true,
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
          0: {
            items: 1,
          },
          400: {
            items: 2,
          },
          600: {
            items: 3,
          },
          800: {
            items: 4,
          },
          1000: {
            items: 5,
          },
        },
      };

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
