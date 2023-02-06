<?php

namespace GraphQL\SchemaObject;

class VideoTimedTextTracksFilterInputObject extends InputObject
{
    protected $format;

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }
}
