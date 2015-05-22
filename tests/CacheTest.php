<?php

use ImdbPHP\Cache;
use ImdbPHP\Config;
use ImdbPHP\Logger;

class CacheTest extends PHPUnit_Framework_TestCase {

  private function getConfig() {
    $config = new Config();
    $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
    return $config;
  }

  /**
   * @expectedException \ImdbPHP\Exception
   */
  public function test_configured_directory_does_not_exist_causes_exception() {
    $config = new Config();
    $config->usezip = true;
    $config->cachedir = dirname(__FILE__).'/nonexistingfolder/';
    new Cache($config, new Logger());
  }

  /**
   * @expectedException \ImdbPHP\Exception
   */
  public function test_configured_directory_non_writeable_causes_exception() {
    $config = new Config();
    $config->usezip = true;
    $config->cachedir = dirname(__FILE__).'/cache_nonwriteable/';
    new Cache($config, new Logger());
  }

  public function test_get_returns_null_when_usecache_is_false() {
    $config = $this->getConfig();
    $cache = new Cache($config, new Logger());

    $cache->set('usecacheTest', 'value');

    $this->assertEquals('value', $cache->get('usecacheTest'));
    $config->usecache = false;
    $this->assertEquals(null, $cache->get('usecacheTest'));
  }

  public function test_set_does_not_cache_when_storecache_is_false() {
    $config = $this->getConfig();
    $config->storecache = false;
    $cache = new Cache($config, new Logger());

    $cache->set('storecacheTest', 'value');

    $this->assertEquals(null, $cache->get('storecacheTest'));
  }

  public function test_set_get_zipped() {
    $config = $this->getConfig();
    $config->usezip = true;
    $cache = new Cache($config, new Logger());

    $setOk = $cache->set('test1', 'a value');
    $this->assertTrue($setOk);

    $getValue = $cache->get('test1');
    $this->assertEquals('a value', $getValue);
  }

  public function test_set_get_notzipped() {
    $config = $this->getConfig();
    $config->usezip = false;
    $cache = new Cache($config, new Logger());

    $setOk = $cache->set('test2', 'a value');
    $this->assertTrue($setOk);

    $getValue = $cache->get('test2');
    $this->assertEquals('a value', $getValue);
  }

  public function test_purge() {
    $path = realpath(dirname(__FILE__).'/cache') . '/purge';
    @mkdir($path);

    $config = new Config();
    $config->usezip = false;
    $config->cachedir = $path . '/';
    $config->cache_expire = 1000;

    $cache = new Cache($config, new Logger());
    touch("$path/test-old", time()-1002);
    touch("$path/test-new");

    $cache->purge();

    $this->assertTrue(file_exists("$path/test-new"));
    $this->assertFalse(file_exists("$path/test-old"));

    unlink("$path/test-new");
    rmdir($path);
  }
}