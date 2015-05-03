<?php

require_once dirname(__FILE__) . '/../imdb_cache.class.php';
require_once dirname(__FILE__) . '/../imdb_logger.class.php';
require_once dirname(__FILE__) . '/../mdb_config.class.php';

class imdb_cacheTest extends PHPUnit_Framework_TestCase {

  private function getConfig() {
    $config = new mdb_config();
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    return $config;
  }

  /**
   * @expectedException imdb_exception
   */
  public function test_configured_directory_does_not_exist_causes_exception() {
    $config = new mdb_config();
    $config->usezip = true;
    $config->cachedir = dirname(__FILE__).'/nonexistingfolder/';
    new imdb_cache($config, new imdb_logger());
  }

  /**
   * @expectedException imdb_exception
   */
  public function test_configured_directory_non_writeable_causes_exception() {
    $config = new mdb_config();
    $config->usezip = true;
    $config->cachedir = dirname(__FILE__).'/cache_nonwriteable/';
    new imdb_cache($config, new imdb_logger());
  }

  public function test_get_returns_null_when_usecache_is_false() {
    $config = $this->getConfig();
    $cache = new imdb_cache($config, new imdb_logger());

    $cache->set('usecacheTest', 'value');

    $this->assertEquals('value', $cache->get('usecacheTest'));
    $config->usecache = false;
    $this->assertEquals(null, $cache->get('usecacheTest'));
  }

  public function test_set_does_not_cache_when_storecache_is_false() {
    $config = $this->getConfig();
    $config->storecache = false;
    $cache = new imdb_cache($config, new imdb_logger());

    $cache->set('storecacheTest', 'value');

    $this->assertEquals(null, $cache->get('storecacheTest'));
  }

  public function test_set_get_zipped() {
    $config = $this->getConfig();
    $config->usezip = true;
    $cache = new imdb_cache($config, new imdb_logger());

    $setOk = $cache->set('test1', 'a value');
    $this->assertTrue($setOk);

    $getValue = $cache->get('test1');
    $this->assertEquals('a value', $getValue);
  }

  public function test_set_get_notzipped() {
    $config = $this->getConfig();
    $config->usezip = false;
    $cache = new imdb_cache($config, new imdb_logger());

    $setOk = $cache->set('test2', 'a value');
    $this->assertTrue($setOk);

    $getValue = $cache->get('test2');
    $this->assertEquals('a value', $getValue);
  }

  public function test_purge() {
    $path = realpath(dirname(__FILE__).'/cache') . '/purge';
    @mkdir($path);

    $config = new mdb_config();
    $config->usezip = false;
    $config->cachedir = $path . '/';
    $config->cache_expire = 1000;

    $cache = new imdb_cache($config, new imdb_logger());
    touch("$path/test-old", time()-1002);
    touch("$path/test-new");

    $cache->purge();

    $this->assertTrue(file_exists("$path/test-new"));
    $this->assertFalse(file_exists("$path/test-old"));

    unlink("$path/test-new");
    rmdir($path);
  }
}