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

 require_once (dirname(__FILE__)."/browseremulator.class.php");
 if (defined('IMDBPHP_CONFIG')) require_once (IMDBPHP_CONFIG);
 else require_once (dirname(__FILE__)."/mdb_config.class.php");
 require_once (dirname(__FILE__)."/mdb_request.class.php");

 #===================================================[ The IMDB Base class ]===
 /** Accessing Movie information
  * @package MDBApi
  * @class mdb_base
  * @extends mdb_config
  * @author Georgos Giagas
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class mdb_base extends mdb_config {
  var $version = '1.1.6';

  /** Last response from the IMDB server
   *  This is a 3-digit code according to RFC2616. This is e.g. a "200" for "OK",
   *  "404" for "not found", etc.). This attribute holds the response from the
   *  last query to the server and is overwritten on the next. Additional to the
   *  codes defined in RFC2616, "000" means the server could not be contacted -
   *  e.g. IMDB site down, or networking problems. If it is completely empty, you
   *  did not run any request yet ;) Consider this attribute read-only - you can
   *  use it to figure out why no information is returned in some cases.
   * @class imdb_base
   * @attribute string lastServerResponse
   */

 #---------------------------------------------------------[ Debug helpers ]---
  function debug_scalar($scalar) {
    if ($this->debug) echo "<b><font color='#ff0000'>$scalar</font></b><br>";
  }
  function debug_object($object) {
    if ($this->debug) {
      echo "<font color='#ff0000'><pre>";
      print_r($object);
      echo "</pre></font>";
    }
  }
  function debug_html($html) {
    if ($this->debug) echo "<b><font color='#ff0000'>".htmlentities($html)."</font></b><br>";
  }

 #---------------------------------------------------------[ Other Helpers ]---
  protected $months = array("January"=>"01","February"=>"02","March"=>"03","April"=>"04",
           "May"=>"05","June"=>"06","July"=>"07","August"=>"08","September"=>"09",
	   "October"=>"10","November"=>"11","December"=>"12");
  /** Get numerical value for month name
   * @method monthNo
   * @param string name name of month
   * @return integer month number
   */
  function monthNo($mon) {
    return $this->months[$mon];
  }

 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   return false;
  }

  /** Obtain page from web server
   * @method private getWebPage
   * @param string wt internal name of the page
   * @param string url URL to open
   */
  function getWebPage($wt,$url) {
    $req = new MDB_Request("");
    $req->setURL($url);
    if ($req->sendRequest()!==FALSE) $head = $req->getLastResponseHeaders();
    else ($head[0] = "HTTP/1.1 000");
    $response = explode(" ",$head[0]);
    $this->lastServerResponse = $response[1];
    switch (substr($head[0],0,12)) {
      case "HTTP/1.1 000":
        $this->page[$wt] = "cannot open page";
        $this->debug_scalar("cannot open page (could not connect to host): $url");
        return false; break;
      case "HTTP/1.1 404":
        $this->page[$wt] = "cannot open page";
        $this->debug_scalar("cannot open page (error 404): $url");
        return false; break;
      case "HTTP/1.1 301":
      case "HTTP/1.1 302":
      case "HTTP/1.1 200": break;
      default: $this->debug_scalar("HTTP response code not handled explicitly: '".$head[0]."'"); break;
    }
    $this->page[$wt]=$req->getResponseBody();
  }

  /** Load an IMDB page into the corresponding property (variable)
   * @method private openpage
   * @param string wt internal name of the page
   * @param optional string type whether its a "movie" (default) or a "person"
   */
  function openpage ($wt,$type="movie") {
   if (strlen($this->imdbID) != 7){
    $this->debug_scalar("not valid imdbID: ".$this->imdbID."<BR>".strlen($this->imdbID));
    $this->page[$wt] = "cannot open page";
    return;
   }
   $urlname = $this->set_pagename($wt);
   if ($urlname===false) return;

   if ($this->usecache) { // Try to read from cache
    $fname = "$this->cachedir/$this->imdbID.$wt";
    if ( get_class($this)=="pilot" ) $fname .= ".pilot";
    if ( $this->usezip ) {
     if ( ($this->page[$wt] = @join("",@gzfile($fname))) ) {
      if ( $this->converttozip ) {
       @$fp = fopen ($fname,"r");
       $zipchk = fread($fp,2);
       fclose($fp);
       if ( !($zipchk[0] == chr(31) && $zipchk[1] == chr(139)) ) { //checking for zip header
         /* converting on access */
         $fp = @gzopen ($fname, "w");
         @gzputs ($fp, $this->page[$wt]);
         @gzclose ($fp);
       }
      }
      return;
     }
    } else { // no zip
     @$fp = fopen ($fname, "r");
     if ($fp) {
      $temp="";
      while (!feof ($fp)) {
	 $temp .= fread ($fp, 1024);
	 $this->page[$wt] = $temp;
      }
      return;
     }
    }
   } // end cache

   switch ($type) {
     case "person" : $url = "http://".$this->imdbsite."/name/nm".$this->imdbID.$urlname; break;
     case "pilot"  : $url = "http://".$this->pilotsite.$urlname."?api_key=".$this->pilot_apikey; break;
     default       : $url = "http://".$this->imdbsite."/title/tt".$this->imdbID.$urlname;
   }
   $this->getWebPage($wt,$url);

   // Checking for redirects
   if (@preg_match('|<TITLE>(.*)</TITLE>.*The document has moved <A HREF="(.*)">|iUms',$this->page[$wt],$match)) {
     if ($match[1]=="302 Found") {
       $this->getWebPage($wt,$match[2]);
     }
   }
   if (@preg_match('|<body>You are being <a href="(.*)">redirected</a>|iUms',$this->page[$wt],$match)) { // pilot bug
     if (!preg_match('|\.json|',$match[1])) $match[1] .= ".json?api_key=".$this->pilot_apikey; // double bug
     $this->getWebPage($wt,$match[1]);
   }

   if ($this->page[$wt] == "cannot open page") return; // this should not go to the cache!
   if( $this->page[$wt] ){ //storecache
    if ($this->storecache) {
     if (!is_dir($this->cachedir)) {
       $this->debug_scalar("<BR>***ERROR*** Configured cache directory does not exist!<BR>");
       return;
     }
     if (!is_writable($this->cachedir)) {
       $this->debug_scalar("<BR>***ERROR*** Configured cache directory lacks write permission!<BR>");
       return;
     }
     $fname = "$this->cachedir/$this->imdbID.$wt";
     if ( get_class($this)=="pilot" ) $fname .= ".pilot";
     if ( $this->usezip ) {
      $fp = gzopen ($fname, "w");
      gzputs ($fp, $this->page[$wt]);
      gzclose ($fp);
     } else { // no zip
      $fp = fopen ($fname, "w");
      fputs ($fp, $this->page[$wt]);
      fclose ($fp);
     }
    }
    return;
   }
   $this->page[$wt] = "cannot open page";
   $this->debug_scalar("cannot open page: $url");
  }

 #-------------------------------------------------------[ Get current MID ]---
  /** Retrieve the IMDB ID
   * @method imdbid
   * @return string id IMDBID currently used
   */
  function imdbid () {
   return $this->imdbID;
  }

 #--------------------------------------------------[ Start (over) / Reset ]---
  /** Reset page vars
   * @method protected reset_vars
   */
  protected function reset_vars() {
    return;
  }

  /** Setup class for a new IMDB id
   * @method setid
   * @param string id IMDBID of the requested movie
   */
  function setid ($id) {
   if (!preg_match("/^\d{7}$/",$id)) $this->debug_scalar("<BR>setid: Invalid IMDB ID '$id'!<BR>");
   $this->imdbID = $id;
   $this->reset_vars();
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor imdb_base
   * @param string id IMDBID to use for data retrieval
   */
  function __construct($id) {
   parent::__construct();
   $this->setid($id);
   $this->lastServerResponse = "";
   if ($this->storecache && ($this->cache_expire > 0)) $this->purge();
  }

 #---------------------------------------------------------[ Cache Purging ]---
  /** Check cache and purge outdated files
   *  This method looks for files older than the cache_expire set in the
   *  mdb_config and removes them
   * @method purge
   */
  function purge() {
    if (is_dir($this->cachedir))  {
      if (is_writable($this->cachedir)) {
        $thisdir = dir($this->cachedir);
        $now = time();
        while( $file=$thisdir->read() ) {
          if ($file!="." && $file!="..") {
            $fname = $this->cachedir . $file;
	    if (is_dir($fname)) continue;
            $mod = filemtime($fname);
            if ($mod && ($now - $mod > $this->cache_expire)) unlink($fname);
          }
        }
      } elseif (!empty($this->cachedir)) {
        $this->debug_scalar("Cache directory (".$this->cachedir.") lacks write permission - purge aborted.");
      }
    } elseif (!empty($this->cachedir)) {
      $this->debug_scalar("Cache directory ('".$this->cachedir."') does not exist - purge aborted.");
    }
  }

 } // end class movie_base

?>
