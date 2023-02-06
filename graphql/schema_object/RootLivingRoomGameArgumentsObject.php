<?php

namespace GraphQL\SchemaObject;

class RootLivingRoomGameArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
