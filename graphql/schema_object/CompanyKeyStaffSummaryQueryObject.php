<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKeyStaffSummary";

    public function selectEmployment(CompanyKeyStaffSummaryEmploymentArgumentsObject $argsObject = null)
    {
        $object = new CompanyEmploymentQueryObject("employment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
