<?php

namespace GraphQL\SchemaObject;

class RootCompanyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
