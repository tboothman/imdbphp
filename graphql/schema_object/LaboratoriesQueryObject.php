<?php

namespace GraphQL\SchemaObject;

class LaboratoriesQueryObject extends QueryObject
{
    const OBJECT_NAME = "Laboratories";

    public function selectItems(LaboratoriesItemsArgumentsObject $argsObject = null)
    {
        $object = new LaboratoryQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(LaboratoriesRestrictionArgumentsObject $argsObject = null)
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
