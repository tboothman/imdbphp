<?php

namespace GraphQL\SchemaObject;

class RootVideoArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
