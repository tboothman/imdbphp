<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft@qumran.org>            #
 # http://www.qumran.org/homes/izzy/                                         #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

 require_once (dirname(__FILE__)."/browseremulator.class.php");
 require_once (dirname(__FILE__)."/imdb_config.php");

 #===============================================[ The IMDB class itself ]===
 /** Accessing IMDB information
  * @package Api
  * @class imdb
  * @extends imdb_config
  * @author Izzy (izzysoft@qumran.org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdb extends imdb_config {

  function debug_scalar($scalar) {
    if ($this->debug) echo "<b><font color='#ff0000'>$scalar</font></b><br>";
  }
  function debug_object($object) {
    if ($this->debug) {
      echo "<font color='#ff0000'><pre>";
      print_r($object);
      echo "</pre></font>";
    }
  }
  function debug_html($html) {
    if ($this->debug) echo "<b><font color='#ff0000'>".htmlentities($html)."</font></b><br>";
  }

  /** Open an IMDB page
   * @method openpage
   * @param string wt
   */
  function openpage ($wt) {
   if (strlen($this->imdbID) != 7){
    $this->debug_scalar("not valid imdbID: ".$this->imdbID."<BR>".strlen($this->imdbID));
    $this->page[$wt] = "cannot open page";
    return;
   }
   switch ($wt){
    case "Title"       : $urlname="/"; break;
    case "Credits"     : $urlname="/fullcredits"; break;
    case "CrazyCredits": $urlname="/crazycredits"; break;
    case "Plot"        : $urlname="/plotsummary"; break;
    case "Taglines"    : $urlname="/taglines"; break;
    case "Episodes"    : $urlname="/episodes"; break;
    case "Quotes"      : $urlname="/quotes"; break;
    case "Trailers"    : $urlname="/trailers"; break;
    case "Goofs"       : $urlname="/goofs"; break;
    case "Trivia"      : $urlname="/trivia"; break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return;
   }
   if ($this->usecache) {
    $fname = "$this->cachedir/$this->imdbID.$wt";
    if ( $this->usezip ) {
     if ( ($this->page[$wt] = @join("",@gzfile($fname))) ) {
      if ( $this->converttozip ) {
       @$fp = fopen ($fname,"r");
       $zipchk = fread($fp,2);
       fclose($fp);
       if ( !($zipchk[0] == chr(31) && $zipchk[1] == chr(139)) ) { //checking for zip header
         /* converting on access */
         $fp = @gzopen ($fname, "w");
         @gzputs ($fp, $this->page[$wt]);
         @gzclose ($fp);
       }
      }
      return;
     }
    } else { // no zip
     @$fp = fopen ($fname, "r");
     if ($fp) {
      $temp="";
      while (!feof ($fp)) {
	 $temp .= fread ($fp, 1024);
	 $this->page[$wt] = $temp;
      }
      return;
     }
    }
   } // end cache

   $req = new IMDB_Request("");
   $url = "http://".$this->imdbsite."/title/tt".$this->imdbID.$urlname;
   $req->setURL($url);
   $req->sendRequest();
   $this->page[$wt]=$req->getResponseBody();

   if( $this->page[$wt] ){ //storecache
    if ($this->storecache) {
     $fname = "$this->cachedir/$this->imdbID.$wt";
     if ( $this->usezip ) {
      $fp = gzopen ($fname, "w");
      gzputs ($fp, $this->page[$wt]);
      gzclose ($fp);
     } else { // no zip
      $fp = fopen ($fname, "w");
      fputs ($fp, $this->page[$wt]);
      fclose ($fp);
     }
    }
    return;
   }
   $this->page[$wt] = "cannot open page";
   $this->debug_scalar("cannot open page: $url");
  }

  /** Retrieve the IMDB ID
   * @method imdbid
   * @return string id
   */
  function imdbid () {
   return $this->imdbID;
  }

  /** Setup class for a new IMDB id
   * @method setid
   * @param string id
   */
  function setid ($id) {
   $this->imdbID = $id;

   $this->page["Title"] = "";
   $this->page["Credits"] = "";
   $this->page["CrazyCredits"] = "";
   $this->page["Amazon"] = "";
   $this->page["Goofs"] = "";
   $this->page["Trivia"] = "";
   $this->page["Plot"] = "";
   $this->page["Comments"] = "";
   $this->page["Quotes"] = "";
   $this->page["Taglines"] = "";
   $this->page["Plotoutline"] = "";
   $this->page["Trivia"] = "";
   $this->page["Directed"] = "";
   $this->page["Episodes"] = "";
   $this->page["Quotes"] = "";
   $this->page["Trailers"] = "";

   $this->main_title = "";
   $this->main_year = "";
   $this->main_runtime = "";
   $this->main_rating = "";
   $this->main_comment = "";
   $this->main_votes = "";
   $this->main_language = "";
   $this->main_genre = "";
   $this->main_genres = "";
   $this->main_tagline = "";
   $this->main_plotoutline = "";
   $this->main_alttitle = "";
   $this->main_colors = "";
   $this->credits_cast = "";
   $this->main_director = "";
   $this->main_seasons = "";
   $this->main_episodes = "";
   $this->main_quotes = array();
   $this->main_trailers = array();
   $this->crazy_credits = array();
   $this->goofs = array();
   $this->trivia = array();
  }

  /** Initialize class
   * @constructor imdb
   * @param string id
   */
  function imdb ($id) {
   $this->imdb_config();
   $this->setid($id);
   if ($this->storecache && ($this->cache_expire > 0)) $this->purge();
  }

  /** Check cache and purge outdated files
   *  This method looks for files older than the cache_expire set in the
   *  imdb_config and removes them
   * @method purge
   */
  function purge() {
    if (is_dir($this->cachedir))  {
      $thisdir = dir($this->cachedir);
      $now = time();
      while( $file=$thisdir->read() ) {
        if ($file!="." && $file!="..") {
          $fname = $this->cachedir . $file;
	  if (is_dir($fname)) continue;
          $mod = filemtime($fname);
          if ($mod && ($now - $mod > $this->cache_expire)) unlink($fname);
        }
      }
    }
  }

  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url
   */
  function main_url(){
   return "http://".$this->imdbsite."/title/tt".$this->imdbid()."/";
  }

  /** Get movie title
   * @method title
   * @return string title
   */
  function title () {
   if ($this->main_title == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->main_title = strstr ($this->page["Title"], "<title>");
    $endpos = strpos ($this->main_title, "</title>");
    $this->main_title = substr ($this->main_title, 7, $endpos - 7);
    $year_s = strpos ($this->main_title, "(", 0);
    $year_e = strpos ($this->main_title, ")", 0);
    $this->main_title = substr ($this->main_title, 0, $year_s - 1);
   }
   return $this->main_title;
  }

  /** Get year
   * @method year
   * @return string year
   */
  function year () {
   if ($this->main_year == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->main_year = strstr ($this->page["Title"], "<title>");
    $endpos = strpos ($this->main_title, "</title>");
    $this->main_year = substr ($this->main_year, 7, $endpos - 7);
    $y = preg_match("/\((\d{4})\)/",$this->main_year,$match);
    $this->main_year = $match[1];
   }
   return $this->main_year;
  }

  /** Get general runtime
   * @method runtime_all
   * @return string runtime
   */
  function runtime_all () {
   if ($this->main_runtime == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $runtime_s = strpos ($this->page["Title"], "Runtime:");
    $runtime_e = strpos ($this->page["Title"], "<br>", $runtime_s);
    $this->main_runtime = substr ($this->page["Title"], $runtime_s + 13, $runtime_e - $runtime_s - 14);
    if ($runtime_s == 0)
	$this->main_runtime = "";
    }
    return $this->main_runtime;
  }

  /** Get overall runtime
   * @method runtime
   * @return mixed string runtime (if set), NULL otherwise
   */
  function runtime(){
   $runarr = $this->runtimes();
   if (isset($runarr[0]["time"])){
	return $runarr[0]["time"];
   }else{
	return NULL;
   }
  }

  /** Retrieve language specific runtimes
   * @method runtimes
   * @return array runtimes (array[0..n] of array[time,country,comment])
   */
  function runtimes(){
   if ($this->main_runtimes == "") {
    if ($this->runtime_all() == "") return array();
    $run_arr= explode( "/" , $this->runtime_all());
    $max = count($run_arr);
    for ( $i=0; $i < $max ; $i++){
	$time_e = strpos( $run_arr[$i], " min");
	$country_e = strpos($run_arr[$i], ":");
	if ( $country_e == 0){
	 $time_s = 0;
	}else{
	 $time_s = $country_e+1;
	}
	$comment_s = strpos( $run_arr[$i], '(');
	$comment_e = strpos( $run_arr[$i], ')');
	$runtemp["time"]= substr( $run_arr[$i], $time_s, $time_e - $time_s);
	$country_s = 0;
	if ($country_s != $country_e){
	 $runtemp["country"]= substr( $run_arr[$i], $country_s, $country_e - $country_s);
	}else{
	 $runtemp["country"]=NULL;
	}
	if ($comment_s != $comment_e){
	 $runtemp["comment"]= substr( $run_arr[$i], $comment_s + 1, $comment_e - $comment_s - 1);
	}else{
	 $runtemp["comment"]=NULL;
	}
	$this->main_runtimes[$i] = $runtemp;
    }
   }
   return $this->main_runtimes;
  }

  /** Get movie rating
   * @method rating
   * @return string rating
   */
  function rating () {
   if ($this->main_rating == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $rate_s = strpos ($this->page["Title"], "User Rating:");
    if ( $rate_s == 0 )	return FALSE;
    $rate_s = strpos ($this->page["Title"], "<b>", $rate_s);
    $rate_e = strpos ($this->page["Title"], "/", $rate_s);
    $this->main_rating = substr ($this->page["Title"], $rate_s + 3, $rate_e - $rate_s - 3);
    if ($rate_e - $rate_s > 7) $this->main_rating = "";
   }
   return $this->main_rating;
  }

  /** Get movie comment
   * @method comment
   * @return string comment
   */
  function comment () {
     if ($this->main_comment == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $comment_s = strpos ($this->page["Title"], "people found the following comment useful:-");
      if ( $comment_s == 0) return false;
      $comment_e = strpos ($this->page["Title"], "Was the above comment useful to you?", $comment_s);
      $this->main_comment = substr ($this->page["Title"], $comment_s + 43, $comment_e - $comment_s - 43);
      $this->main_comment = preg_replace("/a href\=\"\//i","a href=\"http://".$this->imdbsite."/",$this->main_comment);
     }
     return $this->main_comment;
  }

  /** Return votes for this movie
   * @method votes
   * @return string votes
   */
  function votes () {
   if ($this->main_votes == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $vote_s = strpos ($this->page["Title"], "User Rating:");
    if ( $vote_s == 0) return false;
    $vote_s = strpos ($this->page["Title"], "(", $vote_s);
    $vote_e = strpos ($this->page["Title"], "votes", $vote_s);
    $this->main_votes = substr ($this->page["Title"], $vote_s + 1, $vote_e - $vote_s - 2);
    $this->main_votes = str_replace("ratings","http://".$this->imdbsite."/title/tt".$this->imdbID."/ratings", $this->main_votes);
    $this->main_votes .= "</a>";
   }
   return $this->main_votes;
  }

  /** Get movies original language
   * @method language
   * @return string language
   */
  function language () {
   if ($this->main_language == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $lang_s = strpos ($this->page["Title"], "/Sections/Languages/");
    if ( $lang_s == 0) return FALSE;
    $lang_s = strpos ($this->page["Title"], ">", $lang_s);
    $lang_e = strpos ($this->page["Title"], "<", $lang_s);
    $this->main_language = substr ($this->page["Title"], $lang_s + 1, $lang_e - $lang_s - 1);
   }
   return $this->main_language;
  }

  /** Get all langauges this movie is available in
   * @method languages
   * @return array languages (array[0..n] of strings)
   */
  function languages () {
   if ($this->main_languages == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $lang_s = 0;
    $lang_e = 0;
    $i = 0;
    $this->main_languages = array();
    while (strpos($this->page["Title"], "/Sections/Languages/", $lang_e) > $lang_s) {
	$lang_s = strpos ($this->page["Title"], "/Sections/Languages/", $lang_s);
	$lang_s = strpos ($this->page["Title"], ">", $lang_s);
	$lang_e = strpos ($this->page["Title"], "<", $lang_s);
	$this->main_languages[$i] = substr ($this->page["Title"], $lang_s + 1, $lang_e - $lang_s - 1);
	$i++;
    }
   }
   return $this->main_languages;
  }

  /** Get the movies main genre
   * @method genre
   * @return string genre
   */
  function genre () {
   if ($this->main_genre == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $genre_s = strpos ($this->page["Title"], "/Sections/Genres/");
    if ( $genre_s === FALSE || $genre_s < 0 )	return FALSE;
    $genre_s = strpos ($this->page["Title"], ">", $genre_s);
    $genre_e = strpos ($this->page["Title"], "<", $genre_s);
    $this->main_genre = substr ($this->page["Title"], $genre_s + 1, $genre_e - $genre_s - 1);
   }
   return $this->main_genre;
  }

  /** Get all genres the movie is registered for
   * @method genres
   * @return array genres (array[0..n] of strings)
   */
  function genres () {
   if ($this->main_genres == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->main_genres = array();
    $genre_s = strpos($this->page["Title"],"/Sections/Genres/") -5;
    if ($genre_s === FALSE) return array(); // no genre found
    $genre_e = strpos($this->page["Title"],"/rg/title-tease/",$genre_s);
    $block = substr($this->page["Title"],$genre_s,$genre_e-$genre_s);
    $diff = $genre_e-$genre_s;
    $genre_s = 0;
    $genre_e = 0;
    $i = 0;
    while (strpos($block, "/Sections/Genres/", $genre_e) > $genre_s) {
	$genre_s = strpos ($block, "/Sections/Genres/", $genre_s);
	$genre_s = strpos ($block, ">", $genre_s);
	$genre_e = strpos ($block, "<", $genre_s);
	$this->main_genres[$i] = substr ($block, $genre_s + 1, $genre_e - $genre_s - 1);
	$i++;
    }
   }
   return $this->main_genres;
  }

  /** Get colors
   * @method colors
   * @return array colors (array[0..1] of strings)
   */
  function colors () {
   if ($this->main_colors == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $color_s = 0;
    $color_e = 0;
    $i = 0;
    while (strpos ($this->page["Title"], "/List?color-info", $color_e) > $color_s) {
	$color_s = strpos ($this->page["Title"], "/List?color-info", $color_s);
	$color_s = strpos ($this->page["Title"], ">", $color_s);
	$color_e = strpos ($this->page["Title"], "<", $color_s);
	$this->main_colors[$i] = substr ($this->page["Title"], $color_s + 1, $color_e - $color_s - 1);
	$i++;
    }
   }
   return $this->main_colors;
  }

  /** Get the main tagline for the movie
   * @method tagline
   * @return string tagline
   */
  function tagline () {
   if ($this->main_tagline == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $tag_s = strpos ($this->page["Title"], "Tagline:");
    if ( $tag_s == 0) return FALSE;
    $tag_s = strpos ($this->page["Title"], ">", $tag_s);
    $tag_e = strpos ($this->page["Title"], "<", $tag_s);
    $this->main_tagline = substr ($this->page["Title"], $tag_s + 1, $tag_e - $tag_s - 1);
   }
   return $this->main_tagline;
  }

  /** Get the number of seasons or 0 if not a series
   * @method seasons
   * @return int seasons
   */
  function seasons() {
    if ( $this->main_seasons == "" ) {
      if ( $this->page["Title"] == "" ) $this->openpage("Title");
      if ( preg_match_all('|<a href="episodes#season-\d+">(\d+)</a>|Ui',$this->page["Title"],$matches) ) {
        $this->main_seasons = count($matches[0]);
      } else {
        $this->main_seasons = 0;
      }
    }
    return $this->main_seasons;
  }

  /** Get the main Plot outline for the movie
   * @method plotoutline
   * @return string plotoutline
   */
  function plotoutline () {
    if ($this->main_plotoutline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $plotoutline_s = strpos ($this->page["Title"], "Plot Outline:");
      if ( $plotoutline_s == 0) return FALSE;
      $plotoutline_s = strpos ($this->page["Title"], ">", $plotoutline_s);
      $plotoutline_e = strpos ($this->page["Title"], "<", $plotoutline_s);
      $this->main_plotoutline = substr ($this->page["Title"], $plotoutline_s + 1, $plotoutline_e - $plotoutline_s - 1);
    }
    return $this->main_plotoutline;
  }

  /** Get cover photo
   * @method photo
   * @return mixed photo (string url if found, FALSE otherwise)
   */
  function photo () {
   if ($this->main_photo == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $tag_s = strpos ($this->page["Title"], "<a name=\"poster\"");
    if ($tag_s == 0) return FALSE;
    $tag_s = strpos ($this->page["Title"], "http://",$tag_s);
    $tag_e = strpos ($this->page["Title"], '"', $tag_s);
    $this->main_photo = substr ($this->page["Title"], $tag_s, $tag_e - $tag_s);
    if ($tag_s == 0) return FALSE;
   }
   return $this->main_photo;
  }

  /** Save the photo to disk
   * @method savephoto
   * @param string path
   * @return boolean success
   */
  function savephoto ($path) {
   $req = new IMDB_Request("");
   $photo_url = $this->photo ();
   if (!$photo_url) return FALSE;
   $req->setURL($photo_url);
   $req->sendRequest();
   if (strpos($req->getResponseHeader("Content-Type"),'image/jpeg') === 0
     || strpos($req->getResponseHeader("Content-Type"),'image/gif') === 0
     || strpos($req->getResponseHeader("Content-Type"), 'image/bmp') === 0 ){
	$fp = $req->getResponseBody();
   }else{
	$this->debug_scalar("<BR>*photoerror* ".$photo_url.": Content Type is '".$req->getResponseHeader("Content-Type")."'<BR>");
	return false;
   }

   $fp2 = fopen ($path, "w");
   if ((!$fp) || (!$fp2)){
     $this->debug_scalar("image error...<BR>");
     return false;
   }

   fputs ($fp2, $fp);
   return TRUE;
  }

  /** Get the URL for the movies cover photo
   * @method photo_localurl
   * @return mixed url (string URL or FALSE if none)
   */
  function photo_localurl(){
   $path = $this->photodir.$this->imdbid().".jpg";
   if ( @fopen($path,"r")) return $this->photoroot.$this->imdbid().'.jpg';
   if ($this->savephoto($path))	return $this->photoroot.$this->imdbid().'.jpg';
   return false;
  }

  /** Get country of production
   * @method country
   * @return array country (array[0..n] of string)
   */
  function country () {
   if ($this->main_country == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->main_country = array();
    $country_s = strpos($this->page["Title"],"/Sections/Countries/") -5;
    if ($country_s === FALSE) return array(); // no country found
    $country_e = strpos($this->page["Title"],"</div>",$country_s);
    $block = substr($this->page["Title"],$country_s,$country_e-$country_s);
    preg_match_all("/\/Sections\/Countries.*?>(.*?)</",$block,$matches);
    for ($i=0;$i<count($matches[0]);++$i) $this->main_country[$i] = $matches[1][$i];
   }
   return $this->main_country;
  }

  /** Get movies alternative names
   * @method alsoknow
   * @return array aka (array[0..n] of array[title,year,country,comment])
   */
  function alsoknow () {
   if ($this->main_alsoknow == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $ak_s = strpos ($this->page["Title"], "Also Known As:</h5>");
    if ($ak_s>0) $ak_s += 19;
    if ($ak_s == 0) $ak_s = strpos ($this->page["Title"], "Alternativ:");
    if ($ak_s == 0) return array();
    $alsoknow_end = strpos ($this->page["Title"], "</div>", $ak_s);
    $alsoknow_all = substr($this->page["Title"], $ak_s, $alsoknow_end - $ak_s);
    preg_match_all("/(.*?) (\(\d{4}\) |)\((.*?)\).*?\((.*?)\) <br>/",$alsoknow_all,$matches);
    for ($i=0;$i<count($matches[0]);++$i) $this->main_alsoknow[] = array("title"=>$matches[1][$i],"year"=>$matches[2][$i],"country"=>$matches[3][$i],"comment"=>$matches[4][$i]);
   }
   return $this->main_alsoknow;
  }

  /** Get sound formats
   * @method sound
   * @return array sound (array[0..n] of strings)
   */
  function sound () {
   if ($this->main_sound == "") {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $sound_s = 0;
    $sound_e = 0;
    $i = 0;
    while (strpos ($this->page["Title"], "/List?sound", $sound_e) > $sound_s) {
	$sound_s = strpos ($this->page["Title"], "/List?sound", $sound_s);
	$sound_s = strpos ($this->page["Title"], ">", $sound_s);
	$sound_e = strpos ($this->page["Title"], "<", $sound_s);
	$this->main_sound[$i] = substr ($this->page["Title"], $sound_s + 1, $sound_e - $sound_s - 1);
	$i++;
    }
   }
   return $this->main_sound;
  }

  /** Get the MPAA data (PG?)
   * @method mpaa
   * @return array mpaa (array[country]=rating)
   */
  function mpaa () { // patch by Brian Ruth not yet tested (by me...)
   if (empty($this->main_mpaa)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $mpaa_s = 0;
    $mpaa_e = 0;
    $this->main_mpaa = array();
    while (strpos ($this->page["Title"], "/List?certificates", $mpaa_e) > $mpaa_s) {
	$mpaa_s = strpos ($this->page["Title"], "/List?certificates", $mpaa_s);
	$mpaa_s = strpos ($this->page["Title"], ">", $mpaa_s);
	$mpaa_c = strpos ($this->page["Title"], ":", $mpaa_s);
	$mpaa_e = strpos ($this->page["Title"], "<", $mpaa_s);
	$country = substr ($this->page["Title"], $mpaa_s + 1, $mpaa_c - $mpaa_s - 1);
	$rating = substr ($this->page["Title"], $mpaa_c + 1, $mpaa_e - $mpaa_c - 1);
	$this->main_mpaa[$country] = $rating;
    }
   }
   return $this->main_mpaa;
  }

#-------------------------------------------------------------[ /plot page ]---
  /** Get the movies plot(s)
   * @method plot
   * @return array plot (array[0..n] of strings)
   */
  function plot () {
   if ($this->plot_plot == "") {
    if ( $this->page["Plot"] == "" ) $this->openpage ("Plot");
    if ( $this->page["Plot"] == "cannot open page" ) return array(); // no such page
    $plot_e = 0;
    $i = 0;
    $this->plot_plot = array();
    while (($plot_s = strpos ($this->page["Plot"], "<p class=\"plotpar\">", $plot_e)) !== FALSE) {
	$plot_e = strpos ($this->page["Plot"], "</p>", $plot_s);
	$tmplot = substr ($this->page["Plot"], $plot_s + 19, $plot_e - $plot_s - 19);
	$tmplot = preg_replace('/<a href=\"\/SearchPlotWriters/i','<a href="http://'.$this->imdbsite.'/SearchPlotWriters/',$tmplot);
	$this->plot_plot[$i] = $tmplot;
	$i++;
    }
   }
   return $this->plot_plot;
  }

#---------------------------------------------------------[ /taglines page ]---
  /** Get all available taglines for the movie
   * @method taglines
   * @return array taglines (array[0..n] of strings)
   */
  function taglines () {
   if ($this->taglines == "") {
    if ( $this->page["Taglines"] == "" ) $this->openpage ("Taglines");
    if ( $this->page["Taglines"] == "cannot open page" ) return array(); // no such page
    $tags_e = 0;
    $i = 0;
    $tags_s = strpos ($this->page["Taglines"], "<td width=\"90%\" valign=\"top\" >", $tags_e);
    $tagend = strpos ($this->page["Taglines"], "<form method=\"post\" action=\"/updates\">", $tags_s);
    $this->taglines = array();
    while (($tags_s = strpos ($this->page["Taglines"], "<p>", $tags_e)) < $tagend) {
	$tags_e = strpos ($this->page["Taglines"], "</p>", $tags_s);
	$tmptag = substr ($this->page["Taglines"], $tags_s + 3, $tags_e - $tags_s - 3);
	if (preg_match("/action\=\"\//i",$tmptag)) continue;
	$this->taglines[$i] = $tmptag;
	$i++;
    }
   }
   return $this->taglines;
  }

#----------------------------------------------------------[ /credits page ]---
  /** Get rows for a given table on the page
   * @method private get_table_rows
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_table_rows ( $html, $table_start ){
   $row_s = strpos ( $html, ">".$table_start."<");
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
   $i=0;
   while ( ($row_e + 5 < $endtable) && ($row_s != 0) ){
     $row_s = strpos ( $html, "<tr>", $row_s);
     $row_e = strpos ($html, "</tr>", $row_s);
     $temp = trim(substr ($html, $row_s + 4 , $row_e - $row_s - 4));
     if ( strncmp( $temp, "<td valign=",10) == 0 ){
       $rows[$i] = $temp;
       $i++;
     }
     $row_s = $row_e;
   }
   return $rows;
  }

  /** Get rows for the cast table on the page
   * @method private get_table_rows_cast
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the method cast
   */
  function get_table_rows_cast ( $html, $table_start ){
   $row_s = strpos ( $html, '<table class="cast">');
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
   $i=0;
   while ( ($row_e + 5 < $endtable) && ($row_s != 0) ){
     $row_s = strpos ( $html, "<tr", $row_s);
     $row_e = strpos ($html, "</tr>", $row_s);
     $temp = trim(substr ($html, $row_s , $row_e - $row_s));
     $row_x = strpos( $temp, '<td class="nm">' );
     $temp = trim(substr($temp,$row_x));
     if ( strncmp( $temp, "<td class=",10) == 0 ){
       $rows[$i] = $temp;
       $i++;
     }
     $row_s = $row_e;
   }
   return $rows;
  }

  /** Get content of table row cells
   * @method private get_row_cels
   * @param string row (as returned by imdb::get_table_rows)
   * @return array cells (array[0..n] of strings)
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_row_cels ( $row ){
   $cel_s = 0;
   $cel_e = 0;
   $endrow = strlen($row);
   $i = 0;
   $cels = array();
   while ( $cel_e + 5 < $endrow ){
	$cel_s = strpos( $row, "<td",$cel_s);
	$cel_s = strpos( $row, ">" , $cel_s);
	$cel_e = strpos( $row, "</td>", $cel_s);
	$cels[$i] = substr( $row, $cel_s + 1 , $cel_e - $cel_s - 1);
	$i++;
   }
   return $cels;
  }

  /** Get the IMDB name (?)
   * @method private get_imdbname
   * @param string href
   * @return string
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_imdbname( $href){
   if ( strlen( $href) == 0) return $href;
   $name_s = 15;
   $name_e = strpos ( $href, '"', $name_s);
   if ( $name_e != 0){
	return substr( $href, $name_s, $name_e -1 - $name_s);
   }else{
	return $href;
   }
  }

  /** Get the director(s) of the movie
   * @method director
   * @return array director (array[0..n] of strings)
   */
  function director () {
   if ($this->credits_director == "") {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $director_rows = $this->get_table_rows($this->page["Credits"], "Directed by");
   for ( $i = 0; $i < count ($director_rows); $i++){
	$cels = $this->get_row_cels ($director_rows[$i]);
	if (!isset ($cels[0])) return array();
	$dir["imdb"] = $this->get_imdbname($cels[0]);
	$dir["name"] = strip_tags($cels[0]);
	$role = trim(strip_tags($cels[2]));
	if ( $role == ""){
		$dir["role"] = NULL;
	}else{
		$dir["role"] = $role;
	}
	$this->credits_director[$i] = $dir;
   }
   return $this->credits_director;
  }

  /** Get the actors
   * @method cast
   * @return array cast (array[0..n] of strings)
   */
  function cast () {
   if ($this->credits_cast == "") {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $cast_rows = $this->get_table_rows_cast($this->page["Credits"], "Cast");
   for ( $i = 0; $i < count ($cast_rows); $i++){
	$cels = $this->get_row_cels ($cast_rows[$i]);
	if (!isset ($cels[0])) return array();
	$dir["imdb"] = $this->get_imdbname($cels[0]);
	$dir["name"] = strip_tags($cels[0]);
	$role = strip_tags($cels[2]);
	if ( $role == ""){
		$dir["role"] = NULL;
	}else{
		$dir["role"] = $role;
	}
	$this->credits_cast[$i] = $dir;
   }
   return $this->credits_cast;
  }

  /** Get the writer(s)
   * @method writing
   * @return array writers (array[0..n] of strings)
   */
  function writing () {
   if ($this->credits_writing == "") {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_writing = array();
   $writing_rows = $this->get_table_rows($this->page["Credits"], "Writing credits");
   for ( $i = 0; $i < count ($writing_rows); $i++){
     $cels = $this->get_row_cels ($writing_rows[$i]);
     if ( count ( $cels) > 2){
       $wrt["imdb"] = $this->get_imdbname($cels[0]);
       $wrt["name"] = strip_tags($cels[0]);
       $role = strip_tags($cels[2]);
       if ( $role == ""){
         $wrt["role"] = NULL;
       }else{
         $wrt["role"] = $role;
       }
       $this->credits_writing[$i] = $wrt;
     }
   }
   return $this->credits_writing;
  }

  /** Obtain the producer(s)
   * @method producer
   * @return array producer (array[0..n] of strings)
   */
  function producer () {
   if ($this->credits_producer == "") {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_producer = array();
   $producer_rows = $this->get_table_rows($this->page["Credits"], "Produced by");
   for ( $i = 0; $i < count ($producer_rows); $i++){
	$cels = $this->get_row_cels ($producer_rows[$i]);
	if ( count ( $cels) > 2){
		$wrt["imdb"] = $this->get_imdbname($cels[0]);
		$wrt["name"] = strip_tags($cels[0]);
		$role = strip_tags($cels[2]);
		if ( $role == ""){
			$wrt["role"] = NULL;
		}else{
			$wrt["role"] = $role;
		}
		$this->credits_producer[$i] = $wrt;
	}
   }
   return $this->credits_producer;
  }

  /** Obtain the composer(s) ("Original Music by...")
   * @method composer
   * @return array composer (array[0..n] of strings)
   */
  function composer () {
   if ($this->credits_composer == "") {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_composer = array();
   $composer_rows = $this->get_table_rows($this->page["Credits"], "Original Music by");
   for ( $i = 0; $i < count ($composer_rows); $i++){
	$cels = $this->get_row_cels ($composer_rows[$i]);
	if ( count ( $cels) > 2){
		$wrt["imdb"] = $this->get_imdbname($cels[0]);
		$wrt["name"] = strip_tags($cels[0]);
		$role = strip_tags($cels[2]);
		if ( $role == ""){
			$wrt["role"] = NULL;
		}else{
			$wrt["role"] = $role;
		}
		$this->credits_composer[$i] = $wrt;
	}
   }
   return $this->credits_composer;
  }

#-----------------------------------------------------[ /crazycredits page ]---
  /** Get the Crazy Credits
   * @method crazy_credits
   * @return array crazy_credits (array[0..n] of string)
   */
  function crazy_credits() {
    if (empty($this->crazy_credits)) {
      if (empty($this->page["CrazyCredits"])) $this->openpage("CrazyCredits");
      if ( $this->page["CrazyCredits"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos ($this->page["CrazyCredits"],"<li><tt>");
      $tag_e = strpos ($this->page["CrazyCredits"],"</ul>",$tag_s);
      $cred  = str_replace ("<br>"," ",substr ($this->page["CrazyCredits"],$tag_s, $tag_e - $tag_s));
      $cred  = str_replace ("  "," ",str_replace ("\n"," ",$cred));
      preg_match_all("/<li><tt>(.*?)<\/tt><\/li>/",$cred,$matches);
      $this->crazy_credits = $matches[1];
    }
    return $this->crazy_credits;
  }

#---------------------------------------------------------[ /episodes page ]---
  /** Get the series episode(s)
   * @method episodes
   * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot])
   */
  function episodes() {
    if ( $this->seasons() == 0 ) return null;
    if ( $this->main_episodes == "" ) {
      if ( $this->page["Episodes"] == "" ) $this->openpage("Episodes");
      if ( $this->page["Episodes"] == "cannot open page" ) return array(); // no such page
      if ( preg_match_all('|<h4>Season (\d+), Episode (\d+): <a href="/title/tt(\d{7})/">(.*)</a></h4><b>Original Air Date: (.*)</b><br>(.*)<br/><br/>|Ui',$this->page["Episodes"],$matches) ) {
	for ( $i = 0 ; $i < count($matches[0]); $i++ ) {
          $this->main_episodes[$matches[1][$i]][$matches[2][$i]] = array("imdbid" => $matches[3][$i],"title" => $matches[4][$i], "airdate" => $matches[5][$i], "plot" => $matches[6][$i]);
        }
      }
    }
    return $this->main_episodes;
  }

#------------------------------------------------------------[ /goofs page ]---
  /** Get the goofs
   * @method goofs
   * @return array goofs (array[0..n] of array[type,content]
   */
  function goofs() {
    if (empty($this->goofs)) {
      if (empty($this->page["Goofs"])) $this->openpage("Goofs");
      if ($this->page["Goofs"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["Goofs"],'<ul class="trivia">');
      $tag_e = strrpos($this->page["Goofs"],'<ul class="trivia">'); // maybe more than one
      $tag_e = strrpos($this->page["Goofs"],"</ul>",$tag_e);
      $goofs = substr($this->page["Goofs"],$tag_s,$tag_e - $tag_s);
      preg_match_all("/<li><b>(.*?)<\/b>(.*?)<br><br><\/li>/",$goofs,$matches);
      $gc = count($matches[1]);
      for ($i=0;$i<$gc;++$i) $this->goofs[] = array("type"=>$matches[1][$i],"content"=>$matches[2][$i]);
    }
    return $this->goofs;
  }

#-----------------------------------------------------------[ /quotes page ]---
  /** Get the quotes for a given movie
   * @method quotes
   * @return array quotes (array[0..n] of string)
   */
  function quotes() {
    if ( empty($this->main_quotes) ) {
      if ( $this->page["Quotes"] == "" ) $this->openpage("Quotes");
      if ( $this->page["Quotes"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos($this->page["Quotes"], '<a name="qt');
      if (empty($tag_s)) return FALSE;
      $tag_e = $tag_s;
      while ($tag_s = strpos($this->page["Quotes"], '<a name="qt', $tag_e)) {
        $tag_s = strpos($this->page["Quotes"],">", $tag_s) +1;
	$tag_e = strpos($this->page["Quotes"],"<hr",$tag_s);
	$quote = substr($this->page["Quotes"], $tag_s, $tag_e - $tag_s);
	$this->main_quotes[] = preg_replace('/<a href=\"\/name\/nm/i','<a href="http://'.$this->imdbsite.'/name/nm',$quote);
	$tag_s = $tag_e;
      }
    }
    return $this->main_quotes;
  }

#---------------------------------------------------------[ /trailers page ]---
  /** Get the trailer URLs for a given movie
   * @method trailers
   * @return array trailers (array[0..n] of string)
   */
  function trailers() {
    if ( empty($this->main_trailers) ) {
      if ( $this->page["Trailers"] == "" ) $this->openpage("Trailers");
      if ( $this->page["Trailers"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos($this->page["Trailers"], '<div class="video-gallery">');
      if (!empty($tag_s)) { // trailers on the IMDB site itself
        $tag_e = strpos($this->page["Trailers"],"</a>\n</div",$tag_s);
        $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s +1);
        $tag_e = 0;
        while ($tag_s = strpos($trail, '<a href="/rg/VIDEO_TITLE', $tag_e)) {
          $tag_s = strpos($trail,"=", $tag_s) +2;
	  $tag_e = strpos($trail,'">',$tag_s);
          $url   = substr($trail, $tag_s, $tag_e - $tag_s);
	  $this->main_trailers[] = "http://".$this->imdbsite."/$url";
          $tag_s = $tag_e;
        }
      }
      $tag_s = strpos($this->page["Trailers"], "<h3>Trailers on Other Sites</h3>");
      if (empty($tag_s)) return FALSE;
      $tag_e = strpos($this->page["Trailers"], "<h3>Related Links</h3>", $tag_s);
      $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s);
      $tag_e = 0;
      while ($tag_s = strpos($trail, '<a href=', $tag_e)) {
        $tag_s = strpos($trail,"=", $tag_s) +2;
        $tag_e = strpos($trail,'">',$tag_s);
        $this->main_trailers[] = substr($trail, $tag_s, $tag_e - $tag_s);
        $tag_s = $tag_e;
      }
    }
    return $this->main_trailers;
  }

#-----------------------------------------------------------[ /trivia page ]---
  /** Get the trivia info
   * @method trivia
   * @return array trivia (array[0..n] string
   */
  function trivia() {
    if (empty($this->trivia)) {
      if (empty($this->page["Trivia"])) $this->openpage("Trivia");
      if ($this->page["Trivia"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["Trivia"],'<ul class="trivia">');
      $tag_e = strrpos($this->page["Trivia"],'<ul class="trivia">'); // maybe more than one
      $tag_e = strrpos($this->page["Trivia"],"</ul>",$tag_e);
      $goofs = substr($this->page["Trivia"],$tag_s,$tag_e - $tag_s);
      preg_match_all("/<li>(.*?)<br><br><\/li>/",$goofs,$matches);
      $gc = count($matches[1]);
      for ($i=0;$i<$gc;++$i) $this->trivia[] = str_replace('href="/','href="http://'.$this->imdbsite."/",$matches[1][$i]);
    }
    return $this->trivia;
  }

 } // end class imdb

 #====================================================[ IMDB Search class ]===
 /** Search the IMDB for a title and obtain the movies IMDB ID
  * @package Api
  * @class imdbsearch
  * @extends imdb_config
  */
 class imdbsearch extends imdb_config{
  var $page = "";
  var $name = NULL;
  var $resu = array();
  var $url = "http://www.imdb.com/";

  /** Read the config
   * @constructor imdbsearch
   */
  function imdbsearch() {
    $this->imdb_config();
  }

  /** Set the name (title) to search for
   * @method setsearchname
   */
  function setsearchname ($name) {
   $this->name = $name;
   $this->page = "";
   $this->url = NULL;
  }

  /** Set the URL
   * @method seturl
   */
  function seturl($url){
   $this->url = $url;
  }

  /** Create the IMDB URL for the movie search
   * @method mkurl
   * @return string url
   */
  function mkurl () {
   if ($this->url !== NULL){
    $url = $this->url;
   }else{
     if (!isset($this->maxresults)) $this->maxresults = 20;
     switch ($this->searchvariant) {
       case "moonface" : $query = ";more=tt;nr=1"; // @moonface variant (untested)
       case "sevec"    : $query = "&restrict=Movies+only&GO.x=0&GO.y=0&GO=search;tt=1"; // Sevec ori
       default         : $query = ";tt=on"; // Izzy
     }
     if ($this->maxresults > 0) $query .= ";mx=20";
     $url = "http://".$this->imdbsite."/find?q=".urlencode($this->name).$query;
   }
   return $url;
  }

  /** Setup search results
   * @method results
   * @return array results
   */
  function results ($url="") {
   if ($this->page == "") {
     if (empty($url)) $url = $this->mkurl();
     $be = new IMDB_Request($url);
     $be->sendrequest();
     $fp = $be->getResponseBody();
     if ( !$fp ){
       if ($header = $be->getResponseHeader("Location")){
        if (strpos($header,$this->imdbsite."/find?")) {
          return $this->results($header);
          break(4);
        }
        #--- @moonface variant (not tested)
        # $idpos = strpos($header, "/Title?") + 7;
        # $this->resu[0] = new imdb( substr($header, $idpos,7));
        #--- end @moonface / start sevec variant
        $url = explode("/",$header);
        $id  = substr($url[count($url)-2],2);
        $this->resu[0] = new imdb($id);
        #--- end Sevec variant
        return $this->resu;
       }else{
        return NULL;
       }
     }
     $this->page = $fp;
   } // end (page="")

   $searchstring = array( '<A HREF="/title/tt', '<A href="/title/tt', '<a href="/Title?', '<a href="/title/tt');
   $i = 0;
   foreach( $searchstring as $srch){
    $res_e = 0;
    $res_s = 0;
    $len = strlen($srch);
    while ((($res_s = strpos ($this->page, $srch, $res_e)) > 10)) {
      $res_e = strpos ($this->page, "(", $res_s);
      $tmpres = new imdb ( substr($this->page, $res_s+$len, 7)); // make a new imdb object by id
      $ts = strpos($this->page, ">",$res_s) +1; // >movie title</a>
      $te = strpos($this->page,"<",$ts);
      $tmpres->main_title = substr($this->page,$ts,$te-$ts);
      $ts = strpos($this->page,"(",$te) +1;
      $te = strpos($this->page,")",$ts);
      $tmpres->main_year=substr($this->page,$ts,$te-$ts);
      $i++;
      $this->resu[$i] = $tmpres;
    }
   }
   return $this->resu;
  }
} // end class imdbsearch

?>
