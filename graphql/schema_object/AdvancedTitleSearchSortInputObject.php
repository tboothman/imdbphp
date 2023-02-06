<?php

namespace GraphQL\SchemaObject;

class AdvancedTitleSearchSortInputObject extends InputObject
{
    protected $sortBy;
    protected $sortOrder;

    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
