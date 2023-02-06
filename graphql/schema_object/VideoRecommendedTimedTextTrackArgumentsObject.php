<?php

namespace GraphQL\SchemaObject;

class VideoRecommendedTimedTextTrackArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(RecommendedVideoTimedTextTrackFilterInputObject $recommendedVideoTimedTextTrackFilterInputObject)
    {
        $this->filter = $recommendedVideoTimedTextTrackFilterInputObject;

        return $this;
    }
}
