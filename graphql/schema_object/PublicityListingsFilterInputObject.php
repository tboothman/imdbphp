<?php

namespace GraphQL\SchemaObject;

class PublicityListingsFilterInputObject extends InputObject
{
    protected $categories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}
