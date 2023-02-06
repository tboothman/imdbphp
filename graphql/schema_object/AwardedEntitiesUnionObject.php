<?php

namespace GraphQL\SchemaObject;

class AwardedEntitiesUnionObject extends UnionObject
{
    public function onAwardedNames()
    {
        $object = new AwardedNamesQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onAwardedTitles()
    {
        $object = new AwardedTitlesQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
