<?php

namespace GraphQL\SchemaObject;

class VideoRelatedVideosArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
