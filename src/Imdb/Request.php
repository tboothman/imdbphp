<?php

#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# written by Giorgos Giagas                                                 #
# extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################

namespace Imdb;

/**
 * The request class
 * Here we emulate a browser accessing the IMDB site. You don't need to
 * call any of its method directly - they are rather used by the IMDB classes.
 */
class Request extends \BrowserEmulator {

  /**
   * No need to call this.
   * @param string $url URL to open
   * @param Config $config Optionally pass in the Config object to use
   */
  public function __construct($url, Config $config) {
    parent::__construct();

    $this->urltoopen = $url;

    $this->addHeaderLine('Referer', 'http://' . $config->imdbsite . '/');

    if ($config->force_agent)
      $this->addHeaderLine('User-Agent', $config->force_agent);
    if ($config->language)
      $this->addHeaderLine('Accept-Language', $config->language);
  }

  /**
   * Send a request to the movie site
   * @return boolean success
   */
  public function sendRequest() {
    $this->fpopened = $this->fopen($this->urltoopen);
    if ($this->fpopened !== false)
      return true;
    return false;
  }

  /**
   * Get the Response body
   * @return string page
   */
  public function getResponseBody() {
    $page = "";
    if ($this->fpopened === FALSE)
      return $page;
    while (!feof($this->fpopened)) {
      $page .= fread($this->fpopened, 1024);
    }
    return $page;
  }

  /**
   * Set the URL we need to parse
   * @param string $url
   */
  public function setURL($url) {
    $this->urltoopen = $url;
  }

  /**
   * Get a header value from the response
   * @param string $header header field name
   * @return string header value
   */
  public function getresponseheader($header) {
    $headers = $this->getLastResponseHeaders();
    foreach ($headers as $head) {
      if (is_integer(strpos($head, $header))) {
        $hstart = strpos($head, ": ");
        $head = trim(substr($head, $hstart + 2, 100));
        return $head;
      }
    }
  }

  /**
   * HTTP status code of the last response
   * @return int|null null if last request failed
   */
  public function getStatus() {
    $headers = $this->getLastResponseHeaders();
    if (empty($headers[0])) {
      return null;
    }

    if (!preg_match("#^HTTP/[\d\.]+ (\d+)#i", $headers[0], $matches)) {
      return null;
    }

    return (int)$matches[1];
  }

  /**
   * Get the URL to redirect to if a 30* was returned
   * @return string|null URL to redirect to if 300, otherwise null
   */
  public function getRedirect() {
    $status = $this->getStatus();
    if ($status == 301 || $status == 302 || $status == 303 || $status == 307) {
      foreach ($this->getLastResponseHeaders() as $header) {
        if (strpos(trim(strtolower($header)), 'location') !== 0)
          continue;
        $aline = explode(': ', $header);
        $target = trim($aline[1]);
        $urlParts = parse_url($target);
        if (!isset($urlParts['host'])) {
          $initialRequestUrlParts = parse_url($this->urltoopen);
          $target = $initialRequestUrlParts['scheme'] . "://" . $initialRequestUrlParts['host'] . $target;
        }
        return $target;
      }
    }
  }
}
