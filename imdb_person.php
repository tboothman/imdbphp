<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require ("imdb_person.class.php");

$person = new imdb_person ($_GET["mid"]);

if (isset ($_GET["mid"])) {
  $pid = $_GET["mid"];
  $person->setid ($pid);

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n <TITLE>".$person->name()."</TITLE>\n";
  echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; }</STYLE>\n";
  echo "</HEAD>\n<BODY>\n<TABLE BORDER='1' ALIGN='center' STYLE='border-collapse:collapse'>";

  # Name
  echo '<TR><TH COLSPAN="3" STYLE="background-color:#ffb000">';
  echo $person->name()."</TH></tr>\n";
  flush();

  # Photo
  echo '<TR><TD rowspan="28" valign="top">';
  if (($photo_url = $person->photo_localurl() ) != FALSE) {
    echo '<img src="'.$photo_url.'" alt="Cover">';
  } else {
    echo "No photo available";
  }

  // This also works for all the other filmographies:
  $filmo = $person->movies_actor();
  if (!empty($filmo)) {
    echo "<TR><TD><b>Actors Filmographie:</b> </td><td>\n";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Movie</th><th style='background-color:#07f;'>Character</th></tr>";
    foreach ($filmo as $film) {
      echo "<tr><td><a href='imdb.php?mid=".$film["mid"]."'>".$film["name"]."</a>";
      if (!empty($film["year"])) echo " (".$film["year"].")";
      echo "</td><td>";
      if (empty($film["chname"])) echo "&nbsp;";
      else {
        if (empty($film["chid"])) echo $film["chname"];
        else echo "<a href='http://".$person->imdbsite."/character/ch".$film["chid"]."/'>".$film["chname"]."</a>";
      }
      echo "</td></tr>";
    }
    echo "</table></TD></TR>\n";
    echo "</td></tr>\n";
  }

  echo '</TABLE><BR>';
}
?>
