<?php

namespace GraphQL\SchemaObject;

class VideoTimedTextTracksArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(VideoTimedTextTracksFilterInputObject $videoTimedTextTracksFilterInputObject)
    {
        $this->filter = $videoTimedTextTracksFilterInputObject;

        return $this;
    }
}
