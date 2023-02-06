<?php

namespace GraphQL\SchemaObject;

class NameAkaQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameAka";

    public function selectDisplayableProperty(NameAkaDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameAkaPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
