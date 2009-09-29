<?
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Checking class imdb_charts                                                #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require_once("imdb_charts.class.php");
require_once(dirname(__FILE__)."/helpers.inc");
$imdb = new imdb_topcharts;

echo "<H3>Class imdb_topcharts (Revision ".$imdb->revision.")</H3>\n";

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

echo " <LI>method getChartsTop10(): ";
$res = $imdb->getChartsTop10();
if (count($res)<10||empty($res[0])) fail();
else pass();
echo "</LI>\n";
++$GLOBALS["methods"];

echo " <LI>method getChartsTop10(): ";
$res = $imdb->getChartsBoxOffice();
if (count($res)<10||empty($res[0][0])) fail();
else pass();
echo "</LI>\n";
++$GLOBALS["methods"];

echo "<hr>\n";
flush();
?>