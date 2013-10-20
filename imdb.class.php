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

 require_once (dirname(__FILE__)."/movie_base.class.php");

 #=============================================================================
 #=================================================[ The IMDB class itself ]===
 #=============================================================================
 /** Accessing IMDB information
  * @package IMDB
  * @class imdb
  * @extends movie_base
  * @author Georgos Giagas
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdb extends movie_base {

 #======================================================[ Common functions ]===
 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize the class
   * @constructor imdb
   * @param string id IMDBID to use for data retrieval
   */
  function __construct($id) {
    parent::__construct($id);
    $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
    $this->setid($id);
  }

 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   switch ($wt){
    case "Title"       : $urlname="/"; break;
    case "TitleFoot"   : $urlname="/_ajax/iframe?component=footer"; break;
    case "Credits"     : $urlname="/fullcredits"; break;
    case "CrazyCredits": $urlname="/crazycredits"; break;
    case "Plot"        : $urlname="/plotsummary"; break;
    case "Synopsis"    : $urlname="/synopsis"; break;
    case "Taglines"    : $urlname="/taglines"; break;
    case "Episodes"    : $urlname="/episodes"; break;
    case "Quotes"      : $urlname="/quotes"; break;
    case "Trailers"    : $urlname="/trailers"; break;
    case "VideoSites"  : $urlname="/videosites"; break;
    case "Goofs"       : $urlname="/trivia?tab=gf"; break;
    case "Trivia"      : $urlname="/trivia"; break;
    case "Soundtrack"  : $urlname="/soundtrack"; break;
    case "MovieConnections" : $urlname="/trivia?tab=mc"; break;
    case "ExtReviews"  : $urlname="/externalreviews"; break;
    case "ReleaseInfo" : $urlname="/releaseinfo"; break;
    case "CompanyCredits" : $urlname="/companycredits"; break;
    case "ParentalGuide"  : $urlname="/parentalguide"; break;
    case "OfficialSites"  : $urlname="/officialsites"; break;
    case "Keywords"       : $urlname="/keywords"; break;
    case "Awards"      : $urlname="/awards"; break;
    case "Locations"   : $urlname="/locations"; break;
    default            :
      if ( preg_match('!^Episodes-(\d+)$!',$wt,$match) ) {
        $urlname = '/episodes?season='.$match[1];
      } else {
        $this->page[$wt] = "unknown page identifier";
        $this->debug_scalar("Unknown page identifier: $wt");
        return false;
      }
   }
   return $urlname;
  }

 #-----------------------------------------------[ URL to movies main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  public function main_url(){
   return "http://".$this->imdbsite."/title/tt".$this->imdbid()."/";
  }

 #======================================================[ Title page infos ]===
 #-------------------------------------------[ Movie title (name) and year ]---
  /** Setup title and year properties
   * @method protected title_year
   */
  protected function title_year() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (@preg_match('!<title>(IMDb\s*-\s*)?(?<title>.*) \((?<movietype>.*)(?<year>\d{4}|\?{4}).*\)(.*)(\s*-\s*IMDb)?</title>!',$this->page["Title"],$match)) {
      $this->main_title = $match[2];
      if(preg_match('!class="title-extra" itemprop="name"\s*>\s*"?(.*?)"?\s*<i>!s',$this->page["Title"],$otitle)) $this->original_title = trim($otitle[1]);
      if (empty($match[3])) $main_movietype = 'Movie';
      else $main_movietype  = $match[3];
      if ($match[3]=="????") $this->main_year = "";
      else $this->main_year  = $match[4];
      $mt = trim($match[3]);
      if ( $mt != '????' && !empty($mt) ) $this->main_movietype = $mt;
      if ( preg_match('!^(.+)\s+(\d{4})&ndash;\s*$!',$main_movietype,$match) ) {
        $this->main_endyear = $this->main_year;
        $this->main_year    = $match[2];
      } else {
        $this->main_endyear = $this->main_year;
      }
    }
  }

  /** Get movie type
   * @method movietype
   * @return string movietype (TV series, Movie, ...)
   * @see IMDB page / (TitlePage)
   * @brief This is faster than movietypes() as it is retrieved already together with the title.
   *        If no movietype had been defined explicitly, it returns 'Movie' -- so this is always set.
   */
  public function movietype() {
    if ( empty($this->main_movietype) ) {
      if ( empty($this->main_title) ) $this->title_year(); // in case title was not yet parsed; it might already contain the movietype
      if ( !empty($this->main_movietype) ) return $this->main_movietype; // done already
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if ( preg_match('!<h1 class="header"[^>]*>.+</h1>\s*<div class="infobar">\s*([\w\s]+)!ims', $this->page["Title"],$match) ) {
        $this->main_movietype = trim($match[1]);
      }
      $this->debug_object($match);
    }
    if ( empty($this->main_movietype) ) $this->main_movietype = 'Movie';
    return $this->main_movietype;
  }

  /** Get movie title
   * @method title
   * @return string title movie title (name)
   * @see IMDB page / (TitlePage)
   */
  public function title() {
    if ($this->main_title == "") $this->title_year();
    return $this->main_title;
  }

  /** Get movie original title
   * @method orig_title
   * @return string title original movie title (name), if available
   * @see IMDB page / (TitlePage)
   */
  public function orig_title() {
    if ($this->main_title == "") $this->title_year();
    return $this->original_title;
  }

  /** Get year
   * @method year
   * @return string year
   * @see IMDB page / (TitlePage)
   */
  public function year() {
    if ($this->main_year == -1) $this->title_year();
    return $this->main_year;
  }

  /** Get end-year
   *  Usually this returns the same value as year() -- except for those cases where production spanned multiple years, usually for series
   * @method endyear
   * @return string year
   * @see IMDB page / (TitlePage)
   */
  public function endyear() {
    if ($this->main_endyear == -1) $this->title_year();
    return $this->main_endyear;
  }

  /** Get range of years for e.g. series spanning multiple years
   * @method yearspan
   * @return array yearspan [start,end] (if there was no range, start==end)
   * @see IMDB page / (TitlePage)
   */
  function yearspan() {
    if ( empty($this->main_yearspan) ) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if ( preg_match('!<title>.*?\(.*?(\d{4})(\&ndash;|\xe2\x80\x93|-)(\d{4}|\?{4}).*?</title>!i',$this->page['Title'],$match) ) {
        $this->main_yearspan = array('start'=>$match[1],'end'=>$match[3]);
      } else {
        $this->main_yearspan = array('start'=>$this->year(),'end'=>$this->year());
      }
    }
    return $this->main_yearspan;
  }

  /** Get movie types (if any specified)
   * @method movieTypes
   * @return array [0..n] of strings (or empty array if no movie types specified)
   * @see IMDB page / (TitlePage)
   */
  public function movieTypes() {
    if ( empty($this->main_movietypes) ) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/\<title\>(.*)\<\/title\>/",$this->page["Title"],$match)) {
        if (preg_match_all('|\(([^\)]*)\)|',$match[1],$matches)) {
          for ($i=0;$i<count($matches[0]);++$i) if (!preg_match('|^\d{4}$|',$matches[1][$i])) $this->main_movietypes[] = $matches[1][$i];
        }
      }
    }
    return $this->main_movietypes;
  }

 #---------------------------------------------------------------[ Runtime ]---
  /** Get general runtime
   * @method protected runtime_all
   * @return string runtime complete runtime string, e.g. "150 min / USA:153 min (director's cut)"
   */
  protected function runtime_all() {
    if ($this->main_runtime == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match('!Runtime:</h4>\s*(.*)\s*</div!ms',$this->page["Title"],$match))
        $this->main_runtime = $match[1];
    }
    return $this->main_runtime;
  }

  /** Get overall runtime (first one mentioned on title page)
   * @method runtime
   * @return mixed string runtime in minutes (if set), NULL otherwise
   * @see IMDB page / (TitlePage)
   */
  public function runtime() {
    if (empty($this->movieruntimes)) $runarr = $this->runtimes();
    else $runarr = $this->movieruntimes;
    if (isset($runarr[0]["time"])) return $runarr[0]["time"];
    return NULL;
  }

  /** Retrieve language specific runtimes
   * @method runtimes
   * @return array runtimes (array[0..n] of array[time,country,comment])
   * @see IMDB page / (TitlePage)
   */
  public function runtimes(){
    if (empty($this->movieruntimes)) {
      if (empty($this->main_runtime)) $rt = $this->runtime_all();
      if (preg_match_all("/[\/ ]*((\D*?):|)([\d]+?) min( \((.*?)\)|)/",$this->main_runtime,$matches)) {
        for ($i=0;$i<count($matches[0]);++$i) $this->movieruntimes[] = array("time"=>$matches[3][$i],"country"=>$matches[2][$i],"comment"=>$matches[5][$i]);
      } elseif (preg_match('!<div class="infobar">.*?(\d+)\s*min!ims',$this->page['Title'],$match)) {
        $this->movieruntimes[] = array('time'=>$match[1],'country'=>'','comment'=>'');
      }
    }
    return $this->movieruntimes;
  }

  #----------------------------------------------------------[ Aspect Ratio ]---
  /** Aspect Ratio of movie screen
   * @method aspect_ratio
   * @return string ratio
   * @see IMDB page / (TitlePage)
   */
  public function aspect_ratio() {
    if (empty($this->aspectratio)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      preg_match('!<h4 class="inline">Aspect Ratio:</h4>\s*(.*?)\s</div>!ims',$this->page["Title"],$match);
      $this->aspectratio = $match[1];
    }
    return $this->aspectratio;
  }

 #----------------------------------------------------------[ Movie Rating ]---
  /** Setup votes
   * @method protected rate_vote
   */
  protected function rate_vote() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match('!<span itemprop="ratingValue">(\d{1,2}\.\d)!i',$this->page["Title"],$match)){
      $this->main_rating = $match[1];
    } else {
      $this->main_rating = 0;
    }
    if (preg_match('!<span itemprop="ratingCount">([\d\.,]+)</span!i',$this->page["Title"],$match)){
        $this->main_votes = $match[1];
    }else{
        $this->main_votes = 0;
    }
  }

  /** Get movie rating
   * @method rating
   * @return string rating current rating as given by IMDB site
   * @see IMDB page / (TitlePage)
   */
  public function rating () {
    if ($this->main_rating == -1) $this->rate_vote();
    return $this->main_rating;
  }

  /** Return votes for this movie
   * @method votes
   * @return string votes count of votes for this movie
   * @see IMDB page / (TitlePage)
   */
  public function votes() {
    if ($this->main_votes == -1) $this->rate_vote();
    return $this->main_votes;
  }

 #------------------------------------------------------[ Movie Comment(s) ]---
  /** Get movie main comment (from title page)
   * @method comment
   * @return string comment full text of movie comment from the movies main page
   * @see IMDB page / (TitlePage)
   */
  public function comment() {
    // this stuff whent into a frame in 2011! _ajax/iframe?component=footer
    if ($this->main_comment == "") {
      if ($this->page["Title"]=="") $this->openpage ("Title");
      if (@preg_match('!<div class\="user-comments">\s*(.*?)\s*<hr\s*/>\s*<div class\="yn"!ms',$this->page["Title"],$match))
        $this->main_comment = preg_replace("/a href\=\"\//i","a href=\"http://".$this->imdbsite."/",$match[1]);
        $this->main_comment = str_replace("http://i.media-imdb.com/images/showtimes",$this->imdb_img_url."/showtimes",$this->main_comment);
    }
    return $this->main_comment;
  }

  /** Get movie main comment (from title page - split-up variant)
   * @method comment_split
   * @return array comment array[string title, string date, array author, string comment]; author: array[string url, string name]
   * @see IMDB page / (TitlePage)
   */
  public function comment_split() {
    if (empty($this->split_comment)) {
      if ($this->main_comment == "") $comm = $this->comment();
      if (@preg_match('!<strong[^>]*>(.*?)</strong>.*?<div class="comment-meta">\s*(.*?)\s*\|\s*by\s*(.*?</a>).*?(<p[^>]*>.*?)\s*</div!ims',$this->main_comment,$match)) {
        @preg_match('!href="(.*?)">(.*)</a!i',$match[3],$author);
        $this->split_comment = array("title"=>$match[1],"date"=>$match[2],"author"=>array("url"=>$author[1],"name"=>$author[2]),"comment"=>trim($match[4]));
      } elseif (@preg_match('!<div class="comment-meta">\s*<meta itemprop="datePublished" content=".+?">\s*(.{10,20})\s*\|\s*by\s*(.*?)\s*&ndash;.*?<div>\s*(.*?)\s*</div>!ims',$this->main_comment,$match)) {
        @preg_match('!href="(.*?)">(.*)</a!i',$match[2],$author);
        $this->split_comment = array('title'=>'','date'=>$match[1],'author'=>array("url"=>$author[1],"name"=>$author[2]),"comment"=>trim($match[3]));
      }
    }
    return $this->split_comment;
  }

 #-------------------------------------------------------[ Recommendations ]---
  /** Get recommended movies (People who liked this...also liked)
   * @method movie_recommendations
   * @return array recommendations (array[title,imdbid,year])
   * @see IMDB page / (TitlePage)
   */
  public function movie_recommendations() {
    if (empty($this->movierecommendations)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if ( $this->page["Title"] == "cannot open page" ) return $this->movierecommendations; // no such page
      $doc = new DOMDocument();
      @$doc->loadHTML($this->page["Title"]);
      $xp = new DOMXPath($doc);
      $posters = array();
      $cells = $xp->query("//div[@id=\"title_recs\"]/div[@class=\"rec_overviews\"]/div[@class=\"rec_overview\"]/div[@class=\"rec_details\"]");
      foreach ($cells as $cell) {
        preg_match('!tt(\d+)!',$cell->getElementsByTagName('a')->item(0)->getAttribute('href'),$ref);
        $movie['title'] = trim($cell->getElementsByTagName('a')->item(0)->nodeValue);
        $movie['imdbid'] = $ref[1];
        preg_match('!(\d+)!',$cell->getElementsByTagName('span')->item(0)->nodeValue,$ref);
        $movie['year'] = $ref[1];
        $this->movierecommendations[] = $movie;
      }
    }
    return $this->movierecommendations;
  }

 #--------------------------------------------------------------[ Keywords ]---
  /** Get the keywords for the movie
   * @method keywords
   * @return array keywords
   * @see IMDB page / (TitlePage)
   */
  public function keywords() {
    if (empty($this->main_keywords)) {
      if ($this->page["Title"] == "") $this->openpage("Title");
      if (preg_match_all('!href="/keyword/.+?"\s*>\s*(.*?)\s*</a>!',$this->page["Title"],$matches))
        $this->main_keywords = $matches[1];
    }
    return $this->main_keywords;
  }

 #--------------------------------------------------------[ Language Stuff ]---
  /** Get movies original language
   * @method language
   * @return string language
   * @brief There is not really a main language on the IMDB sites (yet), so this
   *  simply returns the first one
   * @see IMDB page / (TitlePage)
   */
  public function language() {
   if ($this->main_language == "") {
     if (empty($this->langs)) $this->langs = $this->languages();
     $this->main_language = $this->langs[0];
   }
   return $this->main_language;
  }

  /** Get all languages this movie is available in
   * @method languages
   * @return array languages (array[0..n] of strings)
   * @see IMDB page / (TitlePage)
   */
  public function languages() {
   if (empty($this->langs)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all('!href="/language/(.*?)"[^>]*>\s*(.*?)\s*</a>(\s+\((.*?)\)|)!m',$this->page["Title"],$matches)) {
      $this->langs = $matches[2];
      $mc = count($matches[2]);
      for ($i=0;$i<$mc;$i++) {
        $this->langs_full[] = array('name'=>$matches[2][$i],'code'=>$matches[1][$i],'comment'=>$matches[4][$i]);
      }
    }
   }
   return $this->langs;
  }

  /** Get all languages this movie is available in, including details
   * @method languages_detailed
   * @return array languages (array[0..n] of array[string name, string code, string comment], code being the ISO-Code)
   * @see IMDB page / (TitlePage)
   */
  public function languages_detailed() {
    if (empty($this->langs_full)) $foo = $this->languages();
    return $this->langs_full;
  }


 #--------------------------------------------------------------[ Genre(s) ]---
  /** Get the movies main genre
   *  Since IMDB.COM does not really now a "Main Genre", this simply means the
   *  first mentioned genre will be returned.
   * @method genre
   * @return string genre first of the genres listed on the movies main page
   * @brief There is not really a main genre on the IMDB sites (yet), so this
   *  simply returns the first one
   * @see IMDB page / (TitlePage)
   */
  public function genre() {
   if (empty($this->main_genre)) {
    if (empty($this->moviegenres)) $genres = $this->genres();
    if (!empty($genres)) $this->main_genre = $this->moviegenres[0];
   }
   return $this->main_genre;
  }

  /** Get all genres the movie is registered for
   * @method genres
   * @return array genres (array[0..n] of strings)
   * @see IMDB page / (TitlePage)
   */
  public function genres() {
    if (empty($this->moviegenres)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (preg_match_all('!<a href="/genre/[^?][^>]+?>(.*?)\</a>!',$this->page["Title"],$matches)) {
        $this->moviegenres = $matches[1];
      } elseif (preg_match('!<div class="infobar">(.*?)</div>!ims',$this->page['Title'],$match)) {
        if (preg_match_all('!href="/genre/.*?"\s*>(.*?)<!ims',$match[1],$matches)) {
          $this->moviegenres = $matches[1];
        }
      }
    }
    foreach ($this->moviegenres as $i => $val) {
      $this->moviegenres[$i] = trim(strip_tags($this->moviegenres[$i]));
    }
    $this->moviegenres = array_merge(array_unique($this->moviegenres));
    return $this->moviegenres;
  }

 #----------------------------------------------------------[ Color format ]---
  /** Get colors
   * @method colors
   * @return array colors (array[0..1] of strings)
   * @see IMDB page / (TitlePage)
   */
  public function colors() {
    if (empty($this->moviecolors)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (preg_match_all("|/search/title\?colors=.*?>\s*(.*?)<|",$this->page["Title"],$matches))
        $this->moviecolors = $matches[1];
    }
    return $this->moviecolors;
  }

 #---------------------------------------------------------------[ Creator ]---
  /** Get the creator of a movie (most likely for seasons only)
   * @method creator
   * @return array creator (array[0..n] of array[name,imdb])
   * @see IMDB page / (TitlePage)
   */
  public function creator() {
    if (empty($this->main_creator)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match("/Creator:\<\/h5\>\s*\n(.*?)(<\/div|<a class=\"tn15more)/ms",$this->page["Title"],$match)) {
        if ( preg_match_all('|/name/nm(\d{7}).*?>(.*?)<|ims',$match[1],$matches) ) {
          for ($i=0;$i<count($matches[0]);++$i)
          $this->main_creator[] = array('name'=>$matches[2][$i],'imdb'=>$matches[1][$i]);
        }
      }
    }
    return $this->main_creator;
  }

 #---------------------------------------------------------------[ Tagline ]---
  /** Get the main tagline for the movie
   * @method tagline
   * @return string tagline
   * @see IMDB page / (TitlePage)
   */
  public function tagline() {
    if ($this->main_tagline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match('!Taglines:</h4>\s*(.*?)\s*<!ims',$this->page["Title"],$match)) {
        $this->main_tagline = trim($match[1]);
      }
    }
    return $this->main_tagline;
  }

 #---------------------------------------------------------------[ Seasons ]---
  /** Get the number of seasons or 0 if not a series
   * @method seasons
   * @return int seasons number of seasons
   * @see IMDB page / (TitlePage)
   */
  public function seasons() {
    if ( $this->seasoncount == -1 ) {
      if ( $this->page["Title"] == "" ) $this->openpage("Title");
      if ( preg_match_all('|href="/title/tt\d{7}/episodes\?season=\d+.*?"\s*>(\d+)</a>|Ui',$this->page["Title"],$matches) ) {
        $this->seasoncount = $matches[1][0];
      } else {
        $this->seasoncount = 0;
      }
      if ( preg_match_all('|href="/title/tt\d{7}/episodes\?season\=unknown"\s*>unknown</a>|Ui',$this->page["Title"],$matches) ) {
        $this->seasoncount += count($matches[0]);
      }
    }
    return $this->seasoncount;
  }

 #-----------------------------------------------[ Is it part of a serial? ]---
  /** Try to figure out if this is a movie or a serie
   * @method is_serial
   * @return boolean
   * @see IMDB page / (TitlePage)
   */
  public function is_serial() {
    if ( $this->page["Title"] == "" ) $this->openpage("Title");
    preg_match('|href="/title/tt\d{7}/episodes\?|i',$this->page["Title"],$matches);
    return preg_match('|href="/title/tt\d{7}/episodes\?|i',$this->page["Title"],$matches);
  }

 #------------------------------------[ Provide "Uplink" info for episodes ]---
  /** If it is an episode, we may want to now to know where it belongs to
   * @method get_episode_details
   * @return array [imdbid,seriestitle,series_prodtime,episodetitle,season,episode]
   * @see IMDB page / (TitlePage)
   * @brief based on an idea of lennert, see ticket:263
   * @version series_prodtime is no longer available due to IMDB site changes, see ticket:281
   */
  public function get_episode_details() {
    if (!$this->is_serial()) return array(); // not an episode
    if ($this->page["Title"] == "") $this->openpage("Title");
    $preg = '!<h2 class="tv_header">\s*<a\s+href="/title/tt(?<seriesimdbid>\d{7})/.*?"\s*>\s*(?<seriestitle>.+?)</a>:\s*'
          . '<span class="nobr">\s*Season\s+(?<season>\d+),\s+Episode\s+(?<episode>\d+)\s*</span>\s*'
          . '</h2>\s*<h1 class="header">\s*'
          . '(?<episodetitle>.+?)\s*<span class="nobr">\s*\((?<airdate>.+?)\)\s*</span>!ims';
    if ( preg_match($preg, $this->page["Title"], $match) ) {
      $info = array("imdbid"=>$match['seriesimdbid'], "seriestitle"=>$match['seriestitle'], "series_prodtime"=>'', "episodetitle"=>strip_tags($match['episodetitle']),
                    "season"=>$match['season'], "episode"=>$match['episode'], "airdate"=>$match['airdate']);
      return $info;
    } else {
      return array(); // no success
    }
  }

 #--------------------------------------------------------[ Plot (Outline) ]---
  /** Get the main Plot outline for the movie
   * @method plotoutline
   * @param optional boolean fallback Fallback to storyline if we could not catch plotoutline? Default: FALSE
   * @return string plotoutline
   * @see IMDB page / (TitlePage)
   */
  public function plotoutline($fallback=FALSE) {
    if ($this->main_plotoutline == "") {
      if ($this->page["Title"] == "") $this->openpage("Title");
      if (preg_match('!<span class="rating-rating">.*?<p itemprop="description">\s*(.*?)\s*</p>!ims',$this->page['Title'],$match)) {
        $this->main_plotoutline = trim($match[1]);
      } elseif (preg_match('!<span class="rating-rating">.*?(<p>.*?)\s*<div!ims',$this->page['Title'],$match)) {
        $this->main_plotoutline = trim($match[1]);
      } elseif (preg_match('!<p itemprop="description">\s*(.*?)\s*</p>!ims',$this->page['Title'],$match)) {
        $this->main_plotoutline = trim($match[1]);
      } elseif($fallback) {
        $this->main_plotoutline = $this->storyline();
      }
      if ( preg_match('!<p>\s*(<p>.*</p>)\s*$!ims',$this->main_plotoutline,$tmp) ) $this->main_plotoutline = $tmp[1];
    }
    $this->main_plotoutline = preg_replace('!\s*<a href="/title/tt\d{7}/plotsummary[^>]*>See full summary.*$!i','',$this->main_plotoutline);
    return $this->main_plotoutline;
  }

  /** Get the Storyline for the movie
   * @method storyline
   * @return string storyline
   * @see IMDB page / (TitlePage)
   */
  public function storyline() {
    if ($this->main_storyline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match('!Storyline</h2>\s*\n*<div.*?>\s*\n*<?p?>?(.*?)<?/?p?<h4!ims',$this->page["Title"],$match)) {
        if (preg_match('!(.*?)<em class="nobr">Written by!ims',$match[1],$det))
          $this->main_storyline = $det[1];
        elseif (preg_match('!(.*)\s</p>!ims',$match[1],$det))
          $this->main_storyline = $det[1];
        elseif (preg_match('!(.*)\s<span class="see-more inline">!ims',$match[1],$det))
          $this->main_storyline = $det[1];
        elseif (preg_match('!(.*)\s\|!ims',$match[1],$det))
          $this->main_storyline = $det[1];
        else $this->main_storyine = trim($match[1]);
      }
    }
    return $this->main_storyline;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Setup cover photo (thumbnail and big variant)
   * @method protected thumbphoto
   * @return boolean success (TRUE if found, FALSE otherwise)
   * @see IMDB page / (TitlePage)
   */
  protected function thumbphoto() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    preg_match('!id="img_primary">.*?<img [^>]+src="(.+?)".*(<td id="overview-top)?"!ims',$this->page["Title"],$match);
    if (empty($match[1])) return FALSE;
    $this->main_thumb = $match[1];
    if ( preg_match('|(.*\._V1).*|iUs',$match[1],$mo) ) {
      $this->main_photo = $mo[1];
      return true;
    }
    else return FALSE;
  }


  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return mixed photo (string url if found, FALSE otherwise)
   * @see IMDB page / (TitlePage)
   */
  public function photo($thumb=true) {
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
   * @see IMDB page / (TitlePage)
   */
  public function savephoto($path,$thumb=true,$rerun=0) {
    switch ($rerun) {
      case 2:  $req = new MDB_Request(''); break;
      case 1:  $req = new MDB_Request('','',!$this->trigger_referer); break;
      default: $req = new MDB_Request('','',$this->trigger_referer); break;
    }
    $photo_url = $this->photo ($thumb);
    if (!$photo_url) return FALSE;
    $req->setURL($photo_url);
    $req->sendRequest();
    if (strpos($req->getResponseHeader("Content-Type"),'image/jpeg') === 0
      || strpos($req->getResponseHeader("Content-Type"),'image/gif') === 0
      || strpos($req->getResponseHeader("Content-Type"), 'image/bmp') === 0 ){
        $fp = $req->getResponseBody();
    } else {
        switch ($rerun) {
          case 2 :
            $ctype = $req->getResponseHeader("Content-Type");
            $this->debug_scalar("<BR>*photoerror* at ".__FILE__." line ".__LINE__. ": ".$photo_url.": Content Type is '$ctype'<BR>");
            if (substr($ctype,0,4)=='text') $this->debug_scalar("Details: <PRE>". $req->getResponseBody() ."</PRE>\n");
            return FALSE;
            break;
          case 1 :
            $this->debug_scalar("<BR>Initiate third run for savephoto($path) on IMDBID ".$this->imdbID."<BR>");
            unset($req);
            return $this->savephoto($path,$thumb,2);
            break;
          default:
            $this->debug_scalar("<BR>Initiate second run for savephoto($path) on IMDBID ".$this->imdbID."<BR>");
            unset($req);
            return $this->savephoto($path,$thumb,1);
            break;
        }
    }
    $fp2 = fopen ($path, "w");
    if ((!$fp) || (!$fp2)){
      $this->debug_scalar("image error at ".__FILE__." line ".__LINE__."...<BR>");
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
   * @see IMDB page / (TitlePage)
   */
  public function photo_localurl($thumb=true){
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

  /** Get URLs for the pictures on the main page
   * @method mainPictures
   * @return array [0..n] of [imgsrc, imglink, bigsrc], where<UL>
   *    <LI>imgsrc is the URL of the thumbnail IMG as displayed on main page</LI>
   *    <LI>imglink is the link to the <b><i>page</i></b> with the "big image"</LI>
   *    <LI>bigsrc is the URL of the "big size" image itself</LI>
   * @author moonface
   * @author izzy
   */
  public function mainPictures() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (empty($this->main_pictures)) {
      preg_match('!<div class="mediastrip">\s*(.*?)\s*</div>!ims',$this->page["Title"],$match);
      if (@preg_match_all('!<a .*?href="(?<href>.*?)".*?<img.*?src="(.*?)".*?loadlate="(?<imgsrc>.*?)"!ims',$match[1],$matches)) {
        for ($i=0;$i<count($matches[0]);++$i) {
          $this->main_pictures[$i]["imgsrc"] = $matches['imgsrc'][$i];
          if (substr($matches['href'][$i],0,4)!="http") $matches['href'][$i] = "http://".$this->imdbsite.$matches[1][$i];
          $this->main_pictures[$i]["imglink"] = $matches['href'][$i];
          preg_match('|(.*\._V1).*|iUs',$matches['imgsrc'][$i],$big);
          $ext = substr($matches[2][$i],-3);
          $this->main_pictures[$i]["bigsrc"] = $big[1].".${ext}";
/*          // Get bigsrc from linked photo page. (proposed by ticket:327 -- seems to result in the same as above, so keeping it just-in-case)
          //preg_match('!<div id="photo-container".*?>\s*(.*?)\s*</div>!ims',$this->getWebPage("Bigsrc", $matches[1][$i]),$match2);
          //if (@preg_match_all('!<img.*?id="primary-img".*?src="(.*?)".*?!ims',$match2[1],$matches2)) {
          //  $this->main_pictures[$i]["bigsrc"] = $matches2[1][0];
          //} */
        }
      }
    }
    return $this->main_pictures;
  }

 #-------------------------------------------------[ Country of Production ]---
  /** Get country of production
   * @method country
   * @return array country (array[0..n] of string)
   * @see IMDB page / (TitlePage)
   */
  public function country() {
   if (empty($this->countries)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->countries = array();
    if (preg_match_all('!/country/.+?>(.*?)<\/a!m',$this->page["Title"],$matches))
      for ($i=0;$i<count($matches[0]);++$i) $this->countries[$i] = $matches[1][$i];
   }
   return $this->countries;
  }


 #------------------------------------------------------------[ Movie AKAs ]---
  /** Get movies alternative names
   * @method alsoknow
   * @return array aka array[0..n] of array[title,year,country,comment]; searching
   *         on akas.imdb.com will add "lang" (2-char language code) to the array
   *         for localized names, "country" may hold multiple countries separated
   *         by commas
   * @see IMDB page ReleaseInfo
   * @version Due to changes on the IMDB sites, neither the languages nor the year
   *          seems to be available anymore - so those array properties will always
   *          be empty, and kept for compatibility only (for a while, at least).
   *          Moreover, content has been moved from the title page to ReleaseInfo page.
   */
  public function alsoknow() {
   if (empty($this->akas)) {
    if ($this->page["ReleaseInfo"] == "") $this->openpage ("ReleaseInfo");
    $ak_s = strpos ($this->page["ReleaseInfo"], "<a id=\"akas\"");
    //if ($ak_s == 0) $ak_s = strpos ($this->page["ReleaseInfo"], "Alternativ:");
    if ($ak_s == 0) return array();
    $alsoknow_end = strpos ($this->page["ReleaseInfo"], "</table>", $ak_s);
    $alsoknow_all = substr($this->page["ReleaseInfo"], $ak_s, $alsoknow_end - $ak_s);
    preg_match_all("@<td>(.*?)</td>@i", $alsoknow_all, $matches);
    for($i=0;$i<count($matches[1]);$i+=2){
        $country = trim($matches[1][$i]);
        $titles = explode('/',$matches[1][$i+1]);
        foreach($titles as $tit){
            $firstbracket = strpos($tit, '(');
            if($firstbracket === false){
                $title = trim($tit);
                $comment = '';
            }else{
                $title = trim(substr($tit, 0, $firstbracket));
                preg_match_all("@\((.+?)\)@", $tit, $matches3);
                $comment = implode(', ', $matches3[1]);
            }
            $this->akas[] = array(
                "title"=>$title,
                "year"=>'',
                "country"=>$country,
                "comment"=>$comment,
                "lang"=>''
            );
        }
    }
   }
   return $this->akas;
  }


 #---------------------------------------------------------[ Sound formats ]---
  /** Get sound formats
   * @method sound
   * @return array sound (array[0..n] of strings)
   * @see IMDB page / (TitlePage)
   */
  public function sound() {
   if (empty($this->sound)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (preg_match_all("|/search/title\?sound_mixes=.*?>\s*(.*?)<|",$this->page["Title"],$matches))
      $this->sound = $matches[1];
   }
   return $this->sound;
  }

 #-------------------------------------------------------[ MPAA / PG / FSK ]---
  /** Get the MPAA data (also known as PG or FSK)
   * @method mpaa
   * @return array mpaa (array[country]=rating)
   * @see IMDB page / (TitlePage)
   */
  public function mpaa() {
   if (empty($this->mpaas)) {
    if ($this->page["ParentalGuide"] == "") $this->openpage("ParentalGuide");
    if (preg_match_all("|/search/title\?certificates=.*?>\s*(.*?):(.*?)<|",$this->page["ParentalGuide"],$matches)) {
      $cc = count($matches[0]);
      for ($i=0;$i<$cc;++$i) $this->mpaas[$matches[1][$i]] = $matches[2][$i];
    }
   }
   return $this->mpaas;
  }

  /** Get the MPAA data (also known as PG or FSK) - including historical data
   * @method mpaa_hist
   * @return array mpaa (array[country][0..n]=rating)
   * @see IMDB page / (TitlePage)
   */
  public function mpaa_hist() {
   if (empty($this->mpaas_hist)) {
    if ($this->page["ParentalGuide"] == "") $this->openpage("ParentalGuide");
    if (preg_match_all("|/search/title\?certificates=.*?>\s*(.*?):(.*?)<|",$this->page["ParentalGuide"],$matches)) {
      $cc = count($matches[0]);
      for ($i=0;$i<$cc;++$i) $this->mpaas_hist[$matches[1][$i]][] = $matches[2][$i];
    }
   }
   return $this->mpaas_hist;
  }

 #----------------------------------------------------[ MPAA justification ]---
  /** Find out the reason for the MPAA rating
   * @method mpaa_reason
   * @return string reason why the movie was rated such
   * @see IMDB page / (TitlePage)
   */
  public function mpaa_reason() {
   if (empty($this->mpaa_justification)) {
    if ($this->page["ParentalGuide"] == "") $this->openpage("ParentalGuide");
    if (preg_match('!href="/mpaa"\s*>.*?</h5>\s*<div class="info-content">\s*(.*?)\s*</div!ims',$this->page["ParentalGuide"],$match))
      $this->mpaa_justification = trim($match[1]);
   }
   return $this->mpaa_justification;
  }

 #------------------------------------------------------[ Production Notes ]---
  /** For not-yet completed movies, we can get the production state
   * @method prodNotes
   * @return array production notes [status,statnote,lastupdate[day,month,mon,year],more,note]
   * @see IMDB page / (TitlePage)
   */
  public function prodNotes() {
   if (empty($this->main_prodnotes)) {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if (!preg_match('!(<h2>Production Notes.*?)\s*</div!ims',$this->page["Title"],$match)) return $this->main_prodnotes; // no info available
    if ( preg_match('!<b>Status:\s*</b>\s*(.*?)\s*<br!ims',$match[1],$tmp) )
      if ( preg_match('!(.*?)\s*<span class="ghost">\|</span>\s*(.*)!ims',$tmp[1],$tmp2) ) {
        $status = trim($tmp2[1]); $statnote = trim($tmp2[2]);
      } else {
        $status = trim($tmp); $statnote = '';
      }
    if ( preg_match('!<b>Updated:\s*</b>\s*(\d+)\s*(\D+)\s+(\d{4})!ims',$match[1],$tmp) )
        $update = array("day"=>$tmp[1],"month"=>$tmp[2],"mon"=>$this->monthNo($tmp[2]),"year"=>$tmp[3]);
    if ( preg_match('!<b>More Info:\s*</b>\s*(.*)!ims',$match[1],$tmp) )
        $more = preg_replace('!\s*onclick=".*?"!ims','',trim($tmp[1]));
        $more = preg_replace('!href="/!ims','href="http://'.$this->imdbsite.'/',$more);
    if ( preg_match('!<b>Note:\s*</b>\s*(.*?)</!ims',$match[1],$tmp) )
        $note = trim($tmp[1]);
    $this->main_prodnotes = array("status"=>$status,"statnote"=>$statnote,"lastUpdate"=>$update,"more"=>$more,"note"=>$note);
   }
   return $this->main_prodnotes;
  }

 #----------------------------------------------[ Position in the "Top250" ]---
  /** Find the position of a movie in the top 250 ranked movies
   * @method top250
   * @return int position a number between 1..250 if the movie is listed, 0 otherwise
   * @author abe
   * @see http://projects.izzysoft.de/trac/imdbphp/ticket/117
   */
  public function top250() {
    if ($this->main_top250 == -1) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      if (@preg_match('!<a href="[^"]*/chart/top\?tt(.*?)"><strong>Top 250 #(.*?)</a>!i',$this->page["Title"],$match)) {
        $this->main_top250 = $match[2];
      } else {
        $this->main_top250 = 0;
      }
    }
    return $this->main_top250;
  }


 #=====================================================[ /plotsummary page ]===
 #--------------------------------------------------[ Full Plot (combined) ]---
  /** Get the movies plot(s)
   * @method plot
   * @return array plot (array[0..n] of strings)
   * @see IMDB page /plotsummary
   */
  public function plot() {
   if (empty($this->plot_plot)) {
    if ( $this->page["Plot"] == "" ) $this->openpage ("Plot");
    if ( $this->page["Plot"] == "cannot open page" ) return array(); // no such page
    if (preg_match('!<div class="desc"[^>]*>(.+?)<h4!ims',$this->page["Plot"],$block)) {
      if (preg_match_all('!<li\s+class="(odd|even)[^"]*"\s*>(.+?)</li>!ims',$block[0],$matches)) {
        for ($i=0;$i<count($matches[0]);++$i) {
          $this->plot_plot[$i] = preg_replace('!<a href="/search/title!i','<a href="http://'.$this->imdbsite.'/search/title',$matches[2][$i]);
        }
      }
    }
   }
   return $this->plot_plot;
  }

 #-----------------------------------------------------[ Full Plot (split) ]---
  /** Get the movie plot(s) - split-up variant
   * @method plot_split
   * @return array array[0..n] of array[string plot,array author] - where author consists of string name and string url
   * @see IMDB page /plotsummary
   */
  public function plot_split() {
    if (empty($this->split_plot)) {
      if (empty($this->plot_plot)) $plots = $this->plot();
      for ($i=0;$i<count($this->plot_plot);++$i) {
        if (preg_match("/(.*?)<i>.*<a href=\"(.*?)\">(.*?)<\/a>/",$this->plot_plot[$i],$match))
          $this->split_plot[] = array("plot"=>$match[1],"author"=>array("name"=>$match[3],"url"=>$match[2]));
      }
    }
    return $this->split_plot;
  }

 #========================================================[ /synopsis page ]===
 #---------------------------------------------------------[ Full Synopsis ]---
  /** Get the movies synopsis
   * @method synopsis
   * @return string synopsis
   * @see IMDB page /synopsis
   */
  public function synopsis() {
    if (empty($this->synopsis_wiki)) {
    if ( $this->page["Synopsis"] == "" ) $this->openpage ("Synopsis");
    if ( $this->page["Synopsis"] == "cannot open page" ) return $this->synopsis_wiki; // no such page
    if (preg_match('|<div id="swiki\.2\.1">(.*?)</div>|ims',$this->page["Synopsis"],$match))
      $this->synopsis_wiki = trim($match[1]);
    }
    return $this->synopsis_wiki;
  }

 #========================================================[ /taglines page ]===
 #--------------------------------------------------------[ Taglines Array ]---
  /** Get all available taglines for the movie
   * @method taglines
   * @return array taglines (array[0..n] of strings)
   * @see IMDB page /taglines
   */
  public function taglines() {
   if (empty($this->taglines)) {
    if ( $this->page["Taglines"] == "" ) $this->openpage ("Taglines");
    if ( $this->page["Taglines"] == "cannot open page" ) return array(); // no such page
    if (preg_match_all('!<div class="soda[^>]+>\s*(.*)\s*</div!U',$this->page["Taglines"],$matches))
      $this->taglines = $matches[1];
   }
   return $this->taglines;
  }

 #=====================================================[ /fullcredits page ]===
 #-----------------------------------------------------[ Helper: TableRows ]---
  /** Get rows for a given table on the page
   * @method protected get_table_rows
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the methods director, cast, writing, producer, composer
   */
  protected function get_table_rows( $html, $table_start ) {
   if ($table_start=="Writing Credits") $row_s = strpos ( $html, ">".$table_start);
   else $row_s = strpos ( $html, ">".$table_start."&nbsp;<");
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
   $block = substr($html,$row_s,$endtable - $row_s);
   if (preg_match_all('!<tr>(.+?)</tr>!ims',$block,$matches)) {
     $mc = count($matches[1]);
     /* for ($i=0;$i<$mc;++$i) if ( strncmp( trim($matches[1][$i]), "<td valign=",10) == 0 ) $rows[] = $matches[1][$i]; */
     $rows = $matches[1];
   }
   return $rows;
  }

 #------------------------------------------------[ Helper: Cast TableRows ]---
  /** Get rows for the cast table on the page
   * @method protected get_table_rows_cast
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the method cast
   */
  protected function get_table_rows_cast( $html, $table_start, $class="nm" ) {
   $row_s = strpos ( $html, '<table class="cast_list">');
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
   $block = substr($html,$row_s,$endtable - $row_s);
   if (preg_match_all('!<tr.*?>(.*?)</tr>!ims',$block,$matches)) {
     return $matches[1];
   }
   return array();
  }

 #------------------------------------------------[ Helper: Awards TableRows ]---
  /** Get rows for the awards table on the page
   * @method protected get_table_rows_awards
   * @param string html
   * @param string table_start
   * @return mixed rows (FALSE if table not found, array[0..n] of strings otherwise)
   * @see used by the method awards
   * @author Qvist
   */
  protected function get_table_rows_awards( $html ) {
   $row_s = strpos ( $html, '<table style="margin-top:' );
   $row_e = $row_s;
   if ( $row_s == 0 )  return FALSE;
   $endtable = strpos($html, "</table>", $row_s);
   $table_string = substr($html,$row_s,$endtable - $row_s);
   if (preg_match_all("/<tr>(.*?)<\/tr>/ims",$table_string,$matches)) {
     return $matches[1];
   }
   return $rows;
  }

 #------------------------------------------------------[ Helper: RowCells ]---
  /** Get content of table row cells
   * @method protected get_row_cels
   * @param string row (as returned by imdb::get_table_rows)
   * @return array cells (array[0..n] of strings)
   * @see used by the methods director, cast, writing, producer, composer
   */
  protected function get_row_cels( $row ) {
   if (preg_match_all("/<td.*?>(.*?)<\/td>/ims",$row,$matches)) return $matches[1];
   return array();
  }

 #-------------------------------------------[ Helper: Get IMDBID from URL ]---
  /** Get the IMDB ID from a names URL
   * @method protected get_imdbname
   * @param string href url to the staff members IMDB page
   * @return string IMDBID of the staff member
   * @see used by the methods director, cast, writing, producer, composer
   */
  protected function get_imdbname($href) {
   return preg_replace('!^.*(\d{7}).*$!ims','$1',$href);
   if ( strlen( $href) == 0) return $href;
   $name_s = 17;
   $name_e = strpos ( $href, '"', $name_s);
   if ( $name_e != 0) return substr( $href, $name_s, $name_e -1 - $name_s);
   else	return $href;
  }

 #-------------------------------------------------------------[ Directors ]---
  /** Get the director(s) of the movie
   * @method director
   * @return array director (array[0..n] of arrays[imdb,name,role])
   * @see IMDB page /fullcredits
   */
  public function director() {
   if (empty($this->credits_director)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $director_rows = $this->get_table_rows($this->page["Credits"], "Directed by");
   if($director_rows==null) $director_rows = $this->get_table_rows($this->page["Credits"], "Series Directed by");
   for ( $i = 0; $i < count ($director_rows); $i++){
    $cels = $this->get_row_cels ($director_rows[$i]);
    if (!isset ($cels[0])) return array();
    $dir = array();
    $dir["imdb"] = $this->get_imdbname($cels[0]);
    $dir["name"] = trim(strip_tags($cels[0]));
    if (isset($cels[2])) $role = trim(strip_tags($cels[2]));
    else $role = "";
    if ( $role == "") $dir["role"] = NULL;
    else $dir["role"] = $role;
    $this->credits_director[$i] = $dir;
   }
   return $this->credits_director;
  }

 #----------------------------------------------------------------[ Actors ]---
  /** Get the actors
   * @method cast
   * @return array cast (array[0..n] of arrays[imdb,name,role,thumb,photo])
   * @see IMDB page /fullcredits
   */
  public function cast() {
   if (empty($this->credits_cast)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $cast_rows = $this->get_table_rows_cast($this->page["Credits"], "Cast", "itemprop");
   for ( $i = 0; $i < count ($cast_rows); $i++){
    $cels = $this->get_row_cels ($cast_rows[$i]);
    if (!isset ($cels[1])) continue;
    $dir = array();
    $dir["imdb"] = preg_replace('!.*href="/name/nm(\d{7})/.*!ims','$1',$cels[1]);
    $dir["name"] = trim(strip_tags($cels[1]));
    if (empty($dir['name'])) continue;
    if (isset($cels[3])) $role = trim(strip_tags($cels[3]));
    else $role = "";
    if ( $role == "") $dir["role"] = NULL;
    else $dir["role"] = $role;
    if (preg_match('!.*<img [^>]*loadlate="([^"]+)".*!ims',$cels[0],$match)) {
      $dir["thumb"] = $match[1];
      if (strpos($dir["thumb"],'._V1'))
        $dir["photo"] = preg_replace('|(.*._V1)\..+\.(.*)|is','$1.$2',$dir["thumb"]);
    } else {
      $dir["thumb"] = $dir["photo"] = "";
    }
    $this->credits_cast[] = $dir;
   }
   return $this->credits_cast;
  }


 #---------------------------------------------------------------[ Writers ]---
  /** Get the writer(s)
   * @method writing
   * @return array writers (array[0..n] of arrays[imdb,name,role])
   * @see IMDB page /fullcredits
   */
  public function writing() {
   if (empty($this->credits_writing)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_writing = array();
   $writing_rows = $this->get_table_rows($this->page["Credits"], "Writing Credits");
   for ( $i = 0; $i < count ($writing_rows); $i++){
     $wrt = array();
     if ( preg_match('!<a\s+href="/name/nm(\d{7})/[^>]*>\s*(.+)\s*</a>!ims',$writing_rows[$i],$match) ) {
       $wrt['imdb'] = $match[1];
       $wrt['name'] = trim($match[2]);
     } elseif ( preg_match('!<td\s+class="name">(.+?)</td!ims',$writing_rows[$i],$match) ) {
       $wrt['imdb'] = '';
       $wrt['name'] = trim($match[1]);
     } else continue;
     if ( preg_match('!<td\s+class="credit"\s*>\s*(.+?)\s*</td>!ims',$writing_rows[$i],$match) ) {
       $wrt['role'] = trim($match[1]);
     } else $wrt['role'] = NULL;
     $this->credits_writing[] = $wrt;
   }
   return $this->credits_writing;
  }

 #-------------------------------------------------------------[ Producers ]---
  /** Obtain the producer(s)
   * @method producer
   * @return array producer (array[0..n] of arrays[imdb,name,role])
   * @see IMDB page /fullcredits
   */
  public function producer() {
   if (empty($this->credits_producer)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_producer = array();
   $producer_rows = $this->get_table_rows($this->page["Credits"], "Produced by");
   for ( $i = 0; $i < count ($producer_rows); $i++){
    $cels = $this->get_row_cels ($producer_rows[$i]);
    if ( count ( $cels) > 2){
     $wrt = array();
     $wrt["imdb"] = $this->get_imdbname($cels[0]);
     $wrt["name"] = trim(strip_tags($cels[0]));
     if (isset($cels[2])) $role = trim(strip_tags($cels[2]));
     else $role = "";
     if ( $role == "") $wrt["role"] = NULL;
     else $wrt["role"] = $role;
     $this->credits_producer[$i] = $wrt;
    }
   }
   return $this->credits_producer;
  }

 #-------------------------------------------------------------[ Composers ]---
  /** Obtain the composer(s) ("Original Music by...")
   * @method composer
   * @return array composer (array[0..n] of arrays[imdb,name,role])
   * @see IMDB page /fullcredits
   */
  public function composer() {
   if (empty($this->credits_composer)) {
    if ( $this->page["Credits"] == "" ) $this->openpage ("Credits");
    if ( $this->page["Credits"] == "cannot open page" ) return array(); // no such page
   }
   $this->credits_composer = array();
   $composer_rows = $this->get_table_rows($this->page["Credits"], "Music by");
   for ( $i = 0; $i < count ($composer_rows); $i++){
     if ( preg_match('!<a\s+href="/name/nm(\d{7})/[^>]*>\s*(.+)\s*</a>!ims',$composer_rows[$i],$match) ) {
       $wrt['imdb'] = $match[1];
       $wrt['name'] = trim($match[2]);
     } elseif ( preg_match('!<td\s+class="name">(.+?)</td!ims',$composer_rows[$i],$match) ) {
       $wrt['imdb'] = '';
       $wrt['name'] = trim($match[1]);
     } else continue;
     if ( preg_match('!<td\s+class="credit"\s*>\s*(.+?)\s*</td>!ims',$composer_rows[$i],$match) ) {
       $wrt['role'] = trim($match[1]);
     } else $wrt['role'] = NULL;
     $this->credits_composer[$i] = $wrt;
    }
    return $this->credits_composer;
  }

 #====================================================[ /crazycredits page ]===
 #----------------------------------------------------[ CrazyCredits Array ]---
  /** Get the Crazy Credits
   * @method crazy_credits
   * @return array crazy_credits (array[0..n] of string)
   * @see IMDB page /crazycredits
   */
  public function crazy_credits() {
    if (empty($this->crazy_credits)) {
      if (empty($this->page["CrazyCredits"])) $this->openpage("CrazyCredits");
      if ( $this->page["CrazyCredits"] == "cannot open page" ) return array(); // no such page
      if ( preg_match_all('!<div id="cz.+?>(.+?)</span\s*>\s*<span class="linksoda">!ims',$this->page["CrazyCredits"],$matches) ) {
        $this->crazy_credits = $matches[1];
      }
    }
    return $this->crazy_credits;
  }

 #========================================================[ /episodes page ]===
 #--------------------------------------------------------[ Episodes Array ]---
  /** Get the series episode(s)
   * @method episodes
   * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot,season,episode])
   * @see IMDB page /episodes
   * @version Attention: Starting with revision 506 (version 2.1.3), the outer array no longer starts at 0 but reflects the real season number!
   */
  public function episodes() {
    if ( !$this->is_serial() && !$this->seasons() ) return $this->season_episodes;
    if ( empty($this->season_episodes) ) {
      if ( !$this->seasons() ) {
        $ser = $this->get_episode_details();
        $tid = $this->imdbID;
        $this->imdbID = $ser['imdbid'];
      } else {
        $tid = $this->imdbID;
      }
      if ( $this->page["Episodes"] == "" ) $this->openpage("Episodes");
      if ( $this->page["Episodes"] == "cannot open page" ) return $this->season_episodes; // no such page
      if ( preg_match('!<select id="bySeason"(.*?)</select!ims',$this->page["Episodes"],$match) ) {
        preg_match_all('!<option\s+(selected="selected" |)value="(\d+)">!i',$match[1],$matches);
        for ($i=0;$i<count($matches[0]);++$i) {
          $s = $matches[2][$i];
          if ( empty($this->page["Episodes-$s"]) ) $this->openpage("Episodes-$s");
          if ( $this->page["Episodes-$s"] == "cannot open page" ) continue; // no such page
          $preg = '!<div class="info" itemprop="episodes".+?>\s*<meta itemprop="episodeNumber" content="(?<episodeNumber>\d+)"/>\s*'
                . '<div class="airdate">\s*(?<airdate>.+?)\s*</div>\s*'
                . '.+?\shref="/title/tt(?<imdbid>\d{7})/"\s+title="(?<title>.+?)"\s+itemprop="name"'
                . '.+?<div class="item_description" itemprop="description">(?<plot>.*?)</div>!ims';
          preg_match_all($preg,$this->page["Episodes-$s"],$eps);
          $ec = count($eps[0]);
          for ($ep=0;$ep<$ec;++$ep) {
            $this->season_episodes[$s][$eps['episodeNumber'][$ep]] = array ('imdbid'=>$eps['imdbid'][$ep],'title'=>trim($eps['title'][$ep]),'airdate'=>$eps['airdate'][$ep],'plot'=>trim($eps['plot'][$ep]),'season'=>$s,'episode'=>$eps['episodeNumber'][$ep]);
          }
        }
      }
      $this->imdbID = $tid;
    }
    return $this->season_episodes;
  }

 #===========================================================[ /goofs page ]===
 #-----------------------------------------------------------[ Goofs Array ]---
  /** Get the goofs
   * @method goofs
   * @return array goofs (array[0..n] of array[type,content]
   * @see IMDB page /goofs
   * @version Spoilers are currently skipped (differently formatted)
   */
  public function goofs() {
    if (empty($this->goofs)) {
      if (empty($this->page["Goofs"])) $this->openpage("Goofs");
      if ($this->page["Goofs"] == "cannot open page") return array(); // no such page
      if ( @preg_match_all('@<h4 class="li_group">(.+?)(!?&nbsp;)</h4>\s*(.+?)\s*(<h4 class="li_group">|<div id="top_rhs_wrapper")@ims',$this->page["Goofs"],$matches) ) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) {
          if ($matches[1][$i]=='Spoilers') continue; // no spoilers, moreover they are differently formatted
          preg_match_all('!<div id="gf.+?>(.+?)<div!ims',$matches[3][$i],$goofy);
          $ic = count($goofy[0]);
          for ($k=0;$k<$ic;++$k) $this->goofs[] = array("type"=>$matches[1][$i],"content"=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$goofy[1][$k]));
        }
      }
    }
    return $this->goofs;
  }


 #==========================================================[ /quotes page ]===
 #----------------------------------------------------------[ Quotes Array ]---
  /** Get the quotes for a given movie
   * @method quotes
   * @return array quotes (array[0..n] of string)
   * @see IMDB page /quotes
   */
  public function quotes() {
    if ( empty($this->moviequotes) ) {
      if ( $this->page["Quotes"] == "" ) $this->openpage("Quotes");
      if ( $this->page["Quotes"] == "cannot open page" ) return array(); // no such page
      if (preg_match_all('!class="quote soda (odd|even)"\s*><p>\s*(.*?)\s*</p>\s*<div class=!ims',str_replace("\n"," ",$this->page["Quotes"]),$matches))
        foreach ($matches[2] as $match) {
          $this->moviequotes[] = "<p>".str_replace('href="/name/','href="http://'.$this->imdbsite.'/name/',preg_replace('!<span class="linksoda".+?</span>!ims','',$match))."</p>";
        }
    }
    return $this->moviequotes;
  }


 #========================================================[ /trailers page ]===
 #--------------------------------------------------------[ Trailers Array ]---
  /** Get the trailer URLs for a given movie
   * @method trailers
   * @param optional boolean full Retrieve all available data (TRUE), or stay compatible with previous IMDBPHP versions (FALSE, Default)
   * @param optional boolean all  Fetch all trailers (including off-site ones)? Default: True
   * @return mixed trailers either array[0..n] of string ($full=FALSE), or array[0..n] of array[lang,title,url,restful_url,resolution] ($full=TRUE)
   * @author george
   * @author izzy
   * @see IMDB page /trailers
   * @brief New code thanks to george (http://projects.izzysoft.de/trac/imdbphp/ticket/286) with some minor adjustments by izzy
   */
  public function trailers($full=FALSE,$all=TRUE) {
    if ( empty($this->trailers) ) {
        if ( $this->page["Trailers"] == "" ) $this->openpage("Trailers");
        if ( $this->page["Trailers"] == "cannot open page" ) return array(); // no such page
        // due to site change, onsite / offsite trailers are mixed in on the same page
        // following code does not weed out offsite trailers.  
        // Also $tag_s will be TRUE even if there are no trailers
        // old code -- $tag_s = strpos($this->page["Trailers"], '<div id="search-results">');
        $has_trailers = strpos($this->page["Trailers"], '<div id="search-results"><ol>');
        if ($has_trailers !== FALSE) { // if any on-site or off-site trailers exists
            $html_trailer = substr($this->page["Trailers"], $has_trailers, strpos($this->page["Trailers"],'</ol>',$has_trailers) - ($has_trailers+1) );
            // echo $html_trailer;
            // offsite trailer will have links like    href="/video/imdblink/vi.....
            if ($all) $regex = '@<a\s*onclick=".*?"\s*href="(/video/.*?/vi\d+/)".*?><img.*?title="(.*?)"\s*viconst=".*?"\s*src="(.*?)"@s';
            else $regex = '@<a\s*onclick=".*?"\s*href="(/video/(?!imdblink).*?/vi\d+/)".*?><img.*?title="(.*?)"\s*src="(.*?)"@s';
            if (preg_match_all($regex, $html_trailer, $matches)) {
                //print_r($matches);
                for ($i=0;$i<count($matches[0]);++$i) {
                    $trailer = "http://".$this->imdbsite.$matches[1][$i];
                    $res = (strpos($matches[3][$i], 'HDIcon') !== FALSE )? 'HD' : 'SD';
                    if ( $full ) $this->trailers[] = array("lang"=>'',"title"=>html_entity_decode($matches[2][$i],ENT_QUOTES, 'UTF-8'),"url"=>$trailer,"restful_url"=>'',"resolution"=>$res);
                    else $this->trailers[] = $trailer;
                }
            }
        }
    }
    return $this->trailers;
  }


 #===========================================================[ /videosites ]===
 #--------------------------------------------------------[ content helper ]---
 /** Parse segments of external information on "VideoSites"
  * @method protected parse_extcontent
  * @param string title segment title
  * @param array res resultset (passed by reference)
  */
 protected function parse_extcontent($title,&$res) {
   if ( $this->page["VideoSites"] == "" ) $this->openpage("VideoSites");
   if ( $this->page["VideoSites"] == "cannot open page" ) return array(); // no such page
   if ( preg_match("!<h4 class=\"li_group\">$title\s*</h4>\s*(.+?)<(h4|div)!ims",$this->page["VideoSites"],$match) ) {
     if ( preg_match_all('!<li>(.+?)</li>!ims',$match[1],$matches) ) {
       $mc = count($matches[0]);
       for ($i=0;$i<$mc;++$i) {
         if ( preg_match('!<a .*href="(?<url>.+?)".*?>(?<site>.*?) - (?<desc>.*) \((?<type>.*?)\)</a>!',$matches[1][$i],$entry) ) {
           $res[] = array('site'=>$entry['site'], 'url'=>$entry['url'], 'type'=>$entry['type'], 'desc'=>$entry['desc']);
         } elseif ( preg_match('!<a .*href="(?<url>.+?)".*?>(?<site>.*?) - (?<desc>.+)</a>!',$matches[1][$i],$entry) ) {
           $res[] = array('site'=>$entry['site'], 'url'=>$entry['url'], 'type'=>'', 'desc'=>$entry['desc']);
         } elseif ( preg_match('!<a .*href="(?<url>.+?)".*?>(?<desc>.+)</a>!',$matches[1][$i],$entry) ) {
           $res[] = array('site'=>'', 'url'=>$entry['url'], 'type'=>'', 'desc'=>$entry['desc']);
         }
       }
     }
   }
 }

 #---------------------------------------------------[ Off-site soundclips ]---
  /** Get the off-site soundclip URLs
   * @method soundclipsites
   * @return array soundclipsites array[0..n] of array(site,url,type,desc)
   * @see IMDB page /videosites
   */
  public function soundclipsites() {
    if ( empty($this->soundclip_sites) ) {
      $this->parse_extcontent('Sound Clips',$this->soundclip_sites);
    }
    return $this->video_sites;
  }

 #-------------------------------------------------------[ Off-site photos ]---
  /** Get the off-site photo URLs
   * @method photosites
   * @return array photosites array[0..n] of array(site,url,type,desc)
   * @see IMDB page /videosites
   */
  public function photosites() {
    if ( empty($this->photo_sites) ) {
      $this->parse_extcontent('Photographs',$this->photo_sites);
    }
    return $this->photo_sites;
  }

 #--------------------------------------------------[ Off-site miscellanea ]---
  /** Get the off-site misc URLs
   * @method miscsites
   * @return array miscsites array[0..n] of array(site,url,type,desc)
   * @see IMDB page /videosites
   */
  public function miscsites() {
    if ( empty($this->misc_sites) ) {
      $this->parse_extcontent('Miscellaneous Sites',$this->misc_sites);
    }
    return $this->misc_sites;
  }

 #------------------------------------------[ Off-site trailers and videos ]---
  /** Get the off-site videos and trailer URLs
   * @method videosites
   * @return array videosites array[0..n] of array(site,url,type,desc)
   * @see IMDB page /videosites
   */
  public function videosites() {
    if ( empty($this->video_sites) ) {
      $this->parse_extcontent('Video Clips and Trailers',$this->video_sites);
    }
    return $this->video_sites;
  }


 #==========================================================[ /trivia page ]===
 #----------------------------------------------------------[ Trivia Array ]---
  /** Get the trivia info
   * @method trivia
   * @param optional boolean spoil Whether to retrieve the spoilers (TRUE) or the non-spoilers (FALSE, default)
   * @return array trivia (array[0..n] string
   * @see IMDB page /trivia
   */
  public function trivia($spoil=FALSE) {
    if (empty($this->trivia)) {
      if (empty($this->page["Trivia"])) $this->openpage("Trivia");
      if ($this->page["Trivia"] == "cannot open page") return array(); // no such page
      if ($spoil) {
        preg_match('!<a id="spoilers"(.+?)\s*<div class="article!ims',$this->page["Trivia"],$block);
      } else {
        preg_match('!<div id="trivia_content"(.+?)<a id="spoilers"!ims',$this->page["Trivia"],$block);
        if (empty($block)) preg_match('!<div id="trivia_content"(.+?)<div id="sidebar">!ims',$this->page["Trivia"],$block);
      }
      if ( preg_match_all('!<div class="sodatext">\s*(.*?)\s*</div>\s*<div!ims',$block[1],$matches) ) {
        $gc = count($matches[1]);
        for ($i=0;$i<$gc;++$i) $this->trivia[] = str_replace('href="/','href="http://'.$this->imdbsite."/",$matches[1][$i]);
      }
    }
    return $this->trivia;
  }


 #======================================================[ /soundtrack page ]===
 #------------------------------------------------------[ Soundtrack Array ]---
  /** Get the soundtrack listing
   * @method soundtrack
   * @return array soundtracks (array[0..n] of array(soundtrack,array[0..n] of credits array[credit_to,desc])
   * @see IMDB page /soundtrack
   */
  public function soundtrack() {
   if (empty($this->soundtracks)) {
     if (empty($this->page["Soundtrack"])) $this->openpage("Soundtrack");
     if ($this->page["Soundtrack"] == "cannot open page") return array(); // no such page
     if (preg_match_all('!class="soundTrack soda (odd|even)"\s*>\s*(?<title>.+?)<br\s*/>(?<desc>.+?)</div>!ims',str_replace("\n"," ",$this->page["Soundtrack"]),$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          $s['soundtrack'] = $matches['title'][$i];
          $s['credits'] = array();
          if ( preg_match_all('|^\s*(.*?)\s+by\s+(<a href[^>]+>.+?</a>)|i',$matches['desc'][$i],$match1) ) {
            for ($k=0;$k<count($match1[0]);++$k) {
              switch ($match1[1][$k]) {
                case "Arranged" : $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'arrangement'); break;
                case "Composed" : $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'composer'); break;
                case "Performed": $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'performer'); break;
                case "Written"  : $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'writer'); break;
                case "Written and Produced": {
                  $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'writer');
                  $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'producer');
                } break;
                case "Written and Performed": {
                  $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'writer');
                  $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'performer');
                } break;
                default: $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$match1[2][$k]), 'desc'=>'**'.$match1[1][$k].'**');
              }
            }
          } elseif ( preg_match_all('|\s*([^>]*)\s+by\s+([^<]+)|i',$matches['desc'][$i],$match1) ) { // creditors without link
            for ($k=0;$k<count($match1[0]);++$k) {
              if ( preg_match('!(.+)\s+and\s+(.+)!',$match1[2][$k],$cr) ) $creds = array($cr[1],$cr[2]);
              else $creds = array($match1[2][$k]);
              switch ($match1[1][$k]) {
                case "Arranged" : foreach ($creds as $cred) $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'arrangement'); break;
                case "Composed" : foreach ($creds as $cred) $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'composer'); break;
                case "Performed": foreach ($creds as $cred) $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'performer'); break;
                case "Written"  : foreach ($creds as $cred) $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'writer'); break;
                case "Written and Produced": foreach ($creds as $cred) {
                     $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'writer');
                     $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'producer');
                   }
                   break;
                case "Written and Performed": foreach ($creds as $cred) {
                     $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'writer');
                     $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'performer');
                   }
                   break;
                default: foreach ($creds as $cred) $s['credits'][] = array('credit_to'=>str_replace('href="/','href="http://'.$this->imdbsite.'/',$cred), 'desc'=>'**'.$match1[1][$k].'**'); break;
              }
            }
          }
          if ( preg_match('|Courtesy of\s+([^<]+)<|i',$matches['desc'][$i],$match) ) $s['credits'][] = array('credit_to'=>$match[1], 'desc'=>'courtesy');
          if ( preg_match('|By Arrangement with\s+([^<]+)<|i',$matches['desc'][$i],$match) ) $s['credits'][] = array('credit_to'=>$match[1], 'desc'=>'arrangement');
          if ( preg_match('|Under license from\s+([^<]+)<|i',$matches['desc'][$i],$match) ) $s['credits'][] = array('credit_to'=>$match[1], 'desc'=>'license');
          $this->soundtracks[] = $s;
        }
     }
   }
   return $this->soundtracks;
  }

 #=================================================[ /movieconnection page ]===
 #----------------------------------------[ Helper: ConnectionBlock Parser ]---
  /** Parse connection block (used by method movieconnection only)
   * @method protected parseConnection
   * @param string conn connection type
   * @return array [0..n] of array mid,name,year,comment - or empty array if not found
   */
  protected function parseConnection($conn) {
    $tag_s = strpos($this->page["MovieConnections"],"<h4 class=\"li_group\">$conn");
    if (empty($tag_s)) return array(); // no such feature
    $tag_e = strpos($this->page["MovieConnections"],"<h4 class=\"li",$tag_s+4);
    if (empty($tag_e)) $tag_e = strpos($this->page["MovieConnections"],"<script",$tag_s);
    $block = substr($this->page["MovieConnections"],$tag_s,$tag_e-$tag_s);
    if (preg_match_all('!<a href="(.*?)">(.*?)</a>&nbsp;\((\d{4})\)(.*<br\s*/>(.*?)\s*</div>)?!ims',$block,$matches)) {
      $this->debug_object($matches);
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) {
        $mid = substr($matches[1][$i],9,strlen($matches[1][$i])-10); // isolate imdb id from url
        $arr[] = array("mid"=>$mid, "name"=>$matches[2][$i], "year"=>$matches[3][$i], "comment"=>trim($matches[5][$i]));
      }
    }
    return $arr;
  }

 #-------------------------------------------------[ MovieConnection Array ]---
  /** Get connected movie information
   * @method movieconnection
   * @return array connections (versionOf, editedInto, followedBy, spinOff,
   *         spinOffFrom, references, referenced, features, featured, spoofs,
   *         spoofed - each an array of mid, name, year, comment or an empty
   *         array if no connections of that type)
   * @see IMDB page /movieconnection
   */
  public function movieconnection() {
    if (empty($this->movieconnections)) {
      if (empty($this->page["MovieConnections"])) $this->openpage("MovieConnections");
      if ($this->page["MovieConnections"] == "cannot open page") return array(); // no such page
      $this->movieconnections["editedFrom"] = $this->parseConnection("Edited from");
      $this->movieconnections["editedInto"] = $this->parseConnection("Edited into");
      $this->movieconnections["featured"]   = $this->parseConnection("Featured in");
      $this->movieconnections["features"]   = $this->parseConnection("Features");
      $this->movieconnections["followedBy"] = $this->parseConnection("Followed by");
      $this->movieconnections["follows"]    = $this->parseConnection("Follows");
      $this->movieconnections["references"] = $this->parseConnection("References");
      $this->movieconnections["referenced"] = $this->parseConnection("Referenced in");
      $this->movieconnections["remadeAs"]   = $this->parseConnection("Remade as");
      $this->movieconnections["remakeOf"]   = $this->parseConnection("Remake of");
      $this->movieconnections["spinOff"]    = $this->parseConnection("Spin off");
      $this->movieconnections["spinOffFrom"] = $this->parseConnection("Spin off from");
      $this->movieconnections["spoofed"]    = $this->parseConnection("Spoofed in");
      $this->movieconnections["spoofs"]     = $this->parseConnection("Spoofs");
      $this->movieconnections["versionOf"]  = $this->parseConnection("Version of");
    }
    return $this->movieconnections;
  }

 #=================================================[ /externalreviews page ]===
 #-------------------------------------------------[ ExternalReviews Array ]---
  /** Get list of external reviews (if any)
   * @method extReviews
   * @return array [0..n] of array [url, desc] (or empty array if no data)
   * @see IMDB page /externalreviews
   */
  public function extReviews() {
    if (empty($this->extreviews)) {
      if (empty($this->page["ExtReviews"])) $this->openpage("ExtReviews");
      if ($this->page["ExtReviews"] == "cannot open page") return array(); // no such page
      if (preg_match_all('@<li><a href="(.*?)".*?>(.*?)</a>@',$this->page["ExtReviews"],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          $this->extreviews[$i] = array("url"=>$matches[1][$i], "desc"=>$matches[2][$i]);
        }
      }
    }
    return $this->extreviews;
  }

 #=====================================================[ /releaseinfo page ]===
 #-----------------------------------------------------[ ReleaseInfo Array ]---
  /** Obtain Release Info (if any)
   * @method releaseInfo
   * @return array release_info array[0..n] of strings (country,day,month,mon,
             year,comment) - "month" is the month name, "mon" the number
   * @see IMDB page /releaseinfo
   */
  public function releaseInfo() {
    if (empty($this->release_info)) {
      if (empty($this->page["ReleaseInfo"])) $this->openpage("ReleaseInfo");
      if ($this->page["ReleaseInfo"] == "cannot open page") return array(); // no such page
      $tag_s = strpos($this->page["ReleaseInfo"],'<th class="xxxx">Country</th><th class="xxxx">Date</th>');
      $tag_e = strpos($this->page["ReleaseInfo"],'</table',$tag_s);
      $block = substr($this->page["ReleaseInfo"],$tag_s,$tag_e-$tag_s);
      preg_match_all('!<tr[^>]*>\s*<td><a[^>]*>(.*?)</a></td>\s*<td[^>]*>(.*?)</td>\s*<td>(.*?)</td>!ims',$block,$matches);
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) {
        $country = strip_tags($matches[1][$i]);
        if ( preg_match('!href="/date/(\d{2})-(\d{2})/">\d+ (.*?)</a>\s*<a href="/year/(\d{4})/">!is',$matches[2][$i],$match) ) { // full info
          $this->release_info[] = array('country'=>$country,'day'=>$match[2],'month'=>$match[3],'mon'=>$match[1],'year'=>$match[4],'comment'=>$matches[3][$i]);
        } elseif ( preg_match('!(\d{1,2})\s*(.+?)<a href="/year/(\d{4})/.+?"\s*>!is',$matches[2][$i],$match) ) { // full info v2
          $this->release_info[] = array('country'=>$country,'day'=>$match[1],'month'=>$match[2],'mon'=>$this->monthNo(trim($match[2])),'year'=>$match[3],'comment'=>$matches[3][$i]);
        } elseif ( !preg_match('|a href=|i',$matches[2][$i],$match) ) { // no links within
          if ( preg_match('!^(.+?)\s(\d{4})$!s',trim($matches[2][$i]),$match) ) { // month and year
            $this->release_info[] = array('country'=>$country,'day'=>'','month'=>$match[1],'mon'=>$this->monthNo(trim($match[1])),'year'=>$match[2],'comment'=>$matches[3][$i]);
          } elseif ( preg_match('!(\d{4})!',trim($matches[2][$i]),$match) ) { // year at least
            $this->release_info[] = array('country'=>$country,'day'=>'','month'=>'','mon'=>'','year'=>$match[1],'comment'=>$matches[3][$i]);
          }
        } else {
          $this->debug_scalar("NO MATCH ON<pre>".htmlentities($matches[2][$i])."</pre>");
        }
      }
    }
    return $this->release_info;
  }

 #=======================================================[ /locations page ]===
  /** Obtain filming locations
   * @method locations
   * @return array locations array[0..n] of array[name,url] with name being the
   *               name of the location, and url a relative URL to list other
   *               movies sharing this location
   * @see IMDB page /locations
   */
  public function locations() {
    if ( empty($this->locations) ) {
      if ( empty($this->page['Locations']) ) $this->openpage("Locations");
      if ( $this->page['Locations'] == "cannot open page" ) return array(); // no such page
      $tag_s = strpos($this->page['Locations'],'<div id="tn15adrhs">');
      $tag_e = strpos($this->page['Locations'],'</dl>');
      $block = substr($this->page['Locations'],$tag_s,$tag_e-$tag_s);
      $block = substr($block,strpos($block,'<dl>'));
      if ( preg_match_all('!<dt>(<a href="(.*?)">|)(.*?)(</a>|</dt>)!ims',$block,$matches) ) {
        for ($i=0;$i<count($matches[0]);++$i)
          $this->locations[] = array('name'=>$matches[3][$i], 'url'=>$matches[2][$i]);
      }
    }
    return $this->locations;
  }

 #==================================================[ /companycredits page ]===
 #---------------------------------------------[ Helper: Parse CompanyInfo ]---
  /** Parse company info
   * @method protected companyParse
   * @param ref string text to parse
   * @param ref array parse target
   */
  protected function companyParse(&$text,&$target) {
    preg_match_all('|<li>\s*<a href="(.*)"\s*>(.*)</a>(.*)</li>|iUms',$text,$matches);
    $mc = count($matches[0]);
    for ($i=0;$i<$mc;++$i) {
      $target[] = array("name"=>$matches[2][$i], "url"=>'http://'.$this->imdbsite.$matches[1][$i], "notes"=>trim($matches[3][$i]));
    }
  }

 #---------------------------------------------------[ Producing Companies ]---
  /** Info about Production Companies
   * @method prodCompany
   * @return array [0..n] of array (name,url,notes)
   * @see IMDB page /companycredits
   */
  public function prodCompany() {
    if (empty($this->compcred_prod)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h4[^>]*>Production Companies</h4>\s*<ul[^>]*>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_prod);
      }
    }
    return $this->compcred_prod;
  }

 #------------------------------------------------[ Distributing Companies ]---
  /** Info about distributors
   * @method distCompany
   * @return array [0..n] of array (name,url,notes)
   * @see IMDB page /companycredits
   */
  public function distCompany() {
    if (empty($this->compcred_dist)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h4[^>]*>Distributors</h4>\s*<ul[^>]*>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_dist);
      }
    }
    return $this->compcred_dist;
  }

 #---------------------------------------------[ Special Effects Companies ]---
  /** Info about Special Effects companies
   * @method specialCompany
   * @return array [0..n] of array (name,url,notes)
   * @see IMDB page /companycredits
   */
  public function specialCompany() {
    if (empty($this->compcred_special)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h4[^>]*>Special Effects</h4>\s*<ul[^>]*>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_special);
      }
    }
    return $this->compcred_special;
  }

 #-------------------------------------------------------[ Other Companies ]---
  /** Info about other companies
   * @method otherCompany
   * @return array [0..n] of array (name,url,notes)
   * @see IMDB page /companycredits
   */
  public function otherCompany() {
    if (empty($this->compcred_other)) {
      if (empty($this->page["CompanyCredits"])) $this->openpage("CompanyCredits");
      if ($this->page["CompanyCredits"] == "cannot open page") return array(); // no such page
      if (preg_match('|<h4[^>]*>Other Companies</h4>\s*<ul[^>]*>(.*?)</ul>|ims',$this->page["CompanyCredits"],$match)) {
        $this->companyParse($match[1],$this->compcred_other);
      }
    }
    return $this->compcred_other;
  }

 #===================================================[ /parentalguide page ]===
 #-------------------------------------------------[ ParentalGuide Details ]---
  /** Detailed Parental Guide
   * @method parentalGuide
   * @return array of strings; keys: Alcohol, Sex, Violence, Profanity,
   *         Frightening - and maybe more; values: arguments for the rating
   * @see IMDB page /parentalguide
   */
  public function parentalGuide() {
    if (empty($this->parental_guide)) {
      if (empty($this->page["ParentalGuide"])) $this->openpage("ParentalGuide");
      if ($this->page["ParentalGuide"] == "cannot open page") return array(); // no such page
      if (preg_match_all('/<div class="section">(.*)<div id="swiki(\.\d+\.\d+|_last)">/iUms',$this->page["ParentalGuide"],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          if ( !preg_match('|<span>(.*)</span>|iUms',$matches[1][$i],$match) ) continue;
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

 #===================================================[ /officialsites page ]===
 #---------------------------------------------------[ Official Sites URLs ]---
  /** URLs of Official Sites
   * @method officialSites
   * @return array [0..n] of url, name
   * @see IMDB page /officialsites
   * @brief now combined with /videosites to /externalsites
   */
  public function officialSites() {
    if (empty($this->official_sites)) {
      $sites = array();
      $this->parse_extcontent('Official Sites',$sites);
      foreach ($sites as $site) $this->official_sites[] = array('url'=>$site['url'],'name'=>$site['desc']);
    }
    return $this->official_sites;
  }

 #========================================================[ /keywords page ]===
 #--------------------------------------------------------------[ Keywords ]---
  /** Get the complete keywords for the movie
   * @method keywords_all
   * @return array keywords
   * @see IMDB page /keywords
   */
  function keywords_all() {
    if (empty($this->all_keywords)) {
      if ($this->page["Keywords"] == "") $this->openpage("Keywords");
      if (preg_match_all('|<a href\="/keyword/[\w\?_\=\-\s"]+>(.*?)</a>|',$this->page["Keywords"],$matches))
        $this->all_keywords = $matches[1];
    }
    return $this->all_keywords;
  }

  #========================================================[ /awards page ]===
  #--------------------------------------------------------------[ Awards ]---
  /** Get the complete awards for the movie
   * @method awards
   * @return array awards array[festivalName]['entries'][0..n] of array[year,won,category,award,people,comment]
   * @see IMDB page /awards
   * @author Qvist
   * @brief array[festivalName] is array[name,entries] - where name is a string,
   *        and entries is above described array
   */
  public function awards() {
    if (empty($this->awards)) {
      if ($this->page["Awards"] == "") $this->openpage("Awards");
      $award_rows = $this->get_table_rows_awards($this->page["Awards"]);
      $rowcount = count ($award_rows);
      $festival = ""; $year = 0; $won = false; $award = ""; $comment = ""; $people = array(); $nr = 0;
      for ( $i = 0; $i < $rowcount; $i++){
        $cels = $this->get_row_cels ($award_rows[$i]);
        if( count ($cels) == 0 ){ continue; }
        if( count ($cels) == 1 && preg_match( '|<big><a href\="/Sections/Awards/([^\/]+)/">(.*?)</a></big>|s', $cels[0], $matches ) ){
            $festival = $matches[1];
            $this->awards[$festival]['name'] = $matches[2];
            $nr = 0;
        }
        if( count ($cels) == 4 && preg_match( '|<a href\="/Sections/Awards/'.quotemeta( $festival ).'/[\d-]+">(\d{4}) </a>|s', $cels[0], $matches ) ){
            $year = $matches[1];
            array_shift( $cels );
        }
        if( count ($cels) == 3 && preg_match( '|<b>(.*?)</b>|s', $cels[0], $matches ) ){
            $won = ($matches[1]=="Won")?true:false;
            array_shift( $cels );
        }
        if( count ($cels) == 2 && strpos( $cels[0], "<" ) === false ){
            $award = $cels[0];
            array_shift( $cels );
        }
        if( count ($cels) == 1 && preg_match( '|([^<>]*)<br>(.*)<small>|s', $cels[0], $matches ) ){
            $category = trim( $matches[1] );
            preg_match_all( '|<a href\="/name/nm(\d{7})/">(.*?)</a>|s', $cels[0], $matches );
            $people = isset( $matches[0][0] )?array_combine( $matches[1], $matches[2] ):array();
            preg_match( '|<small>(.*?)</small>|s', $cels[0], $matches );
            $comment = isset( $matches[1] )?strip_tags( $matches[1] ):'';
            array_shift( $cels );
            $nr++;
        }
        if( count ($cels) == 0 ){
            $this->awards[$festival]['entries'][$nr] = array(
                'year' => $year, 'won' => $won, 'category' => $category, 'award' => $award, 'people' => $people, 'comment' => $comment );
        }
      }
    }
    return $this->awards;
  }


 } // end class imdb

?>