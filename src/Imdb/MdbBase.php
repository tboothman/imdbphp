<?php
 #############################################################################
 # PHP MovieAPI                                          (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

namespace Imdb;

/**
 * Accessing Movie information
 * @author Georgos Giagas
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
 */
class MdbBase extends Config {
  public $version = '3.1.5';

  protected $months = array(
      "January" => "01",
      "February" => "02",
      "March" => "03",
      "April" => "04",
      "May" => "05",
      "June" => "06",
      "July" => "07",
      "August" => "08",
      "September" => "09",
      "October" => "10",
      "November" => "11",
      "December" => "12"
    );

  /**
   * @var Cache
   */
  protected $cache;

  /**
   * @var Logger
   */
  protected $logger;

  /**
   * @var Config
   */
  protected $config;

  /**
   * @var Pages
   */
  protected $pages;

  protected $page = array();

  protected $imdbID;

  /**
   * @param Config $config OPTIONAL override default config
   */
  public function __construct(Config $config = null) {
    parent::__construct();

    if ($config) {
      foreach ($config as $key => $value) {
        $this->$key = $value;
      }
    }

    $this->config = $config ?: $this;
    $this->logger = new Logger($this->debug);
    $this->cache = new Cache($this->config, $this->logger);
    $this->pages = new Pages($this->config, $this->cache, $this->logger);

    if ($this->storecache && ($this->cache_expire > 0)) {
      $this->cache->purge();
    }
  }

  /**
   * Setup class for a new IMDB id
   * @param string id IMDBID of the requested movie
   * @TODO remove this / make it private
   * @TODO allow numeric ids and coerce them into 7 digit strings
   * @TODO why is this in mdbbase when the base has no id ...
   */
  public function setid ($id) {
    if (!preg_match("/^\d{7}$/",$id)) $this->debug_scalar("<BR>setid: Invalid IMDB ID '$id'!<BR>");
    $this->imdbID = $id;
    $this->reset_vars();
  }

  /**
   * Retrieve the IMDB ID
   * @return string id IMDBID currently used
   * @TODO why is this in mdbbase when the base has no id ...
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
   * @param string name name of month
   * @return integer month number
   */
  protected function monthNo($mon) {
    return @$this->months[$mon];
  }

  /**
   * Get a page from IMDb, which will be cached in memory for repeated use
   * @param string $context Name of the page or some other context to build the URL with to retrieve the page
   * @return string
   */
  protected function getPage($context = null) {
    return $this->pages->get($this->buildUrl($context));
  }

  /**
   * Overrideable method to build the URL used by getPage
   * @param string $context OPTIONAL
   * @return string
   */
  protected function buildUrl($context = null) {
    return '';
  }

  /**
   * Reset page vars
   */
  protected function reset_vars() {
    return;
  }

}
