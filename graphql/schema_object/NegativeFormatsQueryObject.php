<?php

namespace GraphQL\SchemaObject;

class NegativeFormatsQueryObject extends QueryObject
{
    const OBJECT_NAME = "NegativeFormats";

    public function selectItems(NegativeFormatsItemsArgumentsObject $argsObject = null)
    {
        $object = new NegativeFormatQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(NegativeFormatsRestrictionArgumentsObject $argsObject = null)
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
