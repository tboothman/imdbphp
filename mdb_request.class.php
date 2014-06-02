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

  require_once (dirname(__FILE__)."/browseremulator.class.php");
  if (defined('IMDBPHP_CONFIG')) require_once (IMDBPHP_CONFIG);
  else require_once (dirname(__FILE__)."/mdb_config.class.php");

  /** The request class
   *  Here we emulate a browser accessing the IMDB site. You don't need to
   *  call any of its method directly - they are rather used by the IMDB classes.
   * @package MDBApi
   * @class MDB_Request
   */
  class MDB_Request extends BrowserEmulator{
    var $maxsize = 100000;
    /** Constructor: Initialize the BrowserEmulator
     *  No need to call this.
     * @constructor MDB_Request
     * @param string url URL to open
     * @param optional string force_agent user agent string to use. Defaults to the one set in mdb_config.
     * @param optional bool trigger_referer whether to trigger the referer. '' = take value from mdb_config (default)
     * @param mdb_config Optionally pass in the mdb_config object to use
     */
    public function __construct($url, $force_agent='', $trigger_referer='', $iconf = null){
      $this->BrowserEmulator();
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
        if ( substr(get_class($this),0,4)=="imdb" )
          $this->addHeaderLine('Referer','http://' . $this->imdbsite . '/');
        elseif ( in_array('HTTP_REFERER',array_keys($_SERVER)) )
          $this->addHeaderLine('Referer',$_SERVER['HTTP_REFERER']);
      }
      if ($force_agent) $this->addHeaderLine('User-Agent', $iconf->force_agent);
      if ($iconf->language) $this->addHeaderLine('Accept-Language', $iconf->language);
    }
    /** Send a request to the movie site
     * @method sendRequest
     * @return boolean success
     */
    function sendRequest(){
      $this->fpopened = $this->fopen($this->urltoopen);
      if ($this->fpopened!==false) return true;
      return false;
    }
    /** Get the Response body
     * @method getResponseBody
     * @return string page
     */
    function getResponseBody(){
      $page = "";
      if ($this->fpopened===FALSE) return $page;
      while (!feof ($this->fpopened)) {
        $page .= fread ($this->fpopened, 1024);
      }
      return $page;
    }
    /** Set the URL we need to parse
     * @method setURL
     */
    function setURL($url){
      $this->urltoopen = $url;
    }
    /** Obtain the response header
     * @method getresponseheader
     * @param optional string header
     * @return string header
     */
    function getresponseheader($header = false){
      $headers = $this->getLastResponseHeaders();
      foreach ($headers as $head){
        if ( is_integer(strpos ($head, $header) )){
          $hstart = strpos ($head, ": ");
          $head = trim(substr($head,$hstart+2,100));
          return $head;
        }
      }
    }
  }

?>
