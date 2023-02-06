<?php

namespace GraphQL\SchemaObject;

class DemographicDataFilterInputObject extends InputObject
{
    protected $excludeTypes;
    protected $includeTypes;
    protected $selfVerified;
    protected $visibility;

    public function setExcludeTypes(array $excludeTypes)
    {
        $this->excludeTypes = $excludeTypes;

        return $this;
    }

    public function setIncludeTypes(array $includeTypes)
    {
        $this->includeTypes = $includeTypes;

        return $this;
    }

    public function setSelfVerified($selfVerified)
    {
        $this->selfVerified = $selfVerified;

        return $this;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }
}
