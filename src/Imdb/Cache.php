<?php

namespace Imdb;
use Psr\Log\LoggerInterface;

/**
 * File caching
 * Caches files to disk in config->cachedir optionally gzipping if config->usezip
 *
 * Config keys used: cachedir cache_expire usezip converttozip usecache storecache
 */
class Cache extends CacheBase {
  /**
   * Cache constructor.
   * @param Config $config
   * @param LoggerInterface $logger
   * @throws Exception
   */
  public function __construct(Config $config, LoggerInterface $logger) {
    parent::__construct($config, $logger);

    if (($this->config->usecache || $this->config->storecache) && !is_dir($this->config->cachedir)) {
      @mkdir($this->config->cachedir, 0700, true);
      if (!is_dir($this->config->cachedir)) {
        $this->logger->critical("[Cache] Configured cache directory [{$this->config->cachedir}] does not exist!");
        throw new Exception("[Cache] Configured cache directory [{$this->config->cachedir}] does not exist!");
      }
    }
    if ($this->config->storecache && !is_writable($this->config->cachedir)) {
      $this->logger->critical("[Cache] Configured cache directory [{$this->config->cachedir}] lacks write permission!");
      throw new Exception("[Cache] Configured cache directory [{$this->config->cachedir}] lacks write permission!");
    }
  }

  /**
   * @inheritdoc
   */
  public function getInternal($key, $cleanKey) {
    $fname = $this->config->cachedir . '/' . $cleanKey;
    if (!file_exists($fname)) {
      $this->logger->debug("[Cache] Cache miss for [$key]");
      return null;
    }

    $this->logger->debug("[Cache] Cache hit for [$key]");
    if ($this->config->usezip) {
      if (($content = @join("", @gzfile($fname)))) {
        if ($this->config->converttozip) {
          @$fp = fopen($fname, "r");
          $zipchk = fread($fp, 2);
          fclose($fp);
          if (!($zipchk[0] == chr(31) && $zipchk[1] == chr(139))) { //checking for zip header
            /* converting on access */
            $fp = @gzopen($fname, "w");
            @gzputs($fp, $content);
            @gzclose($fp);
          }
        }

        return $content;
      }
    } else { // no zip
      return file_get_contents($fname);
    }
  }

  /**
   * @inheritdoc
   */
  public function setInternal($key, $cleanKey, $value) {
    $fname = $this->config->cachedir . '/' . $cleanKey;
    $this->logger->debug("[Cache] Writing key [$key] to [$fname]");
    if ($this->config->usezip) {
      $fp = gzopen($fname, "w");
      gzputs($fp, $value);
      gzclose($fp);
    } else { // no zip
      $this->logger->debug("[Cache] Writing $fname");
      file_put_contents($fname, $value);
    }
  }

  /**
   * @inheritdoc
   *
   * This method looks for files older than the cache_expire set in the
   * mdb_config and removes them
   *
   * @TODO add a limit on how frequently a purge can occur
   */
  public function purgeInternal() {
    $cacheDir = $this->config->cachedir;
    $this->logger->debug("[Cache] Purging old cache entries");

    $thisdir = dir($cacheDir);
    $now = time();
    while ($file = $thisdir->read()) {
      if ($file != "." && $file != ".." && $file != ".placeholder") {
        $fname = $cacheDir . $file;
        if (is_dir($fname))
          continue;
        $mod = filemtime($fname);
        if ($mod && ($now - $mod > $this->config->cache_expire))
          unlink($fname);
      }
    }
  }
}
