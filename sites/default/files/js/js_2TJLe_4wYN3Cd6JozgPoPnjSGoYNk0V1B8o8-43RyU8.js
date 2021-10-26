/**
 * @file
 * Control Zoom.
 */

/**
 * @typedef {Object} ControlZoomSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} position
 */

(function (Drupal) {

  'use strict';

  /**
   * Zoom control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map zoom functionality to relevant elements.
   */
  Drupal.behaviors.leafletControlZoom = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_control_zoom',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {ControlZoomSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          L.control.zoom({
            position: featureSettings.position
          }).addTo(map.leafletMap);

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
 * Gesture handling.
 */

(function (Drupal) {

  'use strict';

  /**
   * Gesture handling.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map gesture handling functionality to relevant elements.
   */
  Drupal.behaviors.leafletGestureHandling = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_gesture_handling',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {GeolocationMapFeatureSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          L.Util.setOptions(map.leafletMap, {
            gestureHandlingOptions: {
              duration: 1000
            }
          });
          map.leafletMap['gestureHandling'].enable();

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
 * Control recenter.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Recenter control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map recenter functionality to relevant elements.
   */
  Drupal.behaviors.leafletControlRecenter = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_control_recenter',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {GeolocationMapFeatureSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addInitializedCallback(function (map) {
            jQuery.each(map.leafletMap.controls, function (index, control) {
              var currentControlContainer = control.getContainer();
              if (!currentControlContainer.classList.contains('leaflet_control_recenter')) {
                return;
              }
              map.leafletMap.removeControl(control);
              map.leafletMap.addControl(control);
            });
            var recenterButton = $('.geolocation-map-control .recenter', map.wrapper);
            recenterButton.click(function (e) {
              map.setCenter();
              e.preventDefault();
            });
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
