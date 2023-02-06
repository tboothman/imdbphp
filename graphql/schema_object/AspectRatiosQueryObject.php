<?php

namespace GraphQL\SchemaObject;

class AspectRatiosQueryObject extends QueryObject
{
    const OBJECT_NAME = "AspectRatios";

    public function selectItems(AspectRatiosItemsArgumentsObject $argsObject = null)
    {
        $object = new AspectRatioQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(AspectRatiosRestrictionArgumentsObject $argsObject = null)
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
