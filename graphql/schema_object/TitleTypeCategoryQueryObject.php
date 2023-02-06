<?php

namespace GraphQL\SchemaObject;

class TitleTypeCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTypeCategory";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(TitleTypeCategoryLanguageArgumentsObject $argsObject = null)
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
