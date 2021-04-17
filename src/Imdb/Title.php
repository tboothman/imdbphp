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

use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * A title on IMDb
 * @author Georgos Giagas
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2002-2004 by Giorgos Giagas and (c) 2004-2009 by Itzchak Rehberg and IzzySoft
 */
class Title extends MdbBase
{

    const MOVIE = 'Movie';
    const TV_SERIES = 'TV Series';
    const TV_EPISODE = 'TV Episode';
    const TV_MINI_SERIES = 'TV Mini-Series';
    const TV_MOVIE = 'TV Movie';
    const TV_SPECIAL = 'TV Special';
    const TV_SHORT = 'TV Short';
    const GAME = 'Video Game';
    const VIDEO = 'Video';
    const SHORT = 'Short';

    protected $akas = array();
    protected $awards = array();
    protected $countries = array();
    protected $castlist = array(); // pilot only
    protected $crazy_credits = array();
    protected $credits_cast = array();
    protected $credits_cinematographer = array();
    protected $credits_composer = array();
    protected $credits_director = array();
    protected $credits_producer = array();
    protected $credits_writing = array();
    protected $extreviews = array();
    protected $goofs = array();
    protected $langs = array();
    protected $langs_full = array();
    protected $aspectratio = "";
    protected $main_comment = "";
    protected $main_genre = "";
    protected $main_keywords = array();
    protected $all_keywords = array();
    protected $main_language = "";
    protected $main_poster = "";
    protected $main_poster_thumb = "";
    protected $main_pictures = array();
    protected $main_plotoutline = "";
    protected $main_runtime = "";
    protected $main_movietype = "";
    protected $main_title = "";
    protected $original_title = "";
    protected $main_year = -1;
    protected $main_endyear = -1;
    protected $main_yearspan = array();
    protected $main_tagline = "";
    protected $main_storyline = "";
    protected $main_prodnotes = array();
    protected $main_movietypes = array();
    protected $main_top250 = -1;
    protected $moviecolors = array();
    protected $movieconnections = array();
    protected $moviegenres = array();
    protected $moviequotes = array();
    protected $movierecommendations = array();
    protected $movieruntimes = array();
    protected $mpaas = array();
    protected $mpaas_hist = array();
    protected $mpaa_justification = "";
    protected $plot_plot = array();
    protected $synopsis_wiki = "";
    protected $release_info = array();
    protected $seasoncount = -1;
    protected $season_episodes = array();
    protected $sound = array();
    protected $soundtracks = array();
    protected $split_comment = array();
    protected $split_plot = array();
    protected $split_moviequotes = array();
    protected $taglines = array();
    protected $trailers = array();
    protected $video_sites = array();
    protected $soundclip_sites = array();
    protected $photo_sites = array();
    protected $misc_sites = array();
    protected $trivia = array();
    protected $compcred_prod = array();
    protected $compcred_dist = array();
    protected $compcred_special = array();
    protected $compcred_other = array();
    protected $parental_guide = array();
    protected $official_sites = array();
    protected $locations = array();
    protected $budget = null;
    protected $filmingDates = null;
    protected $moviealternateversions = array();
    protected $isSerial = null;
    protected $episodeSeason = null;
    protected $episodeEpisode = null;
    protected $jsonLD = null;

    protected $pageUrls = array(
      "AlternateVersions" => '/alternateversions',
      "Awards" => "/awards",
      "CompanyCredits" => "/companycredits",
      "CrazyCredits" => "/crazycredits",
      "Credits" => "/fullcredits",
      "Episodes" => "/episodes",
      "ExtReviews" => "/externalreviews",
      "Goofs" => "/trivia?tab=gf",
      "Keywords" => "/keywords",
      "Locations" => "/locations",
      "MovieConnections" => "/movieconnections",
      "OfficialSites" => "/officialsites",
      "ParentalGuide" => "/parentalguide",
      "Plot" => "/plotsummary",
      "Quotes" => "/quotes",
      "ReleaseInfo" => "/releaseinfo",
      "Soundtrack" => "/soundtrack",
      "Synopsis" => "/plotsummary",
      "Taglines" => "/taglines",
      "Technical" => "/technical",
      "Title" => "/",
      "Trailers" => "/videogallery/content_type-trailer",
      "Trivia" => "/trivia",
      "VideoSites" => "/externalsites",
    );

    /**
     * Create an imdb object populated with id, title, year, and movie type
     * @param string $id imdb ID
     * @param string $title film title
     * @param int $year
     * @param string $type
     * @param Config $config
     * @param LoggerInterface $logger OPTIONAL override default logger
     * @param CacheInterface $cache OPTIONAL override default cache
     * @return Title
     */
    public static function fromSearchResult(
      $id,
      $title,
      $year,
      $type,
      Config $config = null,
      LoggerInterface $logger = null,
      CacheInterface $cache = null
    ) {
        $imdb = new Title($id, $config, $logger, $cache);
        $imdb->main_title = $title;
        $imdb->main_year = (int)$year;
        $imdb->main_movietype = $type;
        return $imdb;
    }

    /**
     * @param string $id IMDb ID. e.g. 285331 for https://www.imdb.com/title/tt0285331/
     * @param Config $config OPTIONAL override default config
     * @param LoggerInterface $logger OPTIONAL override default logger `\Imdb\Logger` with a custom one
     * @param CacheInterface $cache OPTIONAL override the default cache with any PSR-16 cache. None of the caching config in `\Imdb\Config` have any effect except cache_expire
     */
    public function __construct(
      $id,
      Config $config = null,
      LoggerInterface $logger = null,
      CacheInterface $cache = null
    ) {
        parent::__construct($config, $logger, $cache);
        $this->setid($id);
    }

    #-------------------------------------------------------------[ Open Page ]---

    protected function buildUrl($page = null)
    {
        return "https://" . $this->imdbsite . "/title/tt" . $this->imdbID . $this->getUrlSuffix($page);
    }

    /**
     * @param string $pageName internal name of the page
     * @return string
     */
    protected function getUrlSuffix($pageName)
    {
        if (isset($this->pageUrls[$pageName])) {
            return $this->pageUrls[$pageName];
        }

        if (preg_match('!^Episodes-(-?\d+)$!', $pageName, $match)) {
            return '/episodes?season=' . $match[1];
        }

        throw new \Exception("Could not find URL for page $pageName");
    }

    /**
     * Get the URL for this title's page
     * @return string
     */
    public function main_url()
    {
        return "https://" . $this->imdbsite . "/title/tt" . $this->imdbid() . "/";
    }

    /**
     * Setup title and year properties
     */
    protected function title_year()
    {
        $this->getPage("Title");
        if (@preg_match('!<title>(IMDb\s*-\s*)?(?<ititle>.*)(\s*-\s*IMDb)?</title>!', $this->page["Title"], $imatch)) {
            $ititle = $imatch['ititle'];
            if (preg_match('!(?<title>.*) \((?<movietype>.*)(?<year>\d{4}|\?{4})((&nbsp;|–)(?<endyear>\d{4}|)).*\)(.*)!',
              $ititle, $match)) { // serial
                $this->main_movietype = trim($match['movietype']);
                $this->main_year = $match['year'];
                $this->main_endyear = $match['endyear'] ? $match['endyear'] : '0';
                $this->main_title = htmlspecialchars_decode($match['title']);
            } elseif (preg_match('!(?<title>.*) \((?<movietype>.*)(?<year>\d{4}|\?{4}).*\)(.*)!', $ititle, $match)) {
                $this->main_movietype = trim($match['movietype']);
                $this->main_year = $match['year'];
                $this->main_endyear = $match['year'];
                $this->main_title = htmlspecialchars_decode($match['title']);
            } elseif (preg_match('!(?<title>.*) \((?<movietype>.*)\)(.*)!', $ititle,
              $match)) { // not yet released, but have been given a movietype.
                $this->main_movietype = trim($match['movietype']);
                $this->main_title = htmlspecialchars_decode($match['title']);
                $this->main_year = '0';
                $this->main_endyear = '0';
            } elseif (preg_match('!<title>(?<title>.*) - IMDb</title>!', $this->page["Title"],
              $match)) { // not yet released, so no dates etc.
                $this->main_title = htmlspecialchars_decode($match['title']);
                $this->main_year = '0';
                $this->main_endyear = '0';
            }
            if (preg_match('!class="originalTitle">(.+?)<span!s', $this->page["Title"], $otitle)) {
                $this->original_title = trim($otitle[1]);
            }
            if ($this->main_year == "????") {
                $this->main_year = "";
            }
        }
    }

    /** Get movie type
     * @return string movietype (TV Series, Movie, TV Episode, TV Special, TV Movie, TV Mini-Series, Video Game, TV Short, Video)
     * @see IMDB page / (TitlePage)
     * @brief This is faster than movietypes() as it is retrieved already together with the title.
     *        If no movietype had been defined explicitly, it returns 'Movie' -- so this is always set.
     */
    public function movietype()
    {
        if (empty($this->main_movietype)) {
            if (empty($this->main_title)) {
                $this->title_year();
            } // Most types are shown in the <title> tag
            if (!empty($this->main_movietype)) {
                return $this->main_movietype;
            }
            // TV Special isn't shown in the page title but is mentioned next to the release date
            if (preg_match('/title="See more release dates" >TV Special/', $this->getPage("Title"), $match)) {
                $this->main_movietype = 'TV Special';
            }
            if (empty($this->main_movietype)) {
                $this->main_movietype = 'Movie';
            }
        }
        return $this->main_movietype;
    }

    /** Get movie title
     * @return string title movie title (name)
     * @see IMDB page / (TitlePage)
     */
    public function title()
    {
        if ($this->main_title == "") {
            $this->title_year();
        }
        return $this->main_title;
    }

    /** Get movie original title
     * @return string title original movie title (name), if available
     * @see IMDB page / (TitlePage)
     */
    public function orig_title()
    {
        if ($this->original_title == "") {
            $this->title_year();
        }
        return $this->original_title;
    }

    /** Get year
     * @return string year
     * @see IMDB page / (TitlePage)
     */
    public function year()
    {
        if ($this->main_year == -1) {
            $this->title_year();
        }
        return $this->main_year;
    }

    /** Get end-year
     *  Usually this returns the same value as year() -- except for those cases where production spanned multiple years, usually for series
     * @return string year
     * @see IMDB page / (TitlePage)
     */
    public function endyear()
    {
        if ($this->main_endyear == -1) {
            $this->title_year();
        }
        return $this->main_endyear;
    }

    /** Get range of years for e.g. series spanning multiple years
     * @return array yearspan [start,end] (if there was no range, start==end)
     * @see IMDB page / (TitlePage)
     */
    function yearspan()
    {
        if (empty($this->main_yearspan)) {
            $this->main_yearspan = array('start' => $this->year(), 'end' => $this->endyear());
        }
        return $this->main_yearspan;
    }

    /** Get movie types (if any specified)
     * @return array [0..n] of strings (or empty array if no movie types specified)
     * @see IMDB page / (TitlePage)
     */
    public function movieTypes()
    {
        if (empty($this->main_movietypes)) {
            $this->getPage("Title");
            if (@preg_match("/\<title\>(.*)\<\/title\>/", $this->page["Title"], $match)) {
                if (preg_match_all('|\(([^\)]*)\)|', $match[1], $matches)) {
                    for ($i = 0; $i < count($matches[0]); ++$i) {
                        if (!preg_match('|^\d{4}$|', $matches[1][$i])) {
                            $this->main_movietypes[] = $matches[1][$i];
                        }
                    }
                }
            }
        }
        return $this->main_movietypes;
    }

    #---------------------------------------------------------------[ Runtime ]---

    /**
     * Get general runtime
     * @return string runtime complete runtime string, e.g. "150 min / USA:153 min (director's cut)"
     */
    protected function runtime_all()
    {
        if ($this->main_runtime == "") {
            $this->getPage("Title");
            if (@preg_match('!Runtime:</h4>\s*(.+?)\s*</div!ms', $this->page["Title"], $match)) {
                $this->main_runtime = $match[1];
            }
        }
        if ($this->main_runtime == "") {
            $this->getPage("Technical");
            if (@preg_match('!Runtime.*?<td>(.+?)</td!ms', $this->page["Technical"], $match)) {
                $this->main_runtime = $match[1];
            }
        }
        return $this->main_runtime;
    }

    /**
     * Get overall runtime (first one mentioned on title page)
     * @return int|null runtime in minutes (if set), NULL otherwise
     * @see IMDB page / (TitlePage)
     */
    public function runtime()
    {
        $jsonValue = isset($this->jsonLD()->duration) ? $this->jsonLD()->duration : (isset($this->jsonLD()->timeRequired) ? $this->jsonLD()->timeRequired : null);
        if (isset($jsonValue) && preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?/', $jsonValue, $matches)) {
            $h = isset($matches[1]) ? intval($matches[1]) * 60 : 0;
            $m = isset($matches[2]) ? intval($matches[2]) : 0;
            return $h + $m;
        }
        // Fallback in case new json format aren't available
        $runtimes = $this->runtimes();
        if (!empty($runtimes[0]['time'])) {
            return intval($runtimes[0]['time']);
        }

        return null;
    }

    /**
     * Retrieve all runtimes and their descriptions
     * @return array runtimes (array[0..n] of array[time,annotations]) where annotations is an array of comments meant to describe this cut
     * @see IMDB page / (TitlePage)
     */
    public function runtimes()
    {
        if (empty($this->movieruntimes)) {
            $this->movieruntimes = array();
            $rt = $this->runtime_all();
            foreach (preg_split('!(\||<br>)!', strip_tags($rt, '<br>')) as $runtimestring) {
                if (preg_match_all("/(\d+\s+hr\s+\d+\s+min)?\((\d+)\s+min\)|(\d+)\s+min/", $runtimestring, $matches,
                  PREG_SET_ORDER, 0)) {
                    $runtime = isset($matches[1][2]) ? $matches[1][2] : (isset($matches[0][3]) ? $matches[0][3] : 0);
                    $annotations = array();
                    if (preg_match_all("/\((?!\d+\s+min)(.+?)\)/", $runtimestring, $matches)) {
                        $annotations = $matches[1];
                    }
                    $this->movieruntimes[] = array(
                      "time" => $runtime,
                      "country" => '',
                      "comment" => '',
                      "annotations" => $annotations
                    );
                }
            }
        }
        return $this->movieruntimes;
    }

    #----------------------------------------------------------[ Aspect Ratio ]---

    /**
     * Aspect Ratio of movie screen
     * @return string ratio e.g. "2.35 : 1" or "" if there is no aspect ratio on imdb
     * @see IMDB page / (TitlePage)
     */
    public function aspect_ratio()
    {
        if (empty($this->aspectratio)) {
            $page = $this->getPage("Title");
            if (preg_match('!<h4 class="inline">Aspect Ratio:</h4>\s*(.*?)\s+</div>!ims', $page, $match)) {
                $this->aspectratio = $match[1];
            }
        }
        return $this->aspectratio;
    }

    #----------------------------------------------------------[ Movie Rating ]---

    /** Get movie rating
     * @return string rating current rating as given by IMDB site
     * @see IMDB page / (TitlePage)
     */
    public function rating()
    {
        return isset($this->jsonLD()->aggregateRating->ratingValue) ? $this->jsonLD()->aggregateRating->ratingValue : '';
    }

    /**
     * Return number of votes for this movie
     * @return int
     * @see IMDB page / (TitlePage)
     */
    public function votes()
    {
        return isset($this->jsonLD()->aggregateRating->ratingCount) ? $this->jsonLD()->aggregateRating->ratingCount : 0;
    }

    /**
     * Rating out of 100 on metacritic
     * @return int|null
     */
    public function metacriticRating()
    {
        $page = $this->getPage('Title');
        if (preg_match('!"metacriticScore.+>\n.+?(\d+)!im', $page, $match)) {
            return (int)$match[1];
        }
        return null;
    }

    /**
     * Number of reviews on metacritic
     * @return null
     * @deprecated since version 3.1.3
     */
    public function metacriticNumReviews()
    {
        return null;
    }

    #------------------------------------------------------[ Movie Comment(s) ]---

    /** Get movie main comment (from title page)
     * @return string comment full text of movie comment from the movies main page
     * @see IMDB page / (TitlePage)
     */
    public function comment()
    {
        // this stuff whent into a frame in 2011! _ajax/iframe?component=footer
        if ($this->main_comment == "") {
            $this->getPage("Title");
            if (@preg_match('!<div class\="user-comments">\s*(.*?)\s*<hr\s*/>\s*<div class\="yn"!ms',
              $this->page["Title"], $match)) {
                $this->main_comment = preg_replace("/a href\=\"\//i", "a href=\"https://" . $this->imdbsite . "/",
                  $match[1]);
            }
            $this->main_comment = str_replace("https://i.media-imdb.com/images/showtimes",
              $this->imdb_img_url . "/showtimes", $this->main_comment);
        }
        return $this->main_comment;
    }

    /** Get movie main comment (from title page - split-up variant)
     * @return array comment array[string title, string date, array author, string comment]; author: array[string url, string name]
     * @see IMDB page / (TitlePage)
     */
    public function comment_split()
    {
        if (empty($this->split_comment)) {
            if ($this->main_comment == "") {
                $comm = $this->comment();
            }
            if (@preg_match('!<strong[^>]*>(.*?)</strong>.*?<div class="comment-meta">\s*(.*?)\s*\|\s*by\s*(.*?</a>).*?<p[^>]*>(.*?)\s*</div!ims',
              $this->main_comment, $match)) {
                @preg_match('!href="(.*?)"[^>]*><span[^>]*>(.*)</span!i', $match[3], $author);
                $this->split_comment = array(
                  "title" => $match[1],
                  "date" => $match[2],
                  "author" => array("url" => $author[1], "name" => $author[2]),
                  "comment" => trim($match[4])
                );
            } elseif (@preg_match('!<div class="comment-meta">\s*<meta itemprop="datePublished" content=".+?">\s*(.{10,20})\s*\|\s*by\s*(.*?)\s*&ndash;.*?<div>\s*(.*?)\s*</div>!ims',
              $this->main_comment, $match)) {
                @preg_match('!href="(.*?)">(.*)</a!i', $match[2], $author);
                $this->split_comment = array(
                  'title' => '',
                  'date' => $match[1],
                  'author' => array("url" => $author[1], "name" => $author[2]),
                  "comment" => trim($match[3])
                );
            }
        }
        return $this->split_comment;
    }

    #-------------------------------------------------------[ Recommendations ]---

    /**
     * Get recommended movies (People who liked this...also liked)
     * @return array recommendations (array[title,imdbid,year,endyear,rating,votes])
     * @see IMDB page / (TitlePage)
     */
    public function movie_recommendations()
    {
        if (empty($this->movierecommendations)) {
            $doc = new \DOMDocument();
            @$doc->loadHTML($this->getPage("Title"));
            $xp = new \DOMXPath($doc);
            $cells = $xp->query("//div[@id=\"title_recs\"]//div[@class=\"rec-title\"]");
            /** @var \DOMElement $cell */
            foreach ($cells as $cell) {
                if (preg_match('!tt(\d+)!', $cell->getElementsByTagName('a')->item(0)->getAttribute('href'), $ref)) {
                    $movie['title'] = trim($cell->getElementsByTagName('a')->item(0)->nodeValue);
                    $movie['imdbid'] = $ref[1];
                    $span = $xp->query($cell->getNodePath() . '//span[@class="nobr"]')->item(0)->nodeValue;
                    $years = preg_replace('/[^0-9]/', '', $span);
                    if (strlen($years) > 4) {
                        $movie['year'] = substr($years, 0, 4);
                        $movie['endyear'] = substr($years, 4);
                    } else {
                        $movie['year'] = $years;
                        $movie['endyear'] = "";
                    }
                    if (preg_match('/([0-9.,]{1,3})\/10\s*\(([0-9\s.,]+)/iu', $cell->parentNode->getElementsByTagName('div')->item(3)->getAttribute('title'),
                      $rating)) {
                        $movie['rating'] = str_replace(',', '.', $rating[1]);
                        $movie['votes'] = preg_replace('/[^0-9]/', '', $rating[2]);
                    } else {
                        $movie['rating'] = -1;
                        $movie['votes'] = -1;
                    }
                    $this->movierecommendations[] = $movie;
                }
            }
        }
        return $this->movierecommendations;
    }

    #--------------------------------------------------------------[ Keywords ]---

    /** Get the keywords for the movie
     * @return array keywords
     * @see IMDB page / (TitlePage)
     */
    public function keywords()
    {
        if (empty($this->main_keywords)) {
            $this->getPage("Title");
            if (preg_match_all('!href="/search/keyword[^>]+?>\s*<span[^>]*?>(.*?)</span></a>!', $this->page["Title"],
              $matches)) {
                $this->main_keywords = $matches[1];
            }
        }
        return $this->main_keywords;
    }

    #--------------------------------------------------------[ Language Stuff ]---

    /** Get movies original language
     * @return string language
     * @brief There is not really a main language on the IMDB sites (yet), so this
     *  simply returns the first one
     * @see IMDB page / (TitlePage)
     */
    public function language()
    {
        if (empty($this->main_language)) {
            if (empty($this->langs)) {
                $this->langs = $this->languages();
            }
            if (!empty($this->langs)) {
                $this->main_language = $this->langs[0];
            }
        }
        return $this->main_language;
    }

    /** Get all languages this movie is available in
     * @return array languages (array[0..n] of strings)
     * @see IMDB page / (TitlePage)
     */
    public function languages()
    {
        if (empty($this->langs)) {
            if (preg_match_all('!href="/search/title\?.+?primary_language=([^&]*)[^>]*>\s*(.*?)\s*</a>(\s+\((.*?)\)|)!m',
              $this->getPage("Title"), $matches)) {
                $this->langs = $matches[2];
                $mc = count($matches[2]);
                for ($i = 0; $i < $mc; $i++) {
                    $this->langs_full[] = array(
                      'name' => $matches[2][$i],
                      'code' => $matches[1][$i],
                      'comment' => trim($matches[4][$i])
                    );
                }
            }
        }
        return $this->langs;
    }

    /** Get all languages this movie is available in, including details
     * @return array languages (array[0..n] of array[string name, string code, string comment], code being the ISO-Code)
     * @see IMDB page / (TitlePage)
     */
    public function languages_detailed()
    {
        if (empty($this->langs_full)) {
            $this->languages();
        }
        return $this->langs_full;
    }


    #--------------------------------------------------------------[ Genre(s) ]---

    /** Get the movies main genre
     *  Since IMDB.COM does not really now a "Main Genre", this simply means the
     *  first mentioned genre will be returned.
     * @return string genre first of the genres listed on the movies main page
     * @brief There is not really a main genre on the IMDB sites (yet), so this
     *  simply returns the first one
     * @see IMDB page / (TitlePage)
     */
    public function genre()
    {
        if (empty($this->main_genre)) {
            if (empty($this->moviegenres)) {
                $this->genres();
            }
            if (!empty($this->moviegenres)) {
                $this->main_genre = $this->moviegenres[0];
            }
        }
        return $this->main_genre;
    }

    /** Get all genres the movie is registered for
     * @return array genres (array[0..n] of strings)
     * @see IMDB page / (TitlePage)
     */
    public function genres()
    {
        if (empty($this->moviegenres)) {
            $genres = isset($this->jsonLD()->genre) ? $this->jsonLD()->genre : array();
            if (!is_array($genres)) {
                $genres = (array)$genres;
            }
            $this->moviegenres = $genres;
        }
        if (empty($this->moviegenres)) {
            if (@preg_match('!Genres:</h4>(.*?)</div!ims', $this->page["Title"], $match)) {
                if (@preg_match_all('!href="[^>]+?>\s*(.*?)\s*<!', $match[1], $matches)) {
                    $this->moviegenres = $matches[1];
                }
            }
        }
        return $this->moviegenres;
    }

    #----------------------------------------------------------[ Color format ]---

    /**
     * Get the colours this movie was shot in.
     * e.g. Color, Black and White
     * @return array colors (array[0..1] of strings)
     * @see IMDB page / (TitlePage)
     */
    public function colors()
    {
        if (empty($this->moviecolors)) {
            $this->getPage("Title");
            if (preg_match_all("|/search/title\?colors=[^>]+?>\s?(.*?)</a|", $this->page["Title"], $matches)) {
                $this->moviecolors = $matches[1];
            }
        }
        return $this->moviecolors;
    }

    #---------------------------------------------------------------[ Creator ]---

    /**
     * Get the creator(s) of a TV Show
     * @return array creator (array[0..n] of array[name,imdb])
     * @see IMDB page / (TitlePage)
     */
    public function creator()
    {
        $result = array();
        if ($this->jsonLD()->{'@type'} === 'TVSeries' && isset($this->jsonLD()->creator) && is_array($this->jsonLD()->creator)) {
            foreach ($this->jsonLD()->creator as $creator) {
                if ($creator->{'@type'} === 'Person') {
                    $result[] = array(
                      'name' => $creator->name,
                      'imdb' => rtrim(str_replace('/name/nm', '', $creator->url), '/')
                    );
                }
            }
        }
        return $result;
    }

    #---------------------------------------------------------------[ Tagline ]---

    /** Get the main tagline for the movie
     * @return string tagline
     * @see IMDB page / (TitlePage)
     */
    public function tagline()
    {
        if ($this->main_tagline == "") {
            $this->getPage("Title");
            if (@preg_match('!Taglines:</h4>\s*(.*?)\s*<!ims', $this->page["Title"], $match)) {
                $this->main_tagline = trim($match[1]);
            }
        }
        return $this->main_tagline;
    }

    #---------------------------------------------------------------[ Seasons ]---

    /** Get the number of seasons or 0 if not a series
     * @return int seasons number of seasons
     * @see IMDB page / (TitlePage)
     */
    public function seasons()
    {
        if ($this->seasoncount == -1) {
            $this->getPage("Title");
            if (preg_match_all('|href="/title/tt\d{7,8}/episodes\?season=\d+.*?"\s*>(\d+)</a>|Ui', $this->page["Title"],
              $matches)) {
                $this->seasoncount = $matches[1][0];
            } else {
                $this->seasoncount = 0;
            }
            if (preg_match_all('|href="/title/tt\d{7,8}/episodes\?season\=unknown"\s*>unknown</a>|Ui',
              $this->page["Title"], $matches)) {
                $this->seasoncount += count($matches[0]);
            }
        }
        return $this->seasoncount;
    }

    /**
     * Is this title serialised (a tv show)?
     * This could be the show page or an episode
     * @return boolean
     * @see IMDB page / (TitlePage)
     */
    public function is_serial()
    {
        if (isset($this->isSerial)) {
            return $this->isSerial;
        }

        return $this->isSerial = (bool)preg_match('|href="/title/tt\d{7,8}/episodes\?|i', $this->getPage("Title"));
    }

    /**
     * Is this title a TV Show episode?
     * @return boolean
     */
    public function isEpisode()
    {
        return self::movietype() === self::TV_EPISODE;
    }

    /**
     * Title of the episode
     * @return string
     */
    public function episodeTitle()
    {
        if (!$this->isEpisode()) {
            return "";
        }

        return $this->jsonLD()->name;
    }

    private function populateEpisodeSeasonEpisode()
    {
        if (!isset($this->episodeEpisode) || !isset($this->episodeSeason)) {
            if (preg_match("@<div class=\"bp_heading\">Season (\d+) <span class=\"ghost\">\|</span> Episode (\d+)</div>@",
              $this->getPage("Title"), $matches)) {
                $this->episodeSeason = (int)$matches[1];
                $this->episodeEpisode = (int)$matches[2];
            } else {
                $this->episodeSeason = 0;
                $this->episodeEpisode = 0;
            }
        }
    }

    /**
     * @return int 0 if not available
     */
    public function episodeSeason()
    {
        if (!$this->isEpisode()) {
            return 0;
        }

        $this->populateEpisodeSeasonEpisode();

        return $this->episodeSeason;
    }

    /**
     * @return int 0 if not available
     */
    public function episodeEpisode()
    {
        if (!$this->isEpisode()) {
            return 0;
        }

        $this->populateEpisodeSeasonEpisode();

        return $this->episodeEpisode;
    }

    /**
     * The date when this episode aired for the first time
     * @return string An ISO 8601 date e.g. 2015-01-01. Will be an empty string if not available
     */
    public function episodeAirDate()
    {
        if (!$this->isEpisode()) {
            return "";
        }

        if (!isset($this->jsonLD()->datePublished)) {
            return '';
        }

        return $this->jsonLD()->datePublished;
    }

    /**
     * Extra information about this episode (if this title is an episode)
     * @return array [imdbid,seriestitle,episodetitle,season,episode,airdate]
     * e.g.
     * <pre>
     * array (
     * 'imdbid'       => '0303461',      // ImdbID of the show
     * 'seriestitle'  => 'Firefly',      // Title of the show
     * 'episodetitle' => 'The Train Job',// Title of this episode
     * 'season'       => 1,
     * 'episode'      => 1,
     * 'airdate'      => '2002-09-20',
     * )
     * </pre>
     * @see IMDB page / (TitlePage)
     */
    public function get_episode_details()
    {
        if (!$this->isEpisode()) {
            return array();
        }
        $seriesRegex = '!<div class="titleParent">\s*<a\s+href="/title/tt(?<seriesimdbid>\d{7,8})[^"]+"\s*title="(?<seriestitle>[^"]+)"!ims';

        if (preg_match($seriesRegex, $this->getPage("Title"), $match)) {
            return array(
              "imdbid" => $match['seriesimdbid'],
              "seriestitle" => $match['seriestitle'],
              "episodetitle" => $this->episodeTitle(),
              "season" => $this->episodeSeason(),
              "episode" => $this->episodeEpisode(),
              "airdate" => $this->episodeAirDate()
            );
        } else {
            return array(); // no success
        }
    }

    #--------------------------------------------------------[ Plot (Outline) ]---

    /** Get the main Plot outline for the movie
     * @param boolean $fallback Fallback to storyline if we could not catch plotoutline
     * @return string plotoutline
     * @see IMDB page / (TitlePage)
     */
    public function plotoutline($fallback = false)
    {
        if ($this->main_plotoutline == "") {
            $page = $this->getPage("Title");
            if (preg_match('!class="summary_text">\s*(.*?)\s*</div>!ims', $page, $match)) {
                $this->main_plotoutline = trim($match[1]);
            } elseif ($fallback) {
                $this->main_plotoutline = $this->storyline();
            }
        }
        $this->main_plotoutline = preg_replace('!\s*<a href="/title/tt\d{7,8}/(plotsummary|synopsis)[^>]*>See full (summary|synopsis).*$!i',
          '', $this->main_plotoutline);
        $this->main_plotoutline = preg_replace('#<a href="[^"]+"\s+>Add a Plot</a>&nbsp;&raquo;#', '',
          $this->main_plotoutline);
        return $this->main_plotoutline;
    }

    /** Get the Storyline for the movie
     * @return string storyline
     * @see IMDB page / (TitlePage)
     */
    public function storyline()
    {
        if ($this->main_storyline == "") {
            $page = $this->getPage("Title");
            if (@preg_match('~Storyline</h2>.*?<div.*?<p>.*?<span>(.*?)</span>.*?</p>~ims', $page, $match)) {
                $this->main_storyline = trim($match[1]);
            }
        }
        return $this->main_storyline;
    }

    #--------------------------------------------------------[ Photo specific ]---

    /** Setup cover photo (thumbnail and big variant)
     * @return boolean success (TRUE if found, FALSE otherwise)
     * @see IMDB page / (TitlePage)
     */
    private function populatePoster()
    {
        if (isset($this->jsonLD()->image)) {
            $this->main_poster = $this->jsonLD()->image;
        }
        preg_match('!<img [^>]+title="[^"]+Poster"[^>]+src="([^"]+)"[^>]+/>!ims', $this->getPage("Title"), $match);
        if (!empty($match[1])) {
            $this->main_poster_thumb = $match[1];
        }
    }


    /**
     * Get the poster/cover image URL
     * @param boolean $thumb get the thumbnail (182x268) or the full sized image
     * @return string|false photo (string URL if found, FALSE otherwise)
     * @see IMDB page / (TitlePage)
     */
    public function photo($thumb = true)
    {
        if (empty($this->main_poster)) {
            $this->populatePoster();
        }
        if (!$thumb && empty($this->main_poster)) {
            return false;
        }
        if ($thumb && empty($this->main_poster_thumb)) {
            return false;
        }
        if ($thumb) {
            return $this->main_poster_thumb;
        }
        return $this->main_poster;
    }

    /**
     * Save the poster/cover image to disk
     * @param string $path where to store the file
     * @param boolean $thumb get the thumbnail (100x140, default) or the
     *        bigger variant (400x600 - FALSE)
     * @return boolean success
     * @see IMDB page / (TitlePage)
     */
    public function savephoto($path, $thumb = true)
    {
        $photo_url = $this->photo($thumb);
        if (!$photo_url) {
            return false;
        }

        $req = new Request($photo_url, $this->config);
        $req->sendRequest();
        if (strpos($req->getResponseHeader("Content-Type"), 'image/jpeg') === 0 ||
          strpos($req->getResponseHeader("Content-Type"), 'image/gif') === 0 ||
          strpos($req->getResponseHeader("Content-Type"), 'image/bmp') === 0) {
            $image = $req->getResponseBody();
        } else {
            $ctype = $req->getResponseHeader("Content-Type");
            $this->debug_scalar("*photoerror* at " . __FILE__ . " line " . __LINE__ . ": " . $photo_url . ": Content Type is '$ctype'");
            if (substr($ctype, 0, 4) == 'text') {
                $this->debug_scalar("Details: <PRE>" . $req->getResponseBody() . "</PRE>\n");
            }
            return false;
        }

        $fp2 = fopen($path, "w");
        if (!$fp2) {
            $this->logger->warning("Failed to open [$path] for writing  at " . __FILE__ . " line " . __LINE__ . "...<BR>");
            return false;
        }
        fputs($fp2, $image);
        return true;
    }

    /** Get the URL for the movies cover image
     * @param boolean $thumb get the thumbnail (182x268, default) or the
     *        bigger variant (400x600 - FALSE)
     * @return mixed url (string URL or FALSE if none)
     * @see IMDB page / (TitlePage)
     */
    public function photo_localurl($thumb = true)
    {
        if ($thumb) {
            $ext = "";
        } else {
            $ext = "_big";
        }
        if (!is_dir($this->photodir)) {
            $this->debug_scalar("<BR>***ERROR*** The configured image directory does not exist!<BR>");
            return false;
        }
        $path = $this->photodir . $this->imdbid() . "${ext}.jpg";
        if (file_exists($path)) {
            return $this->photoroot . $this->imdbid() . "${ext}.jpg";
        }
        if (!is_writable($this->photodir)) {
            $this->debug_scalar("<BR>***ERROR*** The configured image directory lacks write permission!<BR>");
            return false;
        }
        if ($this->savephoto($path, $thumb)) {
            return $this->photoroot . $this->imdbid() . "${ext}.jpg";
        }
        return false;
    }

    /** Get URLs for the pictures on the main page
     * @return array [0..n] of [imgsrc, imglink, bigsrc], where<UL>
     *    <LI>imgsrc is the URL of the thumbnail IMG as displayed on main page</LI>
     *    <LI>imglink is the link to the <b><i>page</i></b> with the "big image"</LI>
     *    <LI>bigsrc is the URL of the "big size" image itself</LI>
     * @author moonface
     * @author izzy
     */
    public function mainPictures()
    {
        $this->getPage("Title");
        if (empty($this->main_pictures)) {
            preg_match('!<div class="mediastrip">\s*(.*?)\s*</div>!ims', $this->page["Title"], $match);
            if (@preg_match_all('!<a .*?href="(?<href>.*?)".*?<img.*?src="(.*?)".*?loadlate="(?<imgsrc>.*?)"!ims',
              $match[1], $matches)) {
                for ($i = 0; $i < count($matches[0]); ++$i) {
                    $this->main_pictures[$i]["imgsrc"] = $matches['imgsrc'][$i];
                    if (substr($matches['href'][$i], 0, 4) != "http") {
                        $matches['href'][$i] = "https://" . $this->imdbsite . $matches[1][$i];
                    }
                    $this->main_pictures[$i]["imglink"] = $matches['href'][$i];
                    preg_match('|(.*\._V1).*|iUs', $matches['imgsrc'][$i], $big);
                    $ext = substr($matches[2][$i], -3);
                    $this->main_pictures[$i]["bigsrc"] = $big[1] . ".${ext}";
                    /*          // Get bigsrc from linked photo page. (proposed by ticket:327 -- seems to result in the same as above, so keeping it just-in-case)
          //preg_match('!<div id="photo-container".*?>\s*(.*?)\s*</div>!ims',$this->getWebPage("Bigsrc", $matches[1][$i]),$match2);
          //if (@preg_match_all('!<img.*?id="primary-img".*?src="(.*?)".*?!ims',$match2[1],$matches2)) {
          //  $this->main_pictures[$i]["bigsrc"] = $matches2[1][0];
          //} */
                }
            }
        }
        return $this->main_pictures;
    }

    #-------------------------------------------------[ Country of Production ]---

    /** Get country of production
     * @return array country (array[0..n] of string)
     * @see IMDB page / (TitlePage)
     */
    public function country()
    {
        if (empty($this->countries)) {
            if (preg_match_all('!/search/title\?country_of_origin=[^>]+?>(.*?)<!m', $this->getPage("Title"),
              $matches)) {
                $this->countries = $matches[1];
            }
        }
        return $this->countries;
    }


    #------------------------------------------------------------[ Movie AKAs ]---

    /**
     * Get movie's alternative names
     * Note: This may return an empty country or comments. The original title will have a country of '' and a comment of 'original title'
     * comment, year and lang are there for backwards compatibility and should not be used
     * @return array array[0..n] of array[title,country,comments[]]
     * @see IMDB page ReleaseInfo
     */
    public function alsoknow()
    {
        if (empty($this->akas)) {
            $page = $this->getPage("ReleaseInfo");
            if (empty($page)) {
                return array();
            } // no such page

            $table = Parsing::table($page, "//*[@id=\"akas\"]/following-sibling::table");

            if (empty($table)) {
                return array();
            }

            foreach ($table as $row) {
                $description = $row[0];
                $title = $row[1];

                $firstbracket = strpos($description, '(');
                if ($firstbracket === false) {
                    $country = $description;
                    $comments = array();
                } else {
                    $country = trim(substr($description, 0, $firstbracket));
                    preg_match_all("@\((.+?)\)@", $description, $matches);
                    $comments = $matches[1];
                }

                $this->akas[] = array(
                  "title" => $title,
                  "country" => $country,
                  "comments" => $comments,
                  "comment" => implode(', ', $comments),
                  "year" => '',
                  "lang" => ''
                );
            }
        }
        return $this->akas;
    }


    #---------------------------------------------------------[ Sound formats ]---

    /** Get sound formats
     * @return array sound (array[0..n] of strings)
     * @see IMDB page / (TitlePage)
     */
    public function sound()
    {
        if (empty($this->sound)) {
            $this->getPage("Title");
            if (preg_match_all("|/search/title\?sound_mixes=[^>]+>\s*(.*?)</|", $this->page["Title"], $matches)) {
                $this->sound = $matches[1];
            }
        }
        return $this->sound;
    }

    #-------------------------------------------------------[ MPAA / PG / FSK ]---

    /**
     * Get the MPAA rating / Parental Guidance / Age rating for this title by country
     * @return array [country => rating]
     * @see IMDB Parental Guidance page / (parentalguide)
     */
    public function mpaa()
    {
        if (empty($this->mpaas)) {
            $this->getPage("ParentalGuide");
            if (preg_match_all("|/search/title\?certificates=.*?>\s*(.*?):(.*?)<|", $this->page["ParentalGuide"],
              $matches)) {
                $cc = count($matches[0]);
                for ($i = 0; $i < $cc; ++$i) {
                    $this->mpaas[$matches[1][$i]] = $matches[2][$i];
                }
            }
        }
        return $this->mpaas;
    }

    /** Get the MPAA data (also known as PG or FSK) - including historical data
     * @return array mpaa (array[country][0..n]=rating)
     * @see IMDB page / (TitlePage)
     */
    public function mpaa_hist()
    {
        if (empty($this->mpaas_hist)) {
            $this->getPage("ParentalGuide");
            if (preg_match_all("|/search/title\?certificates=.*?>\s*(.*?):(.*?)<|", $this->page["ParentalGuide"],
              $matches)) {
                $cc = count($matches[0]);
                for ($i = 0; $i < $cc; ++$i) {
                    $this->mpaas_hist[$matches[1][$i]][] = $matches[2][$i];
                }
            }
        }
        return $this->mpaas_hist;
    }

    #----------------------------------------------------[ MPAA justification ]---

    /** Find out the reason for the MPAA rating
     * @return string reason why the movie was rated such
     * @see IMDB page / (TitlePage)
     */
    public function mpaa_reason()
    {
        if (empty($this->mpaa_justification)) {
            $this->getPage("ParentalGuide");
            if (preg_match('!id="mpaa-rating"\s*>\s*<td[^>]*>.*</td>\s*<td[^>]*>(.*)</td>!im',
              $this->page["ParentalGuide"], $match)) {
                $this->mpaa_justification = trim($match[1]);
            }
        }
        return $this->mpaa_justification;
    }

    #------------------------------------------------------[ Production Notes ]---

    /** For not-yet completed movies, we can get the production state
     * @return array production notes [status,statnote,lastupdate[day,month,mon,year],more,note]
     * @see IMDB page / (TitlePage)
     */
    public function prodNotes()
    {
        if (empty($this->main_prodnotes)) {
            $this->getPage("Title");
            if (!preg_match('!(<h2>Production Notes.*?)\s*</div!ims', $this->page["Title"], $match)) {
                return $this->main_prodnotes;
            } // no info available
            if (preg_match('!<b>Status:\s*</b>\s*(.*?)\s*<br!ims', $match[1], $tmp)) {
                if (preg_match('!(.*?)\s*<span class="ghost">\|</span>\s*(.*)!ims', $tmp[1], $tmp2)) {
                    $status = trim($tmp2[1]);
                    $statnote = trim($tmp2[2]);
                } else {
                    $status = trim($tmp);
                    $statnote = '';
                }
            } else {
                $status = '';
            }
            if (preg_match('!<b>Updated:\s*</b>\s*(\d+)\s*(\D+)\s+(\d{4})!ims', $match[1], $tmp)) {
                $update = array(
                  "day" => $tmp[1],
                  "month" => $tmp[2],
                  "mon" => $this->monthNo($tmp[2]),
                  "year" => $tmp[3]
                );
            } else {
                $update = array();
            }
            if (preg_match('!<b>More Info:\s*</b>\s*(.*)!ims', $match[1], $tmp)) {
                $more = preg_replace('!\s*onclick=".*?"!ims', '', trim($tmp[1]));
                $more = preg_replace('!href="/!ims', 'href="https://' . $this->imdbsite . '/', $more);
            } else {
                $more = '';
            }
            if (preg_match('!<b>Note:\s*</b>\s*(.*?)</!ims', $match[1], $tmp)) {
                $note = trim($tmp[1]);
            } else {
                $note = '';
            }
            $this->main_prodnotes = array(
              "status" => $status,
              "statnote" => $statnote,
              "lastUpdate" => $update,
              "more" => $more,
              "note" => $note
            );
        }
        return $this->main_prodnotes;
    }

    #----------------------------------------------[ Position in the "Top250" ]---

    /**
     * Find the position of a movie or tv show in the top 250 ranked movies or tv shows
     * @return int position a number between 1..250 if ranked, 0 otherwise
     * @author abe
     * @see http://projects.izzysoft.de/trac/imdbphp/ticket/117
     */
    public function top250()
    {
        if ($this->main_top250 == -1) {
            if (@preg_match('!<a href="[^"]*/chart/top.*>\s*Top Rated (?:Movies|TV) #(\d+)\s*</a>!si',
              $this->getPage("Title"), $match)) {
                $this->main_top250 = (int)$match[1];
            } else {
                $this->main_top250 = 0;
            }
        }
        return $this->main_top250;
    }


    #=====================================================[ /plotsummary page ]===
    #--------------------------------------------------[ Full Plot (combined) ]---
    /** Get the movies plot(s)
     * @return array plot (array[0..n] of strings)
     * @see IMDB page /plotsummary
     */
    public function plot()
    {
        if (empty($this->plot_plot)) {
            $page = $this->getPage("Plot");
            if (empty($page)) {
                return array();
            } // no such page
            $doc = new \DOMDocument();
            @$doc->loadHTML($page);
            $xp = new \DOMXPath($doc);
            $cells = $xp->query("//ul[@id=\"plot-summaries-content\"]/li[@id!=\"no-summary-content\"]");
            foreach ($cells as $cell) {
                $link = '';
                if ($a = $cell->getElementsByTagName('a')->item(0)) {
                    $href = preg_replace('!/search/title!i', 'https://' . $this->imdbsite . '/search/title',
                      $a->getAttribute('href'));
                    $link = "\n-\n" . '<a href="' . $href . '">' . trim($cell->getElementsByTagName('a')->item(0)->nodeValue) . '</a>';
                }
                $this->plot_plot[] = $cell->getElementsByTagName('p')->item(0)->nodeValue . $link;
            }
        }
        return $this->plot_plot;
    }

    #-----------------------------------------------------[ Full Plot (split) ]---

    /** Get the movie plot(s) - split-up variant
     * @return array array[0..n] of array[string plot,array author] - where author consists of string name and string url
     * @see IMDB page /plotsummary
     */
    public function plot_split()
    {
        if (empty($this->split_plot)) {
            if (empty($this->plot_plot)) {
                $this->plot_plot = $this->plot();
            }
            foreach ($this->plot_plot as $plot) {
                if (preg_match('!(?<plot>.*?)\n-\n<a href="(?<author_url>.*?)">(?<author_name>.*?)<\/a>!ims', $plot,
                  $match)) {
                    $this->split_plot[] = array(
                      "plot" => $match['plot'],
                      "author" => array("name" => $match['author_name'], "url" => $match['author_url'])
                    );
                } else {
                    $this->split_plot[] = array("plot" => $plot, "author" => array("name" => '', "url" => ''));
                }
            }
        }
        return $this->split_plot;
    }

    #========================================================[ /synopsis page ]===
    #---------------------------------------------------------[ Full Synopsis ]---
    /** Get the movies synopsis
     * @return string synopsis
     * @see IMDB page /synopsis
     */
    public function synopsis()
    {
        if (empty($this->synopsis_wiki)) {
            $page = $this->getPage("Synopsis");
            if (empty($page)) {
                return $this->synopsis_wiki;
            } // no such page
            if (preg_match('|<h4[^>]*>Synopsis</h4>\s*<ul[^>]*>\s*<li[^>]*>(.*?)</li>\s*</ul>|ims', $page, $match)) {
                $this->synopsis_wiki = trim($match[1]);
            }
        }
        return $this->synopsis_wiki;
    }

    #========================================================[ /taglines page ]===
    #--------------------------------------------------------[ Taglines Array ]---
    /** Get all available taglines for the movie
     * @return array taglines (array[0..n] of strings)
     * @see IMDB page /taglines
     */
    public function taglines()
    {
        if (empty($this->taglines)) {
            $this->getPage("Taglines");
            if ($this->page["Taglines"] == "cannot open page") {
                return array();
            } // no such page
            if (preg_match_all('!<div class="soda[^>]+>\s*(.*)\s*</div!U', $this->page["Taglines"], $matches)) {
                $this->taglines = array_map('trim', $matches[1]);
            }
        }
        return $this->taglines;
    }

    #=====================================================[ /fullcredits page ]===
    #-----------------------------------------------------[ Helper: TableRows ]---
    /**
     * Get rows for a given table on the page
     * @param string html
     * @param string table_start
     * @return string[] Contents of each row of the table
     * @see used by the methods director, cast, writing, producer, composer
     */
    protected function get_table_rows($html, $table_start)
    {
        if ($table_start == "Writing Credits" || $table_start == "Series Writing Credits") {
            $row_s = strpos($html, ">" . $table_start);
        } else {
            $row_s = strpos($html, ">" . $table_start . "&nbsp;<");
        }
        if ($row_s == 0) {
            return array();
        }
        $endtable = strpos($html, "</table>", $row_s);
        $block = substr($html, $row_s, $endtable - $row_s);
        if (preg_match_all('!<tr>(.+?)</tr>!ims', $block, $matches)) {
            $rows = $matches[1];
        }
        return $rows;
    }

    #------------------------------------------------[ Helper: Cast TableRows ]---

    /** Get rows for the cast table on the page
     * @param string html
     * @param string table_start
     * @return array array[0..n] of strings
     * @see used by the method cast
     */
    protected function get_table_rows_cast($html, $table_start, $class = "nm")
    {
        $row_s = strpos($html, '<table class="cast_list">');
        if ($row_s == 0) {
            return array();
        }
        $endtable = strpos($html, "</table>", $row_s);
        $block = substr($html, $row_s, $endtable - $row_s);
        if (preg_match_all('!<tr.*?>(.*?)</tr>!ims', $block, $matches)) {
            return $matches[1];
        }
        return array();
    }

    #------------------------------------------------------[ Helper: RowCells ]---

    /** Get content of table row cells
     * @param string row (as returned by imdb::get_table_rows)
     * @return array cells (array[0..n] of strings)
     * @see used by the methods director, cast, writing, producer, composer
     */
    protected function get_row_cels($row)
    {
        if (preg_match_all("/<td.*?>(.*?)<\/td>/ims", $row, $matches)) {
            return $matches[1];
        }
        return array();
    }

    #-------------------------------------------[ Helper: Get IMDBID from URL ]---

    /** Get the IMDB ID from a names URL
     * @param string href url to the staff members IMDB page
     * @return string IMDBID of the staff member
     * @see used by the methods director, cast, writing, producer, composer
     */
    protected function get_imdbname($href)
    {
        return preg_replace('!^.*nm(\d+).*$!ims', '$1', $href);
    }

    #-------------------------------------------------------------[ Directors ]---

    /**
     * Get the director(s) of the movie
     * @return array director (array[0..n] of arrays[imdb,name,role])
     * @see IMDB page /fullcredits
     */
    public function director()
    {
        if (!empty($this->credits_director)) {
            return $this->credits_director;
        }
        $directorRows = $this->get_table_rows($this->getPage('Credits'), "Directed by");
        if (!$directorRows) {
            $directorRows = $this->get_table_rows($this->getPage('Credits'), "Series Directed by");
        }
        foreach ($directorRows as $directorRow) {
            $cells = $this->get_row_cels($directorRow);
            if (isset($cells[0])) {
                if (isset($cells[2])) {
                    $role = trim(strip_tags($cells[2]));
                } else {
                    $role = null;
                }

                $this->credits_director[] = array(
                  'imdb' => $this->get_imdbname($cells[0]),
                  'name' => trim(strip_tags($cells[0])),
                  'role' => $role ?: null
                );
            }
        }
        return $this->credits_director;
    }

    #----------------------------------------------------------------[ Actors ]---

    /*
    * Get the Stars members for this title
    * @return empty array OR array Stars (array[0..n] of array[imdb,name])
     * e.g.
     * <pre>
     * array (
     *  'imdb' => '0000134',
     *  'name' => 'Robert De Niro', // Actor's name on imdb
     * )
     * </pre>
    */
    public function actor_stars()
    {
        $stars = array();
        if (empty($this->jsonLD()->actor)) {
            return $stars;
        }
        $actors = $this->jsonLD()->actor;
        if (!is_array($this->jsonLD()->actor)) {
            $actors = array($this->jsonLD()->actor);
        }
        foreach ($actors as $actor) {
            $act = array(
                'imdb' => preg_replace('!.*?/name/nm(\d+)/.*!', '$1', $actor->url),
                'name' => $actor->name,
            );
            $stars[] = $act;
        }
        return $stars;
    }
    
    /**
     * Get the actors/cast members for this title
     * @param boolean $short whether to get only the cast listed on the title page, or to get the full cast listing
     * @return array cast (array[0..n] of array[imdb,name,name_alias,role,role_episodes,role_start_year,role_end_year,thumb,photo])
     * e.g.
     * <pre>
     * array (
     *  'imdb' => '0922035',
     *  'name' => 'Dominic West', // Actor's name on imdb
     *  'name_alias' => NULL, // Name credited to actor if it is different to their imdb name
     *  'credited' => true, // Was the actor credited in the film?
     *  'role' => "Det. James 'Jimmy' McNulty",
     *  'role_episodes' => 60, // Only applies to episodic titles. Will be NULL if not available
     *  'role_start_year' => 2002, // Only applies to episodic titles. Will be NULL if not available
     *  'role_end_year' => 2008, // Only applies to episodic titles. Will be NULL if not available
     *  'role_other' => array() // Any other information about what the cast member did e.g. 'voice', 'archive footage'
     *  'thumb' => 'https://ia.media-imdb.com/images/M/MV5BMTY5NjQwNDY2OV5BMl5BanBnXkFtZTcwMjI2ODQ1MQ@@._V1_SY44_CR0,0,32,44_AL_.jpg',
     *  'photo' => 'https://ia.media-imdb.com/images/M/MV5BMTY5NjQwNDY2OV5BMl5BanBnXkFtZTcwMjI2ODQ1MQ@@.jpg' // Fullsize image of actor
     * )
     * </pre>
     * @see IMDB page /fullcredits
     */
    public function cast($short = false)
    {
        if (!empty($this->credits_cast)) {
            return $this->credits_cast;
        }

        if ($short) {
            $page = $this->getPage("Title");
        } else {
            $page = $this->getPage("Credits");
        }

        if (empty($page)) {
            return array(); // no such page
        }

        $cast_rows = $this->get_table_rows_cast($page, "Cast", "itemprop");
        foreach ($cast_rows as $cast_row) {
            $cels = $this->get_row_cels($cast_row);
            if (4 !== count($cels)) {
                continue;
            }
            $dir = array(
              'imdb' => null,
              'name' => null,
              'name_alias' => null,
              'credited' => true,
              'role' => null,
              'role_episodes' => null,
              'role_start_year' => null,
              'role_end_year' => null,
              'role_other' => array(),
              'thumb' => null,
              'photo' => null
            );
            $dir["imdb"] = preg_replace('!.*href="/name/nm(\d+)/.*!ims', '$1', $cels[1]);
            $dir["name"] = trim(strip_tags($cels[1]));
            if (empty($dir['name'])) {
                continue;
            }


            $role_cell = trim(strip_tags(str_replace('&nbsp;', '', $cels[3])));
            if ($role_cell) {
                $role_lines = explode("\n", $role_cell);
                // The first few lines (before any lines starting with brackets) are the role name
                while ($role_line = array_shift($role_lines)) {
                    $role_line = trim($role_line);
                    if (!$role_line) {
                        continue;
                    }
                    if ($role_line[0] == '(' || preg_match('@\d+ episode@', $role_line)) {
                        // Start of additional information, stop looking for the role name
                        array_unshift($role_lines, $role_line);
                        break;
                    }
                    if ($dir['role']) {
                        $dir['role'] .= ' ' . $role_line;
                    } else {
                        $dir['role'] = $role_line;
                    }
                }

                // Trim off the funny / ... role added on tv shows where an actor has multiple characters
                $dir['role'] = str_replace(' / ...', '', $dir['role']);

                $cleaned_role_cell = implode("\n", $role_lines);

                if (preg_match("#\(as (.+?)\)#s", $cleaned_role_cell, $matches)) {
                    $dir['name_alias'] = $matches[1];
                    $cleaned_role_cell = preg_replace("#\(as (.+?)\)#s", '', $cleaned_role_cell);
                }

                if (preg_match("#(\d+) episodes?, (\d+)(?:-(\d+))?#", $cleaned_role_cell, $matches)) {
                    $dir['role_episodes'] = (int)$matches[1];
                    $dir['role_start_year'] = (int)$matches[2];
                    if (isset($matches[3])) {
                        $dir['role_end_year'] = (int)$matches[3];
                    } else {
                        // If no end year, make the same as start year
                        $dir['role_end_year'] = (int)$matches[2];
                    }
                    $cleaned_role_cell = preg_replace("#\((\d+) episodes?, (\d+)(?:-(\d+))?\)#", '',
                      $cleaned_role_cell);
                }

                // Extract uncredited and other bits from their brackets after the role
                if (preg_match_all("#\((.+?)\)#", $cleaned_role_cell, $matches)) {
                    foreach ($matches[1] as $role_info) {
                        $role_info = trim($role_info);
                        if ($role_info == 'uncredited') {
                            $dir['credited'] = false;
                        } else {
                            $dir['role_other'][] = $role_info;
                        }
                    }
                }
            }


            if (preg_match('!.*<img [^>]*loadlate="([^"]+)".*!ims', $cels[0], $match)) {
                $dir["thumb"] = $match[1];
                if (strpos($dir["thumb"], '._V1')) {
                    $dir["photo"] = preg_replace('#\._V1_.+?(\.\w+)$#is', '$1', $dir["thumb"]);
                }
            } else {
                $dir["thumb"] = $dir["photo"] = "";
            }

            $this->credits_cast[] = $dir;
        }
        return $this->credits_cast;
    }


    #---------------------------------------------------------------[ Writers ]---

    /** Get the writer(s)
     * @return array writers (array[0..n] of arrays[imdb,name,role])
     * @see IMDB page /fullcredits
     */
    public function writing()
    {
        if (empty($this->credits_writing)) {
            $page = $this->getPage("Credits");
            if (empty($page)) {
                return array(); // no such page
            }
        }
        $writing_rows = $this->get_table_rows($this->page["Credits"], "Writing Credits");
        if (!$writing_rows) {
            $writing_rows = $this->get_table_rows($this->page["Credits"], "Series Writing Credits");
        }
        if (!$writing_rows) {
            return array();
        }
        for ($i = 0; $i < count($writing_rows); $i++) {
            $wrt = array();
            if (preg_match('!<a\s+href="/name/nm(\d+)/[^>]*>\s*(.+)\s*</a>!ims', $writing_rows[$i], $match)) {
                $wrt['imdb'] = $match[1];
                $wrt['name'] = trim($match[2]);
            } elseif (preg_match('!<td\s+class="name">(.+?)</td!ims', $writing_rows[$i], $match)) {
                $wrt['imdb'] = '';
                $wrt['name'] = trim($match[1]);
            } else {
                continue;
            }
            if (preg_match('!<td\s+class="credit"\s*>\s*(.+?)\s*</td>!ims', $writing_rows[$i], $match)) {
                $wrt['role'] = trim($match[1]);
            } else {
                $wrt['role'] = null;
            }
            $this->credits_writing[] = $wrt;
        }
        return $this->credits_writing;
    }

    #-------------------------------------------------------------[ Producers ]---

    /**
     * Obtain the producer(s)
     * @return array producer (array[0..n] of arrays[imdb,name,role])
     * e.g.
     * Array (
     *  'imdb' => '0905152'
     *  'name' => 'Lilly Wachowski'
     *  'role' => 'executive producer' // Can be null if no role is given
     * )
     * @see IMDB page /fullcredits
     */
    public function producer()
    {
        if (!empty($this->credits_producer)) {
            return $this->credits_producer;
        }
        $producerRows = $this->get_table_rows($this->getPage("Credits"), "Produced by");
        if (!$producerRows) {
            $producerRows = $this->get_table_rows($this->getPage("Credits"), "Series Produced by");
        }
        foreach ($producerRows as $producerRow) {
            $cells = $this->get_row_cels($producerRow);
            if (count($cells) > 2) {
                if (isset($cells[2])) {
                    $role = trim(strip_tags($cells[2]));
                    $role = preg_replace('/ \(as .+\)$/', '', $role);
                } else {
                    $role = null;
                }

                $this->credits_producer[] = array(
                  'imdb' => $this->get_imdbname($cells[0]),
                  'name' => trim(strip_tags($cells[0])),
                  'role' => $role ?: null
                );
            }
        }
        return $this->credits_producer;
    }

    #-------------------------------------------------------------[ Cinematographers ]---

    /** Obtain the cinematographer(s) ("Cinematography by...")
     * @return array cinematographer (array[0..n] of arrays[imdb,name,role])
     * @see IMDB page /fullcredits
     */
    public function cinematographer()
    {
        if (!empty($this->credits_cinematographer)) {
            return $this->credits_cinematographer;
        }
        $cinematographer_rows = $this->get_table_rows($this->getPage('Credits'), "Cinematography by");
        foreach ($cinematographer_rows as $cinematographer_row) {
            $cinematographer = array();
            if (preg_match('!<a\s+href="/name/nm(\d+)/[^>]*>\s*(.+)\s*</a>!ims', $cinematographer_row, $match)) {
                $cinematographer['imdb'] = $match[1];
                $cinematographer['name'] = trim($match[2]);
            } elseif (preg_match('!<td\s+class="name">(.+?)</td!ims', $cinematographer_row, $match)) {
                $cinematographer['imdb'] = '';
                $cinematographer['name'] = trim($match[1]);
            } else {
                continue;
            }
            if (preg_match('!<td\s+class="credit"\s*>\s*(.+?)\s*</td>!ims', $cinematographer_row, $match)) {
                $cinematographer['role'] = trim($match[1]);
            } else {
                $cinematographer['role'] = null;
            }
            $this->credits_cinematographer[] = $cinematographer;
        }
        return $this->credits_cinematographer;
    }

    #-------------------------------------------------------------[ Composers ]---

    /** Obtain the composer(s) ("Original Music by...")
     * @return array composer (array[0..n] of arrays[imdb,name,role])
     * @see IMDB page /fullcredits
     */
    public function composer()
    {
        if (!empty($this->credits_composer)) {
            return $this->credits_composer;
        }
        $composer_rows = $this->get_table_rows($this->getPage('Credits'), "Music by");
        if (!$composer_rows) {
            $composer_rows = $this->get_table_rows($this->getPage('Credits'), "Series Music by");
        }
        foreach ($composer_rows as $composer_row) {
            $composer = array();
            if (preg_match('!<a\s+href="/name/nm(\d+)/[^>]*>\s*(.+)\s*</a>!ims', $composer_row, $match)) {
                $composer['imdb'] = $match[1];
                $composer['name'] = trim($match[2]);
            } elseif (preg_match('!<td\s+class="name">(.+?)</td!ims', $composer_row, $match)) {
                $composer['imdb'] = '';
                $composer['name'] = trim($match[1]);
            } else {
                continue;
            }
            if (preg_match('!<td\s+class="credit"\s*>\s*(.+?)\s*</td>!ims', $composer_row, $match)) {
                $composer['role'] = trim($match[1]);
            } else {
                $composer['role'] = null;
            }
            $this->credits_composer[] = $composer;
        }
        return $this->credits_composer;
    }

    #====================================================[ /crazycredits page ]===
    #----------------------------------------------------[ CrazyCredits Array ]---
    /**
     * Get the Crazy Credits
     * @return string[]
     * @see IMDB page /crazycredits
     */
    public function crazy_credits()
    {
        if (empty($this->crazy_credits)) {
            if (preg_match_all('!<div class="sodatext">\s*(.*?)\s*</div>!ims', $this->getPage("CrazyCredits"),
              $matches)) {
                foreach ($matches[1] as $credit) {
                    $this->crazy_credits[] = trim(strip_tags($credit));
                }
            }
        }
        return $this->crazy_credits;
    }

    #========================================================[ /episodes page ]===
    #--------------------------------------------------------[ Episodes Array ]---
    /**
     * Get the series episode(s)
     * @return array episodes (array[0..n] of array[0..m] of array[imdbid,title,airdate,plot,season,episode])
     * @see IMDB page /episodes
     * @version Attention: Starting with revision 506 (version 2.1.3), the outer array no longer starts at 0 but reflects the real season number!
     */
    public function episodes()
    {
        if (!$this->is_serial() && !$this->seasons()) {
            return array();
        }

        if (empty($this->season_episodes)) {
            if (!$this->seasons()) {
                $ser = $this->get_episode_details();
                if (isset($ser['imdbid'])) {
                    $show = new Title($ser['imdbid'], $this->config);
                    return $this->season_episodes = $show->episodes();
                } else {
                    return array();
                }
            }
            $page = $this->getPage("Episodes");
            if (empty($page)) {
                return $this->season_episodes;
            } // no such page
            if (preg_match('!<select id="bySeason"(.*?)</select!ims', $page, $match)) {
                preg_match_all('!<option\s+(selected="selected" |)value="([^"]+)">!i', $match[1], $matches);
                for ($i = 0; $i < count($matches[0]); ++$i) {
                    $s = $matches[2][$i];
                    $page = $this->getPage("Episodes-$s");
                    if (empty($page)) {
                        continue;
                    } // no such page
                    $preg = '!<div class="info" itemprop="episodes".+?>\s*<meta itemprop="episodeNumber" content="(?<episodeNumber>-?\d+)"/>\s*'
                      . '<div class="airdate">\s*(?<airdate>.*?)\s*</div>\s*'
                      . '.+?\shref="/title/tt(?<imdbid>\d{7,8})/[^"]+?"\s+title="(?<title>[^"]+?)"\s+itemprop="name"'
                      . '.+?<div class="item_description" itemprop="description">(?<plot>.*?)</div>!ims';
                    preg_match_all($preg, $page, $eps, PREG_SET_ORDER);
                    foreach ($eps as $ep) {
                        $plot = preg_replace('#<a href="[^"]+"\s+>Add a Plot</a>#', '', trim($ep['plot']));
                        $plot = preg_replace('#Know what this is about\?<br>\s*<a href="[^"]+"\s*> Be the first one to add a plot.\s*</a>#ims',
                          '', $plot);

                        $episode = array(
                          'imdbid' => $ep['imdbid'],
                          'title' => trim($ep['title']),
                          'airdate' => $ep['airdate'],
                          'plot' => $plot,
                          'season' => $s,
                          'episode' => $ep['episodeNumber']
                        );

                        if ($ep['episodeNumber'] == -1) {
                            $this->season_episodes[$s][] = $episode;
                        } else {
                            $this->season_episodes[$s][$ep['episodeNumber']] = $episode;
                        }
                    }
                }
            }
        }
        return $this->season_episodes;
    }

    #===========================================================[ /goofs page ]===
    #-----------------------------------------------------------[ Goofs Array ]---
    /** Get the goofs
     * @return array goofs (array[0..n] of array[type,content]
     * @see IMDB page /goofs
     * @version Spoilers are currently skipped (differently formatted)
     */
    public function goofs()
    {
        if (empty($this->goofs)) {
            $page = $this->getPage("Goofs");
            if (empty($page)) {
                return array();
            } // no such page
            if (@preg_match_all('@<h4 class="li_group">(.+?)(!?&nbsp;)</h4>\s*(.+?)\s*(?=<h4 class="li_group">|<div id="top_rhs_wrapper")@ims',
              $this->page["Goofs"], $matches)) {
                $gc = count($matches[1]);
                for ($i = 0; $i < $gc; ++$i) {
                    if ($matches[1][$i] == 'Spoilers') {
                        continue;
                    } // no spoilers, moreover they are differently formatted
                    preg_match_all('!<div id="gf.+?>(\s*<div class="sodatext">)?(.+?)\s*</div>\s*<div!ims',
                      $matches[3][$i], $goofy);
                    $ic = count($goofy[0]);
                    for ($k = 0; $k < $ic; ++$k) {
                        $this->goofs[] = array(
                          "type" => $matches[1][$i],
                          "content" => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                            trim($goofy[2][$k]))
                        );
                    }
                }
            }
        }
        return $this->goofs;
    }


    #==========================================================[ /quotes page ]===
    #----------------------------------------------------------[ Quotes Array ]---
    /** Get the quotes for a given movie
     * @return array quotes (array[0..n] of string)
     * @see IMDB page /quotes
     */
    public function quotes()
    {
        if (empty($this->moviequotes)) {
            $page = $this->getPage("Quotes");
            if (empty($page)) {
                return array();
            }

            if (preg_match_all('!<div class="sodatext">\s*(.*?)\s*</div>!ims', str_replace("\n", " ", $page),
              $matches)) {
                foreach ($matches[1] as $match) {
                    $this->moviequotes[] = str_replace('href="/name/', 'href="https://' . $this->imdbsite . '/name/',
                      preg_replace('!<span class="linksoda".+?</span>!ims', '', $match));
                }
            }
        }
        return $this->moviequotes;
    }

    /** Get the quotes for a given movie (split-up variant)
     * @return array quote array[string quote, array character]; character: array[string url, string name]
     * @see IMDB page /quotes
     */
    public function quotes_split()
    {
        if (empty($this->split_moviequotes)) {
            if (empty($this->moviequotes)) {
                $quote = $this->quotes();
            }
            $i = 0;
            if (!empty($this->moviequotes)) {
                foreach ($this->moviequotes as $moviequotes) {
                    if (@preg_match_all('!<p>\s*(.*?)\s*</p>!', $moviequotes, $matches)) {
                        if (!empty($matches[1])) {
                            foreach ($matches[1] as $quote) {
                                if (@preg_match('!href="([^"]*)"\s*>.+?character">(.*?)</span.+?:(.*)!', $quote,
                                  $match)) {
                                    $this->split_moviequotes[$i][] = array(
                                      'quote' => trim(strip_tags($match[3])),
                                      'character' => array('url' => $match[1], 'name' => $match[2])
                                    );
                                } else {
                                    $this->split_moviequotes[$i][] = array(
                                      'quote' => trim(strip_tags($quote)),
                                      'character' => array('url' => '', 'name' => '')
                                    );
                                }
                            }
                        }
                    }
                    ++$i;
                }
            }
        }
        return $this->split_moviequotes;
    }


    #========================================================[ /trailers page ]===
    #--------------------------------------------------------[ Trailers Array ]---
    /**
     * Get the trailer URLs for a given movie
     * @param boolean $full Retrieve all available data (TRUE), or stay compatible with previous IMDBPHP versions (FALSE, Default)
     * @return mixed trailers either array[0..n] of string ($full=FALSE), or array[0..n] of array[lang,title,url,restful_url,resolution] ($full=TRUE)
     * @see IMDB page /trailers
     */
    public function trailers($full = false)
    {
        if (empty($this->trailers)) {
            $page = $this->getPage("Trailers");
            if (empty($page)) {
                return array();
            } // no such page

            $has_trailers = strpos($page, '<div class="search-results"><ol>');
            if ($has_trailers !== false) {
                $html_trailer = substr($page, $has_trailers,
                  strpos($page, '</ol>', $has_trailers) - ($has_trailers + 1));
                $doc = new \DOMDocument();
                @$doc->loadHTML('<?xml encoding="UTF-8">' . $html_trailer);
                foreach ($doc->getElementsByTagName('li') as $trailerNode) {
                    $titleNode = $trailerNode->getElementsByTagName('a')->item(1);
                    $title = $titleNode->nodeValue;
                    $url = "https://" . $this->imdbsite . $titleNode->getAttribute('href');
                    $imageUrl = $trailerNode->getElementsByTagName('img')->item(0)->getAttribute('loadlate');
                    $res = (strpos($imageUrl, 'HDIcon') !== false) ? 'HD' : 'SD';

                    if ($full) {
                        $this->trailers[] = array(
                          'title' => $title,
                          'url' => $url,
                          'resolution' => $res,
                          'lang' => '',
                          'restful_url' => ''
                        );
                    } else {
                        $this->trailers[] = $url;
                    }
                }
            }
        }
        return $this->trailers;
    }


    #===========================================================[ /videosites ]===
    #--------------------------------------------------------[ content helper ]---
    /** Convert IMDB redirect-URLs of external sites to real URLs
     * @param string url redirect-url
     * @return string url real-url
     */
    protected function convertIMDBtoRealURL($url)
    {
        if (preg_match('/^https?:\/\//', $url)) {
            return $url;
        }
        $req = new Request("https://" . $this->imdbsite . $url, $this->config);
        if ($req->sendRequest() !== false) {
            $head = $req->getLastResponseHeaders();
            foreach ($head as $header) {
                if (preg_match('/:/', $header)) {
                    list($type, $value) = explode(':', $header, 2);
                    if ($type == 'Location' || $type == 'location' ) {
                        return preg_replace('/\s/', '', $value);
                    }
                }
            }
        }
        return false;
    }

    /** Parse segments of external information on "VideoSites"
     * @param string title segment title
     * @param array res resultset (passed by reference)
     */
    protected function parse_extcontent($title, &$res)
    {
        $page = $this->getPage("VideoSites");
        if (empty($page)) {
            return array();
        } // no such page
        if (preg_match("!<h4 class=\"li_group\">$title\s*</h4>\s*(.+?)<(h4|div)!ims", $this->page["VideoSites"],
          $match)) {
            if (preg_match_all('!<li>(.+?)</li>!ims', $match[1], $matches)) {
                $mc = count($matches[0]);
                for ($i = 0; $i < $mc; ++$i) {
                    if (preg_match('!<a .*href="(?<url>.+?)".*?>(?<site>.*?) - (?<desc>.*) \((?<type>.*?)\)</a>!s',
                      $matches[1][$i], $entry)) {
                        $entry['url'] = $this->convertIMDBtoRealURL($entry['url']);
                        $res[] = array(
                          'site' => $entry['site'],
                          'url' => $entry['url'],
                          'type' => $entry['type'],
                          'desc' => trim($entry['desc'])
                        );
                    } elseif (preg_match('!<a .*href="(?<url>.+?)".*?>(?<site>.*?) - (?<desc>.+)</a>!s',
                      $matches[1][$i], $entry)) {
                        $entry['url'] = $this->convertIMDBtoRealURL($entry['url']);
                        $res[] = array(
                          'site' => $entry['site'],
                          'url' => $entry['url'],
                          'type' => '',
                          'desc' => trim($entry['desc'])
                        );
                    } elseif (preg_match('!<a .*href="(?<url>.+?)".*?>(?<desc>.+)</a>!s', $matches[1][$i], $entry)) {
                        $entry['url'] = $this->convertIMDBtoRealURL($entry['url']);
                        $res[] = array('site' => '', 'url' => $entry['url'], 'type' => '', 'desc' => trim($entry['desc']));
                    }
                }
            }
        }
    }

    #---------------------------------------------------[ Off-site soundclips ]---

    /** Get the off-site soundclip URLs
     * @return array soundclipsites array[0..n] of array(site,url,type,desc)
     * @see IMDB page /videosites
     */
    public function soundclipsites()
    {
        if (empty($this->soundclip_sites)) {
            $this->parse_extcontent('Sound Clips', $this->soundclip_sites);
        }
        return $this->soundclip_sites;
    }

    #-------------------------------------------------------[ Off-site photos ]---

    /** Get the off-site photo URLs
     * @return array photosites array[0..n] of array(site,url,type,desc)
     * @see IMDB page /videosites
     */
    public function photosites()
    {
        if (empty($this->photo_sites)) {
            $this->parse_extcontent('Photographs', $this->photo_sites);
        }
        return $this->photo_sites;
    }

    #--------------------------------------------------[ Off-site miscellanea ]---

    /** Get the off-site misc URLs
     * @return array miscsites array[0..n] of array(site,url,type,desc)
     * @see IMDB page /videosites
     */
    public function miscsites()
    {
        if (empty($this->misc_sites)) {
            $this->parse_extcontent('Miscellaneous Sites', $this->misc_sites);
        }
        return $this->misc_sites;
    }

    #------------------------------------------[ Off-site trailers and videos ]---

    /** Get the off-site videos and trailer URLs
     * @return array videosites array[0..n] of array(site,url,type,desc)
     * @see IMDB page /videosites
     */
    public function videosites()
    {
        if (empty($this->video_sites)) {
            $this->parse_extcontent('Video Clips and Trailers', $this->video_sites);
        }
        return $this->video_sites;
    }


    #==========================================================[ /trivia page ]===
    #----------------------------------------------------------[ Trivia Array ]---
    /**
     * Get the trivia info
     * @param boolean $spoil *Deprecated*. There are no longer spoiler trivia on imdb
     * @return array trivia (array[0..n] string
     * @see IMDB page /trivia
     */
    public function trivia($spoil = false)
    {
        if (empty($this->trivia)) {
            $page = $this->getPage("Trivia");
            if (empty($page)) {
                return array();
            } // no such page
            if ($spoil) {
                return [];
            } else {
                preg_match('!<div id="trivia_content"(.+?)<a id="spoilers"!ims', $this->page["Trivia"], $block);
                if (empty($block)) {
                    preg_match('!<div id="trivia_content"(.+?)<div id="sidebar">!ims', $this->page["Trivia"], $block);
                }
            }
            if (preg_match_all('!<div class="sodatext">\s*(.*?)\s*</div>\s*<div!ims', $block[1], $matches)) {
                $gc = count($matches[1]);
                for ($i = 0; $i < $gc; ++$i) {
                    $this->trivia[] = str_replace('href="/', 'href="https://' . $this->imdbsite . "/", $matches[1][$i]);
                }
            }
        }
        return $this->trivia;
    }


    #======================================================[ /soundtrack page ]===
    #------------------------------------------------------[ Soundtrack Array ]---
    /** Get the soundtrack listing
     * @return array soundtracks (array[0..n] of array(soundtrack,array[0..n] of credits array[credit_to,desc])
     * @see IMDB page /soundtrack
     */
    public function soundtrack()
    {
        if (empty($this->soundtracks)) {
            $page = $this->getPage("Soundtrack");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match_all('!class="soundTrack soda (odd|even)"\s*>\s*(?<title>.+?)<br\s*/>(?<desc>.+?)</div>!ims',
              str_replace("\n", " ", $this->page["Soundtrack"]), $matches)) {
                $mc = count($matches[0]);
                for ($i = 0; $i < $mc; ++$i) {
                    $s['soundtrack'] = $matches['title'][$i];
                    $s['credits'] = array();
                    if (preg_match_all('|^\s*(.*?)\s+by\s+(<a href[^>]+>.+?</a>)|i', $matches['desc'][$i], $match1)) {
                        for ($k = 0; $k < count($match1[0]); ++$k) {
                            switch ($match1[1][$k]) {
                                case "Arranged" :
                                    $s['credits'][] = array(
                                      'credit_to' => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                                        $match1[2][$k]),
                                      'desc' => 'arrangement'
                                    );
                                    break;
                                case "Composed" :
                                    $s['credits'][] = array(
                                      'credit_to' => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                                        $match1[2][$k]),
                                      'desc' => 'composer'
                                    );
                                    break;
                                case "Performed":
                                    $s['credits'][] = array(
                                      'credit_to' => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                                        $match1[2][$k]),
                                      'desc' => 'performer'
                                    );
                                    break;
                                case "Written"  :
                                    $s['credits'][] = array(
                                      'credit_to' => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                                        $match1[2][$k]),
                                      'desc' => 'writer'
                                    );
                                    break;
                                case "Written and Produced":
                                    {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $match1[2][$k]),
                                          'desc' => 'writer'
                                        );
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $match1[2][$k]),
                                          'desc' => 'producer'
                                        );
                                    }
                                    break;
                                case "Written and Performed":
                                    {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $match1[2][$k]),
                                          'desc' => 'writer'
                                        );
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $match1[2][$k]),
                                          'desc' => 'performer'
                                        );
                                    }
                                    break;
                                default:
                                    $s['credits'][] = array(
                                      'credit_to' => str_replace('href="/', 'href="https://' . $this->imdbsite . '/',
                                        $match1[2][$k]),
                                      'desc' => '**' . $match1[1][$k] . '**'
                                    );
                            }
                        }
                    } elseif (preg_match_all('|\s*([^>]*)\s+by\s+([^<]+)|i', $matches['desc'][$i],
                      $match1)) { // creditors without link
                        for ($k = 0; $k < count($match1[0]); ++$k) {
                            if (preg_match('!(.+)\s+and\s+(.+)!', $match1[2][$k], $cr)) {
                                $creds = array($cr[1], $cr[2]);
                            } else {
                                $creds = array($match1[2][$k]);
                            }
                            switch ($match1[1][$k]) {
                                case "Arranged" :
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'arrangement'
                                        );
                                    }
                                    break;
                                case "Composed" :
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'composer'
                                        );
                                    }
                                    break;
                                case "Performed":
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'performer'
                                        );
                                    }
                                    break;
                                case "Written"  :
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'writer'
                                        );
                                    }
                                    break;
                                case "Written and Produced":
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'writer'
                                        );
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'producer'
                                        );
                                    }
                                    break;
                                case "Written and Performed":
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'writer'
                                        );
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => 'performer'
                                        );
                                    }
                                    break;
                                default:
                                    foreach ($creds as $cred) {
                                        $s['credits'][] = array(
                                          'credit_to' => str_replace('href="/',
                                            'href="https://' . $this->imdbsite . '/', $cred),
                                          'desc' => '**' . $match1[1][$k] . '**'
                                        );
                                    }
                                    break;
                            }
                        }
                    }
                    if (preg_match('|Courtesy of\s+([^<]+)<|i', $matches['desc'][$i], $match)) {
                        $s['credits'][] = array('credit_to' => $match[1], 'desc' => 'courtesy');
                    }
                    if (preg_match('|By Arrangement with\s+([^<]+)<|i', $matches['desc'][$i], $match)) {
                        $s['credits'][] = array('credit_to' => $match[1], 'desc' => 'arrangement');
                    }
                    if (preg_match('|Under license from\s+([^<]+)<|i', $matches['desc'][$i], $match)) {
                        $s['credits'][] = array('credit_to' => $match[1], 'desc' => 'license');
                    }
                    $this->soundtracks[] = $s;
                }
            }
        }
        return $this->soundtracks;
    }

    #=================================================[ /movieconnection page ]===
    #----------------------------------------[ Helper: ConnectionBlock Parser ]---
    /** Parse connection block (used by method movieconnection only)
     * @param string conn connection type
     * @return array [0..n] of array mid,name,year,comment - or empty array if not found
     */
    protected function parseConnection($conn)
    {
        $arr = array();
        $tag_s = strpos($this->page["MovieConnections"], "<h4 class=\"li_group\">$conn");
        if (empty($tag_s)) {
            return array();
        } // no such feature
        $tag_e = strpos($this->page["MovieConnections"], "<h4 class=\"li", $tag_s + 4);
        if (empty($tag_e)) {
            $tag_e = strpos($this->page["MovieConnections"], "<h2", $tag_s);
        }
        $block = substr($this->page["MovieConnections"], $tag_s, $tag_e - $tag_s);
        if (preg_match_all('!<a href="(.*?)">(.*?)</a>(?:&nbsp;\((\d{4})\))?(.*?<br\s*/>(.*?)\s*</div>)?!ims', $block,
          $matches)) {
            $this->debug_object($matches);
            $mc = count($matches[0]);
            for ($i = 0; $i < $mc; ++$i) {
                $mid = substr($matches[1][$i], 9, strlen($matches[1][$i]) - 8); // isolate imdb id from url
                $arr[] = array(
                  "mid" => $mid,
                  "name" => $matches[2][$i],
                  "year" => $matches[3][$i],
                  "comment" => trim($matches[5][$i])
                );
            }
        }
        return $arr;
    }

    #-------------------------------------------------[ MovieConnection Array ]---

    /** Get connected movie information
     * @return array connections (versionOf, editedInto, followedBy, spinOff,
     *         spinOffFrom, references, referenced, features, featured, spoofs,
     *         spoofed - each an array of mid, name, year, comment or an empty
     *         array if no connections of that type)
     * @see IMDB page /movieconnection
     */
    public function movieconnection()
    {
        if (empty($this->movieconnections)) {
            $page = $this->getPage("MovieConnections");
            if (empty($page)) {
                return array();
            } // no such page
            $this->movieconnections["editedFrom"] = $this->parseConnection("Edited from");
            $this->movieconnections["editedInto"] = $this->parseConnection("Edited into");
            $this->movieconnections["featured"] = $this->parseConnection("Featured in");
            $this->movieconnections["features"] = $this->parseConnection("Features");
            $this->movieconnections["followedBy"] = $this->parseConnection("Followed by");
            $this->movieconnections["follows"] = $this->parseConnection("Follows");
            $this->movieconnections["references"] = $this->parseConnection("References");
            $this->movieconnections["referenced"] = $this->parseConnection("Referenced in");
            $this->movieconnections["remadeAs"] = $this->parseConnection("Remade as");
            $this->movieconnections["remakeOf"] = $this->parseConnection("Remake of");
            $this->movieconnections["spinOff"] = $this->parseConnection("Spin off");
            $this->movieconnections["spinOffFrom"] = $this->parseConnection("Spin off from");
            $this->movieconnections["spoofed"] = $this->parseConnection("Spoofed in");
            $this->movieconnections["spoofs"] = $this->parseConnection("Spoofs");
            $this->movieconnections["versionOf"] = $this->parseConnection("Version of");
        }
        return $this->movieconnections;
    }

    #=================================================[ /externalreviews page ]===
    #-------------------------------------------------[ ExternalReviews Array ]---
    /** Get list of external reviews (if any)
     * @return array [0..n] of array [url, desc] (or empty array if no data)
     * @see IMDB page /externalreviews
     */
    public function extReviews()
    {
        if (empty($this->extreviews)) {
            $page = $this->getPage("ExtReviews");
            if (empty($page)) {
                return array();
            } // no such page
            $tag_s = strpos($page, "<ul class=\"simpleList\"");
            if ($tag_s == 0) {
                return array();
            }
            $tag_e = strpos($page, '</ul', $tag_s);
            $block = substr($page, $tag_s, $tag_e - $tag_s);

            if (preg_match_all('@href="(.*?)"[^>]*>([^<]*)</a>@', $block, $matches)) {
                $mc = count($matches[0]);
                for ($i = 0; $i < $mc; ++$i) {
                    $this->extreviews[$i] = array(
                      "url" => $matches[1][$i],
                      "desc" => trim($matches[2][$i])
                    );
                }
            }
        }
        return $this->extreviews;
    }

    #=====================================================[ /releaseinfo page ]===
    #-----------------------------------------------------[ ReleaseInfo Array ]---
    /** Obtain Release Info (if any)
     * @return array release_info array[0..n] of strings (country,day,month,mon,
     * year,comment) - "month" is the month name, "mon" the number
     * @see IMDB page /releaseinfo
     */
    public function releaseInfo()
    {
        if (empty($this->release_info)) {
            $page = $this->getPage("ReleaseInfo");
            if (empty($page)) {
                return array();
            } // no such page

            $table = Parsing::table($page, "//*[@id=\"releases\"]/following-sibling::table");

            if (empty($table)) {
                return array();
            }

            foreach ($table as $row) {
                $country = trim(strip_tags($row[0]));
                $date = $row[1];
                $comment = preg_replace('/\s+/', ' ', $row[2]);

                if (!preg_match("/(\d{1,2})?\s*(\w+)?\s*(\d{4})/", $date, $matches)) {
                    continue;
                }

                list(, $day, $month, $year) = $matches;

                $this->release_info[] = array(
                  'country' => $country,
                  'day' => $day,
                  'month' => $month,
                  'mon' => $month ? $this->monthNo($month) : '',
                  'year' => $year,
                  'comment' => $comment
                );
            }
        }
        return $this->release_info;
    }

    #=======================================================[ /locations page ]===

    /**
     * Filming locations
     * @return string[]
     * @see IMDB page /locations
     */
    public function locations()
    {
        if (empty($this->locations)) {
            $page = $this->getPage("Locations");
            if (empty($page)) {
                return array();
            } // no such page
            $doc = new \DOMDocument();
            @$doc->loadHTML($page);
            $xp = new \DOMXPath($doc);
            $cells = $xp->query("//section[@id=\"filming_locations\"]//dt");
            foreach ($cells as $cell) {
                $this->locations[] = trim($cell->nodeValue);
            }
        }
        return $this->locations;
    }

    #==================================================[ /companycredits page ]===
    #---------------------------------------------[ Helper: Parse CompanyInfo ]---
    /** Parse company info
     * @param ref string text to parse
     * @param ref array parse target
     */
    protected function companyParse(&$text, &$target)
    {
        preg_match_all('|<li>\s*<a href="(.*)"\s*>(.*)</a>(.*)</li>|iUms', $text, $matches);
        $mc = count($matches[0]);
        for ($i = 0; $i < $mc; ++$i) {
            $target[] = array(
              "name" => $matches[2][$i],
              "url" => 'https://' . $this->imdbsite . $matches[1][$i],
              "notes" => trim($matches[3][$i])
            );
        }
    }

    #---------------------------------------------------[ Producing Companies ]---

    /** Info about Production Companies
     * @return array [0..n] of array (name,url,notes)
     * @see IMDB page /companycredits
     */
    public function prodCompany()
    {
        if (empty($this->compcred_prod)) {
            $page = $this->getPage("CompanyCredits");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match('|<h4[^>]*>Production Companies</h4>\s*<ul[^>]*>(.*?)</ul>|ims',
              $this->page["CompanyCredits"], $match)) {
                $this->companyParse($match[1], $this->compcred_prod);
            }
        }
        return $this->compcred_prod;
    }

    #------------------------------------------------[ Distributing Companies ]---

    /** Info about distributors
     * @return array [0..n] of array (name,url,notes)
     * @see IMDB page /companycredits
     */
    public function distCompany()
    {
        if (empty($this->compcred_dist)) {
            $page = $this->getPage("CompanyCredits");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match('|<h4[^>]*>Distributors</h4>\s*<ul[^>]*>(.*?)</ul>|ims', $this->page["CompanyCredits"],
              $match)) {
                $this->companyParse($match[1], $this->compcred_dist);
            }
        }
        return $this->compcred_dist;
    }

    #---------------------------------------------[ Special Effects Companies ]---

    /** Info about Special Effects companies
     * @return array [0..n] of array (name,url,notes)
     * @see IMDB page /companycredits
     */
    public function specialCompany()
    {
        if (empty($this->compcred_special)) {
            $page = $this->getPage("CompanyCredits");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match('|<h4[^>]*>Special Effects</h4>\s*<ul[^>]*>(.*?)</ul>|ims', $this->page["CompanyCredits"],
              $match)) {
                $this->companyParse($match[1], $this->compcred_special);
            }
        }
        return $this->compcred_special;
    }

    #-------------------------------------------------------[ Other Companies ]---

    /** Info about other companies
     * @return array [0..n] of array (name,url,notes)
     * @see IMDB page /companycredits
     */
    public function otherCompany()
    {
        if (empty($this->compcred_other)) {
            $page = $this->getPage("CompanyCredits");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match('|<h4[^>]*>Other Companies</h4>\s*<ul[^>]*>(.*?)</ul>|ims', $this->page["CompanyCredits"],
              $match)) {
                $this->companyParse($match[1], $this->compcred_other);
            }
        }
        return $this->compcred_other;
    }

    #===================================================[ /parentalguide page ]===
    #------------------------------------------------[ Helper: ParentalGuide Section ]---
    /** Get lists for the Parental Guide section's
     * @param string html
     * @param string section_id
     * @return array array[0..n] of strings
     * @see used by the method parentalGuide
     */
    protected function get_section_list_parental_guide($html, $section_id)
    {
        $tag_s = strpos($html, '<section id="advisory-' . $section_id . '"');
        if ($tag_s == 0) {
            return array();
        }
        $tag_e = strpos($html, '</section', $tag_s);
        $block = substr($html, $tag_s, $tag_e - $tag_s);

        if (preg_match_all('!<li class="ipl[^"]+">\s*(.*?)\s*<div!sui', $block, $matches)) {
            return array_map('htmlspecialchars_decode', array_map('trim', $matches[1]));
        }
        return array();
    }

    #-------------------------------------------------[ ParentalGuide Details ]---

    /** Detailed Parental Guide
     * @param boolean $spoil Whether to retrieve the spoilers (TRUE) or the non-spoilers (FALSE, default)
     * @return array of strings; keys: Drugs, Sex, Violence, Profanity,
     *         Frightening - and maybe more; values: arguments for the rating
     * @see IMDB page /parentalguide
     */
    public function parentalGuide($spoil = false)
    {
        if (empty($this->parental_guide)) {
            $page = $this->getPage("ParentalGuide");
            if (empty($page)) {
                return array();
            } // no such page
            if (preg_match_all('@<section id="advisory-([^"]*)(?<!spoilers)">.+?<h4[^>]+>(.*?)</h4>@sui', $page,
              $matches)) {
                $section_id = $matches[1];
                $section_name = array_map('htmlspecialchars_decode', $matches[2]);
                foreach ($section_id as $key => $id) {
                    if ($spoil && 0 !== strpos($id, 'spoiler')) {
                        continue;
                    } elseif (!$spoil && 0 === strpos($id, 'spoiler')) {
                        continue;
                    }
                    switch ($array_key = $section_name[$key]) {
                        case 'Alcohol, Drugs & Smoking'    :
                            $array_key = 'Drugs';
                            break;
                        case 'Sex & Nudity'                :
                            $array_key = 'Sex';
                            break;
                        case 'Violence & Gore'             :
                            $array_key = 'Violence';
                            break;
                        case 'Frightening & Intense Scenes':
                            $array_key = 'Frightening';
                            break;
                    }
                    $this->parental_guide[$array_key] = $this->get_section_list_parental_guide($page, $id);
                }
            }
        }
        return $this->parental_guide;
    }

    #===================================================[ /officialsites page ]===
    #---------------------------------------------------[ Official Sites URLs ]---
    /** URLs of Official Sites
     * @return array [0..n] of url, name
     * @see IMDB page /officialsites
     * @brief now combined with /videosites to /externalsites
     */
    public function officialSites()
    {
        if (empty($this->official_sites)) {
            $sites = array();
            $this->parse_extcontent('Official Sites', $sites);
            foreach ($sites as $site) {
                $this->official_sites[] = array('url' => $site['url'], 'name' => $site['desc']);
            }
        }
        return $this->official_sites;
    }

    #========================================================[ /keywords page ]===
    #--------------------------------------------------------------[ Keywords ]---
    /** Get the complete keywords for the movie
     * @return array keywords
     * @see IMDB page /keywords
     */
    public function keywords_all()
    {
        if (empty($this->all_keywords)) {
            $page = $this->getPage("Keywords");
            if (preg_match_all('|<a href="/search/keyword[^>]+?>(.*?)</a>|', $page, $matches)) {
                $this->all_keywords = $matches[1];
            }
        }
        return $this->all_keywords;
    }

    #========================================================[ /awards page ]===
    #--------------------------------------------------------------[ Awards ]---
    /** Get all awards this title was nominated for or won
     * @param boolean $compat whether stay backward compatible to the original format of Qvist. Default: TRUE
     * @return array awards array[festivalName]['entries'][0..n] of array[year,won,category,award,people[],comment,outcome]
     * e.g.
     * <pre>  [
     *    'Science Fiction and Fantasy Writers of America' =>
     *    [
     *      'entries' =>
     *      [
     *        [
     *          'year' => '2000',
     *          'won' => false,
     *          'category' => 'Best Script',
     *          'award' => 'Nebula Award',
     *          'people' =>
     *          [
     *              '0905154' => 'Lana Wachowski',
     *              '0905152' => 'Andy Wachowski',
     *          ],
     *          'outcome' => 'Nominated'
     *        ]
     *      ]
     *    ]
     *  ]</pre>
     * @see IMDB page /awards
     */
    public function awards($compat = true)
    {
        if (empty($this->awards)) {
            $this->getPage("Awards");
            $row_s = strpos($this->page["Awards"], '<h1 class="header">Awards</h1>');
            $row_e = strpos($this->page["Awards"], '<div class="article"', $row_s);
            $block = substr($this->page["Awards"], $row_s, $row_e - $row_s);
            preg_match_all('!<h3>\s*(?<festival>.+?)\s*<a [^>]+>\s*(?<year>\d{4}).*?</h3>\s*<table [^>]+>(?<table>.+?)</table>!ims',
              $block, $matches);
            $acount = count($matches[0]);
            for ($i = 0; $i < $acount; $i++) {
                $festival = $matches['festival'][$i];
                if (!preg_match_all('!<td class="(?<class>.+?)"[^>]*>\s*(?<data>.*?)\s*</td>!ims',
                  $matches['table'][$i], $col)) {
                    continue;
                }
                $ccount = count($col[0]);
                for ($k = 0; $k < $ccount; ++$k) {
                    switch ($col['class'][$k]) {
                        case "title_award_outcome":
                            preg_match('!(?<outcome>.+?)<br\s*/>\s*<span class="award_category">\s*(?<award>.+?)</span>!ims',
                              $col['data'][$k], $data);
                            $outcome = trim(strip_tags($data['outcome']));
                            if ($outcome === "Winner" || $outcome === "Won") {
                                $won = true;
                                $outcome = "Won";
                            } else {
                                $won = false;
                                if ($outcome === "Nominee") {
                                    $outcome = "Nominated";
                                }
                            }
                            $award = trim($data['award']);
                            break;
                        case "award_description":
                            $desc = trim($col['data'][$k]);
                            if (preg_match_all('|<a href\="/name/nm(\d+)[^"]*"\s*>(.*?)</a>|s', $desc, $data)) {
                                $people = isset($data[0][0]) ? array_combine($data[1], $data[2]) : array();
                                preg_match('!(.+?)<br!ims', $desc, $data) ? $cat = $data[1] : $cat = '';
                                if (substr($cat, 0, 3) == '<a ') {
                                    $cat = '';
                                }
                            } else {
                                $desc = preg_replace('#<div class="award_detail_notes">.+?</div>#s', '', $desc);
                                $cat = trim(strip_tags($desc));
                                $people = array();
                            }
                            if ($compat) {
                                $this->awards[$festival]['entries'][] = array(
                                  'year' => $matches['year'][$i],
                                  'won' => $won,
                                  'category' => $cat,
                                  'award' => $award,
                                  'people' => $people,
                                  'comment' => '',
                                  'outcome' => $outcome
                                );
                            } else {
                                $this->awards[$festival][] = array(
                                  'year' => $matches['year'][$i],
                                  'won' => $won,
                                  'category' => $cat,
                                  'award' => $award,
                                  'people' => $people,
                                  'outcome' => $outcome
                                );
                            }
                            break;
                        default:
                            break;
                    }
                }
                continue;
            }
        }
        return $this->awards;
    }

    /*
  * Get budget
  * @return int|null null on failure / no data
  * @brief Assuming budget is estimated, and in american dollar
  * @see IMDB page / (TitlePage)
  */
    public function budget()
    {
        if (empty($this->budget)) {
            $page = $this->getPage("Title");
            if (@preg_match("!<h4[^>]+>Budget:</h4>\\$([\d,]+)\n!is", $page, $bud)) { // Opening Weekend
                $this->budget = intval(str_replace(",", "", $bud[1]));
            } else {
                return null;
            }
        }
        return $this->budget;
    }

    #-------------------------------------------------[ Filming Dates ]---

    /**
     * Get filming dates
     * @return null|array[beginning, end]
     * Time format : YYYY-MM-DD
     * @see IMDB page / (Locations)
     */
    public function filmingDates()
    {
        if (empty($this->filmingDates)) {
            $page = $this->getPage("Locations");
            if (@preg_match("!<h4[^>]+>Filming Dates</h4>\s*\n*(.*?)(<br/>\n*)*</section!ims", $page, $filDates)) {
                if (preg_match("/(\d+ \w+ \d{4}) - (\d+ \w+ \d{4})/", strip_tags($filDates[1]), $dates)) {
                    $this->filmingDates = array(
                      'beginning' => date('Y-m-d', strtotime($dates[1])),
                      'end' => date('Y-m-d', strtotime($dates[2])),
                    );
                }
            }
        }
        return $this->filmingDates;
    }

    /**
     * Get the Alternate Versions for a given movie
     * @return array Alternate Version (array[0..n] of string)
     * @see IMDB page /alternateversions
     */
    public function alternateVersions()
    {
        if (empty($this->moviealternateversions)) {
            $page = $this->getPage('AlternateVersions');

            if (false !== strpos($page, 'id="no_content"')) {
                return array();
            }

            if (preg_match_all('!<div class="soda (odd|even)">\s*(.*?)\s*</div>!ims', $page, $matches)) {
                foreach ($matches[2] as $match) {
                    $this->moviealternateversions[] = trim(str_replace("\n", " ", $match));
                }
            }
        }
        return $this->moviealternateversions;
    }

    protected function getPage($page = null)
    {
        if (!empty($this->page[$page])) {
            return $this->page[$page];
        }

        $this->page[$page] = parent::getPage($page);

        return $this->page[$page];
    }

    protected function jsonLD()
    {
        if ($this->jsonLD) {
            return $this->jsonLD;
        }
        $page = $this->getPage('Title');
        preg_match('#<script type="application/ld\+json">(.+?)</script>#ims', $page, $matches);
        $this->jsonLD = json_decode($matches[1]);
        return $this->jsonLD;
    }

    /**
     * Get the ID for the title we're using. There might have been a redirect from the ID given in the constructor
     * @return string|null e.g. 0133093
     */
    public function real_id()
    {
        $page = $this->getPage('Title');
        if (preg_match('#<meta property="pageId" content="tt(\d+)"#', $page, $matches) && !empty($matches[1])) {
            return $matches[1];
        }
    }
}
