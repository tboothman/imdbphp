<?php

namespace GraphQL\SchemaObject;

class GenreSearchConstraintInputObject extends InputObject
{
    protected $allGenreIds;
    protected $anyGenreIds;
    protected $excludeGenreIds;
    protected $maxRelevantGenres;

    public function setAllGenreIds(array $allGenreIds)
    {
        $this->allGenreIds = $allGenreIds;

        return $this;
    }

    public function setAnyGenreIds(array $anyGenreIds)
    {
        $this->anyGenreIds = $anyGenreIds;

        return $this;
    }

    public function setExcludeGenreIds(array $excludeGenreIds)
    {
        $this->excludeGenreIds = $excludeGenreIds;

        return $this;
    }

    public function setMaxRelevantGenres($maxRelevantGenres)
    {
        $this->maxRelevantGenres = $maxRelevantGenres;

        return $this;
    }
}
