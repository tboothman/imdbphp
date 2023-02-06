<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawGameListTitlesArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
