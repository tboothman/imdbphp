<?php

namespace GraphQL\SchemaObject;

class ManagedClientQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedClient";

    public function selectClient(ManagedClientClientArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("client");
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
