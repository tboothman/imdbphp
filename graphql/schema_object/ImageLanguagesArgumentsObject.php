<?php

namespace GraphQL\SchemaObject;

class ImageLanguagesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
