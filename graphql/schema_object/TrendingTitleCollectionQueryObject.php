<?php

namespace GraphQL\SchemaObject;

class TrendingTitleCollectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingTitleCollection";

    public function selectItems(TrendingTitleCollectionItemsArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleConnectionQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOption(TrendingTitleCollectionOptionArgumentsObject $argsObject = null)
    {
        $object = new TrendingCollectionOptionQueryObject("option");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
