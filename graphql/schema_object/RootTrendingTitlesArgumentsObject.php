<?php

namespace GraphQL\SchemaObject;

class RootTrendingTitlesArgumentsObject extends ArgumentsObject
{
    protected $limit;
    protected $paginationToken;

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
}
