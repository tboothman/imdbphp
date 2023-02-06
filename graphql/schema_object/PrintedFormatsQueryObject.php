<?php

namespace GraphQL\SchemaObject;

class PrintedFormatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrintedFormats";

    public function selectItems(PrintedFormatsItemsArgumentsObject $argsObject = null)
    {
        $object = new PrintedFormatQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(PrintedFormatsRestrictionArgumentsObject $argsObject = null)
    {
        $object = new TechnicalSpecificationsRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
