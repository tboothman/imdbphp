<?php

require_once dirname(__FILE__) . '/../imdb_person_search.class.php';

class imdb_person_searchTest extends PHPUnit_Framework_TestCase {
  public function test_searching_for_a_specific_actor_returns_him() {
    $search = $this->getimdbpersonsearch();
    $results = $search->search('Forest Whitaker');

    $this->assertInternalType('array', $results);
    //print_r($results);
    /* @var $firstResult imdb_person */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb_person', $firstResult);
    // Break its imdbsite so it can't make any external requests. This ensures the search class added these properties
    $firstResult->imdbsite = '';
    $this->assertEquals("0001845", $firstResult->imdbid());
    $this->assertEquals("Forest Whitaker", $firstResult->name());
  }

  protected function getimdbpersonsearch() {
    $config = new mdb_config();
    $config->language = 'en';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;
    $config->debug = false;

    $imdbsearch = new imdb_person_search($config);
    return $imdbsearch;
  }

  // @TODO more tests
}