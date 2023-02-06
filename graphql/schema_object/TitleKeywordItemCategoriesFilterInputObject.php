<?php

namespace GraphQL\SchemaObject;

class TitleKeywordItemCategoriesFilterInputObject extends InputObject
{
    protected $excludeItemCategories;
    protected $itemCategories;

    public function setExcludeItemCategories(array $excludeItemCategories)
    {
        $this->excludeItemCategories = $excludeItemCategories;

        return $this;
    }

    public function setItemCategories(array $itemCategories)
    {
        $this->itemCategories = $itemCategories;

        return $this;
    }
}
