<?php

namespace GraphQL\SchemaObject;

class TrendingNameCollectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingNameCollection";

    public function selectItems(TrendingNameCollectionItemsArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameConnectionQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOption(TrendingNameCollectionOptionArgumentsObject $argsObject = null)
    {
        $object = new TrendingCollectionOptionQueryObject("option");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
