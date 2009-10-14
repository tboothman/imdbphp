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

 if (defined('IMDBPHP_CONFIG')) require_once (IMDBPHP_CONFIG);
 else require_once (dirname(__FILE__)."/mdb_config.class.php");

 #====================================================[ IMDB Search class ]===
 /** Search the IMDB for a title and obtain the movies IMDB ID
  * @package IMDB
  * @class pilotsearch
  * @extends mdb_config
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class pilotsearch extends mdb_config {
  var $page = "";
  var $name = NULL;
  var $resu = array();
  var $url = "http://www.imdb.com/";

  /** Read the config
   * @constructor pilotsearch
   */
  function __construct() {
    parent::__construct();
    $this->search_episodes(FALSE);
  }

  /** Search for episodes or movies
   * @method search_episodes
   * @param boolean enabled TRUE: Search for episodes; FALSE: Search for movies (default)
   * @version no episodes here, so this is a dummy for compatibility only
   */
  public function search_episodes($enable) {
    // $this->episode_search = $enable;
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
     $url = "http://".$this->pilotsite."/searches/movies.json?q=".urlencode($this->name)."&api_key=".$this->pilot_apikey;
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
   * @param optional string URL Replace search URL by your own
   * @return array results array of objects (instances of the imdb class)
   * @todo Since the returned JSON file is a collection of complete movie
   *   records, these records should be placed into the cache dir for later use,
   *   if the cache is enabled
   */
  public function results($url="") {
   // get the result list
   if ($this->page == "") {
     if (empty($url)) $url = $this->mkurl();
     $be = new MDB_Request($url);
     $be->sendrequest();
     $fp = $be->getResponseBody();
     $this->page = json_decode($fp);
   } // end (page="")

   // parse results
   $i = 0;
   foreach ($this->page->movies as $movie) {
     if ( $this->maxresults && $i > $this->maxresults ) break;
     ++$i;
     // if (cache) store json_encode($movie)
     $item = new pilot('0000000');
     $item->page['Title'] = $movie;
     $item->setid(str_pad($movie->alternative_identifiers->imdb,7,0,STR_PAD_LEFT));
     $this->resu[] = $item;
   }

   return $this->resu;
  }
} // end class pilotsearch

?>
