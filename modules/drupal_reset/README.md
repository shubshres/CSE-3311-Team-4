# Introduction

This module deletes all database tables and files for the current site and
redirect back to `install.php` so that one can reinstall Drupal from scratch.
The purpose of this module is to assist in the testing of install profiles. It
is only useful during development.

# Usage

Drupal Reset module provides you option to delete all your files or your site
database or the complete files and database.

Once the module is enabled, access Drupal Reset from the main Configuration page
under Development or at this path:

`/admin/config/development/drupal_reset`

There you have three options to go with for resetting your Drupal site:
  - Reset All
  - Reset Files
  - Reset Databases

There is no configurations for this module.

Drupal Reset does not remove module or theme files. It only removes the database
and files in the 'files' directory.

When using the 'Reset Files' option, it does not remove Drupal file entities.

# Incompatibility

Drupal Reset is not fully compatible with the Domain Access module. If you use
Domain Access, before running Drupal Reset on your site, you must comment out
the configuration line in the settings.php file which looks like this:

`include DRUPAL_ROOT . '/sites/all/modules/contrib/domain/settings.inc';`
