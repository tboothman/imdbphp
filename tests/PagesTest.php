<?php

use Imdb\Pages;
use Imdb\Config;
use Imdb\Cache;
use Imdb\Logger;

class PagesTest extends PHPUnit_Framework_TestCase {
  public function testConstructor() {
    $pages = new Pages(new Config(), new Cache(new Config(), new Logger()), new Logger());
  }

  public function testGetRetrievesFromCache() {
    $cache = Mockery::mock('\Imdb\Cache', [
        'get' => 'test'
    ]);

    $pages = new Pages(new Config(), $cache, new Logger());

    $result = $pages->get('/');

    $this->assertEquals('test', $result);
  }

  public function testGetDoesNotUseCacheForSecondCall() {
    $cache = Mockery::mock('\Imdb\Cache');
    $cache->shouldReceive('get')->once()->andReturn('test');

    $pages = new Pages(new Config(), $cache, new Logger());

    $result = $pages->get('/');

    $this->assertEquals('test', $result);

    $result2 = $pages->get('/');

    $this->assertEquals('test', $result2);
  }

  public function testGetMakesRequestIfNotInCache() {
    $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
    $pages = Mockery::Mock('\Imdb\Pages[requestPage]', [new Config(), $cache, new Logger()]);
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('requestPage')->once()->andReturn('test');

    $result = $pages->get('/');
    $this->assertEquals('test', $result);
  }

  public function testGetSavesToCache() {
    $cache = Mockery::mock('\Imdb\Cache');

    $cache->shouldReceive('get')->once()->andReturn('test');
    $cache->shouldReceive('set')->with('test')->once()->andReturn(true);

    $pages = Mockery::Mock('\Imdb\Pages[requestPage]', [new Config(), $cache, new Logger()]);
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('requestPage')->once()->andReturn('test');

    $result = $pages->get('/');
    $this->assertEquals('test', $result);
  }

  /**
   * @expectedException \Imdb\Exception\Http
   */
  public function testGetThrowsExceptionIfHttpFails() {
    $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
    $request = Mockery::mock([
       'sendRequest' => false
    ]);
    $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', [new Config(), $cache, new Logger()]);
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('buildRequest')->once()->andReturn($request);
    $pages->get('test');
  }

  public function testGetDoesNotThrowExceptionIfHttpFailsAndThrowHttpExceptionsIsFalse() {
    $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
    $request = Mockery::mock([
       'sendRequest' => false
    ]);
    $config = new Config();
    $config->throwHttpExceptions = false;
    $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', [$config, $cache, new Logger()]);
    $pages->shouldAllowMockingProtectedMethods();
    $pages->shouldReceive('buildRequest')->once()->andReturn($request);
    $pages->get('test');
  }
}