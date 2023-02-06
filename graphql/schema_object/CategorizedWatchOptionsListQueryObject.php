<?php

namespace GraphQL\SchemaObject;

class CategorizedWatchOptionsListQueryObject extends QueryObject
{
    const OBJECT_NAME = "CategorizedWatchOptionsList";

    public function selectCategorizedWatchOptionsList(CategorizedWatchOptionsListCategorizedWatchOptionsListArgumentsObject $argsObject = null)
    {
        $object = new CategorizedWatchOptionsQueryObject("categorizedWatchOptionsList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
