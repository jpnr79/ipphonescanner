<?php
if (!defined('GLPI_ROOT')) { define('GLPI_ROOT', realpath(__DIR__ . '/../..')); }
/*
 -------------------------------------------------------------------------
 IpPhoneScanner plugin for GLPI
 Copyright (C) 2017 by the IpPhoneScanner Development Team.

 https://github.com/pluginsGLPI/ipphonescanner
 -------------------------------------------------------------------------

 LICENSE

 This file is part of IpPhoneScanner.

 IpPhoneScanner is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 IpPhoneScanner is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with IpPhoneScanner. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

define('PLUGIN_IPPHONESCANNER_VERSION', '0.0.1');

/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @return void
 */
function plugin_init_ipphonescanner() {
   global $PLUGIN_HOOKS;
   #require_once(__DIR__ . '/vendor/autoload.php');
   $PLUGIN_HOOKS['menu_toadd']['ipphonescanner']['tools'] = 'PluginIpphonescannerMenu';
   $PLUGIN_HOOKS['csrf_compliant']['ipphonescanner'] = true;
}


/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array
 */
function plugin_version_ipphonescanner() {
   return [
      'name'           => 'IpPhoneScanner',
      'version'        => PLUGIN_IPPHONESCANNER_VERSION,
      'author'         => '<a href="http://www.teclib.com">Teclib\'</a>',
      'license'        => '',
      'homepage'       => '',
      'minGlpiVersion' => '9.1'
   ];
}

/**
 * Check pre-requisites before install
 * OPTIONNAL, but recommanded
 *
 * @return boolean
 */
function plugin_ipphonescanner_check_prerequisites() {
   // Strict version check (could be less strict, or could allow various version)
   // GLPI must be at least 9.1 ...
   $glpi_version = 'unknown';
   $version_file = defined('GLPI_ROOT') ? GLPI_ROOT . '/version' : __DIR__ . '/../../../version';
   if (is_file($version_file)) {
      $glpi_version = trim(file_get_contents($version_file));
   } elseif (defined('GLPI_VERSION')) {
      $glpi_version = constant('GLPI_VERSION');
   }
   $ok = ($glpi_version !== 'unknown') && version_compare($glpi_version, '9.1', '>=');
   if (!$ok) {
      $msg = '';
      if (method_exists('Plugin', 'messageIncompatible')) {
         $msg = Plugin::messageIncompatible('core', '9.1');
         echo $msg;
      } else {
         $msg = "This plugin requires GLPI >= 9.1";
         echo $msg;
      }
      // Robust error logging
      if (!class_exists('Toolbox') && defined('GLPI_ROOT') && file_exists(GLPI_ROOT . '/src/Toolbox.php')) {
         require_once GLPI_ROOT . '/src/Toolbox.php';
      }
      if (class_exists('Toolbox') && method_exists('Toolbox', 'logInFile')) {
         Toolbox::logInFile('ipphonescanner', $msg);
      } else if (defined('GLPI_ROOT')) {
         $logfile = GLPI_ROOT . '/files/_log/ipphonescanner-error.log';
         @file_put_contents($logfile, $msg."\n", FILE_APPEND);
      }
      return false;
   }
   return true;
}

/**
 * Check configuration process
 *
 * @param boolean $verbose Whether to display message on failure. Defaults to false
 *
 * @return boolean
 */
function plugin_ipphonescanner_check_config($verbose = false) {
   if (true) { // Your configuration check
      return true;
   }

   if ($verbose) {
      echo 'Installed / not configured (ipphonescanner)';
   }
   return false;
}
