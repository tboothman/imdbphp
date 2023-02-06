<?php

namespace GraphQL\SchemaObject;

class LivingRoomPassportResultsQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomPassportResults";

    public function selectLists(LivingRoomPassportResultsListsArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomPassportListConnectionQueryObject("lists");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
