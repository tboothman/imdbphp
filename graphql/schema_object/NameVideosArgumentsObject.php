<?php

namespace GraphQL\SchemaObject;

class NameVideosArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $first;

    public function setFilter(VideosQueryFilterInputObject $videosQueryFilterInputObject)
    {
        $this->filter = $videosQueryFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
