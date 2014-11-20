<?php

require_once dirname(__FILE__) . '/../imdb_person.class.php';

class imdb_personTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $search = $this->getimdb_person();
  }

  public function test_main_url() {
    $search = $this->getimdb_person();
    $this->assertEquals('http://www.imdb.com/name/nm0594503/', $search->main_url());
  }

  public function test_name() {
    $search = $this->getimdb_person();
    $this->assertEquals('Hayao Miyazaki', $search->name());
  }

  public function test_savephoto() {
    //@todo
    return;
    $search = $this->getimdb_person();
    $this->assertEquals('', $search->savephoto());
  }

  public function test_localurl() {
    //@todo
    return;
    $search = $this->getimdb_person();
    $this->assertEquals('', $search->localurl());
  }

  public function test_movies_all() {
    $search = $this->getimdb_person();
    $result = $search->movies_all();
    $this->assertInternalType('array', $result);
    $this->assertCount(157, $result);
  }

  public function test_movies_actress() {
    $search = $this->getimdb_person();
    $result = $search->movies_actress();
    $this->assertInternalType('array', $result);
    $this->assertCount(0, $result);
  }

  //@TODO test with an actress

  public function test_movies_actor() {
    $search = $this->getimdb_person();
    $result = $search->movies_actor();
    $this->assertInternalType('array', $result);
    $this->assertCount(3, $result);
    $this->assertEquals('2511906', $result[0]['mid']);
    $this->assertEquals('Kyoshinhei Tôkyô ni arawaru', $result[0]['name']);
    $this->assertEquals('2012', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('Giant robot', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_producer() {
    $search = $this->getimdb_person();
    $result = $search->movies_producer();
    $this->assertInternalType('array', $result);
    $this->assertCount(11, $result);
    $this->assertEquals('1568921', $result[0]['mid']);
    $this->assertEquals('Arrietty', $result[0]['name']);
    $this->assertEquals('2010', $result[0]['year']);
    //@TODO 'chname' as 'Producer' is surely wrong, it should be executive producer or nothing
//    $this->assertEquals('', $result[0]['chid']);
//    $this->assertEquals('', $result[0]['chname']);
//    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_director() {
    $search = $this->getimdb_person();
    $result = $search->movies_director();
    $this->assertInternalType('array', $result);
    $this->assertCount(25, $result);
    $this->assertEquals('2013293', $result[0]['mid']);
    $this->assertEquals('The Wind Rises', $result[0]['name']);
    $this->assertEquals('2013', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    //@TODO this says 'Director' .. doesn't seem right
    //$this->assertEquals('', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_soundtrack() {
    $search = $this->getimdb_person();
    $result = $search->movies_soundtrack();
    $this->assertInternalType('array', $result);
    $this->assertCount(3, $result);
    $this->assertEquals('1798188', $result[0]['mid']);
    $this->assertEquals('From Up on Poppy Hill', $result[0]['name']);
    $this->assertEquals('2011', $result[0]['year']);
    //@TODO where did 'lyrics: "Kon'iro no Uneri ga"' go?
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_crew() {
    $search = $this->getimdb_person();
    $result = $search->movies_crew();
    $this->assertInternalType('array', $result);
    $this->assertCount(8, $result);
     $this->assertEquals('From Up on Poppy Hill', $result[0]['name']);
    $this->assertEquals('2011', $result[0]['year']);
    //@TODO where did 'planning' go?
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_thanx() {
    $search = $this->getimdb_person();
    $result = $search->movies_thanx();
    $this->assertInternalType('array', $result);
    $this->assertCount(3, $result);
    $this->assertEquals('1957945', $result[0]['mid']);
    $this->assertEquals('La Luna', $result[0]['name']);
    $this->assertEquals('2011', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_self() {
    $search = $this->getimdb_person();
    $result = $search->movies_self();
    $this->assertInternalType('array', $result);
    $this->assertCount(23, $result);
    $this->assertEquals('1095875', $result[0]['mid']);
    $this->assertEquals('Jônetsu tairiku', $result[0]['name']);
    $this->assertEquals('2014', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('Himself', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_writer() {
    $search = $this->getimdb_person();
    $result = $search->movies_writer();
    $this->assertInternalType('array', $result);
    $this->assertCount(34, $result);
    $this->assertEquals('2013293', $result[0]['mid']);
    $this->assertEquals('The Wind Rises', $result[0]['name']);
    $this->assertEquals('2013', $result[0]['year']);
    //@TODO (comic) / (screenplay)  ????
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_movies_archive() {
    $search = $this->getimdb_person();
    $result = $search->movies_archive();
    $this->assertInternalType('array', $result);
    $this->assertCount(1, $result);
    $this->assertEquals('0318251', $result[0]['mid']);
    $this->assertEquals('Troldspejlet', $result[0]['name']);
    $this->assertEquals('2009', $result[0]['year']);
    $this->assertEquals('', $result[0]['chid']);
    $this->assertEquals('Himself', $result[0]['chname']);
    $this->assertEquals('', $result[0]['addons']);
  }

  public function test_birthname() {
    $search = $this->getimdb_person();
    $this->assertEquals('', $search->birthname());
  }

  //@TODO find someone with a different birth name

  public function test_nickname() {
    $search = $this->getimdb_person();
    $result = $search->nickname();
    $this->assertInternalType('array', $result);
    $this->assertCount(1, $result);
    $this->assertEquals('the Japanese Walt Disney', $result[0]);
  }

  public function test_movies_born() {
    $search = $this->getimdb_person();
    $result = $search->born();
    $this->assertInternalType('array', $result);
    $this->assertCount(5, $result);
    $this->assertEquals('5', $result['day']);
    $this->assertEquals('January', $result['month']);
    $this->assertEquals('1', $result['mon']);
    $this->assertEquals('1941', $result['year']);
    $this->assertEquals('Tokyo, Japan', $result['place']);
  }

  public function test_movies_died() {
    $search = $this->getimdb_person('0005132');
    $result = $search->died();
    $this->assertCount(6, $result);
    $this->assertEquals('22', $result['day']);
    $this->assertEquals('January', $result['month']);
    $this->assertEquals('1', $result['mon']);
    $this->assertEquals('2008', $result['year']);
    $this->assertEquals('Manhattan, New York City, New York, USA', $result['place']);
    $this->assertEquals('accidental overdose of prescription drugs', $result['cause']);
  }

  public function test_movies_died_without_cause() {
    $search = $this->getimdb_person('0662730');
    $result = $search->died();
    $this->assertCount(6, $result);
    $this->assertEquals('19', $result['day']);
    $this->assertEquals('October', $result['month']);
    $this->assertEquals('10', $result['mon']);
    $this->assertEquals('2014', $result['year']);
    $this->assertEquals('Toronto, Ontario, Canada', $result['place']);
    $this->assertEquals(null, $result['cause']);
  }

  public function test_height() {
    $search = $this->getimdb_person();
    $result = $search->height();
    $this->assertInternalType('array', $result);
    $this->assertEquals("5' 4½\"", $result['imperial']);
    $this->assertEquals('1.64 m', $result['metric']);
  }

  //@TODO Write proper tests for this method
  public function test_spouse() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->spouse());
  }

  //@TODO Write proper tests for this method
  public function test_bio() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->bio());
  }

  //@TODO Write proper tests for this method
  public function test_trivia() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->trivia());
  }

  //@TODO Write proper tests for this method
  public function test_quotes() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->quotes());
  }

  //@TODO Write proper tests for this method
  public function test_trademark() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->trademark());
  }

  //@TODO Write proper tests for this method
  public function test_salary() {
    $search = $this->getimdb_person();
    $this->assertEmpty($search->salary());
  }

  //@TODO find someone with a salary

  //@TODO Write proper tests for this method
  public function test_pubprints() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->pubprints());
  }

  //@TODO Write proper tests for this method
  public function test_pubmovies() {
    $search = $this->getimdb_person();
    //$this->assertNotEmpty($search->pubmovies());
  }

  //@TODO Write proper tests for this method
  public function test_pubportraits() {
    $search = $this->getimdb_person();
    //$this->assertNotEmpty($search->pubportraits());
  }

  //@TODO Write proper tests for this method
  public function test_interviews() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->interviews());
  }

  //@TODO Write proper tests for this method
  public function test_articles() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->articles());
  }

  //@TODO Write proper tests for this method
  public function test_pictorials() {
    $search = $this->getimdb_person();
    //$this->assertNotEmpty($search->pictorials());
  }

  //@TODO Write proper tests for this method
  public function test_magcovers() {
    $search = $this->getimdb_person();
    $this->assertNotEmpty($search->magcovers());
  }


  protected function getimdb_person($id = '0594503') {
    $config = new mdb_config();
    $config->language = 'en-GB';
    $config->imdbsite = 'www.imdb.com';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new imdb_person($id, $config);
  }
}