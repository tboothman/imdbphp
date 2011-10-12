<?php
 #############################################################################
 # IMDBPHP.MoviePilot                                    (c) Itzchak Rehberg #
 # written by Itzchak Rehberg <izzysoft AT qumran DOT org>                   #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################

 /* $Id$ */

 require_once (dirname(__FILE__)."/browseremulator.class.php");
 require_once (dirname(__FILE__)."/mdb_base.class.php");
 require_once (dirname(__FILE__)."/mdb_request.class.php");

#===================================================[ The Movie Base class ]===
/** Accessing Movie information
 * @package MDBApi
 * @class movie_base
 * @extends mdb_base
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class movie_base extends mdb_base {

#------------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor movie_base
   * @param string id IMDBID to use for data retrieval
   */
  function __construct ($id) {
    parent::__construct($id);
  }

#--------------------------------------------------[ Start (over) / Reset ]---
  /** Reset page vars
   * @method protected reset_vars
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
   $this->main_votes = -1;
   $this->main_year = -1;
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
   $this->trivia = array();
   $this->compcred_prod = array();
   $this->compcred_dist = array();
   $this->compcred_special = array();
   $this->compcred_other = array();
   $this->parental_guide = array();
   $this->official_sites = array();
   $this->locations = array();
  }


} // end class movie_base
?>
