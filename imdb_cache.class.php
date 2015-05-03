<?php

require_once dirname(__FILE__)."/imdb_exception.class.php";

/**
 * File caching
 * Caches files to disk in config->cachedir optionally gzipping if config->usezip
 *
 * Config keys used: cachedir cache_expire usezip converttozip usecache storecache
 */
class imdb_cache {

  /**
   * @var mdb_config
   */
  protected $config;

  /**
   * @var imdb_logger
   */
  protected $logger;

  public function __construct(mdb_config $config, imdb_logger $logger) {
    $this->config = $config;
    $this->logger = $logger;

    if (($this->config->usecache || $this->config->storecache) && !is_dir($this->config->cachedir)) {
      $this->logger->critical("[Cache] Configured cache directory [{$this->config->cachedir}] does not exist!");
      throw new imdb_exception("[Cache] Configured cache directory [{$this->config->cachedir}] does not exist!");
    }
    if ($this->config->storecache && !is_writable($this->config->cachedir)) {
      $this->logger->critical("[Cache] Configured cache directory [{$this->config->cachedir}] lacks write permission!");
      throw new imdb_exception("[Cache] Configured cache directory [{$this->config->cachedir}] lacks write permission!");
    }
  }

  /**
   * Get string value of $key from cache
   * @param string $key
   * @return string|null null on failure / cache miss
   */
  public function get($key) {
    if (!$this->config->usecache) {
      return null;
    }

    $cleanKey = $this->sanitiseKey($key);

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
   * Store $value to the disk cache
   * @param string $key
   * @param string $value
   * @return bool successful?
   */
  public function set($key, $value) {
    if (!$this->config->storecache) {
      return false;
    }

    $cleanKey = $this->sanitiseKey($key);

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

    return true;
  }

  /**
   * Check cache and purge outdated files
   * This method looks for files older than the cache_expire set in the
   * mdb_config and removes them
   * @TODO add a limit on how frequently a purge can occur
   */
  public function purge() {
    $cacheDir = $this->config->cachedir;
    $this->logger->debug("[Cache] Purging old cache entries");

    $thisdir = dir($cacheDir);
    $now = time();
    while ($file = $thisdir->read()) {
      if ($file != "." && $file != "..") {
        $fname = $cacheDir . $file;
        if (is_dir($fname))
          continue;
        $mod = filemtime($fname);
        if ($mod && ($now - $mod > $this->config->cache_expire))
          unlink($fname);
      }
    }
  }

  private function sanitiseKey($key) {
    return str_replace(array('/', '\\', '?', '%', '*', ':', '|', '"', '<', '>'), '.', $key);
  }

}
