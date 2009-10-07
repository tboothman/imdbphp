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
 * @package MDBApi
 * @class mdb_config
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class mdb_config {
  var $imdbsite;
  var $cachedir;
  var $usecache;
  var $storecache;
  var $usezip;
  var $converttozip;
  var $cache_expire;
  var $photodir;
  var $photoroot;
  /* If MoviePilot misses certain data (i.e. it does not provide that datatype
   *  at all, as it is e.g. with MPAA/FSK), should the API try to substitute them
   *  via the IMDB class? To define this, you should use the following constants:
   *  <UL><LI>NO_ACCESS - don't access IMDB.COM at all</LI>
   *      <LI>BASIC_ACCESS - access it only for very basic data. This means very
   *          non-descriptive stuff, like e.g. MPAA/FSK.</LI>
   *      <LI>MEDIUM_ACCESS - something more than BASIC, but ommit "traceable"
   *          stuff like full descriptions, IMDB ratings, and the like</LI>
   *      <LI>FULL_ACCESS - get all we can get</LI></UL>
   * @class mdb_config
   * @constant integer pilot_imdbfill
   */
  const pilot_imdbfill = NO_ACCESS;

  /** Constructor and only method of this base class.
   *  There's no need to call this yourself - you should just place your
   *  configuration data here.
   * @constructor mdb_config
   */
  function __construct() {
    /** IMDB server to use.
     *  choices are us.imdb.com, uk.imdb.com, akas.imdb.com, german.imdb.com and
     *  italian.imdb.com - the localized ones (i.e. italian and german) are only
     *  qualified to find the movies IMDB ID (with the imdbsearch class) -- but
     *  parsing (with the imdb class) for most of the details will fail at the moment.
     * @attribute string imdbsite
     */
    $this->imdbsite = "akas.imdb.com";
    /** MoviePilot server to use.
     *  choices are &lt;lang&gt;.api.moviepilot.com - where &lt;lang&gt; is one
     *  of de|en|es|fr|pl - more may follow sometimes in the future. Other than
     *  with the IMDB servers, here the prefix tells the language of the
     *  <B>content</B>! So it is really intended for chosing the desired language.
     * @attribute string pilotsite
     */
    $this->pilotsite = "www.moviepilot.de";
    /** The MoviePilot API requires an API key. We initialize it empty here, so
     *  it is left to you to set it from your own script files (or in your own
     *  configuration defined by the constant IMDBPHP_CONFIG)
     * @attribute string pilot_apikey
     */
    $this->pilot_apikey = "";
    /** Directory to store the cache files. This must be writable by the web
     *  server. It doesn't need to be under documentroot.
     * @attribute string cachedir
     */
    $this->cachedir = dirname(__FILE__).'/cache/';
    /** Use a cached page to retrieve the information if available?
     * @attribute boolean usecache
     */
    $this->usecache = true;
    /** Store the pages retrieved for later use?
     * @attribute boolean storecache
     */
    $this->storecache = true;
    /** Use zip compression for caching the retrieved html-files?
     * @attribute boolean usezip
     */
    $this->usezip = true;
    /** Convert non-zip cache-files to zip (check file permissions!)?
     * @attribute boolean converttozip
     */
    $this->converttozip = true;
    /** Cache expiration - cache files older than this value (in seconds) will
     *  be automatically deleted.
     * @attribute integer cache_expire
     */
    $this->cache_expire = 3600;
    /** Where to store images retrieved from the IMDB site by the method photo_localurl().
     *  This needs to be under documentroot to be able to display them on your pages.
     * @attribute string photodir
     */
    $this->photodir = './images/';
    /** URL corresponding to photodir, i.e. the URL to the images, i.e. start at
     *  your servers DOCUMENT_ROOT when specifying absolute path
     * @attribute string photoroot
     */
    $this->photoroot = './images/';
    /** Where the local IMDB images reside (look for the "showtimes/" directory)
     *  This should be either a relative, an absolute, or an URL including the
     *  protocol (e.g. when a different server shall deliver them)
     * @attribute string imdb_img_url
     */
    $this->imdb_img_url = './imgs/';
    /** Enable debug mode?
     * @attribute boolean debug
     */
    $this->debug = 0;
    #--------------------------------------------------=[ TWEAKING OPTIONS ]=--
    /** Limit for the result set of searches.
     *  Use 0 for no limit, or the number of maximum entries you wish. Default
     *  (when commented out) is 20.
     * @attribute integer maxresults
     */
    $this->maxresults = 20;
    /** Moviename search variant. There are different ways of searching for a
     *  movie name, with slightly differing result sets. Set the variant you
     *  prefer, either "sevec", "moonface", or "izzy". The latter one is the
     *  default if you comment out this setting or use an empty string.
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
