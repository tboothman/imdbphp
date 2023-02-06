<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameTextTokenQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGameTextToken";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(LivingRoomGameTextTokenLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
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

    public function selectToken()
    {
        $this->selectField("token");

        return $this;
    }
}
