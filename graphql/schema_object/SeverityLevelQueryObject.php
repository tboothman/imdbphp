<?php

namespace GraphQL\SchemaObject;

class SeverityLevelQueryObject extends QueryObject
{
    const OBJECT_NAME = "SeverityLevel";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(SeverityLevelLanguageArgumentsObject $argsObject = null)
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

    public function selectVotedFor()
    {
        $this->selectField("votedFor");

        return $this;
    }
}
