<?php

namespace GraphQL\SchemaObject;

class AuthProviderDeprecationUrlQueryObject extends QueryObject
{
    const OBJECT_NAME = "AuthProviderDeprecationUrl";

    public function selectLabel(AuthProviderDeprecationUrlLabelArgumentsObject $argsObject = null)
    {
        $object = new AuthProviderDeprecationUrlLabelQueryObject("label");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
