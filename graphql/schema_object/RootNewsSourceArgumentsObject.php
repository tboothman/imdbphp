<?php

namespace GraphQL\SchemaObject;

class RootNewsSourceArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
