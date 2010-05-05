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

 #=================================================[ The IMDB Person class ]===
 /** Accessing IMDB staff information
  * @package IMDB
  * @class imdb_person
  * @extends mdb_base
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright 2008 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdb_person extends person_base {

 #========================================================[ Common methods ]===
 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method protected set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  protected function set_pagename($wt) {
   switch ($wt){
    case "Name"        : $urlname="/"; break;
    case "Bio"         : $urlname="/bio"; break;
    case "Publicity"   : $urlname="/publicity"; break;
    default            :
      $this->page[$wt] = "unknown page identifier";
      $this->debug_scalar("Unknown page identifier: $wt");
      return false;
   }
   return $urlname;
  }

 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor imdb_person
   * @param string id IMDBID to use for data retrieval
   */
  function __construct($id) {
    parent::__construct($id);
    $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
    $this->setid($id);
  }

 #-----------------------------------------------[ URL to person main page ]---
  /** Set up the URL to the movie title page
   * @method main_url
   * @return string url full URL to the current movies main page
   */
  public function main_url(){
   return "http://".$this->imdbsite."/name/nm".$this->imdbid()."/";
  }

 #=============================================================[ Main Page ]===
 #------------------------------------------------------------------[ Name ]---
  /** Get the name of the person
   * @method name
   * @return string name full name of the person
   * @see IMDB person page / (Main page)
   */
  public function name() {
    if (empty($this->fullname)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match("/<title>(.*?)<\/title>/i",$this->page["Name"],$match)) {
        $this->fullname = trim($match[1]);
      }
    }
    return $this->fullname;
  }

 #--------------------------------------------------------[ Photo specific ]---
  /** Get cover photo
   * @method photo
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
   * @return mixed photo (string url if found, FALSE otherwise)
   * @see IMDB person page / (Main page)
   */
  public function photo($thumb=true) {
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
   * @see IMDB person page / (Main page)
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
   * @param optional boolean thumb get the thumbnail (100x140, default) or the
   *        bigger variant (400x600 - FALSE)
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
  /** Get filmography
   * @method private filmograf
   * @param ref array where to store the filmography
   * @param string type Which filmografie to retrieve ("actor",)
   */
  private function filmograf(&$res,$type) {
    if ($this->page["Name"] == "") $this->openpage ("Name","person");
    if (preg_match("/<a name=\"$type\"(.*?)<\/div>/msi",$this->page["Name"],$match) || empty($type)) {
      if (empty($type)) $match[1] = $this->page["Name"];
      else $match[1] = str_replace("</li><li>","</li>\n<li>",$match[1]); // *!* ugly workaround for long lists, see Sly (mid=0000230)
      if (preg_match_all('!<a(.*?)href="/title/tt(\d{7})/"[^>]*>(.*?)</a>(.*?)<(/li|br)>!ims',$match[1],$matches)) {
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          preg_match('|^\s*\((\d{4})\)|',$matches[4][$i],$year);
          $str = $matches[4][$i]; //preg_replace('|\(\d{4}\)|','',substr($matches[4][$i],0,strpos($matches[4][$i],"<br>")));
	  if ( preg_match('|<a .*href\=\"/character/ch(\d{7})\/\">(.*?)<\/a>|i',$str,$char) ) {
	    $chid   = $char[1];
	    $chname = $char[2];
	  } else {
	    $chid   = '';
	    if ( preg_match('|\.\.\.\. ([^>]+)|',$str,$char) ) $chname = $char[1];
	    else $chname = '';
	  }
	  if ( empty($chname) ) {
	    switch($type) {
	      case 'director' : $chname = 'Director'; break;
	      case 'producer' : $chname = 'Producer'; break;
	    }
	  }
          $res[] = array("mid"=>$matches[2][$i],"name"=>$matches[3][$i],"year"=>$year[1],"chid"=>$chid,"chname"=>$chname,"addons"=>$addons[1]);
        }
      }
    }
  }

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
   */
  public function movies_all() {
    if (empty($this->allfilms)) $this->filmograf($this->allfilms,"");
    return $this->allfilms;
  }

  /** Get actress filmography
   * @method movies_actress
   * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
   *         the character IMDB ID, chname the character name, and addons an
   *         array of additional remarks (the things in parenthesis)
   * @see IMDB person page / (Main page)
   */
  public function movies_actress() {
     if (empty($this->actressfilms)) $this->filmograf($this->actressfilms,"actress");
     return $this->actressfilms;
   }

  /** Get actors filmography
   * @method movies_actor
   * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
   *         the character IMDB ID, chname the character name, and addons an
   *         array of additional remarks (the things in parenthesis)
   * @see IMDB person page / (Main page)
   */
  public function movies_actor() {
    if (empty($this->actorsfilms)) $this->filmograf($this->actorsfilms,"actor");
    return $this->actorsfilms;
  }

  /** Get producers filmography
   * @method movies_producer
   * @return array array[0..n][mid,name,year,chid,chname,addons], where chid is
   *         the character IMDB ID, chname the character name, and addons an
   *         array of additional remarks (the things in parenthesis)
   * @see IMDB person page / (Main page)
   */
  public function movies_producer() {
    if (empty($this->producersfilms)) $this->filmograf($this->producersfilms,"producer");
    return $this->producersfilms;
  }

  /** Get directors filmography
   * @method movies_director
   * @return array array[0..n][mid,name,year]
   * @see IMDB person page / (Main page)
   */
  public function movies_director() {
    if (empty($this->directorsfilms)) $this->filmograf($this->directorsfilms,"director");
    return $this->directorsfilms;
  }

  /** Get soundtrack filmography
   * @method movies_soundtrack
   * @return array array[0..n][mid,name,year]
   * @see IMDB person page / (Main page)
   */
  public function movies_soundtrack() {
    if (empty($this->soundtrackfilms)) $this->filmograf($this->soundtrackfilms,"soundtrack");
    return $this->soundtrackfilms;
  }

  /** Get "Misc Crew" filmography
   * @method movies_crew
   * @return array array[0..n][mid,name,year]
   * @see IMDB person page / (Main page)
   */
  public function movies_crew() {
    if (empty($this->crewsfilms)) $this->filmograf($this->crewsfilms,"miscellaneousX20crew");
    return $this->crewsfilms;
  }

  /** Get "Thanx" filmography
   * @method movies_thanx
   * @return array array[0..n][mid,name,year]
   * @see IMDB person page / (Main page)
   */
  public function movies_thanx() {
    if (empty($this->thanxfilms)) $this->filmograf($this->thanxfilms,"thanks");
    return $this->thanxfilms;
  }

  /** Get "Self" filmography
   * @method movies_self
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   * @see IMDB person page / (Main page)
   */
  public function movies_self() {
    if (empty($this->selffilms)) $this->filmograf($this->selffilms,"self");
    return $this->selffilms;
  }

  /** Get writers filmography
   * @method movies_writer
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   * @see IMDB person page / (Main page)
   */
  public function movies_writer() {
    if (empty($this->writerfilms)) $this->filmograf($this->writerfilms,"writer");
    return $this->writerfilms;
  }

  /** Get "Archive Footage" filmography
   * @method movies_archive
   * @return array array[0..n][mid,name,year,chid,chname], where chid is the
   *         character IMDB ID, and chname the character name
   * @see IMDB person page / (Main page)
   */
  public function movies_archive() {
    if (empty($this->archivefilms)) $this->filmograf($this->archivefilms,"archive");
    return $this->archivefilms;
  }

 #==================================================================[ /bio ]===
 #------------------------------------------------------------[ Birth Name ]---
 /** Get the birth name
  * @method birthname
  * @return string birthname
  * @see IMDB person page /bio
  */
 public function birthname() {
   if (empty($this->birth_name)) {
    if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
    if (preg_match("/Birth Name<\/h5>\s*\n(.*?)\n/m",$this->page["Bio"],$match))
      $this->birth_name = trim($match[1]);
   }
   return $this->birth_name;
 }

 #-------------------------------------------------------------[ Nick Name ]---
 /** Get the nick name
  * @method nickname
  * @return array nicknames array[0..n] of strings
  * @see IMDB person page /bio
  */
 public function nickname() {
   if (empty($this->nick_name)) {
    if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
    if (preg_match("/Nickname<\/h5>\s*\n(.*?)\n<h5>/ms",$this->page["Bio"],$match)) {
      $nicks = explode("<br/>",$match[1]);
      foreach ($nicks as $nick) {
        $nick = trim($nick);
        if (!empty($nick)) $this->nick_name[] = $nick;
      }
    }
   }
   return $this->nick_name;
 }

 #------------------------------------------------------------------[ Born ]---
  /** Get Birthday
   * @method born
   * @return array birthday [day,month,mon,year,place]
   *         where month is the month name, and mon the month number
   * @see IMDB person page /bio
   */
  public function born() {
    if (empty($this->birthday)) {
      if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
      if ( preg_match('|Date of Birth</h5>\s*(.*)<br|iUms',$this->page["Bio"],$match) ) {
        preg_match('|/date/(\d+)-(\d+)/.*?>\d+\s+(.*?)<|',$match[1],$daymon);
        preg_match('|/search/name\?birth_year=(\d{4})|ims',$match[1],$dyear);
        preg_match('|/search/name\?birth_place=.*?">(.*)<|ims',$match[1],$dloc);
        $this->birthday = array("day"=>$daymon[2],"month"=>$daymon[3],"mon"=>$daymon[1],"year"=>$dyear[1],"place"=>$dloc[1]);
      }
    }
    return $this->birthday;
  }

 #------------------------------------------------------------------[ Died ]---
  /** Get Deathday
   * @method died
   * @return array deathday [day,month.mon,year,place,cause]
   *         where month is the month name, and mon the month number
   * @see IMDB person page /bio
   */
  public function died() {
    if (empty($this->deathday)) {
      if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
      if (preg_match('|Date of Death</h5>(.*)<br|iUms',$this->page["Bio"],$match)) {
        preg_match('|/date/(\d+)-(\d+)/.*?>\d+\s+(.*?)<|',$match[1],$daymon);
	preg_match('|/search/name\?death_date=(\d{4})|ims',$match[1],$dyear);
	preg_match('/(\,\s*([^\(]+))/ims',$match[1],$dloc);
	preg_match('/\(([^\)]+)\)/ims',$match[1],$dcause);
        $this->deathday = array("day"=>$daymon[2],"month"=>$daymon[3],"mon"=>$daymon[1],"year"=>$dyear[1],"place"=>$dloc[2],"cause"=>$dcause[1]);
      }
    }
    return $this->deathday;
  }

 #-----------------------------------------------------------[ Body Height ]---
 /** Get the body height
  * @method height
  * @return array [imperial,metric] height in feet and inch (imperial) an meters (metric)
  * @see IMDB person page /bio
  */
 public function height() {
   if (empty($this->bodyheight)) {
    if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
    if (preg_match("/Height<\/h5>\s*\n(.*?)\s*\((.*?)\)/m",$this->page["Bio"],$match)) {
      $this->bodyheight["imperial"] = trim($match[1]);
      $this->bodyheight["metric"] = trim($match[2]);
    }
   }
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
  */
 public function spouse() {
   if (empty($this->spouses)) {
     if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
     $pos_s = strpos($this->page["Bio"],"<h5>Spouse</h5>");
     if (!$pos_s) return $this->spouses;
     $pos_e = strpos($this->page["Bio"],"</table>",$pos_s);
     $block = substr($this->page["Bio"],$pos_s,$pos_e - $pos_s +8);
     if (@preg_match_all("/<tr>.*?<td.*?>(.*?)<\/td>.*?<td.*?>(.*?)<\/td>/ms",$block,$matches)) { // table lines
       $mc = count($matches[0]);
       for ($i=0;$i<$mc;++$i) {
         unset($tmp);
         if (preg_match("/href\=\"\/name\/nm(\d{7})\/\">(.*?)<\/a>/i",$matches[1][$i],$match)) { // col#1: MID + name
           $tmp["imdb"] = trim($match[1]);
           $tmp["name"] = trim($match[2]);
         } else {
           $tmp["name"] = trim($matches[1][$i]);
         }
#         if (preg_match("/href\=\"\/OnThisDay\?day\=(\d{1,2}).{1,5}month\=(.*?)\".*\"\/MarriedInYear\?(\d{4})\"/",$matches[2][$i],$match)) { // col#2: date (from)
#         if (preg_match("/href\=\"\/OnThisDay\?day\=(\d{1,2}).{1,5}month\=(.*?)\".*\"\/MarriedInYear\?(\d{4})\">\d{4}<\/a>(.* href\=\"\/OnThisDay\?day=(\d{1,2}).{1,5}month=(.*?)\".*<\/a>\s*(\d{4})|)/",$matches[2][$i],$match)) { // col#2: date from + to
#         if (preg_match("/href\=\"\/OnThisDay\?day\=(\d{1,2}).{1,5}month\=(.*?)\".*\"\/MarriedInYear\?(\d{4})\">\d{4}<\/a>(.* href\=\"\/OnThisDay\?day=(\d{1,2}).{1,5}month=(.*?)\".*<\/a>\s*(\d{4})\)|)\s*\((.*?)\)/",$matches[2][$i],$match)) { // col#2: date, comment
         if (preg_match("/href\=\"\/OnThisDay\?day\=(\d{1,2}).{1,5}month\=(.*?)\".*\"\/MarriedInYear\?(\d{4})\">\d{4}<\/a>(.* href\=\"\/OnThisDay\?day=(\d{1,2}).{1,5}month=(.*?)\".*<\/a>\s*(\d{4})\)|)\s*\((.*?)\)(\s*(\d+) child|)/",$matches[2][$i],$match)) { // col#2: date, children
           $tmp["from"] = array("day"=>$match[1],"month"=>$match[2],"mon"=>$this->monthNo($match[2]),"year"=>$match[3]);
           $tmp["to"]   = array("day"=>$match[5],"month"=>$match[6],"mon"=>$this->monthNo($match[6]),"year"=>$match[7]);
           $tmp["comment"] = $match[8];
           $tmp["children"] = $match[10];
         }
         $this->spouses[] = $tmp;
       }
     }
   }
   return $this->spouses;
 }

 #---------------------------------------------------------------[ MiniBio ]---
 /** Get the person's mini bio
  * @method bio
  * @return array bio array [0..n] of array[string desc, array author[url,name]]
  * @see IMDB person page /bio
  */
  public function bio() {
   if (empty($this->bio_bio)) {
     if ( $this->page["Bio"] == "" ) $this->openpage ("Bio","person");
     if ( $this->page["Bio"] == "cannot open page" ) return array(); // no such page
     if (@preg_match_all('|<h5>Mini Biography</h5>\s*(.+)\s+.+\s+(.+)|',$this->page["Bio"],$matches)) {
       for ($i=0;$i<count($matches[0]);++$i) {
         $bio_bio["desc"] = str_replace("href=\"/name/nm","href=\"http://".$this->imdbsite."/name/nm",
                              str_replace("href=\"/title/tt","href=\"http://".$this->imdbsite."/title/tt",
                                str_replace('/SearchBios','http://'.$this->imdbsite.'/SearchBios',$matches[1][$i])));
         $author = 'Written by '.(str_replace('/SearchBios','http://'.$this->imdbsite.'/SearchBios',$matches[2][$i]));
         if (@preg_match("/href\=\"(.*?)\">(.*?)<\/a>/",$author,$match)) {
           $bio_bio["author"]["url"]  = $match[1][$i];
           $bio_bio["author"]["name"] = $match[2][$i];
         }
         $this->bio_bio[] = $bio_bio;
         unset($bio_bio,$author);
       }
     }
   }
   return $this->bio_bio;
  }

 #-----------------------------------------[ Helper to Trivia, Quotes, ... ]---
  /** Parse Trivia, Quotes, etc (same structs)
   * @method private parparse
   * @param string name
   * @param ref array res
   */
  private function parparse($name,&$res) {
    if ( $this->page["Bio"] == "" ) $this->openpage ("Bio","person");
    $pos_s = strpos($this->page["Bio"],"<h5>$name</h5>");
    $pos_e = strpos($this->page["Bio"],"<br",$pos_s);
    $block = substr($this->page["Bio"],$pos_s,$pos_e - $pos_s);
    if (preg_match_all("/<p>(.*?)<\/p>/ms",$block,$matches))
      foreach ($matches[1] as $match)
        $res[] = str_replace('href="/name/nm', 'href="http://'.$this->imdbsite.'/name/nm',
                 str_replace('href="/title/tt','href="http://'.$this->imdbsite.'/title/tt',$match));
  }

 #----------------------------------------------------------------[ Trivia ]---
  /** Get the Trivia
   * @method trivia
   * @return array trivia array[0..n] of string
   * @see IMDB person page /bio
   */
  public function trivia() {
    if (empty($this->bio_trivia)) $this->parparse("Trivia",$this->bio_trivia);
    return $this->bio_trivia;
  }

 #----------------------------------------------------------------[ Quotes ]---
  /** Get the Personal Quotes
   * @method quotes
   * @return array quotes array[0..n] of string
   * @see IMDB person page /bio
   */
  public function quotes() {
    if (empty($this->bio_quotes)) $this->parparse("Personal Quotes",$this->bio_quotes);
    return $this->bio_quotes;
  }

 #------------------------------------------------------------[ Trademarks ]---
  /** Get the "trademarks" of the person
   * @method trademark
   * @return array trademarks array[0..n] of strings
   * @see IMDB person page /bio
   */
  public function trademark() {
    if (empty($this->bio_tm)) $this->parparse("Trade Mark",$this->bio_tm);
    return $this->bio_tm;
  }

 #----------------------------------------------------------------[ Salary ]---
  /** Get the salary list
   * @method salary
   * @return array salary array[0..n] of array movie[strings imdb,name,year], string salary
   * @see IMDB person page /bio
   */
  public function salary() {
    if (empty($this->bio_salary)) {
      if ( $this->page["Bio"] == "" ) $this->openpage ("Bio","person");
      $pos_s = strpos($this->page["Bio"],"<h5>Salary</h5>");
      if (!$pos_s) return $this->bio_salary;
      $pos_e = strpos($this->page["Bio"],"</table",$pos_s);
      $block = substr($this->page["Bio"],$pos_s,$pos_e - $pos_s);
      if (preg_match_all("/<tr.*?<td.*?>(.*?)<\/td>.*?<td.*?>(.*?)<\/td>/ms",$block,$matches)) { // for each table row
        $mc = count($matches[0]);
        for ($i=0;$i<$mc;++$i) {
          if (preg_match("/\/title\/tt(\d{7})\/\">(.*?)<\/a>\s*\((\d{4})\)/",$matches[1][$i],$match)) {
            $movie["imdb"] = $match[1];
            $movie["name"] = $match[2];
            $movie["year"] = $match[3];
          } else {
            $movie["name"] = $matches[1][$i];
          }
          $this->bio_salary[] = array("movie"=>$movie,"salary"=>$matches[2][$i]);
        }
      }
    }
    return $this->bio_salary;
  }

 #============================================================[ /publicity ]===
 #-----------------------------------------------------------[ Print media ]---
  /** Print media about this person
   * @method pubprints
   * @return array prints array[0..n] of array[author,title,place,publisher,year,isbn,url],
   *         where "place" refers to the place of publication, and "url" is a link to the ISBN
   * @see IMDB person page /publicity
   */
  public function pubprints() {
    if (empty($this->pub_prints)) {
      if ( $this->page["Publicity"] == "" ) $this->openpage ("Publicity","person");
      $pos_s = strpos($this->page["Publicity"],"<h5>Biography (print)</h5>");
      $pos_e = strpos($this->page["Publicity"],"<br",$pos_s);
      $block = substr($this->page["Publicity"],$pos_s,$pos_e - $pos_s);
      $arr = explode("<p>",$block);
      $pc = count($arr);
      for ($i=1;$i<$pc;++$i) {
        if (preg_match('/(.*).\s*<i>(.*)<\/i>\s*((.*):|)((.*),|)\s*((\d+)\.|)\s*ISBN\s*<a href="(.*)">(.*)<\/a>/iU',$arr[$i],$match)) {
          $this->pub_prints[] = array("author"=>$match[1],"title"=>$match[2],"place"=>trim($match[4]),"publisher"=>trim($match[6]),"year"=>$match[8],"isbn"=>$match[10],"url"=>$match[9]);
        } elseif (preg_match('/(.*).\s*<i>(.*)<\/i>\s*((.*):|)((.*),|)\s*((\d+)\.)/iU',$arr[$i],$match)) {
          $this->pub_prints[] = array("author"=>$match[1],"title"=>$match[2],"place"=>trim($match[4]),"publisher"=>trim($match[6]),"year"=>$match[8],"isbn"=>"","url"=>"");
        }
      }
    }
    return $this->pub_prints;
  }

 #----------------------------------------------[ Helper for movie parsing ]---
  /** Parse movie helper
   * @method private parsepubmovies
   * @param ref array res where to store the results
   * @param string page name of the page
   * @param string header header of the block on the IMDB site
   * @brief helper to pubmovies() and portrayedmovies()
   */
  private function parsepubmovies(&$res,$page,$header) {
    if ( $this->page[$page] == "" ) $this->openpage ($page,"person");
    $pos_s = strpos($this->page[$page],"<h5>$header</h5>");
    $pos_e = strpos($this->page[$page],"<h5",$pos_s+5);
    $skip  = strlen($header)+9;
    $block = substr($this->page[$page],$pos_s+$skip,$pos_e - $pos_s -$skip);
    $arr = explode("<br/><br/>",$block);
    $pc = count($arr);
    for ($i=0;$i<$pc;++$i) {
      if (preg_match('/href="\/title\/tt(\d+)\/">(.*)<\/a>\s*(\((\d+)\)|)/',$arr[$i],$match)) {
        $res[] = array("imdb"=>$match[1],"name"=>$match[2],"year"=>$match[4]);
      }
    }
 }

 #----------------------------------------------------[ Biographical movies ]---
  /** Biographical Movies
   * @method pubmovies
   * @return array pubmovies array[0..n] of array[imdb,name,year]
   * @see IMDB person page /publicity
   */
  public function pubmovies() {
    if (empty($this->pub_movies)) $this->parsepubmovies($this->pub_movies,"Publicity","Biographical movies");
    return $this->pub_movies;
  }

 #-----------------------------------------------------------[ Portrayed in ]---
  /** List of movies protraying the person
   * @method pubportraits
   * @return array pubmovies array[0..n] of array[imdb,name,year]
   * @see IMDB person page /publicity
   */
  public function pubportraits() {
    if (empty($this->pub_portraits)) $this->parsepubmovies($this->pub_portraits,"Publicity","Portrayed in");
    return $this->pub_portraits;
  }

 #--------------------------------------------[ Helper for Article parsing ]---
  /** Helper for article parsing
   * @method private parsearticles
   * @param ref array res where to store the results
   * @param string page name of the page
   * @param string title title of the block
   * @brief used by interviews(), articles()
   * @see IMDB person page /publicity
   */
  private function parsearticles(&$res,$page,$title) {
    if ( $this->page[$page] == "" ) $this->openpage ($page,"person");
    $pos_s = strpos($this->page[$page],"<h5>$title</h5>");
    $pos_e = strpos($this->page[$page],"</table",$pos_s);
    $block = substr($this->page[$page],$pos_s,$pos_e-$pos_s);
    @preg_match_all("|<tr>(.*)</tr>|iU",$block,$matches); // get the rows
    $lc = count($matches[0]);
    for ($i=0;$i<$lc;++$i) {
      //if (@preg_match('/href="(.*)">(.*)<\/a>.*valign="top">(.*),\s*(.*|)(,\s*by.*"author" href="(.*)">(.*)|)</iU',$matches[1][$i],$match)) {
      // links have been removed from the site at 2010-02-22
      if (@preg_match('|<td.*?>(.*?)</td><td.*?>(.*?)</td>|ms',$matches[1][$i],$match)) {
        @preg_match('/(\d{1,2}|)\s*(\S+|)\s*(\d{4}|)/i',$match[2],$dat);
        $datum = array("day"=>$dat[1],"month"=>trim($dat[2]),"mon"=>$this->monthNo(trim($dat[2])),"year"=>trim($dat[3]),"full"=>$match[3]);
        if (strlen($dat[0])) $match[2] = trim(substr($match[2],strlen($dat[0])+1));
        @preg_match('|<a name="author">(.*?)</a>|ims',$match[2],$author);
        if (strlen($author[0])) $match[2] = trim(str_replace(', by: '.$author[0],'',$match[2]));
        //$res[] = array("inturl"=>$match[1],"name"=>$match[2],"date"=>$datum,"details"=>trim($match[4]),"auturl"=>$match[6],"author"=>$match[7]);
        $res[] = array("inturl"=>'',"name"=>$match[1],"date"=>$datum,"details"=>trim($match[2]),"auturl"=>'',"author"=>$author[1]);
      }
    }
  }

 #-------------------------------------------------------------[ Interviews ]---
  /** Interviews
   * @method interviews
   * @return array interviews array[0..n] of array[inturl,name,date,details,auturl,author]
   *         where all elements are strings - just date is an array[day,month,mon,year,full]
   *         (full: as displayed on the IMDB site)
   * @see IMDB person page /publicity
   */
  public function interviews() {
    if (empty($this->pub_interviews)) $this->parsearticles($this->pub_interviews,"Publicity","Interview");
    return $this->pub_interviews;
  }

 #--------------------------------------------------------------[ Articles ]---
  /** Articles
   * @method articles
   * @return array articles array[0..n] of array[inturl,name,date,details,auturl,author]
   *         where all elements are strings - just date is an array[day,month,mon,year,full]
   *         (full: as displayed on the IMDB site)
   * @see IMDB person page /publicity
   */
  public function articles() {
    if (empty($this->pub_articles)) $this->parsearticles($this->pub_articles,"Publicity","Article");
    return $this->pub_articles;
  }

 #--------------------------------------------------------------[ Articles ]---
  /** Pictorials
   * @method pictorials
   * @return array pictorials array[0..n] of array[inturl,name,date,details,auturl,author]
   *         where all elements are strings - just date is an array[day,month,mon,year,full]
   *         (full: as displayed on the IMDB site)
   * @see IMDB person page /publicity
   */
  public function pictorials() {
    if (empty($this->pub_pictorials)) $this->parsearticles($this->pub_pictorials,"Publicity","Pictorial");
    return $this->pub_pictorials;
  }

 #--------------------------------------------------------------[ Articles ]---
  /** Magazine cover photos
   * @method magcovers
   * @return array magcovers array[0..n] of array[inturl,name,date,details,auturl,author]
   *         where all elements are strings - just date is an array[day,month,mon,year,full]
   *         (full: as displayed on the IMDB site)
   * @see IMDB person page /publicity
   */
  public function magcovers() {
    if (empty($this->pub_magcovers)) $this->parsearticles($this->pub_magcovers,"Publicity","Magazine cover photo");
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

 } // end class imdb_person

 #==========================================[ The IMDB Person search class ]===
 /** Searching IMDB staff information
  * @package IMDB
  * @class imdbpsearch
  * @extends imdbsearch
  * @author Izzy (izzysoft AT qumran DOT org)
  * @copyright 2008-2009 by Itzchak Rehberg and IzzySoft
  * @version $Revision$ $Date$
  */
 class imdbpsearch extends imdbsearch {
 #-----------------------------------------------------------[ Constructor ]---
  /** Initialize class (read config etc.)
   * @constructor imdbpsearch
   */
   function __construct() {
     parent::__construct();
   }

 #-------------------------------------------------------[ private helpers ]---
  /** Create the IMDB URL for the name search
   * @method private mkurl
   * @return string url
   */
  private function mkurl() {
   if ($this->url !== NULL) {
    $url = $this->url;
   } else {
     $query = ";s=nm";
     if (!isset($this->maxresults)) $this->maxresults = 20;
     if ($this->maxresults > 0) $query .= ";mx=20";
     $url = "http://".$this->imdbsite."/find?q=".urlencode($this->name).$query;
   }
   return $url;
  }

 #-----------------------------------------------------------[ get results ]---
  /** Setup search results
   * @method results
   * @param optional string URL Replace search URL by your own
   * @return array results array of objects (instances of the imdb_person class)
   */
  public function results($url="") {
   if ($this->page == "") {
     if (empty($url)) $url = $this->mkurl();
     $be = new MDB_Request($url);
     $be->sendrequest();
     $fp = $be->getResponseBody();
     if ( !$fp ){
       if ($header = $be->getResponseHeader("Location")){
        if (strpos($header,$this->imdbsite."/find?")) {
          return $this->results($header);
          break(4);
        }
        $url = explode("/",$header);
        $id  = substr($url[count($url)-2],2);
        $this->resu[0] = new imdb_person($id);
        return $this->resu;
       }else{
        return NULL;
       }
     }
     $this->page = $fp;
   } // end (page="")

   if ($this->maxresults > 0) $maxresults = $this->maxresults; else $maxresults = 999999;
   // make sure to catch col #3, not #1 (pic only)
   preg_match_all('|<tr>\s*<td.*>.*</td>\s*<td.*>.*</td>\s*<td.*<a href="/name/nm(\d{7})[^>]*>([^<]+)</a>(.*)</td>|Uims',$this->page,$matches);
   $mc = count($matches[0]);
   $mids_checked = array();
   for ($i=0;$i<$mc;++$i) {
     if ($i == $maxresults) break; // limit result count
     $pid = $matches[1][$i];
     if (in_array($pid,$mids_checked)) continue;
     $mids_checked[] = $pid;
     $name    = $matches[2][$i];
     $info    = $matches[3][$i];
     $tmpres  = new imdb_person($pid);
     $tmpres->fullname = $name;
     if (!empty($info)) {
       if (preg_match('|<small>\((.*),\s*<a href="/title/tt(\d{7})/">(.*)</a>\s*\((\d{4})\)\)|Ui',$info,$match)) {
         $role = $match[1];
         $mid  = $match[2];
         $movie= $match[3];
         $year = $match[4];
         $tmpres->setSearchDetails($role,$mid,$movie,$year);
       }
     }
     $this->resu[$i] = $tmpres;
     unset($tmpres);
   }
   return $this->resu;
  }
 }

?>
