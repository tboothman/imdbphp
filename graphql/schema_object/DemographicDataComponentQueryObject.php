<?php

namespace GraphQL\SchemaObject;

class DemographicDataComponentQueryObject extends QueryObject
{
    const OBJECT_NAME = "DemographicDataComponent";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(DemographicDataComponentLanguageArgumentsObject $argsObject = null)
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
