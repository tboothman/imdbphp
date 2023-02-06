<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForJobQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForJob";

    public function selectCategory(CompanyKnownForJobCategoryArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForCreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJob(CompanyKnownForJobJobArgumentsObject $argsObject = null)
    {
        $object = new CompanyJobQueryObject("job");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
