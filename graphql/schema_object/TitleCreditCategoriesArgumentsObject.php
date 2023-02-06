<?php

namespace GraphQL\SchemaObject;

class TitleCreditCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(TitleCreditCategoryWithCreditsFilterInputObject $titleCreditCategoryWithCreditsFilterInputObject)
    {
        $this->filter = $titleCreditCategoryWithCreditsFilterInputObject;

        return $this;
    }
}
