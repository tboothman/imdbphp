<?
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Checking class imdb_trailers                                              #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require_once("imdb.class.php");
require_once("imdb_trailers.class.php");
require_once(dirname(__FILE__)."/helpers.inc");

$showtrailer = new imdb_trailers();
$imdb = new imdb("0117571"); // page with AllTrailers trailer

echo "<H3>Checking class imdb_trailers...</H3>\n";

$imdb->cachedir = "../cache";
switch ($_REQUEST["cache"]) {
  case "false":
  case "off"  :
  case "0"    : $imdb->usecache = 0; $imdb->storecache = 0;
                echo "<p>Caching turned off.</p>";
                break;
  case "true" :
  case "on"   :
  case 1      : $imdb->usecache = 1; $imdb->storecache = 1;
                echo "<p>Caching turned on.</p>";
                break;
}

echo " <LI>method getFlashCodeAllTrailers(): ";
$arraytrailers = $imdb->trailers(); // array of URLs
foreach ($arraytrailers as $trail_url) {
  $url = strtolower($trail_url);
  if (strpos($url,"alltrailers.net")!==FALSE) // AllTrailers.Net
    $res = $showtrailer->getFlashCodeAllTrailers($trail_url);
}
if (count($res)<1||empty($res[0])) fail();
else pass();
echo "</LI>\n";
++$GLOBALS["methods"];

echo " <LI>method getFlashCodeMovieMaze(): ";
$imdb->setid("0758774"); // page with MovieMaze trailers
$arraytrailers = $imdb->trailers(); // array of URLs
foreach ($arraytrailers as $trail_url) {
  $url = strtolower($trail_url);
  if ( strpos($url,"www.moviemaze.de")!==FALSE ) // moviemaze URL
    $res = $showtrailer->getFlashCodeMovieMaze($trail_url);
}
if (count($res)<10||empty($res[0])) fail();
else pass();
echo "</LI>\n";
++$GLOBALS["methods"];

echo "<hr>\n";
flush();
?>
