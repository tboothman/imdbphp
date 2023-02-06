<?php

namespace GraphQL\SchemaObject;

class TitleCompanyCreditCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(CompanyCreditsFilterInputObject $companyCreditsFilterInputObject)
    {
        $this->filter = $companyCreditsFilterInputObject;

        return $this;
    }
}
