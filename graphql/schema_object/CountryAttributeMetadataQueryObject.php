<?php

namespace GraphQL\SchemaObject;

class CountryAttributeMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "CountryAttributeMetadata";

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectValidValues(CountryAttributeMetadataValidValuesArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountryQueryObject("validValues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
