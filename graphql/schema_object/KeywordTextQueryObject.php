<?php

namespace GraphQL\SchemaObject;

class KeywordTextQueryObject extends QueryObject
{
    const OBJECT_NAME = "KeywordText";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(KeywordTextLanguageArgumentsObject $argsObject = null)
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
}
