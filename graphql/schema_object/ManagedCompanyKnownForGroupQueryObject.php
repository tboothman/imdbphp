<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForGroup";

    public function selectKeyStaff(ManagedCompanyKnownForGroupKeyStaffArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffGroupQueryObject("keyStaff");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKnownForClient(ManagedCompanyKnownForGroupKnownForClientArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientGroupQueryObject("knownForClient");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKnownForTitle(ManagedCompanyKnownForGroupKnownForTitleArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleGroupQueryObject("knownForTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
