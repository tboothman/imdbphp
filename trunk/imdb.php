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

require ("imdb.class.php");

$movie = new imdb ($_GET["mid"]);

if (isset ($_GET["mid"])) {
  $movieid = $_GET["mid"];
  $movie->setid ($movieid);

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n <TITLE>".$movie->title().' ('.$movie->year().")</TITLE>\n";
  echo " <STYLE TYPE='text/css'>body,td,th { font-size:12px; font-family:sans-serif; }</STYLE>\n";
  echo "</HEAD>\n<BODY>\n<TABLE BORDER='1' ALIGN='center' STYLE='border-collapse:collapse'>";

  # Title & year
  echo '<TR><TH COLSPAN="3" STYLE="background-color:#ffb000">';
  echo $movie->title().' ('.$movie->year().")</TH></tr>\n";
  flush();

  # Photo
  echo '<TR><TD rowspan="28" valign="top">';
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

  # Seasons
  if ( $movie->seasons() != 0 ) {
   echo '<TR><TD><B>Seasons:</B></TD><TD>'.$movie->seasons()."</TD></TR>\n";
    flush();
  }

  # Year & runtime
  echo '<TR><TD><B>Year:</B></TD><TD>'.$movie->year().'</TD></TR>';
  $runtime = $movie->runtime();
  if (!empty($runtime)) echo "<TR><TD valign=top><B>Runtime:</b></TD><TD>$runtime minutes</TD></TR>\n";
  flush();

  # MPAA
  $mpaa = $movie->mpaa();
  if (!empty($mpaa)) {
    $mpar = $movie->mpaa_reason();
    if (empty($mpar)) echo '<TR><TD><B>MPAA:</b></TD><TD>';
    else echo '<TR><TD rowspan="2"><B>MPAA:</b></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Country</th><th style='background-color:#07f;'>Rating</th></tr>";
    foreach ($mpaa as $key=>$mpaa) {
      echo "<tr><td>$key</td><td>$mpaa</td></tr>";
    }
    echo "</table></TD></TR>\n";
    if (!empty($mpar)) echo "<TR><TD>$mpar</TD></TR>\n";
  }

  # Ratings and votes
  $ratv = $movie->rating();
  if (!empty($ratv)) echo "<TR><TD><B>Rating:</b></TD><TD>$ratv</TD></TR>\n";
  $ratv = $movie->votes();
  if (!empty($ratv)) echo "<TR><TD><B>Votes:</B></TD><TD>$ratv</TD></TR>\n";
  flush();

  # Languages
  $languages = $movie->languages();
  if (!empty($languages)) {
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
    echo '<TR><TD><B>Country:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($country); $i++) {
      echo $country[$i].', ';
    }
    echo $country[$i]."</TD></TR>\n";
  }

  # Genres
  $genre = $movie->genre();
  if (!empty($genre)) echo "<TR><TD><B>Genre:</B></TD><TD>$genre</TD></TR>\n";

  $gen = $movie->genres();
  if (!empty($gen)) {
    echo '<TR><TD><B>All Genres:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($gen); $i++) {
      echo $gen[$i].', ';
    }
    echo $gen[$i]."</TD></TR>\n";
  }

  # Colors
  $col = $movie->colors();
  if (!empty($col)) {
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
    echo '<TR><TD><B>Sound:</B></TD><TD>';
    for ($i = 0; $i + 1 < count($sound); $i++) {
      echo $sound[$i].', ';
    }
    echo $sound[$i]."</TD></TR>\n";
  }

  $tagline = $movie->tagline();
  if (!empty($tagline)) {
    echo "<TR><TD valign='top'><B>Tagline:</B></TD><TD>$tagline</TD></TR>\n";
  }

  #==[ Staff ]==
  # director(s)
  $director = $movie->director();
  if (!empty($director)) {
    echo '<TR><TD valign=top><B>Director:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($director); $i++) {
      echo '<tr><td width=200>';
      echo '<a href="imdb_person.php?mid='.substr($director[$i]["imdb"],2).'">';
      echo $director[$i]["name"].'</a></td><td>';
      echo $director[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  # Story
  $write = $movie->writing();
  if (!empty($write)) {
    echo '<TR><TD valign=top><B>Writing By:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($write); $i++) {
      echo '<tr><td width=200>';
      echo '<a href="imdb_person.php?mid='.substr($write[$i]["imdb"],2).'">';
      echo $write[$i]["name"].'</a></td><td>';
      echo $write[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Producer
  $produce = $movie->producer();
  if (!empty($produce)) {
    echo '<TR><TD valign=top><B>Produced By:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($produce); $i++) {
      echo '<tr><td width=200>';
      echo '<a href="imdb_person.php?mid='.substr($produce[$i]["imdb"],2).'">';
      echo $produce[$i]["name"].'</a></td><td>';
      echo $produce[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  # Music
  $compose = $movie->composer();
  if (!empty($compose)) {
    echo '<TR><TD valign=top><B>Music:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($compose); $i++) {
      echo '<tr><td width=200>';
      echo '<a href="imdb_person.php?mid='.substr($compose[$i]["imdb"],2).'">';
      echo $compose[$i]["name"]."</a></td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Cast
  $cast = $movie->cast();
  if (!empty($cast)) {
    echo '<TR><TD valign=top><B>Cast:</B></TD><TD>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Actor</th><th style='background-color:#07f;'>Role</th></tr>";
    for ($i = 0; $i < count($cast); $i++) {
      echo '<tr><td width=200>';
      echo '<a href="imdb_person.php?mid='.substr($cast[$i]["imdb"],2).'">';
      echo $cast[$i]["name"].'</a></td><td>';
      echo $cast[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Plot outline & plot
  $plotoutline = $movie->plotoutline();
  if (!empty($plotoutline))
    echo "<tr><td valign='top'><b>Plot Outline:</b></td><td>$plotoutline</td></tr>\n";

  $plot = $movie->plot();
  if (!empty($plot)) {
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
    echo '<tr><td valign=top><b>Taglines:</b></td><td><ul>';
    for ($i = 0; $i < count($taglines); $i++) {
      echo "<li>".$taglines[$i]."</li>\n";
    }
    echo "</ul></td></tr>\n";
  }

  $seasons = $movie->seasons();
  if ( $seasons != 0 ) {
    $episodes = $movie->episodes();
    echo '<tr><td valign=top><b>Episodes:</b></td><td>';
    for ( $season = 1; $season <= $seasons; ++$season ) {
      $eps = @count($episodes[$season]);
      for ( $episode = 1; $episode <= $eps; ++$episode ) {
        $episodedata = &$episodes[$season][$episode];
        echo '<b>Season '.$season.', Episode '.$episode.': <a href="'.$_SERVER["PHP_SELF"].'?mid='.$episodedata['imdbid'].'">'.$episodedata['title'].'</a></b> (<b>Original Air Date: '.$episodedata['airdate'].'</b>)<br>'.$episodedata['plot'].'<br/><br/>';
      }
    }
    echo "</td></tr>\n";
  }

  # Selected User Comment
  $comment = $movie->comment();
  if (!empty($comment))
    echo "<tr><td valign='top'><b>User Comments:</b></td><td>$comment</td></tr>\n";

  # Quotes
  $quotes = $movie->quotes();
  if (!empty($quotes)) {
    echo '<tr><td valign=top><b>Movie Quotes:</b></td><td>';
    echo preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$quotes[0])."</td></tr>\n";
  }

  # Trailer
  $trailers = $movie->trailers();
  if (!empty($trailers)) {
    echo '<tr><td valign=top><b>Trailers:</b></td><td>';
    for ($i=0;$i<count($trailers);++$i) {
      echo "<a href='".$trailers[$i]."'>".$trailers[$i]."</a><br>\n";
    }
    echo "</td></tr>\n";
  }

  # Crazy Credits
  $crazy = $movie->crazy_credits();
  $cc    = count($crazy);
  if ($cc) {
    echo '<tr><td valign=top><b>Crazy Credits:</b></td><td>';
    echo "We know about $cc <i>Crazy Credits</i>. One of them reads:<br>$crazy[0]</td></tr>\n";
  }

  # Goofs
  $goofs = $movie->goofs();
  $gc    = count($goofs);
  if ($gc > 0) {
    echo '<tr><td valign=top><b>Goofs:</b></td><td>';
    echo "We know about $gc goofs. Here comes one of them:<br>";
    echo "<b>".$goofs[0]["type"]."</b> ".$goofs[0]["content"]."</td></tr>\n";
  }

  # Trivia
  $trivia = $movie->trivia();
  $gc     = count($trivia);
  if ($gc > 0) {
    echo '<tr><td valign=top><b>Trivia:</b></td><td>';
    echo "There are $gc entries in the trivia list - like these:<br><ul>";
    for ($i=0;$i<5;++$i) {
      if (empty($trivia[$i])) break;
      echo "<li>".preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$trivia[$i])."</li>";
    }
    echo "</ul></td></tr>\n";
  }

  # Soundtracks
  $soundtracks = $movie->soundtrack();
  $gc = count($soundtracks);
  if ($gc > 0) {
    echo '<tr><td valign=top><b>Soundtracks:</b></td><td>';
    echo "There are $gc soundtracks listed - like these:<br>";
    echo "<table align='center' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><th style='background-color:#07f;'>Soundtrack</th><th style='background-color:#07f;'>Credit 1</th><th style='background-color:#07f;'>Credit 2</th></tr>";
    for ($i=0;$i<5;++$i) {
      if (empty($soundtracks[$i])) break;
      $credit1 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$soundtracks[$i]["credits"][0]);
      $credit2 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$soundtracks[$i]["credits"][1]);
      echo "<tr><td>".$soundtracks[$i]["soundtrack"]."</td><td>$credit1</td><td>$credit2</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  echo '</TABLE><BR>';
}
?>
