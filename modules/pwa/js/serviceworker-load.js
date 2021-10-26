"use strict";

(function (Drupal, drupalSettings, navigator, window) {
  'use strict';

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
      navigator.serviceWorker.register(drupalSettings.pwa.installPath, {
        scope: drupalSettings.path.baseUrl
      }).then(function (registration) {
        console.log("Service Worker registered! Scope: ".concat(registration.scope));
      }).catch(function (err) {
        console.log("Service Worker registration failed: ".concat(err));
      });
    });
  }
})(Drupal, drupalSettings, navigator, window);
