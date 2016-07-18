<?php

use Imdb\Pages;
use Imdb\Config;
use Imdb\Cache;
use Imdb\Logger;

class PagesTest extends PHPUnit_Framework_TestCase {
  public function testConstructor() {
    $pages = new Pages(new Config(), new Cache(new Config(), new Logger(false)), new Logger(false));
  }

  public function testGetRetrievesFromCache() {
    $cache = Mockery::mock('\Imdb\Cache', array(
        'get' => 'test'
    ));

    $pages = new Pages(new Config(), $cache, new Logger(false));

    $result = $pages->get('/');

    $this->assertEquals('test', $result);
  }

  public function testGetDoesNotUseCacheForSecondCall() {
    $cache = Mockery::mock('\Imdb\Cache');
    $cache->shouldReceive('get')->once()->andReturn('test');

    $pages = new Pages(new Config(), $cache, new Logger(false));

    $result = $pages->get('/');

    $this->assertEquals('test', $result);

    $result2 = $pages->get('/');

    $this->assertEquals('test', $result2);
  }

  public function testGetMakesRequestIfNotInCache() {
    $cache = Mockery::mock('\Imdb\Cache', array(
        'get' => null,
        'set' => true
    ));
    $pages = Mockery::Mock('\Imdb\Pages[requestPage]', array(new Config(), $cache, new Logger(false)));
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('requestPage')->once()->andReturn('test');

    $result = $pages->get('/');
    $this->assertEquals('test', $result);
  }

  public function testGetSavesToCache() {
    $cache = Mockery::mock('\Imdb\Cache');

    $cache->shouldReceive('get')->once()->andReturn(null);
    $cache->shouldReceive('set')->with('title/whatever', 'test')->once()->andReturn(true);

    $pages = Mockery::Mock('\Imdb\Pages[requestPage]', array(new Config(), $cache, new Logger(false)));
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('requestPage')->once()->andReturn('test');

    $result = $pages->get('/title/whatever');
    $this->assertEquals('test', $result);
    \Mockery::close();
  }

  /**
   * @expectedException \Imdb\Exception\Http
   */
  public function testGetThrowsExceptionIfHttpFails() {
    $cache = Mockery::mock('\Imdb\Cache', array(
        'get' => null,
        'set' => true
    ));
    $request = Mockery::mock(array(
       'sendRequest' => false
    ));
    $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', array(new Config(), $cache, new Logger(false)));
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('buildRequest')->once()->andReturn($request);
    $pages->get('test');
  }

  public function testGetDoesNotThrowExceptionIfHttpFailsAndThrowHttpExceptionsIsFalse() {
    $cache = Mockery::mock('\Imdb\Cache', array(
        'get' => null,
        'set' => true
    ));
    $request = Mockery::mock(array(
       'sendRequest' => false
    ));
    $config = new Config();
    $config->throwHttpExceptions = false;
    $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', array($config, $cache, new Logger(false)));
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('buildRequest')->once()->andReturn($request);
    $pages->get('test');
  }
}