<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientSummaryRepresentationArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
