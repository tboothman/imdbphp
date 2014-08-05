<?php

require_once dirname(__FILE__) . '/../imdb_person.class.php';

class imdb_personTest extends PHPUnit_Framework_TestCase {
  public function test_constructor() {
    $search = $this->getimdb_person();
  }

  protected function getimdb_person($id = '0594503') {
    $config = new mdb_config();
    $config->language = 'en';
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $config->usezip = true;
    $config->cache_expire = 3600;

    return new imdb_person($id, $config);
  }
}