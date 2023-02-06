<?php

namespace GraphQL\SchemaObject;

class DisplayableLanguageQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableLanguage";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
