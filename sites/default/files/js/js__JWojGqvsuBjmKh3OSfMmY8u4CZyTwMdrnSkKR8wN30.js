/**
 * @file
 * Control Fullscreen.
 */

/**
 * @typedef {Object} ControlFullscreenSettings
 *
 * @extends {GeolocationMapFeatureSettings}

 * @property {String} position
 * @property {String} behavior
 */

(function (Drupal) {

  'use strict';

  /**
   * Fullscreen control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationFullScreenControl = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_fullscreen',

        /**
         * @param {GeolocationGoogleMap} map - Current map.
         * @param {ControlFullscreenSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addPopulatedCallback(function (map) {
            var options = {
              fullscreenControlOptions: {
                position: google.maps.ControlPosition[featureSettings.position]
              }
            };

            if (featureSettings.behavior === 'always') {
              options.fullscreenControl = true;
            }
            else {
              options.fullscreenControl = undefined;
            }

            map.googleMap.setOptions(options);
          });

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
 * Control Loading Indicator.
 */

(function ($, Drupal) {

  'use strict';

  var ajaxBeforeSendOriginal = Drupal.Ajax.prototype.beforeSend;

  Drupal.Ajax.prototype.beforeSend = function (xmlhttprequest, options) {
    var loadingIndicator = $(this.selector + ' .geolocation-map-control .loading-indicator');
    if (loadingIndicator.length) {
      loadingIndicator.show();
    }

    ajaxBeforeSendOriginal.call(this, xmlhttprequest, options);
  };

  /**
   * Loading Indicator control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationControlRecenter = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_loading_indicator',

        /**
         * @param {GeolocationMapInterface} map
         * @param {GeolocationMapFeatureSettings} featureSettings
         */
        function (map, featureSettings) {
          var loadingIndicator = $('.geolocation-map-control .loading-indicator', map.wrapper);

          map.addPopulatedCallback(function (map) {
            loadingIndicator.hide();
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
 * Client location indicator.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * ClientLocationIndicator.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationClientLocationIndicator = {
    attach: function (context, drupalSettings) {

      Drupal.geolocation.executeFeatureOnAllMaps(
        'client_location_indicator',

        /**
         * @param {GeolocationMapInterface} map
         * @param {GeolocationMapFeatureSettings} featureSettings
         */
        function (map, featureSettings) {
          if (!navigator.geolocation) {
            return true;
          }
          map.addInitializedCallback(function (map) {
            var clientLocationMarker = new google.maps.Marker({
              clickable: false,
              icon: {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: '#039be5',
                fillOpacity: 1.0,
                scale: 8,
                strokeColor: 'white',
                strokeWeight: 2
              },
              shadow: null,
              zIndex: 999,
              map: map.googleMap,
              position: {lat: 0, lng: 0}
            });

            var indicatorCircle = null;

            setInterval(function () {
              navigator.geolocation.getCurrentPosition(function (currentPosition) {
                var currentLocation = new google.maps.LatLng(currentPosition.coords.latitude, currentPosition.coords.longitude);
                clientLocationMarker.setPosition(currentLocation);

                if (!indicatorCircle) {
                  indicatorCircle = map.addAccuracyIndicatorCircle(currentLocation, parseInt(currentPosition.coords.accuracy.toString()));
                }
                else {
                  indicatorCircle.setCenter(currentLocation);
                  indicatorCircle.setRadius(parseInt(currentPosition.coords.accuracy.toString()));
                }
              });
            }, 5000);
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
 * Control Recenter.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Recenter control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationControlRecenter = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_recenter',

        /**
         * @param {GeolocationMapInterface} map
         * @param {GeolocationMapFeatureSettings} featureSettings
         */
        function (map, featureSettings) {
          map.addInitializedCallback(function (map) {
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
/**
 * @file
 * Restrict map.
 */

/**
 * @typedef {Object} MapRestrictionSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} north
 * @property {String} south
 * @property {String} east
 * @property {String} west
 * @property {Boolean} strict
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Map restriction.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationMapRestriction = {
    attach: function (context, drupalSettings) {

      Drupal.geolocation.executeFeatureOnAllMaps(
          'map_restriction',

          /**
           * @param {GeolocationGoogleMap} map - Current map.
           * @param {MapRestrictionSettings} featureSettings - Settings for current feature.
           */
          function (map, featureSettings) {
            map.addInitializedCallback(function (map) {
              map.googleMap.setOptions({
                restriction: {
                  latLngBounds: {
                    north: parseFloat(featureSettings.north),
                    south: parseFloat(featureSettings.south),
                    east: parseFloat(featureSettings.east),
                    west: parseFloat(featureSettings.west)
                  },
                strictBounds: Boolean(featureSettings.strict)
                }
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
/**
 * @file
 * Control Street View.
 */

/**
 * @typedef {Object} ControlStreetViewSettings
 *
 * @extends {GeolocationMapFeatureSettings}

 * @property {String} position
 * @property {String} behavior
 */

(function (Drupal) {

  'use strict';

  /**
   * Streetview control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationStreetViewControl = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_streetview',

        /**
         * @param {GeolocationGoogleMap} map - Current map.
         * @param {ControlStreetViewSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addPopulatedCallback(function (map) {
            var options = {
              streetViewControlOptions: {
                position: google.maps.ControlPosition[featureSettings.position]
              }
            };

            if (featureSettings.behavior === 'always') {
              options.streetViewControl = true;
            }
            else {
              options.streetViewControl = undefined;
            }

            map.googleMap.setOptions(options);
          });

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
 * Control Street View.
 */

/**
 * @typedef {Object} ControlRotateSettings
 *
 * @extends {GeolocationMapFeatureSettings}

 * @property {String} position
 * @property {String} behavior
 */

(function (Drupal) {

  'use strict';

  /**
   * Streetview control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationRotateControl = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_rotate',

        /**
         * @param {GeolocationGoogleMap} map - Current map.
         * @param {ControlStreetViewSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addPopulatedCallback(function (map) {
            var options = {
              rotateControlOptions: {
                position: google.maps.ControlPosition[featureSettings.position]
              }
            };

            if (featureSettings.behavior === 'always') {
              options.rotateControl = true;
            }
            else {
              options.rotateControl = undefined;
            }
            map.googleMap.setOptions(options);
          });

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
 * Zoom Control.
 */

/**
 * @typedef {Object} ControlZoomSettings
 *
 * @extends {GeolocationMapFeatureSettings}
 *
 * @property {String} behavior
 * @property {String} position
 * @property {String} style
 */

(function (Drupal) {

  'use strict';

  /**
   * Zoom control.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches common map style functionality to relevant elements.
   */
  Drupal.behaviors.geolocationZoomControl = {
    attach: function (context, drupalSettings) {
      Drupal.geolocation.executeFeatureOnAllMaps(
        'control_zoom',

        /**
         * @param {GeolocationGoogleMap} map - Current map.
         * @param {ControlZoomSettings} featureSettings - Settings for current feature.
         */
        function (map, featureSettings) {
          map.addPopulatedCallback(function (map) {
            var options = {
              zoomControlOptions: {
                position: google.maps.ControlPosition[featureSettings.position],
                style: google.maps.ZoomControlStyle[featureSettings.style]
              }
            };

            if (featureSettings.behavior === 'always') {
              options.zoomControl = true;
            }
            else {
              options.zoomControl = undefined;
            }
            map.googleMap.setOptions(options);
          });

          return true;
        },
        drupalSettings
      );
    },
    detach: function (context, drupalSettings) {}
  };

})(Drupal);
;
