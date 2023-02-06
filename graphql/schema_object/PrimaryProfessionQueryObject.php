<?php

namespace GraphQL\SchemaObject;

class PrimaryProfessionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrimaryProfession";

    public function selectCategory(PrimaryProfessionCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProfession(PrimaryProfessionProfessionArgumentsObject $argsObject = null)
    {
        $object = new ProfessionQueryObject("profession");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
