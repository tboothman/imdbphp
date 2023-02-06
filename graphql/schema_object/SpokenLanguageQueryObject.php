<?php

namespace GraphQL\SchemaObject;

class SpokenLanguageQueryObject extends QueryObject
{
    const OBJECT_NAME = "SpokenLanguage";

    public function selectDisplayableProperty(SpokenLanguageDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleSpokenLanguagePropertyQueryObject("displayableProperty");
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

    public function selectLanguage(SpokenLanguageLanguageArgumentsObject $argsObject = null)
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
