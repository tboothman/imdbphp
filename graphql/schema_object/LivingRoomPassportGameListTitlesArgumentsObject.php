<?php

namespace GraphQL\SchemaObject;

class LivingRoomPassportGameListTitlesArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}