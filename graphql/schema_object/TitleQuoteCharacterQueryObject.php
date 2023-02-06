<?php

namespace GraphQL\SchemaObject;

class TitleQuoteCharacterQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleQuoteCharacter";

    public function selectCharacter()
    {
        $this->selectField("character");

        return $this;
    }

    public function selectName(TitleQuoteCharacterNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
