<?php

require_once (dirname(__FILE__) . "/mdb_base.class.php");
require_once (dirname(__FILE__) . "/imdb_person.class.php");

#==========================================[ The IMDB Person search class ]===
/** Searching IMDB staff information
 * @package IMDB
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright 2008-2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision: 644 $ $Date: 2014-01-25 20:20:39 +0000 (Sat, 25 Jan 2014) $
 */

class imdb_person_search extends mdb_base {

  var $page = "";
  var $name = null;
  var $resu = array();
  var $url = null;
  var $last_results = 0;

  /**
   * Search for people on imdb who match $searchTerms
   * @method search
   * @param string $searchTerms
   * @return array of imdb_person
   */
  public function search($searchTerms) {
    $this->setsearchname($searchTerms);
    $this->reset();
    return $this->results();
  }

  /**
   * Set the name (title) to search for
   * @method setsearchname
   * @param string searchstring what to search for - (part of) the movie name
   */
  public function setsearchname($name) {
    $this->name = $name;
    $this->page = "";
    $this->url = null;
  }

  /**
   * Set the URL (overwrite default search URL and run your own)
   *  This URL will be reset if you call the setsearchname() method
   * @method seturl
   * @param string URL to use
   * @deprecated This will be dropped soon if nobody objects. Please check whether you're using it!
   */
  public function seturl($url) {
    $this->url = $url;
  }

  /**
   * Reset search results
   * This empties the collected search results. Without calling this, every
   * new search appends its results to the ones collected by the previous search.
   * @method reset
   */
  function reset() {
    $this->resu = array();
  }

  /**
   * Setup search results
   * @method results
   * @param optional string URL Replace search URL by your own
   * @return array results array of objects (instances of the imdb_person class)
   */
  public function results($url = "") {
    if ($this->page == "") {
      if ($this->usecache && empty($url)) { // Try to read from cache
        $this->cache_read(urlencode(strtolower($this->name)) . '.search', $this->page);
      } // end cache read
      if (empty($url))
        $url = $this->mkurl();
      $be = new MDB_Request($url, $this);
      $be->sendrequest();
      $fp = $be->getResponseBody();
      if (!$fp) {
        if ($header = $be->getResponseHeader("Location")) {
          mdb_base::debug_scalar("No immediate response body - we are redirected.<br>New URL: $header");
          if (strpos($header, $this->imdbsite . "/find?")) {
            return $this->results($header);
            break(4);
          }
          $url = explode("/", $header);
          $id = substr($url[count($url) - 2], 2);
          $this->resu[0] = new imdb_person($id, $this);
          return $this->resu;
        } else {
          mdb_base::debug_scalar("No result, no redirection -- something's wrong here...");
          return NULL;
        }
      }
      $this->page = $fp;

      if ($this->storecache && $this->page != "cannot open page" && $this->page != "") { //store cache
        $this->cache_write(urlencode(strtolower($this->name)) . '.search', $this->page);
      }
    } // end (page="")

    if ($this->maxresults > 0)
      $maxresults = $this->maxresults;
    else
      $maxresults = 999999;
    // make sure to catch col #3, not #1 (pic only)
    //                        photo           name                   1=id        2=name        3=details
    preg_match_all('|<tr.*>\s*<td.*>.*</td>\s*<td.*<a href="/name/nm(\d{7})[^>]*>([^<]+)</a>\s*(.*)</td>|Uims', $this->page, $matches);
    $mc = count($matches[0]);
    mdb_base::debug_scalar("$mc matches");
    $mids_checked = array();
    for ($i = 0; $i < $mc; ++$i) {
      if ($i == $maxresults)
        break; // limit result count
      $pid = $matches[1][$i];
      if (in_array($pid, $mids_checked))
        continue;
      $mids_checked[] = $pid;
      $name = $matches[2][$i];
      $info = $matches[3][$i];
      $tmpres = new imdb_person($pid);
      $tmpres->fullname = $name;
      if (!empty($info)) {
        if (preg_match('|<small>\((.*),\s*<a href="/title/tt(\d{7}).*"\s*>(.*)</a>\s*\((\d{4})\)\)|Ui', $info, $match)) {
          $role = $match[1];
          $mid = $match[2];
          $movie = $match[3];
          $year = $match[4];
          $tmpres->setSearchDetails($role, $mid, $movie, $year);
        }
      }
      $this->resu[$i] = $tmpres;
      unset($tmpres);
    }
    return $this->resu;
  }

  /**
   * Create the IMDB URL for the name search
   * @method protected mkurl
   * @return string url
   */
  protected function mkurl() {
    if ($this->url !== NULL) {
      $url = $this->url;
    } else {
      $query = "&s=nm";
      if (!isset($this->maxresults))
        $this->maxresults = 20;
      if ($this->maxresults > 0)
        $query .= "&mx=20";
      $url = "http://" . $this->imdbsite . "/find?q=" . urlencode($this->name) . $query;
    }
    mdb_base::debug_scalar("Using search URL '$url'");
    return $url;
  }

}

class imdbpsearch extends imdb_person_search {}