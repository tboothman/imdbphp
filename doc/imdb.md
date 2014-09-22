imdb
===============

Accessing IMDB information




* Class name: imdb
* Namespace: 
* Parent class: [movie_base](movie_base.md)





Properties
----------


### $version

    public mixed $version = '2.3.3'





* Visibility: **public**


### $lastServerResponse

    public string $lastServerResponse

The last HTTP status code from the IMDB server
This is a 3-digit code according to RFC2616. This is e.g. a "200" for "OK",
"404" for "not found", etc.). This attribute holds the response from the
last query to the server and is overwritten on the next. Additional to the
codes defined in RFC2616, "000" means the server could not be contacted -
e.g. IMDB site down, or networking problems. If it is completely empty, you
did not run any request yet ;) Consider this attribute read-only - you can
use it to figure out why no information is returned in some cases.



* Visibility: **public**


### $imdbsite

    public string $imdbsite = "akas.imdb.com"

IMDB server to use.

choices are www.imdb.&lt;lang&gt; with &lt;lang&gt; being one of
de|es|fr|it|pt, uk.imdb.com, and akas.imdb.com - the localized ones are
only qualified to find the movies IMDB ID (with the imdbsearch class;
akas.imdb.com will be the best place to search as it has all AKAs) -- but
parsing (with the imdb class) for most of the details will fail for
most of the details.

* Visibility: **public**


### $language

    public string $language = ""

Tell IMDB which is the preferred language.

Any valid language code can be used here (e.g. en-US, de, pt-BR).
If this option is specified, the Accept-Language header with this value
will be included in the requests.

* Visibility: **public**


### $pilot_imdbfill

    public integer $pilot_imdbfill = NO_ACCESS

If the Pilot classes miss certain data (i.e. it does not provide that datatype
 at all, as it is e.g. with MPAA/FSK), should the API try to substitute them
 via the IMDB class? To define this, you should use the following constants:
 <UL><LI>NO_ACCESS - don't access IMDB.COM at all</LI>
     <LI>BASIC_ACCESS - access it only for very basic data. This means very
         non-descriptive stuff, like e.g. MPAA/FSK.</LI>
     <LI>MEDIUM_ACCESS - something more than BASIC, but ommit "traceable"
         stuff like full descriptions, IMDB ratings, and the like</LI>
     <LI>FULL_ACCESS - get all we can get</LI></UL>



* Visibility: **public**


### $cachedir

    public string $cachedir = './cache/'

Directory to store the cache files. This must be writable by the web
server. It doesn't need to be under documentroot.



* Visibility: **public**


### $usecache

    public boolean $usecache = true

Use a cached page to retrieve the information if available?



* Visibility: **public**


### $storecache

    public boolean $storecache = true

Store the pages retrieved for later use?



* Visibility: **public**


### $usezip

    public boolean $usezip = true

Use zip compression for caching the retrieved html-files?



* Visibility: **public**


### $converttozip

    public boolean $converttozip = true

Convert non-zip cache-files to zip (check file permissions!)?



* Visibility: **public**


### $cache_expire

    public integer $cache_expire = 3600

Cache expiration - cache files older than this value (in seconds) will
be automatically deleted.



* Visibility: **public**


### $photodir

    public string $photodir = './images/'

Where to store images retrieved from the IMDB site by the method photo_localurl().

This needs to be under documentroot to be able to display them on your pages.

* Visibility: **public**


### $photoroot

    public string $photoroot = './images/'

URL corresponding to photodir, i.e. the URL to the images, i.e. start at
your servers DOCUMENT_ROOT when specifying absolute path



* Visibility: **public**


### $imdb_img_url

    public string $imdb_img_url = './imgs/'

Where the local IMDB images reside (look for the "showtimes/" directory)
This should be either a relative, an absolute, or an URL including the
protocol (e.g. when a different server shall deliver them)



* Visibility: **public**


### $imdb_utf8recode

    public boolean $imdb_utf8recode = false

Try to recode all non-UTF-8 content to UTF-8?
As the name suggests, this only should concern IMDB classes.



* Visibility: **public**


### $debug

    public boolean $debug = false

Enable debug mode?



* Visibility: **public**


### $maxresults

    public integer $maxresults = 20

Limit for the result set of searches.

Use 0 for no limit, or the number of maximum entries you wish. Default
(when commented out) is 20.

* Visibility: **public**


### $default_agent

    public string $default_agent = 'Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3'

Set the default user agent (if none is detected)



* Visibility: **public**


### $force_agent

    public string $force_agent = ''

Enforce the use of a special user agent



* Visibility: **public**


Methods
-------


### fromSearchResult

    \imdb imdb::fromSearchResult(string $id, string $title, integer $year, $type, \mdb_config $config)

Create an imdb object populated with id, title, year



* Visibility: **public**
* This method is **static**.


#### Arguments
* $id **string** - &lt;p&gt;imdb ID&lt;/p&gt;
* $title **string** - &lt;p&gt;film title&lt;/p&gt;
* $year **integer**
* $type **mixed**
* $config **[mdb_config](mdb_config.md)**



### __construct

    mixed mdb_config::__construct($iniFile)

Initialize the class



* Visibility: **public**
* This method is defined by [mdb_config](mdb_config.md)


#### Arguments
* $iniFile **mixed**



### main_url

    string imdb::main_url()

Set up the URL to the movie title page



* Visibility: **public**




### movietype

    string imdb::movietype()

Get movie type



* Visibility: **public**




### title

    string imdb::title()

Get movie title



* Visibility: **public**




### orig_title

    string imdb::orig_title()

Get movie original title



* Visibility: **public**




### year

    string imdb::year()

Get year



* Visibility: **public**




### endyear

    string imdb::endyear()

Get end-year
 Usually this returns the same value as year() -- except for those cases where production spanned multiple years, usually for series



* Visibility: **public**




### yearspan

    array imdb::yearspan()

Get range of years for e.g. series spanning multiple years



* Visibility: **public**




### movieTypes

    array imdb::movieTypes()

Get movie types (if any specified)



* Visibility: **public**




### runtime

    integer|null imdb::runtime()

Get overall runtime (first one mentioned on title page)



* Visibility: **public**




### runtimes

    array imdb::runtimes()

Retrieve all runtimes and their descriptions



* Visibility: **public**




### aspect_ratio

    string imdb::aspect_ratio()

Aspect Ratio of movie screen



* Visibility: **public**




### rating

    string imdb::rating()

Get movie rating



* Visibility: **public**




### votes

    integer imdb::votes()

Return number of votes for this movie



* Visibility: **public**




### comment

    string imdb::comment()

Get movie main comment (from title page)



* Visibility: **public**




### comment_split

    array imdb::comment_split()

Get movie main comment (from title page - split-up variant)



* Visibility: **public**




### movie_recommendations

    array imdb::movie_recommendations()

Get recommended movies (People who liked this.

..also liked)

* Visibility: **public**




### keywords

    array imdb::keywords()

Get the keywords for the movie



* Visibility: **public**




### language

    string imdb::language()

Get movies original language



* Visibility: **public**




### languages

    array imdb::languages()

Get all languages this movie is available in



* Visibility: **public**




### languages_detailed

    array imdb::languages_detailed()

Get all languages this movie is available in, including details



* Visibility: **public**




### genre

    string imdb::genre()

Get the movies main genre
 Since IMDB.COM does not really now a "Main Genre", this simply means the
 first mentioned genre will be returned.



* Visibility: **public**




### genres

    array imdb::genres()

Get all genres the movie is registered for



* Visibility: **public**




### colors

    array imdb::colors()

Get the colours this movie was shot in.

e.g. Color, Black and White

* Visibility: **public**




### creator

    array imdb::creator()

Get the creator of a movie (most likely for seasons only)



* Visibility: **public**




### tagline

    string imdb::tagline()

Get the main tagline for the movie



* Visibility: **public**




### seasons

    integer imdb::seasons()

Get the number of seasons or 0 if not a series



* Visibility: **public**




### is_serial

    boolean imdb::is_serial()

Try to figure out if this is a movie or a serie



* Visibility: **public**




### get_episode_details

    array imdb::get_episode_details()

If it is an episode, we may want to now to know where it belongs to



* Visibility: **public**




### plotoutline

    string imdb::plotoutline($fallback)

Get the main Plot outline for the movie



* Visibility: **public**


#### Arguments
* $fallback **mixed**



### storyline

    string imdb::storyline()

Get the Storyline for the movie



* Visibility: **public**




### photo

    mixed imdb::photo($thumb)

Get poster/cover photo



* Visibility: **public**


#### Arguments
* $thumb **mixed**



### savephoto

    boolean imdb::savephoto($path, $thumb)

Save the poster/cover photo to disk



* Visibility: **public**


#### Arguments
* $path **mixed**
* $thumb **mixed**



### photo_localurl

    mixed imdb::photo_localurl($thumb)

Get the URL for the movies cover photo



* Visibility: **public**


#### Arguments
* $thumb **mixed**



### mainPictures

    array imdb::mainPictures()

Get URLs for the pictures on the main page



* Visibility: **public**




### country

    array imdb::country()

Get country of production



* Visibility: **public**




### alsoknow

    array imdb::alsoknow()

Get movie's alternative names
Note: This may return an empty country or comments.

comment, year and lang are there for backwards compatibility and should not be used

* Visibility: **public**




### sound

    array imdb::sound()

Get sound formats



* Visibility: **public**




### mpaa

    array imdb::mpaa()

Get the MPAA data (also known as PG or FSK)



* Visibility: **public**




### mpaa_hist

    array imdb::mpaa_hist()

Get the MPAA data (also known as PG or FSK) - including historical data



* Visibility: **public**




### mpaa_reason

    string imdb::mpaa_reason()

Find out the reason for the MPAA rating



* Visibility: **public**




### prodNotes

    array imdb::prodNotes()

For not-yet completed movies, we can get the production state



* Visibility: **public**




### top250

    integer imdb::top250()

Find the position of a movie in the top 250 ranked movies



* Visibility: **public**




### plot

    array imdb::plot()

Get the movies plot(s)



* Visibility: **public**




### plot_split

    array imdb::plot_split()

Get the movie plot(s) - split-up variant



* Visibility: **public**




### synopsis

    string imdb::synopsis()

Get the movies synopsis



* Visibility: **public**




### taglines

    array imdb::taglines()

Get all available taglines for the movie



* Visibility: **public**




### director

    array imdb::director()

Get the director(s) of the movie



* Visibility: **public**




### cast

    array imdb::cast($clean_ws)

Get the actors



* Visibility: **public**


#### Arguments
* $clean_ws **mixed**



### writing

    array imdb::writing()

Get the writer(s)



* Visibility: **public**




### producer

    array imdb::producer()

Obtain the producer(s)



* Visibility: **public**




### composer

    array imdb::composer()

Obtain the composer(s) ("Original Music by.

..")

* Visibility: **public**




### crazy_credits

    array imdb::crazy_credits()

Get the Crazy Credits



* Visibility: **public**




### episodes

    array imdb::episodes()

Get the series episode(s)



* Visibility: **public**




### goofs

    array imdb::goofs()

Get the goofs



* Visibility: **public**




### quotes

    array imdb::quotes()

Get the quotes for a given movie



* Visibility: **public**




### trailers

    mixed imdb::trailers($full, $all)

Get the trailer URLs for a given movie



* Visibility: **public**


#### Arguments
* $full **mixed**
* $all **mixed**



### soundclipsites

    array imdb::soundclipsites()

Get the off-site soundclip URLs



* Visibility: **public**




### photosites

    array imdb::photosites()

Get the off-site photo URLs



* Visibility: **public**




### miscsites

    array imdb::miscsites()

Get the off-site misc URLs



* Visibility: **public**




### videosites

    array imdb::videosites()

Get the off-site videos and trailer URLs



* Visibility: **public**




### trivia

    array imdb::trivia($spoil)

Get the trivia info



* Visibility: **public**


#### Arguments
* $spoil **mixed**



### soundtrack

    array imdb::soundtrack()

Get the soundtrack listing



* Visibility: **public**




### movieconnection

    array imdb::movieconnection()

Get connected movie information



* Visibility: **public**




### extReviews

    array imdb::extReviews()

Get list of external reviews (if any)



* Visibility: **public**




### releaseInfo

    array imdb::releaseInfo()

Obtain Release Info (if any)



* Visibility: **public**




### locations

    array imdb::locations()

Obtain filming locations



* Visibility: **public**




### prodCompany

    array imdb::prodCompany()

Info about Production Companies



* Visibility: **public**




### distCompany

    array imdb::distCompany()

Info about distributors



* Visibility: **public**




### specialCompany

    array imdb::specialCompany()

Info about Special Effects companies



* Visibility: **public**




### otherCompany

    array imdb::otherCompany()

Info about other companies



* Visibility: **public**




### parentalGuide

    array imdb::parentalGuide()

Detailed Parental Guide



* Visibility: **public**




### officialSites

    array imdb::officialSites()

URLs of Official Sites



* Visibility: **public**




### keywords_all

    array imdb::keywords_all()

Get the complete keywords for the movie



* Visibility: **public**




### awards

    array imdb::awards($compat)

Get the complete awards for the movie



* Visibility: **public**


#### Arguments
* $compat **mixed**



### set_pilot_imdbfill

    mixed mdb_base::set_pilot_imdbfill($level)

Setting the IMDB fallback mode



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $level **mixed**



### get_pilot_imdbfill

    integer mdb_base::get_pilot_imdbfill()

Check the IMDB fallback level for non-IMDB classes.

As <code>pilot_imdbfill</code> is a protected variable, this is the only
way to read its current value.

* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)




### debug_scalar

    mixed mdb_base::debug_scalar($scalar)





* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $scalar **mixed**



### debug_object

    mixed mdb_base::debug_object($object)





* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $object **mixed**



### debug_html

    mixed mdb_base::debug_html($html)





* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $html **mixed**



### imdbid

    string mdb_base::imdbid()

Retrieve the IMDB ID



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)




### setid

    mixed mdb_base::setid($id)

Setup class for a new IMDB id



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $id **mixed**



### purge

    mixed mdb_base::purge()

Check cache and purge outdated files
This method looks for files older than the cache_expire set in the
mdb_config and removes them



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)




### cache_read

    mixed mdb_base::cache_read($file, $content)

Read content from cache



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $file **mixed**
* $content **mixed**



### cache_write

    mixed mdb_base::cache_write($file, $content)

Writing content to cache



* Visibility: **public**
* This method is defined by [mdb_base](mdb_base.md)


#### Arguments
* $file **mixed**
* $content **mixed**


