<?php

namespace GraphQL\SchemaObject;

class WatchOptionsSearchConstraintInputObject extends InputObject
{
    protected $anyWatchProviderIds;
    protected $anyWatchRegions;
    protected $hasWatchOptionTypes;

    public function setAnyWatchProviderIds(array $anyWatchProviderIds)
    {
        $this->anyWatchProviderIds = $anyWatchProviderIds;

        return $this;
    }

    public function setAnyWatchRegions(array $anyWatchRegions)
    {
        $this->anyWatchRegions = $anyWatchRegions;

        return $this;
    }

    public function setHasWatchOptionTypes(array $hasWatchOptionTypes)
    {
        $this->hasWatchOptionTypes = $hasWatchOptionTypes;

        return $this;
    }
}
