<?php

namespace GraphQL\SchemaObject;

class ConnectionCategoryWithConnectionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ConnectionCategoryWithConnections";

    public function selectCategory(ConnectionCategoryWithConnectionsCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConnections(ConnectionCategoryWithConnectionsConnectionsArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionConnectionQueryObject("connections");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
