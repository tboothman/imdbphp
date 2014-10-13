<?php
#############################################################################
# IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
# written by Giorgos Giagas                                                 #
# extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
# http://www.izzysoft.de/                                                   #
# ------------------------------------------------------------------------- #
# IMDBPHP TOP CHARTS                                      (c) Ricardo Silva #
# written by Ricardo Silva (banzap) <banzap@gmail.com>                      #
# http://www.ricardosilva.pt.tl/                                            #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################
/* $Id$ */

include_once (dirname(__FILE__)."/mdb_base.class.php");

#=================================================[ The IMDB Charts class ]===
/** Obtaining the information about Moviemeter Top 10 and Weekend box office of IMDB
 * @package IMDB
 * @class imdb_topcharts
 * @author Ricardo Silva (banzap) <banzap@gmail.com>
 * @version $Revision$ $Date$
 */

class imdb_topcharts {
   var $chartspage = "http://www.imdb.com/chart/";
   var $page = "";

   /**
    * Constructor: Get data from the charts page
    * @param mdb_config $config OPTIONAL override default config
    */
   function __construct(mdb_config $config = null){
      $req = new MDB_Request($this->chartspage, $config);
      $req->sendRequest();
      $this->page=$req->getResponseBody();
      $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
   }

   /** Get the MOVIEmeter Top 10
    * @method getChartsTop10
    * @return array with ID of movies in the MOVIEmeter Top 10
    */
   function getChartsTop10(){
         $matchinit = "MOVIEmeter Top 10";
         $init_pos = strpos($this->page,$matchinit);
         $init_pos += (strlen($matchinit)+1);
         $i = 0;
         $offset = $init_pos;
         $res = "";
         while($i<10){
            $pattern = "<a href=\"/title/tt(\d+)/\">";
            $matches = "";
            preg_match($pattern, $this->page , $matches,PREG_OFFSET_CAPTURE,$offset);
            $mid_i = strpos($this->page,"tt",$matches[0][1])+2;
            $mid = substr($matches[0][0],17,7);
            $res[$i] = $mid;
            $offset = $matches[0][1]+1;
            $i++;
         }
         return $res;
   }

   /** Get the USA Weekend Box-Office Summary, weekend earnings and all time earnings
    * @method getChartsBoxOffice
    * @return array of array with ID of movies in the USA Weekend Box-Office Summary, weekend earnings and all time earnings
    */
   function getChartsBoxOffice(){
         $matchinit = 'US Box Office: USA Top 10';
         $init_pos = strpos($this->page,$matchinit);
         $init_pos += (strlen($matchinit)+1);
         $i = 0;
         $offset = $init_pos;
         $res = "";
         while($i<10){
            //mid
            $pattern = "<a\s+href=\"/title/tt(\d+)/\"\s*>";
            $matches = null;
            preg_match($pattern, $this->page , $matches,PREG_OFFSET_CAPTURE,$offset);
            $mid = substr($matches[0][0],18,7);
            $res[$i][0] = $mid;
            $offset = $matches[0][1]+10;
            //weekend
            $pattern1 = "/([$](\d+)M)|([$](\d+)[.](\d+)M)/";
            $matches1 = null;
            preg_match($pattern1, $this->page , $matches1,PREG_OFFSET_CAPTURE,$offset);
            $mid_e = strpos($matches1[0][0],"M");
            $mid = substr($matches1[0][0],1,$mid_e-1);
            $res[$i][1] = $mid;
            $offset = $matches1[0][1]+10;
            //all
            $pattern2 = "/([$](\d+)M)|([$](\d+)[.](\d+)M)/";
            $matches2 = null;
            preg_match($pattern2, $this->page , $matches2,PREG_OFFSET_CAPTURE,$offset);
            $mid_e = strpos($matches2[0][0],"M");
            $mid = substr($matches2[0][0],1,$mid_e-1);
            $res[$i][2] = $mid;
            $offset = $matches2[0][1]+10;
            $i++;
         }
         return $res;
   }
}

?>
