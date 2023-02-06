<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootTopListsForItemArgumentsObject extends ArgumentsObject
{
    protected $first;
    protected $itemId;
    protected $topListType;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function setTopListType($topListType)
    {
        $this->topListType = new RawObject($topListType);

        return $this;
    }
}
