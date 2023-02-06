<?php

namespace GraphQL\SchemaObject;

class TitleCreditCategoryWithCreditsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleCreditCategoryWithCredits";

    public function selectCategory(TitleCreditCategoryWithCreditsCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredits(TitleCreditCategoryWithCreditsCreditsArgumentsObject $argsObject = null)
    {
        $object = new CreditConnectionQueryObject("credits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
