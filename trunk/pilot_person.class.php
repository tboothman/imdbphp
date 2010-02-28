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

 require_once (dirname(__FILE__)."/person_base.class.php");
 require_once (dirname(__FILE__)."/imdbsearch.class.php");
 if (mdb_config::pilot_imdbfallback_enabled) require_once (dirname(__FILE__)."/imdb_person.class.php");

 #=================================================[ The IMDB Person class ]===
 /** Accessing IMDB staff information
  * @package IMDB
  * @class pilot_person
  * @extends mdb_base
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright 2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class pilot_person extends person_base {

 #========================================================[ Common methods ]===
 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   switch ($wt){
    case "Name"        : $urlname="/people/imdb-id-".(int)$this->imdbid().".json"; break;
    case "Images"      :
      if ($this->page["Name"]=="") $this->openpage("Name");
      $urlname = parse_url($this->page["Name"]->restful_url,PHP_URL_PATH).'/images.json';
      break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return false;
   }
   return $urlname;
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor pilot_person
   * @param string id IMDBID to use for data retrieval
   */
  function __construct($id) {
    parent::__construct($id);
    if ( empty($this->pilot_apikey) )
      trigger_error('Please provide a valid api key or contact api@moviepilot.de.',E_USER_WARNING);
    $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
    if (mdb_config::pilot_imdbfallback_enabled) $this->imdb = new imdb_person($id);
    $this->setid($id);
  }

 #-----------------------------------------------[ URL to person main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  public function main_url(){
    return "http://".$this->pilotsite."/people/imdb-id-".(int)$this->imdbid();
  }

 #-------------------------------------------------------------[ Open Page ]---
  /** Load an Pilot page into the corresponding property (variable)
   * @method private openpage
   * @param string wt internal name of the page
   * @param optional string type whether its a "movie" (default) or a "person"
   */
  function openpage ($wt,$type="pilot") {
    parent::openpage($wt,$type);
    if ($this->page[$wt] == "cannot open page") return;
    if ($this->page[$wt] == '{"error":"please provide a valid api key or contact api@moviepilot.de"}') {
      $this->debug_scalar('ERROR: invalid API key');
      trigger_error('Please provide a valid api key or contact api@moviepilot.de.',E_USER_WARNING);
      return;
    }
    $this->page[$wt] = json_decode($this->page[$wt]);
  }

 #=============================================================[ Main Page ]===
 #------------------------------------------------------------------[ Name ]---
  /** Get the name of the person
   * @method name
   * @return string name full name of the person
   * @see Pilot person page / (Main page)
   */
  public function name() {
    if (empty($this->fullname)) {
      if ($this->page["Name"] == "") $this->openpage ("Name");
      $this->fullname = $this->page["Name"]->first_name . ' ' . $this->page["Name"]->last_name;
    }
    return $this->fullname;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Get all available photo URLs
   * @method photo_array
   * @return array images [0..n] of array[width,size,url]
   * @see Pilot Person Image page
   */
  public function photo_array() {
    if ( empty($this->photo_array) ) {
      if ($this->page["Images"] == "") $this->openpage ("Images");
      $icount = $this->page["Images"]->total_entries;
      if (!$icount) return array();
      foreach ($this->page["Images"]->images as $img) {
	$this->photo_array[] = array(
	  "width"=>$img->width,
	  "size" =>$img->size,
	  "url"  =>$img->base_url . $img->photo_id . '/' . $img->file_name_base . '.' . $img->extension
	);
      }
    }
    return $this->photo_array;
  }

  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (smallest one found, default)
   *        or the bigger variant (biggest one found - FALSE)
   * @return mixed photo (string url if found, FALSE otherwise)
   * @see Pilot Person Image page
   */
  public function photo($thumb=true) {
    if (empty($this->main_photo)) {
      $imgs = $this->photo_array();
      $icount = $this->page["Images"]->total_entries;
      if (!$icount) return FALSE;
      if ($thumb) $width = 9999999;
      else $width = 0;
      foreach ($imgs as $img) {
        if ($thumb && $img['width'] < $width) {
	  $this->main_photo = $img['url'];
	  $width = $img['width'];
	} elseif (!$thumb && $img['width'] > $width) {
	  $this->main_photo = $img['url'];
	  $width = $img['width'];
	}
      }
    }
    return $this->main_photo;
  }

  /** Save the photo to disk
   * @method savephoto
   * @param string path where to store the file
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return boolean success
   * @see Pilot Person Image page
   */
  public function savephoto($path,$thumb=true) {
    $req = new MDB_Request("");
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
   * @param optional boolean thumb get the thumbnail (smallest one found, default)
   *        or the bigger variant (biggest one found - FALSE)
   * @return mixed url (string URL or FALSE if none)
   * @see IMDB person page / (Main page)
   */
  public function photo_localurl($thumb=true){
    if ($thumb) $ext = ""; else $ext = "_big";
    if (!is_dir($this->photodir)) {
      $this->debug_scalar("<BR>***ERROR*** The configured image directory does not exist!<BR>");
      return false;
    }
    $path = $this->photodir."nm".$this->imdbid()."${ext}.jpg";
    if ( @fopen($path,"r")) return $this->photoroot."nm".$this->imdbid()."${ext}.jpg";
    if (!is_writable($this->photodir)) {
      $this->debug_scalar("<BR>***ERROR*** The configured image directory lacks write permission!<BR>");
      return false;
    }
    if ($this->savephoto($path,$thumb)) return $this->photoroot."nm".$this->imdbid()."${ext}.jpg";
    return false;
  }

 #----------------------------------------------------------[ Filmographie ]---
 /** Get complete filmography
  *  This method ignores the categories and tries to collect the complete
  *  filmography. Useful e.g. for pages without categories on. It may, however,
  *  contain duplicates if there are categories and a movie is listed in more
  *  than one of them
  * @method movies_all
  * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
  *         the character IMDB ID, chname the character name, and addons an
  *         array of additional remarks (the things in parenthesis)
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_all() {
    if (empty($this->allfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->allfilms = $this->imdb->movies_all();
    return $this->allfilms;
  }

 /** Get actress filmography
  * @method movies_actress
  * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
  *         the character IMDB ID, chname the character name, and addons an
  *         array of additional remarks (the things in parenthesis)
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_actress() {
     if (empty($this->actressfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->actressfilms = $this->imdb->movies_acress();
     return $this->actressfilms;
   }

 /** Get actors filmography
  * @method movies_actor
  * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
  *         the character IMDB ID, chname the character name, and addons an
  *         array of additional remarks (the things in parenthesis)
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_actor() {
    if (empty($this->actorsfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->actorsfilms = $this->imdb->movies_actor();
    return $this->actorsfilms;
  }

 /** Get producers filmography
  * @method movies_producer
  * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
  *         the character IMDB ID, chname the character name, and addons an
  *         array of additional remarks (the things in parenthesis)
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_producer() {
    if (empty($this->producersfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->producersfilms = $this->imdb->movies_producer();
    return $this->producersfilms;
  }

 /** Get directors filmography
  * @method movies_director
  * @return array array[0..n][mid,name,year]
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_director() {
    if (empty($this->directorsfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->directorsfilms = $this->imdb->movies_director();
    return $this->directorsfilms;
  }

 /** Get soundtrack filmography
  * @method movies_soundtrack
  * @return array array[0..n][mid,name,year]
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_soundtrack() {
    if (empty($this->soundtrackfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->soundtrackfilms = $this->imdb->movies_soundtrack();
    return $this->soundtrackfilms;
  }

 /** Get "Misc Crew" filmography
  * @method movies_crew
  * @return array array[0..n][mid,name,year]
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_crew() {
    if (empty($this->crewsfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->crewsfilms = $this->imdb->movies_crew();
    return $this->crewsfilms;
  }

 /** Get "Thanx" filmography
  * @method movies_thanx
  * @return array array[0..n][mid,name,year]
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_thanx() {
    if (empty($this->thanxfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->thanxfilms = $this->imdb->movies_thanx();
    return $this->thanxfilms;
  }

 /** Get "Self" filmography
  * @method movies_self
  * @return array array[0..n][mid,name,year,chid,chname], where chid is the
  *         character IMDB ID, and chname the character name
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_self() {
    if (empty($this->selffilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->selffilms = $this->imdb->movies_self();
    return $this->selffilms;
  }

 /** Get writers filmography
  * @method movies_writer
  * @return array array[0..n][mid,name,year,chid,chname], where chid is the
  *         character IMDB ID, and chname the character name
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_writer() {
    if (empty($this->writerfilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->writerfilms = $this->imdb->movies_writer();
    return $this->writerfilms;
  }

 /** Get "Archive Footage" filmography
  * @method movies_archive
  * @return array array[0..n][mid,name,year,chid,chname], where chid is the
  *         character IMDB ID, and chname the character name
  * @see IMDB person page / (Main page)
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function movies_archive() {
    if (empty($this->archivefilms) && $this->pilot_imdbfill==FULL_ACCESS) $this->archivefilms = $this->imdb->movies_archive();
    return $this->archivefilms;
  }

 #==================================================================[ /bio ]===
 #------------------------------------------------------------[ Birth Name ]---
 /** Get the birth name
  * @method birthname
  * @return string birthname
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set at least to MEDIUM_ACCESS, it will be retrieved from IMDB.
  */
 public function birthname() {
   if (empty($this->birth_name) && $this->pilot_imdbfill > BASIC_ACCESS) $this->birth_name = $this->imdb->birthname();
   return $this->birth_name;
 }

 #-------------------------------------------------------------[ Nick Name ]---
 /** Get the nick name
  * @method nickname
  * @return array nicknames array[0..n] of strings
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set at least to MEDIUM_ACCESS, it will be retrieved from IMDB.
  */
 public function nickname() {
   if (empty($this->nick_name) && $this->pilot_imdbfill > BASIC_ACCESS) $this->nick_name = $this->imdb->nickname();
   return $this->nick_name;
 }

 #------------------------------------------------------------------[ Born ]---
  /** Get Birthday
   * @method born
   * @return array birthday [day,month,mon,year,place]
   *         where month is the month name, and mon the month number
   * @see Pilot person page / (Main page)
   */
  public function born() {
    if (empty($this->birthday)) {
      if ($this->page["Name"] == "") $this->openpage ("Name");
      $months = array_flip($this->months);
      if ( preg_match('|(\d+)\-(\d+)\-(\d+)|',$this->page["Name"]->date_of_birth,$match) )
        $this->birthday = array("day"=>$match[3],"month"=>$months[$match[2]],"mon"=>$match[2],"year"=>$match[1],"place"=>'');
    }
    return $this->birthday;
  }

 #------------------------------------------------------------------[ Died ]---
  /** Get Deathday
   * @method died
   * @return array deathday [day,month.mon,year,place,cause]
   *         where month is the month name, and mon the month number
   * @see Pilot person page / (Main page)
   */
  public function died() {
    if (empty($this->deathday)) {
      if ($this->page["Name"] == "") $this->openpage ("Name");
      $months = array_flip($this->months);
      if ( preg_match('|(\d+)\-(\d+)\-(\d+)|',$this->page["Name"]->date_of_death,$match) )
        $this->deathday = array("day"=>$match[3],"month"=>$months[$match[2]],"mon"=>$match[2],"year"=>$match[1],"place"=>'');
    }
    return $this->deathday;
  }

 #-----------------------------------------------------------[ Body Height ]---
 /** Get the body height
  * @method height
  * @return array [imperial,metric] height in feet and inch (imperial) an meters (metric)
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set at least to MEDIUM_ACCESS, it will be retrieved from IMDB.
  */
 public function height() {
   if (empty($this->bodyheight) && $this->pilot_imdbfill > BASIC_ACCESS) $this->bodyheight = $this->imdb->height();
   return $this->bodyheight;
 }

 #----------------------------------------------------------------[ Spouse ]---
 /** Get spouse(s)
  * @method spouse
  * @return array [0..n] of array spouses [string imdb, string name, array from,
  *         array to, string comment, string children], where from/to are array
  *         [day,month,mon,year] (month is the name, mon the number of the month),
  *         comment usually is "divorced" (ouch), children is the number of children
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set at least to MEDIUM_ACCESS, it will be retrieved from IMDB.
  */
 public function spouse() {
   if (empty($this->spouses) && $this->pilot_imdbfill > BASIC_ACCESS) $this->spouses = $this->imdb->spouse();
   return $this->spouses;
 }

 #---------------------------------------------------------------[ MiniBio ]---
 /** Get the person's mini bio
  * @method bio
  * @return array bio array [0..n] of array[string desc, array author[url,name]]
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB. Otherwise, we use
  *        the short_description provided at Moviepilots Person main .json
  */
  public function bio() {
   if (empty($this->bio_bio)) {
     if ($this->pilot_imdbfill==FULL_ACCESS) $this->bio_bio = $this->imdb->bio();
     else {
       if ($this->page["Name"] == "") $this->openpage("Name");
       if (!empty($this->page["Name"]->short_description))
         $this->bio_bio[] = array("desc"=>$this->page["Name"]->short_description,"author"=>array("url"=>'',"name"=>'Moviepilot'));
     }
   }
   return $this->bio_bio;
  }

 #----------------------------------------------------------------[ Trivia ]---
 /** Get the Trivia
  * @method trivia
  * @return array trivia array[0..n] of string
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function trivia() {
    if (empty($this->bio_trivia) && $this->pilot_imdbfill==FULL_ACCESS) $this->bio_trivia = $this->imdb->trivia();
    return $this->bio_trivia;
  }

 #----------------------------------------------------------------[ Quotes ]---
 /** Get the Personal Quotes
  * @method quotes
  * @return array quotes array[0..n] of string
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function quotes() {
    if (empty($this->bio_quotes) && $this->pilot_imdbfill==FULL_ACCESS) $this->bio_quotes = $this->imdb->quotes();
    return $this->bio_quotes;
  }

 #------------------------------------------------------------[ Trademarks ]---
 /** Get the "trademarks" of the person
  * @method trademark
  * @return array trademarks array[0..n] of strings
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function trademark() {
    if (empty($this->bio_tm) && $this->pilot_imdbfill==FULL_ACCESS) $this->bio_tm = $this->imdb->trademark();
    return $this->bio_tm;
  }

 #----------------------------------------------------------------[ Salary ]---
 /** Get the salary list
  * @method salary
  * @return array salary array[0..n] of array movie[strings imdb,name,year], string salary
  * @see IMDB person page /bio
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function salary() {
    if (empty($this->bio_salary) && $this->pilot_imdbfill==FULL_ACCESS) $this->bio_salary = $this->imdb->salary();
    return $this->bio_salary;
  }

 #============================================================[ /publicity ]===
 #-----------------------------------------------------------[ Print media ]---
 /** Print media about this person
  * @method pubprints
  * @return array prints array[0..n] of array[author,title,place,publisher,year,isbn,url],
  *         where "place" refers to the place of publication, and "url" is a link to the ISBN
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function pubprints() {
    if (empty($this->pub_prints) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_prints = $this->imdb->pubprints();
    return $this->pub_prints;
  }

 #----------------------------------------------------[ Biographical movies ]---
 /** Biographical Movies
  * @method pubmovies
  * @return array pubmovies array[0..n] of array[imdb,name,year]
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function pubmovies() {
    if (empty($this->pub_movies) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_movies = $this->imdb->pubmovies();
    return $this->pub_movies;
  }

 #-----------------------------------------------------------[ Portrayed in ]---
 /** List of movies protraying the person
  * @method pubportraits
  * @return array pubmovies array[0..n] of array[imdb,name,year]
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function pubportraits() {
    if (empty($this->pub_portraits) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_portraits = $this->imdb->pubportraits();
    return $this->pub_portraits;
  }

 #-------------------------------------------------------------[ Interviews ]---
 /** Interviews
  * @method interviews
  * @return array interviews array[0..n] of array[inturl,name,date,details,auturl,author]
  *         where all elements are strings - just date is an array[day,month,mon,year,full]
  *         (full: as displayed on the IMDB site)
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function interviews() {
    if (empty($this->pub_interviews) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_interviews = $this->imdb->interviews();
    return $this->pub_interviews;
  }

 #--------------------------------------------------------------[ Articles ]---
 /** Articles
  * @method articles
  * @return array articles array[0..n] of array[inturl,name,date,details,auturl,author]
  *         where all elements are strings - just date is an array[day,month,mon,year,full]
  *         (full: as displayed on the IMDB site)
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function articles() {
    if (empty($this->pub_articles) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_articles = $this->imdb->articles();
    return $this->pub_articles;
  }

 #--------------------------------------------------------------[ Articles ]---
 /** Pictorials
  * @method pictorials
  * @return array pictorials array[0..n] of array[inturl,name,date,details,auturl,author]
  *         where all elements are strings - just date is an array[day,month,mon,year,full]
  *         (full: as displayed on the IMDB site)
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function pictorials() {
    if (empty($this->pub_pictorials) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_pictorials = $this->imdb->pictorials();
    return $this->pub_pictorials;
  }

 #--------------------------------------------------------------[ Articles ]---
 /** Magazine cover photos
  * @method magcovers
  * @return array magcovers array[0..n] of array[inturl,name,date,details,auturl,author]
  *         where all elements are strings - just date is an array[day,month,mon,year,full]
  *         (full: as displayed on the IMDB site)
  * @see IMDB person page /publicity
  * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
  *        set to FULL_ACCESS, it will be retrieved from IMDB.
  */
  public function magcovers() {
    if (empty($this->pub_magcovers) && $this->pilot_imdbfill==FULL_ACCESS) $this->pub_magcovers = $this->imdb->magcovers();
    return $this->pub_magcovers;
  }

 #---------------------------------------------------------[ Search Details ]---
  /** Set some search details
   * @method setSearchDetails
   * @param string role
   * @param integer mid IMDB ID
   * @param string name movie-name
   * @param integer year
   */
  function setSearchDetails($role,$mid,$name,$year) {
    $this->SearchDetails = array("role"=>$role,"mid"=>$mid,"moviename"=>$name,"year"=>$year);
  }
  /** Get the search details
   *  They are just set when the imdb_person object has been initialized by the
   *  imdbpsearch class
   * @method getSearchDetails
   * @return array SearchDetails (mid,name,role,moviename,year)
   */
  function getSearchDetails() {
    return $this->SearchDetails;
  }

 } // end class pilot_person
?>
