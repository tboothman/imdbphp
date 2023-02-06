<?php

namespace GraphQL\SchemaObject;

class ParentsGuideCategorySummaryGuideItemsArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
