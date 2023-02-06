<?php

namespace GraphQL\SchemaObject;

class NegativeFormatQueryObject extends QueryObject
{
    const OBJECT_NAME = "NegativeFormat";

    public function selectAttributes(NegativeFormatAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(NegativeFormatDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNegativeFormat()
    {
        $this->selectField("negativeFormat");

        return $this;
    }
}
