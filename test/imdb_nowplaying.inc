<?
require_once ("imdb_nowplaying.class.php");
require_once(dirname(__FILE__)."/helpers.inc");

echo "<H3>Checking class imdb_nowplaying...</H3>\n";

$imdb->cachedir = "../cache";
switch ($_REQUEST["cache"]) {
  case "false":
  case "off"  :
  case "0"    : $imdb->usecache = 0; $imdb->storecache = 0;
                echo "<p>Caching turned off.</p>";
                break;
  case "true" :
  case "on"   :
  case 1      : $imdb->usecache = 1; $imdb->storecache = 1;
                echo "<p>Caching turned on.</p>";
                break;
}

$imdb = new imdb_nowplaying();

echo " <LI>method getNowPlayingMovies(): ";
$res  = $imdb->getNowPlayingMovies();
if (empty($res)||empty($res[0])) fail();
else pass();
echo "</LI>\n";
++$GLOBALS["methods"];

?>