<?php

namespace GraphQL\SchemaObject;

class ClaimedNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "ClaimedName";

    public function selectName(ClaimedNameNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
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
