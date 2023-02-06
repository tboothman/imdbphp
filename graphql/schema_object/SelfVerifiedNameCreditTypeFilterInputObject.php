<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditTypeFilterInputObject extends InputObject
{
    protected $excludeTypes;
    protected $includeTypes;

    public function setExcludeTypes(array $excludeTypes)
    {
        $this->excludeTypes = $excludeTypes;

        return $this;
    }

    public function setIncludeTypes(array $includeTypes)
    {
        $this->includeTypes = $includeTypes;

        return $this;
    }
}
