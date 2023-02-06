<?php

namespace GraphQL\SchemaObject;

class LinkedAuthProviderQueryObject extends QueryObject
{
    const OBJECT_NAME = "LinkedAuthProvider";

    public function selectDeprecationMessage(LinkedAuthProviderDeprecationMessageArgumentsObject $argsObject = null)
    {
        $object = new AuthProviderDeprecationMessageQueryObject("deprecationMessage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }
}
