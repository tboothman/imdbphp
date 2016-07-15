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
 * Configuration class for imdbphp
 * You should override the settings in here by creating an ini file in the conf folder.
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
 */
class Config {

  /**
   * Set the language Imdb will use for titles
   * Any valid language code can be used here (e.g. en-US, de, pt-BR).
   * If this option is specified, the Accept-Language header with this value
   * will be included in the requests.
   * @var string
   */
  public $language = "";

  /**
   * IMDB domain to use.
   * @var string imdbsite
   */
  public $imdbsite = "www.imdb.com";

  /**
   * Set the log type. If empty default logger will be used.
   * If this option is specified, it must be a class name which implements LoggerInterface.
   * @var string
   */
  public $logtype = "";

  /**
   * Set the cache type. If empty default file cache will be used.
   * If this option is specified, it must be a class name which implements CacheInterface.
   * @var string
   */
  public $cachetype = "";

  /**
   * Directory to store the cache files. This must be writable by the web
   * server. It doesn't need to be under documentroot.
   * @var string
   */
  public $cachedir = './cache/';

  /**
   * Use a cached page to retrieve the information if available?
   * @var boolean
   */
  public $usecache = true;

  /**
   * Store the pages retrieved for later use?
   * @var boolean
   */
  public $storecache = true;

  /**
   * Use zip compression for caching the retrieved html-files?
   * @var boolean
   */
  public $usezip = true;

  /**
   * Convert non-zip cache-files to zip (check file permissions!)?
   * @var boolean
   */
  public $converttozip = true;

  /**
   * Cache expiration - cache files older than this value (in seconds) will
   * be automatically deleted.
   * If 0 cache will never expire
   * @var integer
   */
  public $cache_expire = 604800;

  /**
   * Where to store images retrieved from the IMDB site by the method photo_localurl().
   * This needs to be under documentroot to be able to display them on your pages.
   * @var string
   */
  public $photodir = './images/';

  /**
   * URL corresponding to photodir, i.e. the URL to the images, i.e. start at
   * your servers DOCUMENT_ROOT when specifying absolute path
   * @var string
   */
  public $photoroot = './images/';

  /**
   * Where the local IMDB images reside (look for the "showtimes/" directory)
   * This should be either a relative, an absolute, or an URL including the
   * protocol (e.g. when a different server shall deliver them)
   * @var string
   */
  public $imdb_img_url = './imgs/';

  /**
   * Enable debug mode?
   * @var boolean
   */
  public $debug = false;

  /**
   * Throw exceptions when a request to fetch some content fails?
   * @var boolean
   */
  public $throwHttpExceptions = true;

  #--------------------------------------------------=[ TWEAKING OPTIONS ]=--

  /**
   * Set the default user agent (if none is detected)
   * @var string
   */
  public $default_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0';

  /**
   * Enforce the use of a special user agent
   * @var string
   */
  public $force_agent = '';

  /**
   * Constructor
   * @param string $iniFile *optional* Path to a config file containing any config overrides
   */
  public function __construct($iniFile = null) {
    // A little hack to maintain the old default behaviour of making sure the cache folder is
    // within the imdbphp folder by default ('.' is the directory of the first php file loaded)
    if ($this->cachedir == './cache/') {
      $this->cachedir = dirname(__FILE__) . '/../../cache/';
    }

    if ($iniFile) {
      $ini_files = array($iniFile);
    } else {
      $ini_files = glob(dirname(__FILE__) . '/../../conf/*.ini');
    }

    if (is_array($ini_files)) {
      foreach ($ini_files as $file) {
        $ini = parse_ini_file($file);
        foreach ($ini as $var => $val) {
          $this->$var = $val;
        }
      }
    }
  }

}
