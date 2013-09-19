<?php
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
require_once("pilot.class.php");

echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
echo "<HTML><HEAD>\n <TITLE>IMDBPHP Cache Contents</TITLE>\n";
echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; }</STYLE>\n";
echo "</HEAD><BODY>\n";
$imdb   = new imdb("0");
$pilot  = new pilot("0");
$movies = array();
if ($d = opendir ($imdb->cachedir)) {
  while (false !== ($entry = readdir ($d))) {
    if (strstr ($entry, "Title")) {
       $imdbid = substr ($entry, 0, 7);
       if (preg_match('|.pilot$|',$entry)) $movies[$imdbid]['pilot'] = 1;
       else $movies[$imdbid]['imdb'] = 1;
    }
  }
}

if (!empty($movies)) {
  echo "<TABLE ALIGN='center' BORDER='1' STYLE='border-collapse:collapse;margin-top:20px;'>\n"
     . " <TR><TH STYLE='background-color:#ffb000'>Movie</TH><TH STYLE='background-color:#ffb000'>IMDB</TH><TH STYLE='background-color:#ffb000'>MoviePilot</TR>\n";
  foreach($movies as $movie) {
    if ($movie['imdb']) {
      $imdb->setid($imdbid);
      $title = $imdb->title();
    } else {
      $pilot->setid($imdbid);
      $title = $pilot->title();
    }
    echo " <TR><TD>$title</TD><TD>";
    // IMDB
    if ($movie['imdb']) echo "<a href='movie.php?engine=imdb&mid=${imdbid}'>Cache</a> | ";
    else echo "Cache | ";
    echo "<a href='http://us.imdb.com/title/tt${imdbid}'>Remote</TD><TD>";
    // MoviePilot
    if ($movie['pilot']) echo "<a href='movie.php?engine=pilot&mid=${imdbid}'>Cache</a> | ";
    else echo "Cache | ";
    echo "<a href='http://www.moviepilot.de/movies/imdb-id-".(int)$imdbid."'>Remote</a></TD></TR>\n";
  }
  echo "</TABLE>\n";
}

echo "</BODY></HTML>";
?>
