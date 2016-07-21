<?php

namespace Imdb;
use Psr\Log\LoggerInterface;

/**
 * Base class for a cache instance.
 *
 * @author Yevgeniy Yanavichus <yevgeniy.yanavichus@sferastudios.com>
 */
abstract class CacheBase implements CacheInterface {
  /**
   * @var Config
   */
  protected $config;

  /**
   * @var LoggerInterface
   */
  protected $logger;

  /**
   * CacheBase constructor.
   *
   * @param Config $config
   * @param LoggerInterface $logger OPTIONAL override default logger
   */
  public function __construct(Config $config = null, LoggerInterface $logger = null) {
    $this->config = empty($config) ? new Config() : $config;
    $this->logger = empty($logger) ? new Logger($this->config->debug) : $logger;
  }

  /**
   * @inheritdoc
   */
  public function get($key) {
    if (!$this->config->usecache) {
      return null;
    }

    $cleanKey = $this->sanitiseKey($key);

    return $this->getInternal($key, $cleanKey);
  }

  /**
   * Specific implementation which should be overridden
   *
   * @param string $key
   * @param string $cleanKey
   * @return string|null null on failure / cache miss
   */
  public abstract function getInternal($key, $cleanKey);

  /**
   * @inheritdoc
   */
  public function set($key, $value) {
    if (!$this->config->storecache) {
      return false;
    }

    $cleanKey = $this->sanitiseKey($key);

    $this->setInternal($key, $cleanKey, $value);

    return true;
  }

  /**
   * Specific implementation which should be overridden
   *
   * @param string $key
   * @param string $cleanKey
   * @param string $value
   * @return bool successful?
   */
  public abstract function setInternal($key, $cleanKey, $value);

  /**
   * @inheritdoc
   */
  public function purge() {
    if (!$this->config->storecache || $this->config->cache_expire == 0) {
      return;
    }

    $this->purgeInternal();
  }

  /**
   * Specific implementation which should be overridden
   */
  public abstract function purgeInternal();

  /**
   * Auxiliary method
   *
   * @param string $key
   * @return string
   */
  private function sanitiseKey($key) {
    return str_replace(array('/', '\\', '?', '%', '*', ':', '|', '"', '<', '>'), '.', $key);
  }
}
