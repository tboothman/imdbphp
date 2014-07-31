<?php
 #############################################################################
 # IMDBPHP                              (c) Giorgos Giagas & Itzchak Rehberg #
 # written by Giorgos Giagas                                                 #
 # extended & maintained by Itzchak Rehberg <izzysoft AT qumran DOT org>     #
 # http://www.izzysoft.de/                                                   #
 # ------------------------------------------------------------------------- #
 # IMDBPHP TRAILERS                                        (c) Ricardo Silva #
 # written by Ricardo Silva (banzap) <banzap@gmail.com>                      #
 # http://www.ricardosilva.pt.tl/                                            #
 # rewritten and extended by Itzchak Rehberg <izzysoft AT qumran DOT org>    #
 # ------------------------------------------------------------------------- #
 # This program is free software; you can redistribute and/or modify it      #
 # under the terms of the GNU General Public License (see doc/LICENSE)       #
 #############################################################################
 # $Id$

 require_once (dirname(__FILE__)."/imdb.class.php");

 #=================================================[ The IMDB Charts class ]===
 /** Obtaining the URL of the trailer Flash Movie
  * @package IMDB
  * @class imdb_trailers
  * @author Ricardo Silva (banzap) <banzap@gmail.com>
  * @version $Revision$ $Date$
  */
 class imdb_trailers {
	var $page = "";
	var $moviemazeurl = "http://www.moviemaze.de";
	var $alltrailersurl = "http://www.alltrailers.net";
	var $latemagurl = "http://latemag.com";
	var $moviemazeflashplayer = "/media/trailer/flash/player.swf";
	var $latemagflashplayer = "/files/mediaplayer.swf";
	var $moviemazefilesyntax = "file=";
	var $latemagfilesyntax = "file=";
  protected $config;

  /**
   *
   * @param mdb_config $config OPTIONAL override default config
   */
    public function __construct(mdb_config $config = null) {
      $this->config = $config;
      $this->revision = preg_replace('|^.*?(\d+).*$|','$1','$Revision$');
    }
		
   /** Retrieve trailer URLs from moviemaze.de
    * @method getFlashCodeMovieMaze
    * @param string url trailer url as retrieved with imdb::videosites
    * @brief the URL of the trailer in http://www.moviemaze.de, this URL its obtained from the IMDB class, using the trailer function.
    * @return array [0..n] of array[url,format] of movie trailers (Flash or Quicktime)
    */
    function getFlashCodeMovieMaze($url){
      $req = new MDB_Request($url, $this->config);
      $req->sendRequest();
      $this->page=$req->getResponseBody();
      if($this->page=="" || $this->page==false) return false;
      preg_match_all('/<a href="([^\"]*)\.(flv|mov)"/iUms',$this->page,$matches);
      $mc = count($matches[0]);
      for ($i=0;$i<$mc;++$i) {
        if ( strpos($matches[1][$i],"http://")===0 ) $list[] = array("url"=>$matches[1][$i].".".$matches[2][$i],"format"=>$matches[2][$i]);
        else $list[] = array("url"=>$this->moviemazeurl.$matches[1][$i].".".$matches[2][$i],"format"=>$matches[2][$i]);
      }
      return $list;
    }

   /** Retrieve trailers from alltrailers.net
    * @method getFlashCodeAllTrailers
    * @param string url page url as retrieved with imdb::videosites
    * @brief the URL of the trailer in http://www.alltrailers.net, this URL its obtained from the IMDB class, using the trailer function.
    * @return array [0..n] of array[url,format] of movie trailers (Flash)
    */
    function getFlashCodeAllTrailers($url){
      if (strpos($url,"http://alltrailers")!==FALSE) $url = str_replace("http://","http://www.",$url);
      $req = new MDB_Request($url, $this->config);
      $req->sendRequest();
      $pattern = "'";
      $this->page=$req->getResponseBody();
      if($this->page=="" || $this->page==false) return false;
      preg_match_all('|<embed .* src="([^\"]*)"|iUms',$this->page,$matches);
      $mc = count($matches[1]);
      for ($i=0;$i<$mc;++$i) {
        if (strpos($matches[1][$i],"http://")===0) $list[$i] = array("url"=>$matches[1][$i],"format"=>"flv");
        else $list[$i] = array("url"=>$this->alltrailersurl.$matches[1][$i],"format"=>"flv");
      }
      return $list;
    }

   /** Retrieve trailers from IMDB site
    * @method getImdbTrailers
    * @param string url page url as retrieved with imdb::videosites
    * @return array [0..n] of array[url,format] of movie trailers (Flash)
    */
   function getImdbTrailers($url) {
     $url = str_replace("rg/VIDEO_TITLE/GALLERY/","",$url)."player";
     $req = new MDB_Request($url, $this->config);
     $req->sendRequest();
     $this->page=$req->getResponseBody();
     if($this->page=="" || $this->page==false) return false;
     preg_match('|so\.addVariable\("file",\s*"(http.*)"|iUms',$this->page,$match);
     $url = urldecode($match[1]);
     preg_match('|type\=\.(.{3})|i',$url,$format);
     if (!empty($url)) return array( array("url"=>$url,"format"=>$format[1]) );
   }

   /** Retrieve trailers from movieplayer.it (Italian)
    * @method getMoviePlayerTrailers
    * @param string url page url as retrieved with imdb::videosites
    * @return array [0..n] of array[url,format] of movie trailers (Flash)
    */
   function getMoviePlayerTrailers($url) {
     $req = new MDB_Request($url, $this->config);
     $req->sendRequest();
     $this->page=$req->getResponseBody();
     if($this->page=="" || $this->page==false) return false;
     preg_match('|s1\.addVariable\("file",\s*"(http.*)"|iUms',$this->page,$match);
     preg_match('|\.(.{3})$|i',$match[1],$format);
     if (!empty($match[1])) return array( array("url"=>$match[1],"format"=>$format[1]) );
   }

   /** Retrieve trailers from azmovietrailers.com
    * @method getAZMovieTrailers
    * @param string url page url as retrieved with imdb::videosites
    * @return array [0..n] of array[url,format] of movie trailers (Flash)
    */
   function getAZMovieTrailers($url) {
     $req = new MDB_Request($url, $this->config);
     $req->sendRequest();
     $this->page=$req->getResponseBody();
     if($this->page=="" || $this->page==false) return false;
     preg_match('|flashvars\="file\=(http.*)\&|iUms',$this->page,$match);
     preg_match('|\.(.{3})$|i',$match[1],$format);
     if (!empty($match[1])) return array( array("url"=>$match[1],"format"=>$format[1]) );
   }

   /** Retrieve trailers from youtube
    * @method getYoutubeTrailers
    * @param string url
    * @return array [0..n] of array[url,format] of movie trailers
    */
   function getYoutubeTrailers($url) {
     $videoid = preg_replace('|.*v=(.*)|','\\1',$url);
     parse_str(file_get_contents("http://youtube.com/get_video_info?video_id={$videoid}"),$i);
     if($i['status'] == 'fail' && $i['errorcode'] == '150') {
        $content = file_get_contents("http://www.youtube.com/watch?v={$videoid}");
        preg_match_all ("/(\\{.*?\\})/is", $content, $matches);
        $obj = json_decode($matches[0][1]);
        $token = $obj->{'t'};
        $fmt_url_map = $obj->{'fmt_url_map'};
     } elseif ($i['status'] == 'fail' && $i['errorcode'] != '150') {
        return false;
     } else {
        $token = $i['token'];
        $fmt_url_map = $i['fmt_url_map'];
     }
     $url = "http://www.youtube.com/get_video.php?video_id={$videoid}&vq=2&fmt={$fmt}&t={$token}";
     $headers = get_headers($url,1);
     $video = $headers['Location'];
     if(!isset($video)) {
        preg_match ("/((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s\"]*))/is", $fmt_url_map, $matches);
        $video = explode(',', $matches[0]); $video = $video[0];
     }
     #some times array?
     if (is_array($video)) return array("url"=>$video[0],"format"=>"flv");
     else return array("url"=>$video,"format"=>"flv");
   }

   /** Get all possible trailers
    * @method getAllTrailers
    * @param string mid IMDB ID
    * @return array [0..n] of array[url,format] of movie trailers
    */
   function getAllTrailers($mid) {
     $movie = new imdb($mid, $this->config);
     $arraytrailers = $movie->videosites();
     $list = array();
     foreach ($arraytrailers as $trail) {
       unset($tl);
       $tmp = strtolower($trail['url']);
       if ( strpos($tmp,"www.moviemaze.de")!==FALSE )
         $tl = $this->getFlashCodeMovieMaze($trail['url']);
       elseif ( strpos($tmp,"alltrailers.net")!==FALSE)
         $tl = $this->getFlashCodeAllTrailers($trail['url']);
       elseif ( strpos($url,"imdb.com/rg/VIDEO_TITLE/GALLERY")!==FALSE )
         $tl = $this->getImdbTrailers($trail['url']);
       elseif ( strpos($tmp,"www.movieplayer.it")!==FALSE )
         $tl = $this->getMoviePlayerTrailers($trail['url']);
       elseif ( strpos($tmp,"azmovietrailers.com")!==FALSE)
         $tl = $this->getAZMovieTrailers($trail['url']);
       elseif ( strpos($tmp,"youtube.com")!==FALSE)
         $tl = $this->getYoutubeTrailers($trail['url']);
       if ( isset($tl) ) $list = array_merge($list,$tl);
     }
   	 return $list;
   }
 }

