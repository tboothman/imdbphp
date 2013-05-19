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

 require_once (dirname(__FILE__)."/mdb_base.class.php");

 #====================================================[ IMDB Search class ]===
 /** Search the IMDB for a title and obtain the movies IMDB ID
  * @package MoviePilot
  * @class pilotsearch
  * @extends mdb_config
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class pilotsearch extends mdb_base {
  var $page = "";
  var $name = NULL;
  var $resu = array();
  var $url = "http://www.imdb.com/";

  /** Read the config
   * @constructor pilotsearch
   */
  function __construct() {
    parent::__construct('');
    if ( empty($this->pilot_apikey) )
      trigger_error('Please provide a valid api key or contact api@moviepilot.de.',E_USER_WARNING);
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
     if (!isset($this->maxresults)) $this->maxresults = 20;
     if ($this->maxresults > 0) $query = "&per_page=".$this->maxresults;
     else $query = "";
     $url = "http://".$this->pilotsite."/searches/movies.json?q=".urlencode($this->name)."&api_key=".$this->pilot_apikey.$query;
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
   */
  public function results($url="") {
   if ( empty($this->pilot_apikey) ) {
     trigger_error('Please provide a valid api key or contact api@moviepilot.de.',E_USER_WARNING);
     return array();
   }
   // get the result list
   if ($this->page == "") {
     if (empty($url)) $url = $this->mkurl();
     $be = new MDB_Request($url);
     $be->sendrequest();
     $fp = $be->getResponseBody();
     if ( preg_match('!"error":"please provide a valid api key or contact api@moviepilot.(de|com)"}!i',$fp,$match) ) {
       $this->debug_scalar('ERROR: invalid API key');
       trigger_error('Please provide a valid api key or contact api@moviepilot.'.$match[1].'.',E_USER_WARNING);
       return array();
     }
     $this->page = json_decode($fp);
   } // end (page="")

   // parse results
   $i = 0;
   if (!empty($this->page->movies)) foreach ($this->page->movies as $movie) {
     if ( $this->maxresults && $i > $this->maxresults ) break;
     ++$i;
     if ( property_exists($movie,'alternative_identifiers') && property_exists($movie->alternative_identifiers,'imdb') ) {
       $mid = str_pad($movie->alternative_identifiers->imdb,7,0,STR_PAD_LEFT);
       $item = new pilot($mid);
       $item->page['Title'] = $movie;
       $item->setid($mid);
       $this->resu[] = $item;
       if ($this->storecache) $this->cache_write($mid.'.'.'Title.pilot',json_encode($movie));
     }
   }

   return $this->resu;
  }
} // end class pilotsearch

?>
