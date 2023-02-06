<?php

namespace GraphQL\SchemaObject;

class TrendingTitleCollectionOptionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingTitleCollectionOptions";

    public function selectOptions(TrendingTitleCollectionOptionsOptionsArgumentsObject $argsObject = null)
    {
        $object = new TrendingCollectionOptionQueryObject("options");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelectedItem(TrendingTitleCollectionOptionsSelectedItemArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleCollectionQueryObject("selectedItem");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
