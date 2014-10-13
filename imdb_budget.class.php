<?php
#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# written by Giorgos Giagas                                                 #
# extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# Budget data                                                  (c) Isyankar #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################

/* $Id$ */

require_once (dirname(__FILE__)."/movie_base.class.php");

#=============================================================================
#=================================================[ The IMDB class itself ]===
#=============================================================================
/**
 * IMDb Budget Data and other business data such as country/weekend grosses
 * @package IMDB
 * @class imdb_budget
 * @extends movie_base
 * @author Isyankar
 * @author Izzy (izzysoft AT qumran DOT org)
 * @version $Revision$ $Date$
 */
class imdb_budget extends movie_base {

#======================================================[ Common functions ]===
#-----------------------------------------------------------[ Constructor ]---
 /** Initialize the class
  * @constructor imdb_budget
  * @param string id IMDBID to use for data retrieval
  * @param mdb_config $config OPTIONAL override default config
  */
 function __construct($id, mdb_config $config = null) {
   parent::__construct($id, $config);
   $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
   $this->setid($id);
   $this->reset_vars();
 }

#--------------------------------------------------[ Start (over) / Reset ]---
 /** Reset page vars
  * @method protected reset_vars
  */
 protected function reset_vars() {
   $this->budget = null;
   $this->openingWeekend = array();
   $this->gross = array();
   $this->weekendGross = array();
   $this->admissions = array();
   $this->filmingDates = array();
   $this->page['BoxOffice'] = '';
 }

#-------------------------------------------------------------[ Open Page ]---
 /** Define page urls
  * @method protected set_pagename
  * @param string wt internal name of the page
  * @return string urlname page URL
  */
  protected function set_pagename($wt) {
    switch ($wt) {
      case "BoxOffice":
        $urlname = "/business";
        break;
      default:
        $this->logger->critical("[Budget] Unknown page identifier [$wt]");
        return '';
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

  protected function buildUrl($page) {
    return "http://" . $this->imdbsite . "/title/tt" . $this->imdbID . $this->set_pagename($page);
  }

#====================================================[ /business page ]=== 

 /* Get budget
  * @method protected get_budget
  * @param string budg
  * @return int|null null on failure
  * @brief Assuming budget is estimated, and in american dollar
  * @see IMDB page / (TitlePage)
  */
 protected function get_budget($budg){
     // Tries to get a single entry
    if (@preg_match("!(.*?)\s*\(estimated\)!ims", $budg, $opWe)) {
      $result = $opWe[1];
      return intval(substr(str_replace(",", "", $result), 1));
    } else {
      return null;
    }
 } // End of get_budget

 /* Get budget
  * @method get_budget
  * @return int|null null on failure / no data
  * @brief Assuming budget is estimated, and in american dollar
  * @see IMDB page / (TitlePage)
  */
  public function budget() {
    if (empty($this->budget)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Budget</h5>\s*\n*(.*?)(<br/>\n*)*<h5!ims", $page, $bud)) { // Opening Weekend
        $budget = $bud[1];
      } else {
        return null;
      }
      $this->budget = $this->get_budget($budget);
    }
    return $this->budget;
  }

  #-------------------------------------------------[ Openingbudget ]---
 /** Get opening weekend budget
  * @method protected get_openingWeekend
  * @param ref string listOpening
  * @return array[0..n] of array[value,country,date,nbScreens]
  * @see IMDB page
  */
 protected function get_openingWeekend(&$listOpening){
   $result = array();
   $temp = $listOpening;

   $i = 0;
   while($temp != NULL){
     // Tries to get a single entry
     if (@preg_match("!(.*?)<br/>!ims",$temp,$opWe)) 
     $entry = $opWe[1];

     // Tries to extract the value
     if (@preg_match("!(.*?)\(!ims",$opWe[1],$value))
       $opWe[1] = str_replace($value,"",$opWe[1]);

     // Tries to extract the country
     if (@preg_match("!(.*?)\)\s*!ims",$opWe[1],$country))
       $opWe[1] = str_replace($country,"",$opWe[1]);

     // Tries to extract the date
     if (@preg_match("!\((.*?)\)\s*!ims",$opWe[1],$date)) 
       if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$date[1],$dayMonth))
         if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$date[1],$year))
           $dateValue = $year[1].'-'.$dayMonth[1];
     $opWe[1] = str_replace($date,"",$opWe[1]);

     // Tries to extract the number of screens
     if (@preg_match("!\((.*?)\)\s*!ims",$opWe[1],$nbScreen))
       $opWe[1] = str_replace($nbScreen,"",$opWe[1]);

     // Parse the results in an array
     $result[$i] = array(
       'value'     => trim($value[1]),
       'country'   => $country[1],
       'date'      => $dateValue,
       'nbScreens' => intval(str_replace(",","",$nbScreen[1]))
     );

     // Remove the entry from the list of entries
     if (@preg_match("!<br/>(.*?)$!ims",$temp,$temp))
       $temp = $temp[1];

     $i++;
   }
   return $result;
 } // End of get_openingWeekend


 /** Opening weekend budget
   * @method openingWeekend
   * @return array[0..n] of array[value,country,date,nbScreens]
   * @see IMDB page
   * @TODO fix 'value' field .. "&#163;3,384,948" isn't good enough
   */
  public function openingWeekend() {
    if (empty($this->openingWeekend)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Opening Weekend</h5>\n*(.*?)<br/>\n*<h5!ims", $page, $opWe)) // Opening Weekend
        $openingWeekend = $opWe[1];
      $this->openingWeekend = $this->get_openingWeekend($openingWeekend);
    }
    return $this->openingWeekend;
  }

 #-------------------------------------------------[ Gross ]---
 /** Get gross budget
  * @method protected get_gross
  * @param ref string listGross
  * @return array[0..n] of array[value,country,date]
  * @see IMDB page / (TitlePage)
  */
 protected function get_gross(&$listGross) {
   $result = array();
   $temp = $listGross;
   $i = 0;
   while($temp != NULL){
     // Tries to get a single entry
     if (@preg_match("!(.*?)<br/>!ims",$temp,$gr)) 
       $entry = $gr[1];
       //echo 'ici'.$entry.'ici';

     // Tries to extract the value
     if (@preg_match("!(.*?)\(!ims",$gr[1],$value))
       $gr[1] = str_replace($value,"",$gr[1]);

     // Tries to extract the country
     if (@preg_match("!(.*?)\)\s*!ims",$gr[1],$country))
       $gr[1] = str_replace($country,"",$gr[1]);

     // Tries to extract the date
     if (@preg_match("!\((.*?)\)\s*!ims",$gr[1],$date))
       if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$date[1],$dayMonth))
         if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$date[1],$year))
           $dateValue = $year[1].'-'.$dayMonth[1];
     $gr[1] = str_replace($date,"",$gr[1]);

     // Parse the results in an array
     $result[$i] = array(
       'value'     => trim($value[1]),
       'country'   => $country[1],
       'date'      => $dateValue,
     );

     // Remove the entry from the list of entries
     if (@preg_match("!<br/>(.*?)$!ims",$temp,$temp))
       $temp = $temp[1];

     $i++;
   }
   return $result;
 } // End of get_gross


 /** Get gross budget
   * @method gross
   * @return array[0..n] of array[value,country,date]
   * @see IMDB page / (TitlePage)
   * @TODO fix 'value' field .. "&#163;3,384,948" isn't good enough
   */
  public function gross() {
    if (empty($this->gross)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Gross</h5>\n*(.*?)<br/>\n*<h5!ims", $page, $gr)) // Gross
        $gross = $gr[1];
      $this->gross = $this->get_gross($gross);
    }
    return $this->gross;
  }


 #-------------------------------------------------[ Weekend Gross ]---
 /** Get weekend gross budget
  * @method protected get_weekendGross
  * @param ref string listweekendGross
  * @return array[0..n] of array[value,country,date,nbScreens]
  * @see IMDB page / (TitlePage)
  */
 protected function get_weekendGross(&$listweekendGross){
   $result = array();
   $temp = $listweekendGross;
   $i = 0;

   while($temp != NULL){
     // Tries to get a single entry
     if (@preg_match("!(.*?)<br/>!ims",$temp,$weGr))
       $entry = $weGr[1];

     // Tries to extract the value
     if (@preg_match("!(.*?)\(!ims",$weGr[1],$value))
       $weGr[1] = str_replace($value,"",$weGr[1]);

     // Tries to extract the country
     if (@preg_match("!(.*?)\)\s*!ims",$weGr[1],$country))
       $weGr[1] = str_replace($country,"",$weGr[1]);

     // Tries to extract the date
     if (@preg_match("!\((.*?)\)\s*!ims",$weGr[1],$date))
       if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$date[1],$dayMonth))
         if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$date[1],$year))
           $dateValue = $year[1].'-'.$dayMonth[1];
     $weGr[1] = str_replace($date,"",$weGr[1]);

     // Tries to extract the number of screens
     if (@preg_match("!\((.*?)\)\s*!ims",$weGr[1],$nbScreen))
       $weGr[1] = str_replace($nbScreen,"",$weGr[1]);

     // Parse the results in an array
     $result[$i] = array(
       'value'     => trim($value[1]),
       'country'   => $country[1],
       'date'      => $dateValue,
       'nbScreens' => intval(str_replace(",","",$nbScreen[1]))
     );

     // Remove the entry from the list of entries
     if (@preg_match("!<br/>(.*?)$!ims",$temp,$temp))
       $temp = $temp[1];

     $i++;
   }
   return $result;
 } // End of get_weekendGross


 /** Get weekend gross budget
   * @method weekendGross
   * @return array[0..n] of array[value,country,date,nbScreen]
   * @see IMDB page / (TitlePage)
   */
  public function weekendGross() {
    if (empty($this->weekendGross)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Weekend Gross</h5>\n*(.*?)<br/>\n*<h5!ims", $page, $weGr)) // Weekend Gross
        $weekendGross = $weGr[1];
      $this->weekendGross = $this->get_weekendGross($weekendGross);
    }
    return $this->weekendGross;
  }

  #-------------------------------------------------[ Admissions ]---
 /** Get admissions budget
  * @method protected get_admissions
  * @param ref string listAdmissions
  * @return array[0..n] of array[value,country,date]
  * @see IMDB page / (TitlePage)
  */
 protected function get_admissions(&$listAdmissions) {
   $result = array();
   $temp = $listAdmissions;
   $i = 0;

   while($temp != NULL){
     // Tries to get a single entry
     if (@preg_match("!(.*?)<br/>!ims",$temp,$adm))
       $entry = $adm[1];

     // Tries to extract the value
     if (@preg_match("!(.*?)\(!ims",$adm[1],$value))
       $adm[1] = str_replace($value,"",$adm[1]);

     // Tries to extract the country
     if (@preg_match("!(.*?)\)\s*!ims",$adm[1],$country))
       $adm[1] = str_replace($country,"",$adm[1]);

     // Tries to extract the date
     if (@preg_match("!\((.*?)\)\s*!ims",$adm[1],$date))
       if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$date[1],$dayMonth))
         if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$date[1],$year))
           $dateValue = $year[1].'-'.$dayMonth[1];
     $adm[1] = str_replace($date,"",$adm[1]);

     // Parse the results in an array
     $result[$i] = array(
       'value'     => intval(str_replace(",","",$value[1])),
       'country'   => $country[1],
       'date'      => $dateValue,
     );

     // Remove the entry from the list of entries
     if (@preg_match("!<br/>(.*?)$!ims",$temp,$temp))
       $temp = $temp[1];

     $i++;
   }
   return $result;
 } // End of get_admissions


 /** Get admissions budget
   * @method admissions
   * @return array[0..n] of array[value,country,date]
   * @see IMDB page / (business)
   */
  public function admissions() {
    if (empty($this->admissions)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Admissions</h5>\n*(.*?)<br/>\n*<h5!ims", $page, $weGr)) // Admissions
        $admissions = $weGr[1];
      $this->admissions = $this->get_admissions($admissions);
    }
    return $this->admissions;
  }

  #-------------------------------------------------[ Filming Dates ]---
 /** Get filming dates
  * @method get_filmingDates
  * @param ref string listFilmingDates
  * @return array[0..n] of array[beginning,end]
  * Time format : YYYY-MM-DD
  * @see IMDB page / (TitlePage)
  */
 protected function get_filmingDates($listFilmingDates){
   $temp = $listFilmingDates;

   // Tries to get the beginning
   if (@preg_match("!(.*?)&nbsp;-!ims",$temp,$beginning))

     if (@preg_match("#[A-Z0-9]#",$beginning[1])) { // Check if there is a date
       if (@preg_match("!<a(.*?)&nbsp;-!ims",$temp)) { // Check if there  is a linked date
         if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$beginning[1],$dayMonthB))
           if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$beginning[1],$yearB))
             $beginningDate = $yearB[1].'-'.$dayMonthB[1];
       } else if (@preg_match("!(.*?)&nbsp;-!ims",$temp,$beginning)) {
         $beginningDate = date('Y-m-d', strtotime($beginning[1]));
       }
     }

   // Tries to get the end
   if (@preg_match("!-&nbsp;(.*?)$!ims",$temp,$end))

     if (@preg_match("#[A-Z0-9]#",$end[1])) { // Check if there is a date
       if (@preg_match("!-&nbsp;<a(.*?)!ims",$temp)) { // Check if there  is a linked date
         if (@preg_match("!<a href=\"/date/(.*?)/\">!ims",$end[1],$dayMonthE))
           if (@preg_match("!<a href=\"/year/(.*?)/\">!ims",$end[1],$yearE))
             $endDate = $yearE[1].'-'.$dayMonthE[1];
       } else if (@preg_match("!-&nbsp;(.*?)$!ims",$temp,$end)) {
         $endDate = date('Y-m-d', strtotime($end[1]));
       }
     }

   // Parse the results in an array
   $result = array(
       'beginning' => $beginningDate,
       'end'       => $endDate
   );

   return $result;
 }


 /** Get filming dates
   * @method filmingDates
   * @return array[beginning, end]
   * Time format : YYYY-MM-DD
   * @see IMDB page / (TitlePage)
   */
  public function filmingDates() {
    if (empty($this->filmingDates)) {
      $page = $this->getPage("BoxOffice");
      if (@preg_match("!<h5>Filming Dates</h5>\s*\n*(.*?)(<br/>\n*)*<h5!ims", $page, $filDates)) // Filming Dates
        $filmingDates = $filDates[1];
      $this->filmingDates = $this->get_filmingDates($filmingDates);
    }
    return $this->filmingDates;
  }

}
