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

require_once("imdb.class.php");

$conf = new imdb_config;
echo "<HTML><HEAD><TITLE>IMDBPHP Cache Contents</TITLE></HEAD><BODY>";
$movie = new imdb ("0");
if ($d = opendir ($conf->cachedir)) {
  echo "<TABLE ALIGN='center' BORDER='1' STYLE='border-collapse:collapse;margin-top:20px;'>\n"
     . " <TR><TH STYLE='background-color:#ffb000'>Movie Details</TH><TH STYLE='background-color:#ffb000'>IMDB page</TH></TR>\n";
  while (false !== ($entry = readdir ($d))) {
    if (strstr ($entry, "Title")) {
       $imdbid = substr ($entry, 0, 7);
       $movie->setid ($imdbid);
       echo " <TR><TD><a href=imdb.php?mid=${imdbid}>".$movie->title()."</a></TD>"
            .    "<TD><a href=\"http://us.imdb.com/title/tt${imdbid}\">imdb page</a></TD></TR>\n";
    }
  }
  echo "</TABLE>\n</BODY></HTML>";
}
echo "</BODY></HTML>";
?>
