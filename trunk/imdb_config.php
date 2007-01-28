<?php
/*
This file is part of imdbphp.

    imdbphp is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    imdbphp is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with imdbphp; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// the proxy to use for connections to imdb.
// leave it empty for no proxy.
// this is only supported with PEAR. 
define ('PROXY', "");
define ('PROXY_PORT', "");

// set to false to use the old browseremulator.
$PEAR = false;

class imdb_config {
	var $imdbsite;
	var $cachedir;
	var $usecache;
	var $storecache;
        var $cache_expire;
	var $photodir;
	var $photoroot;

	function imdb_config(){
		$this->imdbsite = "us.imdb.com";
			// the imdb server to use.
			// choices are us.imdb.com uk.imdb.com german.imdb.com
                        // and italian.imdb.com
                        // the localized ones (i.e. italian and german) are
                        // only qualified to find the movies IMDB ID -- but
                        // parsing for the details will fail at the moment.

		$this->cachedir = './imdb/cache/';
			//cachedir should be writable by the webserver.
			//this doesn't need to be under documentroot.

		$this->usecache = false;
			//whether to use a cached page to retrieve the information if available.

		$this->storecache = false;
			//whether to store the pages retrieved for later use.

                $this->cache_expire = 0;
                        // automatically delete cached files older than X secs

		$this->photodir = './images/';
			//images are stored here after calling photo_localurl()
			// this needs to be under documentroot to be able to display them on your pages.

		$this->photoroot = './images/';
                        // this is the URL to the images, i.e. start at your
                        // servers DOCUMENT_ROOT when specifying absolute path
	}

}

// Don't edit below this line if you don't know exactly what you're doing :)

if ( $PEAR ){
// this release requires the HTTP_Request class from the PEAR project.
	require_once ("HTTP/Request.php");

	class IMDB_Request extends HTTP_Request{
		function IMDB_Request($url){
			$this->HTTP_Request($url);
			if ( PROXY != ""){
				$this->setProxy(PROXY, PROXY_PORT);
			}
			$this->_allowRedirects = false;
			$this->addHeader("User-Agent", "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
		}	
	}
}else{
	require_once ("browseremulator.class.php");

	class IMDB_Request extends BrowserEmulator{
		var $maxsize = 100000;
		function IMDB_Request($url){
			$this->BrowserEmulator();
			$this->urltoopen = $url;
		}
		function sendRequest(){
			$this->fpopened = $this->fopen($this->urltoopen);
		}
		function getResponseBody(){
                        $page = "";
			while (!feof ($this->fpopened)) {
				$page .= fread ($this->fpopened, 1024);
			}
			return $page;
		}
		function setURL($url){
			$this->urltoopen = $url;
		}
		function getresponseheader($header = false){
			$headers = $this->getLastResponseHeaders();
			foreach ($headers as $head){
				if ( is_integer(strpos ($head, $header) )){
					$hstart = strpos ($head, ": ");
					$head = trim(substr($head,$hstart+2,100));
					return $head;
				}
			}
		}
		
	}
}		

?>
