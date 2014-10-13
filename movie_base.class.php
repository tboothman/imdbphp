<?php
 #############################################################################
 # IMDBPHP.Movie                                         (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

 require_once (dirname(__FILE__)."/mdb_base.class.php");

#===================================================[ The Movie Base class ]===
/** Accessing Movie information
 * @package MDBApi
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class movie_base extends mdb_base {

  protected $akas = array();
  protected $awards = array();
  protected $countries = array();
  protected $castlist = array(); // pilot only
  protected $crazy_credits = array();
  protected $credits_cast = array();
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
  protected $main_photo = "";
  protected $main_thumb = "";
  protected $main_pictures = array();
  protected $main_plotoutline = "";
  protected $main_rating = -1;
  protected $main_runtime = "";
  protected $main_movietype = "";
  protected $main_title = "";
  protected $original_title = "";
  protected $main_votes = -1;
  protected $main_year = -1;
  protected $main_endyear = -1;
  protected $main_yearspan = array();
  protected $main_creator = array();
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

  /**
   * Initialize class
   * @param string $id IMDBID to use for data retrieval
   * @param mdb_config $config *optional* override default config
   */
  function __construct ($id, mdb_config $config = null) {
    parent::__construct($config);
    $this->reset_vars();
  }

  /**
   * Reset all in object caching data e.g. page strings and parsed values
   */
  protected function reset_vars() {
   $this->page["Title"] = "";
   $this->page["TitleFoot"] = ""; // IMDB only, as part of info was outsourced
   $this->page["Credits"] = "";
   $this->page["CrazyCredits"] = "";
   $this->page["Amazon"] = "";
   $this->page["Goofs"] = "";
   $this->page["Trivia"] = "";
   $this->page["Plot"] = "";
   $this->page["Synopsis"] = "";
   $this->page["Comments"] = "";
   $this->page["Quotes"] = "";
   $this->page["Taglines"] = "";
   $this->page["Plotoutline"] = "";
   $this->page["Trivia"] = "";
   $this->page["Directed"] = "";
   $this->page["Episodes"] = "";
   $this->page["Quotes"] = "";
   $this->page["Trailers"] = "";
   $this->page["MovieConnections"] = "";
   $this->page["ExtReviews"] = "";
   $this->page["ReleaseInfo"] = "";
   $this->page["CompanyCredits"] = "";
   $this->page["ParentalGuide"] = "";
   $this->page["OfficialSites"] = "";
   $this->page["Keywords"] = "";
   $this->page["Awards"] = "";
   $this->page["Locations"] = "";
   $this->page["VideoSites"] = "";

   $this->akas = array();
   $this->awards = array();
   $this->countries = array();
   $this->castlist = array(); // pilot only
   $this->crazy_credits = array();
   $this->credits_cast = array();
   $this->credits_composer = array();
   $this->credits_director = array();
   $this->credits_producer = array();
   $this->credits_writing = array();
   $this->extreviews = array();
   $this->goofs = array();
   $this->langs = array();
   $this->langs_full = array();
   $this->aspectratio = "";
   $this->main_comment = "";
   $this->main_genre = "";
   $this->main_keywords = array();
   $this->all_keywords = array();
   $this->main_language = "";
   $this->main_photo = "";
   $this->main_thumb = "";
   $this->main_pictures = array();
   $this->main_plotoutline = "";
   $this->main_rating = -1;
   $this->main_runtime = "";
   $this->main_movietype = "";
   $this->main_title = "";
   $this->original_title = "";
   $this->main_votes = -1;
   $this->main_year = -1;
   $this->main_endyear = -1;
   $this->main_yearspan = array();
   $this->main_creator = array();
   $this->main_tagline = "";
   $this->main_storyline = "";
   $this->main_prodnotes = array();
   $this->main_movietypes = array();
   $this->main_top250 = -1;
   $this->moviecolors = array();
   $this->movieconnections = array();
   $this->moviegenres = array();
   $this->moviequotes = array();
   $this->movierecommendations = array();
   $this->movieruntimes = array();
   $this->mpaas = array();
   $this->mpaas_hist = array();
   $this->mpaa_justification = "";
   $this->plot_plot = array();
   $this->synopsis_wiki = "";
   $this->release_info = array();
   $this->seasoncount = -1;
   $this->season_episodes = array();
   $this->sound = array();
   $this->soundtracks = array();
   $this->split_comment = array();
   $this->split_plot = array();
   $this->taglines = array();
   $this->trailers = array();
   $this->video_sites = array();
   $this->soundclip_sites = array();
   $this->photo_sites = array();
   $this->misc_sites = array();
   $this->trivia = array();
   $this->compcred_prod = array();
   $this->compcred_dist = array();
   $this->compcred_special = array();
   $this->compcred_other = array();
   $this->parental_guide = array();
   $this->official_sites = array();
   $this->locations = array();
  }

}
