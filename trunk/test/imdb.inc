<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Checking class imdb (movie)                                               #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

require_once("imdb.class.php");
require_once(dirname(__FILE__)."/helpers.inc");

echo "<H3>Checking class imdb...</H3>\n";
$imdb = new imdb("0117500"); // The Rock

page("Title");
 setid($imdb,"0117500");
 method($imdb,"title");
 method($imdb,"year");
 method($imdb,"runtime");
 method($imdb,"rating");
 method($imdb,"votes");
 method($imdb,"comment");
 method($imdb,"comment_split");
 method($imdb,"language");
 method($imdb,"genre");
 method($imdb,"colors");
 method($imdb,"tagline");
 method($imdb,"plotoutline");
 method($imdb,"photo");
 method($imdb,"country");
 method($imdb,"alsoknow");
 method($imdb,"sound");
 method($imdb,"mpaa");
 method($imdb,"mpaa_reason");
 setid($imdb,"0105946"); // Babylon 5
 method($imdb,"seasons");
endpage();
page("Plotsummary");
 setid($imdb,"0117500");
 method($imdb,"plot");
 method($imdb,"plot_split");
endpage();
page("Taglines");
 method($imdb,"taglines");
endpage();
page("Credits");
 method($imdb,"director");
 method($imdb,"cast");
 method($imdb,"writing");
 method($imdb,"producer");
 method($imdb,"composer");
endpage();
page("CrazyCredits");
 setid($imdb,"0105946");
 method($imdb,"crazy_credits");
endpage();
page("Episodes");
 method($imdb,"episodes");
endpage();
page("Goofs");
 setid($imdb,"0117500");
 method($imdb,"goofs");
endpage();
page("Quotes");
 method($imdb,"quotes");
endpage();
page("Trailers");
 method($imdb,"trailers");
endpage();
page("Trivia");
 method($imdb,"trivia");
endpage();
page("Soundtrack");
 method($imdb,"soundtrack");
endpage();
page("MovieConnection");
 method($imdb,"movieconnection");
endpage();
page("ExtReviews");
 method($imdb,"extReviews");
endpage();

?>