<?php

namespace GraphQL\SchemaObject;

class ListAreElementsInListArgumentsObject extends ArgumentsObject
{
    protected $itemElementIds;

    public function setItemElementIds(array $itemElementIds)
    {
        $this->itemElementIds = $itemElementIds;

        return $this;
    }
}
