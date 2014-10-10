<?php

require_once dirname(__FILE__) . '/../imdb_budget.class.php';

class imdb_budgetTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $budget = $this->getimdb_budget();
  }

  public function test_budget() {
    $budget = $this->getimdb_budget();
    $this->assertEquals(63000000, $budget->budget());
  }

  public function test_openingWeekend_multiple() {
    $budget = $this->getimdb_budget();
    $openingWeekend = $budget->openingWeekend();
    $this->assertInternalType('array', $openingWeekend);

    $firstItem = $openingWeekend[0];
    $this->assertEquals('$27,788,331', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-04-04', $firstItem['date']);
    $this->assertEquals(2849, $firstItem['nbScreens']);

    $secondItem = $openingWeekend[1];
    $this->assertEquals('&#163;3,384,948', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-06-13', $secondItem['date']);
    $this->assertEquals(361, $secondItem['nbScreens']);
  }

  public function test_gross_multiple() {
    $budget = $this->getimdb_budget();
    $gross = $budget->gross();
    $this->assertInternalType('array', $gross);

    $firstItem = $gross[0];
    $this->assertEquals('$171,479,930', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-09-26', $firstItem['date']);

    $secondItem = $gross[26];
    $this->assertEquals('&#163;16,918,842', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-08-29', $secondItem['date']);
  }

  public function test_weekendGross_multiple() {
    $budget = $this->getimdb_budget();
    $weekendGross = $budget->weekendGross();
    $this->assertInternalType('array', $weekendGross);

    $firstItem = $weekendGross[0];
    $this->assertEquals('$1,011,566', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-06-27', $firstItem['date']);
    $this->assertEquals(1139, $firstItem['nbScreens']);

    $secondItem = $weekendGross[13];
    $this->assertEquals('&#163;63,166', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-08-29', $secondItem['date']);
    $this->assertEquals(87, $secondItem['nbScreens']);
  }

  public function test_admissions_multiple() {
    $budget = $this->getimdb_budget();
    $admissions = $budget->admissions();
    $this->assertInternalType('array', $admissions);

    $firstItem = $admissions[0];
    $this->assertEquals(178659, $firstItem['value']);
    $this->assertEquals('Germany', $firstItem['country']);
    $this->assertEquals('2003-05-25', $firstItem['date']);

    $secondItem = $admissions[1];
    $this->assertEquals(3194163, $secondItem['value']);
    $this->assertEquals('Germany', $secondItem['country']);
    $this->assertEquals('1999-07-18', $secondItem['date']);
  }

  public function test_filmingDates() {
    $budget = $this->getimdb_budget();

    $filmingDates = $budget->filmingDates();
    $this->assertInternalType('array', $filmingDates);
    $this->assertEquals('1998-03-14', $filmingDates['beginning']);
    $this->assertEquals('1998-09-01', $filmingDates['end']);
  }

  protected function getimdb_budget($id = '0133093') {
    $config = new mdb_config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new imdb_budget($id, $config);
  }
}