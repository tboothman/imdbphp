<?php

namespace GraphQL\SchemaObject;

class ManagingRepresentativeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagingRepresentative";

    public function selectManager(ManagingRepresentativeManagerArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("manager");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
