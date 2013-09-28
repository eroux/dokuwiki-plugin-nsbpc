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
        'params' => array(
          'name' => 'string',
          'currentns' => 'string',
          ),
        'return' => array('filepath' => 'string'),
        );
      $result[] = array(
        'name' => 'getConf',
        'desc' => 'returns the configuration for a plugin, reading config from all config files associated to this plugin in the current and parent namespaces',
        'params' => array(
          'name' => 'string',
          'currentns' => 'string',
          ),
        'return' => array('conf' => 'array'),
        );
    }
  /**
   * This function returns the path of the closest config file for the plugin.
   * The config file is __XXX.cfg, where XXX is the name supplied to this
   * function. The currentns argument is the current namespace (or page name).
   *
   * The result is a string containing the path to the file, or false if no
   * conf file is found.
   */
    function getConfFile($name, $currentns){
      $name = "nbspc".$name;
      $namespaces = explode(':', getNS(cleanID(getID())));
      while(!empty($namespaces))
      {
        $page = implode(':', $namespaces).':'.$name;
        if (page_exists($page))
        {
          return($page);
        }
        array_pop($namespaces);
      }
      return false;
    }
  /**
   * This function returns an array of configuration items for the plugin.
   * The config is read from __XXX.cfg, with the parse_ini_file() function. 
   * The returned array contains all the configuration values in the config
   * files of the current and parent namespaces. When a key is present in
   * several of these files, the returned associated value is the one of the
   * closest config file.
   *
   * If no conf file is found, then the returned array is empty.
   *
   * The currentns argument is the same as above.
   */
    function getConf($name, $currentns){
      return array();
    }
}
