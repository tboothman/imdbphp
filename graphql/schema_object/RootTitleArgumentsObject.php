<?php

namespace GraphQL\SchemaObject;

class RootTitleArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
