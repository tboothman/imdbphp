<?php
 #############################################################################
 # PHP MovieAPI                                          (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

if (defined('IMDBPHP_CONFIG')) require_once (IMDBPHP_CONFIG);
else require_once (dirname(__FILE__)."/mdb_config.class.php");

require_once (dirname(__FILE__)."/mdb_request.class.php");
require_once dirname(__FILE__)."/imdb_page.class.php";
require_once dirname(__FILE__)."/imdb_cache.class.php";
require_once dirname(__FILE__)."/imdb_logger.class.php";

#===================================================[ The IMDB Base class ]===
/** Accessing Movie information
 * @package MDBApi
 * @author Georgos Giagas
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class mdb_base extends mdb_config {
  public $version = '2.6.1';

  /**
   * @deprecated since version 2.3.4
   */
  public $lastServerResponse;

  protected $months = array("January"=>"01","February"=>"02","March"=>"03","April"=>"04",
           "May"=>"05","June"=>"06","July"=>"07","August"=>"08","September"=>"09",
           "October"=>"10","November"=>"11","December"=>"12");

  /**
   * @var imdb_cache
   */
  protected $cache;

  /**
   * @var imdb_logger
   */
  protected $logger;

  protected $page = array();


  /**
   * @constructor mdb_base
   * @param object mdb_config $config OPTIONAL override default config
   */
  public function __construct(mdb_config $config = null) {
    parent::__construct();

    if ($config) {
      foreach ($config as $key => $value) {
        $this->$key = $value;
      }
    }

    $this->logger = new imdb_logger($this->debug);
    $this->cache = new imdb_cache($this, $this->logger);

    if ($this->storecache && ($this->cache_expire > 0)) $this->cache->purge();
  }

  /**
   * Setup class for a new IMDB id
   * @method setid
   * @param string id IMDBID of the requested movie
   */
  public function setid ($id) {
    if (!preg_match("/^\d{7}$/",$id)) $this->debug_scalar("<BR>setid: Invalid IMDB ID '$id'!<BR>");
    $this->imdbID = $id;
    $this->reset_vars();
  }

  /**
   * Retrieve the IMDB ID
   * @method imdbid
   * @return string id IMDBID currently used
   */
  public function imdbid() {
    return $this->imdbID;
  }

 #---------------------------------------------------------[ Debug helpers ]---
  protected function debug_scalar($scalar) {
    $this->logger->error($scalar);
  }
  protected function debug_object($object) {
    $this->logger->error('{object}', array('object' => $object));
  }
  protected function debug_html($html) {
    $this->logger->error(htmlentities($html));
  }

  /**
   * Get numerical value for month name
   * @method protected monthNo
   * @param string name name of month
   * @return integer month number
   */
  protected function monthNo($mon) {
    return @$this->months[$mon];
  }

 #-------------------------------------------------------------[ Open Page ]---
  /**
   * Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   return false;
  }

  /**
   * Get a page from IMDb, which will be cached in memory for repeated use
   * @param string $page Name of the page to retrieve e.g. Title, Credits
   * @return string
   * @see mdb_base->set_pagename()
   */
  protected function getPage($page) {
    if (!empty($this->page[$page])) {
      return $this->page[$page];
    }

    $pageRequest = new imdb_page($this->buildUrl($page), $this, $this->cache, $this->logger);

    $this->page[$page] = $pageRequest->get();

    // @TODO is this needed? is anything on imdb not utf8 encoded?
    // Non ascii characters appear to be entity encoded anyway, so this would do nothing?
    if ($this->imdb_utf8recode && function_exists('mb_detect_encoding')) {
      $cur_encoding = mb_detect_encoding($this->page[$page]);
      if (!($cur_encoding == "UTF-8" && mb_check_encoding($this->page[$page], "UTF-8"))) {
        $this->page[$page] = utf8_encode($this->page[$page]);
      }
    }

    return $this->page[$page];
  }

  /**
   * Overrideable method to build the URL used by getPage
   * @param string $page
   * @return string
   */
  protected function buildUrl($page) {
    return '';
  }

  /**
   * Reset page vars
   * @method protected reset_vars
   */
  protected function reset_vars() {
    return;
  }

}

