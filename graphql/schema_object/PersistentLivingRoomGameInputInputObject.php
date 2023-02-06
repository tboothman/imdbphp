<?php

namespace GraphQL\SchemaObject;

class PersistentLivingRoomGameInputInputObject extends InputObject
{
    protected $gameTypeId;

    public function setGameTypeId($gameTypeId)
    {
        $this->gameTypeId = $gameTypeId;

        return $this;
    }
}
