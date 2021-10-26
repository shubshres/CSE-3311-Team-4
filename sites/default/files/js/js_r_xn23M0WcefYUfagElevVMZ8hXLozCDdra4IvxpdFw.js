/**
 * @file
 * Control layer.
 */

/**
 * @typedef {Object} ControlLayerSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} defaultLabel
 * @property {Array} tileLayerProviders
 * @property {Array} tileLayerOptions
 * @property {String} position
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Tile layer control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches tile layer control functionality to relevant elements.
   */
  Drupal.behaviors.leafletControlLayer = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_control_layer',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {ControlLayerSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          var baseMaps = {};
          baseMaps[featureSettings.defaultLabel] = map.tileLayer;
          $.each(featureSettings.tileLayerProviders, function (variant, label) {
            var parts = variant.split('.');
            var provider = parts[0];
            baseMaps[label] = L.tileLayer.provider(variant,
              featureSettings.tileLayerOptions[provider] || {});
          });

          var overlayMaps = {};
          L.control.layers(baseMaps, overlayMaps, {
            position: featureSettings.position
          }).addTo(map.leafletMap);

          return true;
        },
        drupalSettings
      );
    },
    detach: function (context, drupalSettings) {}
  };

})(jQuery, Drupal);
;
/**
 * @file
 * Tile layer.
 */

/**
 * @typedef {Object} TileLayerSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} tileLayerProvider
 * @property {String} tileLayerOptions
 */

(function (Drupal) {

  'use strict';

  /**
   * TileLayerSettings.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches TileLayerSettings functionality to relevant elements.
   */
  Drupal.behaviors.leafletTileLayer = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_tile_layer',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {TileLayerSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.tileLayer.remove();
          map.tileLayer = L.tileLayer.provider(featureSettings.tileLayerProvider,
            featureSettings.tileLayerOptions
          ).addTo(map.leafletMap);

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
 * Marker Popup.
 */

/**
 * @typedef {Object} LeafletMarkerPopupSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {Boolean} infoAutoDisplay
 * @property {Number} maxWidth
 * @property {Number} minWidth
 * @property {Number} maxHeight
 * @property {Boolean} autoPan
 * @property {Boolean} keepInView
 * @property {Boolean} closeButton
 * @property {Boolean} autoClose
 * @property {Boolean} closeOnEscapeKey
 * @property {String} className
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Marker Popup.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map marker popup functionality to relevant elements.
   */
  Drupal.behaviors.leafletMarkerPopup = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_marker_popup',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {LeafletMarkerPopupSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          var geolocationLeafletPopupHandler = function (currentMarker) {
            if (typeof (currentMarker.locationWrapper) === 'undefined') {
              return;
            }

            var content = currentMarker.locationWrapper.find('.location-content');

            if (content.length < 1) {
              return;
            }
            var popupOptions = {};
            /**
             * 'maxWidth' => $feature_settings['max_width'],
             'minWidth' => $feature_settings['min_width'],
             'maxHeight' => $feature_settings['max_height'],
             'autoPan' => $feature_settings['auto_pan'],
             'keepInView' => $feature_settings['keep_in_view'],
             'closeButton' => $feature_settings['close_button'],
             'autoClose' => $feature_settings['auto_close'],
             'closeOnEscapeKey' => $feature_settings['close_on_escape_key'],
             'className' => $feature_settings['class_name'],
             */
            if (featureSettings.maxWidth) {
              popupOptions.maxWidth = Math.round(featureSettings.maxWidth);
            }
            if (featureSettings.minWidth) {
              popupOptions.minWidth = Math.round(featureSettings.minWidth);
            }
            if (featureSettings.maxHeight) {
              popupOptions.maxHeight = Math.round(featureSettings.maxHeight);
            }
            if (typeof featureSettings.autoPan !== "undefined") {
              popupOptions.autoPan = featureSettings.autoPan;
            }
            if (typeof featureSettings.keepInView !== "undefined") {
              popupOptions.keepInView = featureSettings.keepInView;
            }
            if (typeof featureSettings.closeButton !== "undefined") {
              popupOptions.closeButton = featureSettings.closeButton;
            }
            if (typeof featureSettings.autoClose !== "undefined") {
              popupOptions.autoClose = featureSettings.autoClose;
            }
            if (typeof featureSettings.closeOnEscapeKey !== "undefined") {
              popupOptions.closeOnEscapeKey = featureSettings.closeOnEscapeKey;
            }
            if (featureSettings.className) {
              popupOptions.className = featureSettings.className;
            }

            currentMarker.bindPopup(content.html(), popupOptions);

            if (featureSettings.infoAutoDisplay) {
              currentMarker.openPopup();
            }
          };

          map.addPopulatedCallback(function (map) {
            $.each(map.mapMarkers, function (index, currentMarker) {
              geolocationLeafletPopupHandler(currentMarker);
            });
          });

          map.addMarkerAddedCallback(function (currentMarker) {
            geolocationLeafletPopupHandler(currentMarker);
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
