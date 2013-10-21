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

// set this to TRUE if you want to play with the PEAR stuff instead of
// browseremulator. Be warned that there's no support for problems ;)
$PEAR = false;

/** Enable IMDB-Fallback for non-IMDB classes?
 *  If this is not set to TRUE, changing of the <code>pilot_imdbfill</code>
 *  setting will have no effect, it will always be set to <code>NO_ACCESS</code>.
 *  The imdb classes will be included based on this setting.
 * @package MDBApi
 * @constant boolean PILOT_IMDBFALLBACK
 * @see mdb_config::pilot_imdbfill
 */
if ( !defined('PILOT_IMDBFALLBACK') ) define('PILOT_IMDBFALLBACK',FALSE);

/** Configuration part of the IMDB classes
 * @package MDBApi
 * @class mdb_config
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2008 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class mdb_config {
  var $imdbsite;
  var $language;
  protected $pilot_imdbfill;
  var $cachedir;
  var $usecache;
  var $storecache;
  var $usezip;
  var $converttozip;
  var $cache_expire;
  var $photodir;
  var $photoroot;
  var $imdb_img_url;
  var $imdb_utf8recode;
  var $debug;
  var $maxresults;
  var $searchvariant;

  /** Constructor and only method of this base class.
   *  There's no need to call this yourself - you should just place your
   *  configuration data here.
   * @constructor mdb_config
   */
  function __construct() {
    /** IMDB server to use.
     *  choices are www.imdb.&lt;lang&gt; with &lt;lang&gt; being one of
     *  de|es|fr|it|pt, uk.imdb.com, and akas.imdb.com - the localized ones are
     *  only qualified to find the movies IMDB ID (with the imdbsearch class;
     *  akas.imdb.com will be the best place to search as it has all AKAs) -- but
     *  parsing (with the imdb class) for most of the details will fail for
     *  most of the details.
     * @attribute string imdbsite
     */
    $this->imdbsite = "akas.imdb.com";
    /** Tell IMDB which is the preferred language.
     *  Any valid language code can be used here (e.g. en-US, de, pt-BR).
     *  If this option is specified, the Accept-Language header with this value
     *  will be included in the requests.
     * @attribute string language
     */
    $this->language = "";
    /* If the Pilot classes miss certain data (i.e. it does not provide that datatype
     *  at all, as it is e.g. with MPAA/FSK), should the API try to substitute them
     *  via the IMDB class? To define this, you should use the following constants:
     *  <UL><LI>NO_ACCESS - don't access IMDB.COM at all</LI>
     *      <LI>BASIC_ACCESS - access it only for very basic data. This means very
     *          non-descriptive stuff, like e.g. MPAA/FSK.</LI>
     *      <LI>MEDIUM_ACCESS - something more than BASIC, but ommit "traceable"
     *          stuff like full descriptions, IMDB ratings, and the like</LI>
     *      <LI>FULL_ACCESS - get all we can get</LI></UL>
     * @class mdb_config
     * @attribute integer pilot_imdbfill
     */
    $this->pilot_imdbfill = NO_ACCESS;
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
    /** Try to recode all non-UTF-8 content to UTF-8?
     *  As the name suggests, this only should concern IMDB classes.
     * @attribute boolean imdb_utf8recode
     */
    $this->imdb_utf8recode = FALSE;
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
    /** Set the default user agent (if none is detected)
     * @attribute string user_agent
     */
    $this->default_agent = 'Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3';
    /** Enforce the use of a special user agent
     * @attribute string force_agent
     */
    $this->force_agent = '';
    /** Trigger the HTTP referer
     *  This is required in some places. However, if you think you need to disable
     *  this behaviour, do it here.
     * @attribute boolean trigger_referer
     */
    $this->trigger_referer = TRUE;
    // let PHP report any script errors (useful for code debugging). Comment out
    // to use the default level defined in php.ini, or set to an appropriate
    // level (E_ALL = all errors/warning/notices, E_ALL ^ E_NOTICE = PHP default;
    // see PHP documentation for details)
    # error_reporting(E_ALL);
    # error_reporting(E_ALL ^ E_NOTICE);
    #----------------------------------------------=[ User specific values ]=--
    $ini_files = glob(dirname(__FILE__).'/conf/*.ini');
    foreach ($ini_files as $file) {
      $ini = parse_ini_file($file);
      foreach($ini as $var=>$val) $this->$var = $val;
    }
  }
}
?>
