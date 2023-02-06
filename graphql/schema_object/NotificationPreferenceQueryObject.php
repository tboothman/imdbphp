<?php

namespace GraphQL\SchemaObject;

class NotificationPreferenceQueryObject extends QueryObject
{
    const OBJECT_NAME = "NotificationPreference";

    public function selectInterested()
    {
        $this->selectField("interested");

        return $this;
    }

    public function selectType(NotificationPreferenceTypeArgumentsObject $argsObject = null)
    {
        $object = new NotificationPreferenceTypeQueryObject("type");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
