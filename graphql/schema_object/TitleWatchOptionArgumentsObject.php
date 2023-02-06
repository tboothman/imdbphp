<?php

namespace GraphQL\SchemaObject;

class TitleWatchOptionArgumentsObject extends ArgumentsObject
{
    protected $location;
    protected $providerId;

    public function setLocation(WatchOptionsLocationInputObject $watchOptionsLocationInputObject)
    {
        $this->location = $watchOptionsLocationInputObject;

        return $this;
    }

    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;

        return $this;
    }
}
