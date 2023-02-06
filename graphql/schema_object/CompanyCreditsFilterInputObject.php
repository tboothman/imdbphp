<?php

namespace GraphQL\SchemaObject;

class CompanyCreditsFilterInputObject extends InputObject
{
    protected $categories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}
