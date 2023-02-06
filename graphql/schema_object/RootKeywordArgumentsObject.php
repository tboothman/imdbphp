<?php

namespace GraphQL\SchemaObject;

class RootKeywordArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
