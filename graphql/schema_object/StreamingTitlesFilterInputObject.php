<?php

namespace GraphQL\SchemaObject;

class StreamingTitlesFilterInputObject extends InputObject
{
    protected $maxProviders;
    protected $providers;

    public function setMaxProviders($maxProviders)
    {
        $this->maxProviders = $maxProviders;

        return $this;
    }

    public function setProviders(array $providers)
    {
        $this->providers = $providers;

        return $this;
    }
}
