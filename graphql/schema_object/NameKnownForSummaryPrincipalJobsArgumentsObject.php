<?php

namespace GraphQL\SchemaObject;

class NameKnownForSummaryPrincipalJobsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
