<?php

namespace GraphQL\SchemaObject;

class GoofsFilterInputObject extends InputObject
{
    protected $categories;
    protected $excludeCategories;
    protected $spoilers;

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

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
