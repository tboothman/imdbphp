<?php

namespace GraphQL\SchemaObject;

class RootNameArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
