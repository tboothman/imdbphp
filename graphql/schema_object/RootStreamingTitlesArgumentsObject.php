<?php

namespace GraphQL\SchemaObject;

class RootStreamingTitlesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(StreamingTitlesFilterInputObject $streamingTitlesFilterInputObject)
    {
        $this->filter = $streamingTitlesFilterInputObject;

        return $this;
    }
}
