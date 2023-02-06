<?php

namespace GraphQL\SchemaObject;

class ColorationQueryObject extends QueryObject
{
    const OBJECT_NAME = "Coloration";

    public function selectAttributes(ColorationAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConceptId()
    {
        $this->selectField("conceptId");

        return $this;
    }

    public function selectDisplayableProperty(ColorationDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
