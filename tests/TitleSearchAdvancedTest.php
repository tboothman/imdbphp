<?php

use Imdb\Config;
use Imdb\TitleSearchAdvanced;

class imdb_titlesearchadvancedTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $this->getTitleSearchAdvanced();
  }

  public function test_by_language_year() {
    $search = $this->getTitleSearchAdvanced();
    $search->setLanguages(['en']);
    $search->setYear(2000);
    $list = $search->search();
    $this->assertInternalType('array', $list);
  }

  public function test_episodes() {
    $search = $this->getTitleSearchAdvanced();
    $search->setTitleTypes([TitleSearchAdvanced::TV_EPISODE]);
    $list = $search->search();
    $this->assertInternalType('array', $list);
  }

  protected function getTitleSearchAdvanced() {
    $config = new Config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new TitleSearchAdvanced();
  }
}