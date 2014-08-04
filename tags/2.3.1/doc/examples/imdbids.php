#!/usr/bin/php
<?
######################################################################
# Retrieve movie data from IMDB and store it in XML files. List of
# IMDBIDs can be specified in $datafile, one ID per line (see example)
# Output (XML) goes to $resultfile.
# Note that the IMDBPHP classes must be "in reach" for the script to
# work. So either place this script in their directory, or adjust the
# PHP path correspondingly.
######################################################################
#
######################################################################
# HINTS
######################################################################
#
# * Some configuration can be done in the Configuration section.
# * If no $datafile is found, the script silently exits after creating an empty $resultfile
# * if $datafile is found, but does not contain any valid ImdbIDs, the script exists and leaves *NO* $resultfile
# * If $resultfile already exists, it will be overwritten

######################################################################
#  Configuration
######################################################################
$datafile   = "imdbids.txt"; // file containing the IMDB-IDs to process, one per line
$resultfile = "imdbids.xml"; // output file containing the data

######################################################################
#  PROCESSING
######################################################################

#================[ Check if the $datafile exists - exit otherwise ]===
if ( ! file_exists($datafile) ) {
  file_put_contents($resultfile,'');
  exit;
}

#===[ Load $datafile, extract ImdbIDs. If no valid IDs found exit ]===
$tids = file($datafile);
$imdbimds = array();
foreach ($tids as $tid) {
  preg_match('!.*(\d{7}).*!s',$tid,$id); // ImdbId = 7 digits
  if ( ! empty($id) ) $imdbids[] = $id[1];
}
unset($tids,$tid,$id);
if ( empty($imdbids) ) {
  if ( file_exists($resultfile) ) unlink($resultfile);
  exit;
}

#========================================[ Process loaded ImdbIDs ]===
function elem($name,$content,$cdata=FALSE) { // create XML element if content not empty
  if ( empty($content) ) return '';
  if ( $cdata ) return "    <$name><![CDATA[$content]]></$name>\n";
  return "    <$name>$content</$name>\n";
}

require_once("imdb.class.php"); // Load the API
require_once("imdb_budget.class.php");
$xml = "<?xml version='1.0' encoding='iso-8859-15'?>\n<imdbdata>\n"; // start XML output

foreach ($imdbids as $imdbid) { // process each ID
  $movie = new imdb($imdbid);
  $xml .= "  <movie>\n"
       .  "    <imdbid>$imdbid</imdbid>\n"
       . elem ( 'title',$movie->title() )
       . elem ( 'year',$movie->year() )
       . elem ( 'rating',$movie->rating() )
       . elem ( 'votes',$movie->votes() )
       . elem ( 'tagline',$movie->tagline(),TRUE )
       . elem ( 'plot',$movie->plotoutline(),TRUE );
  $people = '';
  foreach ( $movie->prodCompany() as $person ) {
    $people .= ";".$person['name'];
  }
  if ( ! empty($people) ) $xml .= elem ( 'company',substr($people,1) );
  $people = '';
  foreach ( $movie->director() as $person ) {
    $people .= ";".$person['name'];
  }
  if ( ! empty($people) ) $xml .= elem ( 'director',substr($people,1) );
  $people = '';
  foreach ( $movie->cast() as $person ) {
    $people .= ";".$person['name'];
  }
  if ( ! empty($people) ) $xml .= elem ( 'actor',substr($people,1) );
  $genres = '';
  foreach ( $movie->genres() as $genre ) {
    $genres .= ";$genre";
  }
  if ( ! empty($genres) ) $xml .= elem ( 'genre',substr($genres,1) );
  if (($photo_url = $movie->photo_localurl() ) != FALSE) {
    $xml .= "    <cover>$photo_url</cover>\n";
  }
  $budg = new imdb_budget($imdbid);
  $xml .= elem ( 'budget',$budg->budget() );
  $xml .= "  </movie>\n";
}

file_put_contents($resultfile,$xml."</imdbdata>\n");

######################################################################
# EOF
######################################################################
?>