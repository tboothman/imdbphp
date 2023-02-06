<?php

namespace GraphQL\SchemaObject;

class NameCreditCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $sort;

    public function setFilter(NameCreditCategoryFilterInputObject $nameCreditCategoryFilterInputObject)
    {
        $this->filter = $nameCreditCategoryFilterInputObject;

        return $this;
    }

    public function setSort(NameCreditSortInputObject $nameCreditSortInputObject)
    {
        $this->sort = $nameCreditSortInputObject;

        return $this;
    }
}
