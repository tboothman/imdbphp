<?php

namespace GraphQL\SchemaObject;

class ProcessesQueryObject extends QueryObject
{
    const OBJECT_NAME = "Processes";

    public function selectItems(ProcessesItemsArgumentsObject $argsObject = null)
    {
        $object = new ProcessQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(ProcessesRestrictionArgumentsObject $argsObject = null)
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
