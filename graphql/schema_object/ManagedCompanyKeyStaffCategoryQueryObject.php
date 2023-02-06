<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKeyStaffCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKeyStaffCategory";

    public function selectStaff(ManagedCompanyKeyStaffCategoryStaffArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffConnectionQueryObject("staff");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
