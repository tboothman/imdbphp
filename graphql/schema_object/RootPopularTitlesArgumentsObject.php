<?php

namespace GraphQL\SchemaObject;

class RootPopularTitlesArgumentsObject extends ArgumentsObject
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

    public function setQueryFilter(PopularTitlesQueryFilterInputObject $popularTitlesQueryFilterInputObject)
    {
        $this->queryFilter = $popularTitlesQueryFilterInputObject;

        return $this;
    }
}
