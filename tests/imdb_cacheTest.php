<?php

require_once dirname(__FILE__) . '/../imdb_cache.class.php';
require_once dirname(__FILE__) . '/../imdb_logger.class.php';
require_once dirname(__FILE__) . '/../mdb_config.class.php';

class imdb_cacheTest extends PHPUnit_Framework_TestCase {
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

  public function test_set_get_zipped() {
    $config = new mdb_config();
    $config->usezip = true;
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    $cache = new imdb_cache($config, new imdb_logger());

    $setOk = $cache->set('test1', 'a value');
    $this->assertTrue($setOk);

    $getValue = $cache->get('test1');
    $this->assertEquals('a value', $getValue);
  }

  public function test_set_get_notzipped() {
    $config = new mdb_config();
    $config->usezip = false;
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
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