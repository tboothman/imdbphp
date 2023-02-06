<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataCreditTypesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(SelfVerifiedNameCreditTypeFilterInputObject $selfVerifiedNameCreditTypeFilterInputObject)
    {
        $this->filter = $selfVerifiedNameCreditTypeFilterInputObject;

        return $this;
    }
}
