<?php

namespace GraphQL\SchemaObject;

class SharedNamesFilterInputObject extends InputObject
{
    protected $creditCategories;

    public function setCreditCategories(array $creditCategories)
    {
        $this->creditCategories = $creditCategories;

        return $this;
    }
}
