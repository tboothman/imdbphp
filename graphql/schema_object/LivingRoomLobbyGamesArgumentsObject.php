<?php

namespace GraphQL\SchemaObject;

class LivingRoomLobbyGamesArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $state;

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

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
