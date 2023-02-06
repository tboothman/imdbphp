<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameAttributeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameAttribute";

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }

    public function selectValues(SelfVerifiedNameAttributeValuesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("values");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
