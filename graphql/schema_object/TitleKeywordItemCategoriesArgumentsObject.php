<?php

namespace GraphQL\SchemaObject;

class TitleKeywordItemCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(TitleKeywordItemCategoriesFilterInputObject $titleKeywordItemCategoriesFilterInputObject)
    {
        $this->filter = $titleKeywordItemCategoriesFilterInputObject;

        return $this;
    }
}
