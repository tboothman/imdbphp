<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKeyStaff";

    public function selectName(CompanyKeyStaffNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSummary(CompanyKeyStaffSummaryArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
