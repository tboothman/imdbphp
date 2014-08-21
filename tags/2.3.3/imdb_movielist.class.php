<?php
#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# ------------------------------------------------------------------------- #
# Miscellaneous movie lists                                                 #
# written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################

/* $Id$ */

require_once (dirname(__FILE__)."/movie_base.class.php");

/** Accessing miscellaneous IMDB movie lists
 * @package IMDB
 * @class imdb_movielist
 * @extends movie_base
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class imdb_movielist extends movie_base {

#==========================================[ internal (protected) methods ]===
#-----------------------------------------------------------[ Constructor ]---
 /** Initialize the class
  * @constructor imdb_movielist
  * @param optional object mdb_config override default config
  */
 function __construct(mdb_config $config = null) {
   parent::__construct('0000001', $config);
   $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
   $this->reset_vars();
 }

 /** Define page urls
  * @method protected set_pagename
  * @param string wt internal name of the page
  * @param array replace special URL settings
  * @return string urlname page URL
  */
 protected function set_pagename($wt,$replace=array()) {
   switch ($wt){
     case "CountryYear" :
       $urlname="/List?year=%year&&countries=%countries&&tv=%tv";
       $urlname="/search/title?year=%year&&countries=%countries&&tv=%tv";
       foreach ($replace as $var=>$val) $urlname = str_replace("%$var",$val,$urlname);
       break;
     case "LanguageYear" :
       $urlname="/search/title?year=%year&&language=%countries&&tv=%tv";
       foreach ($replace as $var=>$val) $urlname = str_replace("%$var",$val,$urlname);
       break;
     case "MostpopYear" :
       $urlname="/year/%year";
       foreach ($replace as $var=>$val) $urlname = str_replace("%$var",$val,$urlname);
       break;
     default            :
       $this->page[$wt] = "unknown page identifier";
       $this->debug_scalar("Unknown page identifier: $wt");
       return false;
   }
   return $urlname;
 }

#=============================================================[ public API ]===
 /** Initialize/Reset variables used
  * @method public reset_vars
  */
 public function reset_vars() {
   $this->page["CountryYear"] = "";
   $this->page["LanguageYear"] = "";
   $this->page["MostpopYear"] = "";
   $this->enable_serials();
   $this->countryYear = array();
   $this->languageYear = array();
   $this->mostpopYear = array();
 }

 /** Define whether lists shall include TV serials. Off by default.
  * @method public enable_serials
  * @param optional string state (on|off, default: off)
  */
 public function enable_serials($switch='off') {
   $switch = strtolower($switch);
   if ( !in_array($switch,array('on','off')) ) $switch = 'off';
   $this->tv = $switch;
 }

 /** Parse movie list. Helper to by_x_year methods.
  * @method protected parse_x_year
  * @param string pagename name of page
  * @param ref array result where to store the results
  */
 protected function parse_x_year($pagename,&$ret) {
   $doc = new DOMDocument();
   @$doc->loadHTML($this->page[$pagename]);
   $xp = new DOMXPath($doc);
   $titles  = $xp->query("//div[@id='main']/table/tr/td[3]/a");
   $details = $xp->query("//div[@id='main']/table/tr/td[3]/span[1]");
   $serdet  = $xp->query("//div[@id='main']/table/tr/td[3]/span[2]");
   $serref  = $xp->query("//div[@id='main']/table/tr/td[3]/span[2]/a");
   $nodecount = $titles->length;
   for ($i=0;$i<$nodecount;++$i) {
     preg_match('|(\d{7})/$|',$titles->item($i)->getAttribute('href'),$match);
     $id = $match[1];
     $title = trim($titles->item($i)->nodeValue);
     preg_match('!\((\d+).*?\s+(.*?)\)!',$details->item($i)->nodeValue,$match);
     $year  = $match[1];
     $mtype = $match[2];
     if ( strpos(strtolower($mtype),'series')!==FALSE ) $is_serial = 1;
     else $is_serial = 0;
     if ( $this->tv=='off' && $is_serial ) continue;
     if ($is_serial) {
       preg_match('!\((\d{4})\)!',$serdet->item($i)->nodeValue,$match);
       $ep_year = $match[1];
       preg_match('!(\d{7})!',$serref->item($i)->getAttribute('href'),$match);
       $ep_id   = $match[1];
       $ep_name = trim($serref->item($i)->nodeValue);
     } else {
       $ep_year = ''; $ep_id = 0; $ep_name = '';
     }
     $ret[] = array('imdbid'=>$id,'title'=>$title,'year'=>$year,'type'=>$mtype,'serial'=>$is_serial,'episode_imdbid'=>$ep_id,'episode_title'=>$ep_name,'episode_year'=>$ep_year);
   }
 }

 /** Retrieve a list of movies by year and origin
  * @method public by_country_year
  * @param string country
  * @param integer year
  * @return array [0..n] of array[imdbid,title,year]
  */
 public function by_country_year($country,$year) {
   $url = 'http://'.$this->imdbsite.$this->set_pagename('CountryYear',array("year"=>$year,"countries"=>$country,"tv"=>$this->tv));
   $this->getWebPage('CountryYear',$url);
   $this->parse_x_year('CountryYear',$this->countryYear);
   return $this->countryYear;
 }

 /** Retrieve a list of movies by year and language
  * @method public by_language_year
  * @param string language
  * @param integer year
  * @return array [0..n] of array[imdbid,title,year]
  */
 public function by_language_year($lang,$year) {
   $url = 'http://'.$this->imdbsite.$this->set_pagename('LanguageYear',array("year"=>$year,"language"=>$lang,"tv"=>$this->tv));
   $this->getWebPage('LanguageYear',$url);
   $this->parse_x_year('LanguageYear',$this->languageYear);
   return $this->languageYear;
 }

 /** Most popular movies by year ("Top 10")
  * @method public mostpop_by_year
  * @param integer year
  * @return array [0..n] of array[imdbid,title,year,votes,rating]
  */
 public function mostpop_by_year($year) {
   $url = 'http://'.$this->imdbsite.$this->set_pagename('MostpopYear',array("year"=>$year));
   $this->getWebPage('MostpopYear',$url);

   $doc = new DOMDocument();
   @$doc->loadHTML($this->page['MostpopYear']);
   $xp = new DOMXPath($doc);
   $rating = $xp->query("//table[@class='results']/tr/td[3]/div[@class='user_rating']/div");
   $titles = $xp->query("//table[@class='results']/tr/td[3]/a");
   $years  = $xp->query("//table[@class='results']/tr/td[3]/span[@class='year_type']");
   $nodecount = $titles->length;

   for ($i=0;$i<$nodecount;++$i) {
     preg_match('|(\d{7})/$|',$titles->item($i)->getAttribute('href'),$match);
     $id = $match[1];
     $title = trim($titles->item($i)->nodeValue);
     $year = trim($years->item($i)->nodeValue);
     if (!empty($year)) $year = substr($year,1,4);
     preg_match('!Users rated this\s+(.+)/.+\((.+)\s+vote!',$rating->item($i)->getAttribute('title'),$match);
     $rate = $match[1];
     $vote = $match[2];
     $this->mostpopYear[] = array('imdbid'=>$id,'title'=>$title,'year'=>$year,'votes'=>$vote,'rating'=>$rate);
   }
   return $this->mostpopYear;
 }

}