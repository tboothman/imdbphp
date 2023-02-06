<?php

namespace GraphQL\SchemaObject;

class PrintedFormatQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrintedFormat";

    public function selectAttributes(PrintedFormatAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(PrintedFormatDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrintedFormat()
    {
        $this->selectField("printedFormat");

        return $this;
    }
}
