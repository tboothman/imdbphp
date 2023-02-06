<?php

namespace GraphQL\SchemaObject;

class NickNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "NickName";

    public function selectDisplayableProperty(NickNameDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNickNamePropertyQueryObject("displayableProperty");
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
