<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all environments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to ensure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * Skipping permissions hardening will make scaffolding
 * work better, but will also raise a warning when you
 * install Drupal.
 *
 * https://www.drupal.org/project/drupal/issues/3091285
 */
// $settings['skip_permissions_hardening'] = TRUE;

/**
 * Drupal 8.8 workaround
 */
$settings['config_sync_directory'] = dirname(DRUPAL_ROOT) . '/config';

/**
 * Default Content Directory
 *
 */
$settings['default_content_deploy_content_directory'] = dirname(DRUPAL_ROOT) . '/content';

/**
 * enviro ind setup.
 */
$config['environment_indicator.indicator']['name'] = PANTHEON_ENVIRONMENT;
$config['environment_indicator.indicator']['bg_color'] = '#352069'; // green';
$config['environment_indicator.indicator']['fg_color'] = '#ffffff'; //white

if ($_SERVER['PANTHEON_ENVIRONMENT'] === 'dev') {
  $config['environment_indicator.indicator']['bg_color'] = '#008000'; // green';
  $config['environment_indicator.indicator']['fg_color'] = '#ffffff'; //white
  }

/**
 * If there is an environment settings file, then include it
 */
$envirosettings = __DIR__ . "/enviros/settings." . $_ENV['PANTHEON_ENVIRONMENT'] . ".php";
if (file_exists($envirosettings)) {
  // Config split
  $config['config_split.config_split.' . PANTHEON_ENVIRONMENT]['status'] = TRUE;
  include $envirosettings;
}


/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}
