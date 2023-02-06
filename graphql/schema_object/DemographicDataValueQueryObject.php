<?php

namespace GraphQL\SchemaObject;

class DemographicDataValueQueryObject extends QueryObject
{
    const OBJECT_NAME = "DemographicDataValue";

    public function selectComponents(DemographicDataValueComponentsArgumentsObject $argsObject = null)
    {
        $object = new DemographicDataComponentQueryObject("components");
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

    public function selectLanguage(DemographicDataValueLanguageArgumentsObject $argsObject = null)
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
