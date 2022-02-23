<?php

use Imdb\Calendar;

class CalendarTest extends PHPUnit\Framework\TestCase
{
    public function test_getUpcomingReleases()
    {
        $cal = $this->getCalendar();
        $calendar = $cal->upcomingReleases("GB");
        $this->assertIsArray($calendar);
        $this->assertTrue(count($calendar) >= 1);
        $this->assertTrue(count($calendar[0]) >= 1);
        $this->assertTrue($calendar[0]['date']) != "");
        $this->assertTrue($calendar[0]['title']) != "");
        $this->assertTrue(is_numeric($calendar[0]['year']));
        $this->assertTrue(is_numeric($calendar[0]['imdb']));
    }

    protected function getCalendar()
    {
        $config = new \Imdb\Config();
        $config->language = 'en-GB';
        $config->imdbsite = 'www.imdb.com';
        $config->cachedir = realpath(dirname(__FILE__) . '/cache') . '/';
        $config->usezip = false;
        $config->cache_expire = 3600;

        return new Calendar($config);
    }
}
