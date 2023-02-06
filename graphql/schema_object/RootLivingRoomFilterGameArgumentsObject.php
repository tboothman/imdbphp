<?php

namespace GraphQL\SchemaObject;

class RootLivingRoomFilterGameArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(LivingRoomFilterGameInputInputObject $livingRoomFilterGameInputInputObject)
    {
        $this->input = $livingRoomFilterGameInputInputObject;

        return $this;
    }
}
