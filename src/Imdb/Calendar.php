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
# IMDBPHP UPCOMMING RELEASES (based on IMDBPHP TOP CHARTS (c)Ricardo Silva) #
# written/modified/extended by Ed (github user: duck7000)                   #
# ------------------------------------------------------------------------- #
# This program is free software; you can redistribute and/or modify it      #
# under the terms of the GNU General Public License (see doc/LICENSE)       #
#############################################################################

namespace Imdb;

/**
 * Obtains information about upcoming movie releases as seen on IMDb
 * https://www.imdb.com/calendar
 * @author Ricardo Silva (banzap) <banzap@gmail.com>
 * @author Ed (github user: duck7000)
 */
class Calendar extends MdbBase
{

    /**
     * Get upcoming movie releases as seen on IMDb
     * @return array (array[string date, array releases] of arrays[title,year,imdbid])
     * @parameter $country, This defines wich country list is returned
     * for example DE, NL, US as they appear on https://www.imdb.com/calendar
     */
    public function upcomingReleases($country)
    {
        $page = $this->getXpathPage($country);
        $calendar = array();
        $dates = $page->query("//*[@id='main']/h4");
        foreach ($dates as $key => $date) {
            $key++;
            $titlesRaw = $page->query("//*[@id='main']/ul[$key]//li");
            $titles = array();
            foreach ($titlesRaw as $value) {
                $href = $value->getElementsByTagName('a')->item(0)->getAttribute('href');
                preg_match('!.*?/title/tt(\d+)/.*!', $href, $imdbid);
                $title = trim($value->getElementsByTagName('a')->item(0)->nodeValue);
                preg_match('#\((.*?)\)#', $value->nodeValue, $year);
                $titles[] = array(
                    'title' => $title,
                    'year' => $year[1],
                    'imdbid' => $imdbid[1]
                );
            }
            $calendar[] = array(
                'date' => trim($date->nodeValue),
                'releases' => $titles
            );
        }
        return $calendar;
    }

    protected function buildUrl($context = null)
    {
        return "https://" . $this->config->imdbsite . "/calendar/?region=$context";
    }
}
