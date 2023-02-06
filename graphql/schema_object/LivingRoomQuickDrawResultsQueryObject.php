<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawResultsQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomQuickDrawResults";

    public function selectLists(LivingRoomQuickDrawResultsListsArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomQuickDrawListConnectionQueryObject("lists");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
