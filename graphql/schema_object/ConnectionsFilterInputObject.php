<?php

namespace GraphQL\SchemaObject;

class ConnectionsFilterInputObject extends InputObject
{
    protected $categories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}
