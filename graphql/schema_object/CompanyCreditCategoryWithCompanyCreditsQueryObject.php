<?php

namespace GraphQL\SchemaObject;

class CompanyCreditCategoryWithCompanyCreditsQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyCreditCategoryWithCompanyCredits";

    public function selectCategory(CompanyCreditCategoryWithCompanyCreditsCategoryArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyCredits(CompanyCreditCategoryWithCompanyCreditsCompanyCreditsArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditConnectionQueryObject("companyCredits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(CompanyCreditCategoryWithCompanyCreditsRestrictionArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
