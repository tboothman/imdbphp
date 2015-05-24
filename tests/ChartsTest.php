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
    $this->assertCount(10, $boxOffice);
    for ($i = 0; $i < 10; $i++) {
      $this->assertInternalType('array', $boxOffice[$i]);
      $this->assertCount(3, $boxOffice[$i]);
      $this->assertTrue(is_numeric($boxOffice[$i]['weekend']));
      $this->assertTrue(is_numeric($boxOffice[$i]['gross']));
    }
  }
}