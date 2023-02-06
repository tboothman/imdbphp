<?php

namespace GraphQL\SchemaObject;

class TitleWatchOptionsByCategoryArgumentsObject extends ArgumentsObject
{
    protected $limit;
    protected $location;
    protected $promotedProvider;
    protected $queryFilter;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

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

    public function setQueryFilter(WatchOptionQueryFilterInputObject $watchOptionQueryFilterInputObject)
    {
        $this->queryFilter = $watchOptionQueryFilterInputObject;

        return $this;
    }
}
