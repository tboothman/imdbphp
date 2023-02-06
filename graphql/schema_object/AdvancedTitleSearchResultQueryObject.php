<?php

namespace GraphQL\SchemaObject;

class AdvancedTitleSearchResultQueryObject extends QueryObject
{
    const OBJECT_NAME = "AdvancedTitleSearchResult";

    public function selectTitle(AdvancedTitleSearchResultTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
