<?php

use Imdb\Config;
use Imdb\TitleSearchAdvanced;

class imdb_titlesearchadvancedTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $this->getTitleSearchAdvanced();
  }

  public function test_by_language_year() {
    $search = $this->getTitleSearchAdvanced();
    $search->setLanguages(array('en'));
    $search->setYear(2000);
    $list = $search->search();
    $this->assertInternalType('array', $list);
    $this->assertCount(50, $list);
  }

  public function test_episodes() {
    $search = $this->getTitleSearchAdvanced();
    $search->setTitleTypes(array(TitleSearchAdvanced::TV_EPISODE));
    $list = $search->search();
    $this->assertInternalType('array', $list);
    $this->assertCount(50, $list);

    foreach ($list as $result) {
      $this->assertNotEmpty($result['title']);
      $this->assertEquals('TV Series', $result['type']);
      $this->assertTrue($result['serial']);
      $this->assertNotEmpty($result['episode_title']);
      $this->assertNotEmpty($result['episode_imdbid']);
    }
  }

  public function test_sort() {
    $search = $this->getTitleSearchAdvanced();
    $search->setSort(TitleSearchAdvanced::SORT_NUM_VOTES);
    $search->setYear(2003);
    $search->setTitleTypes(array(TitleSearchAdvanced::TV_EPISODE));
    $list = $search->search();

    $this->assertInternalType('array', $list);
    $this->assertCount(50, $list);

    $firstResult = $list[0];

    $this->assertInternalType('array', $firstResult);
    $this->assertEquals('0303461', $firstResult['imdbid']);
    $this->assertEquals('Firefly', $firstResult['title']);
    $this->assertEquals('2002', $firstResult['year']);
    $this->assertEquals('TV Series', $firstResult['type']);
    $this->assertEquals('0579540', $firstResult['episode_imdbid']);
    $this->assertEquals('Trash', $firstResult['episode_title']);
    $this->assertEquals(2003, $firstResult['episode_year']);

    $secondResult = $list[1];

    $this->assertInternalType('array', $secondResult);
    $this->assertEquals('0303461', $secondResult['imdbid']);
    $this->assertEquals('Firefly', $secondResult['title']);
    $this->assertEquals('2002', $secondResult['year']);
    $this->assertEquals('TV Series', $secondResult['type']);
    $this->assertEquals('0579538', $secondResult['episode_imdbid']);
    $this->assertEquals('The Message', $secondResult['episode_title']);
    $this->assertEquals(2003, $secondResult['episode_year']);
  }

  protected function getTitleSearchAdvanced() {
    $config = new Config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = false;
    $config->cache_expire = 3600;

    return new TitleSearchAdvanced($config);
  }
}
