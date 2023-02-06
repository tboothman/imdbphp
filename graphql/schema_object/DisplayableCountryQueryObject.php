<?php

namespace GraphQL\SchemaObject;

class DisplayableCountryQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableCountry";

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
