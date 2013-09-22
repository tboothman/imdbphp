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

echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
echo "<HTML><HEAD>\n <TITLE>IMDBPHP Cache Contents</TITLE>\n";
echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; }</STYLE>\n";
echo "</HEAD><BODY>\n";
$imdb   = new imdb("0");
$movies = array();
if ( is_dir($imdb->cachedir) ) {
  $files = glob($imdb->cachedir.'*.Title');
    foreach ($files as $file) {
      if ( preg_match('!^(\d{7})\.Title$!i',basename($file),$match) ) $movies[] = array('imdbid'=>$match[1],'imdb'=>1);
    }
}

if (!empty($movies)) {
  echo "<TABLE ALIGN='center' BORDER='1' STYLE='border-collapse:collapse;margin-top:20px;'>\n"
     . " <TR><TH STYLE='background-color:#ffb000'>Movie</TH><TH STYLE='background-color:#ffb000'>IMDB</TH><TH STYLE='background-color:#ffb000'>MoviePilot</TR>\n";
  foreach($movies as $movie) {
    $imdb->setid($movie['imdbid']);
    $title = $imdb->title();
    echo " <TR><TD>$title</TD><TD ALIGN='center'>";
    // IMDB
    if ($movie['imdb']) echo "<a href='movie.php?engine=imdb&mid=".$movie['imdbid']."'>Cache</a> | ";
    else echo "Cache | ";
    echo "<a href='http://us.imdb.com/title/tt".$movie['imdbid']."'>Remote</TD><TD ALIGN='center'>";
    // MoviePilot
    echo "<a href='http://www.moviepilot.de/movies/imdb-id-".(int)$movie['imdbid']."'>Remote</a></TD></TR>\n";
  }
  echo "</TABLE>\n";
}

echo "</BODY></HTML>";
?>
