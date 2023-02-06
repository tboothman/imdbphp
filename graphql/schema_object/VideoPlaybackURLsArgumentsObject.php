<?php

namespace GraphQL\SchemaObject;

class VideoPlaybackURLsArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(VideoContentFilterInputObject $videoContentFilterInputObject)
    {
        $this->filter = $videoContentFilterInputObject;

        return $this;
    }
}
