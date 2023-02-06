<?php

namespace GraphQL\SchemaObject;

class ParentsGuideCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(ParentsGuideCategoryFilterInputObject $parentsGuideCategoryFilterInputObject)
    {
        $this->filter = $parentsGuideCategoryFilterInputObject;

        return $this;
    }
}
