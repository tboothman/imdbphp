<?php

namespace GraphQL\SchemaObject;

class TitleTextSearchConstraintInputObject extends InputObject
{
    protected $searchTerm;

    public function setSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;

        return $this;
    }
}
