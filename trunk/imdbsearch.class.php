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
 require_once (dirname(__FILE__)."/movie_base.class.php");
 require_once (dirname(__FILE__)."/mdb_request.class.php");

 #====================================================[ IMDB Search class ]===
 /** Search the IMDB for a title and obtain the movies IMDB ID
  * @package IMDB
  * @class imdbsearch
  * @extends mdb_config
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdbsearch extends mdb_base {
  var $page = "";
  var $name = NULL;
  var $resu = array();
  var $url = "http://www.imdb.com/";

  /** Read the config
   * @constructor imdbsearch
   */
  function __construct() {
    parent::__construct('');
    $this->search_episodes(FALSE);
    $this->last_results = 0;
  }

  /** Search for episodes or movies
   * @method search_episodes
   * @param boolean enabled TRUE: Search for episodes; FALSE: Search for movies (default)
   */
  public function search_episodes($enable) {
    $this->episode_search = $enable;
  }

  /** Set the name (title) to search for
   * @method setsearchname
   * @param string searchstring what to search for - (part of) the movie name
   */
  public function setsearchname($name) {
    $this->name = $name;
    $this->page = "";
    $this->url = NULL;
  }

  /** Set the URL (overwrite default search URL and run your own)
   *  This URL will be reset if you call the setsearchname() method
   * @method seturl
   * @param string URL to use
   */
  public function seturl($url){
    $this->url = $url;
  }

  /** Create the IMDB URL for the movie search
   * @method private mkurl
   * @return string url
   */
  private function mkurl() {
   if ($this->url !== NULL){
    $url = $this->url;
   }else{
     if (!isset($this->maxresults)) $this->maxresults = 20;
     if ($this->maxresults > 0) $query = ";mx=20";
     if ($this->episode_search) $url = "http://".$this->imdbsite."/find?q=".urlencode($this->name).$query.";s=ep";
     else {
       switch ($this->searchvariant) {
         case "moonface" : $query .= ";more=tt;nr=1"; // @moonface variant (untested)
         case "sevec"    : $query .= "&restrict=Movies+only&GO.x=0&GO.y=0&GO=search;tt=1"; // Sevec ori
         default         : $query .= ";tt=on"; // Izzy
       }
       $url = "http://".$this->imdbsite."/find?q=".urlencode($this->name).$query;
     }
   }
   return $url;
  }

  /** Reset search results
   *  This empties the collected search results. Without calling this, every
   *  new search appends its results to the ones collected by the previous search.
   * @method reset
   */
  function reset() {
    $this->resu = array();
  }

  /** Setup search results
   * @method results
   * @param optional string URL Replace search URL by your own (Default: empty string)
   * @param optional boolean series whether to include TV series in search results (default: TRUE)
   * @return array results array of objects (instances of the imdb class)
   */
  public function results($url="",$series=TRUE) {
    if ($this->page == "") {
      if ($this->usecache && empty($url)) { // Try to read from cache
        $this->cache_read(urlencode(strtolower($this->name)).'.search',$this->page);
      } // end cache read

      if ($this->page=="") { // not found in cache - go and get it!
        if (empty($url)) $url = $this->mkurl();
        mdb_base::debug_scalar("imdbsearch::results() called. Using URL $url");
        $be = new MDB_Request($url);
        $be->sendrequest();
        $fp = $be->getResponseBody();
        if ( !$fp ) {
          if ($header = $be->getResponseHeader("Location")) {
            mdb_base::debug_scalar("No immediate response body - we are redirected.<br>New URL: $header");
            if ( preg_match('!\.imdb\.(com|de|it)/find\?!',$header) ) {
              return $this->results($header);
              break(4);
            }
            $url = explode("/",$header);
            $id  = substr($url[count($url)-2],2);
            $this->resu[0] = new imdb($id);
            return $this->resu;
          } else {
            mdb_base::debug_scalar('No response body, no redirect - going to Nirwana');
            return NULL;
          }
        }
      $this->page = $fp;
      }

      if ($this->storecache && $this->page != "cannot open page" && $this->page != "") { //store cache
        $this->cache_write(urlencode(strtolower($this->name)).'.search',$this->page);
      }

    } // end (page="")

    // now we have the search content - go and parse it!
    if ($this->maxresults > 0) $maxresults = $this->maxresults; else $maxresults = 999999;
    if ( preg_match_all('!href="/title/tt(\d{7})/"[^>]*>(.*?)</a>\s*(\((\d{4})\)|)[^<]*(<small>(.*?)</small>|)!ims',$this->page,$matches) ) {
      $this->last_results = count($matches[0]);
      $mids_checked = array();
      for ($i=0;$i<$this->last_results;++$i) {
        if (count($this->resu) == $maxresults) break; // limit result count
        if ( empty($matches[2][$i]) || substr(trim($matches[2][$i]),0,4)=='<img' || in_array($matches[1][$i],$mids_checked) ) continue; // empty titles just come from the images
        if ( !$series && (preg_match('!&#x22;.+&#x22;!',($matches[2][$i])) || strpos(strtoupper($matches[6][$i]),'TV SERIES')!==FALSE) ) continue; // skip series if commanded so
        $mids_checked[] = $matches[1][$i];
        $tmpres = new imdb($matches[1][$i]); // make a new imdb object by id
        $tmpres->main_title = $matches[2][$i];
        $tmpres->main_year  = $matches[4][$i];
        $this->resu[] = $tmpres;
      }
    }
    return $this->resu;
  } // end results()

} // end class imdbsearch

?>
