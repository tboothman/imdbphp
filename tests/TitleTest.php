<?php

class imdb_titleTest extends PHPUnit_Framework_TestCase {

  /**
   * IMDb IDs for testing:
   * 0133093 = The Matrix (has everything)
   * 0087544 = Nausicaa (foreign, nonascii)
   * 1570728 = Crazy, Stupid, Love (no runtime in tech details (but has a runtime at top)
   * 0078788 = Apocalypse Now (Two cuts, multiple languages)
   * 0108052 = Schindler's List (multiple colours)
   * 0338187 = The Last New Yorker (see full synopsis...)
   * 2768262 = redirect to 2386868
   * 1899250 = Mr. Considerate. short, no poster
   * 0416449 = 300 (some multi bracket credits)
   * 0103074 = Thelma & Louise (&amp; in title)
   * 1576699 = Mirrors 2 - recommends "'Mirrors' I"
   * 3110958 = Now You See Me 2 -- Testing german language
   *
   * 0306414 = The Wire (TV / has everything)
   * 1286039 = Stargate Universe (multiple creators)
   * 1027544 = Roary the Racing Car (TV show, almost everything missing)
   *
   * 0579539 = A TV episode (train job, firefly)
   *
   * 0284717 = Crociati (tv movie, see full summary...)
   */

    public function testConstruct_from_ini_constructed_config() {
        $config = new \Imdb\Config(dirname(__FILE__) . '/resources/test.ini');
        $imdb = new \Imdb\Title('0133093', $config);
        $this->assertEquals('test.local', $imdb->imdbsite);
        $this->assertEquals('/somefolder', $imdb->cachedir);
        $this->assertEquals(false, $imdb->storecache);
        $this->assertEquals(false, $imdb->usecache);
    }

    public function test_constructor_with_integer_imdbid_is_coerced_to_7_digit_number() {
      $imdb = new \Imdb\Title(133093);
      $this->assertEquals('0133093', $imdb->imdbid());
    }

    public function test_constructor_with_ttxxxxxxx_is_coerced_to_7_digit_number() {
      $imdb = new \Imdb\Title('tt0133093');
      $this->assertEquals('0133093', $imdb->imdbid());
    }

    public function test_constructor_with_url_is_coerced_to_7_digit_number() {
      $imdb = new \Imdb\Title('http://www.imdb.com/title/tt0133093/');
      $this->assertEquals('0133093', $imdb->imdbid());
    }

    public function test_constructor_with_custom_logger() {
      $logger = \Mockery::mock('\Psr\Log\LoggerInterface', function($mock) {
        $mock->shouldReceive('debug');
        $mock->shouldReceive('error');
      });
      $imdb = new \Imdb\Title('some rubbish', null, $logger);
      \Mockery::close(); // Assert that the mocked object was called as expected
    }

    public function test_constructor_with_custom_cache() {
      $cache = \Mockery::mock('\Imdb\CacheInterface', function($mock) {
        $mock->shouldReceive('get')->andReturn('test');
        $mock->shouldReceive('purge');
      });
      $imdb = new \Imdb\Title('', null, null, $cache);
      $imdb->title();
      \Mockery::close();
    }

    // @TODO tests for other types
    public function testMovietype_on_movie() {
        $imdb = $this->getImdb();
        $this->assertEquals('Movie', $imdb->movietype());
    }

    public function testMovietype_on_tv() {
        $imdb = $this->getImdb("0306414");
        $this->assertEquals('TV Series', $imdb->movietype());
    }

    public function testMovietype_on_tvMovie() {
      // @todo I would've thought this should be TV Movie but it's actually Movie
//        $imdb = $this->getImdb("284717");
//        $this->assertEquals('TV Movie', $imdb->movietype());
    }

    public function testTitle() {
        $imdb = $this->getImdb();
        $this->assertEquals('The Matrix', $imdb->title());
    }

    public function testTitle_removes_html_entities() {
        $imdb = $this->getImdb('0103074');
        $this->assertEquals('Thelma & Louise', $imdb->title());
    }

    public function testTitle_different_language() {
      $config = new \Imdb\Config();
      $config->language = 'de-de';
      $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
      $title = new \Imdb\Title(3110958, $config);
      $this->assertEquals('Die Unfassbaren 2', $title->title());
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

    public function testYear_for_a_film() {
        $imdb = $this->getImdb();
        $this->assertEquals(1999, $imdb->year());
    }

    public function testYear_for_a_tv_show() {
        $imdb = $this->getImdb("0306414");
        $this->assertEquals(2002, $imdb->year());
    }

    public function testEndyear_for_a_film() {
        // Film has no range, so endyear is the same as year
        $imdb = $this->getImdb();
        $this->assertEquals(1999, $imdb->endyear());
    }

    public function testEndyear_for_a_tv_show() {
        $imdb = $this->getImdb("0306414");
        $this->assertEquals(2008, $imdb->endyear());
    }

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

    public function testRuntime_no_runtime_in_technical_details() {
        $imdb = $this->getImdb('1570728');
        $this->assertEquals(118, $imdb->runtime());
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

    public function testVotes() {
        $imdb = $this->getImdb();
        $votes = $imdb->votes();
        $this->assertGreaterThan(907000, $votes);
        $this->assertLessThan(1500000, $votes);
    }

    public function testVotes_no_votes() {
        //@TODO
    }

    public function testMetacriticRating() {
      $imdb = $this->getImdb();
      $this->assertEquals(73, $imdb->metacriticRating());
    }

    public function testMetacriticRating_returns_null_when_no_rating() {
      $imdb = $this->getImdb('0087544');
      $this->assertEquals(null, $imdb->metacriticRating());
    }

    public function testMetacriticNumReviews() {
      $imdb = $this->getImdb();
      $this->assertEquals(null, $imdb->metacriticNumReviews());
    }

    public function testComment() {
        //@TODO
    }

    public function testComment_split() {
        //@TODO
    }

    public function testMovie_recommendations() {
        $imdb = $this->getImdb('1576699'); // Mirrors 2 has a recommendation of mirrors 1 which has an I inbetween its name and year
        $recommendations = $imdb->movie_recommendations();
        $this->assertInternalType('array', $recommendations);

        $recommendation = $recommendations[0];
        $this->assertEquals("Mirrors", $recommendation['title']);
        $this->assertEquals("0790686", $recommendation['imdbid']);
        $this->assertEquals(2008, $recommendation['year']);

        foreach ($recommendations as $recommendation) {
          $this->assertInternalType('array', $recommendation);
          $this->assertTrue(strlen($recommendation['title']) > 0); // title
          $this->assertTrue(strlen($recommendation['imdbid']) === 7); // imdb number
          $this->assertTrue(strlen($recommendation['year']) === 4); // year
        }
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
        $imdb = $this->getImdb('0078788');
        $languages = $imdb->languages();
        $this->assertTrue(in_array('English', $languages));
        $this->assertTrue(in_array('French', $languages));
        $this->assertTrue(in_array('Vietnamese', $languages));
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

    public function testColors_one_color() {
      $imdb = $this->getImdb();
      $colors = $imdb->colors();

      $this->assertInternalType('array', $colors);
      $this->assertCount(1, $colors);
      $this->assertEquals('Color', $colors[0]);
    }

    public function testColors_two_colors() {
      $imdb = $this->getImdb('0108052');
      $colors = $imdb->colors();

      $this->assertInternalType('array', $colors);
      $this->assertCount(2, $colors);
      $this->assertEquals('Black and White', $colors[0]);
      $this->assertEquals('Color', $colors[1]);
    }

    public function testCreator_no_creators() {
      // A little weak to test a movie for this, but it is testing a missing field
      $imdb = $this->getImdb('0133093');
      $creators = $imdb->creator();

      $this->assertInternalType('array', $creators);
      $this->assertEquals(0, count($creators));
    }

    public function testCreator_one_creator() {
      $imdb = $this->getImdb('0306414');
      $creators = $imdb->creator();

      $this->assertInternalType('array', $creators);
      $this->assertEquals('David Simon', $creators[0]['name']);
      $this->assertEquals('0800108', $creators[0]['imdb']);
    }

    public function testCreator_two_creators() {
      $imdb = $this->getImdb('1286039');
      $creators = $imdb->creator();

      $this->assertInternalType('array', $creators);
      $this->assertEquals('Robert C. Cooper', $creators[0]['name']);
      $this->assertEquals('0178338', $creators[0]['imdb']);
      $this->assertEquals('Brad Wright', $creators[1]['name']);
      $this->assertEquals('0942249', $creators[1]['imdb']);
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

    public function testEpisodeTitle() {
      $imdb = $this->getImdb('0579539');
      $this->assertEquals('The Train Job', $imdb->episodeTitle());
    }

    public function testEpisodeSeason() {
      $imdb = $this->getImdb('0579539');
      $this->assertEquals(1, $imdb->episodeSeason());
    }

    public function testEpisodeEpisode() {
      $imdb = $this->getImdb('0579539');
      $this->assertEquals(1, $imdb->episodeEpisode());
    }

    public function testEpisodeAirDate() {
      $imdb = $this->getImdb('0579539');
      $this->assertEquals('2002-09-20', $imdb->episodeAirDate());
    }

    public function testGet_episode_details_does_nothing_for_a_film() {
      $imdb = $this->getImdb();
      $episodeDetails = $imdb->get_episode_details();
      $this->assertInternalType('array', $episodeDetails);
      $this->assertCount(0, $episodeDetails);
    }

    public function testGet_episode_details() {
      $imdb = $this->getImdb('0579539');
      $episodeDetails = $imdb->get_episode_details();
      $this->assertEquals(array (
        'imdbid' => '0303461',
        'seriestitle' => 'Firefly',
        'episodetitle' => 'The Train Job',
        'season' => 1,
        'episode' => 1,
        'airdate' => '2002-09-20',
      ), $episodeDetails);
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

    public function testPlotoutline_strip_see_full_synopsis() {
        $imdb = $this->getImdb('0338187');
        $outline = $imdb->plotoutline();
        $this->assertEquals(0, strpos($outline, 'Lifelong friends Lenny (Dominic Chianese) and Ruben (Dick Latessa) are both in their 70s and dyed-in-the-wool New Yorkers...'));
        $this->assertFalse(stripos($outline, 'See full synopsis'));
    }

    public function testPlotoutline_nooutline() {
      $imdb = $this->getImdb('0133096');
      $outline = $imdb->plotoutline();
      $this->assertEquals('', $outline);
    }

    public function testStoryline() {
        //@TODO
    }

    public function testPhoto_returns_false_if_no_poster() {
        $imdb = $this->getImdb('1899250');
        $this->assertFalse($imdb->photo(false));
    }

    public function testPhoto_thumb_returns_false_if_no_poster() {
        $imdb = $this->getImdb('1899250');
        $this->assertFalse($imdb->photo(true));
    }

    public function testPhoto() {
        $imdb = $this->getImdb();
        // This is a little brittle. What if the image changes? what if the size of the poster changes? ...
        $this->assertEquals('https://images-na.ssl-images-amazon.com/images/M/MV5BMDMyMmQ5YzgtYWMxOC00OTU0LWIwZjEtZWUwYTY5MjVkZjhhXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1', $imdb->photo(false));
    }

    public function testPhoto_thumb() {
        $imdb = $this->getImdb();
        // This is a little brittle. What if the image changes? what if the size of the poster changes? ...
        $this->assertEquals('https://images-na.ssl-images-amazon.com/images/M/MV5BMDMyMmQ5YzgtYWMxOC00OTU0LWIwZjEtZWUwYTY5MjVkZjhhXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_UY268_CR6,0,182,268_AL_.jpg', $imdb->photo(true));
    }

    public function testSavephoto() {
        $imdb = $this->getImdb();
        @unlink(dirname(__FILE__).'/cache/poster.jpg');
        $result = $imdb->savephoto(dirname(__FILE__).'/cache/poster.jpg');
        $this->assertTrue($result);
        $this->assertFileExists(dirname(__FILE__).'/cache/poster.jpg');
        @unlink(dirname(__FILE__).'/cache/poster.jpg');
    }

    public function testPhoto_localurl() {
        //@TODO
    }

    public function testMainPictures() {
        //@TODO
    }

    public function testCountry() {
        $imdb = $this->getImdb();
        $this->assertEquals(array('USA'), $imdb->country());
    }

    public function testCountry_nocountries() {
        //@TODO
    }

    public function testAlsoknow() {
        $imdb = $this->getImdb("0087544");
        $akas = $imdb->alsoknow();

        // No country
        $this->assertEquals('Kaze no tani no Naushika', $akas[0]['title']);
        $this->assertEquals('original title', $akas[0]['comments'][0]);

        // Country, no comment
        $this->assertEquals('Nausicaä del Valle del Viento', $akas[1]['title']);
        $this->assertEquals('Argentina', $akas[1]['country']);
        $this->assertEmpty($akas[1]['comments']);

        // Country with comment
        $this->assertEquals('Наусика от Долината на вятъра', $akas[2]['title']);
        $this->assertEquals('Bulgaria', $akas[2]['country']);
        $this->assertEquals('Bulgarian title', $akas[2]['comments'][0]);

        // Country with two comments
        $this->assertEquals('Nausicaä - Aus dem Tal der Winde', $akas[4]['title']);
        $this->assertEquals('Switzerland', $akas[4]['country']);
        $this->assertEquals('DVD title', $akas[4]['comments'][0]);
        $this->assertEquals('German title', $akas[4]['comments'][1]);
    }

    public function testAlsoknow_returns_no_results_when_film_has_no_akas() {
      //@TODO
    }

    public function testSound_multiple_types() {
      $imdb = $this->getImdb();
      $sound = $imdb->sound();
      $this->assertInternalType('array', $sound);
      $this->assertCount(3, $sound);
      $this->assertEquals('DTS', $sound[0]);
      $this->assertEquals('Dolby Digital', $sound[1]);
      $this->assertEquals('SDDS', $sound[2]);
    }

    public function testSound_one_type() {
      $imdb = $this->getImdb('0087544');
      $sound = $imdb->sound();
      $this->assertInternalType('array', $sound);
      $this->assertCount(1, $sound);
      $this->assertEquals('Mono', $sound[0]);
    }

    public function testSound_none() {
      $imdb = $this->getImdb('1027544');
      $sound = $imdb->sound();
      $this->assertInternalType('array', $sound);
      $this->assertCount(0, $sound);
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
      $imdb = $this->getImdb();
      $top250 = $imdb->top250();
      $this->assertInternalType('integer', $top250);
      $this->assertGreaterThan(10, $top250);
      $this->assertLessThan(25, $top250);
    }

    public function testTop250_returns_0_when_not_in_top_250() {
      $imdb = $this->getImdb('1570728');
      $top250 = $imdb->top250();
      $this->assertInternalType('integer', $top250);
      $this->assertEquals(0, $top250);
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
                array(
                  'imdb' => '0905154',
                  'name' => 'Lana Wachowski',
                  'role' => '(as The Wachowski Brothers)'
                ),
                array(
                  'imdb' => '0905152',
                  'name' => 'Lilly Wachowski',
                  'role' => '(as The Wachowski Brothers)'
                )
            ),
            $imdb->director());
    }

    public function testDirector() {
        //@TODO this needs more tests for different scenarios
    }

    public function testCast_film_with_role_link() {
      $imdb = $this->getImdb();
      $cast = $imdb->cast();
      $firstCast = $cast[0];
      $this->assertEquals('0000206', $firstCast['imdb']);
      $this->assertEquals('Keanu Reeves', $firstCast['name']);
      $this->assertEquals('Neo', $firstCast['role']);
      $this->assertTrue($firstCast['credited']);
      $this->assertCount(0, $firstCast['role_other']);
    }

    public function testCast_film_with_role_link_and_as_name() {
      $imdb = $this->getImdb();
      $cast = $imdb->cast();
      $castMember = $cast[14];
      $this->assertEquals('0336802', $castMember['imdb']);
      $this->assertEquals('Marc Aden Gray', $castMember['name']);
      $this->assertEquals('Marc Gray', $castMember['name_alias']);
      $this->assertEquals('Choi', $castMember['role']);
      $this->assertTrue($castMember['credited']);
      $this->assertCount(0, $castMember['role_other']);
    }

    public function testCast_film_no_role_link() {
      $imdb = $this->getImdb();
      $cast = $imdb->cast();
      $castMember = $cast[16];
      $this->assertEquals('0330139', $castMember['imdb']);
      $this->assertEquals('Deni Gordon', $castMember['name']);
      $this->assertEquals('Priestess', $castMember['role']);
      $this->assertTrue($castMember['credited']);
      $this->assertCount(0, $castMember['role_other']);
    }

    public function testCast_film_no_role_link_and_as_name() {
      $imdb = $this->getImdb();
      $cast = $imdb->cast();
      $castMember = $cast[18];
      $this->assertEquals('0936860', $castMember['imdb']);
      $this->assertEquals('Eleanor Witt', $castMember['name']);
      $this->assertEquals('Elenor Witt', $castMember['name_alias']);
      $this->assertEquals('Potential', $castMember['role']);
      $this->assertTrue($castMember['credited']);
      $this->assertCount(0, $castMember['role_other']);
    }

    public function testCast_film_uncredited() {
      $imdb = $this->getImdb();
      $cast = $imdb->cast();
      $castMember = $cast[36];
      $this->assertEquals('1248119', $castMember['imdb']);
      $this->assertEquals('Mike Duncan', $castMember['name']);
      $this->assertEquals(null, $castMember['name_alias']);
      $this->assertEquals('Twin', $castMember['role']);
      $this->assertFalse($castMember['credited']);
    }

    public function testCast_film_as_name_and_brackets_in_role_name() {
      $imdb = $this->getImdb('0416449');
      $cast = $imdb->cast();
      $castMember = $cast[19];
      $this->assertEquals('2542697', $castMember['imdb']);
      $this->assertEquals('Sebastian St. Germain', $castMember['name']);
      $this->assertEquals('Sébastian St Germain', $castMember['name_alias']);
      $this->assertEquals('Fighting Boy (12 years old)', $castMember['role']);
      $this->assertTrue($castMember['credited']);
      $this->assertInternalType('array', $castMember['role_other']);
      $this->assertCount(0, $castMember['role_other']);
    }

    private function findCastByImdbNo($cast, $imdbNo) {
      foreach ($cast as $castMember) {
        if ($castMember['imdb'] == $imdbNo) {
          return $castMember;
        }
      }
    }

    public function testCast_film_multiple_roles() {
      $imdb = $this->getImdb('2015381');
      $cast = $imdb->cast();
      $castMember = $cast[13];
      $this->assertEquals('0348231', $castMember['imdb']);
      $this->assertEquals('Sean Gunn', $castMember['name']);
      $this->assertEquals(null, $castMember['name_alias']);
      $this->assertEquals('Kraglin / On Set Rocket', $castMember['role']);
      $this->assertTrue($castMember['credited']);
      $this->assertInternalType('array', $castMember['role_other']);
      $this->assertCount(0, $castMember['role_other']);
    }

    public function testCast_film_uncredited_and_other() {
      $imdb = $this->getImdb('2015381');
      $cast = $imdb->cast();
      $castMember = $this->findCastByImdbNo($cast, '0001293');
      $this->assertEquals('0001293', $castMember['imdb']);
      $this->assertEquals('Seth Green', $castMember['name']);
      $this->assertEquals(null, $castMember['name_alias']);
      $this->assertEquals('Howard the Duck', $castMember['role']);
      $this->assertFalse($castMember['credited']);
      $this->assertInternalType('array', $castMember['role_other']);
      $this->assertCount(1, $castMember['role_other']);
      $this->assertEquals('voice', $castMember['role_other'][0]);
    }

    public function testCast_tv_multi_episode_multi_year() {
        $imdb = $this->getImdb('0306414');
        $cast = $imdb->cast();
        $firstCast = $cast[0];

        $this->assertEquals('0922035', $firstCast['imdb']);
        $this->assertEquals('Dominic West', $firstCast['name']);
        $this->assertEquals("Det. James 'Jimmy' McNulty", $firstCast['role']);
        $this->assertEquals(60, $firstCast['role_episodes']);
        $this->assertEquals(2002, $firstCast['role_start_year']);
        $this->assertEquals(2008, $firstCast['role_end_year']);
        $this->assertInternalType('array', $firstCast['role_other']);
        $this->assertCount(0, $firstCast['role_other']);
        $this->assertEquals('https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5NjQwNDY2OV5BMl5BanBnXkFtZTcwMjI2ODQ1MQ@@._V1_UY44_CR0,0,32,44_AL_.jpg', $firstCast['thumb']);
        $this->assertEquals('https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5NjQwNDY2OV5BMl5BanBnXkFtZTcwMjI2ODQ1MQ@@.jpg', $firstCast['photo']);
    }

    public function testCast_tv_multi_episode_one_year() {
        $imdb = $this->getImdb('0306414');
        $castMember = $this->findCastByImdbNo($imdb->cast(), '1370480');

        $this->assertEquals('1370480', $castMember['imdb']);
        $this->assertEquals('Dan DeLuca', $castMember['name']);
        $this->assertEquals("David Parenti", $castMember['role']);
        $this->assertEquals(11, $castMember['role_episodes']);
        $this->assertEquals(2006, $castMember['role_start_year']);
        $this->assertEquals(2006, $castMember['role_end_year']);
        $this->assertInternalType('array', $castMember['role_other']);
        $this->assertCount(0, $castMember['role_other']);
    }

    public function testCast_tv_one_episode_one_year() {
        $imdb = $this->getImdb('0306414');
        $cast = $imdb->cast();
        $castMember = $cast[271];

        $this->assertEquals('0661449', $castMember['imdb']);
        $this->assertEquals('Neko Parham', $castMember['name']);
        $this->assertEquals("State Police Undercover Troy Wiggins", $castMember['role']);
        $this->assertEquals(1, $castMember['role_episodes']);
        $this->assertEquals(2002, $castMember['role_start_year']);
        $this->assertEquals(2002, $castMember['role_end_year']);
        $this->assertInternalType('array', $castMember['role_other']);
        $this->assertCount(0, $castMember['role_other']);
    }

    // @TODO Why keep the brackets?
    public function testWriting_multiple_withrole() {
        $imdb = $this->getImdb('0087544');
        $this->assertEquals(array(
                array('imdb' => '0594503',
                    'name' => 'Hayao Miyazaki',
                    'role' => '(comic)'),
                array('imdb' => '0594503',
                    'name' => 'Hayao Miyazaki',
                    'role' => '(screenplay)'),
                array (
                  'imdb' => '1248357',
                  'name' => 'Cindy Davis Hewitt',
                  'role' => '(english version) (english version) &'
                ),
                array('imdb' => '1248358',
                    'name' => 'Donald H. Hewitt',
                    'role' => '(english version) (english version)'),
                array('imdb' => '0411872',
                  'name' => 'Kazunori Itô',
                  'role' => '(first draft) (uncredited)')
            ),
            $imdb->writing());
    }

    public function testWriting_tv() {
      $imdb = $this->getImdb('0306414');
      $credits = $imdb->writing();
      $this->assertEquals(array('imdb' => '0800108', 'name' => 'David Simon', 'role' => '(creator) (60 episodes, 2002-2008)'), $credits[0]);
    }

    public function testWriting() {
        //@TODO more
    }

    public function testProducer() {
        //@TODO
    }

  public function testComposer_movie() {
    $imdb = $this->getImdb();
    $composers = $imdb->composer();
    $this->assertCount(1, $composers);
    $this->assertEquals(array('imdb' => '0204485','name' => 'Don Davis', 'role' => null), $composers[0]);
  }

  public function testComposer_series() {
    $imdb = $this->getImdb('1286039');
    $composers = $imdb->composer();
    $this->assertCount(1, $composers);
    $this->assertEquals(array('imdb' => '0006107', 'name' => 'Joel Goldsmith', 'role' => '(40 episodes, 2009-2011)'), $composers[0]);
  }

  public function testComposer_none() {
    // The wire has 'Series Music Department' but no 'Series Music by' section so returns no results
    $imdb = $this->getImdb('0306414');
    $composers = $imdb->composer();
    $this->assertCount(0, $composers);
  }

  public function testCrazy_credits() {
      $imdb = $this->getImdb();
      $credits = $imdb->crazy_credits();
      $this->assertCount(3, $credits);
      $this->assertEquals('At the end of all the credits, the URL for the (now defunct) website of the film is given, www.whatisthematrix.com, along with a password, \'steak\'. There\'s a \'secret\' link on the page that requests a password.', $credits[0]);
  }
    
    // @TODO Stopped writing out tests for all functions here .. there are plenty more

    public function testEpisodes_returns_nothing_for_a_film() {
      $imdb = $this->getImdb();
      $episodes = $imdb->episodes();
      $this->assertInternalType('array', $episodes);
      $this->assertEmpty($episodes);
    }
    
    public function testEpisodes_returns_episodes_for_a_multiseason_show() {
      $imdb = $this->getImdb('0306414');
      $seasons = $imdb->episodes();
      $this->assertInternalType('array', $seasons);
      $this->assertCount(5, $seasons);
      $episode1 = $seasons[1][1];
      $lastEpisode = $seasons[5][10];

      $this->assertEquals('0749451', $episode1['imdbid']);
      $this->assertEquals('The Target', $episode1['title']);
      $this->assertEquals('2 Jun. 2002', $episode1['airdate']);
      $this->assertEquals("Baltimore Det. Jimmy McNulty finds himself in hot water with his superior Major William Rawls after a drug dealer, D'Angelo Barksdale who is charged with three murders, is acquitted. McNulty knows the judge in question and although it's not his case, he's called into chambers to explain what happened. Obviously key witnesses recanted their police statements on the stand but McNulty doesn't underplay Barksdale's role in at least 7 other murders. When the judge's raises his concerns at the senior levels of the police department, they have a new investigation on their ...", $episode1['plot']);
      $this->assertEquals(1, $episode1['season']);
      $this->assertEquals(1, $episode1['episode']);

      $this->assertEquals('0977179', $lastEpisode['imdbid']);
      $this->assertEquals('-30-', $lastEpisode['title']);
      $this->assertEquals('9 Mar. 2008', $lastEpisode['airdate']);
      $this->assertEquals("Carcetti maps out a damage-control scenario with the police brass in the wake of a startling revelation from Pearlman and Daniels. Their choice: clean up the mess...or hide the dirt.", $lastEpisode['plot']);
      $this->assertEquals(5, $lastEpisode['season']);
      $this->assertEquals(10, $lastEpisode['episode']);
    }

    public function testEpisodes_returns_episodes_for_a_multiseason_show_with_missing_airdates() {
      $imdb = $this->getImdb('1027544');
      $seasons = $imdb->episodes();
      $this->assertInternalType('array', $seasons);
      $this->assertCount(3, $seasons);
      $episode = $seasons[1][20];

      $this->assertEquals('1956132', $episode['imdbid']);
      $this->assertEquals("Mama Mia", $episode['title']);
      $this->assertEquals('', $episode['airdate']);
      $this->assertEquals("", $episode['plot']);
      $this->assertEquals(1, $episode['season']);
      $this->assertEquals(20, $episode['episode']);
    }

    public function testEpisodes_returns_episodes_for_a_multiseason_show_with_empty_plots() {
      $imdb = $this->getImdb('1027544');
      $seasons = $imdb->episodes();
      $this->assertInternalType('array', $seasons);
      $this->assertCount(3, $seasons);
      $episode = $seasons[1][2];

      $this->assertEquals('1878585', $episode['imdbid']);
      $this->assertEquals("Roary Slips Up", $episode['title']);
      $this->assertEquals('2007', $episode['airdate']);
      $this->assertEquals("", $episode['plot']);
      $this->assertEquals(1, $episode['season']);
      $this->assertEquals(2, $episode['episode']);
    }

    // @TODO should it? this alters the imdb object to be the show rather than the episode .. could mess someone up
    public function testEpisodes_works_for_an_episode() {

    }

    public function testGoofs() {
      $imdb = $this->getImdb();

      $goofs = $imdb->goofs();
      $this->assertInternalType('array', $goofs);
      $this->assertGreaterThan(103, count($goofs));
      $this->assertLessThan(130, count($goofs));

      $this->assertEquals('Audio/visual unsynchronised', $goofs[0]['type']);
      $this->assertEquals('When Neo meets Trinity for the first time in the nightclub she is close to him talking in his ear. Even though she pauses between sentences the shot from the back of Trinity shows that her jaw is still moving during the pauses.', $goofs[0]['content']);

      $this->assertEquals('Character error', $goofs[2]['type']);
      $this->assertEquals("The doorknob at the Oracle's apartment is installed backwards. The screws are on the outside of the door, allowing a passer-by to take off the plate and remove the doorknob. Normally the screws would be on the inside to prevent this.", $goofs[2]['content']);

      $this->assertEquals('Character error', $goofs[3]['type']);
      $this->assertEquals("The streets all have Chicago street names (as observed in Trivia section), including Balbo Avenue. This street name is spelled correctly on signs in the subway station where Neo fights Agent Smith, but Tank directs Trinity and Neo to go to &quot;Balboa&quot; (as in <a href=\"http://www.imdb.com/title/tt0075148/\">Rocky</a>). The DVD captions of Tank's dialogue also show it as &quot;Balboa.&quot;", $goofs[3]['content']);

      // This fails all the time. Pick a better film for this?
//      $this->assertEquals('Revealing mistakes', $goofs[102]['type']);
//      $this->assertEquals("When Neo is being run through the agent training program with the woman in the red dress, Morpheus' sunglasses reflect Neo with a Desert Eagle pistol being held up by an Agent standing in an empty sound stage, not the busy city they're supposed to be in.", $goofs[102]['content']);
    }

    public function testQuotes() {
      $imdb = $this->getImdb();
      $quotes = $imdb->quotes();

      $this->assertGreaterThan(100, count($quotes));
    }

    public function testTrailers_all() {
      $imdb = $this->getImdb(2395427);
      $trailers = $imdb->trailers(true);

      $this->assertCount(6, $trailers);

      $this->assertEquals(array(
        "title" => "New Trailer",
        "url" => "http://www.imdb.com/video/imdb/vi1071951385",
        "resolution" => "HD",
        "lang" => "",
        "restful_url" => ""
      ), $trailers[0]);

      $this->assertEquals(array(
        "title" => "TV Spot #1",
        "url" => "http://www.imdb.com/video/imdb/vi1077521945",
        "resolution" => "SD",
        "lang" => "",
        "restful_url" => ""
      ), $trailers[1]);
    }

    public function testTrailers_urlonly() {
      $imdb = $this->getImdb(2395427);
      $trailers = $imdb->trailers(false);

      $this->assertCount(6, $trailers);

      $this->assertEquals("http://www.imdb.com/video/imdb/vi1071951385", $trailers[0]);
      $this->assertEquals("http://www.imdb.com/video/imdb/vi1077521945", $trailers[1]);
    }

    public function testTrailers_no_trailers() {
      $imdb = $this->getImdb(1027544);
      $trailers = $imdb->trailers();

      $this->assertCount(0, $trailers);
    }

    public function testSoundtrack_nosoundtracks() {
        $imdb = $this->getImdb('1899250');
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

    public function test_locations() {
      $imdb = $this->getImdb(107290);
      $locations = $imdb->locations();
      $this->assertCount(17, $locations);
      $this->assertEquals('Kualoa Ranch - 49560 Kamehameha Highway, Ka`a`awa, O\'ahu, Hawaii, USA', $locations[3]);
    }

    public function test_title_redirects_are_followed() {
        $imdb = $this->getImdb('2768262');
        $this->assertEquals('The Battle of the Sexes', $imdb->title());
    }

    public function testAwards_correctly_parses_an_entry_with_expandable_note() {
      $imdb = $this->getImdb('0306414');
      $awards = $imdb->awards();

      $award = $awards['AFI Awards, USA'];
      $firstEntry = $award['entries'][0];

      $this->assertEquals(2009, $firstEntry['year']);
      $this->assertEquals(true, $firstEntry['won']);
      $this->assertEquals('TV Program of the Year', $firstEntry['category']);
      $this->assertEquals('AFI Award', $firstEntry['award']);
      $this->assertCount(0, $firstEntry['people']);
      $this->assertEquals('Won', $firstEntry['outcome']);
    }

    public function testAwards_correctly_parses_an_entry_with_no_category_with_a_following_entry() {
      $imdb = $this->getImdb('0306414');
      $awards = $imdb->awards();

      $award = $awards['Television Critics Association Awards'];
      $firstEntry = $award['entries'][0];

      $this->assertEquals(2008, $firstEntry['year']);
      $this->assertEquals(true, $firstEntry['won']);
      $this->assertEquals('', $firstEntry['category']);
      $this->assertEquals('Heritage Award', $firstEntry['award']);
      $this->assertCount(0, $firstEntry['people']);
      $this->assertEquals('Won', $firstEntry['outcome']);
    }

    public function testAwards_correctly_parses_a_single_entry_award_with_one_person() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $ifmca = $awards['International Film Music Critics Award (IFMCA)'];
      $firstEntry = $ifmca['entries'][0];

      $this->assertEquals(1999, $firstEntry['year']);
      $this->assertEquals(false, $firstEntry['won']);
      $this->assertEquals('Film Score of the Year', $firstEntry['category']);
      $this->assertEquals('FMCJ Award', $firstEntry['award']);
      $this->assertCount(1, $firstEntry['people']);
      $this->assertEquals('Don Davis', $firstEntry['people']['0204485']);
      $this->assertEquals('Nominated', $firstEntry['outcome']);
    }

    public function testAwards_correctly_parses_a_single_entry_award_with_two_people() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $this->assertCount(37, $awards);

      $scifiWritersAward = $awards['Science Fiction and Fantasy Writers of America'];
      $firstEntry = $scifiWritersAward['entries'][0];

      $this->assertEquals(2000, $firstEntry['year']);
      $this->assertEquals(false, $firstEntry['won']);
      $this->assertEquals('Best Script', $firstEntry['category']);
      $this->assertEquals('Nebula Award', $firstEntry['award']);
      $this->assertCount(2, $firstEntry['people']);
      $this->assertEquals('Lana Wachowski', $firstEntry['people']['0905154']);
      $this->assertEquals('Lilly Wachowski', $firstEntry['people']['0905152']);
      $this->assertEquals('Nominated', $firstEntry['outcome']);
    }

    public function testAwards_correctly_parses_a_multi_entry_award() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $award = $awards['Online Film & Television Association'];

      $this->assertCount(5, $award['entries']);

      $firstEntry = $award['entries'][0];

      $this->assertEquals(2000, $firstEntry['year']);
      $this->assertEquals(true, $firstEntry['won']);
      $this->assertEquals('Best Sound Mixing', $firstEntry['category']);
      $this->assertEquals('OFTA Film Award', $firstEntry['award']);
      $this->assertCount(4, $firstEntry['people']);
      $this->assertEquals('John T. Reitz', $firstEntry['people']['0718676']);
      $this->assertEquals('Gregg Rudloff', $firstEntry['people']['0748832']);
      $this->assertEquals('David E. Campbell', $firstEntry['people']['0132372']);
      $this->assertEquals('David Lee Fein', $firstEntry['people']['0270646']);
      $this->assertEquals('Won', $firstEntry['outcome']);

      $secondEntry = $award['entries'][1];

      $this->assertEquals(2000, $secondEntry['year']);
      $this->assertEquals(true, $secondEntry['won']);
      $this->assertEquals('Best Visual Effects', $secondEntry['category']);
      $this->assertEquals('OFTA Film Award', $secondEntry['award']);
      $this->assertCount(4, $secondEntry['people']);
      $this->assertEquals('John Gaeta', $secondEntry['people']['0300665']);
      $this->assertEquals('Janek Sirrs', $secondEntry['people']['0802938']);
      $this->assertEquals('Steve Courtley', $secondEntry['people']['0183871']);
      $this->assertEquals('Jon Thum', $secondEntry['people']['0862039']);
      $this->assertEquals('Won', $secondEntry['outcome']);
    }

    public function testAwards_correctly_parses_an_entry_with_no_people() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $award = $awards['Online Film & Television Association'];

      $this->assertCount(5, $award['entries']);

      $fifthEntry = $award['entries'][4];

      $this->assertEquals(2000, $fifthEntry['year']);
      $this->assertEquals(false, $fifthEntry['won']);
      $this->assertEquals('Best Official Film Website', $fifthEntry['category']);
      $this->assertEquals('OFTA Film Award', $fifthEntry['award']);
      $this->assertCount(0, $fifthEntry['people']);
      $this->assertEquals('Nominated', $fifthEntry['outcome']);
    }

    public function testAwards_correctly_parses_an_entry_with_no_category_or_people() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $award = $awards['National Film Preservation Board, USA'];

      $this->assertCount(1, $award['entries']);

      $firstEntry = $award['entries'][0];

      $this->assertEquals(2012, $firstEntry['year']);
      $this->assertEquals(true, $firstEntry['won']);
      $this->assertEquals('', $firstEntry['category']);
      $this->assertEquals('National Film Registry', $firstEntry['award']);
      $this->assertCount(0, $firstEntry['people']);
      $this->assertEquals('Won', $firstEntry['outcome']);
    }

    public function testAwards_correctly_parses_an_entry_where_people_have_role_descriptions() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $award = $awards['Motion Picture Sound Editors, USA'];

      $this->assertCount(3, $award['entries']);

      $thirdEntry = $award['entries'][2];

      $this->assertEquals(2000, $thirdEntry['year']);
      $this->assertEquals(false, $thirdEntry['won']);
      $this->assertEquals('Best Sound Editing - Music (Foreign & Domestic)', $thirdEntry['category']);
      $this->assertEquals('Golden Reel Award', $thirdEntry['award']);
      $this->assertCount(3, $thirdEntry['people']);
      $this->assertEquals('Lori L. Eschler', $thirdEntry['people']['0002669']);
      $this->assertEquals('Zigmund Gron', $thirdEntry['people']['0343065']);
      $this->assertEquals('Jordan Corngold', $thirdEntry['people']['0180383']);
      $this->assertEquals('Nominated', $thirdEntry['outcome']);
    }

    public function testAwards_correctly_parses_an_entry_with_no_category_name() {
      $imdb = $this->getImdb();
      $awards = $imdb->awards();

      $award = $awards['BMI Film & TV Awards'];

      $this->assertCount(1, $award['entries']);

      $firstEntry = $award['entries'][0];

      $this->assertEquals(1999, $firstEntry['year']);
      $this->assertEquals(true, $firstEntry['won']);
      $this->assertEquals('', $firstEntry['category']);
      $this->assertEquals('BMI Film Music Award', $firstEntry['award']);
      $this->assertCount(1, $firstEntry['people']);
      $this->assertEquals('Don Davis', $firstEntry['people']['0204485']);
      $this->assertEquals('Won', $firstEntry['outcome']);
    }

  public function test_budget() {
    $budget = $this->getImdb();
    $this->assertEquals(63000000, $budget->budget());
  }

  public function test_openingWeekend_multiple() {
    $budget = $this->getImdb();
    $openingWeekend = $budget->openingWeekend();
    $this->assertInternalType('array', $openingWeekend);

    $firstItem = $openingWeekend[0];
    $this->assertEquals('$27,788,331', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-04-04', $firstItem['date']);
    $this->assertEquals(2849, $firstItem['nbScreens']);

    $secondItem = $openingWeekend[1];
    $this->assertEquals('&#163;3,384,948', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-06-13', $secondItem['date']);
    $this->assertEquals(361, $secondItem['nbScreens']);
  }

  public function test_gross_multiple() {
    $budget = $this->getImdb();
    $gross = $budget->gross();
    $this->assertInternalType('array', $gross);

    $firstItem = $gross[0];
    $this->assertEquals('$171,479,930', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-09-26', $firstItem['date']);

    $secondItem = $gross[26];
    $this->assertEquals('&#163;16,918,842', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-08-29', $secondItem['date']);
  }

  public function test_gross_no_year() {
    $budget = $this->getImdb('0058150');
    $gross = $budget->gross();
    $this->assertInternalType('array', $gross);

    $firstItem = $gross[0];
    $this->assertEquals('$51,081,062', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals(null, $firstItem['date']);

    $secondItem = $gross[1];
    $this->assertEquals('$73,800,000', $secondItem['value']);
    $this->assertEquals('Worldwide', $secondItem['country']);
    $this->assertEquals(null, $secondItem['date']);
  }

  public function test_weekendGross_multiple() {
    $budget = $this->getImdb();
    $weekendGross = $budget->weekendGross();
    $this->assertInternalType('array', $weekendGross);

    $firstItem = $weekendGross[0];
    $this->assertEquals('$1,011,566', $firstItem['value']);
    $this->assertEquals('USA', $firstItem['country']);
    $this->assertEquals('1999-06-27', $firstItem['date']);
    $this->assertEquals(1139, $firstItem['nbScreens']);

    $secondItem = $weekendGross[13];
    $this->assertEquals('&#163;63,166', $secondItem['value']);
    $this->assertEquals('UK', $secondItem['country']);
    $this->assertEquals('1999-08-29', $secondItem['date']);
    $this->assertEquals(87, $secondItem['nbScreens']);
  }

  public function test_admissions_multiple() {
    $budget = $this->getImdb();
    $admissions = $budget->admissions();
    $this->assertInternalType('array', $admissions);

    $firstItem = $admissions[0];
    $this->assertEquals(178659, $firstItem['value']);
    $this->assertEquals('Germany', $firstItem['country']);
    $this->assertEquals('2003-05-25', $firstItem['date']);

    $secondItem = $admissions[1];
    $this->assertEquals(3194163, $secondItem['value']);
    $this->assertEquals('Germany', $secondItem['country']);
    $this->assertEquals('1999-07-18', $secondItem['date']);
  }

  public function test_filmingDates() {
    $budget = $this->getImdb();

    $filmingDates = $budget->filmingDates();
    $this->assertInternalType('array', $filmingDates);
    $this->assertEquals('1998-03-14', $filmingDates['beginning']);
    $this->assertEquals('1998-09-01', $filmingDates['end']);
  }

  public function test_videosites() {
    $imdb = $this->getImdb();
    $videoSites = $imdb->videosites();

    $this->assertInternalType('array', $videoSites);
    $this->assertGreaterThan(2, $videoSites);
  }

  public function test_alternateversions() {
    $imdb = $this->getImdb();
    $alternateVersions = $imdb->alternateVersions();

    $this->assertGreaterThan(7, count($alternateVersions));
    $this->assertLessThan(12, count($alternateVersions));

    $this->assertEquals($alternateVersions[0], "Because 'The Matrix' was filmed in Australia the Region 4 (Australia) DVD release includes a more comprehensive Australian based list of credits.");

    foreach ($alternateVersions as $alternateVersion) {
      $this->assertNotEmpty($alternateVersion);
    }
  }

  public function test_alternateversions_no_alternate_versions() {
    $imdb = $this->getImdb('0056592');
    $alternateVersions = $imdb->alternateVersions();

    $this->assertCount(0, $alternateVersions);
  }

    /**
     * Create an imdb object that uses cached pages
     * The matrix by default
     * @return \Imdb\Title
     */
    protected function getImdb($imdbId = '0133093') {
        $config = new \Imdb\Config();
        $config->language = 'En';
        $config->cachedir = realpath(dirname(__FILE__).'/cache') . '/';
        $config->usezip = false;
        $config->cache_expire = 3600;
        $config->debug = false;
        $imdb = new \Imdb\Title($imdbId, $config);
        return $imdb;
    }
}