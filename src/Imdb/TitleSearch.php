<?php

namespace Imdb;

class TitleSearch extends MdbBase {

  const MOVIE = Title::MOVIE;
  const TV_SERIES = Title::TV_SERIES;
  const TV_EPISODE = Title::TV_EPISODE;
  const TV_MINI_SERIES = Title::TV_MINI_SERIES;
  const TV_MOVIE = Title::TV_MOVIE;
  const TV_SPECIAL = Title::TV_SPECIAL;
  const TV_SHORT = Title::TV_SHORT;
  const GAME = Title::GAME;
  const VIDEO = Title::VIDEO;
  const SHORT = Title::SHORT;

  /**
   * Search IMDb for titles matching $searchTerms
   * @param string $searchTerms
   * @param array $wantedTypes *optional* imdb types that should be returned. Defaults to returning all types.
   *                            The class constants MOVIE,GAME etc should be used e.g. [TitleSearch::MOVIE, TitleSearch::TV_SERIES]
   * @param int $maxResults *optional* The maximum number of results to retrieve from IMDB. 0 for unlimited. Defaults to Config::$maxresults
   * @return Title[] array of Title objects
   */
  public function search($searchTerms, $wantedTypes = null, $maxResults = null) {
    $results = array();

    // @TODO remove maxresults? It has no effect on imdb and why would the user want less results than possible?
    if ($maxResults === null) {
      $maxResults = $this->maxresults;
    }

    $page = $this->getPage($searchTerms);

    // Parse & filter results
    if (preg_match_all('!class="result_text"\s*>\s*<a href="/title/tt(?<imdbid>\d{7})/[^>]*>(?<title>.*?)</a>\s*(\([^\d]+\)\s*)?(\((?<year>\d{4})(.*?|)\)|)(?<type>[^<]*)!ims', $page, $matches, PREG_SET_ORDER)) {
      foreach ($matches as $match) {
        if (count($results) == $maxResults) {
          break;
        }

        $type = $this->parseTitleType($match['type']);

        if (is_array($wantedTypes) && !in_array($type, $wantedTypes)) {
          continue;
        }

        $results[] = Title::fromSearchResult($match['imdbid'], $match['title'], $match['year'], $type, $this);
      }
    }

    return $results;
  }

  protected function parseTitleType($string) {
    $string = strtoupper($string);

    if (strpos($string, 'TV SERIES') !== FALSE) {
      return self::TV_SERIES;
    } elseif (strpos($string, 'TV EPISODE') !== FALSE) {
      return self::TV_EPISODE;
    } elseif (strpos($string, 'VIDEO GAME') !== FALSE) {
      return self::GAME;
    } elseif (strpos($string, '(VIDEO)') !== FALSE) {
      return self::VIDEO;
    } elseif (strpos($string, '(SHORT)') !== FALSE) {
      return self::SHORT;
    } elseif (strpos($string, 'TV MINI-SERIES)') !== FALSE) {
      return self::TV_MINI_SERIES;
    } elseif (strpos($string, 'TV MOVIE)') !== FALSE) {
      return self::TV_MOVIE;
    } elseif (strpos($string, 'TV SPECIAL)') !== FALSE) {
      return self::TV_SPECIAL;
    } elseif (strpos($string, 'TV SHORT)') !== FALSE) {
      return self::TV_SHORT;
    } else {
      return self::MOVIE;
    }
  }

  protected function buildUrl($searchTerms = null) {
    return "http://" . $this->imdbsite . "/find?s=tt&q=" . urlencode($searchTerms);
  }
}
