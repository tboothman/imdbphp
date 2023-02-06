<?php

namespace GraphQL\SchemaObject;

class RootImageGalleryArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
