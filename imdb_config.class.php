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

// the proxy to use for connections to imdb (leave it empty for no proxy).
// this is only supported with PEAR. 
define ('PROXY', "");
define ('PROXY_PORT', "");

// set to false to use the old browseremulator.
$PEAR = false;

/** Configuration part of the IMDB classes
 * @package Api
 * @class imdb_config
 */
class imdb_config {
  var $imdbsite;
  var $cachedir;
  var $usecache;
  var $storecache;
  var $usezip;
  var $converttozip;
  var $cache_expire;
  var $photodir;
  var $photoroot;

  /** Constructor and only method of this base class.
   *  There's no need to call this yourself - you should just place your
   *  configuration data here.
   * @constructor imdb_config
   */
  function imdb_config(){
    /** IMDB server to use.
     *  choices are us.imdb.com, uk.imdb.com, akas.imdb.com, german.imdb.com and
     *  italian.imdb.com - the localized ones (i.e. italian and german) are only
     *  qualified to find the movies IMDB ID (with the imdbsearch class) -- but
     *  parsing (with the imdb class) for most of the details will fail at the moment.
     * @class imdb_config
     * @attribute string imdbsite
     */
    $this->imdbsite = "akas.imdb.com";
    /** Directory to store the cache files. This must be writable by the web
     *  server. It doesn't need to be under documentroot.
     * @class imdb_config
     * @attribute string cachedir
     */
    $this->cachedir = '../cache/';
    /** Use a cached page to retrieve the information if available?
     * @class imdb_config
     * @attribute boolean usecache
     */
    $this->usecache = true;
    /** Store the pages retrieved for later use?
     * @class imdb_config
     * @attribute boolean storecache
     */
    $this->storecache = true;
    /** Use zip compression for caching the retrieved html-files?
     * @class imdb_config
     * @attribute boolean usezip
     */
    $this->usezip = true;
    /** Convert non-zip cache-files to zip (check file permissions!)?
     * @class imdb_config
     * @attribute boolean converttozip
     */
    $this->converttozip = true;
    /** Cache expiration - cache files older than this value (in seconds) will
     *  be automatically deleted.
     * @class imdb_config
     * @attribute integer cache_expire
     */
    $this->cache_expire = 3600;
    /** Where to store images retrieved from the IMDB site by the method photo_localurl().
     *  This needs to be under documentroot to be able to display them on your pages.
     * @class imdb_config
     * @attribute string photodir
     */
    $this->photodir = './images/';
    /** URL corresponding to photodir, i.e. the URL to the images, i.e. start at
     *  your servers DOCUMENT_ROOT when specifying absolute path
     * @class imdb_config
     * @attribute string photoroot
     */
    $this->photoroot = './images/';
    /** Enable debug mode?
     * @class imdb_config
     * @attribute boolean debug
     */
    $this->debug = 0;
    #--------------------------------------------------=[ TWEAKING OPTIONS ]=--
    /** Limit for the result set of searches.
     *  Use 0 for no limit, or the number of maximum entries you wish. Default
     *  (when commented out) is 20.
     * @class imdb_config
     * @attribute integer maxresults
     */
    $this->maxresults = 20;
    /** Moviename search variant. There are different ways of searching for a
     *  movie name, with slightly differing result sets. Set the variant you
     *  prefer, either "sevec", "moonface", or "izzy". The latter one is the
     *  default if you comment out this setting or use an empty string.
     * @class imdb_config
     * @attribute string searchvariant
     */
    $this->searchvariant = "";
    // let PHP report any script errors (useful for code debugging). Comment out
    // to use the default level defined in php.ini, or set to an appropriate
    // level (E_ALL = all errors/warning/notices, E_ALL ^ E_NOTICE = PHP default;
    // see PHP documentation for details)
    # error_reporting(E_ALL);
    # error_reporting(E_ALL ^ E_NOTICE);
  }

}
?>
