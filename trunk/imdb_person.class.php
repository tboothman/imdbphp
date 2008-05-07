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

 #=================================================[ The IMDB Person class ]===
 /** Accessing IMDB staff information
  * @package Api
  * @class imdb_person
  * @extends imdb_base
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright 2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision: 114 $ $Date: 2008-05-07 13:12:10 +0200 (Mi, 07 Mai 2008) $
  */
 class imdb_person extends imdb_base {

 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method private set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  function set_pagename($wt) {
   switch ($wt){
    case "Name"        : $urlname="/"; break;
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
   $this->page["Name"] = "";

   $this->main_photo      = "";
   $this->fullname        = "";
   $this->birthday        = array();
   $this->actorsfilms     = array();
   $this->producersfilms  = array();
   $this->soundtrackfilms = array();
   $this->directorsfilms  = array();
   $this->crewsfilms      = array();
   $this->thanxfilms      = array();
   $this->selffilms       = array();
   $this->archivefilms    = array();
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor imdb_person
   * @param string id IMDBID to use for data retrieval
   */
  function imdb_person ($id) {
   $this->imdb_base($id);
  }

 #-----------------------------------------------[ URL to person main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  function main_url(){
   return "http://".$this->imdbsite."/name/nm".$this->imdbid()."/";
  }

 #------------------------------------------------------------------[ Name ]---
  /** Get the name of the person
   * @method name
   * @return string name full name of the person
   */
  function name() {
    if (empty($this->fullname)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match("/<title>(.*?)<\/title>/i",$this->page["Name"],$match)) {
        $this->fullname = trim($match[1]);
      }
    }
    return $this->fullname;
  }

 #------------------------------------------------------------------[ Born ]---
  /** Get Birthday
   * @method born
   * @return array birthdate [day,month.year,place]
   */
  function born() {
    if (empty($this->birthday)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match("/Date of Birth:<\/h5>\s*<a href=\"\/OnThisDay\?day\=(\d{1,2})&month\=(.*?)\">.*?<a href\=\"\/BornInYear\?(\d{4}).*?href\=\"\/BornWhere\?.*?\">(.*?)<\/a>/ms",$this->page["Name"],$match))
        $this->birthday = array("day"=>$match[1],"month"=>$match[2],"year"=>$match[3],"place"=>$match[4]);
    }
    return $this->birthday;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return mixed photo (string url if found, FALSE otherwise)
   */
  function photo($thumb=true) {
    if (empty($this->main_photo)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match('/\<a name="headshot".+"(http:\/\/.+\.jpg)".+<\/a>/',$this->page["Name"],$match)) {
        if ($thumb) $this->main_photo = $match[1];
        else        $this->main_photo = str_replace('_SY140_SX100', '_SY600_SX400',$match[1]);
      } else {
        return FALSE;
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
  /** Get filmography
   * @method private filmograf
   * @param ref array where to store the filmography
   * @param string type Which filmografie to retrieve ("actor",)
   */
  function filmograf(&$res,$type) {
    if ($this->page["Name"] == "") $this->openpage ("Name","person");
    if (preg_match("/<a name=\"$type\"(.*?)<\/div>/msi",$this->page["Name"],$match)) {
      if (preg_match_all("/<a(.*?)href=\"\/title\/tt(\d{7})\/\">(.*?)<\/a>\s*(\((\d{4})\)|)([^<]*?\.\.\.\.\s*<a href=\"\/character\/ch(\d{7})\/\">(.*?)<\/a>|([^<]*?|\s*<small>.*?<\/small>\s*)\.\.\.\.\s*(.*?)\s*<|)/i",$match[1],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          if (empty($matches[8][$i])) $matches[8][$i] = $matches[10][$i];
          $res[] = array("mid"=>$matches[2][$i],"name"=>$matches[3][$i],"year"=>$matches[5][$i],"chid"=>$matches[7][$i],"chname"=>$matches[8][$i]);
        }
      }
    }
  }

  /** Get actors filmography
   * @method movies_actor
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   */
  function movies_actor() {
    if (empty($this->actorsfilms)) $this->filmograf($this->actorsfilms,"actor");
    return $this->actorsfilms;
  }

  /** Get producers filmography
   * @method movies_producer
   * @return array array[0..n][mid,name,year]
   */
  function movies_producer() {
    if (empty($this->producersfilms)) $this->filmograf($this->producersfilms,"producer");
    return $this->producersfilms;
  }

  /** Get directors filmography
   * @method movies_director
   * @return array array[0..n][mid,name,year]
   */
  function movies_director() {
    if (empty($this->directorsfilms)) $this->filmograf($this->directorsfilms,"director");
    return $this->directorsfilms;
  }

  /** Get soundtrack filmography
   * @method movies_soundtrack
   * @return array array[0..n][mid,name,year]
   */
  function movies_soundtrack() {
    if (empty($this->soundtrackfilms)) $this->filmograf($this->soundtrackfilms,"soundtrack");
    return $this->soundtrackfilms;
  }

  /** Get "Misc Crew" filmography
   * @method movies_crew
   * @return array array[0..n][mid,name,year]
   */
  function movies_crew() {
    if (empty($this->crewsfilms)) $this->filmograf($this->crewsfilms,"miscellaneousX20crew");
    return $this->crewsfilms;
  }

  /** Get "Thanx" filmography
   * @method movies_thanx
   * @return array array[0..n][mid,name,year]
   */
  function movies_thanx() {
    if (empty($this->thanxfilms)) $this->filmograf($this->thanxfilms,"thanks");
    return $this->thanxfilms;
  }

  /** Get "Self" filmography
   * @method movies_self
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   */
  function movies_self() {
    if (empty($this->selffilms)) $this->filmograf($this->selffilms,"self");
    return $this->selffilms;
  }

  /** Get "Archive Footage" filmography
   * @method movies_archive
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   */
  function movies_archive() {
    if (empty($this->archivefilms)) $this->filmograf($this->archivefilms,"archive");
    return $this->archivefilms;
  }

 } // end class imdb_person

?>
