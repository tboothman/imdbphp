<?php

namespace GraphQL\SchemaObject;

class RootRecentVideosArgumentsObject extends ArgumentsObject
{
    protected $limit;
    protected $paginationToken;
    protected $queryFilter;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function setPaginationToken($paginationToken)
    {
        $this->paginationToken = $paginationToken;

        return $this;
    }

    public function setQueryFilter(RecentVideosQueryFilterInputObject $recentVideosQueryFilterInputObject)
    {
        $this->queryFilter = $recentVideosQueryFilterInputObject;

        return $this;
    }
}
