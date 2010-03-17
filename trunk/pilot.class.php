<?php
 #############################################################################
 # IMDBPHP.MoviePilot                                    (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

 require_once(dirname(__FILE__)."/movie_base.class.php");
 if (mdb_config::pilot_imdbfallback_enabled) require_once(dirname(__FILE__)."/imdb.class.php");

 #=============================================================================
 #================================================[ The Pilot class itself ]===
 #=============================================================================
 /** Accessing MoviePilot information
  * @package MoviePilot
  * @class pilot
  * @extends movie_base
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class pilot extends movie_base {

 #======================================================[ Common functions ]===
 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor pilot
   * @param string id IMDBID to use for data retrieval
   */
  function __construct($id) {
    parent::__construct($id);
    if ( empty($this->pilot_apikey) )
      trigger_error('Please provide a valid api key or contact api@moviepilot.de.',E_USER_WARNING);
    $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
    if (mdb_config::pilot_imdbfallback_enabled) $this->imdb = new imdb($id);
    $this->setid($id);
  }

  /** Setup class for a new IMDB id
   * @method setid
   * @param string id IMDBID of the requested movie
   */
  function setid($id) {
    parent::setid($id);
    if (mdb_config::pilot_imdbfallback_enabled) $this->imdb->setid($id);
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

 #-----------------------------------------------[ URL to person main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  public function main_url(){
   return "http://".$this->pilotsite."/movies/imdb-id-".(int)$this->imdbid();
  }

 #----------------------------------------------------------[ Set Pagename ]---
  /** Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   switch ($wt){
    case "Title"       : $urlname="/movies/imdb-id-".(int)$this->imdbid().".json"; break;
    case "Credits"     : $urlname="/movies/imdb-id-".(int)$this->imdbid()."/casts.json"; break;
    case "Trailers"    : $urlname="/movies/imdb-id-".(int)$this->imdbid()."/trailers.json"; break;
    case "Images"      : $urlname="/movies/imdb-id-".(int)$this->imdbid()."/images.json"; break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return false;
   }
   return $urlname;
  }

 #======================================================[ Title page infos ]===
 #-------------------------------------------[ Movie title (name) and year ]---
  /** Get movie title
   * @method title
   * @return string title movie title (name)
   * @see MoviePilot page / (TitlePage)
   */
  public function title() {
    if ($this->main_title == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_title = $this->page["Title"]->{'display_title'};
    }
    return $this->main_title;
  }

  /** Get year
   * @method year
   * @return string year
   * @see MoviePilot page / (TitlePage)
   */
  public function year () {
    if ($this->main_year == -1) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_year = $this->page["Title"]->{'production_year'};
    }
    return $this->main_year;
  }

  /** Get movie types (if any specified)
   * @method movieTypes
   * @return array [0..n] of strings (or empty array if no movie types specified)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. If <code>pilot_imdbfill</code> is
   *        set at least to BASIC_ACCESS, it will be retrieved from IMDB.
   */
  public function movieTypes() {
    if ($this->pilot_imdbfill) $this->main_movietypes = $this->imdb->movieTypes();
    return $this->main_movietypes;
  }

 #---------------------------------------------------------------[ Runtime ]---
  /** Get overall runtime (first one mentioned on title page)
   * @method runtime
   * @return mixed string runtime in minutes (if set), NULL otherwise
   * @see MoviePilot page / (TitlePage)
   */
  public function runtime() {
    if (empty($this->movieruntimes)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_runtime = $this->page["Title"]->{'runtime'};
    }
    if ($this->main_runtime) return $this->main_runtime;
    else return NULL;
  }

  /** Retrieve language specific runtimes
   * @method runtimes
   * @return array runtimes (array[0..n] of array[time,country,comment])
   * @see MoviePilot page / (TitlePage)
   * @version this is a fake
   */
  public function runtimes(){
    if (empty($this->movieruntimes)) {
      $country = $this->country();
      $runtime = $this->runtime();
      if ( empty($country[0]) || empty($runtime) ) return array();
      $this->movieruntimes[] = array("time"=>$runtime,"country"=>$country[0],"comment"=>"");
    }
    return $this->movieruntimes;
  }

 #----------------------------------------------------------[ Movie Rating ]---
  /** Get movie rating
   * @method rating
   * @return string rating current rating as given by MoviePilot site
   * @see MoviePilot page / (TitlePage)
   */
  public function rating () {
    if ($this->main_rating == -1) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_rating = $this->page["Title"]->{'average_community_rating'};
    }
    return $this->main_rating;
  }

  /** Return votes for this movie
   * @method votes
   * @return string votes count of votes for this movie
   * @see MoviePilot page / (TitlePage)
   * @version no data provided, so we fake some
   */
  public function votes () {
    return 1;
    //return $this->main_votes;
  }

 #------------------------------------------------------[ Movie Comment(s) ]---
  /** Get movie main comment (from title page)
   * @method comment
   * @return string comment full text of movie comment from the movies main page
   * @see MoviePilot page / (TitlePage)
   */
  public function comment() {
    if ($this->main_comment == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_comment = html_entity_decode($this->page["Title"]->{'long_description'});
    }
    return $this->main_comment;
  }

  /** Get movie main comment (from title page - split-up variant)
   * @method comment_split
   * @return array comment array[string title, string date, array author, string comment]; author: array[string url, string name]
   * @see MoviePilot page / (TitlePage)
   * @version not yet available
   */
  public function comment_split() {
    //$this->split_comment = array("title"=>$match[1],"date"=>$match[2],"author"=>array("url"=>$match[3],"name"=>$match[4]),"comment"=>trim($match[5]));
    return $this->split_comment;
  }

 #--------------------------------------------------------------[ Keywords ]---
  /** Get the keywords for the movie
   * @method keywords
   * @return array keywords
   * @see MoviePilot page / (TitlePage)
   */
  public function keywords () {
    if (empty($this->main_keywords)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_keywords = explode(",",$this->page["Title"]->{'plots_list'});
    }
    return $this->main_keywords;
  }

  /** Get the full keywords for the movie
   *  Just for compatibility with the IMDB class - result here is identical
   *  with pilot::keywords
   * @method keywords_all
   * @return array keywords
   * @see MoviePilot page / (TitlePage)
   */
  public function keywords_all() {
    return $this->keywords();
  }

 #--------------------------------------------------------[ Language Stuff ]---
  /** Get movies original language
   * @method language
   * @return string language
   * @brief There is not really a main language on the IMDB sites (yet), so this
   *  simply returns the first one
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; BASIC_ACCESS
   */
  public function language() {
    if ($this->pilot_imdbfill > BASIC_ACCESS) $this->main_language = $this->imdb->language();
    return $this->main_language;
  }

  /** Get all langauges this movie is available in
   * @method languages
   * @return array languages (array[0..n] of strings)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; BASIC_ACCESS
   */
  public function languages() {
    if ($this->pilot_imdbfill > BASIC_ACCESS) $this->langs = $this->imdb->languages();
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
   * @see MoviePilot page / (TitlePage)
   * @version does currently not match the IMDB genres (hopefully will in the future)
   */
  public function genre () {
   if (empty($this->main_genre)) {
    if (empty($this->moviegenres)) $genres = $this->genres();
    if (!empty($genres)) $this->main_genre = $this->moviegenres[0];
   }
   return $this->main_genre;
  }

  /** Get all genres the movie is registered for
   * @method genres
   * @return array genres (array[0..n] of strings)
   * @see MoviePilot page / (TitlePage)
   * @version does currently not match the IMDB genres (hopefully will in the future)
   */
  public function genres () {
    if (empty($this->moviegenres)) {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->moviegenres = explode(",",$this->page["Title"]->{'genres_list'});
    }
    return $this->moviegenres;
  }

 #----------------------------------------------------------[ Color format ]---
  /** Get colors
   * @method colors
   * @return array colors (array[0..1] of strings)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; BASIC_ACCESS
   */
  public function colors() {
    if ($this->pilot_imdbfill > BASIC_ACCESS) $this->moviecolors = $this->imdb->colors();
    return $this->moviecolors;
  }

 #---------------------------------------------------------------[ Creator ]---
  /** Get the creator of a movie (most likely for seasons only)
   * @method creator
   * @return array creator (array[0..n] of array[name,imdb])
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function creator() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->main_creator = $this->imdb->creator();
    return $this->main_creator;
  }

 #---------------------------------------------------------------[ Tagline ]---
  /** Get the main tagline for the movie
   * @method tagline
   * @return string tagline
   * @see MoviePilot page / (TitlePage)
   * @version no data available
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function tagline() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->main_tagline = $this->imdb->tagline();
    return $this->main_tagline;
  }

 #---------------------------------------------------------------[ Seasons ]---
  /** Get the number of seasons or 0 if not a series
   * @method seasons
   * @return int seasons number of seasons
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function seasons() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->seasoncount = $this->imdb->seasons();
    else return 0;
    return $this->seasoncount;
  }

 #--------------------------------------------------------[ Plot (Outline) ]---
  /** Get the main Plot outline for the movie
   * @method plotoutline
   * @return string plotoutline
   * @see MoviePilot page / (TitlePage)
   */
  public function plotoutline () {
    if ($this->main_plotoutline == "") {
      if ($this->page["Title"] == "") $this->openpage ("Title");
      $this->main_plotoutline = $this->page["Title"]->{'short_description'};
    }
    return $this->main_plotoutline;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Setup cover photo (thumbnail and big variant)
   * @method private thumbphoto
   * @return boolean success (TRUE if found, FALSE otherwise)
   * @see MoviePilot page / (TitlePage)
   */
  private function thumbphoto() {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    if ($this->page["Title"] == "cannot open page") return false; // no such page
    if (empty($this->page["Title"]->poster)) return false; // no pics
    $baseurl = $this->page["Title"]->poster->base_url.$this->page["Title"]->poster->photo_id."/"
             . $this->page["Title"]->poster->file_name_base;
    $this->main_photo = $baseurl.".".$this->page["Title"]->poster->extension;
    $this->main_thumb = $baseurl."_poster".".".$this->page["Title"]->poster->extension;;
    return true;
  }

  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (about 60x45px, default) or the
   *        original variant (FALSE).
   * @return mixed photo (string url if found, FALSE otherwise)
   * @see MoviePilot page / (TitlePage)
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
   * @param optional boolean thumb get the thumbnail (about 60x45px, default) or the
   *        original variant (FALSE)
   * @return boolean success
   * @see MoviePilot page / (TitlePage)
   */
  public function savephoto ($path,$thumb=true) {
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
   * @param optional boolean thumb get the thumbnail (about 60x45, default) or the
   *        original variant (FALSE)
   * @return mixed url (string URL or FALSE if none)
   * @see MoviePilot page / (TitlePage)
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
   *    <LI>imglink is the link to the <b><i>page</i></b> with the "big image" (empty here - just for compatibility with the imdb class)</LI>
   *    <LI>bigsrc is the URL of the "big size" image itself</LI>
   */
  public function mainPictures() {
    if ( empty($this->main_pictures) ) {
      if ( $this->page['Images'] == '' ) $this->openpage('Images');
      if ( $this->page['Images']->total_entries < 1 ) return array(); // no pics available
      for ($i=0;$i<$this->page['Images']->total_entries;++$i) {
        $baseurl = $this->page['Images']->images[$i]->base_url.$this->page['Images']->images[$i]->photo_id."/"
             . $this->page['Images']->images[$i]->file_name_base;
        $this->main_pictures[] = array('imgsrc'=>$baseurl."_poster.".$this->page['Images']->images[$i]->extension,'bigsrc'=>$baseurl.".".$this->page['Images']->images[$i]->extension,'imglink'=>'');
      }
    }
    return $this->main_pictures;
  }

 #-------------------------------------------------[ Country of Production ]---
  /** Get country of production
   * @method country
   * @return array country (array[0..n] of string)
   * @see MoviePilot page / (TitlePage)
   */
  public function country () {
    if ($this->page["Title"] == "") $this->openpage ("Title");
    $this->countries = explode(",",$this->page["Title"]->{'countries_list'});
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
   * @see MoviePilot page / (TitlePage)
   * @version no data available
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; BASIC_ACCESS
   */
  public function alsoknow() {
    if ($this->pilot_imdbfill > BASIC_ACCESS) $this->akas = $this->imdb->alsoknow();
    return $this->akas;
  }

 #---------------------------------------------------------[ Sound formats ]---
  /** Get sound formats
   * @method sound
   * @return array sound (array[0..n] of strings)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; BASIC_ACCESS
   */
  public function sound() {
    if ($this->pilot_imdbfill > BASIC_ACCESS) $this->sound = $this->imdb->sound();
    return $this->sound;
  }

 #-------------------------------------------------------[ MPAA / PG / FSK ]---
  /** Get the MPAA data (also known as PG or FSK)
   * @method mpaa
   * @return array mpaa (array[country]=rating)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> &gt; NO_ACCESS
   */
  public function mpaa() {
    if ($this->pilot_imdbfill) $this->mpaas = $this->imdb->mpaa();
    return $this->mpaas;
  }

  /** Get the MPAA data (also known as PG or FSK) - including historical data
   * @method mpaa_hist
   * @return array mpaa (array[country][0..n]=rating)
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function mpaa_hist() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->mpaas_hist = $this->imdb->mpaa_hist();
    return $this->mpaas_hist;
  }

 #----------------------------------------------------[ MPAA justification ]---
  /** Find out the reason for the MPAA rating
   * @method mpaa_reason
   * @return string reason why the movie was rated such
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function mpaa_reason() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->mpaa_justification = $this->imdb->mpaa_reason();
    return $this->mpaa_justification;
  }

 #------------------------------------------------------[ Production Notes ]---
  /** For not-yet completed movies, we can get the production state
   * @method prodNotes
   * @returns array production notes [status,statnote,lastupdate[day,month,mon,year],more,note]
   * @see MoviePilot page / (TitlePage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function prodNotes() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->main_prodnotes = $this->imdb->prodNotes();
    return $this->main_prodnotes;
  }

 #----------------------------------------------[ Position in the "Top250" ]---
  /** Find the position of a movie in the top 250 ranked movies
   * @method top250
   * @return int position a number between 1..250 if the movie is listed, 0 otherwise
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function top250() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->main_top250 = $this->imdb->top250();
    return $this->main_top250;
  }


 #--------------------------------------------------[ Full Plot (combined) ]---
  /** Get the movies plot(s)
   * @method plot
   * @return array plot (array[0..n] of strings)
   * @see MoviePilot page (Titlepage)
   * @brief No data available at MoviePilot. If
   *        <code>pilot_imdbfill</code> is set to FULL_ACCESS, we
   *        will automatically retrieve this data from the IMDB site configured.
   *        Otherwise we fake some data using <code>pilot::plotoutline()</code>,
   *        resulting in a single record (if any) available there.
   */
  public function plot() {
    if (empty($this->plot_plot)) {
      if ($this->pilot_imdbfill==FULL_ACCESS) $this->plot_plot = $this->imdb->plot();
      else $this->plot_plot[0] = $this->plotoutline();
    }
    return $this->plot_plot;
  }

 #-----------------------------------------------------[ Full Plot (split) ]---
  /** Get the movie plot(s) - split-up variant
   * @method plot_split
   * @return array array[0..n] of array[string plot,array author] - where author consists of string name and string url
   * @see MoviePilot page (Titlepage)
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function plot_split() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->split_plot = $this->imdb->plot_split();
    return $this->split_plot;
  }

 #========================================================[ /synopsis page ]===
 #---------------------------------------------------------[ Full Synopsis ]---
  /** Get the movies synopsis
   * @method synopsis
   * @return string synopsis
   * @see MoviePilot page /synopsis
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function synopsis() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->synopsis_wiki = $this->imdb->synopsis();
    return $this->synopsis_wiki;
  }

 #========================================================[ /taglines page ]===
 #--------------------------------------------------------[ Taglines Array ]---
  /** Get all available taglines for the movie
   * @method taglines
   * @return array taglines (array[0..n] of strings)
   * @see MoviePilot page /taglines
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function taglines() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->taglines = $this->imdb->taglines();
    return $this->taglines;
  }

 #=====================================================[ /fullcredits page ]===
 #---------------------------------------------[ Helper: Get the cast list ]---
  /** Obtain all cast data
   * @method private castlist
   */
  private function castlist() {
    if (empty($this->castlist)) {
      if (empty($this->page["Credits"])) $this->openpage("Credits");
      foreach(array("actor","soundtrack","director","screenplay","production") as $function) $this->castlist[$function] = array(); // fill the important ones
      if ($this->page["Credits"] == "cannot open page") return $this->castlist; // no such page
      //$this->page["Credits"]->{'total_entries'} equals count($this->page["Credits"]->{'movies_people'})
      if (is_array($this->page["Credits"]->{'movies_people'})) foreach($this->page["Credits"]->{'movies_people'} as $person) {
        $function = preg_replace('|.*/(.*?)$|','$1',$person->{'function_restful_url'});
	$person->person->character = $person->character;
	$this->castlist[$function][] = $person->person;
#	echo "$function\n";
      }
    }
  }

 #------------------------------------------[ Check IMDB ID ]---
  /** Create a valid IMDBID
   * @method private mid
   * @param string input value to check
   * @return string imdbid either valid IMDBID (7 digit), or empty string
   */
  private function mid($str) {
    if ( empty($str) ) return $str;
    return str_pad($str,7,'0',STR_PAD_LEFT);
  }

 #-------------------------------------------------------------[ Directors ]---
  /** Get the director(s) of the movie
   * @method director
   * @return array director (array[0..n] of arrays[imdb,name,role])
   * @see MoviePilot page /fullcredits
   */
  public function director() {
    if (empty($this->credits_director)) $this->castlist();
    $this->credits_director = array();
    foreach ($this->castlist["director"] as $person) {
      $this->credits_director[] = array("imdb"=>$this->mid($person->alternative_identifiers->imdb),"name"=>$person->first_name." ".$person->last_name,"role"=>$person->character);
    }
    return $this->credits_director;
  }

 #----------------------------------------------------------------[ Actors ]---
  /** Get the actors
   * @method cast
   * @return array cast (array[0..n] of arrays[imdb,name,role,thumb,photo])
   * @see MoviePilot page /fullcredits
   */
  public function cast() {
    if (empty($this->credits_cast)) $this->castlist();
    $this->credits_cast = array();
    foreach ($this->castlist["actor"] as $person) {
      $this->credits_cast[] = array("imdb"=>$this->mid($person->alternative_identifiers->imdb),"name"=>$person->first_name." ".$person->last_name,"role"=>$person->character);
    }
    return $this->credits_cast;
  }

 #---------------------------------------------------------------[ Writers ]---
  /** Get the writer(s)
   * @method writing
   * @return array writers (array[0..n] of arrays[imdb,name,role])
   * @see MoviePilot page /fullcredits
   */
  public function writing() {
    if (empty($this->credits_writing)) $this->castlist();
    $this->credits_writing = array();
    foreach ($this->castlist["screenplay"] as $person) {
      $this->credits_writing[] = array("imdb"=>$this->mid($person->alternative_identifiers->imdb),"name"=>$person->first_name." ".$person->last_name,"role"=>$person->character);
    }
    return $this->credits_writing;
  }

 #-------------------------------------------------------------[ Producers ]---
  /** Obtain the producer(s)
   * @method producer
   * @return array producer (array[0..n] of arrays[imdb,name,role])
   * @see MoviePilot page /fullcredits
   */
  public function producer() {
    if (empty($this->credits_producer)) $this->castlist();
    $this->credits_producer = array();
    foreach ($this->castlist["production"] as $person) {
      $this->credits_producer[] = array("imdb"=>$this->mid($person->alternative_identifiers->imdb),"name"=>$person->first_name." ".$person->last_name,"role"=>$person->character);
    }
    return $this->credits_producer;
  }

 #-------------------------------------------------------------[ Composers ]---
  /** Obtain the composer(s) ("Original Music by...")
   * @method composer
   * @return array composer (array[0..n] of arrays[imdb,name,role])
   * @see MoviePilot page /fullcredits
   */
  public function composer() {
    if (empty($this->credits_composer)) $this->castlist();
    $this->credits_composer = array();
    foreach ($this->castlist["soundtrack"] as $person) {
      $this->credits_composer[] = array("imdb"=>$this->mid($person->alternative_identifiers->imdb),"name"=>$person->first_name." ".$person->last_name,"role"=>$person->character);
    }
    return $this->credits_composer;
  }

 #====================================================[ /crazycredits page ]===
 #----------------------------------------------------[ CrazyCredits Array ]---
  /** Get the Crazy Credits
   * @method crazy_credits
   * @return array crazy_credits (array[0..n] of string)
   * @see MoviePilot page /crazycredits
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function crazy_credits() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->crazy_credits = $this->imdb->crazy_credits();
    return $this->crazy_credits;
  }

 #========================================================[ /episodes page ]===
 #--------------------------------------------------------[ Episodes Array ]---
  /** Get the series episode(s)
   * @method episodes
   * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot])
   * @see MoviePilot page /episodes
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function episodes() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->season_episodes = $this->imdb->episodes();
    return $this->season_episodes;
  }

 #===========================================================[ /goofs page ]===
 #-----------------------------------------------------------[ Goofs Array ]---
  /** Get the goofs
   * @method goofs
   * @return array goofs (array[0..n] of array[type,content]
   * @see MoviePilot page /goofs
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function goofs() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->goofs = $this->imdb->goofs();
    return $this->goofs;
  }

 #==========================================================[ /quotes page ]===
 #----------------------------------------------------------[ Quotes Array ]---
  /** Get the quotes for a given movie
   * @method quotes
   * @return array quotes (array[0..n] of string)
   * @see MoviePilot page /quotes
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function quotes() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->moviequotes = $this->imdb->quotes();
    return $this->moviequotes;
  }

 #========================================================[ /trailers page ]===
 #--------------------------------------------------------[ Trailers Array ]---
  /** Get the trailer URLs for a given movie
   * @method trailers
   * @param optional boolean full Retrieve all available data (TRUE), or stay compatible with previous IMDBPHP versions (FALSE, Default)
   * @return mixed trailers either array[0..n] of string ($full=FALSE), or array[0..n] of array[lang,title,url,restful_url ($full=TRUE)
   * @see MoviePilot page /trailers
   */
  public function trailers($full=FALSE) {
    if ( empty($this->trailers) ) {
      if (empty($this->page["Trailers"])) $this->openpage("Trailers");
      foreach ($this->page["Trailers"] as $trailer) {
        if ($full) {
          $this->trailers[] = array("lang"=>$trailer->language,"title"=>$trailer->title,"url"=>$trailer->url,"restful_url"=>$trailer->restful_url);
        } else {
          $this->trailers[] = $trailer->url;
        }
      }
    }
    return $this->trailers;
  }

 #===========================================================[ /videosites ]===
 #------------------------------------------[ Off-site trailers and videos ]---
  /** Get the off-site videos and trailer URLs
   * @method videosites
   * @see IMDB page /videosites
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function videosites() {
    if ($this->pilot_imdbfill==FULL_ACCESS) return $this->imdb->videosites();
  }

 #==========================================================[ /trivia page ]===
 #----------------------------------------------------------[ Trivia Array ]---
  /** Get the trivia info
   * @method trivia
   * @return array trivia (array[0..n] string
   * @see MoviePilot page /trivia
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function trivia() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->trivia = $this->imdb->trivia();
    return $this->trivia;
  }

 #======================================================[ /soundtrack page ]===
 #------------------------------------------------------[ Soundtrack Array ]---
  /** Get the soundtrack listing
   * @method soundtrack
   * @return array soundtracks (array[0..n] of array(soundtrack,array[0..n] of credits)
   * @brief Usually, the credits array should hold [0] written by, [1] performed by.
   *  But IMDB does not always stick to that - so in many cases it holds
   *  [0] performed by, [1] courtesy of<BR>
   *        No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   * @see MoviePilot page /soundtrack
   */
  public function soundtrack() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->soundtracks = $this->imdb->soundtrack();
    return $this->soundtracks;
  }

 #=================================================[ /movieconnection page ]===
 #-------------------------------------------------[ MovieConnection Array ]---
  /** Get connected movie information
   * @method movieconnection
   * @return array connections (versionOf, editedInto, followedBy, spinOff,
   *         spinOffFrom, references, referenced, features, featured, spoofs,
   *         spoofed - each an array of mid, name, year, comment or an empty
   *         array if no connections of that type)
   * @see MoviePilot page /movieconnection
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function movieconnection() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->movieconnections = $this->imdb->movieconnection();
    elseif (empty($this->movieconnections)) {
#      if (empty($this->page["MovieConnections"])) $this->openpage("MovieConnections");
#      if ($this->page["MovieConnections"] == "cannot open page") return array(); // no such page
      $this->movieconnections["versionOf"]   = array();
      $this->movieconnections["editedInto"]  = array();
      $this->movieconnections["followedBy"]  = array();
      $this->movieconnections["spinOffFrom"] = array();
      $this->movieconnections["spinOff"]     = array();
      $this->movieconnections["references"]  = array();
      $this->movieconnections["referenced"]  = array();
      $this->movieconnections["features"]    = array();
      $this->movieconnections["featured"]    = array();
      $this->movieconnections["spoofs"]      = array();
      $this->movieconnections["spoofed"]     = array();
    }
    return $this->movieconnections;
  }

 #=================================================[ /externalreviews page ]===
 #-------------------------------------------------[ ExternalReviews Array ]---
  /** Get list of external reviews (if any)
   * @method extReviews
   * @return array [0..n] of array [url, desc] (or empty array if no data)
   * @see MoviePilot page /externalreviews
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function extReviews() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->extreviews = $this->imdb->extReviews();
    return $this->extreviews;
  }

 #=====================================================[ /releaseinfo page ]===
 #-----------------------------------------------------[ ReleaseInfo Array ]---
  /** Obtain Release Info (if any)
   * @method releaseInfo
   * @return array release_info array[0..n] of strings (country,day,month,mon,
             year,comment) - "month" is the month name, "mon" the number
   * @see MoviePilot page (Titlepage)
   * @version no complete data available
   */
  public function releaseInfo() {
    if (empty($this->release_info)) {
      if (empty($this->page["Title"])) $this->openpage("Title");
      if ($this->page["Title"] == "cannot open page") return array(); // no such page
      $country = $this->country();
      preg_match('|^(\d+).(\d+).(\d+)$|',$this->page["Title"]->{'premiere_date'},$match);
      $m = array_flip($this->months);
      $this->release_info[0] = array("country"=>$country[0],"day"=>$match[3],"month"=>$m[$match[2]],"mon"=>$match[2],"year"=>$match[1],"comment"=>"");
    }
    return $this->release_info;
  }

 #==================================================[ /companycredits page ]===
 #---------------------------------------------------[ Producing Companies ]---
  /** Info about Production Companies
   * @method prodCompany
   * @return array [0..n] of array (name,url,notes)
   * @see MoviePilot page /companycredits
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function prodCompany() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->compcred_prod = $this->imdb->prodCompany();
    return $this->compcred_prod;
  }

 #------------------------------------------------[ Distributing Companies ]---
  /** Info about distributors
   * @method distCompany
   * @return array [0..n] of array (name,url,notes)
   * @see MoviePilot page /companycredits
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function distCompany() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->compcred_dist = $this->imdb->distCompany();
    return $this->compcred_dist;
  }

 #---------------------------------------------[ Special Effects Companies ]---
  /** Info about Special Effects companies
   * @method specialCompany
   * @return array [0..n] of array (name,url,notes)
   * @see MoviePilot page /companycredits
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function specialCompany() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->compcred_special = $this->imdb->specialCompany();
    return $this->compcred_special;
  }

 #-------------------------------------------------------[ Other Companies ]---
  /** Info about other companies
   * @method otherCompany
   * @return array [0..n] of array (name,url,notes)
   * @see MoviePilot page /companycredits
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function otherCompany() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->compcred_other = $this->imdb->otherCompany();
    return $this->compcred_other;
  }

 #===================================================[ /parentalguide page ]===
 #-------------------------------------------------[ ParentalGuide Details ]---
  /** Detailed Parental Guide
   * @method parentalGuide
   * @return array of strings; keys: Alcohol, Sex, Violence, Profanity,
   *         Frightening - and maybe more; values: arguments for the rating
   * @see MoviePilot page /parentalguide
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function parentalGuide() {
    if ($this->pilot_imdbfill==FULL_ACCESS) $this->parental_guide = $this->imdb->parentalGuide();
    return $this->parental_guide;
  }

 #===================================================[ /officialsites page ]===
 #---------------------------------------------------[ Official Sites URLs ]---
  /** URLs of Official Sites
   * @method officialSites
   * @return array [0..n] of url, name
   * @see MoviePilot page (Title)
   * @version no complete data available here, but we can get the homepage
   */
  public function officialSites() {
    if (empty($this->official_sites)) {
      if (empty($this->page["Title"])) $this->openpage("Title");
      if ($this->page["Title"] == "cannot open page") return array(); // no such page
      $this->official_sites = array();
      if (!empty($this->page["Title"]->homepage))
        $this->official_sites[] = array("url"=>$this->page["Title"]->homepage,"name"=>"Homepage");
      if (!empty($this->page["Title"]->alternative_identifiers->imdb))
        $this->official_sites[] = array("url"=>"http://www.imdb.com/title/tt".str_pad($this->page["Title"]->alternative_identifiers->imdb,7,"0",STR_PAD_LEFT)."/","name"=>"IMDB");
      if (!empty($this->page["Title"]->alternative_identifiers->omdb))
        $this->official_sites[] = array("url"=>"http://www.omdb.org/movie/".$this->page["Title"]->alternative_identifiers->omdb,"name"=>"OMDB");
      if (!empty($this->page["Title"]->alternative_identifiers->zelluloid))
        $this->official_sites[] = array("url"=>"http://www.zelluloid.de/filme/index.php3?id=".$this->page["Title"]->alternative_identifiers->zelluloid,"name"=>"Zelluloid");
      if (!empty($this->page["Title"]->alternative_identifiers->amazon)) $this->official_sites[] = array("url"=>"http://www.amazon.com/dp/".$this->page["Title"]->alternative_identifiers->amazon."/","name"=>"Amazon");
    }
    return $this->official_sites;
  }

  #========================================================[ /awards page ]===
  #--------------------------------------------------------------[ Awards ]---
  /** Get the complete awards for the movie
   * @method awards
   * @return array awards array[festivalName]['entries'][0..n] of array[year,won,category,award,people]
   * @see IMDB page /awards
   * @brief No data available at MoviePilot. AutoRetrieval from IMDB with
   *        <code>pilot_imdbfill</code> set to FULL_ACCESS
   */
  public function awards() {
    if ($this->pilot_imdbfill==FULL_ACCESS) return $this->imdb->awards();
  }


 } // end class pilot

?>
