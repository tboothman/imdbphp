<?php

use Imdb\Charts;

class imdb_chartsTest extends PHPUnit_Framework_TestCase {
  public function test_getChartsTop10() {
    $charts = new Charts();
    $moviemeter = $charts->getChartsTop10();

    $this->assertInternalType('array', $moviemeter);
    $this->assertCount(10, $moviemeter);
    for ($i = 0; $i < 10; $i++) {
      $this->assertInternalType('string', $moviemeter[$i]);
      $this->assertEquals(7, strlen($moviemeter[$i]));
    }
  }

  public function test_getChartsBoxOffice() {
    $charts = new Charts();
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
}