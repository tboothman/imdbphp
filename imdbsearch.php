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
 # Search for $name and display results                                      #
 #############################################################################
 # $Id$

require ("imdb.class.php");

$search = new imdbsearch ();
$search->setsearchname ($_GET["name"]);
echo "<HTML><HEAD><TITLE>search</TITLE></HEAD><BODY>";
$results = $search->results ();
foreach ($results as $res) {
     echo "<a href=imdb.php?mid=";
     echo $res->imdbid();
     echo ">";
     echo $res->title();
     echo " (".$res->year().")";
     echo "</a> ";
     echo " <a href=\"http://us.imdb.com/title/tt";
     echo $res->imdbid();
     echo "\">imdb page</a>";
     echo "<br>\n";
}
echo "</BODY></HTML>";
?>
