<?php

namespace GraphQL\SchemaObject;

class EpisodesEpisodesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $filter;
    protected $first;
    protected $jumpTo;
    protected $last;
    protected $sort;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFilter(EpisodesFilterInputObject $episodesFilterInputObject)
    {
        $this->filter = $episodesFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setJumpTo($jumpTo)
    {
        $this->jumpTo = $jumpTo;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }

    public function setSort(EpisodesSortInputObject $episodesSortInputObject)
    {
        $this->sort = $episodesSortInputObject;

        return $this;
    }
}
