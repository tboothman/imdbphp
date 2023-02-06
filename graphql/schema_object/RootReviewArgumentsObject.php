<?php

namespace GraphQL\SchemaObject;

class RootReviewArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
