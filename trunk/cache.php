<?

require_once("imdb_config.php");
require_once("imdb.class.php");

$conf = new imdb_config;
echo "<HTML><HEAD><TITLE>cache</TITLE></HEAD><BODY>";
$movie = new imdb ("0");
if ($d = opendir ($conf->cachedir)) {
     while (false !== ($entry = readdir ($d))) {

	  if (strstr ($entry, "Title")) {

	       $imdbid = substr ($entry, 0, 7);
//                      echo $imdbid."<BR>";
	       $movie->setid ($imdbid);
	       echo "<a href=imdb.php?mid=";
	       echo $imdbid;
	       echo ">";
	       echo $movie->title ();
	       echo "</a>";
	       echo " <a href=\"http://us.imdb.com/title/tt";
	       echo $imdbid;
	       echo "\">imdb page</a>";
	       echo "<br>\n";

	  }

     }
}
echo "</BODY></HTML>";
?>
