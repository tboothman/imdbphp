<?php

namespace Tests;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Imdb\Pages;
use Imdb\Config;
use Imdb\Cache;
use Imdb\Logger;
use Mockery;
use PHPUnit_Framework_TestCase;

class PagesTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $pages = new Pages(new Config(), new Cache(new Config(), new Logger(false)), new Logger(false));
    }

    public function testGetRetrievesFromCache()
    {
        $cache = Mockery::mock('\Imdb\Cache', [
        'get' => 'test'
    ]);

        $pages = new Pages(new Config(), $cache, new Logger(false));

        $result = $pages->get('/');

        $this->assertEquals('test', $result);
    }

    // In particular PSR16 caches don't allow {}()/\@: in keys
    public function testGetRetrievesFromAnotherPSR16Cache()
    {
        $cache = new ArrayCachePool();
        $cache->set('search.title?locations=.test..', 'test');

        $pages = new Pages(new Config(), $cache, new Logger(false));

        // Get something that has characters the PSR16 spec doesn't like
        $result = $pages->get('/search/title?locations=(test:)');

        $this->assertEquals('test', $result);
    }

    // It should use its internal cache of the returned strings rather than using the cache object every time
    // The default cache is on disk and replacement cache would also probably involve some IO
    public function testGetDoesNotUseCacheObjectForSecondCall()
    {
        $cache = Mockery::mock('\Imdb\Cache');
        $cache->shouldReceive('get')->once()->andReturn('test');

        $pages = new Pages(new Config(), $cache, new Logger(false));

        $result = $pages->get('/');

        $this->assertEquals('test', $result);

        $result2 = $pages->get('/');

        $this->assertEquals('test', $result2);
    }

    public function testGetMakesRequestIfNotInCache()
    {
        $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
        $pages = Mockery::Mock('\Imdb\Pages[requestPage]', [new Config(), $cache, new Logger(false)]);
        $pages->shouldAllowMockingProtectedMethods();
        $pages->shouldReceive('requestPage')->once()->andReturn('test');

        $result = $pages->get('/');
        $this->assertEquals('test', $result);
    }

    public function testGetSavesToCache()
    {
        $config = new Config();

        $cache = Mockery::mock('\Imdb\Cache');
        $cache->shouldReceive('get')->once()->andReturn(null);
        $cache->shouldReceive('set')->with('title.whatever', 'test', $config->cache_expire)->once()->andReturn(true);

        $pages = Mockery::Mock('\Imdb\Pages[requestPage]', [$config, $cache, new Logger(false)]);
        $pages->shouldAllowMockingProtectedMethods();
        $pages->shouldReceive('requestPage')->once()->andReturn('test');

        $result = $pages->get('/title/whatever');
        $this->assertEquals('test', $result);
        \Mockery::close();
    }

    /**
     * @expectedException \Imdb\Exception\Http
     */
    public function testGetThrowsExceptionIfHttpFails()
    {
        $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
        $request = Mockery::mock([
       'sendRequest' => false
    ]);
        $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', [new Config(), $cache, new Logger(false)]);
        $pages->shouldAllowMockingProtectedMethods();
        $pages->shouldReceive('buildRequest')->once()->andReturn($request);
        $pages->get('test');
    }

    public function testGetDoesNotThrowExceptionIfHttpFailsAndThrowHttpExceptionsIsFalse()
    {
        $cache = Mockery::mock('\Imdb\Cache', [
        'get' => null,
        'set' => true
    ]);
        $request = Mockery::mock([
       'sendRequest' => false
    ]);
        $config = new Config();
        $config->throwHttpExceptions = false;
        $pages = Mockery::Mock('\Imdb\Pages[buildRequest]', [$config, $cache, new Logger(false)]);
        $pages->shouldAllowMockingProtectedMethods();
        $pages->shouldReceive('buildRequest')->once()->andReturn($request);
        $pages->get('test');
    }
}
