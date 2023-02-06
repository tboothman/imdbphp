<?php

namespace GraphQL\SchemaObject;

class DemographicDataItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "DemographicDataItem";

    public function selectSelfVerified(DemographicDataItemSelfVerifiedArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedQueryObject("selfVerified");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType(DemographicDataItemTypeArgumentsObject $argsObject = null)
    {
        $object = new DemographicDataTypeQueryObject("type");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValue(DemographicDataItemValueArgumentsObject $argsObject = null)
    {
        $object = new DemographicDataValueQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
