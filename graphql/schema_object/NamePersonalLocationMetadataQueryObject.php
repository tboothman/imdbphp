<?php

namespace GraphQL\SchemaObject;

class NamePersonalLocationMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamePersonalLocationMetadata";

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectValidValues(NamePersonalLocationMetadataValidValuesArgumentsObject $argsObject = null)
    {
        $object = new NamePersonalLocationQueryObject("validValues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
