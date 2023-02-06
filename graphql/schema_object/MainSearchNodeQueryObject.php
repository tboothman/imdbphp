<?php

namespace GraphQL\SchemaObject;

class MainSearchNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MainSearchNode";

    public function selectEntity(MainSearchNodeEntityArgumentsObject $argsObject = null)
    {
        $object = new MainSearchEntityUnionObject("entity");
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
}
