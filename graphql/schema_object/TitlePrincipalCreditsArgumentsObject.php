<?php

namespace GraphQL\SchemaObject;

class TitlePrincipalCreditsArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(PrincipalCreditsFilterInputObject $principalCreditsFilterInputObject)
    {
        $this->filter = $principalCreditsFilterInputObject;

        return $this;
    }
}
