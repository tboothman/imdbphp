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

$engine = "imdb";

# If MID has been explicitly given, we don't need to search:
if (!empty($_GET["mid"]) && preg_match('/^[0-9]+$/',$_GET["mid"])) {
  switch($_GET["searchtype"]) {
    case "nm" : header("Location: person.php?mid=".$_GET["mid"]); break;
    default   : header("Location: movie.php?mid=".$_GET["mid"]."&engine=$engine"); break;
  }
  return;
}

# If we have no MID and no NAME, go back to search page
if (empty($_GET["name"])) {
  header("Location: index.html");
  return;
}

# Still here? Then we need to search for the movie:
switch ($_GET["searchtype"]) {
  case "nm" :
    require_once("imdb_person_search.class.php");
    $search = new imdbpsearch();
    $headname = "Person";
    $results = $search->search($_GET["name"]);
    break;
  default:
    require_once("imdbsearch.class.php");
    $search = new imdbsearch();
    if ($_GET["searchtype"] == "episode")
      $results = $search->search($_GET["name"], array(imdbsearch::TV_EPISODE));
    else
      $results = $search->search($_GET["name"]);
    $headname = "Movie";
    break;
}

echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
echo "<HTML><HEAD>\n";
echo " <TITLE>Performing search for '".$_GET["name"]."' [IMDBPHP2 v".$search->version."]</TITLE>\n";
echo " <STYLE TYPE='text/css'>body,td,th,h2 { font-size:12px; font-family:sans-serif; } th { background-color:#ffb000; } h2 { text-align:center; font-size:15px; margin-top: 20px; margin-bottom:0; }</STYLE>\n";
echo "</HEAD><BODY>\n";
$sname = htmlspecialchars($_GET['name']);
echo "<H2>[IMDBPHP2 v".$search->version." Demo] Search results for '$sname':</H2>\n";
echo "<TABLE ALIGN='center' BORDER='1' STYLE='border-collapse:collapse;margin-top:20px;'>\n"
   . " <TR><TH>$headname Details</TH><TH>IMDB</TH><TH>Moviepilot</TH></TR>";
foreach ($results as $res) {
  switch($_GET["searchtype"]) {
    case "nm" :
      $details = $res->getSearchDetails();
      if (!empty($details)) {
        $hint = " (".$details["role"]." in <a href='movie.php?mid=".$details["mid"]."'>".$details["moviename"]."</a> (".$details["year"]."))";
      }
      echo " <TR><TD><a href='person.php?mid=".$res->imdbid()."'>".$res->name()."</a>$hint</TD>"
         . "<TD ALIGN='center'><a href='http://".$search->imdbsite."/name/nm".$res->imdbid()."'>imdb page</a></TD></TR>\n";
      break;
    default   :
      if (!isset($res->addon_info)) $res->addon_info = '';
      echo " <TR><TD><a href='movie.php?mid=".$res->imdbid()."&engine=".$_GET["engine"]."'>".$res->title()." (".$res->year().") (".$res->movietype().")</a></TD>"
         . "<TD ALIGN='center'><a href='http://".$search->imdbsite."/title/tt".$res->imdbid()."'>imdb page</a></TD>"
         . "<TD ALIGN='center'><a href='http://www.moviepilot.de/movies/imdb-id-".(int)$res->imdbid()."'>pilot page</a></TD></TR>\n";
      break;
  }
}
echo "</TABLE>\n</BODY></HTML>";
