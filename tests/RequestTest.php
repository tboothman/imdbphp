<?php

use \Imdb\Request;

class imdb_requestTest extends PHPUnit_Framework_TestCase {
  public function test_get() {
    $config = new \Imdb\Config();
    $request = new Request('https://images-na.ssl-images-amazon.com/images/M/MV5BMDMyMmQ5YzgtYWMxOC00OTU0LWIwZjEtZWUwYTY5MjVkZjhhXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_UY268_CR6,0,182,268_AL_.jpg', $config);
    $ok = $request->sendRequest();
    $this->assertTrue($ok);
    $headers = $request->getLastResponseHeaders();
    $this->assertTrue(count($headers) > 5);
    $this->assertEquals($request->getresponseheader('Content-Type'), 'image/jpeg');
  }
}