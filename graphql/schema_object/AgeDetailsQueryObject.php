<?php

namespace GraphQL\SchemaObject;

class AgeDetailsQueryObject extends QueryObject
{
    const OBJECT_NAME = "AgeDetails";

    public function selectDisplayableProperty(AgeDetailsDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameAgeDetailsPropertyQueryObject("displayableProperty");
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

    public function selectLanguage(AgeDetailsLanguageArgumentsObject $argsObject = null)
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

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
