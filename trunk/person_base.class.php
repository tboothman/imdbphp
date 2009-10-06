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

#===================================================[ The Movie Base class ]===
/** Accessing Movie information
 * @package MDBApi
 * @class movie_base
 * @extends mdb_base
 * @author Izzy (izzysoft AT qumran DOT org)
 * @copyright (c) 2009 by Itzchak Rehberg and IzzySoft
 * @version $Revision$ $Date$
 */
class person_base extends mdb_base {

#------------------------------------------------------------[ Constructor ]---
  /** Initialize class
   * @constructor pilot_base
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
   $this->page["Name"] = "";
   $this->page["Bio"]  = "";

   // "Name" page:
   $this->main_photo      = "";
   $this->fullname        = "";
   $this->birthday        = array();
   $this->deathday        = array();
   $this->allfilms        = array();
   $this->actressfilms    = array();
   $this->actorsfilms     = array();
   $this->producersfilms  = array();
   $this->soundtrackfilms = array();
   $this->directorsfilms  = array();
   $this->crewsfilms      = array();
   $this->thanxfilms      = array();
   $this->selffilms       = array();
   $this->archivefilms    = array();

   // "Bio" page:
   $this->birth_name      = "";
   $this->nick_name       = array();
   $this->bodyheight      = array();
   $this->bio_bio         = array();
   $this->bio_trivia      = array();
   $this->bio_tm          = array();
   $this->bio_salary      = array();

   // "Publicity" page:
   $this->pub_prints      = array();
   $this->pub_movies      = array();
   $this->pub_interviews  = array();
   $this->pub_articles    = array();
   $this->pub_pictorial   = array();
   $this->pub_magcovers   = array();

   // SearchDetails
   $this->SearchDetails   = array();
  }

} // end class person_base
?>
