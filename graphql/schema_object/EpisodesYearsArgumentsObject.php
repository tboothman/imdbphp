<?php

namespace GraphQL\SchemaObject;

class EpisodesYearsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}