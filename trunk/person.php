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

if (isset ($_GET["mid"]) && preg_match('/^[0-9]+$/',$_GET["mid"])) {
  $pid = $_GET["mid"];
  if (isset($_GET['engine'])) $engine = $_GET['engine'];
  else $engine = 'imdb';

  switch($engine) {
    default:
        require("imdb_person.class.php");
        $person = new imdb_person($_GET["mid"]);
        $charset = "utf-8";
        $source  = "<B CLASS='active'>IMDB</B>";
        break;
  }

  $person->setid ($pid);

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n";
  echo " <TITLE>".$person->name()." [IMDBPHP2 v".$person->version." Demo]</TITLE>\n";
  echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; font-family:sans-serif; }</STYLE>\n";
  echo " <META http-equiv='Content-Type' content='text/html; charset=$charset'>\n";
  echo "</HEAD>\n<BODY>\n<TABLE BORDER='1' ALIGN='center' STYLE='border-collapse:collapse'>";

  # Name
  echo '<TR><TH COLSPAN="3" STYLE="background-color:#ffb000">';
  echo "[IMDBPHP2 v".$person->version." Demo] Details for " . $person->name();
  echo "<SPAN STYLE='float:right;text-align:right;display:inline !important;font-size:75%;'>Source: [$source]</SPAN>";
  echo "</TH></tr>\n";
  flush();

  # Photo
  echo '<TR><TD rowspan="28" valign="top">';
  if (($photo_url = $person->photo_localurl() ) != FALSE) {
    echo '<div align="center"><img src="'.$photo_url.'" alt="Cover"></div>';
  } else {
    echo "No photo available";
  }

  # Birthday
  $birthday = $person->born();
  if (!empty($birthday)) {
    echo "<div align='center' style='font-size:10px;'>".$person->name()."<br><b>&#9788;</b> ".$birthday["day"].".".$birthday["month"]." ".$birthday["year"];
    if (!empty($birthday["place"])) echo "<br>in ".$birthday["place"];
    echo "</div>";
  }

  # Death
  $death = $person->died();
  if (!empty($death)) {
    echo "<div align='center' style='font-size:10px;'><b>&#8224;</b> ".$death["day"].".".$death["month"]." ".$death["year"];
    if (!empty($death["place"])) echo "<br>in ".$death["place"];
    if (!empty($death["cause"])) echo "<br>Cause: ".$death["cause"];
    echo "</div>";
  }

  # Birthname
  $bn = $person->birthname();
  if (empty($bn)) {
    echo "</TD><TD COLSPAN='2'>&nbsp;</TD></TR>\n";
  } else {
    echo "</TD><TD><B>Birth Name:</B></TD><TD>$bn</TD></TR>\n";
  }

  # Nickname
  $nicks = $person->nickname();
  if (!empty($nicks)) {
    echo "<TR><TD><B>Nicknames:</B></TD><TD>";
    $txt = "";
    foreach ($nicks as $nick) $txt .= "<br>$nick";
    echo substr($txt,4)."</TD></TR>\n";
  }

  # Body Height
  $bh = $person->height();
  if (!empty($bh)) {
    echo "<TR><TD><B>Body Height:</B></TD><TD>".$bh["metric"]."</TD></TR>\n";
  }

  # Spouse(s)
  $sp = $person->spouse();
  if (!empty($sp)) {
    echo "<TR><TD><B>Spouse(s):</B></TD><TD>";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Spouse</th><th style='background-color:#07f;'>Period</th><th style='background-color:#07f;'>Comment</th></tr>";
    foreach ($sp as $spouse) {
      echo "<tr><td><a href='?mid=".$spouse["imdb"]."&engine=".$engine."'>".$spouse["name"]."</a></td>";
      if (empty($spouse["from"])) echo "<td>&nbsp;</td>";
      else {
        echo "<td>".$spouse["from"]["day"].".".$spouse["from"]["month"]." ".$spouse["from"]["year"];
        if (!empty($spouse["to"])) echo " - ".$spouse["to"]["day"].".".$spouse["to"]["month"]." ".$spouse["to"]["year"];
        echo "</td>";
      }
      if (empty($spouse["comment"])&&empty($spouse["children"])) echo "<td>&nbsp;</td></tr>";
      else {
        echo "<td>";
        if (empty($spouse["comment"])&&!empty($spouse["children"])) echo "Kids: ".$spouse["children"]."</td></tr>";
        elseif (empty($spouse["children"])&&!empty($spouse["comment"])) echo $spouse["comment"]."</td></tr>";
        else echo $spouse["comment"]."; Kids: ".$spouse["children"]."</td></tr>";
      }
    }
    echo "</table></TD></TR>\n";
  }

  # MiniBio
  $bio = $person->bio();
  if (!empty($bio)) {
    if (count($bio)<2) $idx = 0; else $idx = 1;
    echo "<TR><TD><B>Mini Bio:</B></TD><TD>".preg_replace('/http\:\/\/'.str_replace(".","\.",$person->imdbsite).'\/name\/nm(\d{7})\//','?mid=\\1&engine='.$engine,$bio[$idx]["desc"])."<BR>(Written by: ".$bio[$idx]['author']['name'].")</TD></TR>\n";
  }

  # Some Trivia (Personal Quotes work the same)
  $trivia = $person->trivia();
  if (!empty($trivia)) {
    $tc = count($trivia);
    echo "<TR><TD><B>Trivia:</B></TD><TD>There are $tc trivia records. Some examples:<UL>";
    for ($i=0;$i<$tc;++$i) {
      if ($i==5) break;
      echo "<LI>".$trivia[$i]."</LI>";
    }
    echo "</UL></TD></TR>\n";
  }

  # Trademarks
  $tm = $person->trademark();
  if (!empty($tm)) {
    echo "<TR><TD><B>Trademarks:</B></TD><TD><UL>";
    foreach ($tm as $trade) echo "<LI>$trade</LI>";
    echo "</UL></TD></TR>\n";
  }

  # Salary
  $sal = $person->salary();
  if (!empty($sal)) {
    echo "<TR><TD><B>Salary:</B></TD><TD>";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Movie</th><th style='background-color:#07f;'>Salary</th></tr>";
    $tc = count($sal);
    for ($i=0;$i<$tc;++$i) {
      echo "<tr><td>";
      if (!empty($sal[$i]["movie"]["imdb"])) echo "<a href='movie.php?mid=".$sal[$i]["movie"]["imdb"]."&engine=".$engine."'>".$sal[$i]["movie"]["name"]."</a>";
      else echo $sal[$i]["movie"]["name"];
      if (!empty($sal[$i]["movie"]["year"])) echo " (".$sal[$i]["movie"]["year"].")";
      echo "</td><td>".$sal[$i]["salary"]."</td></tr>";
    }
    echo "</table></TD></TR>\n";
  }

  // This also works for all the other filmographies:
  $ff = array("producer","director","actor","self");
  foreach ($ff as $var) {
    $fdt = "movies_$var";
    $filmo = $person->$fdt();
    $flname = ucfirst($var)."s Filmography";
    if (!empty($filmo)) {
      echo "<TR><TD><b>$flname:</b> </td><td>\n";
      echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Movie</th><th style='background-color:#07f;'>Character</th></tr>";
      foreach ($filmo as $film) {
        echo "<tr><td><a href='movie.php?mid=".$film["mid"]."&engine=".$engine."'>".$film["name"]."</a>";
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
    }
  }

  # Publications about this person
  $books = $person->pubprints();
  if (!empty($books)) {
    echo "<TR><TD><B>Publications:</B></TD><TD>";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Author</th><th style='background-color:#07f;'>Title</th><th style='background-color:#07f;'>Year</th><th style='background-color:#07f;'>ISBN</th></tr>";
    $tc = count($books);
    for ($i=0;$i<$tc;++$i) {
      echo "<tr><td>".$books[$i]["author"]."</td><td>".$books[$i]["title"]."</td><td>".$books[$i]["year"]."</td><td>";
      if (!empty($books[$i]["url"])) echo "<a href='".$books[$i]["url"]."'>".$books[$i]["isbn"]."</a></td></tr>";
      elseif (!empty($books[$i]["isbn"])) echo $books[$i]["isbn"]."</td></tr>";
      else echo "&nbsp;</td></tr>";
    }
    echo "</table></TD></TR>\n";
  }

  # Biographical movies
  $pm = $person->pubmovies();
  if (!empty($pm)) {
    echo "<TR><TD><B>Biographical movies:</B></TD><TD>";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Movie</th><th style='background-color:#07f;'>Year</th></tr>";
    $tc = count($pm);
    for ($i=0;$i<$tc;++$i) {
      echo "<tr><td><a href='movie.php?mid=".$pm[$i]["imdb"]."&engine=".$engine."'>".$pm[$i]["name"]."</a></td><td>";
      if (empty($pm[$i]["year"])) echo "&nbsp;</td></tr>";
      else echo $pm[$i]["year"]."</td></tr>";
    }
    echo "</table></TD></TR>\n";
  }

  # Interviews (articles, pictorials, and magcovers work the same)
  $iv = $person->interviews();
  if (!empty($iv)) {
    echo "<TR><TD><B>Interviews:</B></TD><TD>";
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Interview</th><th style='background-color:#07f;'>Details</th><th style='background-color:#07f;'>Year</th><th style='background-color:#07f;'>Author</th></tr>";
    $tc = count($iv);
    for ($i=0;$i<$tc;++$i) {
      echo "<tr><td>";
      if ( empty($iv[$i]['inturl']) ) {
        echo $iv[$i]["name"];
      } else {
        echo "<a href='http://".$person->imdbsite.$iv[$i]["inturl"]."'>".$iv[$i]["name"]."</a>";
      }
      echo "</td><td>".$iv[$i]["details"]."</td><td>".$iv[$i]["date"]["full"]."</td><td>";
      if (empty($iv[$i]["author"])) echo "&nbsp;</td></tr>";
      else {
        if ( empty($iv[$i]['auturl']) ) echo $iv[$i]["author"];
        else echo "<a href='http://".$person->imdbsite.$iv[$i]["auturl"]."'>".$iv[$i]["author"]."</a>";
      echo "</td></tr>";
      }
    }
    echo "</table></TD></TR>\n";
  }

  echo '</TABLE><BR>';
}
?>
