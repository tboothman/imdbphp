<?php

namespace GraphQL\SchemaObject;

class GoofCategoryWithGoofsQueryObject extends QueryObject
{
    const OBJECT_NAME = "GoofCategoryWithGoofs";

    public function selectCategory(GoofCategoryWithGoofsCategoryArgumentsObject $argsObject = null)
    {
        $object = new GoofCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGoofs(GoofCategoryWithGoofsGoofsArgumentsObject $argsObject = null)
    {
        $object = new GoofConnectionQueryObject("goofs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
