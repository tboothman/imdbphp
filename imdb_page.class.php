<?php

/**
 * Handles requesting urls, including the caching layer
 */
class imdb_page {

  /**
   * @var mdb_config
   */
  protected $config;

  /**
   * @var imdb_cache
   */
  protected $cache;

  /**
   * @var imdb_logger
   */
  protected $logger;
  protected $pageString;
  protected $url;
  protected $name;

  /**
   *
   * @param string $url URL to retrieve
   * @param mdb_config $config
   * @param imdb_cache $cache
   * @param imdb_logger $logger
   */
  public function __construct($url, mdb_config $config, imdb_cache $cache, imdb_logger $logger) {
    $this->url = $url;
    $this->config = $config;
    $this->cache = $cache;
    $this->logger = $logger;
  }

  /**
   * Retrieve the content of the specified $url
   * Caching will be used where possible
   * @return string
   */
  public function get() {
    if ($this->pageString) {
      return $this->pageString;
    }

    if ($this->pageString = $this->getFromCache()) {
      return $this->pageString;
    }

    if ($this->pageString = $this->requestPage($this->url)) {
      $this->saveToCache();
      return $this->pageString;
    } else {
      // failed to get page
      return '';
    }
  }

  /**
   * Request the page from IMDb
   * @param $url
   * @return string Page html. Empty string on failure
   */
  protected function requestPage($url) {
    $this->logger->info("[Page] Requesting [$url]");
    $req = new MDB_Request($url, $this->config);
    if (!$req->sendRequest()) {
      $this->logger->error("[Page] Failed to connect to server when requesting url [$url]");
      return '';
    }

    if (200 == $req->getStatus()) {
        return $req->getResponseBody();
    } elseif ($redirectUrl = $req->getRedirect()) {
        $this->logger->debug("[Page] Following redirect from [$url] to [$redirectUrl]");
        return $this->requestPage($redirectUrl);
    } else {
        $this->logger->error("[Page] Failed to retrieve url [{url}]. Response headers:{headers}", array('url' => $url, 'headers' => $req->getLastResponseHeaders()));
        return '';
    }
  }

  protected function getFromCache() {
    return $this->cache->get($this->getCacheKey());
  }

  protected function saveToCache() {
    $this->cache->set($this->getCacheKey(), $this->pageString);
  }

  protected function getCacheKey() {
    $urlParts = parse_url($this->url);
    $cacheKey = $urlParts['path'] . (isset($urlParts['query']) ? '?' . $urlParts['query'] : '');
    return trim($cacheKey, '/');
  }

}
