<?php

namespace GraphQL\SchemaObject;

class KeywordMetadataKeywordCategoriesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
