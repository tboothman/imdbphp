<?php

namespace GraphQL\SchemaObject;

class EpisodesFilterInputObject extends InputObject
{
    protected $excludeSeasons;
    protected $includeSeasons;
    protected $releasedOnOrAfter;
    protected $releasedOnOrBefore;
    protected $unknownReleaseDate;

    public function setExcludeSeasons(array $excludeSeasons)
    {
        $this->excludeSeasons = $excludeSeasons;

        return $this;
    }

    public function setIncludeSeasons(array $includeSeasons)
    {
        $this->includeSeasons = $includeSeasons;

        return $this;
    }

    public function setReleasedOnOrAfter(EpisodeReleaseDateInputObject $episodeReleaseDateInputObject)
    {
        $this->releasedOnOrAfter = $episodeReleaseDateInputObject;

        return $this;
    }

    public function setReleasedOnOrBefore(EpisodeReleaseDateInputObject $episodeReleaseDateInputObject)
    {
        $this->releasedOnOrBefore = $episodeReleaseDateInputObject;

        return $this;
    }

    public function setUnknownReleaseDate($unknownReleaseDate)
    {
        $this->unknownReleaseDate = $unknownReleaseDate;

        return $this;
    }
}
