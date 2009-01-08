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
 # Search for $name and display results                                      #
 #############################################################################
 # $Id$

# If MID has been explicitly given, we don't need to search:
if (!empty($_GET["mid"])) {
  switch($_GET["searchtype"]) {
    case "nm" : header("Location: imdbperson.php?mid=".$_GET["mid"]); break;
    default   : header("Location: imdb.php?mid=".$_GET["mid"]); break;
  }
  exit;
}

# If we have no MID and no NAME, go back to search page
if (empty($_GET["name"])) {
  header("Location: index.html");
  exit;
}

# Still here? Then we need to search for the movie:
switch($_GET["searchtype"]) {
  case "nm" : require ("imdb_person.class.php");
              $search = new imdbpsearch();
              $headname = "Person";
              break;
  default   : require ("imdb.class.php");
              $search = new imdbsearch ();
              if ($_GET["searchtype"]=="episode") $search->search_episodes(TRUE);
              else $search->search_episodes(FALSE);
              $headname = "Movie";
              break;
}

$search->setsearchname ($_GET["name"]);
echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
echo "<HTML><HEAD>\n <TITLE>Performing IMDB search for '".$_GET["name"]."'...</TITLE>\n";
echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; font-family:sans-serif; }</STYLE>\n</HEAD><BODY>\n";
$results = $search->results ();
echo "<TABLE ALIGN='center' BORDER='1' STYLE='border-collapse:collapse;margin-top:20px;'>\n"
   . " <TR><TH STYLE='background-color:#ffb000'>$headname Details</TH><TH STYLE='background-color:#ffb000'>IMDB page</TH></TR>";
foreach ($results as $res) {
  switch($_GET["searchtype"]) {
    case "nm" :
      echo " <TR><TD><a href='imdb_person.php?mid=".$res->imdbid()."'>".$res->name()."</a></TD>"
         . "<TD><a href='http://".$search->imdbsite."/title/nm".$res->imdbid()."'>imdb page</a></TD></TR>\n";
      break;
    default   :
      echo " <TR><TD><a href='imdb.php?mid=".$res->imdbid()."'>".$res->title()." (".$res->year().")</a></TD>"
         . "<TD><a href='http://".$search->imdbsite."/title/tt".$res->imdbid()."'>imdb page</a></TD></TR>\n";
      break;
  }
}
echo "</TABLE>\n</BODY></HTML>";
?>
