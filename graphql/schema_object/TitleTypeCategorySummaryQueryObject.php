<?php

namespace GraphQL\SchemaObject;

class TitleTypeCategorySummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTypeCategorySummary";

    public function selectTitleTypeCategory(TitleTypeCategorySummaryTitleTypeCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeCategoryQueryObject("titleTypeCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
