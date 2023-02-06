<?php

namespace GraphQL\SchemaObject;

class ExternalLinksFilterInputObject extends InputObject
{
    protected $categories;
    protected $excludeCategories;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function setExcludeCategories(array $excludeCategories)
    {
        $this->excludeCategories = $excludeCategories;

        return $this;
    }
}
