<?php

namespace GraphQL\SchemaObject;

class RootListArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
