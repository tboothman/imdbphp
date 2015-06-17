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
# Show what we have in the Cache                                            #
#############################################################################
require __DIR__ . "/../bootstrap.php";

use \Imdb\Title;
use \Imdb\Config;

$config = new Config();
$movies = array();
if (is_dir($config->cachedir)) {
  $files = glob($config->cachedir . 'title.tt*');
  foreach ($files as $file) {
    if (preg_match('!^title\.tt(\d{7})$!i', basename($file), $match)) {
      $movies[] = new Title($match[1]);
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>IMDbPHP Cache Contents</title>
    <style type='text/css'>body,td,th { font-size:12px; }</style>
  </head>
  <body>
    <?php if (empty($movies)): ?>
      Nothing in cache
    <?php else: ?>
      <table align="center" border="1" cellpadding="3" style="border-collapse:collapse;margin-top:20px;">
        <tr>
          <th style="background-color:#FFB000">Movie</th>
          <th style="background-color:#FFB000">IMDb</th>
        </tr>

        <?php foreach ($movies as $movie): ?>
        <tr>
          <td><?php echo $movie->title() ?></td>
          <td align="center">
            <a href="movie.php?mid=<?php echo $movie->imdbid() ?>">Cache</a> |
            <a href="<?php echo $movie->main_url() ?>">IMDb</a>
          </td>
        </tr>
        <?php endforeach ?>
      </table>
    <?php endif ?>
  </body>
</html>
