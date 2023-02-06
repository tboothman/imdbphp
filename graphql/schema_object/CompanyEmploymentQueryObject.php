<?php

namespace GraphQL\SchemaObject;

class CompanyEmploymentQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyEmployment";

    public function selectBranch(CompanyEmploymentBranchArgumentsObject $argsObject = null)
    {
        $object = new EmployeeBranchNameQueryObject("branch");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOccupation(CompanyEmploymentOccupationArgumentsObject $argsObject = null)
    {
        $object = new CompanyEmployeeOccupationQueryObject("occupation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(CompanyEmploymentTitleArgumentsObject $argsObject = null)
    {
        $object = new CompanyEmployeeTitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
