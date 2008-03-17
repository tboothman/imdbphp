<?
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 # ------------------------------------------------------------------------- #
 # Show what we have in the Cache                                            #
 #############################################################################
 # $Id$

require_once("imdb_config.php");
require_once("imdb.class.php");

$conf = new imdb_config;
echo "<HTML><HEAD><TITLE>IMDBPHP Cache Contents</TITLE></HEAD><BODY>";
$movie = new imdb ("0");
if ($d = opendir ($conf->cachedir)) {
     while (false !== ($entry = readdir ($d))) {
	  if (strstr ($entry, "Title")) {
	       $imdbid = substr ($entry, 0, 7);
	       $movie->setid ($imdbid);
	       echo "<a href=imdb.php?mid=${imdbid}>";
	       echo $movie->title ();
	       echo "</a>";
	       echo " <a href=\"http://us.imdb.com/title/tt";
	       echo $imdbid;
	       echo "\">imdb page</a>";
	       echo "<br>\n";
	  }
     }
}
echo "</BODY></HTML>";
?>
