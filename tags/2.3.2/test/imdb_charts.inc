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

headline("Class imdb_topcharts (Revision ".$imdb->revision.")","imdb_topcharts");

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

echo "<UL>\n";

raw(" <LI>method getChartsTop10(): ");
$res = $imdb->getChartsTop10();
if (count($res)<10||empty($res[0])) fail("getChartsTop10");
else pass();
raw("</LI>\n");
++$GLOBALS["methods"];

raw(" <LI>method getChartsBoxOffice(): ");
$res = $imdb->getChartsBoxOffice();
if (count($res)<10||empty($res[0][0])) fail("getChartsBoxOffice");
else pass();
raw("</LI>\n");
++$GLOBALS["methods"];

echo "</UL>\n";

raw("<hr>\n");
flush();
?>