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
    $this->assertCount(50, $list);
  }

  public function test_episodes() {
    $search = $this->getTitleSearchAdvanced();
    $search->setTitleTypes([TitleSearchAdvanced::TV_EPISODE]);
    $list = $search->search();
    $this->assertInternalType('array', $list);
    $this->assertCount(50, $list);
  }

  public function test_sort() {
    $search = $this->getTitleSearchAdvanced();
    $search->setSort(TitleSearchAdvanced::SORT_NUM_VOTES);
    $search->setYear(2003);
    $search->setTitleTypes([TitleSearchAdvanced::TV_EPISODE]);
    $list = $search->search();

    $this->assertInternalType('array', $list);
    $this->assertCount(50, $list);

    $firstResult = $list[0];

    $this->assertInternalType('array', $firstResult);
    $this->assertEquals('0303461', $firstResult['imdbid']);
    $this->assertEquals('Firefly', $firstResult['title']);
    $this->assertEquals('2002', $firstResult['year']);
    $this->assertEquals('TV Series', $firstResult['type']);
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
