<?php

namespace GraphQL\SchemaObject;

class NameManagedDataAutomaticFeaturedImagesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
