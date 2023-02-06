<?php

namespace GraphQL\SchemaObject;

class GoofCategoryWithGoofsGoofsArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $first;

    public function setFilter(GoofCategoryWithGoofsFilterInputObject $goofCategoryWithGoofsFilterInputObject)
    {
        $this->filter = $goofCategoryWithGoofsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
