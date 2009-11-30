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
  */
 function __construct() {
   parent::__construct('0000001');
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
       foreach ($replace as $var=>$val) $urlname = str_replace("%$var",$val,$urlname);
       break;
     case "LanguageYear" :
       $urlname="/List?year=%year&&language=%language&&tv=%tv";
       foreach ($replace as $var=>$val) $urlname = str_replace("%$var",$val,$urlname);
       break;
     case "MostpopYear" :
       $urlname="/Sections/Years/%year/total-votes";
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
   $titles = $xp->query("//td/ol/li/a");
   $nodecount = $titles->length;
   for ($i=0;$i<$nodecount;++$i) {
     preg_match('|(\d{7})/$|',$titles->item($i)->getAttribute('href'),$match);
     $id = $match[1];
     preg_match('|(.*)\((\d{4})\)|',trim($titles->item($i)->nodeValue),$match);
     $title = trim($match[1]);
     $year = $match[2];
     $ret[] = array('imdbid'=>$id,'title'=>$title,'year'=>year);
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
   $votes  = $xp->query("//table[@cellspacing='4']/tr/td[1]");
   $rating = $xp->query("//table[@cellspacing='4']/tr/td[2]");
   $titles = $xp->query("//table[@cellspacing='4']/tr/td[3]/a");
   $nodecount = $titles->length;
   for ($i=0;$i<$nodecount;++$i) {
     preg_match('|(\d{7})/$|',$titles->item($i)->getAttribute('href'),$match);
     $id = $match[1];
     preg_match('|(.*)\((\d{4})\)|',trim($titles->item($i)->nodeValue),$match);
     $title = trim($match[1]);
     $year = $match[2];
     $rate = trim($rating->item($i)->nodeValue);
     $vote = trim($votes->item($i)->nodeValue);
     $this->mostpopYear[] = array('imdbid'=>$id,'title'=>$title,'year'=>$year,'votes'=>$vote,'rating'=>$rate);
   }
   return $this->mostpopYear;
 }

}