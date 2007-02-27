<?

require ("imdb.class.php");

$search = new imdbsearch ();
$search->setsearchname ($_GET["name"]);
echo "<HTML><HEAD><TITLE>search</TITLE></HEAD><BODY>";
$results = $search->results ();
foreach ($results as $res) {

     echo "<a href=imdb.php?mid=";
     echo $res->imdbid();
     echo ">";
     echo $res->title();
     echo "(".$res->year().")";
     echo "</a> ";
     echo " <a href=\"http://us.imdb.com/title/tt";
     echo $res->imdbid();
     echo "\">imdb page</a>";
     echo "<br>\n";
}

echo "</BODY></HTML>";
//echo $search->page;

?>
