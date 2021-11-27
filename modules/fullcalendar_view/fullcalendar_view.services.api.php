<?php

/**
 * @file
 * Hooks and API provided by the "Full Calendar View Plugin" module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Allows to alter the $variables data before rendering.
 *
 * @param $variables
 */
function hook_fullcalendar_view_variables_alter(&$variables) {
  // Update something programmatically.
  $fullCalendarView = &$variables['#attached']['drupalSettings']['fullCalendarView'];
  if (!empty($fullCalendarView)) {
    foreach ($fullCalendarView as $key => $value) {
      $fullCalendarView[$key]['description'] = 'Something!';
    }
  }
}

/**
 * @} End of "addtogroup hooks".
 */
