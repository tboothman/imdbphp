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

require __DIR__ . "/../bootstrap.php";

if (isset ($_GET["mid"]) && preg_match('/^[0-9]+$/',$_GET["mid"])) {
  $movieid = $_GET["mid"];

  $movie = new \Imdb\Title($_GET["mid"]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $movie->title().' ('.$movie->year().')' ?> - IMDbPHP</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php # Title & year ?>
    <h2 class="text-center"><?php echo $movie->title().' ('.$movie->year().')' ?></h2>
      <?php # Photo ?>
      <div class="photo text-center">
        <?php
          if (($photo_url = $movie->photo_localurl() ) != FALSE) {
            echo '<img src="'.$photo_url.'" alt="Cover">';
          } else {
            echo "No photo available";
          }
        ?>
      </div>
      <table class="table">
        <tr>
          <th colspan="2" class="move-container">
            Movie Details
            <span class="move-right pr-10">Source: [<a href="<?php echo $movie->main_url() ?>">IMDb</a>]</span>
          </th>
        </tr>
        
        <?php
        # AKAs
        $aka = $movie->alsoknow();
        $cc  = count($aka);
        if (!empty($aka)) {
        ?>
        <tr>
          <td><b>Also known as:</td>
          <td>
            <table>
              <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Country</th>
                <th>Comment</th>
              </tr>
              <?php foreach ( $aka as $ak) { ?>
                <tr>
                  <td><?php echo $ak["title"] ?></td>
                  <td><?php echo $ak["year"] ?></td>
                  <td><?php echo $ak["country"] ?></td>
                  <td><?php echo $ak["comment"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php # Movie Type ?>
        <tr>
          <td class="mw-120"><b>Type:</b></td>
          <td><?php echo $movie->movietype() ?></td>
        </tr>
        
        <?php
        # Keywords
        $keywords = $movie->keywords();
        if ( !empty($keywords) ) {
        ?>
        <tr>
          <td><b>Keywords:</b></td>
          <td><?php echo implode(', ',$keywords) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Seasons
        if ( $movie->seasons() != 0 ) {
        ?>
        <tr>
          <td><b>Seasons:</b></td>
          <td><?php echo $movie->seasons() ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Episode Details
        $ser = $movie->get_episode_details();
        if (!empty($ser)) {
        ?>
        <tr>
          <td><b>Series Details:</b></td>
          <td><?php echo $ser['seriestitle'].' | Season '.$ser['season'].', Episode '.$ser['episode'].", Airdate ".$ser['airdate'] ?></td>
        </tr>
        <?php } ?>
        
        <?php # Year ?>
        <tr>
          <td><b>Year:</b></td>
          <td><?php echo $movie->year() ?></td>
        </tr>
        
        <?php
        # Runtime
        $runtime = $movie->runtime();
        if (!empty($runtime)) {
        ?>
        <tr>
          <td><b>Runtime:</b></td>
          <td><?php echo $runtime; ?> minutes</td>
        </tr>
        <?php } ?>
        
        <?php
        # MPAA
        $mpaa = $movie->mpaa();
        if (!empty($mpaa)) {
          $mpar = $movie->mpaa_reason();
          if (empty($mpar)) {
            echo '<tr><td><b>MPAA:</b></td><td>';
          } else {
            echo '<tr><td rowspan="2"><b>MPAA:</b></td><td>';
          }
          echo "<table><tr><th>Country</th><th>Rating</th></tr>";
          foreach ($mpaa as $key=>$mpaa) {
            echo "<tr><td>$key</td><td>$mpaa</td></tr>";
          }
          echo "</table></td></tr>\n";
          if (!empty($mpar)) {
            echo "<tr><td>$mpar</td></tr>\n";
          }
        }
        ?>
        
        <?php
        # Ratings
        $ratv = $movie->rating();
        if (!empty($ratv)) {
        ?>
        <tr>
          <td><b>Rating:</b></td>
          <td><?php echo $ratv; ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Votes
        $ratv = $movie->votes();
        if (!empty($ratv)) {
        ?>
        <tr>
          <td><b>Votes:</b></td>
          <td><?php echo $ratv; ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Languages
        $languages = $movie->languages();
        if (!empty($languages)) {
        ?>
        <tr>
          <td><b>Languages:</b></td>
          <td><?php echo implode(', ',$languages) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Country
        $country = $movie->country();
        if (!empty($country)) {
        ?>
        <tr>
          <td><b>Country:</b></td>
          <td><?php echo implode(', ',$country) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Genres
        $genre = $movie->genre();
        if (!empty($genre)) {
        ?>
        <tr>
          <td><b>Genre:</b></td>
          <td><?php echo $genre ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # All Genres
        $gen = $movie->genres();
        if (!empty($gen)) {
        ?>
        <tr>
          <td><b>All Genres:</b></td>
          <td><?php echo implode(', ',$gen) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Colors
        $col = $movie->colors();
        if (!empty($col)) {
        ?>
        <tr>
          <td><b>Colors:</b></td>
          <td><?php echo implode(', ',$col) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Sound
        $sound = $movie->sound ();
        if (!empty($sound)) {
        ?>
        <tr>
          <td><b>Sound:</b></td>
          <td><?php echo implode(', ',$sound) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Tagline
        $tagline = $movie->tagline();
        if (!empty($tagline)) {
        ?>
        <tr>
          <td><b>Tagline:</b></td>
          <td><?php echo $tagline ?></td>
        </tr>
        <?php } ?>
        
        <?php
        #==[ Staff ]==
        # director(s)
        $director = $movie->director();
        if (!empty($director)) {
        ?>
        <tr>
          <td><b>Director:</td>
          <td>
            <table>
              <tr>
                <th class="mw-200">Name</th>
                <th class="mw-200">Role</th>
              </tr>
              <?php foreach ( $director as $d) { ?>
                <tr>
                  <td><a href="person.php?mid=<?php echo $d["imdb"] ?>"><?php echo $d["name"] ?></a></td>
                  <td><?php echo $d["role"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Story
        $write = $movie->writing();
        if (!empty($write)) {
        ?>
        <tr>
          <td><b>Writing By:</td>
          <td>
            <table>
              <tr>
                <th class="mw-200">Name</th>
                <th class="mw-200">Role</th>
              </tr>
              <?php foreach ( $write as $w) { ?>
                <tr>
                  <td><a href="person.php?mid=<?php echo $w["imdb"] ?>"><?php echo $w["name"] ?></a></td>
                  <td><?php echo $w["role"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Producer
        $produce = $movie->producer();
        if (!empty($produce)) {
        ?>
        <tr>
          <td><b>Produced By:</td>
          <td>
            <table>
              <tr>
                <th class="mw-200">Name</th>
                <th class="mw-200">Role</th>
              </tr>
              <?php foreach ( $produce as $p) { ?>
                <tr>
                  <td><a href="person.php?mid=<?php echo $p["imdb"] ?>"><?php echo $p["name"] ?></a></td>
                  <td><?php echo $p["role"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Music
        $compose = $movie->composer();
        if (!empty($compose)) {
        ?>
        <tr>
          <td><b>Music:</td>
          <td>
            <table>
              <tr>
                <th class="mw-200">Name</th>
                <th class="mw-200">Role</th>
              </tr>
              <?php foreach ( $compose as $c) { ?>
                <tr>
                  <td><a href="person.php?mid=<?php echo $c["imdb"] ?>"><?php echo $c["name"] ?></a></td>
                  <td><?php echo $c["role"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Cast
        $cast = $movie->cast();
        if (!empty($cast)) {
        ?>
        <tr>
          <td><b>Cast:</td>
          <td>
            <table>
              <tr>
                <th class="mw-200">Name</th>
                <th class="mw-200">Role</th>
              </tr>
              <?php foreach ( $cast as $c) { ?>
                <tr>
                  <td><a href="person.php?mid=<?php echo $c["imdb"] ?>"><?php echo $c["name"] ?></a></td>
                  <td><?php echo $c["role"] ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Plot outline
        $plotoutline = $movie->plotoutline();
        if (!empty($plotoutline)) {
        ?>
        <tr>
          <td><b>Plot Outline:</b></td>
          <td><?php echo $plotoutline ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Plot
        $plot = $movie->plot();
        if (!empty($plot)) {
        ?>
        <tr>
          <td><b>Plot:</b></td>
          <td><ul>
          <?php foreach($plot as $p) { ?>
            <li><?php echo $p ?></li>
          <?php } ?>
          </ul></td>
        </tr>
        <?php } ?>
        
        <?php
        # Taglines
        $taglines = $movie->taglines();
        if (!empty($taglines)) {
        ?>
        <tr>
          <td><b>Taglines:</b></td>
          <td><ul>
          <?php foreach($taglines as $t) { ?>
            <li><?php echo $t ?></li>
          <?php } ?>
          </ul></td>
        </tr>
        <?php } ?>
        
        <?php
        # Episodes
        if ( $movie->is_serial() || $movie->seasons() ) {
        $episodes = $movie->episodes();
        ?>
        <tr>
          <td><b>Episodes:</b></td>
          <td>
          <?php
          foreach ( $episodes as $season => $ep ) {
            foreach ( $ep as $episodedata ) {
              echo '<b>Season '.$episodedata['season'].', Episode '.$episodedata['episode'].': <a href="'.$_SERVER["PHP_SELF"].'?mid='.$episodedata['imdbid'].'">'.$episodedata['title'].'</a></b> (<b>Original Air Date: '.$episodedata['airdate'].'</b>)<br>'.$episodedata['plot'].'<br/><br/>'."\n";
            }
          }
          ?>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Locations
        $locs = $movie->locations();
        if (!empty($locs)) {
        ?>
        <tr>
          <td><b>Filming Locations:</b></td>
          <td><?php echo implode(', ',$locs) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Selected User Comment
        $comment = $movie->comment();
        if (!empty($comment)) {
        ?>
        <tr>
          <td><b>User Comments:</b></td>
          <td><?php echo $comment ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Quotes
        $quotes = $movie->quotes();
        if (!empty($quotes)) {
        ?>
        <tr>
          <td><b>Movie Quotes:</b></td>
          <td><?php echo preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\/(\?ref_=tt_trv_qu)?/","person.php?mid=\\1",$quotes[0]) ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Trailer
        $trailers = $movie->trailers(TRUE);
        if (!empty($trailers)) {
        ?>
        <tr>
          <td><b>Trailers:</b></td>
          <td>
          <?php
            foreach($trailers as $t) {
              if(!empty($t['url'])) { ?>
                <a href="<?php echo $t['url'] ?>"><?php echo $t['title'] ?></a><br>
              <?php
              }
            }
          ?>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Crazy Credits
        $crazy = $movie->crazy_credits();
        $cc    = count($crazy);
        if ($cc) {
        ?>
        <tr>
          <td><b>Crazy Credits:</b></td>
          <td>We know about <?php echo $cc ?> <i>Crazy Credits</i>. One of them reads:<br><?php echo $crazy[0] ?></td>
        </tr>
        <?php } ?>
        
        <?php
        # Goofs
        $goofs = $movie->goofs();
        $gc    = count($goofs);
        if ($gc) {
        ?>
        <tr>
          <td><b>Goofs:</b></td>
          <td>
            We know about <?php echo $gc ?> <i>Goofs</i>. Here comes one of them:<br>
            <b><?php echo $goofs[0]["type"] ?></b> <?php echo $goofs[0]["content"] ?>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Trivia
        $trivia = $movie->trivia();
        $gc     = count($trivia);
        if ($gc > 0) {
        ?>
        <tr>
          <td><b>Trivia:</b></td>
          <td>
            There are <?php echo $gc ?> entries in the trivia list - like these:
            <ul>
              <?php for($i=0;$i<5;++$i) { ?>
              <li>
                <?php echo preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})/","person.php?mid=\\1",$trivia[$i]) ?>
              </li>
              <?php } ?>
            </ul>
          </td>
        </tr>
        <?php } ?>
        
        <?php
        # Soundtracks
        $soundtracks = $movie->soundtrack();
        $gc = count($soundtracks);
        if ($gc > 0) {
        ?>
        <tr>
          <td><b>Soundtracks:</td>
          <td>
            There are <?php echo $gc ?> soundtracks listed - like these:<br>
            <table>
              <tr>
                <th class="mw-200">Soundtrack</th>
                <th class="mw-200">Credit 1</th>
                <th class="mw-200">Credit 2</th>
              </tr>
              <?php foreach ( $soundtracks as $soundtrack) { 
                $credit1 = isset($soundtrack["credits"][0]) ? preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?mid=\\1",$soundtrack["credits"][0]['credit_to'])." (".$soundtrack["credits"][0]['desc'].")" : '';
                $credit2 = isset($soundtrack["credits"][1]) ? preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","person.php?mid=\\1",$soundtrack["credits"][1]['credit_to'])." (".$soundtrack["credits"][1]['desc'].")" : '';
              ?>
                <tr>
                  <td><?php echo $soundtrack["soundtrack"] ?></td>
                  <td><?php echo $credit1 ?></td>
                  <td><?php echo $credit2 ?></td>
                </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
        <?php } ?>
      </table>
  </body>
</html>
<?php } ?>
