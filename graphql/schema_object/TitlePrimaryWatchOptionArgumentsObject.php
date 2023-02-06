<?php

namespace GraphQL\SchemaObject;

class TitlePrimaryWatchOptionArgumentsObject extends ArgumentsObject
{
    protected $location;
    protected $promotedProvider;

    public function setLocation(WatchOptionsLocationInputObject $watchOptionsLocationInputObject)
    {
        $this->location = $watchOptionsLocationInputObject;

        return $this;
    }

    public function setPromotedProvider($promotedProvider)
    {
        $this->promotedProvider = $promotedProvider;

        return $this;
    }
}
