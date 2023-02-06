<?php

namespace GraphQL\SchemaObject;

class LivingRoomFilterGameResultsUnionObject extends UnionObject
{
    public function onLivingRoomCustomWidgetResults()
    {
        $object = new LivingRoomCustomWidgetResultsQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onLivingRoomTimeMachineResults()
    {
        $object = new LivingRoomTimeMachineResultsQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
