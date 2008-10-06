<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # IMDBPHP TRAILERS                                        (c) Ricardo Silva #
 # written by Ricardo Silva (banzap) <banzap@gmail.com>                      #
 # http://www.ricardosilva.pt.tl/                                            #
 # rewritten and extended by Itzchak Rehberg <izzysoft AT qumran DOT org>    #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################
 # $Id$

 require_once (dirname(__FILE__)."/imdb_base.class.php");

 #=================================================[ The IMDB Charts class ]===
 /** Obtaining the URL of the trailer Flash Movie
  * @package Api
  * @class imdb_trailers
  * @extends imdb_base
  * @author Ricardo Silva (banzap) <banzap@gmail.com>
  * @version $Revision$ $Date$
  */
 class imdb_trailers {
	var $page = "";
	var $moviemazeurl = "http://www.moviemaze.de";
	var $alltrailersurl = "http://www.alltrailers.net";
	var $latemagurl = "http://latemag.com";
	var $moviemazeflashplayer = "/media/trailer/flash/player.swf";
	var $latemagflashplayer = "/files/mediaplayer.swf";
	var $moviemazefilesyntax = "file=";
	var $latemagfilesyntax = "file=";

	/** Constructor: Nothing (yet)
	 * @constructor imdb_trailers
	 */
	function imdb_trailers(){
	}
		
       /** Retrieve trailer URLs from moviemaze.de
        * @method getFlashCodeMovieMaze
	* @param string url trailer url as retrieved with imdb::trailers
	* @comment the URL of the trailer in http://www.moviemaze.de, this URL its obtained from the IMDB class, using the trailer function.
	* @return array URLs of movie trailers (Flash or Quicktime)
	*/
       function getFlashCodeMovieMaze($url){
	  $req = new IMDB_Request($url);
	  $req->sendRequest();
	  $this->page=$req->getResponseBody();
	  if($this->page=="" || $this->page==false) return false;
	  preg_match_all('/<a href="([^\"]*)\.(flv|mov)"/iUms',$this->page,$matches);
	  $mc = count($matches[0]);
	  for ($i=0;$i<$mc;++$i) {
	    $list[] = $matches[1][$i].".".$matches[2][$i];
	  }
	  return $list;
	}

       /** Retrieve trailers from alltrailers.net
        * @method getFlashCodeAllTrailers
	* @param string url page url as retrieved with imdb::trailers
	* @comment the URL of the trailer in http://www.alltrailers.net, this URL its obtained from the IMDB class, using the trailer function.
	* @return array URLs of movie trailers (Flash or Quicktime)
	*/
	function getFlashCodeAllTrailers($url){
	  if (strpos($url,"http://alltrailers")!==FALSE) $url = str_replace("http://","http://www.",$url);
	  $req = new IMDB_Request($url);
	  $req->sendRequest();
  	  $pattern = "'";
	  $this->page=$req->getResponseBody();
	  if($this->page=="" || $this->page==false) return false;
	  preg_match_all('|<embed src="([^\"]*)"|iUms',$this->page,$matches);
	  $mc = count($matches[1]);
	  for ($i=0;$i<$mc;++$i) {
	    if (strpos($matches[1][$i],"http://")===0) $list[$i] = $matches[1][$i];
	    else $list[$i] = $this->alltrailersurl.$matches[1][$i];
	  }
	  return $list;
       }
 } // end class imdb_trailers

/*
/// Example of using with IMDB class:

$movie = new imdb($mid);
$showtrailer = new imdb_trailers();
$arraytrailers = $movie->trailers();

foreach ($arraytrailers as $trail_url) {
  $url = strtolower($trail_url);
  if ( strpos($url,"www.moviemaze.de")!==FALSE ) // moviemaze URL
    $mm_urls = $showtrailer->getFlashCodeMovieMaze($trail_url);
  elseif (strpos($url,"alltrailers.net")!==FALSE) // AllTrailers.Net
    $at_urls = $showtrailer->getFlashCodeAllTrailers($trail_url);
}

*/
?>
