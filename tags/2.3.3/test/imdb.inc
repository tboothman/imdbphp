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

$imdb = new imdb("0117500"); // The Rock
headline("Class imdb (Version ".$imdb->version.", Revision ".$imdb->revision.")");
$imdb->cachedir = "../cache";
switch ($cache) {
  case "false":
  case "off"  :
  case "0"    : $imdb->usecache = 0; $imdb->storecache = 0;
                comment("Caching turned off.");
                break;
  case "true" :
  case "on"   :
  case 1      : $imdb->usecache = 1; $imdb->storecache = 1;
                comment("Caching turned on.");
                break;
}

page("Title");
 setid($imdb,"0117500");
 method($imdb,"title");
 method($imdb,"orig_title");
 method($imdb,"movietype");
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
 method($imdb,"mainPictures");
 method($imdb,"country");
 method($imdb,"alsoknow");
 method($imdb,"sound");
 method($imdb,"mpaa");
 method($imdb,"mpaa_hist");
 method($imdb,"mpaa_reason");
 method($imdb,"keywords");
 method($imdb,"keywords_all");
 method($imdb,"movie_recommendations");
 setid($imdb,"0105946"); // Babylon 5
 method($imdb,"seasons");
 setid($imdb,"0517673"); // Babylon 5: No Compromises
 method($imdb,"get_episode_details");
 setid($imdb,"3171716"); // Okka Adugu
 method($imdb,"prodNotes");
 setid($imdb,"0094592"); // 14 going 30 (TV)
 method($imdb,"movieTypes");
endpage();
page("Synopsis");
 setid($imdb,"0758774"); // Body of Lies
 method($imdb,"synopsis");
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
page("VideoSites");
 method($imdb,"videosites");
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
page("ReleaseInfo");
 method($imdb,"releaseInfo");
endpage();
page("CompanyCredits");
 setid($imdb,"0096895"); // Batman
 method($imdb,"prodCompany");
 method($imdb,"distCompany");
 method($imdb,"specialCompany");
 method($imdb,"otherCompany");
endpage();
page("ParentalGuide");
 method($imdb,"parentalGuide");
endpage();
page("OfficialSites");
 method($imdb,"officialSites");
endpage();
page("Awards");
 method($imdb,"awards");
endpage();

?>