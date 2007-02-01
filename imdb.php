<?php

require ("imdb.class.php");

$movie = new imdb ($HTTP_GET_VARS["mid"]);

if (isset ($HTTP_GET_VARS["mid"])) {
     $movieid = $HTTP_GET_VARS["mid"];


     $movie->setid ($movieid);
     echo '<HTML><HEAD><TITLE>';
     echo $movie->title ();
     echo ' (';
     echo $movie->year ();
     echo ')';
     echo "</TITLE></HEAD>\n";

     echo '<BODY>';

     echo '<TABLE><TR><TD colspan=3><FONT size=6><B>';
     echo $movie->title ();
     echo '</B> (';
     echo $movie->year ();
     echo ")</FONT><BR><br>";
     flush ();


     echo "</TD></tr>\n";

     echo '<TR><TD rowspan=110 valign=top>';
     if (($photo_url = $movie->photo_localurl() ) != FALSE){
	  echo '<img src="'.$photo_url.'">';
     }else{
          echo "No photo available";
     }

     echo '</TD><TD valign=top width=120>';
     echo "<b>Also known as:</b> ";
     echo '</td><td>';
     foreach ( $movie->alsoknow() as $ak){
	  echo $ak["title"].": ".$ak["year"].", ".$ak["country"]." (".$ak["comment"].")<BR>";
     }

     echo '</td></tr>';

     echo '<TR><TD>';
     echo '<B>Year:</B></TD><TD>';
     echo $movie->year ();
     echo '</TD></TR>';

     echo '<TR><TD valign=top>';
     echo '<B>Runtime:</b>';
     echo '</TD><TD>';
     echo $movie->runtime ().' minutes';
     echo '</TD></TR>';

/*     echo '<TR><TD valign=top>';
     echo '<B>Runtime line:</b>';
     echo '</TD><TD>';
     echo $movie->runtime_all ();
     echo '</TD></TR>';*/

     echo '<TR><TD valign=top>';
     echo '<B>All Runtimes:</b>';
     echo '</TD><TD>';
     $runtimes = $movie->runtimes ();

     foreach ($movie->runtimes() as $runtimes){
	  echo $runtimes["time"]." min in ".$runtimes["country"]." (".$runtimes["comment"].")<BR>";
//	  if ( ($i+1) != count($runtimes)) echo ", ";
     }

     echo '</TD></TR>';


     echo '<TR><TD>';
     echo '<B>Rating:</b>';
     echo '</TD><TD>';
     echo $movie->rating ();
     echo '</TD></TR>';

     echo '<TR><TD>';
     echo '<B>Votes:</B>';
     echo '</TD><TD>';
     echo $movie->votes ();
     echo '</TD></TR>';

     echo '<TR><TD>';
     echo '<b>Languages:</B>';
     echo '</TD><TD>';
     $languages = $movie->languages ();
	      for ($i = 0; $i + 1 < count ($languages); $i++) {
	 	  echo $languages[$i];
	 	  echo ", ";
	      }
     echo $languages[$i];
 //    echo $movie->language ();
     echo '</TD></TR>';

     echo '<TR><TD>';
     echo '<b>Country:</B>';
     echo '</TD><TD>';
     $country = $movie->country ();
     for ($i = 0; $i + 1 < count ($country); $i++) {
	  echo $country[$i];
	  echo ", ";
     }
     echo $country[$i];
     echo '</TD></TR>';


     echo '<TR><TD>';
     echo '<b>Genre:</b>';
     echo '</TD><TD>';
     echo $movie->genre ();
     echo '</TD></TR>';

     echo '<TR><TD>';
     echo '<b>Colors:</b>';
     echo '</TD><TD>';
     $col = $movie->colors ();
     for ($i = 0; $i + 1 < count ($col); $i++) {
	  echo $col[$i];
	  echo ", ";
     }
     echo $col[$i];
     echo '</TD></TR>';

     echo '<TR><TD>';
     echo '<b>Sound:</B>';
     echo '</TD><TD>';
     $sound = $movie->sound ();
     for ($i = 0; $i + 1 < count ($sound); $i++) {
	  echo $sound[$i];
	  echo ", ";
     }
     echo $sound[$i];
     echo '</TD></TR>';


     echo '<TR><TD>';
     echo '<b>All Genres:</B>';
     echo '</TD><TD>';
     $gen = $movie->genres ();
     for ($i = 0; $i + 1 < count ($gen); $i++) {
	  echo $gen[$i];
	  echo ", ";
     }
     echo $gen[$i];
     echo '</TD></TR>';

     echo '<TR><TD valign=top>';
     echo '<b>Tagline:</b>';
     echo '</TD><TD>';
     echo $movie->tagline ();
     echo '</TD></TR>';



     $director = $movie->director();
     echo '<TR><TD valign=top>';
     echo "<B>Director:</B>";
     echo '</td><td><table>';
     for ($i = 0; $i < count ($director); $i++) {
       echo '<tr><td width=200>';
       echo '<a href="http://us.imdb.com/Name?';
       echo $director[$i]["imdb"];
       echo '">';
	  echo $director[$i]["name"];
	  echo "</a></td><td>";
	  echo $director[$i]["role"];
	  echo "</td></tr>\n";
     }
     echo '</table></td></tr>';

     $write = $movie->writing();
     echo '<TR><TD valign=top>';
     echo "<B>Writing By:</B>";
     echo '</td><td><table>';
     for ($i = 0; $i < count ($write); $i++) {
       echo '<tr><td width=200>';
       echo '<a href="http://us.imdb.com/Name?';
       echo $write[$i]["imdb"];
       echo '">';
	  echo $write[$i]["name"];
	  echo "</a></td><td>";
	  echo $write[$i]["role"];
	  echo "</td></tr>\n";
     }
     echo '</table></td></tr>';

     $produce = $movie->producer();
     echo '<TR><TD valign=top>';
     echo "<B>Produced By:</B>";
     echo '</td><td><table>';
     for ($i = 0; $i < count ($produce); $i++) {
       echo '<tr><td width=200>';
       echo '<a href="http://us.imdb.com/Name?';
       echo $produce[$i]["imdb"];
       echo '">';
	  echo $produce[$i]["name"];
	  echo "</a></td><td>";
	  echo $produce[$i]["role"];
	  echo "</td></tr>\n";
     }
     echo '</table></td></tr>';


     $cast = $movie->cast();
     echo '<TR><TD valign=top>';
     echo "<B>Cast:</B>";
     echo '</td><td><table>';
     for ($i = 0; $i < count ($cast); $i++) {
       echo '<tr><td width=200>';
       echo '<a href="http://us.imdb.com/Name?';
       echo $cast[$i]["imdb"];
       echo '">';
	  echo $cast[$i]["name"];
	  echo "</a></td><td>";
       echo $cast[$i]["role"];
	  echo "</td></tr>\n";
     }
     echo '</table></td></tr>';


	      echo '<tr><td valign=top>';
	      echo '<b>Plot Outline:</b>';
	      echo '</td><td>';
	      echo $movie->plotoutline ();
	 	  echo '</td></tr>';


     $plot = $movie->plot ();
     echo '<tr><td valign=top>';
     echo '<b>Plot:</b>';
     echo '</td><td>';
     for ($i = 0; $i < count ($plot); $i++) {
	  echo "<li>";
	  echo $plot[$i];
	  echo "\n";
     }
     echo '</td></tr>';

     $taglines = $movie->taglines ();
     echo '<tr><td valign=top>';
     echo '<b>Taglines:</b>';
     echo '</td><td>';
     for ($i = 0; $i < count ($taglines); $i++) {
	  echo "<li>";
	  echo $taglines[$i];
	  echo "\n";
     }
     echo '</td></tr>';


	      echo '<tr><td valign=top>';
	      echo '<b>User Comments:</b>';
	      echo '</td><td>';
	      echo $movie->comment ();
	 	  echo '</td></tr>';


     echo '</TABLE><BR>';



}

?>


