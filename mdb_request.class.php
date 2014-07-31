<?php

#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# written by Giorgos Giagas                                                 #
# extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################

/* $Id$ */

require_once (dirname(__FILE__) . "/browseremulator.class.php");
if (defined('IMDBPHP_CONFIG'))
  require_once (IMDBPHP_CONFIG);
else
  require_once (dirname(__FILE__) . "/mdb_config.class.php");

/**
 * The request class
 * Here we emulate a browser accessing the IMDB site. You don't need to
 * call any of its method directly - they are rather used by the IMDB classes.
 * @package MDBApi
 */
class MDB_Request extends BrowserEmulator {

  /**
   * No need to call this.
   * @param string url URL to open
   * @param optional string force_agent user agent string to use. Defaults to the one set in mdb_config.
   * @param optional bool trigger_referer whether to trigger the referer. '' = take value from mdb_config (default)
   * @param mdb_config Optionally pass in the mdb_config object to use
   */
  public function __construct($url, $force_agent = '', $trigger_referer = '', $iconf = null) {
    parent::__construct();

    $this->urltoopen = $url;
    if (!$iconf){
      $iconf = new mdb_config();
    }

    if ($force_agent === ''){
      $force_agent = $iconf->force_agent;
    }

    if ($trigger_referer === ''){
      $trigger_referer = $iconf->trigger_referer;
    }

    if ($trigger_referer){
      $this->addHeaderLine('Referer', 'http://' . $iconf->imdbsite . '/');
    }
    if ($force_agent)
      $this->addHeaderLine('User-Agent', $force_agent);
    if ($iconf->language)
      $this->addHeaderLine('Accept-Language', $iconf->language);
  }

  /**
   * Send a request to the movie site
   * @return boolean success
   */
  public function sendRequest() {
    $this->fpopened = $this->fopen($this->urltoopen);
    if ($this->fpopened !== false)
      return true;
    return false;
  }

  /**
   * Get the Response body
   * @return string page
   */
  public function getResponseBody() {
    $page = "";
    if ($this->fpopened === FALSE)
      return $page;
    while (!feof($this->fpopened)) {
      $page .= fread($this->fpopened, 1024);
    }
    return $page;
  }

  /**
   * Set the URL we need to parse
   */
  public function setURL($url) {
    $this->urltoopen = $url;
  }

  /**
   * Get a header value from the response
   * @param string $header header field name
   * @return string header value
   */
  public function getresponseheader($header) {
    $headers = $this->getLastResponseHeaders();
    foreach ($headers as $head) {
      if (is_integer(strpos($head, $header))) {
        $hstart = strpos($head, ": ");
        $head = trim(substr($head, $hstart + 2, 100));
        return $head;
      }
    }
  }

}
