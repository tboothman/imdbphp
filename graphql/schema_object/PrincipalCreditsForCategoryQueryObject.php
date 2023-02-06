<?php

namespace GraphQL\SchemaObject;

class PrincipalCreditsForCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrincipalCreditsForCategory";

    public function selectCategory(PrincipalCreditsForCategoryCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(PrincipalCreditsForCategoryRestrictionArgumentsObject $argsObject = null)
    {
        $object = new CreditRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalCredits()
    {
        $this->selectField("totalCredits");

        return $this;
    }
}
