<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameAttributeMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameAttributeMetadata";

    public function selectAllowFreeFormText()
    {
        $this->selectField("allowFreeFormText");

        return $this;
    }

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectValidValues(SelfVerifiedNameAttributeMetadataValidValuesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("validValues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
