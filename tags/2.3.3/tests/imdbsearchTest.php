<?php

require_once dirname(__FILE__) . '/../imdbsearch.class.php';

class imdbsearchTest extends PHPUnit_Framework_TestCase {
  public function test_searching_for_a_specific_film_returns_its_imdb_class_with_title_prepopulated() {
    $search = $this->getimdbsearch();
    $results = $search->search('The Lord of the Rings: The Fellowship of the Ring');

    $this->assertInternalType('array', $results);
    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    // Break its imdbsite so it can't make any external requests. This ensures the search class added these properties
    $firstResult->imdbsite = '';
    $this->assertEquals("0120737", $firstResult->imdbid());
    $this->assertEquals("The Lord of the Rings: The Fellowship of the Ring", $firstResult->title());
    $this->assertEquals(2001, $firstResult->year());
  }

  public function test_searching_for_a_movie_returns_only_movies() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Bebop', [imdbsearch::MOVIE]);
    $this->assertInternalType('array', $results);

    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    $this->assertEquals("0275277", $firstResult->imdbid());
    $this->assertEquals("Cowboy Bebop: The Movie", $firstResult->title());
    $this->assertEquals(2001, $firstResult->year());

    /* @var $secondResult imdb */
    $secondResult = $results[1];
    $this->assertInstanceOf('imdb', $secondResult);
    $this->assertEquals("1267295", $secondResult->imdbid());
    $this->assertEquals("Cowboy Bebop", $secondResult->title());
    $this->assertEquals(0, $secondResult->year());
  }

  public function test_searching_for_a_tv_show_returns_only_tv() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Bebop', [imdbsearch::TV_SERIES]);

    $this->assertInternalType('array', $results);

    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    $this->assertEquals("0213338", $firstResult->imdbid());
    $this->assertEquals("Cowboy Bebop", $firstResult->title());
    $this->assertEquals(1998, $firstResult->year());
  }

  public function test_searching_for_a_tv_episode_returns_only_tv_episode() {
    $search = $this->getimdbsearch();
    $results = $search->search('Cowboy Funk', [imdbsearch::TV_EPISODE]);

    $this->assertInternalType('array', $results);

    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    $this->assertEquals("0618966", $firstResult->imdbid());
    $this->assertEquals("Cowboy Funk", $firstResult->title());
    $this->assertEquals(1999, $firstResult->year());
  }

  public function test_searching_for_a_game_returns_only_games() {
    $search = $this->getimdbsearch();
    $results = $search->search('Doom', [imdbsearch::GAME]);

    $this->assertInternalType('array', $results);

    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    $this->assertEquals("0286598", $firstResult->imdbid());
    $this->assertEquals("Ultimate Doom", $firstResult->title());
    $this->assertEquals(1993, $firstResult->year());

    /* @var $secondResult imdb */
    $secondResult = $results[1];
    $this->assertInstanceOf('imdb', $secondResult);
    $this->assertEquals("0291868", $secondResult->imdbid());
    $this->assertEquals("Doom³", $secondResult->title());
    $this->assertEquals(2004, $secondResult->year());
  }

  public function test_searching_for_a_tv_miniseries_returns_only_miniseries() {
    $search = $this->getimdbsearch();
    $results = $search->search('Hatfields & McCoys', [imdbsearch::TV_MINI_SERIES]);

    $this->assertInternalType('array', $results);

    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    $this->assertEquals("1985443", $firstResult->imdbid());
    $this->assertEquals("Hatfields & McCoys", $firstResult->title());
    $this->assertEquals(2012, $firstResult->year());
  }

  protected function getimdbsearch() {
    $config = new mdb_config();
    $config->language = 'en';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    $imdbsearch = new imdbsearch($config);
    return $imdbsearch;
  }
}