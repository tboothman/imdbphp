<?php

require_once dirname(__FILE__) . '/../imdbsearch2.class.php';

class imdbsearchTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {
    set_error_handler(function(){});
  }

  public function test_searching_for_a_specific_film_returns_its_imdb_class_with_title_prepopulated() {
    $search = $this->getimdbsearch();
    $search->setsearchname('The Lord of the Rings: The Fellowship of the Ring');
    $results = $search->results();

    $this->assertInternalType('array', $results);
    /* @var $firstResult imdb */
    $firstResult = $results[0];
    $this->assertInstanceOf('imdb', $firstResult);
    // Break its imdbsite so it can't make any external requests. This ensures the search class added these properties
    $firstResult->imdbsite = '';
    $this->assertEquals($firstResult->imdbid(), "0120737");
    $this->assertEquals($firstResult->title(), "The Lord of the Rings: The Fellowship of the Ring");
    $this->assertEquals($firstResult->year(), 2001);
  }

  protected function getimdbsearch() {
    $imdbsearch = new imdbsearch2();
    $imdbsearch->language = 'en';
    $imdbsearch->cachedir = realpath(dirname(__FILE__).'/cache');
    $imdbsearch->usezip = true;
    $imdbsearch->cache_expire = 9999999999;
    $imdbsearch->debug = true;
    return $imdbsearch;
  }
}