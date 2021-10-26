/**
 * @file
 * Marker Clusterer.
 */

(function (Drupal) {
  'use strict';

  /**
   * Marker Clusterer.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map marker cluster functionality to relevant elements.
   */
  Drupal.behaviors.leafletMarkerClusterer = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_marker_clusterer',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {GeolocationMapFeatureSettings} featureSettings - Settings for current feature.
         * @param {String} featureSettings.zoomToBoundsOnClick - Settings for current feature.
         * @param {String} featureSettings.showCoverageOnHover - Settings for current feature.
         * @param {int} featureSettings.disableClusteringAtZoom - Settings for current feature.
         * @param {Object} featureSettings.customMarkerSettings - Settings for current feature.
         *
         * @see https://github.com/Leaflet/Leaflet.markercluster
         */
        function (map, featureSettings) {
          var options = {
            showCoverageOnHover: false,
            zoomToBoundsOnClick: false,
            disableClusteringAtZoom: null
          };

          if (featureSettings.zoomToBoundsOnClick) {
            options.zoomToBoundsOnClick = true;
          }
          if (featureSettings.showCoverageOnHover) {
            options.showCoverageOnHover = true;
          }
          if (featureSettings.disableClusteringAtZoom) {
            options.disableClusteringAtZoom = featureSettings.disableClusteringAtZoom;
          }
          if (featureSettings.customMarkerSettings) {
            options.iconCreateFunction = function (cluster) {
              var childCount = cluster.getChildCount();
              var customMarkers = featureSettings.customMarkerSettings;
              var className = ' marker-cluster-';
              var radius = 40;

              for (var size in customMarkers) {
                if (childCount < customMarkers[size].limit) {
                  className += size;
                  radius = customMarkers[size].radius;
                  break;
                }
              }

              return new L.DivIcon({
                html: '<div><span>' + childCount + '</span></div>',
                className: 'marker-cluster' + className,
                iconSize: new L.Point(radius, radius)
              });
            };
          }

          var cluster = L.markerClusterGroup(options);

          map.leafletMap.removeLayer(map.markerLayer);
          cluster.addLayer(map.markerLayer);

          map.leafletMap.addLayer(cluster);

          map.addMarkerAddedCallback(function (currentMarker) {
            cluster.addLayer(currentMarker);
          });

          map.addMarkerRemoveCallback(function (marker) {
            cluster.removeLayer(marker);
          });

          return true;
        },
        drupalSettings
      );
    },
    detach: function (context, drupalSettings) { }
  };
})(Drupal);
;
/**
 * @file
 * Marker Icon.
 */

/**
 * @typedef {Object} LeafletMarkerIconSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} markerIconPath
 * @property {Array} iconSize
 * @property {Number} iconSize.width
 * @property {Number} iconSize.height
 * @property {Array} iconAnchor
 * @property {Number} iconAnchor.x
 * @property {Number} iconAnchor.y
 * @property {Array} popupAnchor
 * @property {Number} popupAnchor.x
 * @property {Number} popupAnchor.y
 * @property {String} markerShadowPath
 * @property {Array} shadowSize
 * @property {Number} shadowSize.width
 * @property {Number} shadowSize.height
 * @property {Array} shadowAnchor
 * @property {Number} shadowAnchor.x
 * @property {Number} shadowAnchor.y
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Marker Icon Adjustment.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches map marker icon adjustment functionality to relevant elements.
   */
  Drupal.behaviors.leafletMarkerIcon = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'leaflet_marker_icon',

        /**
         * @param {GeolocationLeafletMap} map - Current map.
         * @param {LeafletMarkerIconSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {

          var geolocationLeafletIconHandler = function (currentMarker) {

            var iconUrl;
            if (typeof currentMarker.locationWrapper !== 'undefined') {
              var currentIcon = currentMarker.locationWrapper.data('icon');
            }

            if (typeof currentIcon === 'undefined') {
              if (typeof featureSettings.markerIconPath === 'string') {
                iconUrl = featureSettings.markerIconPath;
              }
              else {
                return;
              }
            }
            else {
              iconUrl = currentIcon;
            }

            var iconOptions = {
              iconUrl: iconUrl,
              shadowUrl: featureSettings.markerShadowPath
            };

            if (featureSettings.iconSize.width && featureSettings.iconSize.height) {
              $.extend(iconOptions, {iconSize: [featureSettings.iconSize.width, featureSettings.iconSize.height]});
            }

            if (featureSettings.shadowSize.width && featureSettings.shadowSize.height) {
              $.extend(iconOptions, {shadowSize: [featureSettings.shadowSize.width, featureSettings.shadowSize.height]});
            }

            if (featureSettings.iconAnchor.x || featureSettings.iconAnchor.y) {
              $.extend(iconOptions, {iconAnchor: [featureSettings.iconAnchor.x, featureSettings.iconAnchor.y]});
            }

            if (featureSettings.shadowAnchor.x || featureSettings.shadowAnchor.y) {
              $.extend(iconOptions, {shadowAnchor: [featureSettings.shadowAnchor.x, featureSettings.shadowAnchor.y]});
            }

            if (featureSettings.popupAnchor.x || featureSettings.popupAnchor.y) {
              $.extend(iconOptions, {popupAnchor: [featureSettings.popupAnchor.x, featureSettings.popupAnchor.y]});
            }

            currentMarker.setIcon(L.icon(iconOptions));
          };

          map.addPopulatedCallback(function (map) {
            $.each(map.mapMarkers, function (index, currentMarker) {
              geolocationLeafletIconHandler(currentMarker);
            });
          });

          map.addMarkerAddedCallback(function (currentMarker) {
            geolocationLeafletIconHandler(currentMarker);
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
