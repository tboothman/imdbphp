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

require_once("movieposterdb.class.php");
require_once(dirname(__FILE__)."/helpers.inc");
$imdb = new movieposterdb('0117500');

headline("Class movieposterdb (Revision ".$imdb->revision.")","movieposterdb");

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
 method($imdb,"posters");
 method($imdb,"covers");
 method($imdb,"logos");
// method($imdb,"weekendGross"); -- need IMDBID where this is available
 method($imdb,"unsets");
// method($imdb,"others");
endpage();

raw("<hr>\n");
flush();
?>