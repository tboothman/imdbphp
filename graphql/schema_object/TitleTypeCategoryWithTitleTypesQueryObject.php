<?php

namespace GraphQL\SchemaObject;

class TitleTypeCategoryWithTitleTypesQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTypeCategoryWithTitleTypes";

    public function selectCategory(TitleTypeCategoryWithTitleTypesCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypes(TitleTypeCategoryWithTitleTypesTitleTypesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeQueryObject("titleTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
