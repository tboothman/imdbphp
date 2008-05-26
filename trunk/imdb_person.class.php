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
  * @version $Revision$ $Date$
  */
 class imdb_person extends imdb_base {

 #========================================================[ Common methods ]===
 #-------------------------------------------------------------[ Open Page ]---
  /** Define page urls
   * @method private set_pagename
   * @param string wt internal name of the page
   * @return string urlname page URL
   */
  function set_pagename($wt) {
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

 #--------------------------------------------------[ Start (over) / Reset ]---
  /** Reset page vars
   * @method private reset_vars
   */
  function reset_vars() {
   $this->page["Name"] = "";
   $this->page["Bio"]  = "";

   // "Name" page:
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

   // "Bio" page:
   $this->birth_name      = "";
   $this->nick_name       = array();
   $this->bodyheight      = array();
   $this->bio_bio         = array();
   $this->bio_trivia      = array();
   $this->bio_tm          = array();
   $this->bio_salary      = array();

   // "Publicity" page:
   $this->pub_prints      = array();
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

 #=============================================================[ Main Page ]===
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
   * @return array birthday [day,month.year,place]
   */
  function born() {
    if (empty($this->birthday)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match("/Date of Birth:<\/h5>\s*<a href=\"\/OnThisDay\?day\=(\d{1,2})&month\=(.*?)\">.*?<a href\=\"\/BornInYear\?(\d{4}).*?href\=\"\/BornWhere\?.*?\">(.*?)<\/a>/ms",$this->page["Name"],$match))
        $this->birthday = array("day"=>$match[1],"month"=>$match[2],"year"=>$match[3],"place"=>$match[4]);
    }
    return $this->birthday;
  }

 #------------------------------------------------------------------[ Died ]---
  /** Get Deathday
   * @method died
   * @return array deathday [day,month.year,place,cause]
   */
  function died() {
    if (empty($this->deathday)) {
      if ($this->page["Name"] == "") $this->openpage ("Name","person");
      if (preg_match("/Date of Death:<\/h5>\s*<a href=\"\/OnThisDay\?day\=(\d{1,2})&month\=(.*?)\">.*?<a href\=\"\/DiedInYear\?(\d{4}).*?<\/a>\s*\,\s*(.*?)\s*(\((.*?)\)|)\s*<a class/ms",$this->page["Name"],$match))
        $this->deathday = array("day"=>$match[1],"month"=>$match[2],"year"=>$match[3],"place"=>$match[4],"cause"=>$match[6]);
    }
    return $this->deathday;
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

 #==================================================================[ /bio ]===
 #------------------------------------------------------------[ Birth Name ]---
 /** Get the birth name
  * @method birthname
  * @return string birthname
  */
 function birthname() {
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
  */
 function nickname() {
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

 #-----------------------------------------------------------[ Body Height ]---
 /** Get the body height
  * @method height
  * @return array [imperial,metric] height in feet and inch (imperial) an meters (metric)
  */
 function height() {
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
  *         [day,month,year], comment usually is "divorced" (ouch), children is
  *         the number of children
  */
 function spouse() {
   if (empty($this->spouses)) {
     if ($this->page["Bio"] == "") $this->openpage ("Bio","person");
     $pos_s = strpos($this->page["Bio"],"<h5>Spouse</h5>");
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
           $tmp["from"] = array("day"=>$match[1],"month"=>$match[2],"year"=>$match[3]);
           $tmp["to"]   = array("day"=>$match[5],"month"=>$match[6],"year"=>$match[7]);
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
  */
  function bio () {
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
  function parparse($name,&$res) {
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
   */
  function trivia() {
    if (empty($this->bio_trivia)) $this->parparse("Trivia",$this->bio_trivia);
    return $this->bio_trivia;
  }

 #----------------------------------------------------------------[ Quotes ]---
  /** Get the Personal Quotes
   * @method quotes
   * @return array quotes array[0..n] of string
   */
  function quotes() {
    if (empty($this->bio_quotes)) $this->parparse("Personal Quotes",$this->bio_quotes);
    return $this->bio_quotes;
  }

 #------------------------------------------------------------[ Trademarks ]---
  /** Get the "trademarks" of the person
   * @method trademark
   * @return array trademarks array[0..n] of strings
   */
  function trademark() {
    if (empty($this->bio_tm)) $this->parparse("Trade Mark",$this->bio_tm);
    return $this->bio_tm;
  }

 #----------------------------------------------------------------[ Salary ]---
  /** Get the salary list
   * @method salary
   * @return array salary array[0..n] of array movie[strings imdb,name,year], string salary
   */
  function salary() {
    if (empty($this->bio_salary)) {
      if ( $this->page["Bio"] == "" ) $this->openpage ("Bio","person");
      $pos_s = strpos($this->page["Bio"],"<h5>Salary</h5>");
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
  /** Books about this person
   * @method pubprints
   * @return array prints array[0..n] of array[author,title,place,publisher,year,isbn,url],
   *         where "place" refers to the place of publication, and "url" is a link to the ISBN
   */
  function pubprints() {
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

 } // end class imdb_person

?>
