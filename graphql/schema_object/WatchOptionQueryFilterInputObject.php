<?php

namespace GraphQL\SchemaObject;

class WatchOptionQueryFilterInputObject extends InputObject
{
    protected $includeWatchOptionCategories;

    public function setIncludeWatchOptionCategories(array $includeWatchOptionCategories)
    {
        $this->includeWatchOptionCategories = $includeWatchOptionCategories;

        return $this;
    }
}
