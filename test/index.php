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

#===============================================[ optional URL Parameters ]===
# check: only check the specified class (movie, name, charts, nowplay, trail)
#        default: Check them all
# skip : skip the test for the specified, comma-separated classes. Has
#        priority over "check"
# cron : enable cron-mode (cron=1) - i.e. output plain text, and on errors only
# cache: enable (1|on|true) or disable (0|off|false) caching. Overrides config.

require_once(dirname(__FILE__)."/helpers.inc");
#=====================================[ Make sure it works out-of-the-box ]===
$os = php_uname('s');
$path = ini_get('include_path');
if (strtolower(substr($os,0,3))=="win") ini_set('include_path',".;..;$path");
else ini_set('include_path',".:..:$path");

#====================================================[ Output HTML Header ]===
if (!CRON) {
  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n"
     . " <TITLE>IMDBAPI Checks</TITLE>\n"
     . " <STYLE TYPE='text/css'>body,td,th { font-size:12px; font-family:sans-serif; }</STYLE>\n"
     . "</HEAD><BODY>\n";
}
#==========================================[ Define what should be tested ]===
$check_movie   = false;
$check_name    = false;
$check_charts  = false;
$check_nowplay = false;
$check_budget  = false;
$check_poster  = false;
$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri,'?')>0 ) $uri .= '&amp;';
else $uri .= '?';
raw("<SPAN STYLE='margin-right:2em;'><A HREF='{$uri}api=imdb'>IMDB</A></SPAN>\n");
#if ( empty($_REQUEST['api']) && !in_array($_REQUEST['api'],array('imdb','pilot')) ) {
#  if (CRON) {
    $api = 'imdb';
#  } else {
#    raw("</BODY></HTML>\n");
#    exit;
#  }
#} else {
#  $api = $_REQUEST['api'];
#}
(isset($_REQUEST["check"])) ? $check = $_REQUEST["check"] : $check = '';
(isset($_REQUEST["cache"])) ? $cache = $_REQUEST["cache"] : $cache = '0';
switch ($check) {
  case "movie"   : $check_movie   = true; break;
  case "name"    : $check_name    = true; break;
  case "charts"  : $check_charts  = true; break;
  case "nowplay" : $check_nowplay = true; break;
  case "budget"  : $check_budget  = true; break;
  case "poster"  : $check_poster  = true; break;
  default:
    $check_movie   = true;
    $check_name    = true;
    $check_charts  = true;
    $check_nowplay = true;
    $check_budget  = true;
    $check_poster  = true;
}
if (!empty($_REQUEST["skip"])) {
  $skips = explode(",",$_REQUEST["skip"]);
  $segments = array("movie","name","charts","nowplay");
  foreach($skips as $skip) ${"check_$skip"} = FALSE;
}

#=========================================================[ Run the tests ]===
if ($check_movie)   { if ($api=='imdb') require('imdb.inc'); else require('pilot.inc'); }
if ($check_name)    { if ($api=='imdb') require('imdb_person.inc'); else require ('pilot_person.inc'); }
if ($check_charts)  { if ($api=='imdb') require ("imdb_charts.inc"); }
if ($check_nowplay) { if ($api=='imdb') require ("imdb_nowplaying.inc"); }
if ($check_budget)  { if ($api=='imdb') require ("imdb_budget.inc"); }
if ($check_poster)  { if ($api=='imdb') require ("movieposters.inc"); }

#===============================================[ Summary and HTML footer ]===
$passed  = $methods - $failures;
$percent = round(100*$passed/$methods)."%";
if (CRON) {
  if ($failures>0 || !empty($failed)) {
    echo "Some methods failed the automated tests:\n"
       . "========================================\n\n";
    foreach ($failed as $fail) echo "* $fail\n";
    echo "\nOverall results:\n\n"
       . "Success: $passed/$methods ($percent)\n";
  }
} else {
  headline("Test Results:");
  raw("<UL><LI>Methods: $methods</LI><LI>Passed: $passed</LI><LI>Failures: $failures</LI><LI>Success: $percent</LI></UL>\n");
  if ($percent == "100%") raw("<b>Congratulations!</b> Looks like the complete API is working perfectly.");
  raw("</BODY></HTML>\n");
}
?>