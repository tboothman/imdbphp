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

if ( $PEAR ) { // Use the HTTP_Request class from the PEAR project.
  require_once("HTTP/Request.php");
  class IMDB_Request extends HTTP_Request{
    function IMDB_Request($url){
      $this->HTTP_Request($url);
      if ( PROXY != ""){
        $this->setProxy(PROXY, PROXY_PORT);
      }
      $this->_allowRedirects = false;
      $this->addHeader("User-Agent", "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    }	
  }
} else { // Use the browseremu class
  require_once (dirname(__FILE__)."/browseremulator.class.php");

  /** The request class
   *  Here we emulate a browser accessing the IMDB site. You don't need to
   *  call any of its method directly - they are rather used by the IMDB classes.
   * @package Api
   * @class IMDB_Request
   */
  class IMDB_Request extends BrowserEmulator{
    var $maxsize = 100000;
    /** Constructor: Initialize the BrowserEmulator
     *  No need to call this.
     * @constructor IMDB_Request
     */
    function IMDB_Request($url){
      $this->BrowserEmulator();
      $this->urltoopen = $url;
    }
    /** Send a request to the IMDB site
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
}		

?>
