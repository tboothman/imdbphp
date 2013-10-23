<?
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Checking class imdb_nowplaying                                            #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require_once ("imdb_nowplaying.class.php");
require_once(dirname(__FILE__)."/helpers.inc");

$imdb->cachedir = "../cache";
switch ($cache) {
  case "false":
  case "off"  :
  case "0"    : $imdb->usecache = 0; $imdb->storecache = 0;
                comment("Caching turned off.");
                break;
  case "true" :
  case "on"   :
  case 1      : $imdb->usecache = 1; $imdb->storecache = 1;
                comment("Caching turned on.");
                break;
}

$imdb = new imdb_nowplaying();

headline("Class imdb_nowplaying (Revision ".$imdb->revision.")","imdb_nowplaying");

page("Movies-In-Theaters");
// setid($imdb,"0105946");
 method($imdb,"getNowPlayingMovies");
 method($imdb,"getTop10BoxOfficeMovies");
endpage();

echo "<UL>\n";

raw(" <LI>method getNowPlayingMovies(): ");
$res  = $imdb->getNowPlayingMovies();
if (empty($res)||empty($res[0])) fail("getNowPlayingMovies");
else pass();
raw("</LI>\n");
++$GLOBALS["methods"];

echo "</UL>\n";

raw("<hr>\n");
flush();
?>