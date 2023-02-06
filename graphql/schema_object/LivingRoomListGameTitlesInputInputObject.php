<?php

namespace GraphQL\SchemaObject;

class LivingRoomListGameTitlesInputInputObject extends InputObject
{
    protected $after;
    protected $first;
    protected $gameTypeId;
    protected $id;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setGameTypeId($gameTypeId)
    {
        $this->gameTypeId = $gameTypeId;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
