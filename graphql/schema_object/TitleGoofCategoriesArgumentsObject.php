<?php

namespace GraphQL\SchemaObject;

class TitleGoofCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(GoofCategoryWithGoofsFilterInputObject $goofCategoryWithGoofsFilterInputObject)
    {
        $this->filter = $goofCategoryWithGoofsFilterInputObject;

        return $this;
    }
}
