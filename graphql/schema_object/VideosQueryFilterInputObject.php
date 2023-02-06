<?php

namespace GraphQL\SchemaObject;

class VideosQueryFilterInputObject extends InputObject
{
    protected $maturityLevel;

    public function setMaturityLevel($maturityLevel)
    {
        $this->maturityLevel = $maturityLevel;

        return $this;
    }
}
