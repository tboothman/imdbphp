<?php

require_once (dirname(__FILE__) . "/imdb.class.php");

class imdbsearch2 extends mdb_base {

  const MOVIE = 'Movie';
  const TV = 'TV Series';
  const TV_EPISODE = 'TV Episode';
  const GAME = 'Video Game';
  const VIDEO = 'Video';
  const SHORT = 'Short';
  const SPECIAL = 'Special'; //@TODO: What's a special? find one

  /**
   * Search IMDb for titles matching $searchTerms
   * @param type $searchTerms
   * @param array $wantedTypes *optional* imdb types that should be returned. Defaults to returning all types.
   *                            The class constants FILM,TV etc should be used e.g. [imdbsearch::FILM, imdbsearch::TV]
   * @param int $maxResults *optional* The maximum number of results to retrieve from IMDB. 0 for unlimited. Defaults to mdb_config::$maxresults
   * @return array array of imdb objects
   */
  public function search($searchTerms, $wantedTypes = null, $maxResults = null) {
    $page = '';
    $results = [];

    // @TODO remove maxresults? It has no effect on imdb and why would the user want less results than possible?
    if ($maxResults === null) {
      $maxResults = $this->maxresults;
    }

    if ($this->usecache) {
      $this->cache_read(urlencode(strtolower($searchTerms)) . '.search', $page);
    }

    if (!$page) {
      // @TODO pre filter if they only pick one type
      $url = "http://" . $this->imdbsite . "/find?s=tt&q=" . urlencode($searchTerms);
      $page = $this->makeRequest($url);

      if ($this->storecache && $page) {
        $this->cache_write(urlencode(strtolower($searchTerms)) . '.search', $page);
      }
    }

    // Parse & filter results
    if (preg_match_all('!class="result_text"\s*>\s*<a href="/title/tt(?<imdbid>\d{7})/[^>]*>(?<title>.*?)</a>\s*(\([^\d{4}]\)\s*)?(\((?<year>\d{4})(.*?|)\)|)(?<addons>[^<]*)!ims', $page, $matches, PREG_SET_ORDER)) {
      foreach ($matches as $match) {
        if (count($results) == $maxResults) {
          break;
        }

        $type = $this->parseTitleType($match['addons']);

        if (is_array($wantedTypes) && !in_array($type, $wantedTypes)) {
          continue;
        }

        $results[] = imdb::fromSearchResult($match['imdbid'], $match['title'], $match['year'], $match['addons']);
      }
    }

    return $results;
  }

  protected function makeRequest($url) {
    mdb_base::debug_scalar("imdbsearch: Using URL $url");
    $be = new MDB_Request($url, '', '', $this);
    $be->sendrequest();
    $body = $be->getResponseBody();

    // @TODO The intricacies of http should be delt with by the http library
    // @TODO does this ever happen?
    if ($header = $be->getResponseHeader("Location")) {
      mdb_base::debug_scalar("imdbsearch: No immediate response body - we are redirected.<br>New URL: $header");
      if (substr($header, 0, 1) == '/') {
        return $this->makeRequest($this->imdbsite . $header);
      } else {
        return $this->makeRequest($header);
      }
    }

    return $body;
  }

  protected function parseTitleType($string) {
    $string = strtoupper($string);

    if (strpos($string, 'TV SERIES') !== FALSE) {
      return self::TV;
    } elseif (strpos($string, 'TV EPISODE') !== FALSE) {
      return self::TV_EPISODE;
    } elseif (strpos($string, 'VIDEO GAME') !== FALSE) {
      return self::GAME;
    } elseif (strpos($string, '(VIDEO)') !== FALSE) {
      return self::VIDEO;
    } elseif (strpos($string, '(SHORT)') !== FALSE) {
      return self::SHORT;
    } elseif (strpos($string, 'SPECIAL)') !== FALSE) {
      return self::SPECIAL;
    } else {
      return self::MOVIE;
    }
  }



  // Some backwards compatibility stuff. Don't use any of this - It will be removed

  protected $searchTerms;
  protected $episode_search = false;
  /**
   * Search for episodes or movies
   * @param boolean enabled TRUE: Search for episodes; FALSE: Search for movies (default)
   * @deprecated since version 2.2.4
   */
  public function search_episodes($enable) {
    trigger_error('imdbsearch has a new interface. Please use imdbsearch::search instead', E_USER_DEPRECATED);
    $this->episode_search = $enable;
  }

  /**
   * Set the name (title) to search for
   * @param string searchstring what to search for - (part of) the movie name
   * @deprecated since version 2.2.4
   */
  public function setsearchname($name) {
    trigger_error('imdbsearch has a new interface. Please use imdbsearch::search instead', E_USER_DEPRECATED);
    $this->searchTerms = $name;
  }

  /**
   * Perform the search
   * @param optional string URL Replace search URL by your own (Default: empty string)
   * @param optional boolean series whether to include TV series in search results (default: TRUE)
   * @param optional boolean s_episodes whether to include TV episodes in search results (default: TRUE)
   * @param optional boolean s_games whether to include games in search results (default: TRUE)
   * @param optional boolean s_video whether to include videos in search results (default: TRUE). These are often Making Ofs and the like
   * @param optional boolean s_short whether to include shorts in search results (default: TRUE)
   * @param optional boolean s_special whether to include specials in search results (default: TRUE)
   * @return array results array of objects (instances of the imdb class)
   * @deprecated since version 2.2.4
   */
  public function results($url = "", $series = TRUE, $s_episodes = TRUE, $s_games = TRUE, $s_video = TRUE, $s_short = TRUE, $s_special = TRUE) {
    trigger_error('imdbsearch has a new interface. Please use imdbsearch::search instead', E_USER_DEPRECATED);

    $searchTypes = [self::MOVIE];
    if ($series) {
      $searchTypes[] = self::TV;
    }
    if ($s_episodes) {
      $searchTypes[] = self::TV_EPISODE;
    }
    if ($s_games) {
      $searchTypes[] = self::GAME;
    }
    if ($s_video) {
      $searchTypes[] = self::VIDEO;
    }
    if ($s_short) {
      $searchTypes[] = self::SHORT;
    }
    if ($s_special) {
      $searchTypes[] = self::SPECIAL;
    }
    if ($this->episode_search) {
      // yea, this looks stupid .. but it's how the old one worked. This made a different call to imdb for episodes only
      $searchTypes = [self::TV_EPISODE];
    }

    return $this->search($this->searchTerms, $searchTypes);
  }

  /**
   * @deprecated since version 2.2.4
   */
  public function reset() {
    trigger_error('imdbsearch has a new interface. Please use imdbsearch::search instead', E_USER_DEPRECATED);
  }
}
