<?php
/**
 * NSBPC Helper Class
 * Copyright (C) 2013 Elie Roux <elie.roux@telecom-bretagne.eu>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * --------------------------------------------------------------------
 *
 * @version v0.1
 * @package nsbpc
 *
 */
// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');

class helper_plugin_nsbpc extends dokuwiki_plugin
{
  /**
   * Required method, see https://www.dokuwiki.org/devel:helper_plugins
   *
   */
    function getMethods(){
      $result = array();
      $result[] = array(
        'name' => 'getConfFile',
        'desc' => 'returns the path of the closes config file for the plugin in the current or parent namespaces',
        'params' => array('name' => 'string'),
        'return' => array('filepath' => 'string'),
        );
      $result[] = array(
        'name' => 'getConf',
        'desc' => 'returns the configuration for a plugin, reading config from all config files associated to this plugin in the current and parent namespaces',
        'params' => array('name' => 'string'),
        'return' => array('conf' => 'array'),
        );
    }
  /**
   * This function returns the path of the closest config file for the plugin.
   * The config file is __XXX.cfg, where XXX is the name supplied to this
   * function.
   *
   * The result is a string containing the path to the file.
   */
    function getConfFile(name){
      return "test";
    }
  /**
   * This function returns an array of configuration items for the plugin.
   * The config is read from __XXX.cfg, where XXX is the name supplied to this
   * function. The file uses the following syntax
   *
   * <key1>value1</key1>
   * <key2>value2
   * value22</key2>
   * <key3>value2</key3>
   *
   * The result is an array of simple key->value configuration items. The
   * returned array contains all the configuration values in the config files
   * of the current and parent namespaces. When a key is present in several of
   * these files, the returned associated value is the one of the closest 
   * config file.
   */
    function getConf($name){
      return array();
    }
  /**
   * This function reads the configuration items from a config file. It takes
   * a configuration array as an argument, and fills it with the new conf
   * it reads. It does not override the existing conf values of the initial
   * array.
   */
   function _nsbpc_read_conf($filename, $conf){
     return $conf;
   }
}
