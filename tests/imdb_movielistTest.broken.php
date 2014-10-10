<?php

require_once dirname(__FILE__) . '/../imdb_movielist.class.php';

class imdb_movielistTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $budget = $this->getmovielist();
  }

  public function test_by_language_year() {
    $movieList = $this->getmovielist();
    $list = $movieList->by_language_year('english', 2000);
    $this->assertInternalType('array', $list);
  }

  protected function getmovielist() {
    $config = new mdb_config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new imdb_movielist($config);
  }
}