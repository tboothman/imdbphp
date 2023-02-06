<?php

namespace GraphQL\SchemaObject;

class TrendingNameCollectionOptionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingNameCollectionOptions";

    public function selectOptions(TrendingNameCollectionOptionsOptionsArgumentsObject $argsObject = null)
    {
        $object = new TrendingCollectionOptionQueryObject("options");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelectedItem(TrendingNameCollectionOptionsSelectedItemArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameCollectionQueryObject("selectedItem");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
