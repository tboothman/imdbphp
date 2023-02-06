<?php

namespace GraphQL\SchemaObject;

class LocalizedStringQueryObject extends QueryObject
{
    const OBJECT_NAME = "LocalizedString";

    public function selectLanguage()
    {
        $this->selectField("language");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
