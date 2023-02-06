<?php

namespace GraphQL\SchemaObject;

class RootImageArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
