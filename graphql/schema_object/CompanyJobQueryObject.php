<?php

namespace GraphQL\SchemaObject;

class CompanyJobQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyJob";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(CompanyJobLanguageArgumentsObject $argsObject = null)
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
