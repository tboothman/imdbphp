<?php

namespace GraphQL\SchemaObject;

class RootBoxOfficeWeekendChartArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}