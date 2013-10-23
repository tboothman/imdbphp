<?
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Checking class imdb_budget                                                #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require_once("imdb_budget.class.php");
require_once(dirname(__FILE__)."/helpers.inc");
$imdb = new imdb_budget('0117500');

headline("Class imdb_budget (Revision ".$imdb->revision.")","imdb_budget");

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

page("Title");
 setid($imdb,"0117500");
 method($imdb,"budget");
 method($imdb,"openingWeekend");
 method($imdb,"gross");
// method($imdb,"weekendGross"); -- need IMDBID where this is available
 method($imdb,"admissions");
 method($imdb,"filmingDates");
endpage();

raw("<hr>\n");
flush();
?>