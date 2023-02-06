<?php

namespace GraphQL\SchemaObject;

class RecentlyViewedItemUnionObject extends UnionObject
{
    public function onName()
    {
        $object = new NameQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onTitle()
    {
        $object = new TitleQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
