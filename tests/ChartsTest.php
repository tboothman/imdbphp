<?php

use Imdb\Charts;

class imdb_chartsTest extends PHPUnit_Framework_TestCase {
  public function test_getChartsTop10() {
    $charts = $this->getCharts();
    $moviemeter = $charts->getChartsTop10();

    $this->assertInternalType('array', $moviemeter);
    $this->assertCount(10, $moviemeter);
    for ($i = 0; $i < 10; $i++) {
      $this->assertInternalType('string', $moviemeter[$i]);
      $this->assertEquals(7, strlen($moviemeter[$i]));
    }
  }

  public function test_getChartsBoxOffice() {
    $charts = $this->getCharts();
    $boxOffice = $charts->getChartsBoxOffice();

    $this->assertInternalType('array', $boxOffice);
    $this->assertTrue(count($boxOffice) >= 9);
    $this->assertTrue(count($boxOffice) < 11);
    foreach ($boxOffice as $film) {
      $this->assertInternalType('array', $film);
      $this->assertCount(3, $film);
      $this->assertTrue(is_numeric($film['weekend']));
      $this->assertTrue(is_numeric($film['gross']));
    }
  }

  protected function getCharts() {
    $config = new \Imdb\Config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = false;
    $config->cache_expire = 3600;

    return new Charts($config);
  }
}