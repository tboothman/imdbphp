<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # IMDBPHP NOW PLAYING                                     (c) Ricardo Silva #
 # written by Ricardo Silva (banzap) <banzap@gmail.com>                      #
 # http://www.ricardosilva.pt.tl/                                            #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################
 # $Id$

 require_once (dirname(__FILE__)."/mdb_base.class.php");

 #=================================================[ The IMDB Person class ]===
 /** Obtain the Now Playing Movies in theaters of USA, from IMDB
  * @package IMDB
  * @class imdb_nowplaying
  * @extends imdb_base
  * @author Ricardo Silva (banzap) <banzap@gmail.com>
  * @version $Revision$ $Date$
  */
 class imdb_nowplaying {
 	var $nowplayingpage = "http://www.imdb.com/nowplaying/";
	var $page = "";

	/** Constructor: Obtain the raw data from IMDB site
	 * @constructor imdb_nowplaying
	 */
	function imdb_nowplaying(){
	   $req = new MDB_Request($this->nowplayingpage);
	   $req->sendRequest();
	   $this->page=$req->getResponseBody();
	   $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
	}

	/** Retrieve the Now Playing Movies
	 * @method getNowPlayingMovies
	 * @return array of IMDB IDs
	 */
	function getNowPlayingMovies(){
	  $matchinit = "<!-- begin main body -->";
	  $matchend = "<!-- begin box office top 10 -->";
	  $init_pos = strpos($this->page,$matchinit);
  	  $end_pos = strpos($this->page,$matchend);
	  $init_pos += (strlen($matchinit)+1);
	  $offset = $init_pos;
	  $i=0;
	  $res = array();
	  while($offset<$end_pos){
	    $pattern = "<a href=\"/title/tt(\d+)/\">";
	    $matches = "";
	    preg_match($pattern, $this->page , $matches,PREG_OFFSET_CAPTURE,$offset);
	    if($end_pos<$matches[0][1]+1) break;
	    $mid_i = strpos($this->page,"tt",$matches[0][1])+2;
	    $mid = substr($matches[0][0],17,7);
	    $contem = in_array($mid, $res);
	    if(!$contem) $res[$i] = $mid;
	    $offset = $matches[0][1]+1;
	    $i++;
	  }
	  return $res;
	}
 }
?>
