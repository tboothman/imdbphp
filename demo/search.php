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
require __DIR__ . "/../bootstrap.php";

# If MID has been explicitly given, we don't need to search:
if (!empty($_GET["mid"]) && preg_match('/^[0-9]+$/',$_GET["mid"])) {
  switch($_GET["searchtype"]) {
    case "nm" : header("Location: person.php?mid=".$_GET["mid"]); break;
    default   : header("Location: movie.php?mid=".$_GET["mid"]); break;
  }
  return;
}

# If we have no MID and no NAME, go back to search page
if (empty($_GET["name"])) {
  header("Location: index.html");
  return;
}

# Still here? Then we need to search for the movie:
if ($_GET['searchtype'] === 'nm') {
  $headname = "Person";
  $search = new \Imdb\PersonSearch();
  $results = $search->search($_GET["name"]);
} else {
  $headname = "Movie";
  $search = new \Imdb\TitleSearch();
  if ($_GET["searchtype"] == "episode") {
    $results = $search->search($_GET["name"], array(\Imdb\TitleSearch::TV_EPISODE));
  } else {
    $results = $search->search($_GET["name"]);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Performing search for '<?php echo $_GET["name"] ?>' [IMDbPHP v<?php echo $search->version ?>]</title>
    <style type="text/css">body,td,th,h2 { font-size:12px; font-family:sans-serif; } th { background-color:#ffb000; } h2 { text-align:center; font-size:15px; margin-top: 20px; margin-bottom:0; }</style>
  </head>
  <body>
    <h2>[IMDBPHP v<?php echo $search->version ?> Demo] Search results for '<?php echo $_GET["name"] ?>':</h2>
    <table align="center" border="1" style="border-collapse:collapse;margin-top:20px;">
      <tr><th><?php echo $headname ?> Details</th><th>IMDb</th></tr>
      <?php foreach ($results as $res):
        if ($_GET['searchtype'] === 'nm'):
          $details = $res->getSearchDetails();
          if (!empty($details)) {
            $hint = " (".$details["role"]." in <a href='movie.php?mid=".$details["mid"]."'>".$details["moviename"]."</a> (".$details["year"]."))";
          } ?>
          <tr>
            <td><a href="person.php?mid=<?php echo $res->imdbid() ?>"><?php echo $res->name() ?></a><?php echo $hint ?></td>
            <td align="center"><a href="<?php echo $res->main_url() ?>">IMDb page</a></td>
          </tr>
        <?php else: ?>
          <tr>
            <td><a href="movie.php?mid=<?php echo $res->imdbid() ?>"><?php echo $res->title() ?> (<?php echo $res->year() ?>) (<?php echo $res->movietype() ?>)</a></td>
            <td align="center"><a href="<?php echo $res->main_url() ?>">IMDb page</a></td>
          </tr>
        <?php endif ?>
      <?php endforeach ?>
    </table>
  </body>
</html>
