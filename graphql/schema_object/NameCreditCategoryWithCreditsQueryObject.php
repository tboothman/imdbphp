<?php

namespace GraphQL\SchemaObject;

class NameCreditCategoryWithCreditsQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameCreditCategoryWithCredits";

    public function selectCategory(NameCreditCategoryWithCreditsCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredits(NameCreditCategoryWithCreditsCreditsArgumentsObject $argsObject = null)
    {
        $object = new NameCreditConnectionQueryObject("credits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
