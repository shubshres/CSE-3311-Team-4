/**
 * @file
 * Static location center.
 */

(function (Drupal) {

  'use strict';

  Drupal.geolocation = Drupal.geolocation || {};
  Drupal.geolocation.mapCenter = Drupal.geolocation.mapCenter || {};

  /**
   * @param {GeolocationMapInterface} map
   * @param {GeolocationCenterOption} centerOption
   * @param {Boolean} centerOption.success
   */
  Drupal.geolocation.mapCenter.location_plugins = function (map, centerOption) {
    if (
      typeof centerOption.success !== "undefined"
      && centerOption.success
    ) {
      return true;
    }
    return false;
  }

})(Drupal);
;
/**
 * @file
 * Gesture handling.
 */

(function (Drupal) {

  'use strict';

  /**
   * Map interaction disable handling.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map gesture handling functionality to relevant elements.
   */
  Drupal.behaviors.leafletGestureHandling = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_disable_user_interaction',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {GeolocationMapFeatureSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {

          map.leafletMap.dragging.disable();
          map.leafletMap.touchZoom.disable();
          map.leafletMap.doubleClickZoom.disable();
          map.leafletMap.scrollWheelZoom.disable();

          return true;
        },
        drupalSettings
      );
    },
    detach: function (context, drupalSettings) {}
  };

})(Drupal);
;
/**
 * @file
 * Control locate.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Locate control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map locate functionality to relevant elements.
   */
  Drupal.behaviors.leafletControlLocate = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_control_locate',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {GeolocationMapFeatureSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addInitializedCallback(function (map) {
            var locateButton = $('.geolocation-map-control .locate', map.wrapper);
            if (navigator.geolocation && window.location.protocol === 'https:') {
              locateButton.click(function (e) {
                navigator.geolocation.getCurrentPosition(function (currentPosition) {
                  var currentLocation = new L.LatLng(currentPosition.coords.latitude, currentPosition.coords.longitude);
                  map.setCenterByCoordinates(currentLocation, currentPosition.coords.accuracy, 'leaflet_control_locate');
                });
                e.preventDefault();
              });
            }
            else {
              locateButton.remove();
            }
          });

          return true;
        },
        drupalSettings
      );
    },
    detach: function (context, drupalSettings) {}
  };

})(jQuery, Drupal);
;
