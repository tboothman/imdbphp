<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKeyStaffHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKeyStaffHistory";

    public function selectKeyStaffHistory(ManagedCompanyKeyStaffHistoryKeyStaffHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffHistoryConnectionQueryObject("keyStaffHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
