<?php

namespace GraphQL\SchemaObject;

class NameKnownForSummaryPrincipalCharactersArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
