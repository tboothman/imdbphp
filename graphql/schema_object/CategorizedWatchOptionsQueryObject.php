<?php

namespace GraphQL\SchemaObject;

class CategorizedWatchOptionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "CategorizedWatchOptions";

    public function selectCategoryName(CategorizedWatchOptionsCategoryNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("categoryName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWatchOptions(CategorizedWatchOptionsWatchOptionsArgumentsObject $argsObject = null)
    {
        $object = new WatchOptionQueryObject("watchOptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
