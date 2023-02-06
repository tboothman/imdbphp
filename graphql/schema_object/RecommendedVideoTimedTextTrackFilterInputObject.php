<?php

namespace GraphQL\SchemaObject;

class RecommendedVideoTimedTextTrackFilterInputObject extends InputObject
{
    protected $format;
    protected $language;

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }
}
