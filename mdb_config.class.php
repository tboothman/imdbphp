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

/* $Id$ */

/**
 * Configuration class for imdbphp
 * You should override the settings in here by creating an ini file in the conf folder.
 * @package MDBApi
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class mdb_config {

  /**
   * IMDB server to use.
   * choices are www.imdb.&lt;lang&gt; with &lt;lang&gt; being one of
   * de|es|fr|it|pt, uk.imdb.com, and akas.imdb.com - the localized ones are
   * only qualified to find the movies IMDB ID (with the imdbsearch class;
   * akas.imdb.com will be the best place to search as it has all AKAs) -- but
   * parsing (with the imdb class) for most of the details will fail for
   * most of the details.
   * @var string imdbsite
   */
  public $imdbsite = "akas.imdb.com";

  /**
   * Tell IMDB which is the preferred language.
   * Any valid language code can be used here (e.g. en-US, de, pt-BR).
   * If this option is specified, the Accept-Language header with this value
   * will be included in the requests.
   * @var string language
   */
  public $language = "";

  /**
   * Directory to store the cache files. This must be writable by the web
   * server. It doesn't need to be under documentroot.
   * @var string cachedir
   */
  public $cachedir = './cache/';

  /**
   * Use a cached page to retrieve the information if available?
   * @var boolean usecache
   */
  public $usecache = true;

  /**
   * Store the pages retrieved for later use?
   * @var boolean storecache
   */
  public $storecache = true;

  /**
   * Use zip compression for caching the retrieved html-files?
   * @var boolean usezip
   */
  public $usezip = true;

  /**
   * Convert non-zip cache-files to zip (check file permissions!)?
   * @var boolean converttozip
   */
  public $converttozip = true;

  /**
   * Cache expiration - cache files older than this value (in seconds) will
   * be automatically deleted.
   * @var integer cache_expire
   */
  public $cache_expire = 3600;

  /**
   * Where to store images retrieved from the IMDB site by the method photo_localurl().
   * This needs to be under documentroot to be able to display them on your pages.
   * @var string photodir
   */
  public $photodir = './images/';

  /**
   * URL corresponding to photodir, i.e. the URL to the images, i.e. start at
   * your servers DOCUMENT_ROOT when specifying absolute path
   * @var string photoroot
   */
  public $photoroot = './images/';

  /**
   * Where the local IMDB images reside (look for the "showtimes/" directory)
   * This should be either a relative, an absolute, or an URL including the
   * protocol (e.g. when a different server shall deliver them)
   * @var string imdb_img_url
   */
  public $imdb_img_url = './imgs/';

  /**
   * Try to recode all non-UTF-8 content to UTF-8?
   * As the name suggests, this only should concern IMDB classes.
   * @var boolean imdb_utf8recode
   */
  public $imdb_utf8recode = false;

  /**
   * Enable debug mode?
   * @var boolean debug
   */
  public $debug = false;

  #--------------------------------------------------=[ TWEAKING OPTIONS ]=--
  /**
   * Limit for the result set of searches.
   * Use 0 for no limit, or the number of maximum entries you wish. Default
   * (when commented out) is 20.
   * @var integer maxresults
   */
  public $maxresults = 20;

  /**
   * Set the default user agent (if none is detected)
   * @var string default_agent
   */
  public $default_agent = 'Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3';

  /**
   * Enforce the use of a special user agent
   * @var string force_agent
   */
  public $force_agent = '';

  /** Initialize the class
   * @constructor mdb_config
   * @param optional string iniFile A config file containing any config overrides
   */
  public function __construct($iniFile = null) {
    // A little hack to maintain the old default behaviour of making sure the cache folder is
    // within the imdbphp folder by default ('.' is the directory of the first php file loaded)
    if ($this->cachedir == './cache/') {
      $this->cachedir = dirname(__FILE__) . '/cache/';
    }

    if ($iniFile) {
      $ini_files = array($iniFile);
    } else {
      $ini_files = glob(dirname(__FILE__) . '/conf/*.ini');
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
