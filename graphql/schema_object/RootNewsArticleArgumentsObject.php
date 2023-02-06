<?php

namespace GraphQL\SchemaObject;

class RootNewsArticleArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
