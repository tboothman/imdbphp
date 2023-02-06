<?php

namespace GraphQL\SchemaObject;

class RootPersistentLivingRoomGameArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(PersistentLivingRoomGameInputInputObject $persistentLivingRoomGameInputInputObject)
    {
        $this->input = $persistentLivingRoomGameInputInputObject;

        return $this;
    }
}
