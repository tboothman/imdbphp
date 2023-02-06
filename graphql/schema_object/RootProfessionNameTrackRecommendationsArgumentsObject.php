<?php

namespace GraphQL\SchemaObject;

class RootProfessionNameTrackRecommendationsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $input;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setInput(TrackRecommendationsInputInputObject $trackRecommendationsInputInputObject)
    {
        $this->input = $trackRecommendationsInputInputObject;

        return $this;
    }
}
