<?php
 #############################################################################
 # IMDBPHP                                               (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # Get images from movieposterdb.com                                         #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

namespace MoviePosterDb;

use Imdb\Config;

/**
 * Retrieve posters, covers, etc. from movieposterdb.com
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
 */
class Movie extends \Imdb\MdbBase {

  protected $image_exts = array('jpg', 'png', 'gif', 'bmp');

  protected $langs = array();

  /**
   * @param string id IMDBID to use for data retrieval
   * @param Config $config OPTIONAL override default config
   */
  public function __construct($id, Config $config = null) {
    parent::__construct($config);
    $this->setid($id);
  }

  /**
   * Get the posters
   * @return array array of arrays[lang,url]
   */
  public function posters() {
    return $this->parse_list('poster');
  }

  /**
   * Get the cover images
   * @return array array of arrays[lang,url]
   */
  public function covers() {
    return $this->parse_list('cover');
  }

  /**
   * Get the logos
   * @return array array of arrays[lang,url]
   */
  public function logos() {
    return $this->parse_list('logo');
  }

  /**
   * Get the textless images
   * @return array array of arrays[lang,url]
   */
  public function textless() {
    return $this->parse_list('textless');
  }

  /**
   * Get the images having no category set
   * @return array array of arrays[lang,url]
   */
  public function unsets() {
    return $this->parse_list('unset');
  }

  /**
   * Get the "other" images
   * @return array array of arrays[lang,url]
   */
  public function others() {
    return $this->parse_list('other');
  }

  /**
   * Restrict images to given languages. By default, no restriction is active;
   * you may call this method multiple times to add multiple languages (e.g.
   * your native plus EN plus US), and use the reset_lang method to clean.
   * @param string lang two-letter ISO language code
   */
  public function add_lang($lang) {
    $this->langs[] = strtolower($lang);
  }

  /**
   * Reset the language filter built by the add_lang method to its default (i.e. empty)
   */
  public function reset_lang() {
    $this->langs = array();
  }

  /**
   * Save an image to the image dir
   * The image will be retrieved from the passed URL and stored in the configured
   * Config::photodir, using the filename part of the URL specified.
   * @param string url full URL to the image
   * @return boolean success
   */
  public function save_image($url) {
    if (empty($this->config->photodir)) {
      throw new \Exception('Config::photodir is not set');
    }
    $furl = explode('/', $url);
    $fname = $furl[count($furl) - 1];
    $ext = explode('.', $fname);
    $fext = $ext[count($ext) - 1];
    if (!in_array(strtolower($fext), $this->image_exts)) {
      return false;
    }
    if (file_put_contents($this->config->photodir . $fname, file_get_contents($url))) {
      return true;
    }
    return false;
  }

  /**
   * Parse page for images
   * @param optional string type (what image URLs to retrieve: 'poster' (default),
   *        'cover', 'textless', 'logo', 'other', 'unset')
   * @return array array of arrays[lang,url,title]
   */
  protected function parse_list($type = 'poster') {
    $url = 'http://www.movieposterdb.com/movie/' . $this->imdbid() . '/';
    $page = file_get_contents($url);
    $doc = new \DOMDocument();
    @$doc->loadHTML($page);
    $xp = new \DOMXPath($doc);
    $posters = array();
    $cells = $xp->query("//td[@class=\"poster\"]");
    foreach ($cells as $cell) {
      $imgs = $cell->getElementsByTagName('img');
      foreach ($imgs as $imga) {
        $tit = $imga->getAttribute('alt');
        if (!empty($tit)) {
          if (!preg_match('!' . $type . '$!i', $tit)) { // skip wrong types
            continue 2;
          }
          $i['title'] = $tit;
          $i['url'] = $imga->getAttribute('src');
          break;
        }
      }
      $infos = $cell->getElementsByTagName('p');
      foreach ($infos as $info) {
        $spans = $info->getElementsByTagName('span');
        foreach ($spans as $span) {
          if (preg_match('!flag flag-([A-z]+)!', $span->getAttribute('class'), $match)) {
            $i['lang'] = $match[1];
          }
        }
      }
      $elems[] = $i;
    }
    return $elems;
  }

}
