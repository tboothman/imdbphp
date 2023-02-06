<?php

namespace GraphQL\SchemaObject;

class NameDemographicDataArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $limit;

    public function setFilter(DemographicDataFilterInputObject $demographicDataFilterInputObject)
    {
        $this->filter = $demographicDataFilterInputObject;

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
