<?php
#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# written by Giorgos Giagas                                                 #
# extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# IMDBPHP NOW PLAYING                   (c) Ricardo Silva & Itzchak Rehberg #
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
 * @author Ricardo Silva (banzap) <banzap@gmail.com>
 * @author Itzchak Rehberg
 * @version $Revision$ $Date$
 */
class imdb_nowplaying {
  var $nowplayingpage = "http://www.imdb.com/movies-in-theaters/";
  var $page = "";

  /**
   * Constructor: Obtain the raw data from IMDB site
   * @param mdb_config Optionally pass in the mdb_config object to use
   */
  function __construct(mdb_config $iconf = null) {
     $req = new MDB_Request($this->nowplayingpage, $config);
     $req->sendRequest();
     $this->page=$req->getResponseBody();
     $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
  }

  /** Retrieve the Now Playing Movies
   * @method getNowPlayingMovies
   * @return array of IMDB IDs
   */
  function getNowPlayingMovies() {
    $matchinit = '<h1 class="header">';
    $matchend = "<!-- begin TOP_RHS -->";
    $init_pos = strpos($this->page,$matchinit);
    $end_pos = strpos($this->page,$matchend);
    //$pattern = '!href="/title/tt(\d{7})/!';
    $pattern = '!rg/in-theaters/overview-title/images/b.gif\?link=/title/tt(\d+)!';
    if ( preg_match_all($pattern, substr($this->page,$init_pos,$end_pos - $init_pos), $matches) ) {
      $res = array_values(array_unique($matches[1]));
    } else {
      $res = array();
    }
    return $res;
  }

  /** Retrieve the Top 10 Box Office Movies
   * @method getTop10BoxOfficeMovies
   * @return array[0..n] of IMDB IDs
   * @author almathie
   * @author izzy
   */
  public function getTop10BoxOfficeMovies() {
    $matchinit = "<h3>In Theaters Now - Box Office Top Ten";
    $matchend = '<div class=" see-more">';
    $init_pos = strpos($this->page,$matchinit);
    $end_pos = strpos($this->page,$matchend,$init_pos);
    $pattern = '!rg/in-theaters/overview-title/images/b.gif\?link=/title/tt(\d+)!';
    if ( preg_match_all($pattern, substr($this->page,$init_pos,$end_pos - $init_pos), $matches) ) {
      $res = array_values(array_unique($matches[1]));
    } else {
      $res = array();
    }
    return $res;
  }

} // endOfClass
?>
