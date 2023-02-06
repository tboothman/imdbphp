<?php

namespace GraphQL\SchemaObject;

class PersistentLivingRoomGameResultsUnionObject extends UnionObject
{
    public function onLivingRoomPassportResults()
    {
        $object = new LivingRoomPassportResultsQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onLivingRoomQuickDrawResults()
    {
        $object = new LivingRoomQuickDrawResultsQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
