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
  $movieid = $_GET["mid"];
  $engine  = $_GET["engine"];

  switch($engine) {
    default:
        require("imdb.class.php");
        $movie = new imdb($_GET["mid"]);
        //$charset = "iso-8859-1";
        $charset = "utf8";
        $source  = "<B CLASS='active'>IMDB</B>";
        break;
  }

  $movie->setid ($movieid);
  $rows = 2; // count for the rowspan; init with photo + year

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n";
  echo " <TITLE>".$movie->title().' ('.$movie->year().") [IMDBPHP2 v".$movie->version." Demo]</TITLE>\n";
  echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; font-family:sans-serif; } b.active { color:#b00;background-color:#fff;text-decoration:underline;}</STYLE>\n";
  echo " <META http-equiv='Content-Type' content='text/html; charset=$charset'>\n";
  echo "</HEAD>\n<BODY ONLOAD='fix_colspan()'>\n<TABLE BORDER='1' ALIGN='center' STYLE='border-collapse:collapse'>";

  # Title & year
  echo '<TR><TH COLSPAN="3" STYLE="background-color:#ffb000">';
  echo "[IMDBPHP2 v".$movie->version." Demo] Movie Details for '" . $movie->title()."' (".$movie->year().")";
  echo "<SPAN STYLE='float:right;text-align:right;display:inline !important;font-size:75%;'>Source: [$source]</SPAN>";
  echo "</TH></TR>\n";
  flush();

  # Photo
  echo '<TR><TD id="photocol" rowspan="29" valign="top">';
  if (($photo_url = $movie->photo_localurl() ) != FALSE) {
    echo '<img src="'.$photo_url.'" alt="Cover">';
  } else {
    echo "No photo available";
  }

  # AKAs
  $aka = $movie->alsoknow();
  $cc  = count($aka);
  if (!empty($aka)) {
    echo '</TD><TD valign=top width=120><b>Also known as:</b> </td><td>';
    foreach ( $aka as $ak){
      echo $ak["title"];
      if (!empty($ak["year"])) echo " ".$ak["year"];
      echo  " =&gt; ".$ak["country"];
      if (empty($ak["lang"])) { if (!empty($ak["comment"])) echo " (".$ak["comment"].")"; }
      else {
        if (!empty($ak["comment"])) echo ", ".$ak["comment"];
        echo " [".$ak["lang"]."]";
      }
      echo "<BR>";
    }
    echo "</td></tr>\n";
    flush();
  }

  # Movie Type
  ++$rows;
  echo '<TR><TD><B>Type:</B></TD><TD>'.$movie->movietype()."</TD></TR>\n";

  # Keywords
  $keywords = $movie->keywords();
  if ( !empty($keywords) ) {
    ++$rows;
    echo '<TR><TD><B>Keywords:</B></TD><TD>'.implode(', ',$keywords)."</TD></TR>\n";
  }

  # Seasons
  if ( $movie->seasons() != 0 ) {
    ++$rows;
    echo '<TR><TD><B>Seasons:</B></TD><TD>'.$movie->seasons()."</TD></TR>\n";
    flush();
  }

  # Episode Details
  $ser = $movie->get_episode_details();
  if (!empty($ser)) {
    ++$rows;
    echo '<TR><TD><B>Series Details:</B></TD><TD>'.$ser['seriestitle'].' Season '.$ser['season'].', Episode '.$ser['episode'].", Airdate ".$ser['airdate']."</TD></TR>\n";
  }

  # Year & runtime
  echo '<TR><TD><B>Year:</B></TD><TD>'.$movie->year().'</TD></TR>';
  $runtime = $movie->runtime();
  if (!empty($runtime)) {
    ++$rows;
    echo "<TR><TD valign=top><B>Runtime:</b></TD><TD>$runtime minutes</TD></TR>\n";
  }
  flush();

  # MPAA
  $mpaa = $movie->mpaa();
  if (!empty($mpaa)) {
    ++$rows;
    $mpar = $movie->mpaa_reason();
    if (empty($mpar)) echo '<TR><TD><B>MPAA:</b></TD><TD>';
    else echo '<TR><TD rowspan="2"><B>MPAA:</b></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Country</th><th style='background-color:#07f;'>Rating</th></tr>";
    foreach ($mpaa as $key=>$mpaa) {
      echo "<tr><td>$key</td><td>$mpaa</td></tr>";
    }
    echo "</table></TD></TR>\n";
    if (!empty($mpar)) {
      ++$rows;
      echo "<TR><TD>$mpar</TD></TR>\n";
    }
  }

  # Ratings and votes
  $ratv = $movie->rating();
  if (!empty($ratv)) { echo "<TR><TD><B>Rating:</b></TD><TD>$ratv</TD></TR>\n"; ++$rows; }
  $ratv = $movie->votes();
  if (!empty($ratv)) { echo "<TR><TD><B>Votes:</B></TD><TD>$ratv</TD></TR>\n"; ++$rows; }
  flush();

  # Languages
  $languages = $movie->languages();
  if (!empty($languages)) {
    ++$rows;
    echo '<TR><TD><B>Languages:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($languages); $i++) {
      echo $languages[$i].', ';
    }
    echo $languages[$i]."</TD></TR>\n";
  }
  flush();

  # Country
  $country = $movie->country();
  if (!empty($country)) {
    ++$rows;
    echo '<TR><TD><B>Country:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($country); $i++) {
      echo $country[$i].', ';
    }
    echo $country[$i]."</TD></TR>\n";
  }

  # Genres
  $genre = $movie->genre();
  if (!empty($genre)) { echo "<TR><TD><B>Genre:</B></TD><TD>$genre</TD></TR>\n"; ++$rows; }

  $gen = $movie->genres();
  if (!empty($gen)) {
    ++$rows;
    echo '<TR><TD><B>All Genres:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($gen); $i++) {
      echo $gen[$i].', ';
    }
    echo $gen[$i]."</TD></TR>\n";
  }

  # Colors
  $col = $movie->colors();
  if (!empty($col)) {
    ++$rows;
    echo '<TR><TD><B>Colors:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($col); $i++) {
      echo $col[$i].', ';
    }
    echo $col[$i]."</TD></TR>\n";
  }
  flush();

  # Sound
  $sound = $movie->sound ();
  if (!empty($sound)) {
    ++$rows;
    echo '<TR><TD><B>Sound:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($sound); $i++) {
      echo $sound[$i].', ';
    }
    echo $sound[$i]."</TD></TR>\n";
  }

  $tagline = $movie->tagline();
  if (!empty($tagline)) {
    ++$rows;
    echo "<TR><TD valign='top'><B>Tagline:</B></TD><TD>$tagline</TD></TR>\n";
  }

  #==[ Staff ]==
  # director(s)
  $director = $movie->director();
  if (!empty($director)) {
    ++$rows;
    echo '<TR><TD valign=top><B>Director:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Name</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($director); $i++) {
      echo '<tr><td width=200>';
      echo "<a href='person.php?engine=$engine&mid=".$director[$i]["imdb"]."'>";
      echo $director[$i]["name"].'</a></td><td>';
      echo $director[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  # Story
  $write = $movie->writing();
  if (!empty($write)) {
    ++$rows;
    echo '<TR><TD valign=top><B>Writing By:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Name</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($write); $i++) {
      echo '<tr><td width=200>';
      echo "<a href='person.php?engine=$engine&mid=".$write[$i]["imdb"]."'>";
      echo $write[$i]["name"].'</a></td><td>';
      echo $write[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Producer
  $produce = $movie->producer();
  if (!empty($produce)) {
    ++$rows;
    echo '<TR><TD valign=top><B>Produced By:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Name</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($produce); $i++) {
      echo '<tr><td width=200>';
      echo "<a href='person.php?engine=$engine&mid=".$produce[$i]["imdb"]."'>";
      echo $produce[$i]["name"].'</a></td><td>';
      echo $produce[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  # Music
  $compose = $movie->composer();
  if (!empty($compose)) {
    ++$rows;
    echo '<TR><TD valign=top><B>Music:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Name</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($compose); $i++) {
      echo '<tr><td width=200>';
      echo "<a href='person.php?engine=$engine&mid=".$compose[$i]["imdb"]."'>";
      echo $compose[$i]["name"]."</a></td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Cast
  $cast = $movie->cast();
  if (!empty($cast)) {
    ++$rows;
    echo '<TR><TD valign=top><B>Cast:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($cast); $i++) {
      echo '<tr><td width=200>';
      echo "<a href='person.php?engine=$engine&mid=".$cast[$i]["imdb"]."'>";
      echo $cast[$i]["name"].'</a></td><td>';
      echo $cast[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Plot outline & plot
  $plotoutline = $movie->plotoutline();
  if (!empty($plotoutline)) {
    ++$rows;
    echo "<tr><td valign='top'><b>Plot Outline:</b></td><td>$plotoutline</td></tr>\n";
  }

  $plot = $movie->plot();
  if (!empty($plot)) {
    ++$rows;
    echo '<tr><td valign=top><b>Plot:</b></td><td><ul>';
    for ($i = 0; $i < count($plot); $i++) {
      echo "<li>".$plot[$i]."</li>\n";
    }
    echo "</ul></td></tr>\n";
  }
  flush();

  # Taglines
  $taglines = $movie->taglines();
  if (!empty($taglines)) {
    ++$rows;
    echo '<tr><td valign=top><b>Taglines:</b></td><td><ul>';
    for ($i = 0; $i < count($taglines); $i++) {
      echo "<li>".$taglines[$i]."</li>\n";
    }
    echo "</ul></td></tr>\n";
  }

  # Seasons
  if ( $movie->is_serial() || $movie->seasons() ) {
    ++$rows;
    $episodes = $movie->episodes();
    echo '<tr><td valign=top><b>Episodes:</b></td><td>';
    foreach ( $episodes as $season => $ep ) {
      foreach ( $ep as $episodedata ) {
        echo '<b>Season '.$episodedata['season'].', Episode '.$episodedata['episode'].': <a href="'.$_SERVER["PHP_SELF"].'?mid='.$episodedata['imdbid'].'">'.$episodedata['title'].'</a></b> (<b>Original Air Date: '.$episodedata['airdate'].'</b>)<br>'.$episodedata['plot'].'<br/><br/>';
      }
    }
    echo "</td></tr>\n";
  }

  # Locations
  $locs = $movie->locations();
  if (!empty($locs)) {
    ++$rows;
    echo '<tr><td valign="top"><b>Filming Locations:</b></td><td><ul>';
    foreach ($locs as $loc) {
      if ( empty($loc['url']) ) echo '<li>'.$loc['name'].'</li>';
      else echo '<li><a href="http://'.$movie->imdbsite.$loc['url'].'">'.$loc['name'].'</a></li>';
    }
    echo "</ul></td></tr>\n";
  }

  # Selected User Comment
  $comment = $movie->comment();
  if (!empty($comment)) {
    ++$rows;
    echo "<tr><td valign='top'><b>User Comments:</b></td><td>$comment</td></tr>\n";
  }

  # Quotes
  $quotes = $movie->quotes();
  if (!empty($quotes)) {
    ++$rows;
    echo '<tr><td valign=top><b>Movie Quotes:</b></td><td>';
    echo preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?engine=$engine&mid=\\1",$quotes[0])."</td></tr>\n";
  }

  # Trailer
  $trailers = $movie->trailers(TRUE);
  if (!empty($trailers)) {
    ++$rows;
    echo '<tr><td valign=top><b>Trailers:</b></td><td>';
    for ($i=0;$i<count($trailers);++$i) {
      if (!empty($trailers[$i]['url'])) echo "<a href='".$trailers[$i]['url']."'>".$trailers[$i]['title']."</a><br>\n";
    }
    echo "</td></tr>\n";
  }

  # Crazy Credits
  $crazy = $movie->crazy_credits();
  $cc    = count($crazy);
  if ($cc) {
    ++$rows;
    echo '<tr><td valign=top><b>Crazy Credits:</b></td><td>';
    echo "We know about $cc <i>Crazy Credits</i>. One of them reads:<br>$crazy[0]</td></tr>\n";
  }

  # Goofs
  $goofs = $movie->goofs();
  $gc    = count($goofs);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top><b>Goofs:</b></td><td>';
    echo "We know about $gc goofs. Here comes one of them:<br>";
    echo "<b>".$goofs[0]["type"]."</b> ".$goofs[0]["content"]."</td></tr>\n";
  }

  # Trivia
  $trivia = $movie->trivia();
  $gc     = count($trivia);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top><b>Trivia:</b></td><td>';
    echo "There are $gc entries in the trivia list - like these:<br><ul>";
    for ($i=0;$i<5;++$i) {
      if (empty($trivia[$i])) break;
      echo "<li>".preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?engine=$engine&mid=\\1",$trivia[$i])."</li>";
    }
    echo "</ul></td></tr>\n";
  }

  # Soundtracks
  $soundtracks = $movie->soundtrack();
  $gc = count($soundtracks);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top><b>Soundtracks:</b></td><td>';
    echo "There are $gc soundtracks listed - like these:<br>";
    echo "<table align='center' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Soundtrack</th><th style='background-color:#07f;'>Credit 1</th><th style='background-color:#07f;'>Credit 2</th></tr>";
    for ($i=0;$i<5;++$i) {
      if (isset($soundtracks[$i]["credits"][0])) $credit1 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?engine=$engine&mid=\\1",$soundtracks[$i]["credits"][0]['credit_to'])." (".$soundtracks[$i]["credits"][0]['desc'].")"; else $credit1 = '';
      if (isset($soundtracks[$i]["credits"][1])) $credit2 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?engine=$engine&mid=\\1",$soundtracks[$i]["credits"][1]['credit_to'])." (".$soundtracks[$i]["credits"][1]['desc'].")"; else $credit2 = '';
      echo "<tr><td>".$soundtracks[$i]["soundtrack"]."</td><td>$credit1</td><td>$credit2</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  echo "</TABLE><BR>\n";
  echo "<SCRIPT TYPE='text/javascript'>// <!--\n";
  echo "  function fix_colspan() {\n";
  echo "    document.getElementById('photocol').rowSpan = '$rows';\n";
  echo "  }\n//-->\n</SCRIPT>\n";
  echo "</BODY></HTML>";
}
?>
