<?php

namespace GraphQL\SchemaObject;

class ImageTitlesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
