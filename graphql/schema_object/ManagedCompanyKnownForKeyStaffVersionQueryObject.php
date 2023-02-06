<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForKeyStaffVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForKeyStaffVersion";

    public function selectCreatedDate()
    {
        $this->selectField("createdDate");

        return $this;
    }

    public function selectModifiedBy(ManagedCompanyKnownForKeyStaffVersionModifiedByArgumentsObject $argsObject = null)
    {
        $object = new ModifiedByQueryObject("modifiedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStaff(ManagedCompanyKnownForKeyStaffVersionStaffArgumentsObject $argsObject = null)
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

    public function selectVersionNumber()
    {
        $this->selectField("versionNumber");

        return $this;
    }
}
