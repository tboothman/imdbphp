<?php
class imdbTest extends PHPUnit_Framework_TestCase {

    // @TODO tests for other types
    public function testMovietype() {
        $imdb = $this->getImdb();
        $this->assertEquals('Movie', $imdb->movietype());
    }

    public function testTitle() {
        $imdb = $this->getImdb();
        $this->assertEquals('The Matrix', $imdb->title());
    }

    //@TODO tests for titles with non ascii characters. Currently they're
    // html entities, would be nice to decode them

    public function testOrig_title_with_no_original() {
        $imdb = $this->getImdb();
        $this->assertEquals(null, $imdb->orig_title());
    }

    public function testOrig_title_with_original() {
        $imdb = $this->getImdb('0087544');
        $this->assertEquals('Kaze no tani no Naushika', $imdb->orig_title());
    }

    public function testYear() {
        $imdb = $this->getImdb();
        $this->assertEquals(1999, $imdb->year());
    }

    public function testEndyear() {
        $imdb = $this->getImdb();
        $this->assertEquals(1999, $imdb->endyear());
    }

    //@TODO do some tests for this on a tv show
//    public function testEndyear() {
//        $imdb = $this->getImdb();
//        $this->assertEquals(1999, $imdb->endyear());
//    }

    public function testYearspan() {
        // @TODO
    }

    public function testMovieTypes() {
        // @TODO
    }

    public function testRuntime() {
        $imdb = $this->getImdb();
        $this->assertEquals(136, $imdb->runtime());
    }

    public function testRuntime_primary_where_multiple_exist() {
        $imdb = $this->getImdb('0087544');
        $this->assertEquals(117, $imdb->runtime());
    }

    // one plain unannotated runtime "136 min"
    public function testRuntimes_one_runtime() {
        $imdb = $this->getImdb();
        $runtimes = $imdb->runtimes();
        $this->assertEquals(136, $runtimes[0]['time']);
    }

    // Nausicaa's runtimes are "117 min | 95 min (1985) (edited)"
    public function testRuntimes_two_runtimes_multiple_annotations() {
        $imdb = $this->getImdb('0087544');
        $runtimes = $imdb->runtimes();
        $this->assertEquals(117, $runtimes[0]['time']);
        $this->assertEquals(95, $runtimes[1]['time']);
        $this->assertEquals(1985, $runtimes[1]['annotations'][0]);
        $this->assertEquals('edited', $runtimes[1]['annotations'][1]);
    }

    // Apocalypse now "153 min | 202 min (Redux)"
    public function testRuntimes_two_runtimes_one_annotation() {
        $imdb = $this->getImdb('0078788');
        $runtimes = $imdb->runtimes();
        $this->assertEquals(153, $runtimes[0]['time']);
        $this->assertEquals(202, $runtimes[1]['time']);
        $this->assertEquals('Redux', $runtimes[1]['annotations'][0]);
    }

    public function testAspect_ratio() {
        $imdb = $this->getImdb();
        $this->assertEquals('2.35 : 1', $imdb->aspect_ratio());
    }

    public function testAspect_ratio_missing() {
        // @TODO
    }

    public function testRating() {
        $imdb = $this->getImdb();
        $this->assertEquals('8.7', $imdb->rating());
    }

    public function testRating_no_rating() {
        //@TODO
    }

    //@TODO this has nasty commas in the value, would be nice to remove them
    public function testVotes() {
        $imdb = $this->getImdb();
        $this->assertEquals(1, preg_match('/^(\d+,)+\d+$/', $imdb->votes()));
    }

    public function testVotes_no_votes() {
        //@TODO
    }

    public function testComment() {
        //@TODO
    }

    public function testComment_split() {
        //@TODO
    }

    public function testMovie_recommendations() {
        //@TODO
    }

    public function testKeywords() {
        //@TODO
    }

    public function testLanguage() {
        //@TODO
    }

    public function testLanguages_onelanguage() {
        $imdb = $this->getImdb();
        $this->assertEquals(array('English'), $imdb->languages());
    }

    public function testLanguages_multiplelanguage() {
        $imdb = $this->getImdb('1136608');
        $languages = $imdb->languages();
        $this->assertTrue(in_array('English', $languages));
        $this->assertTrue(in_array('Nyanja', $languages));
        $this->assertTrue(in_array('Afrikaans', $languages));
        $this->assertTrue(in_array('Zulu', $languages));
        $this->assertTrue(in_array('Xhosa', $languages));
    }

    public function testLanguages_nolanguage() {
        //@TODO
    }

    public function testLanguages_detailed() {
        //@TODO
    }

    public function testGenre() {
        //@TODO .. this is a pretty terrible function that doesn't return anything useful
        // Writing a test would be meaningless
    }

    // @TODO this function seems to have a fallback, although I'm not sure what to
    // Primary match is to the genre listing just under the title, which this tests
    public function testGenres_multiple() {
        $imdb = $this->getImdb();
        $genres = $imdb->genres();
        $this->assertTrue(in_array('Action', $genres));
        $this->assertTrue(in_array('Sci-Fi', $genres));
    }

    public function testGenres_none() {
        //@TODO
    }

    public function testColors() {
        //@TODO
    }

    public function testTagline() {
        //@TODO
    }

    public function testSeasons() {
        //@TODO
    }

    public function testIs_serial() {
        //@TODO
    }

    public function testGet_episode_details() {
        //@TODO
    }

    // Finds outline in the itemprop="description" section nexto the poster
    public function testPlotoutline() {
        $imdb = $this->getImdb();
        $this->assertEquals('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', $imdb->plotoutline());
    }

    public function testPlotoutline_strip_see_full_summary() {
        $imdb = $this->getImdb('0284717');
        $outline = $imdb->plotoutline();
        $this->assertEquals(0, strpos($outline, 'Towards the end of the eleventh century, Pope Urban II announces a crusade against the Saracens, who have occupied the holy city of Jerusalem.'));
        $this->assertFalse(stripos($outline, 'full summary'));
    }

    public function testPlotoutline_nooutline() {
        // @TODO there are lots of scenarios this function covers ...
    }

    public function testStoryline() {
        //@TODO
    }

    public function testPhoto() {
        //@TODO more tests!
    }

    public function testPhoto_thumb() {
        $imdb = $this->getImdb();
        // This is a little brittle. What if the image changes? what if the size of the poster changes? ...
        $this->assertEquals('http://ia.media-imdb.com/images/M/MV5BMTkxNDYxOTA4M15BMl5BanBnXkFtZTgwNTk0NzQxMTE@._V1_SX214_AL_.jpg', $imdb->photo(true));
    }

    public function testSavephoto() {
        //@TODO
    }

    public function testPhoto_localurl() {
        //@TODO
    }

    public function testMainPictures() {
        //@TODO
    }

    public function testCountry() {
        $imdb = $this->getImdb();
        $this->assertEquals(array('USA', 'Australia'), $imdb->country());
    }

    public function testCountry_nocountries() {
        //@TODO
    }

    public function testAlsoknow() {
        $imdb = $this->getImdb("0087544");
        $akas = $imdb->alsoknow();

        // No country
        $this->assertEquals('Nausicaä of the Valley of the Wind', $akas[0]['title']);
        $this->assertEquals('original title', $akas[0]['comments'][0]);

        //No country or comments (Should this really be included?)
        $this->assertEquals('Kaze no tani no Nausicaa', $akas[2]['title']);
        $this->assertEmpty($akas[2]['comments']);

        // Country, no comment
        $this->assertEquals('Nausicaä del Valle del Viento', $akas[3]['title']);
        $this->assertEquals('Argentina', $akas[3]['country']);
        $this->assertEmpty($akas[3]['comments']);

        // Country with comment
        $this->assertEquals('Наусика от Долината на вятъра', $akas[4]['title']);
        $this->assertEquals('Bulgaria', $akas[4]['country']);
        $this->assertEquals('Bulgarian title', $akas[4]['comments'][0]);

        // Country with two comments
        $this->assertEquals('Nausicaä - Aus dem Tal der Winde', $akas[6]['title']);
        $this->assertEquals('Switzerland', $akas[6]['country']);
        $this->assertEquals('DVD title', $akas[6]['comments'][0]);
        $this->assertEquals('German title', $akas[6]['comments'][1]);
    }

    public function testAlsoknow_returns_no_results_when_film_has_no_akas() {
      //@TODO
    }

    public function testSound() {
        //@TODO
    }

    public function testMpaa() {
        //@TODO
    }

    public function testMpaa_hist() {
        //@TODO
    }

    public function testMpaa_reason() {
        //@TODO
    }

    public function testProdNotes() {
        //@TODO
    }

    public function testTop250() {
        //@TODO
    }

    public function testPlot() {
        //@TODO
    }

    public function testPlot_split() {
        //@TODO
    }

    public function testSynopsis() {
        //@TODO
    }

    public function testTaglines() {
        //@TODO
    }

    public function testDirector_single() {
        $imdb = $this->getImdb('0087544');
        $this->assertEquals(array(
                array('imdb' => '0594503',
                    'name' => 'Hayao Miyazaki',
                    'role' => null),
            ),
            $imdb->director());
    }

    public function testDirector_multiple() {
        $imdb = $this->getImdb();
        // Is the 'role' part correct?
        $this->assertEquals(array(
                array('imdb' => '0905152',
                    'name' => 'Andy Wachowski',
                    'role' => '(as The Wachowski Brothers)'),
                array('imdb' => '0905154',
                    'name' => 'Lana Wachowski',
                    'role' => '(as The Wachowski Brothers)')
            ),
            $imdb->director());
    }

    public function testDirector() {
        //@TODO this needs more tests for different scenarios
    }

    public function testCast() {
        //@TODO
    }

    // Why keep the brackets?
    public function testWriting_multiple_withrole() {
        $imdb = $this->getImdb('0087544');
        $this->assertEquals(array(
                array('imdb' => '0594503',
                    'name' => 'Hayao Miyazaki',
                    'role' => '(comic)'),
                array('imdb' => '0594503',
                    'name' => 'Hayao Miyazaki',
                    'role' => '(screenplay)')
            ),
            $imdb->writing());
    }

    public function testWriting() {
        //@TODO more
    }

    public function testProducer() {
        //@TODO
    }
    
    // Stopped writing out tests for all functions here .. there are plenty more

    public function testSoundtrack_nosoundtracks() {
        $imdb = $this->getImdb('0087544');
        $result = $imdb->soundtrack();
        $this->assertEmpty($result);
    }

    // This function doesn't really work very well
    public function testSoundtrack_matrix() {
        $imdb = $this->getImdb();
        $result = $imdb->soundtrack();
        $this->assertnotEmpty($result);
        $this->assertEquals(12, count($result));

        // fully check out the first result
        // this might be a little tight, loosen this test if it fails incorrectly in the future
        /* Dissolved Girl
        Written by Robert del Naja, Grant Marshall (as Grantley Marshall), Mushroom Vowles (as Andrew Vowles),
        Sara J., and Matt Schwartz
        Performed by Massive Attack
        Courtesy of Virgin Records LTD.
        By Arrangement with Virgin Records America, Inc. */
        $dg = $result[0];
        $this->assertEquals('Dissolved Girl', $dg['soundtrack']);
        // should be 5 writer credits, 1 performer, 1 courtesy and 1 arrangement
//        $this->assertEquals(8, count($dg['credits']), "Incorrect number of credits");
//        $this->assertEquals('writer', $dg['credits'][0]['desc']);
//        $this->assertEquals('<a href="http://'.$imdb->imdbsite.'/name/nm1128020/?ref_=ttsnd_snd_1">Robert del Naja</a>', $dg['credits'][0]['credit_to']);
    }

    
    /**
     * Create an imdb object that uses cached pages
     * @return \imdb
     */
    protected function getImdb($imdbId = '0133093') {
        $imdb = new imdb($imdbId);
        $imdb->cachedir = realpath(dirname(__FILE__).'/cache');
        $imdb->usezip = true;
        $imdb->cache_expire = 9999999999;
        $imdb->debug = true;
        $imdb->language = 'En';
        return $imdb;
    }
}