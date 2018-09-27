<?php

use \Imdb\Title;

class imdb_personTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $this->getimdb_person();
  }

  public function test_main_url() {
    $person = $this->getimdb_person();
    $this->assertEquals('https://www.imdb.com/name/nm0594503/', $person->main_url());
  }

  public function test_name() {
    $person = $this->getimdb_person();
    $this->assertEquals('Hayao Miyazaki', $person->name());
  }

  public function test_savephoto() {
    //@todo
    return;
    $person = $this->getimdb_person();
    $this->assertEquals('', $person->savephoto());
  }

  public function test_movies_all() {
    $person = $this->getimdb_person();
    $result = $person->movies_all();
    $this->assertInternalType('array', $result);
	$this->assertGreaterThan(176, count($result));
  }

  public function test_movies_actress() {
    $person = $this->getimdb_person();
    $result = $person->movies_actress();
    $this->assertInternalType('array', $result);
    $this->assertCount(0, $result);
  }

  public function test_movies_actor() {
    $person = $this->getimdb_person();
    $result = $person->movies_actor();
    $this->assertInternalType('array', $result);
    $this->assertCount(3, $result);
    $this->assertEquals('2511906', $result[0]['mid']);
    $this->assertEquals('Giant God Warrior Appears in Tokyo', $result[0]['name']);
    $this->assertEquals('2012', $result[0]['year']);
    $this->assertEquals(Title::SHORT, $result[0]['title_type']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('Giant robot', $result[0]['chname']);
    $this->assertEquals(array('voice'), $result[0]['addons']);
  }

  public function test_movies_producer() {
    $person = $this->getimdb_person();
    $result = $person->movies_producer();
    $this->assertInternalType('array', $result);
    $this->assertCount(12, $result);
    $arrietty = $result[1];
    $this->assertEquals('1568921', $arrietty['mid']);
    $this->assertEquals('Arrietty', $arrietty['name']);
    $this->assertEquals('2010', $arrietty['year']);
    $this->assertEquals(Title::MOVIE, $arrietty['title_type']);
    //@TODO 'chname' as 'Producer' is surely wrong, it should be executive producer or nothing
//    $this->assertEquals('', $result[0]['chid']);
//    $this->assertEquals('', $result[0]['chname']);
//    $this->assertEquals('', $result[0]['addons']);

    $houseHunting = $result[3];
    $this->assertEquals('0756260', $houseHunting['mid']);
    $this->assertEquals('House-hunting', $houseHunting['name']);
    $this->assertEquals('2006', $houseHunting['year']);
    $this->assertEquals(Title::SHORT, $houseHunting['title_type']);

    // 'Documentary' mapped to Movie
    $yanagawa = $result[11];
    $this->assertEquals('0094345', $yanagawa['mid']);
    $this->assertEquals('The Story of Yanagawa\'s Canals', $yanagawa['name']);
    $this->assertEquals('1987', $yanagawa['year']);
    $this->assertEquals(Title::MOVIE, $yanagawa['title_type']);
  }

  public function test_movies_director() {
    $person = $this->getimdb_person();
    $result = $person->movies_director();
    $this->assertInternalType('array', $result);
    $this->assertGreaterThan(28, $result);
    $windRises = $result[2];
    $this->assertEquals('2013293', $windRises['mid']);
    $this->assertEquals('The Wind Rises', $windRises['name']);
    $this->assertEquals('2013', $windRises['year']);
    $this->assertEquals(\Imdb\Title::MOVIE, $windRises['title_type']);
    $this->assertEquals('', $windRises['chid']);
    //@TODO this says 'Director' .. doesn't seem right
    //$this->assertEquals('', $result[0]['chname']);
    $this->assertEquals(array(), $windRises['addons']);

    // Short
    $mrDough = $result[3];
    $this->assertEquals('1857816', $mrDough['mid']);
    $this->assertEquals('Mr. Dough and the Egg Princess', $mrDough['name']);
    $this->assertEquals('2010', $mrDough['year']);
    $this->assertEquals(\Imdb\Title::SHORT, $mrDough['title_type']);
    $this->assertEquals('', $mrDough['chid']);
    $this->assertEquals(array(), $mrDough['addons']);

    // TV Series
    $sherlockHound = $result[20];
    $this->assertEquals('0088109', $sherlockHound['mid']);
    $this->assertEquals('Sherlock Hound', $sherlockHound['name']);
    $this->assertEquals('', $sherlockHound['year']);
    $this->assertEquals(\Imdb\Title::TV_SERIES, $sherlockHound['title_type']);
    $this->assertEquals('', $sherlockHound['chid']);
    $this->assertEquals(array(), $sherlockHound['addons']);
  }

  public function test_movies_soundtrack() {
    $person = $this->getimdb_person();
    $result = $person->movies_soundtrack();
    $this->assertInternalType('array', $result);
    $this->assertCount(4, $result);
    $this->assertEquals('1798188', $result[0]['mid']);
    $this->assertEquals('From Up on Poppy Hill', $result[0]['name']);
    $this->assertEquals('2011', $result[0]['year']);
    //@TODO where did 'lyrics: "Kon'iro no Uneri ga"' go?
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals(array(), $result[0]['addons']);
  }

  public function test_movies_crew() {
    $person = $this->getimdb_person();
    $result = $person->movies_crew();
    $this->assertInternalType('array', $result);
    $this->assertCount(8, $result);
     $this->assertEquals('From Up on Poppy Hill', $result[0]['name']);
    $this->assertEquals('2011', $result[0]['year']);
    //@TODO where did 'planning' go?
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals(array(), $result[0]['addons']);
  }

  public function test_movies_thanx() {
    $person = $this->getimdb_person();
    $result = $person->movies_thanx();
    $this->assertInternalType('array', $result);
    $this->assertCount(6, $result);
    $laLuna = $result[2];
    $this->assertEquals('1957945', $laLuna['mid']);
    $this->assertEquals('La Luna', $laLuna['name']);
    $this->assertEquals('2011', $laLuna['year']);
    $this->assertEquals('', $laLuna['chid']);
    $this->assertEquals('', $laLuna['chname']);
    $this->assertEquals(array(), $laLuna['addons']);
  }

  public function test_movies_self() {
    $person = $this->getimdb_person();
    $result = $person->movies_self();
    $this->assertInternalType('array', $result);
	$this->assertGreaterThan(26, count($result));
    $movie = $result[2];
    $this->assertEquals('1095875', $movie['mid']);
    $this->assertEquals('Jônetsu tairiku', $movie['name']);
    $this->assertEquals('2014', $movie['year']);
    $this->assertEquals('', $movie['chid']);
    $this->assertEquals('Himself', $movie['chname']);
    $this->assertEquals(array(), $movie['addons']);
  }

  public function test_movies_writer() {
    $person = $this->getimdb_person();
    $result = $person->movies_writer();
    $this->assertInternalType('array', $result);
    $this->assertCount(40, $result);
    $windRises = $result[3];
    $this->assertEquals('2013293', $windRises['mid']);
    $this->assertEquals('The Wind Rises', $windRises['name']);
    $this->assertEquals('2013', $windRises['year']);
    //@TODO (comic) / (screenplay)  ????
    $this->assertEquals('', $windRises['chid']);
    $this->assertEquals('', $windRises['chname']);
    $this->assertEquals(array(), $windRises['addons']);
  }

  public function test_movies_archive() {
    $person = $this->getimdb_person();
    $result = $person->movies_archive();
    $this->assertInternalType('array', $result);
    $this->assertCount(2, $result);

    $this->assertEquals('3674910', $result[0]['mid']);
//    $this->assertEquals('The 87th Annual Academy Awards', $result[0]['name']);
    $this->assertEquals('2015', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('Himself - Honorary Award Recipient', $result[0]['chname']);
    $this->assertEquals(array(), $result[0]['addons']);

    $this->assertEquals('0318251', $result[1]['mid']);
    $this->assertEquals('Troldspejlet', $result[1]['name']);
    $this->assertEquals('2009', $result[1]['year']);
    $this->assertEquals('', $result[1]['chid']);
    $this->assertEquals('Himself', $result[1]['chname']);
    $this->assertEquals(array(), $result[1]['addons']);
  }

  public function test_birthname() {
    $person = $this->getimdb_person();
    $this->assertEquals('', $person->birthname());
  }

  //@TODO find someone with a different birth name

  public function test_nickname() {
    $person = $this->getimdb_person();
    $result = $person->nickname();
    $this->assertInternalType('array', $result);
    $this->assertCount(1, $result);
    $this->assertEquals('the Japanese Walt Disney', $result[0]);
  }

  public function test_movies_born() {
    $person = $this->getimdb_person();
    $result = $person->born();
    $this->assertInternalType('array', $result);
    $this->assertCount(5, $result);
    $this->assertEquals('5', $result['day']);
    $this->assertEquals('January', $result['month']);
    $this->assertEquals('1', $result['mon']);
    $this->assertEquals('1941', $result['year']);
    $this->assertEquals('Tokyo, Japan', $result['place']);
  }

  public function test_movies_died() {
    $person = $this->getimdb_person('0005132');
    $result = $person->died();
    $this->assertCount(6, $result);
    $this->assertEquals('22', $result['day']);
    $this->assertEquals('January', $result['month']);
    $this->assertEquals('1', $result['mon']);
    $this->assertEquals('2008', $result['year']);
    $this->assertEquals('Manhattan, New York City, New York, USA', $result['place']);
    $this->assertEquals('accidental overdose of prescription drugs', $result['cause']);
  }

  public function test_movies_died_without_cause() {
    $person = $this->getimdb_person('0662730');
    $result = $person->died();
    $this->assertCount(6, $result);
    $this->assertEquals('19', $result['day']);
    $this->assertEquals('October', $result['month']);
    $this->assertEquals('10', $result['mon']);
    $this->assertEquals('2014', $result['year']);
    $this->assertEquals('Toronto, Ontario, Canada', $result['place']);
    $this->assertEquals(null, $result['cause']);
  }

  public function test_height() {
    $person = $this->getimdb_person();
    $result = $person->height();
    $this->assertInternalType('array', $result);
    $this->assertEquals("5' 4½\"", $result['imperial']);
    $this->assertEquals('1.64 m', $result['metric']);
  }

  //@TODO Write proper tests for this method
  public function test_spouse() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->spouse());
  }

  //@TODO Write proper tests for this method
  public function test_bio() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->bio());
  }

  //@TODO Write proper tests for this method
  public function test_trivia() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->trivia());
  }

  //@TODO Write proper tests for this method
  public function test_quotes() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->quotes());
  }

  //@TODO Write proper tests for this method
  public function test_trademark() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->trademark());
  }

  //@TODO Write proper tests for this method
  public function test_salary() {
    $person = $this->getimdb_person();
    $this->assertEmpty($person->salary());
  }

  //@TODO find someone with a salary

  //@TODO Write proper tests for this method
  public function test_pubprints() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->pubprints());
  }

  //@TODO Write proper tests for this method
  public function test_pubmovies() {
    $person = $this->getimdb_person('386944');
    $pubMovies = $person->pubmovies();
    $this->assertNotEmpty($pubMovies);
    $this->assertGreaterThan(20, count($pubMovies));
    $this->assertLessThan(35, count($pubMovies));
  }

  //@TODO Write proper tests for this method
  public function test_pubportraits() {
    $person = $this->getimdb_person('386944');
    $this->assertNotEmpty($person->pubportraits());
  }

  //@TODO Write proper tests for this method
  public function test_interviews() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->interviews());
  }

  //@TODO Write proper tests for this method
  public function test_articles() {
    $person = $this->getimdb_person();
    $this->assertNotEmpty($person->articles());
  }

  //@TODO Write proper tests for this method
  public function test_pictorials() {
    $person = $this->getimdb_person(386944);
    $this->assertNotEmpty($person->pictorials());
  }

  public function test_magcovers() {
    $person = $this->getimdb_person();
    $result = $person->magcovers();
    $this->assertNotEmpty($result);
    $this->assertCount(1, $result);
    $first = $result[0];
    $this->assertEquals(array (
      'inturl' => '',
      'name' => 'Comixene (DE)',
      'date' =>
        array (
          'day' => '',
          'month' => 'September',
          'mon' => '09',
          'year' => '2005',
          'full' => 'September 2005',
        ),
      'details' => 'Iss. 89',
      'auturl' => '',
      'author' => '',
    ), $first);
  }


  protected function getimdb_person($id = '0594503') {
    $config = new \Imdb\Config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new \Imdb\Person($id, $config);
  }
}