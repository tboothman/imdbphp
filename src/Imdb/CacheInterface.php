<?php

namespace Imdb;

/**
 * Interface CacheInterface
 *
 * @author Yevgeniy Yanavichus <yevgeniy.yanavichus@sferastudios.com>
 */
interface CacheInterface {
  /**
   * Get string value of $key from cache
   *
   * @param string $key
   * @return string|null null on failure / cache miss
   */
  public function get($key);

  /**
   * Store $value to the cache.
   *
   * @param string $key
   * @param string $value
   * @return bool successful?
   */
  public function set($key, $value);

  /**
   * Check cache and purge outdated items
   */
  public function purge();
}
