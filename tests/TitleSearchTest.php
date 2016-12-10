<?php

use Imdb\Config;
use Imdb\Title;
use Imdb\TitleSearch;

class TitleSearchTest extends PHPUnit_Framework_TestCase {
  public function test_searching_for_a_specific_film_returns_its_imdb_class_with_title_prepopulated() {
    $search = $this->getimdbsearch();
    $results = $search->search('The Lord of the Rings: The Fellowship of the Ring');

    $this->assertInternalType('array', $results);
    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    // Break its imdbsite so it can't make any external requests. This ensures the search class added these properties
    $firstResult->imdbsite = '';
    $this->assertEquals("0120737", $firstResult->imdbid());
    $this->assertEquals("The Lord of the Rings: The Fellowship of the Ring", $firstResult->title());
    $this->assertEquals(2001, $firstResult->year());
  }

  public function test_searching_for_a_movie_returns_only_movies() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Bebop', array(TitleSearch::MOVIE));
    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("0275277", $firstResult->imdbid());
    $this->assertEquals("Cowboy Bebop: The Movie", $firstResult->title());
    $this->assertEquals(2001, $firstResult->year());

    /* @var $secondResult Title */
    $secondResult = $results[1];
    $this->assertInstanceOf('\Imdb\Title', $secondResult);
    $this->assertEquals("1267295", $secondResult->imdbid());
    $this->assertEquals("Cowboy Bebop", $secondResult->title());
    $this->assertEquals(0, $secondResult->year());
  }

  public function test_searching_for_a_tv_show_returns_only_tv() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Bebop', array(TitleSearch::TV_SERIES));

    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("0213338", $firstResult->imdbid());
    $this->assertEquals("Cowboy Bebop", $firstResult->title());
    $this->assertEquals(1998, $firstResult->year());
  }

  public function test_searching_for_a_tv_episode_returns_only_tv_episode() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Funk', array(TitleSearch::TV_EPISODE));

    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("0618966", $firstResult->imdbid());
    $this->assertEquals("Cowboy Funk", $firstResult->title());
    $this->assertEquals(1999, $firstResult->year());
  }

  public function test_searching_for_a_game_returns_only_games() {
    $search = $this->getimdbsearch();
    $results = $search->search('Doom', array(TitleSearch::GAME));

    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("1799527", $firstResult->imdbid());
    $this->assertEquals("Doom", $firstResult->title());
    $this->assertEquals(2016, $firstResult->year());
  }

  public function test_searching_for_a_tv_miniseries_returns_only_miniseries() {
    $search = $this->getimdbsearch();
    $results = $search->search('Hatfields & McCoys', array(TitleSearch::TV_MINI_SERIES));

    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[0];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("1985443", $firstResult->imdbid());
    $this->assertEquals("Hatfields & McCoys", $firstResult->title());
    $this->assertEquals(2012, $firstResult->year());
  }

  // https://github.com/tboothman/imdbphp/pull/24
  // e.g. Home (II) (2015)
  public function test_movies_with_duplicate_name_per_year_get_a_year() {
    $search = $this->getimdbsearch();
    $results = $search->search('Home 2015', array(TitleSearch::MOVIE));
    $this->assertInternalType('array', $results);

    /* @var $firstResult Title */
    $firstResult = $results[1];
    $this->assertInstanceOf('\Imdb\Title', $firstResult);
    $this->assertEquals("2224026", $firstResult->imdbid());
    $this->assertEquals("Home", $firstResult->title());
    $this->assertEquals(2015, $firstResult->year());
  }

  protected function getimdbsearch() {
    $config = new Config();
    $config->language = 'en';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = false;
    $config->cache_expire = 3600;
    $config->debug = false;

    $imdbsearch = new TitleSearch($config);
    return $imdbsearch;
  }
}