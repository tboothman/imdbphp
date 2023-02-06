<?php

namespace GraphQL\SchemaObject;

class ListItemNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListItemNode";

    public function selectDescription(ListItemNodeDescriptionArgumentsObject $argsObject = null)
    {
        $object = new ListDescriptionQueryObject("description");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectItem(ListItemNodeItemArgumentsObject $argsObject = null)
    {
        $object = new ListItemUnionObject("item");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
