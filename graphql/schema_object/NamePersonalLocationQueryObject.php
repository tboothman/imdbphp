<?php

namespace GraphQL\SchemaObject;

class NamePersonalLocationQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamePersonalLocation";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(NamePersonalLocationLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLatitude()
    {
        $this->selectField("latitude");

        return $this;
    }

    public function selectLongitude()
    {
        $this->selectField("longitude");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
