<?php

namespace GraphQL\SchemaObject;

class LaboratoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "Laboratory";

    public function selectAttributes(LaboratoryAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreditedAs()
    {
        $this->selectField("creditedAs");

        return $this;
    }

    public function selectDisplayableProperty(LaboratoryDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsUncredited()
    {
        $this->selectField("isUncredited");

        return $this;
    }

    public function selectLaboratory()
    {
        $this->selectField("laboratory");

        return $this;
    }
}
