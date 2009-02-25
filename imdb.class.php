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

 require_once (dirname(__FILE__)."/imdb_base.class.php");

 #=================================================[ The IMDB class itself ]===
 /** Accessing IMDB information
  * @package Api
  * @class imdb
  * @extends imdb_base
  * @author Georgos Giagas
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdb extends imdb_base {

 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method private set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  function set_pagename($wt) {
   switch ($wt){
    case "Title"       : $urlname="/"; break;
    case "Credits"     : $urlname="/fullcredits"; break;
    case "CrazyCredits": $urlname="/crazycredits"; break;
    case "Plot"        : $urlname="/plotsummary"; break;
    case "Synopsis"    : $urlname="/synopsis"; break;
    case "Taglines"    : $urlname="/taglines"; break;
    case "Episodes"    : $urlname="/episodes"; break;
    case "Quotes"      : $urlname="/quotes"; break;
    case "Trailers"    : $urlname="/trailers"; break;
    case "Goofs"       : $urlname="/goofs"; break;
    case "Trivia"      : $urlname="/trivia"; break;
    case "Soundtrack"  : $urlname="/soundtrack"; break;
    case "MovieConnections" : $urlname="/movieconnections"; break;
    case "ExtReviews"  : $urlname="/externalreviews"; break;
    case "ReleaseInfo" : $urlname="/releaseinfo"; break;
    case "CompanyCredits" : $urlname="/companycredits"; break;
    case "ParentalGuide"  : $urlname="/parentalguide"; break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return false;
   }
   return $urlname;
  }

 #--------------------------------------------------[ Start (over) / Reset ]---
  /** Reset page vars
   * @method private reset_vars
   */
  function reset_vars() {
   $this->page["Title"] = "";
   $this->page["Credits"] = "";
   $this->page["CrazyCredits"] = "";
   $this->page["Amazon"] = "";
   $this->page["Goofs"] = "";
   $this->page["Trivia"] = "";
   $this->page["Plot"] = "";
   $this->page["Synopsis"] = "";
   $this->page["Comments"] = "";
   $this->page["Quotes"] = "";
   $this->page["Taglines"] = "";
   $this->page["Plotoutline"] = "";
   $this->page["Trivia"] = "";
   $this->page["Directed"] = "";
   $this->page["Episodes"] = "";
   $this->page["Quotes"] = "";
   $this->page["Trailers"] = "";
   $this->page["MovieConnections"] = "";
   $this->page["ExtReviews"] = "";
   $this->page["ReleaseInfo"] = "";
   $this->page["CompanyCredits"] = "";
   $this->page["ParentalGuide"] = "";

   $this->akas = array();
   $this->countries = array();
   $this->crazy_credits = array();
   $this->credits_cast = array();
   $this->credits_composer = array();
   $this->credits_director = array();
   $this->credits_producer = array();
   $this->credits_writing = array();
   $this->extreviews = array();
   $this->goofs = array();
   $this->langs = array();
   $this->main_comment = "";
   $this->main_genre = "";
   $this->main_language = "";
   $this->main_photo = "";
   $this->main_thumb = "";
   $this->main_plotoutline = "";
   $this->main_rating = -1;
   $this->main_runtime = "";
   $this->main_title = "";
   $this->main_votes = -1;
   $this->main_year = -1;
   $this->main_tagline = "";
   $this->moviecolors = array();
   $this->movieconnections = array();
   $this->moviegenres = array();
   $this->moviequotes = array();
   $this->movieruntimes = array();
   $this->mpaas = array();
   $this->mpaa_justification = "";
   $this->plot_plot = array();
   $this->synopsis_wiki = "";
   $this->release_info = array();
   $this->seasoncount = -1;
   $this->season_episodes = array();
   $this->sound = array();
   $this->soundtracks = array();
   $this->split_comment = array();
   $this->split_plot = array();
   $this->taglines = array();
   $this->trailers = array();
   $this->trivia = array();
   $this->compcred_prod = array();
   $this->compcred_dist = array();
   $this->compcred_special = array();
   $this->compcred_other = array();
   $this->parental_guide = array();
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor imdb
   * @param string id IMDBID to use for data retrieval
   */
  function imdb ($id) {
   $this->imdb_base($id);
  }

 #-----------------------------------------------[ URL to movies main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  function main_url(){
   return "http://".$this->imdbsite."/title/tt".$this->imdbid()."/";
  }

 #-------------------------------------------[ Movie title (name) and year ]---
  /** Setup title and year properties
   * @method private title_year
   */
  function title_year() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (@preg_match("/\<title\>(.*) \((\d{4}|\?{4}).*\)\<\/title\>/",$this->page["Title"],$match)) {
      $this->main_title = $match[1];
      if ($match[2]=="????") $this->main_year = "";
      else $this->main_year  = $match[2];
    }
  }

  /** Get movie title
   * @method title
   * @return string title movie title (name)
   */
  function title () {
    if ($this->main_title == "") $this->title_year();
    return $this->main_title;
  }

  /** Get year
   * @method year
   * @return string year
   */
  function year () {
    if ($this->main_year == -1) $this->title_year();
    return $this->main_year;
  }

 #---------------------------------------------------------------[ Runtime ]---
  /** Get general runtime
   * @method private runtime_all
   * @return string runtime complete runtime string, e.g. "150 min / USA:153 min (director's cut)"
   */
  function runtime_all() {
    if ($this->main_runtime == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/Runtime:\<\/h5\>\n(.*?)\n/m",$this->page["Title"],$match))
        $this->main_runtime = $match[1];
    }
    return $this->main_runtime;
  }

  /** Get overall runtime (first one mentioned on title page)
   * @method runtime
   * @return mixed string runtime in minutes (if set), NULL otherwise
   */
  function runtime() {
    if (empty($this->movieruntimes)) $runarr = $this->runtimes();
    else $runarr = $this->movieruntimes;
    if (isset($runarr[0]["time"])) return $runarr[0]["time"];
    return NULL;
  }

  /** Retrieve language specific runtimes
   * @method runtimes
   * @return array runtimes (array[0..n] of array[time,country,comment])
   */
  function runtimes(){
    if (empty($this->movieruntimes)) {
      if ($this->runtime_all() == "") return array();
      if (preg_match_all("/[\/ ]*((\D*?):|)([\d]+?) min( \((.*?)\)|)/",$this->main_runtime,$matches))
        for ($i=0;$i<count($matches[0]);++$i) $this->movieruntimes[] = array("time"=>$matches[3][$i],"country"=>$matches[2][$i],"comment"=>$matches[5][$i]);
    }
    return $this->movieruntimes;
  }

 #----------------------------------------------------------[ Movie Rating ]---
  /** Setup votes
   * @method private rate_vote
   */
  function rate_vote() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (@preg_match("/\<b\>(.*?)\/(.*?)\<\/b\>\s*\n\s*&nbsp;&nbsp;\<a href\=\"ratings\" class=\"tn15more\"\>([\d\,]+)/m",$this->page["Title"],$match)) {
      $this->main_rating = $match[1];
      $this->main_votes  = $match[3];
    } else {
      $this->main_rating = 0;
      $this->main_votes  = 0;
    }
  }

  /** Get movie rating
   * @method rating
   * @return string rating current rating as given by IMDB site
   */
  function rating () {
    if ($this->main_rating == -1) $this->rate_vote();
    return $this->main_rating;
  }

  /** Return votes for this movie
   * @method votes
   * @return string votes count of votes for this movie
   */
  function votes () {
    if ($this->main_votes == -1) $this->rate_vote();
    return $this->main_votes;
  }

 #------------------------------------------------------[ Movie Comment(s) ]---
  /** Get movie main comment (from title page)
   * @method comment
   * @return string comment full text of movie comment from the movies main page
   */
  function comment () {
    if ($this->main_comment == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/\<div class\=\"comment\"(.*?)(\<b\>.*?)\<div class\=\"yn\"/ms",$this->page["Title"],$match))
        $this->main_comment = preg_replace("/a href\=\"\//i","a href=\"http://".$this->imdbsite."/",$match[2]);
        $this->main_comment = str_replace("http://i.media-imdb.com/images/showtimes",$this->imdb_img_url."/showtimes",$this->main_comment);
    }
    return $this->main_comment;
  }

  /** Get movie main comment (from title page - split-up variant)
   * @method comment_split
   * @return array comment array[string title, string date, array author, string comment]; author: array[string url, string name]
   */
  function comment_split() {
    if (empty($this->split_comment)) {
      if ($this->main_comment == "") $comm = $this->comment();
      if (@preg_match("/<b>(.*?)<\/b>, (.*)<br>.*?<a href=\"(.*)\">(.*?)<\/a>.*<p>(.*?)<\/p>/ms",$this->main_comment,$match))
        $this->split_comment = array("title"=>$match[1],"date"=>$match[2],"author"=>array("url"=>$match[3],"name"=>$match[4]),"comment"=>trim($match[5]));
    }
    return $this->split_comment;
  }

 #--------------------------------------------------------[ Language Stuff ]---
  /** Get movies original language
   * @method language
   * @return string language
   * @brief There is not really a main language on the IMDB sites (yet), so this
   *  simply returns the first one
   */
  function language () {
   if ($this->main_language == "") {
    if (empty($this->langs)) $langs = $this->languages();
    $this->main_language = $this->langs[0];
   }
   return $this->main_language;
  }

  /** Get all langauges this movie is available in
   * @method languages
   * @return array languages (array[0..n] of strings)
   */
  function languages () {
   if (empty($this->langs)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/\/Sections\/Languages\/.*?>\s*(.*?)\s*</m",$this->page["Title"],$matches))
      $this->langs = $matches[1];
   }
   return $this->langs;
  }

 #--------------------------------------------------------------[ Genre(s) ]---
  /** Get the movies main genre
   *  Since IMDB.COM does not really now a "Main Genre", this simply means the
   *  first mentioned genre will be returned.
   * @method genre
   * @return string genre first of the genres listed on the movies main page
   * @brief There is not really a main genre on the IMDB sites (yet), so this
   *  simply returns the first one
   */
  function genre () {
   if (empty($this->main_genre)) {
    if (empty($this->moviegenres)) $genres = $this->genres();
    if (!empty($genres)) $this->main_genre = $this->moviegenres[0];
   }
   return $this->main_genre;
  }

  /** Get all genres the movie is registered for
   * @method genres
   * @return array genres (array[0..n] of strings)
   */
  function genres () {
    if (empty($this->moviegenres)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (preg_match_all("/\<a href\=\"\/Sections\/Genres\/[\w\-]+\/\"\>(.*?)\<\/a\>/",$this->page["Title"],$matches))
        $this->moviegenres = $matches[1];
    }
    return $this->moviegenres;
  }

 #----------------------------------------------------------[ Color format ]---
  /** Get colors
   * @method colors
   * @return array colors (array[0..1] of strings)
   */
  function colors () {
    if (empty($this->moviecolors)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (preg_match_all("/\/List\?color-info.*?>\s*(.*?)</",$this->page["Title"],$matches))
        $this->moviecolors = $matches[1];
    }
    return $this->moviecolors;
  }

 #---------------------------------------------------------------[ Tagline ]---
  /** Get the main tagline for the movie
   * @method tagline
   * @return string tagline
   */
  function tagline () {
    if ($this->main_tagline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/Tagline:\<\/h5\>\s*\n(.*?)(<\/div|<a class=\"tn15more)/ms",$this->page["Title"],$match)) {
        $this->main_tagline = trim($match[1]);
      }
    }
    return $this->main_tagline;
  }

 #---------------------------------------------------------------[ Seasons ]---
  /** Get the number of seasons or 0 if not a series
   * @method seasons
   * @return int seasons number of seasons
   */
  function seasons() {
    if ( $this->seasoncount == -1 ) {
      if ( $this->page["Title"] == "" ) $this->openpage("Title");
      if ( preg_match_all('|<a href="episodes#season-\d+">(\d+)</a>|Ui',$this->page["Title"],$matches) ) {
        $this->seasoncount = count($matches[0]);
      } else {
        $this->seasoncount = 0;
      }
    }
    return $this->seasoncount;
  }

 #--------------------------------------------------------[ Plot (Outline) ]---
  /** Get the main Plot outline for the movie
   * @method plotoutline
   * @return string plotoutline
   */
  function plotoutline () {
    if ($this->main_plotoutline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/Plot:\<\/h5\>\s*\n(.*?)(<\/div|\||<a class=\"tn15more)/ms",$this->page["Title"],$match)) {
        $this->main_plotoutline = trim($match[1]);
      }
    }
    return $this->main_plotoutline;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Setup cover photo (thumbnail and big variant)
   * @method thumbphoto
   * @return boolean success (TRUE if found, FALSE otherwise)
   */
  function thumbphoto() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    preg_match("/\<a name=\"poster\"(.*?)\<img (.*?) src\=\"(.*?)\"/",$this->page["Title"],$match);
    if (empty($match[3])) return FALSE;
    $this->main_thumb = $match[3];
    preg_match('|(.*\._V1).*|iUs',$match[3],$mo);
    $this->main_photo = $mo[1];
    return true;
  }

  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return mixed photo (string url if found, FALSE otherwise)
   */
  function photo($thumb=true) {
    if (empty($this->main_photo)) $this->thumbphoto();
    if (!$thumb && empty($this->main_photo)) return false;
    if ($thumb && empty($this->main_thumb)) return false;
    if ($thumb) return $this->main_thumb;
    return $this->main_photo;
  }

  /** Save the photo to disk
   * @method savephoto
   * @param string path where to store the file
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return boolean success
   */
  function savephoto ($path,$thumb=true) {
    $req = new IMDB_Request("");
    $photo_url = $this->photo ($thumb);
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
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return mixed url (string URL or FALSE if none)
   */
  function photo_localurl($thumb=true){
    if ($thumb) $ext = ""; else $ext = "_big";
    if (!is_dir($this->photodir)) {
      $this->debug_scalar("<BR>***ERROR*** The configured image directory does not exist!<BR>");
      return false;
    }
    $path = $this->photodir.$this->imdbid()."${ext}.jpg";
    if ( @fopen($path,"r")) return $this->photoroot.$this->imdbid()."${ext}.jpg";
    if (!is_writable($this->photodir)) {
      $this->debug_scalar("<BR>***ERROR*** The configured image directory lacks write permission!<BR>");
      return false;
    }
    if ($this->savephoto($path,$thumb)) return $this->photoroot.$this->imdbid()."${ext}.jpg";
    return false;
  }

 #-------------------------------------------------[ Country of Production ]---
  /** Get country of production
   * @method country
   * @return array country (array[0..n] of string)
   */
  function country () {
   if (empty($this->countries)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->countries = array();
    if (preg_match_all("/\/Sections\/Countries\/\w+\/\"\>\s*(.*?)<\/a/m",$this->page["Title"],$matches))
      for ($i=0;$i<count($matches[0]);++$i) $this->countries[$i] = $matches[1][$i];
   }
   return $this->countries;
  }

 #------------------------------------------------------------[ Movie AKAs ]---
  /** Get movies alternative names
   * @method alsoknow
   * @return array aka array[0..n] of array[title,year,country,comment]; searching
   *         on akas.imdb.com will add "lang" (2-char language code) to the array
   *         for localized names, "comment" will hold additional countries listed
   *         along for these as well as comments: As these things are quite mixed
   *         up on the imdb sites, it's hard to tell what is an additional country
   *         and what is a comment...
   */
  function alsoknow () {
   if (empty($this->akas)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $ak_s = strpos ($this->page["Title"], "Also Known As:</h5>");
    if ($ak_s>0) $ak_s += 19;
    if ($ak_s == 0) $ak_s = strpos ($this->page["Title"], "Alternativ:");
    if ($ak_s == 0) return array();
    $alsoknow_end = strpos ($this->page["Title"], "</div>", $ak_s);
    $alsoknow_all = substr($this->page["Title"], $ak_s, $alsoknow_end - $ak_s);

    $aka_arr = explode("<br>",str_replace("\n","",$alsoknow_all));
    foreach ($aka_arr as $aka) {
      $aka = trim($aka);
      if (strpos('class="tn15more"',$aka)>0) break; // end of list
      if (empty($aka)) continue;
      if (!preg_match("/\(/",$aka)) $this->akas[] = array("title"=>$aka,"year"=>"","country"=>"","comment"=>"");
      elseif (preg_match("/<i class=\"transl\">([^\[\(]+?) (\(\d{4}\) |)(\([^\[]+)\s*\[(.*?)\]<\/i>/",$aka,$match)) { // localized variants on akas.imdb.com
        if (preg_match_all("/\((.*?)\)/",$match[3],$countries)) {
          $country = $countries[1][0]; $comment = "";
          for ($i=1;$i<count($countries[0]);++$i) $comment .= ", ".$countries[1][$i];
        } else $country = $comment = "";
        $this->akas[] = array("title"=>$match[1],"year"=>$match[2],"country"=>$country,"comment"=>substr($comment,2),"lang"=>$match[4]);
      } elseif (preg_match("/(.*?) (\(\d{4}\) |)\((.*?)\)(.*?(\(.*\))|)/",$aka,$match)) {
        if (!empty($match[5]) && preg_match_all("/\((.*?)\)/",$match[5],$comments)) {
          $comm = $comments[1][0];
          for ($i=1;$i<count($comments[0]);++$i) $comm .= ", ".$comments[1][$i];
        } else $comm = "";
        $this->akas[] = array("title"=>$match[1],"year"=>$match[2],"country"=>$match[3],"comment"=>$comm);
      }
    }
   }
   return $this->akas;
  }

 #---------------------------------------------------------[ Sound formats ]---
  /** Get sound formats
   * @method sound
   * @return array sound (array[0..n] of strings)
   */
  function sound () {
   if (empty($this->sound)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/\/List\?sound.*?>\s*(.*?)</",$this->page["Title"],$matches))
      $this->sound = $matches[1];
   }
   return $this->sound;
  }

 #-------------------------------------------------------[ MPAA / PG / FSK ]---
  /** Get the MPAA data (also known as PG or FSK)
   * @method mpaa
   * @return array mpaa (array[country]=rating)
   */
  function mpaa () {
   if (empty($this->mpaas)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("/\/List\?certificates.*?>\s*(.*?):(.*?)</",$this->page["Title"],$matches)) {
      $cc = count($matches[0]);
      for ($i=0;$i<$cc;++$i) $this->mpaas[$matches[1][$i]] = $matches[2][$i];
    }
   }
   return $this->mpaas;
  }

 #----------------------------------------------------[ MPAA justification ]---
  /** Find out the reason for the MPAA rating
   * @method mpaa_reason
   * @return string reason why the movie was rated such
   */
  function mpaa_reason () {
   if (empty($this->mpaa_justification)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match("/href=\"\/mpaa\"\>.*<\/h5\>\s*(.*?)\s*<\/div/",$this->page["Title"],$match))
      $this->mpaa_justification = trim($match[1]);
   }
   return $this->mpaa_justification;
  }

 #-----------------------------------------------------[ /plotsummary page ]---
  /** Get the movies plot(s)
   * @method plot
   * @return array plot (array[0..n] of strings)
   */
  function plot () {
   if (empty($this->plot_plot)) {
    if ( $this->page["Plot"] == "" ) $this->openpage ("Plot");
    if ( $this->page["Plot"] == "cannot open page" ) return array(); // no such page
    if (preg_match_all("/p class=\"plotpar\">(.*?)<\/p>/",str_replace("\n"," ",$this->page["Plot"]),$matches))
      for ($i=0;$i<count($matches[0]);++$i)
        $this->plot_plot[$i] = preg_replace('/<a href=\"\/SearchPlotWriters/i','<a href="http://'.$this->imdbsite.'/SearchPlotWriters/',$matches[1][$i]);
   }
   return $this->plot_plot;
  }

  /** Get the movie plot(s) - split-up variant
   * @method plot_split
   * @return array array[0..n] of array[string plot,array author] - where author consists of string name and string url
   */
  function plot_split() {
    if (empty($this->split_plot)) {
      if (empty($this->plot_plot)) $plots = $this->plot();
      for ($i=0;$i<count($this->plot_plot);++$i) {
        if (preg_match("/(.*?)<i>.*<a href=\"(.*?)\">(.*?)<\/a>/",$this->plot_plot[$i],$match))
          $this->split_plot[] = array("plot"=>$match[1],"author"=>array("name"=>$match[3],"url"=>$match[2]));
      }
    }
    return $this->split_plot;
  }

 #--------------------------------------------------------[ /synopsis page ]---
  /** Get the movies synopsis
   * @method synopsis
   * @return string synopsis
   */
  function synopsis() {
    if (empty($this->synopsis_wiki)) {
    if ( $this->page["Synopsis"] == "" ) $this->openpage ("Synopsis");
    if ( $this->page["Synopsis"] == "cannot open page" ) return $this->synopsis_wiki; // no such page
    if (preg_match('|<div id="swiki\.2\.1">(.*?)</div>|ims',$this->page["Synopsis"],$match))
      $this->synopsis_wiki = trim($match[1]);
    }
    return $this->synopsis_wiki;
  }

 #--------------------------------------------------------[ /taglines page ]---
  /** Get all available taglines for the movie
   * @method taglines
   * @return array taglines (array[0..n] of strings)
   */
  function taglines () {
   if (empty($this->taglines)) {
    if ( $this->page["Taglines"] == "" ) $this->openpage ("Taglines");
    if ( $this->page["Taglines"] == "cannot open page" ) return array(); // no such page
    if (preg_match_all("/<p>(.*?)<\/p><hr/",$this->page["Taglines"],$matches))
      $this->taglines = $matches[1];
   }
   return $this->taglines;
  }

 #-----------------------------------------------------[ /fullcredits page ]---
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
   if (preg_match_all("/<tr>(.*?)<\/tr>/",substr($html,$row_s,$endtable - $row_s),$matches)) {
     $mc = count($matches[1]);
     for ($i=0;$i<$mc;++$i) if ( strncmp( trim($matches[1][$i]), "<td valign=",10) == 0 ) $rows[] = $matches[1][$i];
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
   if (preg_match_all("/<tr.*?(<td class=\"nm\".*?)<\/tr>/",substr($html,$row_s,$endtable - $row_s),$matches))
     return $matches[1];
   return array();
  }

  /** Get content of table row cells
   * @method private get_row_cels
   * @param string row (as returned by imdb::get_table_rows)
   * @return array cells (array[0..n] of strings)
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_row_cels ( $row ){
   if (preg_match_all("/<td.*?>(.*?)<\/td>/",$row,$matches)) return $matches[1];
   return array();
  }

  /** Get the IMDB ID from a names URL
   * @method private get_imdbname
   * @param string href url to the staff members IMDB page
   * @return string IMDBID of the staff member
   * @see used by the methods director, cast, writing, producer, composer
   */
  function get_imdbname( $href){
   if ( strlen( $href) == 0) return $href;
   $name_s = 17;
   $name_e = strpos ( $href, '"', $name_s);
   if ( $name_e != 0) return substr( $href, $name_s, $name_e -1 - $name_s);
   else	return $href;
  }

  /** Get the director(s) of the movie
   * @method director
   * @return array director (array[0..n] of arrays[imdb,name,role])
   */
  function director () {
   if (empty($this->credits_director)) {
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
	if ( $role == "") $dir["role"] = NULL;
	else $dir["role"] = $role;
	$this->credits_director[$i] = $dir;
   }
   return $this->credits_director;
  }

  /** Get the actors
   * @method cast
   * @return array cast (array[0..n] of arrays[imdb,name,role])
   */
  function cast () {
   if (empty($this->credits_cast)) {
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
	if ( $role == "") $dir["role"] = NULL;
	else $dir["role"] = $role;
	$this->credits_cast[$i] = $dir;
   }
   return $this->credits_cast;
  }

  /** Get the writer(s)
   * @method writing
   * @return array writers (array[0..n] of arrays[imdb,name,role])
   */
  function writing () {
   if (empty($this->credits_writing)) {
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
       if ( $role == "") $wrt["role"] = NULL;
       else $wrt["role"] = $role;
       $this->credits_writing[$i] = $wrt;
     }
   }
   return $this->credits_writing;
  }

  /** Obtain the producer(s)
   * @method producer
   * @return array producer (array[0..n] of arrays[imdb,name,role])
   */
  function producer () {
   if (empty($this->credits_producer)) {
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
     if ( $role == "") $wrt["role"] = NULL;
     else $wrt["role"] = $role;
     $this->credits_producer[$i] = $wrt;
    }
   }
   return $this->credits_producer;
  }

  /** Obtain the composer(s) ("Original Music by...")
   * @method composer
   * @return array composer (array[0..n] of arrays[imdb,name,role])
   */
  function composer () {
   if (empty($this->credits_composer)) {
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
     if ( $role == "") $wrt["role"] = NULL;
     else $wrt["role"] = $role;
     $this->credits_composer[$i] = $wrt;
    }
   }
   return $this->credits_composer;
  }

 #----------------------------------------------------[ /crazycredits page ]---
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
      if (preg_match_all("/<li><tt>(.*?)<\/tt><\/li>/",$cred,$matches))
        $this->crazy_credits = $matches[1];
    }
    return $this->crazy_credits;
  }

 #--------------------------------------------------------[ /episodes page ]---
  /** Get the series episode(s)
   * @method episodes
   * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot])
   */
  function episodes() {
    if ( $this->seasons() == 0 ) return null;
    if ( empty($this->season_episodes) ) {
      if ( $this->page["Episodes"] == "" ) $this->openpage("Episodes");
      if ( $this->page["Episodes"] == "cannot open page" ) return array(); // no such page
      if ( preg_match_all('|<h3>Season (\d+), Episode (\d+): <a href="/title/tt(\d{7})/">(.*)</a></h3><span.*>Original Air Date.*<strong>(.*)</strong></span><br>\s*(.*)</td>|Ui',$this->page["Episodes"],$matches) ) {
	for ( $i = 0 ; $i < count($matches[0]); $i++ ) {
          $this->season_episodes[$matches[1][$i]][$matches[2][$i]] = array("imdbid" => $matches[3][$i],"title" => $matches[4][$i], "airdate" => $matches[5][$i], "plot" => $matches[6][$i]);
        }
      }
    }
    return $this->season_episodes;
  }

 #-----------------------------------------------------------[ /goofs page ]---
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
      $tag_e = strrpos($this->page["Goofs"],"</ul>");
      $goofs = substr($this->page["Goofs"],$tag_s,$tag_e - $tag_s);
      if (preg_match_all("/<li><b>(.*?)<\/b>(.*?)<br><br><\/li>/",$goofs,$matches)) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) $this->goofs[] = array("type"=>$matches[1][$i],"content"=>$matches[2][$i]);
      }
    }
    return $this->goofs;
  }

 #----------------------------------------------------------[ /quotes page ]---
  /** Get the quotes for a given movie
   * @method quotes
   * @return array quotes (array[0..n] of string)
   */
  function quotes() {
    if ( empty($this->moviequotes) ) {
      if ( $this->page["Quotes"] == "" ) $this->openpage("Quotes");
      if ( $this->page["Quotes"] == "cannot open page" ) return array(); // no such page
      if (preg_match_all("/<a name=\"qt.*?<\/a>\s*(.*?)<hr/",str_replace("\n"," ",$this->page["Quotes"]),$matches))
        foreach ($matches[1] as $match) $this->moviequotes[] = str_replace('href="/name/','href="http://'.$this->imdbsite.'/name/',$match);
    }
    return $this->moviequotes;
  }

 #--------------------------------------------------------[ /trailers page ]---
  /** Get the trailer URLs for a given movie
   * @method trailers
   * @return array trailers (array[0..n] of string)
   */
  function trailers() {
    if ( empty($this->trailers) ) {
      if ( $this->page["Trailers"] == "" ) $this->openpage("Trailers");
      if ( $this->page["Trailers"] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos($this->page["Trailers"], '<div class="video-gallery">');
      if (!empty($tag_s)) { // trailers on the IMDB site itself
        $tag_e = strpos($this->page["Trailers"],"</a>\n</div",$tag_s);
        $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s +1);
        if (preg_match_all("/<a href=\"(\/rg\/VIDEO_TITLE.*?)\">/",$trail,$matches))
          for ($i=0;$i<count($matches[0]);++$i) $this->trailers[] = "http://".$this->imdbsite.$matches[1][$i];
      }
      $tag_s = strpos($this->page["Trailers"], "<h3>Trailers on Other Sites</h3>");
      if (empty($tag_s)) return FALSE;
      $tag_e = strpos($this->page["Trailers"], "<h3>Related Links</h3>", $tag_s);
      $trail = substr($this->page["Trailers"], $tag_s, $tag_e - $tag_s);
      if (preg_match_all("/<a href=\"(.*?)\">/",$trail,$matches))
        $this->trailers = array_merge($this->trailers,$matches[1]);
    }
    return $this->trailers;
  }

 #----------------------------------------------------------[ /trivia page ]---
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
      $tag_e = strrpos($this->page["Trivia"],"</ul>");
      $goofs = substr($this->page["Trivia"],$tag_s,$tag_e - $tag_s);
      if (preg_match_all("/<li>(.*?)<br><br><\/li>/",$goofs,$matches)) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) $this->trivia[] = str_replace('href="/','href="http://'.$this->imdbsite."/",$matches[1][$i]);
      }
    }
    return $this->trivia;
  }

 #------------------------------------------------------[ /soundtrack page ]---
  /** Get the soundtrack listing
   * @method soundtrack
   * @return array soundtracks (array[0..n] of array(soundtrack,array[0..n] of credits)
   * @brief Usually, the credits array should hold [0] written by, [1] performed by.
   *  But IMDB does not always stick to that - so in many cases it holds
   *  [0] performed by, [1] courtesy of
   */
  function soundtrack() {
   if (empty($this->soundtracks)) {
    if (empty($this->page["Soundtrack"])) $this->openpage("Soundtrack");
    if ($this->page["Soundtrack"] == "cannot open page") return array(); // no such page
    if (preg_match_all("/<li>(.*?)<\/b><br>(.*?)<br>(.*?)<br>.*?<\/li>/",str_replace("\n"," ",$this->page["Soundtrack"]),$matches)) {
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) $this->soundtracks[] = array("soundtrack"=>$matches[1][$i],"credits"=>array(
                                                           str_replace('href="/','href="http://'.$this->imdbsite.'/',$matches[2][$i]),
                                                           str_replace('href="/','href="http://'.$this->imdbsite.'/',$matches[3][$i])));
    }
   }
   return $this->soundtracks;
  }

 #-------------------------------------------------[ /movieconnection page ]---
  /** Parse connection block (used by method movieconnection only)
   * @method private parseConnection
   * @param string conn connection type
   * @return array [0..n] of array mid,name,year,comment - or empty array if not found
   */
  function parseConnection($conn) {
    $tag_s = strpos($this->page["MovieConnections"],"<h5>$conn</h5>");
    if (empty($tag_s)) return array(); // no such feature
    $tag_e = strpos($this->page["MovieConnections"],"<h5>",$tag_s+4);
    if (empty($tag_e)) $tag_e = strpos($this->page["MovieConnections"],"<hr/><h3>",$tag_s);
    $block = substr($this->page["MovieConnections"],$tag_s,$tag_e-$tag_s);
    if (preg_match_all("/\<a href=\"(.*?)\"\>(.*?)\<\/a\> \((\d{4})\)(.*\<br\/\>\&nbsp;-\&nbsp;(.*))?/",$block,$matches)) {
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) {
        $mid = substr($matches[1][$i],9,strlen($matches[1][$i])-10); // isolate imdb id from url
        $arr[] = array("mid"=>$mid, "name"=>$matches[2][$i], "year"=>$matches[3][$i], "comment"=>$matches[5][$i]);
      }
    }
    return $arr;
  }

  /** Get connected movie information
   * @method movieconnection
   * @return array connections (versionOf, editedInto, followedBy, spinOff,
   *         spinOffFrom, references, referenced, features, featured, spoofs,
   *         spoofed - each an array of mid, name, year, comment or an empty
   *         array if no connections of that type)
   */
  function movieconnection() {
    if (empty($this->movieconnections)) {
      if (empty($this->page["MovieConnections"])) $this->openpage("MovieConnections");
      if ($this->page["MovieConnections"] == "cannot open page") return array(); // no such page
      $this->movieconnections["versionOf"]  = $this->parseConnection("Version of");
      $this->movieconnections["editedInto"] = $this->parseConnection("Edited into");
      $this->movieconnections["followedBy"] = $this->parseConnection("Followed By");
      $this->movieconnections["spinOffFrom"] = $this->parseConnection("Spin off from");
      $this->movieconnections["spinOff"] = $this->parseConnection("Spin off");
      $this->movieconnections["references"] = $this->parseConnection("References");
      $this->movieconnections["referenced"] = $this->parseConnection("Referenced in");
      $this->movieconnections["features"] = $this->parseConnection("Features");
      $this->movieconnections["featured"] = $this->parseConnection("Featured in");
      $this->movieconnections["spoofs"] = $this->parseConnection("Spoofs");
      $this->movieconnections["spoofed"] = $this->parseConnection("Spoofed in");
    }
    return $this->movieconnections;
  }

 #------------------------------------------------[ /externalreviews page ]---
  /** Get list of external reviews (if any)
   * @method extReviews
   * @return array [0..n] of array [url, desc] (or empty array if no data)
   */
  function extReviews() {
    if (empty($this->extreviews)) {
      if (empty($this->page["ExtReviews"])) $this->openpage("ExtReviews");
      if ($this->page["ExtReviews"] == "cannot open page") return array(); // no such page
      if (preg_match_all("/\<li\>\<a href=\"(.*?)\"\>(.*?)\<\/a\>/",$this->page["ExtReviews"],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          $this->extreviews[$i] = array("url"=>$matches[1][$i], "desc"=>$matches[2][$i]);
        }
      }
    }
    return $this->extreviews;
  }

 #-----------------------------------------------------[ /releaseinfo page ]---
  /** Obtain Release Info (if any)
   * @method releaseInfo
   * @return array release_info array[0..n] of strings (country,day,month,year,comment)
   */
  function releaseInfo() {
    if (empty($this->release_info)) {
      if (empty($this->page["ReleaseInfo"])) $this->openpage("ReleaseInfo");
      if ($this->page["ReleaseInfo"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["ReleaseInfo"],'<th class="xxxx">Country</th><th class="xxxx">Date</th>');
      $tag_e = strpos($this->page["ReleaseInfo"],'</table',$tag_s);
      $block = substr($this->page["ReleaseInfo"],$tag_s,$tag_e-$tag_s);
      preg_match_all('/<tr>.*?">(.*?)<.*?<td.*?href=.*?day=(\d+).*?month=(.*?)">.*?>(\d{4})<.*?<td>\s*(\((.*?)\)\s*|<\/td>)/ims',$block,$matches);
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) $this->release_info[] = array("country"=>$matches[1][$i],"day"=>$matches[2][$i],"month"=>$matches[3][$i],"year"=>$matches[4][$i],"comment"=>$matches[6][$i]);
    }
    return $this->release_info;
  }

 #-------------------------------------------------------[ /companycredits ]---
  /** Parse company info
   * @method private companyParse
   * @param ref string text to parse
   * @param ref array parse target
   */
  function companyParse(&$text,&$target) {
    preg_match_all('|<li><a href="(.*)">(.*)</a>(.*)</li>|iUms',$text,$matches);
    $mc = count($matches[0]);
    for ($i=0;$i<$mc;++$i) {
      $target[] = array("name"=>$matches[2][$i], "url"=>$matches[1][$i], "notes"=>$matches[3][$i]);
    }
  }

  /** Info about Production Companies
   * @method prodCompany
   * @return array [0..n] of array (name,url,notes)
   */
  function prodCompany() {
    if (empty($this->compcred_prod)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h2>Production Companies</h2><ul>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_prod);
      }
    }
    return $this->compcred_prod;
  }

  /** Info about distributors
   * @method distCompany
   * @return array [0..n] of array (name,url,notes)
   */
  function distCompany() {
    if (empty($this->compcred_dist)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h2>Distributors</h2><ul>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_dist);
      }
    }
    return $this->compcred_dist;
  }

  /** Info about Special Effects companies
   * @method specialCompany
   * @return array [0..n] of array (name,url,notes)
   */
  function specialCompany() {
    if (empty($this->compcred_special)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h2>Special Effects</h2><ul>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_special);
      }
    }
    return $this->compcred_special;
  }

  /** Info about other companies
   * @method otherCompany
   * @return array [0..n] of array (name,url,notes)
   */
  function otherCompany() {
    if (empty($this->compcred_other)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h2>Other Companies</h2><ul>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_other);
      }
    }
    return $this->compcred_other;
  }

 #--------------------------------------------------------[ /parentalguide ]---
  /** Detailed Parental Guide
   * @method parentalGuide
   * @return array of strings; keys: Alcohol, Sex, Violence, Profanity,
   *         Frightening - and maybe more
   */
  function parentalGuide() {
    if (empty($this->parental_guide)) {
      if (empty($this->page["ParentalGuide"])) $this->openpage("ParentalGuide");
      if ($this->page["ParentalGuide"] == "cannot open page") return array(); // no such page
      if (preg_match_all('/<div class="section">(.*)<div id="swiki(\.\d+\.\d+|_last)">/iUms',$this->page["ParentalGuide"],$matches)) {
        $mc = count($matches[0]);
	for ($i=0;$i<$mc;++$i) {
	  preg_match('|<span>(.*)</span>|iUms',$matches[1][$i],$match);
	  $section = $match[1];
	  preg_match('|<p id="swiki\.\d+\.\d+\.\d+">(.*)</p>|iUms',$matches[1][$i],$match);
	  $content = trim($match[1]);
	  preg_match('/^(.*)(\s|\/)/U',$section,$match);
	  $sgot = $match[1]; if (empty($sgot)) $sgot = $section;
	  switch($sgot) {
	    case "Alcohol"    : $this->parental_guide["Drugs"] = trim($content); break;
	    case "Sex"        :
	    case "Violence"   :
	    case "Profanity"  :
	    case "Frightening":
	    default           : $this->parental_guide[$sgot] = trim($content); break;
	  }
	}
      }
    }
    return $this->parental_guide;
  }

 } // end class imdb

?>
