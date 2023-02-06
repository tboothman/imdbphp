<?php

namespace GraphQL\SchemaObject;

class PrincipalCreditsFilterInputObject extends InputObject
{
    protected $categories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}
