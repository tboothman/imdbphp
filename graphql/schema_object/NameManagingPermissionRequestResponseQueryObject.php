<?php

namespace GraphQL\SchemaObject;

class NameManagingPermissionRequestResponseQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameManagingPermissionRequestResponse";

    public function selectIsValid()
    {
        $this->selectField("isValid");

        return $this;
    }

    public function selectRequester(NameManagingPermissionRequestResponseRequesterArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("requester");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTarget(NameManagingPermissionRequestResponseTargetArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("target");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
