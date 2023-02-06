<?php

namespace GraphQL\SchemaObject;

class RootLivingRoomListGameTitlesArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(LivingRoomListGameTitlesInputInputObject $livingRoomListGameTitlesInputInputObject)
    {
        $this->input = $livingRoomListGameTitlesInputInputObject;

        return $this;
    }
}
